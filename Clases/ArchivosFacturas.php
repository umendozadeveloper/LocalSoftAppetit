<?php

class ArchivosFacturas {

    public $NumeroCertificado; //Serial
    public $Certificado;
    public $FechaInicio;
    public $FechaFin;
    public $Sello;
    public $ArchivoKEY;
    public $ArchivoCER;
    public $Pass;

    public function ObtenerDatos($ArchivoKEY, $ArchivoCER, $Pass) {
        $this->ArchivoKEY = $ArchivoKEY;
        $this->ArchivoCER = $ArchivoCER;
        $this->Pass = $Pass;

        
        
        $ejecuta = `C:\OpenSSL-Win64\bin\openssl.exe pkcs8 -inform DER -in $this->ArchivoKEY  -out $this->ArchivoKEY.pem -passin pass:$this->Pass`;
        $ejecuta = `C:\OpenSSL-Win64\bin\openssl.exe x509 -inform DER -outform PEM -in $this->ArchivoCER  -out $this->ArchivoCER.pem`;

        //$ejecuta = `C:\OpenSSL-Win64\bin\openssl.exe  pkcs8 -inform DER -in $this->ArchivoKEY -passin pass:$this->Pass`;

        $Serial = `C:\OpenSSL-Win64\bin\openssl.exe  x509 -in $this->ArchivoCER.pem -serial -noout`;
        $this->NumeroCertificado = $this->ObtenerCertificado($Serial);
        $Certificado = `C:\OpenSSL-Win64\bin\openssl.exe  x509 -in $this->ArchivoCER.pem -serial`;
        $Certificado = str_replace($Serial, "", $Certificado);
        $Certificado = str_replace("-----BEGIN CERTIFICATE-----", "", $Certificado);
        $Certificado = str_replace("-----END CERTIFICATE-----", "", $Certificado);
        $this->Certificado = $Certificado;


        $this->FechaInicio = `C:\OpenSSL-Win64\bin\openssl.exe x509 -in $this->ArchivoCER.pem -startdate -noout`;
        $this->FechaInicio = str_replace("notBefore=","",  $this->FechaInicio);
        $this->FechaInicio = new DateTime($this->FechaInicio);
        $this->FechaInicio = $this->FechaInicio->format('d-m-Y H:i:s');
        
        $this->FechaFin = `C:\OpenSSL-Win64\bin\openssl.exe x509 -in $this->ArchivoCER.pem -enddate -noout`;
        $this->FechaFin = str_replace("notAfter=","",  $this->FechaFin);
        $this->FechaFin = new DateTime($this->FechaFin);
        $this->FechaFin = $this->FechaFin->format('d-m-Y H:i:s');
        
        
    }

    public function ObtenerCertificado($Serial) {
        $Serial = str_replace("serial=", "", $Serial);
        $SerialF = "";
        $resultado = true;
        for ($contador = 0; $contador < strlen($Serial); $contador ++) {

            if ($resultado) {
                $resultado = false;
            } else {
                $SerialF = $SerialF."".$Serial[$contador];
                $resultado = true;
            }
        }
        
        return $SerialF;
    }

}
