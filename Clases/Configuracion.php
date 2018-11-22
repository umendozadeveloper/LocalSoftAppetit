<?php
include_once  'SQL_DML.php';

class Configuracion{
    public $ID;
    public $Publicidad;
    public $CalificacionPlatillos;
    public $CalificacionBebidas;
    public $ClientesVIP;
    public $SoftRestaurant;

    public function Consultar(){
        $con = Conexion();
        $query = "select * from Configuracion";
        
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->ID = utf8_encode($Datos['ID']);
            $this->Publicidad = utf8_encode($Datos['Publicidad']);
            $this->CalificacionPlatillos = utf8_encode($Datos['CalificacionPlatillos']);
            $this->CalificacionBebidas = utf8_encode($Datos['CalificacionBebidas']);
            $this->ClientesVIP = utf8_encode($Datos['ClientesVIP']);
            $this->SoftRestaurant = utf8_encode($Datos['SoftRestaurant']);
        }
        
    }    
    
    
    

    /**
     * 
     * @param int $ID Id del registro de publicidad
     * @param int $Visible 1 - Muestra la imagen en el banner, 0 la oculta
     */
    public function Mostrar_OcultarPublicidad($Visible) {
        $this->Publicidad = $Visible;
        $objSQL = new SQL_DML();
        $query = "update Configuracion set Publicidad = $this->Publicidad";
        $objSQL->Execute($query);
        
    }
    
    
    public function Modificar($Publicidad,$CalificacionPlatillos,$CalificacionBebidas,$ClientesVIP)
    {
        $this->Publicidad = $Publicidad;
        $this->CalificacionBebidas = $CalificacionBebidas;
        $this->CalificacionPlatillos = $CalificacionPlatillos;
        $this->ClientesVIP = $ClientesVIP;
        $objSQL = new SQL_DML();
        $query = "UPDATE Configuracion set Publicidad = '$this->Publicidad', CalificacionPlatillos = '$this->CalificacionPlatillos',"
                . " CalificacionBebidas = '$this->CalificacionBebidas', ClientesVIP = '$this->ClientesVIP' where ID = 1";
        //echo $query;
        return $objSQL->Execute($query);
    }
    
    
}

?>