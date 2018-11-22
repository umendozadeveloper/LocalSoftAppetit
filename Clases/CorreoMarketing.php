<?php

//require 'Usuario.php';
include_once '../PHPMailer-master/class.phpmailer.php';
include_once '../PHPMailer-master/class.smtp.php';
include_once 'Seguridad.php';
include_once 'Empresa.php';

class CorreoMarketing {
    
    public $objMail;
    public $Asunto;
    public $Cuerpo;
    public $Remitente;
    public $Destinatarios;
    public $Password;
   
            
//    function __construct() {
//        $objEmpresa = new Empresa();
//        $objEmpresa->ObtenerPorID(1);
//        $this->objMail = new PHPMailer();
//        $this->objMail->isSMTP();
//        $this->objMail->IsHTML(true);
//        //$this->objMail->CharSet='UTF­8';
//        $this->objMail->Port = 587;//hotmail: 465 o 25
//        //$this->objMail->PluginDir = "includes/";
//        $this->objMail->Mailer = "smtp";
//        $this->objMail->Host = "smtp.gmail.com";//hotmial es : smtp.live.com
//        //$this->objMail->Host = "smtp.live.com";
//        $this->objMail->SMTPAuth = true;
//        $this->objMail->SMTPSecure = "tls";
//        //$this->objMail->Username = "esantibanez@interpc.mx";
//        $this->objMail->Username = $objEmpresa->Correo;
//        $this->objMail->Password = $objEmpresa->Password;
//        $this->objMail->From = $objEmpresa->Correo;
//        $this->objMail->Timeout=60;
//        //  Variable  $this->objMail->FromName = "SISTEMA CAPTURA PROYECTOS";
//        
//        //  Variable  $this->objMail->Subject = "CARTA DE ACEPTACI�N (PROYECTO DE SISTEMA INVESTIGACI�N)";
//        //  Variable $this->objMail->Body = $mensaje;
//        //  Variable $this->objMail->AltBody = utf8_decode($mensaje);
//        //  Variable $this->objMail->AddAddress("umendoza9z@hotmail.com");
//        // Variable $exito = $this->objMail->Send();
//        
//        
//        
//    }
            
    
//    function EnviarCorreoBienvenidaVIP($Folio,$Destinatario){
//        $objEmpresa = new Empresa();
//        $objEmpresa->ObtenerPorID(1);
//        $this->objMail->FromName = $objEmpresa->NombreComercial;
//        $this->objMail->Subject = "BIENVENIDO AL CLUB VIP" . $objEmpresa->NombreComercial;
//        $this->objMail->Body = "Su numero de folio es:$Folio. <br>".  utf8_decode($objEmpresa->TextoBienvenidaVIP);
//        $this->objMail->AltBody = "<head><meta http-equiv='Content-Type' content='text/html;charset=UTF-8'><head>". utf8_decode($this->objMail->Body);
//        $this->objMail->AddAddress($Destinatario);
//        $exito = $this->objMail->Send();
//        //echo "Fue leido:".$this->objMail->."<br>";
//        //$this->objMail->
//        //echo "Info: ".$this->objMail->ErrorInfo."<br>";
//        //echo "Exito: ".$exito;
//        return $exito;
//    }
//    
//    
//    function EnviarCorreoPorPreferencias($Asunto, $Cuerpo, $Destinatarios){
//        $this->Asunto = utf8_decode($Asunto);
//        $this->Cuerpo = utf8_decode($Cuerpo);
//        $this->Destinatarios = $Destinatarios;
//        
//        $objEmpresa = new Empresa();
//        $objEmpresa->ObtenerPorID(1);
//        
//        //$this->objMail->SMTPDebug  = 2;
//        $this->objMail->FromName = $objEmpresa->NombreComercial;
//        $this->objMail->Subject = $this->Asunto;
//        $this->objMail->Body = "<head><meta http-equiv='Content-Type' content='text/html;charset=UTF-8'><head>".  ($this->Cuerpo);
//        $this->objMail->AltBody = "<head><meta http-equiv='Content-Type' content='text/html;charset=UTF-8'><head>".($this->Cuerpo); //utf8_decode($this->objMail->Body);
//        foreach($Destinatarios as $d)
//        {
//            $this->objMail->addAddress($d);
//        }
//        $exito = $this->objMail->send();
//        return $exito;                 
//    }
    
    
   function EnviarCorreoBienvenidaVIP($Folio, $Destinatario){
        $mail = new PHPMailer();
        $mail->isHTML(true);
        $mail->CharSet='iso-8859-1';
        
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        $this->Password= $objEmpresa->Password;
        $this->Remitente = $objEmpresa->Correo;
        $this->Destinatarios = $Destinatario;
        
        
        $mail->Port = 587;//hotmail: 465 o 25
        $mail->Mailer = "smtp";
        $mail->Host = "smtp.gmail.com";//hotmail es : smtp.live.com,  Gmail: smtp.gmail.com
        
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Username = $this->Remitente;
        $mail->Password = $this->Password;
        $mail->From = $this->Remitente;
                
        $mail->FromName = utf8_decode($objEmpresa->NombreComercial);
        $mail->Timeout=60;
        $mail->Subject = utf8_decode('BIENVENIDO AL CLUB VIP');
        
        $mensaje = utf8_decode("Bienvenido");
//        $mail->addAttachment(".".$rutaPdf);
//        $mail->addAttachment(".".$rutaXml);
        
        
//        $estructura_correo = "<div style='text-align:center;  height:200px; width:535px; background-color:white; '>
//                                <div style='height:65px;'><img src='$objEmpresa->Logo' width='75px' height='75px'></div>
//                                <div style='background-color:#D3C9C9;'>
//                                    <div style='background-color:$objEmpresa->ColorFondoBarra; color:white;'><h1>".utf8_decode($objEmpresa->NombreComercial)."</h1></div>
//                                    <div style='background-color:#D3C9C9; width:100%; height:50px;'><h3>$mensaje</h3></div>  
//                                </div>
//                             </div>";

        $mail->Body = utf8_decode("Su número de folio es: $Folio <br>". $objEmpresa->TextoBienvenidaVIP);
//        $mail->msgHTML($estructura_correo);
        $mail->AltBody = utf8_encode($mensaje);

        $mail->AddAddress($Destinatario);
        
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $exito = $mail->Send();
        $mail->smtpClose();
        if($mail->ErrorInfo != null)
        {
            return 0;
        }
        else
        {
            return 1;
        }
        
    }
    
    
    function EnviarCorreoPorPreferencias($Asunto, $Cuerpo, $Destinatarios){  
        $mail = new PHPMailer();
        $mail->isHTML(true);
        $mail->CharSet='iso-8859-1';
        
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        $this->Password= $objEmpresa->Password;
        $this->Remitente = $objEmpresa->Correo;
        $this->Destinatarios = $Destinatarios;
        
        
        $mail->Port = 587;//hotmail: 465 o 25
        $mail->Mailer = "smtp";
        $mail->Host = "smtp.gmail.com";//hotmail es : smtp.live.com,  Gmail: smtp.gmail.com
        
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Username = $this->Remitente;
        $mail->Password = $this->Password;
        $mail->From = $this->Remitente;
                
        $mail->FromName = utf8_decode($objEmpresa->NombreComercial);
        $mail->Timeout=60;
        $mail->Subject = utf8_decode($Asunto);
        
        $mensaje = utf8_decode("Bienvenido");
//        $mail->addAttachment(".".$rutaPdf);
//        $mail->addAttachment(".".$rutaXml);
        
        
//        $estructura_correo = "<div style='text-align:center;  height:200px; width:535px; background-color:white; '>
//                                <div style='height:65px;'><img src='$objEmpresa->Logo' width='75px' height='75px'></div>
//                                <div style='background-color:#D3C9C9;'>
//                                    <div style='background-color:$objEmpresa->ColorFondoBarra; color:white;'><h1>".utf8_decode($objEmpresa->NombreComercial)."</h1></div>
//                                    <div style='background-color:#D3C9C9; width:100%; height:50px;'><h3>$mensaje</h3></div>  
//                                </div>
//                             </div>";

        $mail->Body = utf8_decode($Cuerpo);
//        $mail->msgHTML($estructura_correo);
        $mail->AltBody = utf8_encode($mensaje);

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        foreach ($this->Destinatarios as $correo)
        {
            $mail->AddAddress($correo);
            $exito = $mail->Send();
            $mail->clearAddresses();
        }
        
        
        
//        $exito = $mail->Send();
        $mail->smtpClose();
        if($exito != TRUE)
        {
            return 0;
        }
        else
        {
            return 1;
        }
        
    }
    
}



