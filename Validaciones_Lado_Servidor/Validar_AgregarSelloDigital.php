<?php

include_once '../Funciones/Mensajes_Bootstrap.php';
include_once '../Funciones/P_SwalMensajes.php';
include_once '../Clases/Empresa.php';

class AgregarSelloDigital{
    public $errores;
    public $objSelloDigital;
            
            
    function __construct() {
        $this->errores = array();
        $this->objSelloDigital = new Empresa();
    }
    
    function main()
    {
    
        $rutaCer = "";
        $rutaKey = "";
        $key = "";
        $certificado = "";
        $destino ="";
        if(isset($_POST['txtContrasenaSello']))
        {
            $this->objSelloDigital->Contrasena = $_POST['txtContrasenaSello'];
        }
        else{
            array_push($this->errores,"Ingresar contraseña");
        }
        
        
        if(isset($_FILES['archivoCer'])){
            $certificado = $_FILES['archivoCer']['name'];
            $extensionCer = explode(".", $certificado);
            $destinoCer = "../xml/SelloDigital/" . $certificado;
           
            
            $rutaCer = $_FILES['archivoCer']['tmp_name'];
            $this->objSelloDigital->ArchivoCer = $destinoCer;
        }
        else{
            array_push($this->errores,"Ingresar archivo .cer");
        }
        
        
        if(isset($_FILES['archivoKey'])){
            $key = $_FILES['archivoKey']['name'];
            $extensionKey = explode(".", $key);
            $destinoKey ="../xml/SelloDigital/" . $key;
            $rutaKey = $_FILES['archivoKey']['tmp_name'];
            $this->objSelloDigital->ArchivoKey = $destinoKey;
        }
        else{
            array_push($this->errores,"Ingresar archivo .key");
           
        }
        
        
        
        if($this->errores){
            foreach($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_SellosDigitales.php");
        }
        else{

                $_SESSION['valContrasenaSello'] = $this->objSelloDigital->Contrasena;
                $_SESSION['archivoCer'] = $rutaCer;
                $_SESSION['archivoKey'] = $rutaKey;    
                
                if($this->objSelloDigital->EditarSelloDigital($this->objSelloDigital->ArchivoCer, $this->objSelloDigital->ArchivoKey, 
                        $this->objSelloDigital->Contrasena, 1 )){
                        
                        if($certificado!=""){
                            copy($rutaCer, $this->objSelloDigital->ArchivoCer);
                        }
                        if($key!=""){
                            copy($rutaKey, $this->objSelloDigital->ArchivoKey);
                        }
                $_SESSION['ArchivoCer'] = NULL;
                $_SESSION['ArchivoKey'] = NULL;
                $_SESSION['valContrasenaSello'] = NULL;
                setSuccessMessage("Sello digital guardado correctamente");
                header("Location: ../F_A_SellosDigitales.php");
                }
                
//            else
//            {
//                
//                setFailureMessage("El sello digital ya está registrado, favor de ingresar otro nombre");   
//                header("Location: ../F_A_RegistrarPlatillo.php");
//            }
        }
        
        
        
        
        
        
    }
}

$objAgregarSelloDigital = new AgregarSelloDigital();
$objAgregarSelloDigital->main();

?>
    

