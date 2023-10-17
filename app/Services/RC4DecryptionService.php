<?php

namespace App\Services;

use App\Models\information;
use DarkDevLab\Encryptor\Cipher;
use DarkDevLab\Encryptor\OpenSslEncryptor;

class RC4DecryptionService{
    public function rc4Decryption(information $information)
    {
        $rc4 = new OpenSslEncryptor(env('SECRET_KEY'), Cipher::get(Cipher::RC4));
        $decryptedInformation = new information();
        $startTime = microtime(true);
        foreach ($information->getAttributes() as $key => $value) {
            if ($key !== 'id' && $key !== 'crypt' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at' && $key !== 'duration' && $key !== 'crypt') {
                $decryptedValue = $rc4->decrypt($value);
                $decryptedInformation[$key] = $decryptedValue;
                if($key === 'biometricVideo' || $key === 'kkDocument' || $key === 'photo1')
                {
                    $filePath = str_replace('public', 'storage', $decryptedValue);
                    $rpath = fopen($filePath, "rb");
                    $fileContents = fread($rpath, filesize($filePath));
                    $wpath = fopen($filePath, "wb");
                    $encryptedContent = $rc4->decrypt($fileContents);
                    fwrite($wpath, $encryptedContent);
                }
            } else {

                $decryptedInformation[$key] = $value;
            }
        }
        $endtime = microtime(true);
        $duration = ($endtime - $startTime)*1000;
        $decryptedInformation['duration'] = $duration;
        return $decryptedInformation;
    }
}

?>