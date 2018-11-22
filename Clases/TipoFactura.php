<?php

include_once  'SQL_DML.php';

class TipoFactura {
    
    public $ID;
    public $Nombre;
    public $Descripcion;
    private $Conexion;
    
    public function ObtenerTodo()
    {
        $this->Conexion = Conexion();
        $query = "SELECT * FROM TiposFactura";
        $valor = sqlsrv_query($this->Conexion, $query);
        $Tipos = array();
        
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $objTipoFactura = new TipoFactura();
            $objTipoFactura->ID = utf8_encode($Datos['ID']);
            $objTipoFactura->Nombre = utf8_encode($Datos['Nombre']);
            $objTipoFactura->Descripcion = utf8_encode($Datos['Descripcion']);
            array_push($Tipos, $objTipoFactura);
        }
        sqlsrv_close($this->Conexion);
        return $Tipos;
    }
    
    public function ObtenerPorId($ID)
    {
        $this->Conexion = Conexion();
        $this->ID = $ID;
        $query = "SELECT * FROM TiposFactura WHERE ID = $this->ID";
        $valor = sqlsrv_query($this->Conexion, $query);
        
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $this->ID = utf8_encode($Datos['ID']);
            $this->Nombre = utf8_encode($Datos['Nombre']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            
        }
        sqlsrv_close($this->Conexion);
    }
}
