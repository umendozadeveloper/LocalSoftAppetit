<?php

include_once  '../Clases/Clasificador.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class AgregarClasificador{
    public $errores;
    public $objClasificador;
    
    function __construct() {
        $this->errores = array();
        $this->objClasificador = new Clasificador();
    }
   
    function main(){
        if(isset($_POST['txtClaveClasif'])){
            $this->objClasificador->Clave = $_POST['txtClaveClasif'];
        }
        else{
            array_push($this->errores, "La clave del clasificador no puede quedar vacía");
        }
        
        if(isset($_POST['txtDescrClasif'])){
            $this->objClasificador->Descripcion = $_POST['txtDescrClasif'];
        }
        else{
            array_push($this->errores, "La descripción del clasificador no puede quedar vacía");
        }
        
        if(isset($_POST['cmbEsBebida'])){
            $this->objClasificador->EsBebida = $_POST['cmbEsBebida'];
        }
        else{
            $this->objClasificador->EsBebida = 0;
        }
        if(isset($_POST['cmbEstatus'])){
            $this->objClasificador->Estatus = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Se debe seleccionar un estatus");
        }
       
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarClasificador.php");
        }
        else{
            $_SESSION['valClaveClasif'] = $this->objClasificador->Clave;
            $_SESSION['valDescrClasif'] = $this->objClasificador->Descripcion;
            $_SESSION['valEsBebida']= $this->objClasificador->EsBebida;
            
            $this->objClasificador->Observaciones = $_POST['txtObservaciones'];
            $_SESSION['valObservac'] = $this->objClasificador->Observaciones;
            $_SESSION['valEstatus'] = $this->objClasificador->Estatus;
           
           
            if($this->objClasificador->InsertarClasificador($this->objClasificador->Clave, $this->objClasificador->Descripcion,
            $this->objClasificador->EsBebida, $this->objClasificador->Observaciones, $this->objClasificador->Estatus)){
                $_SESSION['valClaveClasif'] = NULL;
                $_SESSION['valDescrClasif'] = NULL;
                $_SESSION['valEsBebida'] = Null;
                $_SESSION['valObservac'] =null;
                $_SESSION['valEstatus'] = null;
                setSuccessMessage("Clasificador agregado correctamente");
                header("Location: ../F_A_Detalle_Clasificador.php?IdClasificador=".$this->objClasificador->ID);
            }  
            else{
                setSwalFailureMessage("Ocurrió un error, el clasificador no se pudo registrar. Intente más tarde.");
                header("Location: ../F_A_RegistrarClasificador.php");
                
            }
        }
    }    
}

$objAgregarClasificador = new AgregarClasificador();
$objAgregarClasificador->main();