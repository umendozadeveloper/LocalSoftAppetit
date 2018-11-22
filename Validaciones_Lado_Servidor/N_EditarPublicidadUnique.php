<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/Publicidad.php';
include_once './Funciones/Mensajes_Bootstrap.php';

class N_EditarPublicidadUnique{

    public $errores = array();
    public $objPublicidad;
    public $banderaFoto;
            
    function Main(){
    $this->objPublicidad = new Publicidad();
    $this->banderaFoto = 0;
    
    if(!isset($_POST['txtNombreImagen'])){
        array_push($this->errores, "Es necesario ingresar el nombre de la imagen");
    }
    if(!isset($_POST['cmbFoto'])){
        array_push($this->errores, "Favor de seleccionar si se editará la foto o no");
    }
    if(!isset($_POST['Id_Publicidad'])){
        array_push($this->errores, "Elegir publicidad");
    }
    
    
    if($_POST['cmbFoto']==1)
    {
        $this->banderaFoto = 1;
        if(empty($_FILES['archivo']['name'])){
                array_push($this->errores, "Favor de cargar imagen");
        }
    }
    
    
    
    
    
    if($this->retornar()){
        
    }
    else{
        unset($this->errores);
        $this->errores = array();
        $Nombre = $_POST['txtNombreImagen'];
        $Id_Publicidad = $_POST['Id_Publicidad'];
        $tipo = '';
        if($this->banderaFoto==1){
            $foto = $_FILES['archivo']['name'];
            $tipo = $_FILES['archivo']['type'];
            $extensionFoto = explode(".", $foto);
            $Imagen ="../bd_Fotos/Publicidad/".$this->objPublicidad->obtenerId()."Foto.".$extensionFoto[1]."";
            $ruta = $_FILES['archivo']['tmp_name'];
        }
        $this->Validar($Nombre,$tipo);                
        if(!$this->retornar()){
            if($this->banderaFoto==1){
                if($this->objPublicidad->Modificar($Id_Publicidad, $Nombre,$Imagen)){
                    copy($ruta, $Imagen);
                    setSuccessMessage("Se ha editado correctamente");
                }
                else{
                    setFailureMessage("Error en la edición por favor verifique los datos");
                }
            }
            else{
            if($this->objPublicidad->Modificar($Id_Publicidad, $Nombre)){
                setSuccessMessage("Se ha editado correctamente");
            }
            else{
                setFailureMessage("Error en la edición por favor verifique los datos");
            }
            }
        }
        header("Location: ../F_A_EditarPublicidad.php?Id_Publicidad=$Id_Publicidad");
    }
    
    

}

function Validar($Nombre,$Tipo){
        if(strlen($Nombre)<1){
            array_push($this->errores,"Ingresar un nombre");
        }
        if($this->banderaFoto==1)
        if($Tipo!='image/png'){
            array_push($this->errores, "Ingresar archivos solo en formato png");
            array_push($this->errores, $Tipo);
        }
    }
    
    function retornar(){
        if($this->errores){
            foreach($this->errores as $e){
                setFailureMessage($e);
            }
            if(isset($_POST['Id_Publicidad'])){
                header("Location: ../F_A_EditarPublicidad.php?Id_Publicidad=".$_POST['Id_Publicidad']."");
            }
            else{
                header("Location: ../F_A_Publicidad.php?");
            }
            return true;
        }
        else{
            return FALSE;
        }
    }

    
    
}





$objN_AgregarPublicidadU = new N_EditarPublicidadUnique();
$objN_AgregarPublicidadU->Main();
?>