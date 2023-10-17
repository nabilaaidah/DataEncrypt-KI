<?php

namespace App\Services;

use App\Models\information;
use DarkDevLab\Encryptor\Cipher;
use DarkDevLab\Encryptor\OpenSslEncryptor;

class DESEncryptionService{
    public function desEncryption(information $information)
    {
        $des = new OpenSslEncryptor(env('SECRET_KEY'), Cipher::get(Cipher::DES_CBC));
        $encryptInformation = new information();
        $startTime = microtime(true);
        foreach ($information->getAttributes() as $key => $value) {
            if ($key !== 'id' && $key !== 'crypt' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at' && $key !== 'duration' && $key !== 'crypt') {

                $encryptValue = $des->encrypt($value);
                $encryptInformation[$key] = $encryptValue;
            } else {

                $encryptInformation[$key] = $value;
            }
        }
        $endtime = microtime(true);
        $duration = ($endtime - $startTime)*1000;
        $encryptInformation['crypt'] = "DES_CBC";
        $encryptInformation['duration'] = $duration;
        return $encryptInformation;
    }
}

?>