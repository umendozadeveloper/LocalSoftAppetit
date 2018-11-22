<?php

include_once  '../Clases/Ubicacion.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class AgregarUbicacion{
    public $errores;
    public $objUbicacion;
    
    function __construct() {
        $this->errores = array();
        $this->objUbicacion = new Ubicacion();
    }
   
    function main(){
        if(isset($_POST['txtClaveUbicacion'])){
            $this->objUbicacion->Clave = $_POST['txtClaveUbicacion'];
        }
        else{
            array_push($this->errores, "La clave de la ubicación no puede quedar vacía");
        }
        
        if(isset($_POST['txtDescrUbicacion'])){
            $this->objUbicacion->Descripcion = $_POST['txtDescrUbicacion'];
        }
        else{
            array_push($this->errores, "La descripción de la ubicación no puede quedar vacía");
        }
        if(isset($_POST['cmbEstatus'])){
            $this->objUbicacion->Estatus = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Se debe seleccionar un estatus");
        }
       
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarUbicacion.php");
        }
        else{
            $_SESSION['valClaveUbicacion'] = $this->objUbicacion->Clave;
            $_SESSION['valDescrUbicacion'] = $this->objUbicacion->Descripcion;
           
            $this->objUbicacion->Observaciones = $_POST['txtObservaciones'];
            $_SESSION['valObservac'] = $this->objUbicacion->Observaciones;
            $_SESSION['valEstatus'] = $this->objUbicacion->Estatus;
            
            if($this->objUbicacion->Insertar($this->objUbicacion->Clave, $this->objUbicacion->Descripcion,
            $this->objUbicacion->Observaciones, $this->objUbicacion->Estatus)){
                $_SESSION['valClaveUbicacion'] = NULL;
                $_SESSION['valDescrUbicacion'] = NULL;
                $_SESSION['valObservac'] = null;
                $_SESSION['valEstatus'] = null;
                setSuccessMessage("Ubicación agregada correctamente");
                header("Location: ../F_A_DetalleUbicacion.php?IdUbicacion=".$this->objUbicacion->ID);
            }  
            else{
                setSwalFailureMessage("Ocurrió un error, la ubicación no se pudo registrar. Intente más tarde.");
                header("Location: ../F_A_RegistrarUbicacion.php");
                
            }
        }
    }    
}

$objAgregarUbicacion = new AgregarUbicacion();
$objAgregarUbicacion->main();