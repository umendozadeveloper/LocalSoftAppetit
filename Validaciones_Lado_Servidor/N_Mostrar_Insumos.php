<?php 

include_once '../Clases/Insumo.php';

class N_Mostrar_Insumos
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

            echo $objInsumo->Descripcion . ": ". $objInsumo->Presentacion;
        }else{
            echo "";
        }
    }
}

$objInsumos = new N_Mostrar_Insumos();