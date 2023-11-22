<?php

namespace App\Http\Services;

use App\Models\information;
use App\Models\user;
use App\Models\RequestedInformation;
use phpseclib\Crypt\RSA;
class AsymService
{
    public function encrypt($userId, $req_id)
    {
        $user = user::where('id', $userId)->first();
        $reqInfo = new RequestedInformation();
        $publicKey = $user->publicKey;
        $rsa = new RSA();
        $rsa->loadKey($publicKey);
        $enckey = $rsa->encrypt($user->symkey);
        $reqInfo->enckey;
        $reqInfo->request_id = $req_id;
        return $enckey;
    }

    public function decrypt($userId, $reqInformationId, $encsymkey)
    {
        $user = user::where('id', $userId)->first();
        $reqInfo = requestedInformation::where('id', $reqInformationId)->first();
        $information = new information();
        $privKey = $user->privkey;
        $rsa = new RSA();
        $rsa->loadKey($privKey);

    }
}