<?php

namespace App\Services;

use App\Models\information;
use DarkDevLab\Encryptor\OpenSslEncryptor;
use DarkDevLab\Encryptor\Cipher;

class AESEncryptionService{
    public function aesEncryption(information $information)
    {
        $aes = new OpenSslEncryptor(env('SECRET_KEY'), Cipher::get(Cipher::AES_256_CBC));
        $encryptedInformation = new information();
        $startTime = microtime(true);
        foreach ($information->getAttributes() as $key => $value) {
            if ($key !== 'id' && $key !== 'crypt' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at' && $key !== 'duration' && $key !== 'crypt') {

                $encryptedValue = $aes->encrypt($value);
                $encryptedInformation[$key] = $encryptedValue;
            } else {

                $encryptedInformation[$key] = $value;
            }
        }
        $endtime = microtime(true);
        $duration = ($endtime - $startTime)*1000;
        $encryptedInformation['crypt'] = "AES_256_CBC";
        $encryptedInformation['duration'] = $duration;
        return $encryptedInformation;
    }
}

?>