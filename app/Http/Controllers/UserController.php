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
    public function showRegister(){
        return view('register');
    }

    public function showLogin(){
        return view('login');
    }

    public function showDashboard($userId){
        $latestInfo = user::where('id', $userId)->latest()->first();
        return view('profile', ['userId' => $userId, 'latestInfo' => $latestInfo]);
    }

    public function showForm($userId){
        return view('form', ['userId' => $userId]);
    }

    public function storeRegister(Request $request){
        try{
            $existingUser = user::where('email', $request['email'])->first();
            if ($existingUser) {
                print('Email already existed\n');
                return redirect()->back()->withInput()->withErrors(['email' => 'Email already exists. Please use a different email.']);
            }

            $userData = new user();
            $userData->name = $request->fullname;
            $userData->email = $request->email;
            $userData->password = Hash::make($request->password);
            $userData->save();

            return redirect()->route('user.showlogin');
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    public function login(Request $request){
        try{
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                $user = Auth::user();
                $userId = $user->id;
                return redirect()->route('user.dashboard', ['userId' => $userId]);
            }
            else{
                return redirect()->back()->withErrors(['login_error' => 'Email and password invalid!']);
            }
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
