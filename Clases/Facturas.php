<?php

include_once 'SQL_DML.php';

class Facturas {

    public $ID;
    public $Folio;
    public $Fecha;
    public $IdUsuario;
    public $IdCliente;
    public $IdMetodoPago;
    public $IdStatus;
    public $RutaCodigoQR;
    public $RutaXML;
    public $RutaPDF;
    public $UUID;
    public $IdTipoFactura;
    private $Conexion;

    public function ObtenerTodas() {
        $this->Conexion = Conexion();
        $Facturas = array();
        $query = "SELECT * FROM Facturas";
        $valor = sqlsrv_query($this->Conexion, $query);

        while ($Datos = sqlsrv_fetch_array($valor)) {
            $objFacturas = new Facturas();
            $objFacturas->ID = utf8_encode($Datos['ID']);
            $objFacturas->Folio = utf8_encode($Datos['Folio']);
            $objFacturas->Fecha = $Datos['Fecha'];
            $objFacturas->IdUsuario = utf8_encode($Datos['IdUsuario']);
            $objFacturas->IdCliente = utf8_encode($Datos['IdCliente']);
            $objFacturas->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
            $objFacturas->IdStatus = utf8_encode($Datos['IdStatus']);
            $objFacturas->RutaCodigoQR = utf8_encode($Datos['RutaCodigoQR']);
            $objFacturas->RutaXML = utf8_encode($Datos['RutaXML']);
            $objFacturas->RutaPDF = utf8_encode($Datos['RutaPDF']);
            $objFacturas->UUID = utf8_encode($Datos['UUID']);
            $objFacturas->IdTipoFactura = utf8_encode($Datos['IdTipoFactura']);
            array_push($Facturas, $objFacturas);
        }
        sqlsrv_close($this->Conexion);
        return $Facturas;
    }
    
    public function Eliminar($IdFactura)
    {
        $this->ID = $IdFactura;
        $objSQL = new SQL_DML();
        $query = "delete from Facturas WHERE ID = $this->ID";
        
        $objSQL->Execute($query);
    }

    public function ObtenerPorId($ID) {
        $this->ID = $ID;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM Facturas WHERE ID = '$this->ID'";
        $Bandera = false;

        $valor = sqlsrv_query($this->Conexion, $query);

        while ($Datos = sqlsrv_fetch_array($valor)) {
            $this->ID = utf8_encode($Datos['ID']);
            $this->Folio = utf8_encode($Datos['Folio']);
            $this->Fecha = $Datos['Fecha'];
            $this->IdUsuario = utf8_encode($Datos['IdUsuario']);
            $this->IdCliente = utf8_encode($Datos['IdCliente']);
            $this->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
            $this->IdStatus = utf8_encode($Datos['IdStatus']);
            $this->RutaCodigoQR = utf8_encode($Datos['RutaCodigoQR']);
            $this->RutaXML = utf8_encode($Datos['RutaXML']);
            $this->RutaPDF = utf8_encode($Datos['RutaPDF']);
            $this->UUID = utf8_encode($Datos['UUID']);
            $this->IdTipoFactura = utf8_encode($Datos['IdTipoFactura']);
            $Bandera = true;
        }
        sqlsrv_close($this->Conexion);
        return $Bandera;
    }

    public function ObtenerPorFecha($Fecha) {
        $this->Fecha = $Fecha;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM Facturas WHERE Fecha = '$this->Fecha'";

        $valor = sqlsrv_query($this->Conexion, $query);

        while ($Datos = sqlsrv_fetch_array($valor)) {
            $this->ID = utf8_encode($Datos['ID']);
            $this->Folio = utf8_encode($Datos['Folio']);
            $this->Fecha = $Datos['Fecha'];
            $this->IdUsuario = utf8_encode($Datos['IdUsuario']);
            $this->IdCliente = utf8_encode($Datos['IdCliente']);
            $this->IdMetodoPago = utf8_encode($Datos['IdMetodoPago']);
            $this->IdStatus = utf8_encode($Datos['IdStatus']);
            $this->RutaCodigoQR = utf8_encode($Datos['RutaCodigoQR']);
            $this->RutaXML = utf8_encode($Datos['RutaXML']);
            $this->RutaPDF = utf8_encode($Datos['RutaPDF']);
            $this->UUID = utf8_encode($Datos['UUID']);
            $this->IdTipoFactura = utf8_encode($Datos['IdTipoFactura']);
        }
        sqlsrv_close($this->Conexion);
    }

