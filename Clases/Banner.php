<?php
include_once  'SQL_DML.php';

class Banner{
    public $ID;
    public $Visible;

    public function Consultar(){
        $con = Conexion();
        $query = "select * from Banner";
        $publicidad = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objBanner = new Banner();
            $objBanner->ID = utf8_encode($Datos['ID']);
            $objBanner->Visible =  utf8_encode($Datos['Visible']);
            array_push($publicidad, $objBanner);
        }
        return $publicidad;
    }    

    /**
     * 
     * @param int $ID Id del registro de publicidad
     * @param int $Visible 1 - Muestra la imagen en el banner, 0 la oculta
     */
    public function Mostrar_OcultarPublicidad($Visible) {
        $this->Visible = $Visible;
        $objSQL = new SQL_DML();
        $query = "update Banner set Visible = $this->Visible";
        $objSQL->Execute($query);
        
    }
    
    
}

?>