<?php
include_once '../Clases/Ventas.php';
include_once './Funciones/Mensajes_Bootstrap.php';

class VentaCancelada{
    public $errores;
    public $objVenta;
    
    
    public function __construct() {
        $this->objVenta = new Ventas();
        $this->errores = array();
    }
    
    public function main(){
        
        if(isset($_POST['txtID'])){
            $this->objVenta->ID = $_POST['txtID'];
        }
        else {
            array_push($this->errores, "Es necesario seleccionar venta para cancelarla");
        }
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
        }
        else{
            if($this->objVenta->CancelarVenta($this->objVenta->ID)){
                setSuccessMessage("La venta ha sido cancelada");
                header("Location: ../F_A_ConsultarVentas.php");
            }
            else{
                setFailureMessage("Ha ocurrido un error por favor intente nuevamente");
                header("Location: ../F_A_ConsultarVentas.php");
            }
            
        }

    }
}

$objCancela_Venta = new VentaCancelada();
$objCancela_Venta->main();

    
?>