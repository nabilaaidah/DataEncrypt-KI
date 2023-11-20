<?php

namespace App\Http\Controllers;

use App\Models\information;
use App\Models\requesting;
use App\Models\user;
use Illuminate\Http\Request;
use app\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

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

            return redirect()->route('user.dashboard', ['userId' => $userId]);
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
                return view();
            }
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    public function sendEmail($userId, $requestedId, $informationId){
        try{
            $req = user::where('id', $requestedId)->get();

            $email = new Mailer($req);
            Mail::to($req->email)->send($email);
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }
}
