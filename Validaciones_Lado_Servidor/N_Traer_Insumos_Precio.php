<?php 

include_once '../Clases/Insumo.php';
include_once '../Clases/DetalleEntrada.php';

class N_Traer_Insumos_Precio
{
    public $Id_insumo;

    
    public function __construct() {
        $this->main();
    }
    
    public function main() {
        $this->Id_insumo = $_POST['id_insumo'];
        if($this->Id_insumo!='0'){
            $objInsumo = new Insumo();
            $objInsumo->ConsultarPorID($this->Id_insumo);
            
            $objEntradaDetalle= new DetalleEntrada();
            $Costo = $objEntradaDetalle->TraerUltimoPrecioPEPS($this->Id_insumo);
            

            echo $objInsumo->Descripcion . ": ". $objInsumo->Presentacion."├". $Costo;
        }else{
            echo "";
        }
    }
}

$objInsumos = new N_Traer_Insumos_Precio();

