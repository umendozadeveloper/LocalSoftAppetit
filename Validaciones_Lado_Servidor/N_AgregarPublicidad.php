<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/Publicidad.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';


class N_AgregarPublicidad{
    public $objPublicidad;
    public $errores = array();
    
    
    function Main(){
        
        $this->objPublicidad = new Publicidad();
$foto = $_FILES['archivo']['name'];
if(!$_POST['txtNombreImagen']){
    array_push($this->errores, "Favor de ingresar nombre a la imagen");
}

if(!$_FILES['archivo']['name']){
    array_push($this->errores, "Favor de cargar imagen");
}

    if($_FILES['archivo']['type']!="image/png"){
        array_push($this->errores, "El formato del archivo debe ser png");
    }

if($this->errores){
    foreach ($this->errores as $e){
        setFailureMessage($e);
    }
    header("Location: ../F_A_AgregarPublicidad.php");
}
else{

        $Nombre = $_POST['txtNombreImagen'];
        $extensionFoto = explode(".", $foto);
        $Imagen ="../bd_Fotos/Publicidad/".  $this->objPublicidad->obtenerId()."Foto.".$extensionFoto[1]."";
        $ruta = $_FILES['archivo']['tmp_name'];
        
        if($this->objPublicidad->Insertar($Imagen, $Nombre))
        {
            copy($ruta, $Imagen);
            header("Location: ../F_A_AgregarPublicidad.php");
            setSuccessMessage("Imagen registrada correctamente");

        }
        else{
            header("Location: ../F_A_AgregarPublicidad.php");
            setFailureMessage("Error en el registro");
        }
}
    }
    }



$objN_AgregarPublicidad = new N_AgregarPublicidad();
$objN_AgregarPublicidad->Main();
?>
