<?php
include_once '../Clases/Mesa.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class BorradoLogico_Mesa{
    public $errores;
    public $objMesa;
    
    
    public function __construct() {
        $this->objMesa = new Mesa();
        $this->errores = array();
    }
    
    public function main(){
        
        if(isset($_POST['txtID'])){
            $this->objMesa->ID = $_POST['txtID'];
        }
        else {
            array_push($this->errores, "Es necesario seleccionar mesa a eliminar");
        }
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
                header("Location: ../F_A_ConsultarMesas.php");
            }
        }
        else{
            if($this->objMesa->BorradoLogico($this->objMesa->ID)){
                setSuccessMessage("Mesa eliminada correctamente");
                header("Location: ../F_A_ConsultarMesas.php");
            }
            else{
                setFailureMessage("Ha ocurrido un error por favor intente nuevamente");
                header("Location: ../F_A_ConsultarMesas.php");
            }
            
        }

    }
}

$objBorradaL_Mesa = new BorradoLogico_Mesa();
$objBorradaL_Mesa->main();

    
?>