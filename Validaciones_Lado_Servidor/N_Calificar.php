<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/ComandaPlatillos.php';
include_once '../Clases/ComandaVinos.php';


class Neg_Calificar{

    public $errores;
    public $IdTipo;
    public $objProducto;
            
    function __construct() {
        $this->errores = array();
        
        
    }
    
    function main(){
        
        if(isset($_POST['txtIdTipo'])){
            $this->IdTipo = $_POST['txtIdTipo'];
        }
        else{
            array_push($this->errores, "No se seleccionó tipo");
        }
        //echo $_POST['txtValorEstrellas'];
        //echo $_POST[''];
        switch ($this->IdTipo){
            
            //Alimentos
            case 1: 
                $this->objProducto = new ComandaPlatillos();
                $this->objProducto->ID = $_POST['txtID'];
                $this->objProducto->ValorEstrellas = $_POST['txtValorEstrellas'];
                $this->objProducto->CalificarPorID($this->objProducto->ID,  $this->objProducto->ValorEstrellas);
                $this->objProducto->ConsultarPorID($this->objProducto->ID);
                setSuccessMessage("Gracias por calificar nuestro producto!");
                header("Location: ../F_C_Comanda_A_Detalle_Comensal.php?idComanda=".$this->objProducto->IdComanda);
                break;
            //Bebidas
            case 2:
                $this->objProducto = new ComandaVinos();
                $this->objProducto->ID = $_POST['txtID'];
                $this->objProducto->ValorEstrellas = $_POST['txtValorEstrellas'];
                $this->objProducto->CalificarPorID($this->objProducto->ID,  $this->objProducto->ValorEstrellas);
                $this->objProducto->ConsultarPorID($this->objProducto->ID);
                setSuccessMessage("Gracias por calificar nuestro producto!");
                header("Location: ../F_C_Comanda_A_Detalle_Comensal.php?idComanda=".$this->objProducto->IdComanda);
                break;
        }
    }
}

$objNeg_Calificar = new Neg_Calificar();
$objNeg_Calificar->main();

?>