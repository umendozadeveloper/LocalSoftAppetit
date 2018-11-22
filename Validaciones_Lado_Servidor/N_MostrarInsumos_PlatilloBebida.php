<?php 

include_once '../Clases/Insumo.php';
include_once '../Clases/UMContent.php';

class N_MostrarInsumos_PlatilloBebida
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
            
            $objUMContent = new UMContent();
            $objUMContent->ConsultarPorID($objInsumo->IdUMContent);
            
            $informacion = $objInsumo->Descripcion . "├". $objInsumo->Presentacion . "├". $objInsumo->Contenido ." ". $objUMContent->Descripcion;
            echo $informacion;
        }else{
            echo "";
        }
    }
}

$objInsumos = new N_MostrarInsumos_PlatilloBebida();
