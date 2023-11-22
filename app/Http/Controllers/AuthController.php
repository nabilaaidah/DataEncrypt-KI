<?php

namespace App\Http\Controllers;

use App\Models\requesting;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use phpseclib\Crypt\RSA;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    }

    public function showLogin(){
        return view('login');
    }

    public function showLinkLogin(Request $request, $requestId){
        return view('linklogin', ['requestId' => $requestId]);
    }

    public function linkLogin(Request $request, $requestId){
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/'],
                'password' => ['required'],
            ]);

            // if (URL::hasValidSignature($request)) {
                $data = requesting::where('id', $requestId)->first();
                if (Auth::attempt($credentials) && $data->senderEmail == $request->email) {
                    $request->session()->regenerate();
                    // dd($requestId);
                    return redirect()->route('link.showview', ['userId' => $data->user_id, 'id' => $data->information_id]);
                } else {
                    return redirect()->back()->withErrors(['login_error' => 'Email and password did not match the request!']);
                }
            // } else {
            //     return redirect()->route('link.showlogin', ['requestId' => $requestId])->withErrors(['login_error' => 'Invalid or expired login link.']);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->getMessage());
        }
    }

 
    public function storeRegister(Request $request){
        $credentials = $request->validate([
            'fullname' => ['required'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', 'unique:user,email'],
            'password' => ['required'],
        ]);
        $rsa = new RSA();
        $keyPair = $rsa->createKey();
        $publicKey = $keyPair['publickey'];
        $privateKey = $keyPair['privatekey'];
        $symmetricKey = Str::random(64);
        try{
            $existingUser = user::where('email', $request['email'])->first();
            if ($existingUser) {
                print('Email already existed\n');
                return redirect()->back()->withInput()->withErrors(['email' => 'Email already exists. Please use a different email.']);
            }

            $userData = new user();
            $userData->pubkey = $publicKey;
            $userData->privkey = $privateKey;
            $userData->name = $request->fullname;
            $userData->email = $request->email;
            $userData->symkey = $symmetricKey;
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
