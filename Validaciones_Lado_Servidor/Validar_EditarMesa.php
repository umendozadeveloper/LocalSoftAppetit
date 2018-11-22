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
        
        if(isset($_POST['txtID'])){
            $this->objMesa->ID = $_POST['txtID'];
        }
        else{
            array_push($this->errores, "Debe seleccionar mesa a editar");
        }
        if(isset($_POST['cmbEstatus'])){
            $this->objAlmacen->Activo = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Debe seleccionar un estatus");
        }
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_ConsultarMesas.php");
        }
        else{
            $_SESSION['valNumeroMesa'] = $this->objMesa->Numero;
            $_SESSION['valCantidadPersonas'] = $this->objMesa->CantidadPersonas;
            $_SESSION['valUbicacion'] = $this->objMesa->Ubicacion;
            
            $this->objMesa->Observaciones = $_POST['txtObservaciones'];
            $_SESSION['valObservac'] = $this->objMesa->Observaciones;
            $_SESSION['valEstatus'] = $this->objMesa->Activo;
           
            if($this->objMesa->ModificarPorID($this->objMesa->ID,  
                    $this->objMesa->Numero,  $this->objMesa->CantidadPersonas,  
                    $this->objMesa->Ubicacion, $this->objMesa->Activo, 
                    $this->objMesa->Observaciones)){
                    $_SESSION['valNumeroMesa'] = null;
                    $_SESSION['valCantidadPersonas'] = null;
                    $_SESSION['valUbicacion'] = null;
                    $_SESSION['valObservac'] = NULL;
                    $_SESSION['valEstatus'] = NULL;
                    setSuccessMessage("Mesa editada correctamente");
                    header("Location: ../F_A_EditarMesas.php?IdMesa=".$this->objMesa->ID);
                
            }
            
            else{
                setSwalFailureMessage("El número de mesa ya existe favor ingrese otro.");
                header("Location: ../F_A_EditarMesas.php?IdMesa=".$this->objMesa->ID);
                
                
            }
        }
    }    
}

$objAgregarMesa = new AgregarMesas();
$objAgregarMesa->main();