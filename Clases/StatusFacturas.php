<?php

include_once 'SQL_DML.php';

class StatusFacturas {
    
    public $ID;
    public $Nombre;
    public $Descripcion;
    private $Conexion;
    
    public function ObtenerTodo()
    {
        $this->Conexion = Conexion();
        $query = "SELECT * FROM StatusFacturas";
        $Status = array();
        
        $valor = sqlsrv_query($query);
        
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $objStatus = new StatusFacturas();
            $objStatus->ID = utf8_encode($Datos['ID']);
            $objStatus->Nombre = utf8_encode($Datos['Nombre']);
            $objStatus->Descripcion = utf8_encode($Datos['Descripcion']);
            array_push($Status, $objStatus);
        }
        sqlsrv_close($this->Conexion);
        return $Status;
    }
    
    public function ObtenerPorId($ID)
    {
        $this->ID = $ID;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM StatusFacturas WHERE ID = '$this->ID'";
        
        $valor = sqlsrv_query($this->Conexion,$query);
        
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $this->ID = utf8_encode($Datos['ID']);
            $this->Nombre = utf8_encode($Datos['Nombre']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
        }
        sqlsrv_close($this->Conexion);
    }
}
