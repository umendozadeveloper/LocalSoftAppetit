<?php

include_once 'SQL_DML.php';

class PagosFacturas {
    
    public $ID;
    public $IdFormaPago;
    public $NumeroCuenta;
    public $IdFactura;
    private $Conexion;
    
    public function ObtenerPorFactura($IdFactura)
    {
        $this->IdFactura = $IdFactura;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM PagosFacturas WHERE IdFactura = '$this->IdFactura'";
        $Pagos = array();
        
        $valor = sqlsrv_query($this->Conexion,$query);
        
        while ($Datos = sqlsrv_fetch_array($valor))
        {
            $objPagos = new PagosFacturas();
            $objPagos->ID = utf8_encode($Datos['ID']);
            $objPagos->IdFormaPago = utf8_encode($Datos['IdFormaPago']);
            $objPagos->NumeroCuenta = utf8_encode($Datos['NumeroCuenta']);
            $objPagos->IdFactura = utf8_encode($Datos['IdFactura']);
            array_push($Pagos, $objPagos);
        }
        sqlsrv_close($this->Conexion);
        return $Pagos;
    }
    
    public function Agregar($IdFormaPago, $NumeroCuenta, $IdFactura) {
        $this->IdFormaPago = $IdFormaPago;
        $this->NumeroCuenta = $NumeroCuenta;
        $this->IdFactura = $IdFactura;
        
        $objSQL = new SQL_DML();
        $query = " INSERT INTO PagosFacturas "
                . " "
                . " ("
                . "IdFormaPago"
                . ",NumeroCuenta"
                . ",IdFactura) "
                . " VALUES "
                . " ("
                . " $this->IdFormaPago"
                . ", '$this->NumeroCuenta'"
                . ", $this->IdFactura)";
        
        if($objSQL->Execute($query))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    public function Eliminar($IdFactura)
    {
        $this->IdFactura = $IdFactura;
        
        $objSQL = new SQL_DML();
        $query = "DELETE FROM PagosFacturas WHERE IdFactura = $this->IdFactura";
        
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
