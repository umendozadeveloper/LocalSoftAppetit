<?php  

include_once '../../Clases/ProductoCompuesto.php';


class InsertarProductoCompuesto {

    public function __construct() {
        $this->main();
    }

    public function main() {
        
        $IdTipoProducto = '';
        if(isset($_POST['IdTipoProducto'])){
            $IdTipoProducto = $_POST['IdTipoProducto'];
        }       
       
        if(isset($_POST['IdProducto'])){
            $IdProducto = $_POST['IdProducto'];
        }
        
        if(isset($_POST['IdSubProducto'])){
            $IdSubProducto = $_POST['IdSubProducto'];
        }
        if(isset($_POST['IdTipoSubProducto'])){
            $IdTipoSubProducto = $_POST['IdTipoSubProducto'];
        }
        if(isset($_POST['Cantidad'])){
            $Cantidad = $_POST['Cantidad'];
        }
        
        $ProductoCompuesto = new ProductoCompuesto();
        if($ProductoCompuesto->Insertar($IdProducto, $IdTipoProducto, $IdSubProducto, $IdTipoSubProducto, $Cantidad)){
            echo "true";
        }
        else{
            echo "false";
        }
    }
}

$response = new InsertarProductoCompuesto();


