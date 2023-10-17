<?php

namespace App\Http\Controllers;

use App\Models\information;
use App\Models\user;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    function storeInformation(Request $request){
        try{

            $userId = $request->route('userId');

            $data = new information();
            $data->nama = $request->name;
            $data->NIK = $request->nik;
            $data->dob = $request->dob;
            $data->gender = $request->gender;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->geneticDisease = $request->geneticDisease;
            $data->allergies = $request->allergies;
            $data->medications = $request->medications;
            $data->bloodPressure = $request->bloodPressure;
            $data->cholesterol = $request->cholesterol;
            $data->medicalHistory = $request->medicalHistory;
            $data->ethicity = $request->ethnicity;
            $data->sexualOrientation = $request->sexualOrientation;
            $data->religion = $request->religion;
            $data->languages = $request->languages;
            $data->nationality = $request->nationality;
            $data->politicalAffiliation = $request->politicalAffiliation;
            $data->biometricVideo = $request->file('biometricVideo')->store('public/video');
            $data->biometricData = $request->biometricData;
            $data->eyeColor = $request->eyeColor;
            $data->hairColor = $request->hairColor;
            $data->kkDocument = $request->file('kkDocument')->store('public/doc');
            $data->photo1 = $request->file('photo1')->store('public/photo');
            $data->user_id = $userId;
            $data->save();
            
            return redirect()->route('user.dashboard', ['userId' => $userId]);
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    function showView($userId){
        $latestInfo = information::where('user_id', $userId)->latest()->first();

        if($latestInfo){
            return view('vieu', ['userId' => $userId, 'latestInfo' => $latestInfo]);
        }
    }
}
