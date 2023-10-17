<?php

namespace App\Services;

use App\Models\information;
use DarkDevLab\Encryptor\Cipher;
use DarkDevLab\Encryptor\OpenSslEncryptor;

class RC4EncryptionService{
    
    public function rc4Encryption(information $information)
    {
        $rc4 = new OpenSslEncryptor(env('SECRET_KEY'), Cipher::get(Cipher::RC4));
        $encryptedInformation = new information();
        $startTime = microtime(true);
        foreach ($information->getAttributes() as $key => $value) {
            if ($key !== 'id' && $key !== 'crypt' && $key !== 'user_id' && $key !== 'created_at' && $key !== 'updated_at' && $key !== 'duration' && $key !== 'crypt') {
                if($key === 'biometricVideo' || $key === 'kkDocument' || $key === 'photo1')
                {
                    if($key === 'biometricVideo' || $key === 'kkDocument' || $key === 'photo1')
                    {
                        $filePath = str_replace('public', 'storage', $value);
                        $rpath = fopen($filePath, "rb");
                        $fileContents = fread($rpath, filesize($filePath));
                        $wpath = fopen($filePath, "wb");
                        $encryptedContent = $rc4->encrypt($fileContents);
                        fwrite($wpath, $encryptedContent);
                    }
                }
                $encryptedValue = $rc4->encrypt($value);
                $encryptedInformation[$key] = $encryptedValue;
            } else {

                $encryptedInformation[$key] = $value;
            }
        }
        $endtime = microtime(true);
        $duration = ($endtime - $startTime)*1000;
        $encryptedInformation['crypt'] = "RC4";
        $encryptedInformation['duration'] = $duration;
        return $encryptedInformation;
    }
}

?>