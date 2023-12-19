<?php

namespace App\Http\Helpers;
use phpseclib\Crypt\RSA;
class PDFSignatureHelper
{
    private string $obj     =   "====BEGIN_SIGNATURE====\n24 0 obj\n";
    private string $header  =   "<<//ByteRange[ 0 FILELENGTH HASHLEN TRAILLEN]\n/Contents<";
    private string $sig;

    private string $hashres;
    private string $trailer =   ">\n" .
                                "/Filter/Adobe.PPKLite\n" .
                                "/M(D:20231211162228+07'00')\n" .
                                "/Name(THEUSER)\n" .
                                "/Prop_Build<<\n" .
                                "/App<<\n" .
                                "/Name/Adobe#20Acrobat#20Reader#20#2864-bit#29/OS[/Win]/R 1508864/REx(2023.006.20380)/TrustedMode true\n" .
                                ">>\n" .
                                "/Filter<<\n" .
                                "/Date(THEDATE)\n" .
                                "/Name/Adobe.PPKLite\n" .
                                "/R 131104\n" .
                                "/V 2\n" .
                                ">>\n" .
                                "/PubSec<<\n" .
                                "/Date(THEDATE)\n" .
                                "/R 131105\n" .
                                ">>\n" .
                                "/SubFilter/adbe.pkcs7.detached\n" .
                                "/Type/Sig\n".
                                "endobj\n";
    private string $privkey;
    private string $info;
    private string $name;
    private string $filePath;
    public function __construct(string $filePath, string $name, string $privkey){
        $this->privkey = $privkey;
        $this->name = $name;
        $this->filePath = $filePath;
    }

    public function Sign(){
        try{
            $this->HashInformation();
            $this->WriteHash();
            $this->WriteName();
            $this->WriteDate();
            $this->WriteDateTime();
            $this->CalculateByteRange();
        }
        catch(\Exception $e){
            return false;
        }
        return true;
    }

    public function HashInformation(){
        $hashes = file_get_contents($this->filePath);
        $this->info = hash("sha256", $hashes);
    }
    private function WriteDate(){
        $date = date("YmdHis");
        $this->trailer = str_replace("20231211162228", $date, $this->trailer);
    }
    private function WriteName(){
        $this->trailer = str_replace("THEUSER", $this->name, $this->trailer);
    }

    private function WriteDateTime(){
        $date = date("M  d Y H:i:s");
        $this->trailer = str_replace("THEDATE", $date, $this->trailer);
    }

    private function EncryptHash(){
        $rsa = new RSA();
        $rsa->loadKey($this->privkey);
        $this->info = base64_encode($rsa->encrypt($this->info));
    }

    public function GetInfo(){
        return $this->hashres;
    }
    private function WriteHash(){
        $this->EncryptHash();
        $this->sig = $this->info;
    }

    public function CalculateByteRange(){
        $file = file_get_contents($this->filePath);
        $fileLength = filesize($this->filePath);
        $hashLength = strlen($this->info);
        $trailLen = strlen($this->trailer);
        $objlen = strlen($this->obj);
        $this->header = str_replace("TRAILLEN", $trailLen, $this->header);
        $this->header = str_replace("FILELENGTH", $fileLength+46+$objlen, $this->header);
        $this->header = str_replace("HASHLEN", $fileLength+47+$objlen+$hashLength, $this->header);
        $data = $file."\n".$this->obj.$this->header.$this->sig.$this->trailer."%%EOF";
        file_put_contents($this->filePath, $data);
    }
}