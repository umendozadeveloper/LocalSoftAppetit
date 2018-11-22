<?php

include_once  'SQL_DML.php';
class DetallePago {
    
    public $ID;
    public $IdFormaPago;
    public $NumeroCuenta;
    public $IdVenta;
    private $Conexion;
    
    public function ObtenerPorVenta($IdVenta)
    {
        $this->IdVenta = $IdVenta;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM DetallePago WHERE IdVenta = '$this->IdVenta'";
        
        $valor = sqlsrv_query($this->Conexion, $query);
        $Pagos = array();
        
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $objPagos =  new DetallePago();
            $objPagos->ID = utf8_encode($Datos['ID']);
            $objPagos->IdFormaPago = utf8_encode($Datos['IdFormaPago']);
            $objPagos->NumeroCuenta = utf8_encode($Datos['NumeroCuenta']);
            $objPagos->IdVenta = utf8_encode($Datos['IdVenta']);
            array_push($Pagos, $objPagos);
        }
        sqlsrv_close($this->Conexion); 
        return $Pagos;
    }
    
    public function RegistrarPago($IdVenta, $IdFormaPago, $NumeroCuenta)
    {
        $this->IdVenta = $IdVenta;
        $this->IdFormaPago = $IdFormaPago;
        $this->NumeroCuenta = $NumeroCuenta;
        $objSQL = new SQL_DML();
        
        $query = "INSERT INTO DetallePago "
                . "("
                . "IdFormaPago"
                . ",NumeroCuenta"
                . ",IdVenta)"
                . "VALUES"
                . "("
                . "$this->IdFormaPago"
                . ",'$this->NumeroCuenta'"
                . ",$this->IdVenta)";
        echo $query;
        if ($objSQL->Execute($query)) {
            return true;
        } else
        {
            return FALSE;
        }
    }
    
    public function ObtenerTodosPagos(){

        $con = Conexion();
//        $query = "Select * from Ventas where Facturada is NULL";
        $query = "Select * from DetallePago order by IdFormaPago asc";
        $ventas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objVentas = new Ventas();
                $objVentas->ID = utf8_encode($Datos['ID']);
                $objVentas->IdComanda = utf8_encode($Datos['IdComanda']);
                $objVentas->Fecha = $Datos['Fecha'];
//                $objVentas->IdFormaPago = utf8_encode($Datos['IdFormaPago']);
                $objVentas->IdUsuario=utf8_encode($Datos['IdUsuario']);
                $objVentas->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
//                $objVentas->NumeroCuenta = utf8_encode($Datos['NumeroCuenta']);
                $objVentas->Descuento = $Datos['Descuento'];
                $objVentas->Propina = $Datos['Propina'];
                array_push($ventas, $objVentas);
            }
            sqlsrv_close($con);
            return $ventas;
        
        
    }
    
    public function ObtenerPagosParaFacturaGlobal($array_id_ventas){
        $this->Conexion = Conexion();
        $query="select IdFormaPago, NumeroCuenta from DetallePago "; 
        $contador =0;
        foreach($array_id_ventas as $id_venta)
        {
           if($contador==0)
           {
               $query .= "where IdVenta='$id_venta->ID' ";
           }else{
               $query .= "or IdVenta='$id_venta->ID' ";
           }
           $contador++;
        }
        $query .= "order by IdFormaPago asc";
        
        $valor = sqlsrv_query($this->Conexion, $query);
        $array_pagos= array();
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $objDetallePago = new DetallePago();
            $objDetallePago->IdFormaPago = $Datos['IdFormaPago'];
            $objDetallePago->NumeroCuenta = $Datos['NumeroCuenta'];
            array_push($array_pagos, $objDetallePago);
        }
        sqlsrv_close($this->Conexion);
        return $array_pagos;
    }
}
