<?php

namespace App\Http\Controllers;

use App\Models\information;
use App\Models\user;
use Illuminate\Http\Request;
use App\Services\RC4EncryptionService;
use App\Services\RC4DecryptionService;
use App\Services\AESEncryptionService;
use App\Services\AESDecryptionService;
use App\Services\DESEncryptionService;
use App\Services\DESDecryptionService;

class InformationController extends Controller
{
    function storeInformation(Request $request){
        try{
            $request->validate([
                'title' => 'required',
                'name' => 'required',
                'nik' => 'required',
                'dob' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]);

            $userId = $request->route('userId');

            $data = new information();
            $data->title = $request->title;
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
            
            // $encryptRc4 = new RC4EncryptionService();
            // $rc4Data = $encryptRc4->rc4Encryption($data);
            // $rc4Data->save();

            // $encryptAes = new AESEncryptionService();
            // $aesData = $encryptAes->aesEncryption($data);
            // $aesData->save();

            // $encryptDes = new DESEncryptionService();
            // $desData = $encryptDes->desEncryption($data);
            // $desData->save();
            return redirect()->route('user.dashboard', ['userId' => $userId]);
        }
        catch (\Illuminate\Validation\ValidationException $e){
            dd($e->getMessage());
        }
    }

    public function listData($userId){
        $data = information::where('user_id', $userId)->get();
        return view('listdata', ['information' => $data, 'userId' => $userId]);
    }

    public function showView($userId, $id){
        // $decryptRc4 = new RC4DecryptionService();
        // $latestInfo = information::where('user_id', $userId)->where('crypt', 'RC4')->latest()->first();
        // dd($id);
        $latestInfo = information::where('id', $id)->first();

        // $rc4DurInfo = $latestInfo->duration;
        // $aesDurInfo = information::where('user_id', $userId)->where('crypt', 'AES_256_CBC')
        //     ->latest()
        //     ->value('duration');
        // $desDurInfo = information::where('user_id', $userId)->where('crypt', 'DES_CBC')
        //     ->latest()
        //     ->value('duration');
        // $latestInfo = $decryptRc4->rc4Decryption($latestInfo);

        if($latestInfo){
            // dd($latestInfo->nama);
            // return view('vieu', ['userId' => $userId, 'latestInfo' => $latestInfo, 'aesDurInfo' => $aesDurInfo, 'desDurInfo' => $desDurInfo, 'rc4DurInfo' => $rc4DurInfo]);
            return view('vieu', ['id' => $id, 'latestInfo' => $latestInfo, 'userId' => $userId]);
        }
    }

    public function listOtherData($userId, $requestedId){
        // dd($requestedId);
        $data = information::where('user_id', $requestedId)->get();
        $requestedId = user::where('id', $requestedId)->first();
        return view('listotherdata', ['userId' => $userId, 'information' => $data, 'requestedId' => $requestedId]);
    }
}
