<?php 

require '../Clases/ClientesFacturas.php';
class N_CargarClienteSalida
{
    public $Id_cliente;
//    public $Observaciones;
//    public $Cantidad;
//    public $ConceptoES;
//    public $Total;
//    public $Costo_unitario;
//    public $Insumos_agregados;
    
    public function __construct() {
        $this->main();
    }
    
    public function main() {
        $this->Id_cliente = $_POST['id_cliente'];
        $objCliente = new ClientesFacturas();
        $objCliente->obtenerPorID($this->Id_cliente);
        
        echo $objCliente->NombreCliente;
    }
}

$objInsumos = new N_CargarClienteSalida();
