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
        
        if(isset($_POST['txtID'])){
            $this->objUbicacion->ID = $_POST['txtID'];
        }
        else{
            array_push($this->errores, "Debe seleccionar una ubicación a editar");
        }
        
          if(isset($_POST['cmbEstatus'])){
            $this->objUbicacion->Estatus = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Debe seleccionar un estatus");
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
           
            if($this->objUbicacion->ModificarPorID($this->objUbicacion->ID, $this->objUbicacion->Clave, 
                    $this->objUbicacion->Descripcion, $this->objUbicacion->Observaciones,
                    $this->objUbicacion->Estatus)){
                $_SESSION['valClaveUbicacion'] = NULL;
                $_SESSION['valDescrUbicacion'] = NULL;
                $_SESSION['valObservac'] = null;
                $_SESSION['valEstatus'] = NULL;
                setSuccessMessage("Ubicación editado correctamente");
                header("Location: ../F_A_EditarUbicacion.php?IdUbicacion=".$this->objUbicacion->ID);
                
            }
            
            else{
                setSwalFailureMessage("La ubicación ya existe favor ingrese otro.");
                header("Location: ../F_A_EditarUbicacion.php?IdUbicacion=".$this->objUbicacion->ID);
                
                
            }
        }
    }    
}

$objAgregarUbicacion = new AgregarUbicacion();
$objAgregarUbicacion->main();