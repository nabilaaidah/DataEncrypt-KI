<?php

namespace App\Http\Controllers;

use App\Models\information;
use App\Models\user;
use Illuminate\Http\Request;
use App\Models\requesting;
use phpseclib\Crypt\AES;
use phpseclib\Crypt\RSA;
use App\Models\RequestedInformation;
use Illuminate\Support\Str;
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
            $aes = new AES();
            $symkey = Str::random(64);
            $aes->setKey($symkey);
            $data = new information();
            $data->symkey = $symkey;
            $data->title = $request->title;
            $data->nama = $request->name;
            $data->NIK = base64_encode($aes->encrypt($request->nik));
            $data->dob = base64_encode($aes->encrypt($request->dob));
            $data->gender = base64_encode($aes->encrypt($request->gender));
            $data->email = base64_encode($aes->encrypt($request->email));
            $data->phone = base64_encode($aes->encrypt($request->phone));
            $data->address = base64_encode($aes->encrypt($request->address));
            $data->geneticDisease = base64_encode($aes->encrypt($request->geneticDisease));
            $data->allergies = base64_encode($aes->encrypt($request->allergies));
            $data->medications = base64_encode($aes->encrypt($request->medications));
            $data->bloodPressure = base64_encode($aes->encrypt($request->bloodPressure));
            $data->cholesterol = base64_encode($aes->encrypt($request->cholesterol));
            $data->medicalHistory = base64_encode($aes->encrypt($request->medicalHistory));
            $data->ethicity = base64_encode($aes->encrypt($request->ethnicity));
            $data->sexualOrientation = base64_encode($aes->encrypt($request->sexualOrientation));
            $data->religion = base64_encode($aes->encrypt($request->religion));
            $data->languages = base64_encode($aes->encrypt($request->input('languages')));
            $data->nationality = base64_encode($aes->encrypt($request->nationality));
            $data->politicalAffiliation = base64_encode($aes->encrypt($request->politicalAffiliation));
            $data->biometricVideo = base64_encode($aes->encrypt($request->file('biometricVideo')->store('public/video')));
            $data->biometricData = base64_encode($aes->encrypt($request->biometricData));
            $data->eyeColor = base64_encode($aes->encrypt($request->eyeColor));
            $data->hairColor = base64_encode($aes->encrypt($request->hairColor));
            $data->kkDocument = base64_encode($aes->encrypt($request->file('kkDocument')->store('public/doc')));
            $data->photo1 = base64_encode($aes->encrypt($request->file('photo1')->store('public/photo')));
            $data->user_id = $userId;
            $data->save();
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
        $latestInfo = information::where('id', $id)->first();
        $userId = $latestInfo->user_id;
        $symkey = $latestInfo->symkey;
        $aes = new AES();
        $aes->setKey($symkey);
        $latestInfo->NIK = $aes->decrypt(base64_decode($latestInfo->NIK));
        $latestInfo->dob = $aes->decrypt(base64_decode($latestInfo->dob));
        $latestInfo->gender = $aes->decrypt(base64_decode($latestInfo->gender));
        $latestInfo->email = $aes->decrypt(base64_decode($latestInfo->email));
        $latestInfo->phone = $aes->decrypt(base64_decode($latestInfo->phone));
        $latestInfo->address = $aes->decrypt(base64_decode($latestInfo->address));
        $latestInfo->geneticDisease = $aes->decrypt(base64_decode($latestInfo->geneticDisease));
        $latestInfo->allergies = $aes->decrypt(base64_decode($latestInfo->allergies));
        $latestInfo->medications = $aes->decrypt(base64_decode($latestInfo->medications));
        $latestInfo->bloodPressure = $aes->decrypt(base64_decode($latestInfo->bloodPressure));
        $latestInfo->cholesterol = $aes->decrypt(base64_decode($latestInfo->cholesterol));
        $latestInfo->medicalHistory = $aes->decrypt(base64_decode($latestInfo->medicalHistory));
        $latestInfo->ethicity = $aes->decrypt(base64_decode($latestInfo->ethicity));
        $latestInfo->sexualOrientation = $aes->decrypt(base64_decode($latestInfo->sexualOrientation));
        $latestInfo->religion = $aes->decrypt(base64_decode($latestInfo->religion));
        $latestInfo->languages = $aes->decrypt(base64_decode($latestInfo->languages));
        $latestInfo->nationality = $aes->decrypt(base64_decode($latestInfo->nationality));
        $latestInfo->politicalAffiliation = $aes->decrypt(base64_decode($latestInfo->politicalAffiliation));
        $latestInfo->eyeColor = $aes->decrypt(base64_decode($latestInfo->eyeColor));
        $latestInfo->hairColor = $aes->decrypt(base64_decode($latestInfo->hairColor));
        $latestInfo->photo1 = $aes->decrypt(base64_decode($latestInfo->photo1));
        $latestInfo->biometricVideo = $aes->decrypt(base64_decode($latestInfo->biometricVideo));
        $latestInfo->kkDocument = $aes->decrypt(base64_decode($latestInfo->kkDocument));

        if($latestInfo){
            return view('vieu', ['id' => $id, 'latestInfo' => $latestInfo, 'userId' => $userId]);
        }
    }

    public function listOtherData($userId, $requestedId){

        $data = information::where('user_id', $requestedId)->get();
        $requestedId = user::where('id', $requestedId)->first();

        return view('listotherdata', ['userId' => $userId, 'information' => $data, 'requestedId' => $requestedId]);
    }

    public function linkShowView($userId, $informationid){
        //dd($informationid);
        $request = requesting::where('information_id', $informationid)->where('user_id',$userId)->first();
        $request_information = RequestedInformation::where('request_id',$request->id)->first();
        $latestInfo = information::where('id', $informationid)->first();
        $userAskedId = $latestInfo->user_id;
        $privkey = user::where('id', $userAskedId)->first()->privkey;
        //dd($privkey);
        $rsa = new RSA();
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
        $aes = new AES();
        $rsa->loadKey($privkey);
        $enckey = base64_decode($request_information->enc_symkey);
        $symkey = $rsa->decrypt($enckey);
        $aes->setKey($symkey);
        //dd($symkey,$usersym);
        //
        $latestInfo->NIK = $aes->decrypt(base64_decode($latestInfo->NIK));
        $latestInfo->dob = $aes->decrypt(base64_decode($latestInfo->dob));
        $latestInfo->gender = $aes->decrypt(base64_decode($latestInfo->gender));
        $latestInfo->email = $aes->decrypt(base64_decode($latestInfo->email));
        $latestInfo->phone = $aes->decrypt(base64_decode($latestInfo->phone));
        $latestInfo->address = $aes->decrypt(base64_decode($latestInfo->address));
        $latestInfo->geneticDisease = $aes->decrypt(base64_decode($latestInfo->geneticDisease));
        $latestInfo->allergies = $aes->decrypt(base64_decode($latestInfo->allergies));
        $latestInfo->medications = $aes->decrypt(base64_decode($latestInfo->medications));
        $latestInfo->bloodPressure = $aes->decrypt(base64_decode($latestInfo->bloodPressure));
        $latestInfo->cholesterol = $aes->decrypt(base64_decode($latestInfo->cholesterol));
        $latestInfo->medicalHistory = $aes->decrypt(base64_decode($latestInfo->medicalHistory));
        $latestInfo->ethicity = $aes->decrypt(base64_decode($latestInfo->ethicity));
        $latestInfo->sexualOrientation = $aes->decrypt(base64_decode($latestInfo->sexualOrientation));
        $latestInfo->religion = $aes->decrypt(base64_decode($latestInfo->religion));
        $latestInfo->languages = $aes->decrypt(base64_decode($latestInfo->languages));
        $latestInfo->nationality = $aes->decrypt(base64_decode($latestInfo->nationality));
        $latestInfo->politicalAffiliation = $aes->decrypt(base64_decode($latestInfo->politicalAffiliation));
        $latestInfo->eyeColor = $aes->decrypt(base64_decode($latestInfo->eyeColor));
        $latestInfo->hairColor = $aes->decrypt(base64_decode($latestInfo->hairColor));
        $latestInfo->photo1 = $aes->decrypt(base64_decode($latestInfo->photo1));
        $latestInfo->biometricVideo = $aes->decrypt(base64_decode($latestInfo->biometricVideo));
        $latestInfo->kkDocument = $aes->decrypt(base64_decode($latestInfo->kkDocument));
        if($latestInfo){
            return view('linkvieu', ['id' => $request->information_id, 'latestInfo' => $latestInfo, 'userId' => $userId]);
        }
    }
}
