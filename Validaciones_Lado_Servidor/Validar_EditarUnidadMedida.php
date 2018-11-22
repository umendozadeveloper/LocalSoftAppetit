<?php
include_once  '../Clases/UnidadMedidaInsumos.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class AgregarUnidadMedidaInsumos{
    public $errores;
    public $objUnidadMedida;
    
    function __construct() {
        $this->errores = array();
        $this->objUnidadMedida = new UnidadMedidaInsumo();
    }
   
    function main(){
        if(isset($_POST['txtClaveUM'])){
            $this->objUnidadMedida->Clave = $_POST['txtClaveUM'];
        }
        else{
            array_push($this->errores, "La clave de la unidad no puede quedar vacía");
        }
        
        if(isset($_POST['txtDescrUM'])){
            $this->objUnidadMedida->Descripcion = $_POST['txtDescrUM'];
        }
        else{
            array_push($this->errores, "La descripción de la unidad no puede quedar vacía");
        }
        
        if(isset($_POST['txtID'])){
            $this->objUnidadMedida->ID = $_POST['txtID'];
        }
        else{
            array_push($this->errores, "Debe seleccionar unidad a editar");
        }
        
        if(isset($_POST['cmbEstatus'])){
            $this->objUnidadMedida->Estatus = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Debe seleccionar un estatus");
        }
        
       
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_Registrar_UnidadMedida.php");
        }
        else{
            $_SESSION['valClaveUM'] = $this->objUnidadMedida->Clave;
            $_SESSION['valDescrUM'] = $this->objUnidadMedida->Descripcion;
            
             $this->objUnidadMedida->Observaciones = $_POST['txtObservaciones'];
            $_SESSION['valObservac'] = $this->objUnidadMedida->Observaciones;
            $_SESSION['valEstatus'] = $this->objUnidadMedida->Estatus;
           
           
            if($this->objUnidadMedida->ModificarPorID($this->objUnidadMedida->ID, $this->objUnidadMedida->Clave, 
                    $this->objUnidadMedida->Descripcion, $this->objUnidadMedida->Observaciones, $this->objUnidadMedida->Estatus)){
                $_SESSION['valClaveUM'] = NULL;
                $_SESSION['valDescrUM'] = NULL;
                $_SESSION['valObservac'] = null;
                $_SESSION['valEstatus'] = null;
                setSuccessMessage("Unidad de medida editada correctamente");
                header("Location: ../F_A_Editar_UnidadMedida.php?IdUnidad=".$this->objUnidadMedida->ID);
                
            }
            
            else{
                setSwalFailureMessage("La unidad de medida ya existe favor ingrese otro.");
                header("Location: ../F_A_Editar_UnidadMedida.php?IdUnidad=".$this->objUnidadMedida->ID);
                
                
            }
        }
    }    
}

$objAgregarUM = new AgregarUnidadMedidaInsumos();
$objAgregarUM->main();