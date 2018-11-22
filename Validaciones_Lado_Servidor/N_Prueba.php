<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/CorreoMarketing.php';
include_once '../Clases/Cliente.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

include_once '../Clases/Correo.php';

class N_Prueba{
    public $objPublicidad;
    public $errores = array();
    
    
    function Main(){
        
//        $this->objPublicidad = new Publicidad();
//$foto = $_FILES['archivo']['name'];
//if(!$_POST['txtNombreImagen']){
//    array_push($this->errores, "Favor de ingresar nombre a la imagen");
//}
//
//if(!$_FILES['archivo']['name']){
//    array_push($this->errores, "Favor de cargar imagen");
//}
//
//    if($_FILES['archivo']['type']!="image/png"){
//        array_push($this->errores, "El formato del archivo debe ser png");
//    }
//
//if($this->errores){
//    foreach ($this->errores as $e){
//        setFailureMessage($e);
//    }
//    header("Location: ../F_A_AgregarPublicidad.php");
//}
//else{

//        $Nombre = $_POST['txtNombreImagen'];
//        $extensionFoto = explode(".", $foto);
//        $Imagen ="../bd_Fotos/Publicidad/".  $this->objPublicidad->obtenerId()."Foto.".$extensionFoto[1]."";
//        $ruta = $_FILES['archivo']['tmp_name'];
//        
//        if($this->objPublicidad->Insertar($Imagen, $Nombre))
//        {
//            copy($ruta, $Imagen);
//            header("Location: ../F_A_AgregarPublicidad.php");
//            setSuccessMessage("Imagen registrada correctamente");
//
//        }
//        else{
//            header("Location: ../F_A_AgregarPublicidad.php");
//            setFailureMessage("Error en el registro");
//        }
//        
//  
//}
        
        $objCorreo = new CorreoMarketing();
        $objCliente = new Cliente();
        if($objCorreo->EnviarCorreoBienvenidaVIP(5, 'bere.nice@live.com')){
            $tempo = "entra";
            $objCliente->MarcarCorreoEnviado(5);
        }
        
//        $objCorreo = new Correo;
//        $objCorreo->EnviarFactura('bere.nice@live.com', '../xml/FacturaTimbrada2017-05-29T09-28-42.xml', '../xml/FacturaTimbrada2017-05-29T09-28-42.pdf', 'hola');
        
        
    }

    
    
    
}//clase



$objPrueba = new N_Prueba();
$objPrueba->Main();
?>
