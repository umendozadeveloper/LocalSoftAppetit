<?php

include_once  '../Clases/Mesa.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class AgregarMesas{
    public $errores;
    public $objMesa;
    
    function __construct() {
        $this->errores = array();
        $this->objMesa = new Mesa();

    }
    
    function main(){
        if(isset($_POST['txtNumeroMesa'])){
            $this->objMesa->Numero = $_POST['txtNumeroMesa'];
        }
        else{
            array_push($this->errores, "El número de mesas no puede estar vacío");
        }
        
        if(isset($_POST['txtCantidadPersonas'])){
            $this->objMesa->CantidadPersonas= $_POST['txtCantidadPersonas'];
        }
        else{
            array_push($this->errores, "La cantidad de personas por mesa no puede estar vacía");
        }
        
        if(isset($_POST['txtUbicacion'])){
            $this->objMesa->Ubicacion= $_POST['txtUbicacion'];
        }
        else{
            array_push($this->errores, "El campo ubicación no puede estar vacio");
        }
        if(isset($_POST['cmbEstatus'])){
            $this->objMesa->Activo = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Se debe seleccionar si la mesa está en desuso");
        }
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarMesa.php");
        }
        else{
            $_SESSION['valNumeroMesa'] = $this->objMesa->Numero;
            $_SESSION['valCantidadPersonas'] = $this->objMesa->CantidadPersonas;
            $_SESSION['valUbicacion'] = $this->objMesa->Ubicacion;
            
            $this->objMesa->Observaciones = $_POST['txtObservaciones'];
            $_SESSION['valObservac'] = $this->objMesa->Observaciones;
            $_SESSION['valEstatus'] = $this->objMesa->Activo;
           
            if(!$this->objMesa->ConsultarPorNumero($this->objMesa->Numero)){
                if($this->objMesa->InsertarMesa($this->objMesa->Numero,
                    $this->objMesa->CantidadPersonas, $this->objMesa->Ubicacion,
                    $this->objMesa->Observaciones, $this->objMesa->Activo)){
                    $_SESSION['valNumeroMesa'] = null;
                    $_SESSION['valCantidadPersonas'] = null;
                    $_SESSION['valUbicacion'] = null;
                    $_SESSION['valObservac'] = null;
                    $_SESSION['valEstatus'] = NULL;
                    
                    setSuccessMessage("Mesa agreagada correctamente");
                    header("Location: ../F_A_DetalleMesa.php?IdMesa=".$this->objMesa->ID);
                }
            }
            
            else{
                setSwalFailureMessage("El número de mesa ya existe favor ingrese otro.");
                header("Location: ../F_A_RegistrarMesa.php");
                
            }
        }
    }    
}

$objAgregarMesa = new AgregarMesas();
$objAgregarMesa->main();