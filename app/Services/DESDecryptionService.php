<?php

namespace App\Services;

use App\Models\information;
use DarkDevLab\Encryptor\Cipher;
use DarkDevLab\Encryptor\OpenSslEncryptor;

class DESDecryptionService{
    public function desDecryption(information $information)
    {
        $des = new OpenSslEncryptor(env('SECRET_KEY'), Cipher::get(Cipher::DES_CBC));
        $decryptInformation = new information();
        $startTime = microtime(true);
        foreach ($information->getAttributes() as $key => $value) {
            if ($key !== 'id' && $key !== 'crypt' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at' && $key !== 'duration' && $key !== 'crypt') {

                $decryptValue = $des->decrypt($value);
                $decryptInformation[$key] = $decryptValue;
            } else {

                $decryptInformation[$key] = $value;
            }
        }
        $endtime = microtime(true);
        $duration = ($endtime - $startTime)*1000;
        $decryptInformation['duration'] = $duration;
        return $decryptInformation;
    }
}

?>