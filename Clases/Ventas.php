<?php

include_once 'SQL_DML.php';

class Ventas {

    public $ID;
    public $IdComanda;
    public $Fecha;
    public $IdUsuario;
    public $IdMetodoPago;
    private $Conexion;
    
    public $Facturada;
    public $Status;
    public $Propina;
    public $Descuento;

    public function ObtenerPorComanda($IdComanda) {
        $this->IdComanda = $IdComanda;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM Ventas WHERE IdComanda = '$this->IdComanda'";

        $valor = sqlsrv_query($this->Conexion, $query);
        while ($Datos = sqlsrv_fetch_array($valor)) {
            $this->ID = utf8_encode($Datos['ID']);
            $this->Fecha = ($Datos['Fecha']);
            $this->IdUsuario = utf8_encode($Datos['IdUsuario']);
            $this->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
            $this->Propina = $Datos['Propina'];
            $this->Descuento = $Datos['Descuento'];
        }
        sqlsrv_close($this->Conexion);
        return $this;
    }
    
    public function VentaFacturada($Id)
    {
        $this->ID = $Id;
        $objSQL = new SQL_DML();
        $query = "UPDATE Ventas set Facturada = 1 WHERE ID = $this->ID";
        
        $objSQL->Execute($query);
    }
    
    public function VentaNoFacturada($Id)
    {
        $this->ID = $Id;
        $objSQL = new SQL_DML();
        $query = "UPDATE Ventas set Facturada = 0 WHERE ID = $this->ID";
        
        $objSQL->Execute($query);
    }

    public function RegistarVenta($IdComanda, $IdUsuario, $IdMetodoPago, $propina, $descuento) {

        $objSQL = new SQL_DML();
        $query = "SELECT MAX(ID) as ID from Ventas";
        $this->ID = $objSQL->GetScalar($query);
        $this->IdComanda = $IdComanda;
        $this->IdUsuario = $IdUsuario;
        $this->IdMetodoPago = $IdMetodoPago;
        $this->Descuento = $descuento;
        $this->Propina = $propina;
        
        if( is_null($IdUsuario))
        {
            $query = "INSERT INTO VENTAS "
                . "(ID"
                . ",IdComanda"
                . ",Fecha"
                . ",IdUsuario"
                . ",IdMetodoPago"
                . ",Facturada"
                . ",Status, Propina, Descuento)"
                . "VALUES"
                . "('$this->ID'"
                . ",'$this->IdComanda'"
                . ",GETDATE()"
                . ",NULL"
                . ",'$this->IdMetodoPago'"
                . ",0"
                . ",'Correcto', $this->Propina, $this->Descuento)"
                . "";
        }
        else{
            $query = "INSERT INTO VENTAS "
                . "(ID"
                . ",IdComanda"
                . ",Fecha"
                . ",IdUsuario"
                . ",IdMetodoPago"
                . ",Facturada"
                . ",Status, Propina, Descuento)"
                . "VALUES"
                . "('$this->ID'"
                . ",'$this->IdComanda'"
                . ",GETDATE()"
                . ",'$this->IdUsuario'"
                . ",'$this->IdMetodoPago'"
                . ",0"
                . ",'Correcto', $this->Propina, $this->Descuento)"
                . "";
        }
        
//        echo $query;
        if ($objSQL->Execute($query)) {
            return true;
        } else
        {
            return FALSE;
        }
        
    }

