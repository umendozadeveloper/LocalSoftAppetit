<?php
include_once  '../Clases/Concepto.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class AgregarConcepto{
    public $errores;
    public $objConcepto;
    
    function __construct() {
        $this->errores = array();
        $this->objConcepto = new Concepto();
    }
   
    function main(){
        if(isset($_POST['txtClaveConcepto'])){
            $this->objConcepto->Clave = $_POST['txtClaveConcepto'];
        }
        else{
            array_push($this->errores, "La clave del concepto no puede quedar vacía");
        }
        
        if(isset($_POST['txtDescrConcepto'])){
            $this->objConcepto->Descripcion = $_POST['txtDescrConcepto'];
        }
        else{
            array_push($this->errores, "La descripción del concepto no puede quedar vacía");
        }
        
        if(isset($_POST['txtID'])){
            $this->objConcepto->ID = $_POST['txtID'];
        }
        else{
            array_push($this->errores, "Debe seleccionar un concepto a editar");
        }
         if(isset($_POST['cmbES'])){
            $this->objConcepto->ES = $_POST['cmbES'];
        }
        else{
            array_push($this->errores, "Debe seleccionar el tipo de concepto (Entrada/Salida)");
        }
          if(isset($_POST['cmbEstatus'])){
            $this->objConcepto->Estatus = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Debe seleccionar un estatus");
        }
       
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarConceptos.php");
        }
        else{
            $_SESSION['valClaveConcepto'] = $this->objConcepto->Clave;
            $_SESSION['valDescrConcepto'] = $this->objConcepto->Descripcion;
            $_SESSION['valES']= $this->objConcepto->ES;
            
            $this->objConcepto->Observaciones = $_POST['txtObservaciones'];
            $_SESSION['valObservac'] = $this->objConcepto->Observaciones;
            $_SESSION['valEstatus'] = $this->objConcepto->Estatus;
           
            if($this->objConcepto->ModificarPorID($this->objConcepto->ID, $this->objConcepto->Clave, 
                    $this->objConcepto->Descripcion,  $this->objConcepto->ES, $this->objConcepto->Observaciones,
                    $this->objConcepto->Estatus)){
                $_SESSION['valClaveConcepto'] = NULL;
                $_SESSION['valDescrConcepto'] = NULL; 
                $_SESSION['valES']= NULL;
                $_SESSION['valObservac'] = null;
                $_SESSION['valEstatus'] = null;
                setSuccessMessage("Concepto editado correctamente");
                header("Location: ../F_A_EditarConcepto.php?IdConcepto=".$this->objConcepto->ID);
                
            }
            
            else{
                setSwalFailureMessage("El concepto ya existe favor ingrese otro.");
                header("Location: ../F_A_EditarConcepto.php?IdConcepto=".$this->objConcepto->ID);
                
                
            }
        }
    }    
}

$objAgregarConcepto = new AgregarConcepto();
$objAgregarConcepto->main();
