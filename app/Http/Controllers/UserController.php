<?php

namespace App\Http\Controllers;

use App\Models\information;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller 
{
    public function showDashboard($userId){
        $latestInfo = user::where('id', $userId)->first();
        return view('profile', ['userId' => $userId, 'latestInfo' => $latestInfo]);
    }

    public function showForm($userId){
        return view('form', ['userId' => $userId]);
    }

    public function showListData($userId){
        return view('list', ['userId' => $userId]);
    }

    public function checkPassword(Request $request){
        $credentials = $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();
        // dd($user->password);
        try{
            if(Hash::check($request->password, $user->password)){
                $password = $request->password;
                return redirect()->route('user.showform', ['userId' => $user->id]);
            }
            else{
                return redirect()->back()->withErrors(['wrong_password' => 'Password invalid!']);
            }
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    public function showInsertEmail($userId){
        return view('insertEmail', ['userId' => $userId]);
    }

    public function checkEmail(Request $request, $userId){
        $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/'],
        ]);
        try{
            $existed = user::where('email', $request->email)->first();
            if($existed){
                return redirect()->route('user.listotherdata', ['userId' => $userId, 'requestedId' => $existed->id]);
            }
            else{
                return redirect()->back()->withErrors(['email_inexistent' => "Email doesn't exist!"]);
            }
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

}
