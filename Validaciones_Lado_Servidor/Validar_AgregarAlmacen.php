<?php

include_once  '../Clases/Almacen.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class AgregarAlmacen{
    public $errores;
    public $objAlmacen;
    
    function __construct() {
        $this->errores = array();
        $this->objAlmacen = new Almacen();
    }
   
    function main(){
        if(isset($_POST['txtClaveAlmacen'])){
            $this->objAlmacen->Clave = $_POST['txtClaveAlmacen'];
        }
        else{
            array_push($this->errores, "La clave del almacén no puede quedar vacía");
        }
        
        if(isset($_POST['txtDescrAlmacen'])){
            $this->objAlmacen->Descripcion = $_POST['txtDescrAlmacen'];
        }
        else{
            array_push($this->errores, "La descripción del almacén no puede quedar vacía");
        }
        if(isset($_POST['cmbEstatus'])){
            $this->objAlmacen->Estatus = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Se debe seleccionar un estatus");
        }
       
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarAlmacen.php");
        }
        else{
            $_SESSION['valClaveAlmacen'] = $this->objAlmacen->Clave;
            $_SESSION['valDescrAlmacen'] = $this->objAlmacen->Descripcion;
           
            $this->objAlmacen->Observaciones = $_POST['txtObservaciones'];
            $_SESSION['valObservac'] = $this->objAlmacen->Observaciones;
            $_SESSION['valEstatus'] = $this->objAlmacen->Estatus;
            
            if($this->objAlmacen->Insertar($this->objAlmacen->Clave, $this->objAlmacen->Descripcion,
                    $this->objAlmacen->Observaciones,  $this->objAlmacen->Estatus)){
                $_SESSION['valClaveAlmacen'] = NULL;
                $_SESSION['valDescrAlmacen'] = NULL;
                setSuccessMessage("Almacén agregado correctamente");
                header("Location: ../F_A_DetalleAlmacen.php?IdAlmacen=".$this->objAlmacen->ID);
            }  
            else{
                setSwalFailureMessage("Ocurrió un error, el almacén no se pudo registrar. Intente más tarde.");
                header("Location: ../F_A_RegistrarAlmacen.php");
                
            }
        }
    }    
}

$objAgregarAlmacen = new AgregarAlmacen();
$objAgregarAlmacen->main();