    public function ObtenerTodosNoFacturadosPorFactura($IdFactura)
    {
        $con = Conexion();
        $query = "Select * from Ventas where Facturada = 0 and Ventas.Status='Correcto' union
select Ventas.* from Ventas join VentasFacturadas
on VentasFacturadas.IdVenta = Ventas.ID
 where Status='Correcto' and VentasFacturadas.IdFactura = $IdFactura";

        $ventas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objVentas = new Ventas();
                $objVentas->ID = utf8_encode($Datos['ID']);
                $objVentas->IdComanda = utf8_encode($Datos['IdComanda']);
                $objVentas->Fecha = $Datos['Fecha'];
                $objVentas->IdUsuario=utf8_encode($Datos['IdUsuario']);
                $objVentas->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
                $objVentas->Descuento = $Datos['Descuento'];
                $objVentas->Propina = $Datos['Propina'];
                array_push($ventas, $objVentas);
            }
            sqlsrv_close($con);
            return $ventas;
    }
    
    public function ObtenerPorFactura($IdFactura)
    {
        $con = Conexion();
        $query = "select Ventas.* from Ventas join VentasFacturadas
                on VentasFacturadas.IdVenta = Ventas.ID
                where Status='Correcto' and VentasFacturadas.IdFactura = $IdFactura";

        $ventas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objVentas = new Ventas();
                $objVentas->ID = utf8_encode($Datos['ID']);
                $objVentas->IdComanda = utf8_encode($Datos['IdComanda']);
                $objVentas->Fecha = $Datos['Fecha'];
                $objVentas->IdUsuario=utf8_encode($Datos['IdUsuario']);
                $objVentas->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
                $objVentas->Descuento = $Datos['Descuento'];
                $objVentas->Propina = $Datos['Propina'];
                array_push($ventas, $objVentas);
            }
            sqlsrv_close($con);
            return $ventas;
    }
    
    public function ObtenerTodosNoFacturados()
    {
        $con = Conexion();
        $query = "Select * from Ventas where Facturada = 0 and Status='Correcto'";

        $ventas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objVentas = new Ventas();
                $objVentas->ID = utf8_encode($Datos['ID']);
                $objVentas->IdComanda = utf8_encode($Datos['IdComanda']);
                $objVentas->Fecha = $Datos['Fecha'];
                $objVentas->IdUsuario=utf8_encode($Datos['IdUsuario']);
                $objVentas->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
                $objVentas->Descuento = $Datos['Descuento'];
                $objVentas->Propina = $Datos['Propina'];
                array_push($ventas, $objVentas);
            }
            sqlsrv_close($con);
            return $ventas;
    }
    
    public function ObtenerNoFacturados($filtro)
    {
        $con = Conexion();
        $query = "Select * from Ventas where Facturada = 0 and Status='Correcto'"
                . " and $filtro";
        $ventas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objVentas = new Ventas();
                $objVentas->ID = utf8_encode($Datos['ID']);
                $objVentas->IdComanda = utf8_encode($Datos['IdComanda']);
                $objVentas->Fecha = $Datos['Fecha'];
                //$objVentas->IdFormaPago = utf8_encode($Datos['IdFormaPago']);
                $objVentas->IdUsuario=utf8_encode($Datos['IdUsuario']);
                $objVentas->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
                //$objVentas->NumeroCuenta = utf8_encode($Datos['NumeroCuenta']);
                array_push($ventas, $objVentas);
            }
            sqlsrv_close($con);
            return $ventas;
    }
    public function ObtenerTotalPorCadaVenta(){
        $this->Conexion = Conexion();
        #Obtener comandas para después sumar el total de cada una.
        $query = "select ID from Ventas";
        $valor = sqlsrv_query($this->Conexion, $query);
        $ventas= array();
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $objVenta = new Ventas();
            $objVenta->ID = $Datos['ID'];
            array_push($ventas, $objVenta);
        }
       
        $contador = 0;
        $probando="";
        $array_totales = array();
        
        foreach ($ventas as $sales)
        {
             $query = "select Sum(Total) as total from DetalleVenta where IdVenta='". $sales->ID."'";
             $valor = sqlsrv_query($this->Conexion, $query);
             $totales= array();
             while($Datos = sqlsrv_fetch_array($valor))
             {
                            //$sales->ID
                $array_totales[$contador]= $Datos['total'];
                $contador++;
             }
            
            
        }
       
        sqlsrv_close($this->Conexion);
        return $array_totales;
    }
    
    public function ObtenerPorId($Id) {
        $this->ID = $Id;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM Ventas WHERE ID = '$this->ID'";

        $valor = sqlsrv_query($this->Conexion, $query);
        while ($Datos = sqlsrv_fetch_array($valor)) {
            $this->IdComanda = utf8_encode($Datos['IdComanda']);
            $this->Fecha = ($Datos['Fecha']);
            $this->IdUsuario = utf8_encode($Datos['IdUsuario']);
            $this->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
            $this->Facturada = utf8_encode($Datos['Facturada']);
            $this->Status = utf8_encode($Datos['Status']);
            $this->Propina = $Datos['Propina'];
            $this->Descuento = $Datos['Descuento'];
        }
        sqlsrv_close($this->Conexion);
        return $this;
    }
   
    public function CancelarVenta($Id)
    {
        $con = Conexion();
        $this->ID = $Id;
        $objSQL = new SQL_DML();
        $query = "UPDATE Ventas SET Status='Cancelado' where ID='$this->ID'";
        return $objSQL->Execute($query);
    }
    
    public function MarcarComoFacturada($array_folio_comandas){
       $contador=0;
       #Obtine los id de venta que van a ser modificados
       $query = "Select V.ID from Ventas V join Comanda C on V.IdComanda = C.Id";
        while ($contador < count($array_folio_comandas) )
        {
            if($contador == 0)
            {
                $query .= " where IdComanda='".$array_folio_comandas[$contador]."'";
            }
            else{
                $query .= " or IdComanda='".$array_folio_comandas[$contador]."'";
            }
            $contador++;
        }
        $this->Conexion = Conexion();
        
        $valor = sqlsrv_query($this->Conexion, $query);
        $contador=0;
        $array_ventas = array();
        while ($Datos = sqlsrv_fetch_array($valor)) {
           $array_ventas[$contador] = $Datos['ID'];
            $contador++;
        }
        sqlsrv_close($this->Conexion);
        
        $contador=0;
        while($contador < count($array_ventas))
        {
            $query = "Update Ventas set Facturada=1 where ID='".$array_ventas[$contador]."'";
            $objSQL = new SQL_DML();
            $objSQL->Execute($query);
                
            $contador++;
        }
       
        
    }
    
    
    
//◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘ 
    public function ObtenerDescuentosParaFacturaGlobal($array_ventas){
        $this->Conexion = Conexion();
        $contador=0;
        $query = "Select ID, Descuento, IdMetodoPago from Ventas";
        for($contador=0; $contador < count($array_ventas); $contador++)
        {
            if($contador==0){
                $query .= " where ID='".$array_ventas[$contador]."' ";
            }
            else {
                $query.= "or ID='".$array_ventas[$contador]."' "; 
            }
        }
        $valor = sqlsrv_query($this->Conexion,$query);
        $array_descuentos = array();
        while($Datos = sqlsrv_fetch_array($valor)){
            $objVenta = new Ventas();
            $objVenta->ID = $Datos['ID'];
            $objVenta->Descuento = $Datos['Descuento'];
            $objVenta->IdMetodoPago = $Datos['IdMetodoPago'];
            array_push($array_descuentos, $objVenta);
        }
        sqlsrv_close($this->Conexion);
        return $array_descuentos;
    }
    
    
    public function ObtenerVentasParaFacturaGlobal($fechaInicio, $fechaFin){
        $this->Conexion = Conexion();
        #Obtener comandas para después sumar el total de cada una.
        $query = "Select ID,Descuento,IdMetodoPago From Ventas where Facturada='0' and Status='Correcto' and Fecha>='$fechaInicio' and"
                . " Fecha <'$fechaFin' order by ID desc";
        $valor = sqlsrv_query($this->Conexion, $query);
        $id_ventas= array();
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $objVenta = new Ventas();
            $objVenta->ID = $Datos['ID'];
            $objVenta->Descuento = $Datos['Descuento'];
            $objVenta->IdMetodoPago = $Datos['IdMetodoPago'];
            array_push($id_ventas, $objVenta);
        }
        sqlsrv_close($this->Conexion);
        return $id_ventas; 
    }
    
    
    
    public function ObtenerIvaSubtotalParaFacturaGlobal($id_ventas){
       $this->Conexion = Conexion();
        $contador = 0;
        $probando="";
        $array_totales = array();
        $array_temporal= array();
        
        foreach ($id_ventas as $sales)
        {
            $tempo= $sales->ID;
            $tempo3= $sales;
             $query = "Select SUM(D.SubTotal) as subtotal, SUM (D.Total) as total,"
                     . " SUM(D.Total)- SUM(D.SubTotal) as importeIva"
                     . " from Ventas V join DetalleVenta D on V.ID = D.IdVenta where IdVenta='". $sales->ID."'";
             $valor = sqlsrv_query($this->Conexion, $query);
             $totales= array();
             while($Datos = sqlsrv_fetch_array($valor))
             {
                            //$sales->ID
                $array_temporal = array("subtotal" => $Datos['subtotal'], "total" => $Datos['total'], 
                    'importeIva' => $Datos['importeIva']);
                array_push($array_totales, $array_temporal);
             }
            
            
        }
       
        sqlsrv_close($this->Conexion);
        return $array_totales; 
    }
    
    public function CambiarStatusFacturadosCancelado($array_id_ventas){
        $this->Conexion = Conexion();
        $query = "Update Ventas set Facturada=0 ";
        $contador=0;
        foreach ($array_id_ventas as $ventas)
        {
            if($contador==0)
            {
                $query .= "where ID='".$ventas->IdVenta."' "; 
            }else{
                $query .= " or ID='".$ventas->IdVenta."' "; 
            }
            $contador++;
        }
        $objSQL = new SQL_DML();
              
        if($objSQL->Execute($query))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
        sqlsrv_close($this->Conexion);
    }
}
