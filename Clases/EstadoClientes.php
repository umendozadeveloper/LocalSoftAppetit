<?php

class EstadoClientes {
    public $ID;
    public $Estado;
    public $Descripcion;
    
    public function ConsultarPorID($ID){
        $con = Conexion();
        $this->ID = $ID;
        $query = "select * from EstadoClientes where ID = '$this->ID'";
        $res = false;
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->ID = utf8_encode($Datos ['ID']);
            $this->Estado = utf8_encode($Datos ['Estado']);
            $this->Descripcion = utf8_encode($Datos ['Descripcion']);
            $res = true;
        }
        return $res;
    }
}