    public function Agregar($Folio, $IdUsuario, $IdCliente, $IdMetodoPago, $IdStatus, $RutaCodigoQR, $RutaXML, $RutaPDF, $UUID, $IdTipoFactura) {
        $this->Folio = $Folio;
        $this->IdUsuario = $IdUsuario;
        $this->IdCliente = $IdCliente;
        $this->IdMetodoPago = $IdMetodoPago;
        $this->IdStatus = $IdStatus;
        $this->RutaCodigoQR = $RutaCodigoQR;
        $this->RutaXML = $RutaXML;
        $this->RutaPDF = $RutaPDF;
        $this->UUID = $UUID;
        $this->IdTipoFactura = $IdTipoFactura;
        
        $objSQL = new SQL_DML();
        
        $query = "INSERT INTO Facturas
           ([Folio]
           ,[Fecha]
           ,[IdUsuario]
           ,[IdCliente]
           ,[IdMetodoPago]
           ,[IdStatus]
           ,[RutaCodigoQR]
           ,[RutaXML]
           ,[RutaPDF]
           ,[UUID]
           ,[IdTipoFactura])
            VALUES
            (
            $this->Folio
           ,GETDATE()
           ,$this->IdUsuario
           ,$this->IdCliente
           ,'$this->IdMetodoPago'
           ,$this->IdStatus
           ,'$this->RutaCodigoQR'
           ,'$this->RutaXML'
           ,'$this->RutaPDF'
           ,'$this->UUID'
           ,$this->IdTipoFactura    
            )";
        echo $query;
        
        if($objSQL->Execute($query))
        {
            $this->ID = $objSQL->GetScalar("SELECT MAX(ID) as ID FROM Facturas WHERE Folio = $this->Folio");
            $this->ID = $this->ID - 1;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function Editar($ID,$Folio, $IdUsuario, $IdCliente, $IdMetodoPago, $IdStatus, $RutaCodigoQR, $RutaXML, $RutaPDF, $UUID, $IdTipoFactura) {
        $this->ID = $ID;
        $this->Folio = $Folio;
        $this->IdUsuario = $IdUsuario;
        $this->IdCliente = $IdCliente;
        $this->IdMetodoPago = $IdMetodoPago;
        $this->IdStatus = $IdStatus;
        $this->RutaCodigoQR = $RutaCodigoQR;
        $this->RutaXML = $RutaXML;
        $this->RutaPDF = $RutaPDF;
        $this->UUID = $UUID;
        $this->IdTipoFactura = $IdTipoFactura;
        
        $objSQL = new SQL_DML();
        
        $query = "UPDATE Facturas
                    SET Folio = '$this->Folio'
                       ,Fecha = GETDATE()
                       ,IdUsuario = '$this->IdUsuario'
                       ,IdCliente = '$this->IdCliente'
                       ,IdMetodoPago = '$this->IdMetodoPago'
                       ,IdStatus = '$this->IdStatus'
                       ,RutaCodigoQR = '$this->RutaCodigoQR'
                       ,RutaXML = '$this->RutaXML'
                       ,RutaPDF = '$this->RutaPDF'
                       ,UUID = '$this->UUID'
                       ,IdTipoFactura = '$this->IdTipoFactura'    
                  WHERE ID = '$this->ID'";
        
        if($objSQL->Execute($query))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function CambiarStatusCancelada($IdFactura){
        $this->ID = $IdFactura;
        $this->IdStatus = '3';
 
        $objSQL = new SQL_DML();
        
        $query = "Update Facturas set IdStatus='$this->IdStatus' where ID='$this->ID'";
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
