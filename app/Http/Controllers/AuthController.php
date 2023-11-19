<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    }

    public function showLogin(){
        return view('login');
    }

    public function storeRegister(Request $request){
        $credentials = $request->validate([
            'fullname' => ['required'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', 'unique:user,email'],
            'password' => ['required'],
        ]);
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
                'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/'],
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
