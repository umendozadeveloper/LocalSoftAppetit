<?php

include_once 'SQL_DML.php';

class VentasFacturadas {
    
    public $ID;
    public $IdFactura;
    public $IdVenta;
    private $Conexion;
    
    public function RegistrarVentaFacturada($IdVenta,$IdFactura)
    {
        $this->IdVenta = $IdVenta;
        $this->IdFactura = $IdFactura;
        $objSQL = new SQL_DML();
        $query = "INSERT INTO VentasFacturadas (IdFactura,IdVenta) "
                . " VALUES "
                . "("
                . "'$this->IdFactura'
                    ,'$this->IdVenta')";
        if($objSQL->Execute($query))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function ObtenerPorId($ID)
    {
        $this->ID = $ID;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM VentasFacturadas WHERE ID = '$this->ID'";
        
        $valor = sqlsrv_query($this->Conexion, $query);
        while ($Datos = sqlsrv_fetch_array($valor))
        {
            $this->ID = utf8_encode($Datos['ID']);
            $this->IdFactura = utf8_encode($Datos['IdFactura']);
            $this->IdVenta = utf8_encode($Datos['IdVenta']);
        }
        sqlsrv_close($this->Conexion);
    }
    
    public function ObtenerPorVenta($IdVenta)
    {
        $this->IdVenta = $IdVenta;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM VentasFacturadas WHERE IdVenta = '$this->IdVenta'";
        $Bandera = false;
        
        $valor = sqlsrv_query($this->Conexion, $query);
        while ($Datos = sqlsrv_fetch_array($valor))
        {
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->IdFactura = utf8_encode($Datos['IdFactura']);
            $this->IdVenta = utf8_encode($Datos['IdVenta']);
           
            $Bandera = true;
        }
        sqlsrv_close($this->Conexion);
        return $Bandera;
    }
    
    public function ObtenerPorFactura($IdFactura)
    {
        $this->IdFactura = $IdFactura;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM VentasFacturadas WHERE IdFactura = '$this->IdFactura'";
        $Ventas = array();
        
        $valor = sqlsrv_query($this->Conexion, $query);
        while ($Datos = sqlsrv_fetch_array($valor))
        {
            $objVentas = new VentasFacturadas();
            $objVentas->ID = utf8_encode($Datos['ID']);
            $objVentas->IdFactura = utf8_encode($Datos['IdFactura']);
            $objVentas->IdVenta = utf8_encode($Datos['IdVenta']);
            array_push($Ventas, $objVentas);
        }
        sqlsrv_close($this->Conexion);
        return $Ventas;
    }
    
     public function Eliminar($IdFactura)
    {
        $this->IdFactura = $IdFactura;
        
        $objSQL = new SQL_DML();
        $query = "DELETE FROM VentasFacturadas WHERE IdFactura = $this->IdFactura";
        
        if($objSQL->Execute($query))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
