<?php

namespace App\Http\Controllers;

use App\Models\requesting;
use App\Models\user;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function storingRequest($userId, $requestedId, $informationId){
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

    public function showRequestList($userId){
        $data = requesting::where('user_id', $userId)->get();
        return view('listrequestdata', ['information' => $data]);
    }
}
