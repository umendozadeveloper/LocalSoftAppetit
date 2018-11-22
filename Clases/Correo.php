<?php
include_once '../PHPMailer-master/class.phpmailer.php';
include_once '../PHPMailer-master/class.smtp.php';
include_once 'Empresa.php';

class Correo{
    
    public $Remitente;
    public $Destinatario;
    public $Password;
    
    public function EnviarFactura($correoDestinatario, $rutaXml, $rutaPdf, $mensaje){
        $mail = new PHPMailer();
        $mail->isHTML(true);
        $mail->CharSet='iso-8859-1';
        
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        $this->Password= $objEmpresa->Password;
        $this->Remitente = $objEmpresa->Correo;
        $this->Destinatario = $correoDestinatario;
        
        
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
        $mail->Subject = utf8_decode("CFDI: Facturación electrónica de ". $objEmpresa->NombreComercial);
        $mensaje = utf8_decode($mensaje);
        $mail->addAttachment(".".$rutaPdf);
        $mail->addAttachment(".".$rutaXml);
        
        
        $estructura_correo = "<div style='text-align:center;  height:200px; width:535px; background-color:white; '>
                                <div style='height:65px;'><img src='$objEmpresa->Logo' width='75px' height='75px'></div>
                                <div style='background-color:#D3C9C9;'>
                                    <div style='background-color:$objEmpresa->ColorFondoBarra; color:white;'><h1>".utf8_decode($objEmpresa->NombreComercial)."</h1></div>
                                    <div style='background-color:#D3C9C9; width:100%; height:50px;'><h3>$mensaje</h3></div>  
                                </div>
                             </div>";

        $mail->Body =$estructura_correo;
        $mail->msgHTML($estructura_correo);
        $mail->AltBody = utf8_encode($mensaje);

        $mail->AddAddress($this->Destinatario);
        
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
    
        
}

?>
