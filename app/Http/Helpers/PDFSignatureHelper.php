<?php

namespace App\Http\Helpers;
use phpseclib\Crypt\RSA;
class PDFSignatureHelper
{
    
    private string $sig =   "24 0 obj\n" .
                            "/ByteRange[ 0 FILELENGTH LEN TRAILLEN]\n" .
                            "/Contents<THEHASH>\n" .
                            "/Filter/Adobe.PPKLite\n" .
                            "/M(D:20231211162228+07'00')\n" .
                            "/Name(THEUSER)\n" .
                            "/Prop_Build<<\n" .
                            "  /App<<\n" .
                            "    /Name/Adobe#20Acrobat#20Reader#20#2864-bit#29/OS[/Win]/R 1508864/REx(2023.006.20380)/TrustedMode true\n" .
                            "  >>\n" .
                            "  /Filter<<\n" .
                            "    /Date(Nov  5 2023 03:48:10)\n" .
                            "    /Name/Adobe.PPKLite\n" .
                            "    /R 131104\n" .
                            "    /V 2\n" .
                            "  >>\n" .
                            "  /PubSec<<\n" .
                            "    /Date(Nov  5 2023 03:48:10)\n" .
                            "    /R 131105\n" .
                            "  >>\n" .
                            ">>\n" .
                            "/SubFilter/adbe.pkcs7.detached\n" .
                            "/Type/Sig".
                            "endobj\n";
    private array $keys;
    private string $info;
    private string $name;
    private string $filePath;
    public function __construct(string $filePath, string $name, array $keys){
        $this->keys = $keys;
        $this->name = $name;
        $this->filePath = $filePath;
    }

    public function Sign(){
        $this->HashInformation();
        $this->EncryptHash();
        $this->WriteHash();
        $this->WriteName();
        $this->WriteDate();
        $this->WriteDateTime();
        $this->CalculateByteRange();
    }

    public function HashInformation(){
        $this->filePath = str_replace("public", "../../../../public/storage", $this->filePath);
        $this->info = file_get_contents($this->filePath);
        $this->info = hash('SHA256', $this->filePath);
    }
    private function WriteDate(){
        $date = date("YmdHis");
        $this->sig = str_replace("20231211162228", $date, $this->sig);
    }
    private function WriteName(){
        $this->sig = str_replace("THEUSER", $this->name, $this->sig);
    }
    //replace date (Nov  5 2023 03:48:10) with current date time
    private function WriteDateTime(){
        $date = date("M  d Y H:i:s");
        $this->sig = str_replace("Nov  5 2023 03:48:10", $date, $this->sig);
    }

    private function EncryptHash(){
        $rsa = new RSA();
        $rsa->loadKey($this->keys['privatekey']);
        $rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
        $this->info = bin2hex($rsa->sign($this->info));
    }
    private function WriteHash(){
        $this->EncryptHash();
        $this->sig = str_replace("THEHASH", $this->info, $this->sig);
    }

    public function GetSignature(){
        return $this->sig;
    }

    public function CalculateByteRange(){
        $file = fopen($this->filePath, 'rb');
        $partition = explode('>\n', $this->sig);
        $trailLen = strlen($partition[1]);
        $fileLength = filesize($file);
        $data = $file;
        $hashLength = strlen('<'.$this->info.'>');
        str_replace("TRAILLEN", $trailLen, $this->sig);
        str_replace("FILELENGTH", $fileLength, $this->sig);
        str_replace("LEN", $hashLength+$fileLength, $this->sig);
        fclose($file);
        $file = fopen($this->filePath, 'wb');
        fwrite($file, $data);
        fwrite($file, $this->sig);
    }
}