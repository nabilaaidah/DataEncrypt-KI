<?php

namespace App\Http\Controllers;

use App\Mail\DeclineNotification;
use App\Models\information;
use App\Models\requesting;
use App\Models\user;
use Illuminate\Http\Request;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class RequestController extends Controller
{
    public function storingRequest($userId, $requestedId, $informationId){

        try{
            $user = user::where('id', $userId)->first();
            $req = user::where('id', $requestedId)->first();
            // dd($user->email);

            $data = new requesting();
            $data->senderEmail = $user->email;
            $data->receiverEmail = $req->email;
            $data->status = "Mengajukan request";
            $data->information_id = $informationId;
            $data->user_id = $userId;
            $data->save();

            $reqId = $data->id;

            return view('requestsentpage', ['userId' => $userId]);
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    public function showRequestList($userId){
        try{
            $user = user::where('id', $userId)->first();
            $data = requesting::where('receiverEmail', $user->email)->get();
            if($data->first()){
                return view('listrequestdata', ['information' => $data]);
            }
            else{
                return view('norequest', ['userId' => $userId]);
            }
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    public function generateOneTimeToken(){
        $token = Str::random(40);
        session(['one_time_login_token' => $token]);
        return $token;
    }

    public function sendEmail($requestId){
        try{
            $req = requesting::where('id', $requestId)->first();
            $user = user::where('email', $req->receiverEmail)->first();

            $signedUrl = URL::temporarySignedRoute(
                'link.showlogin',
                now()->addMinutes(4), // Set an expiration time (adjust as needed)
                ['requestId' => $requestId]
            );

            $email = new Mailer($signedUrl, $req);
            Mail::to($req->senderEmail)->send($email);

            return view('acceptpage', ['userId' => $user->id]);
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    public function storingAccept($requestId){
        $data = requesting::where('id', $requestId)->first();
        $data->status = 'Diterima';
        $data->save();

        return redirect()->route('request.sendemail', ['requestId' => $requestId]);
    }

    public function storingDecline($requestId){
        $data = requesting::where('id', $requestId)->first();
        $data->status = 'Ditolak';
        $data->save();
        $user = user::where('email', $data->receiverEmail)->first();

        $email = new DeclineNotification($data);
        Mail::to($data->senderEmail)->send($email);
        return view('declinepage', ['userId' => $user->id]);
    }
}
