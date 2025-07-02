<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StpController extends Controller
{

    // El siguiente es un ejemplo de una cadena original válida:
    // ||40072|EMPRESA|20111111||RAS|90646|9999.99||||1234|||Beneficiario|5678||||||||||||REFCOB|7777||||||||


    public function getSign() {
        $privateKey = $this->getCertified();
        $binarySign="";
        openssl_sign($this->cadenaOriginal, $binarySign, $privateKey, "RSA-SHA256");
        $sign = base64_encode($binarySign);
        openssl_free_key($privateKey);
        return $sign;
    }

    private function getCertified() {
        $fp = fopen($this->privatekey, "r");
        $privateKey = fread($fp, filesize($this->privatekey));
        fclose($fp);
        return openssl_get_privatekey($privateKey, $this->passphrase);
    }
}
