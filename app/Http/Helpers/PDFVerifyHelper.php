<?php

namespace App\Http\Helpers;
use phpseclib\Crypt\RSA;

class PDFVerifyHelper{
    private array $keys;

    private array $info;
    private string $filePath;

    public function __construct(string $filePath, array $keys){
        $this->keys = $keys;
        $this->filePath = $filePath;
        $this->BreakData();
    }

    public function VerifyHash(){
        $rsa = new RSA();
        $rsa->loadKey($this->keys["publickey"]);
        $file = file_get_contents($this->filePath);
        $originalBlock= explode("\n====BEGIN_SIGNATURE====", $file)[0];
        $encHash = $this->info['hash'];
        $information = $rsa->decrypt(base64_decode($encHash));
        if(strcmp($information, hash("sha256", $originalBlock)) == 0){
            return ["information" => $information, "originalBlock" => hash("sha256", $originalBlock)];
        }
         return false;
    }

    private function BreakData(){
        $file = file_get_contents($this->filePath);
        $signatureBlock = explode("\n====BEGIN_SIGNATURE====\n", $file)[1];

        //Get Hash Block
        $preHashBlock = explode("/Contents<", $signatureBlock)[1];
        $hashBlock = explode(">", $preHashBlock)[0];

        //Get modified Date
        $preDate = explode("/M(", $signatureBlock)[1];
        $date = explode(")", $preDate)[0];

        //Get issuer
        $preIssuer = explode("/Name(", $signatureBlock)[1];
        $issuer = explode(")", $preIssuer)[0];

        //Get Signature Date
        $preSignatureDate = explode("/Date(", $signatureBlock)[1];
        $signatureDate = explode(")", $preSignatureDate)[0];

        $this->info = [
            "hash" => $hashBlock,
            "date" => $date,
            "issuer" => $issuer,
            "signatureDate" => $signatureDate
        ];
    }
}