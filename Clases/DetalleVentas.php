<?php

include_once  'SQL_DML.php';

class DetalleVentas {
    
    public $ID;
    public $IdVenta;
    public $IdVino;
    public $IdPlatillo;
    public $Descripcion;
    public $Cantidad;
    public $PrecioCarta;
    public $PrecioSinIva;
    public $IVA;
    public $SubTotal;
    public $Total;
    private $Conexion;
    
    public function ObtenerPorIdVenta($IdVenta)
    {
        $this->IdVenta = $IdVenta;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM DetalleVenta WHERE IdVenta = '$this->IdVenta'";
        $valor = sqlsrv_query($this->Conexion,$query);
        $Detalles = array();
        while ($Datos = sqlsrv_fetch_array($valor))
        {
            $objDetalle = new DetalleVentas();
            $objDetalle->ID = utf8_encode($Datos['ID']);
            $objDetalle->IdVino = utf8_encode($Datos['IdVino']);
            $objDetalle->IdPlatillo = utf8_encode($Datos['IdPlatillo']);
            $objDetalle->Descripcion = utf8_encode($Datos['DescripcionProducto']);
            $objDetalle->Cantidad = utf8_encode($Datos['Cantidad']);
            $objDetalle->PrecioCarta = utf8_encode($Datos['PrecioCarta']);
            $objDetalle->PrecioSinIva = utf8_encode($Datos['PrecioSinIva']);
            $objDetalle->IVA = utf8_encode($Datos['IVA']);
            $objDetalle->SubTotal = utf8_encode($Datos['SubTotal']);
            $objDetalle->Total = utf8_encode($Datos['Total']);
            array_push($Detalles, $objDetalle);
        }
        sqlsrv_close($this->Conexion); 
        return $Detalles;
    }
    
    public function RegistrarDetalleVentas($IdVenta,$IdVino, $IdPlatillo, $Descripcion,
            $Cantidad, $PrecioCarta, $PrecioSinIva, $IVA, $SubTotal, $Total)
    {
        $this->IdVenta = $IdVenta;
        $this->IdVino = $IdVino;
        $this->IdPlatillo = $IdPlatillo;
        $this->Descripcion = $Descripcion;
        $this->Cantidad = $Cantidad;
        $this->PrecioCarta = $PrecioCarta;
        $this->PrecioSinIva = $PrecioSinIva;
        $this->IVA = $IVA;
        $this->SubTotal = $SubTotal;
        $this->Total = $Total;
        
        $objSQL = new SQL_DML();
        $this->ID = $objSQL->GetScalar("select MAX (ID) as ID from DetalleVenta");
        
        $query =" INSERT INTO DetalleVenta "
                . "(ID"
                . ",IdVenta"
                . ",IdVino"
                . ",IdPlatillo"
                . ",DescripcionProducto"
                . ",Cantidad"
                . ",PrecioCarta"
                . ",PrecioSinIva"
                . ",IVA"
                . ",SubTotal"
                . ",Total) "
                . " values"
                . "('$this->ID'"
                . ",'$this->IdVenta'"
                . ",'$this->IdVino'"
                . ",'$this->IdPlatillo'"
                . ",'$this->Descripcion'"
                . ",'$this->Cantidad'"
                . ",'$this->PrecioCarta'"
                . ",'$this->PrecioSinIva'"
                . ",'$this->IVA'"
                . ",'$this->SubTotal'"
                . ",'$this->Total')";
        
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
