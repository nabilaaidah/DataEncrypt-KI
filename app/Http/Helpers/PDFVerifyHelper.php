<?php

namespace App\Http\Helpers;
use phpseclib\Crypt\RSA;

class PDFVerifyHelper{
    private string $pubkey;

    private array $info;
    private string $filePath;

    public function __construct(string $filePath, string $pubkey){
        $this->pubkey = $pubkey;
        $this->filePath = $filePath;
        $this->BreakData();
    }

    public function Verify(){
        $rsa = new RSA();
        $rsa->loadKey($this->pubkey);
        $file = file_get_contents($this->filePath);
        $originalBlock= explode("\n====BEGIN_SIGNATURE====", $file)[0];
        $encHash = $this->info['hash'];
        $decodedInformation = base64_decode($encHash);
        $information = $rsa->decrypt($decodedInformation);
        $hashedFile = trim(hash("sha256", $originalBlock),'\n');
        echo $information;
        echo $hashedFile;
        try{
        if(strcmp($information, $hashedFile) == 0){
            return ["FileHash" => $information,
                    "LastModifiedDate" => $this->info['date'],
                    "Issuer" => $this->info['issuer'],
                    "SignatureDate" => $this->info['signatureDate'],
                    "status" => true];
        }
         return [
            "FileHash" =>  null,
            "status" => false,
        ];
        }
        catch(\Exception $e){
            return [
                "FileHash" =>  null,
                "status" => false,
            ];
        }
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