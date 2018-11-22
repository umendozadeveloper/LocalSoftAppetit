<?php

include_once  'SQL_DML.php';
include_once 'Entrada.php';
include_once 'Kardex.php';
include_once 'DetalleEntrada.php';

class SalidaVenta {
    
    public $ID;
    public $IdSalida;
    public $IdCliente;
    public $IdUsuario;
    
    public function Insertar($id_salida, $id_cliente, $id_usuario) {
        
        $this->IdSalida = $id_salida;
        $this->IdCliente = $id_cliente;
        $this->IdUsuario = $id_usuario;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from SalidasVentas");
        $this->ID = $resultado;
        
        $query = "insert into SalidasVentas ".
        "(ID,IdSalida,IdCliente,IdUsuario) ".
         "values ('".$this->ID."','".$this->IdSalida."','".$this->IdCliente."','".$this->IdUsuario."')";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
    }
    

    public function Eliminar($id_salida)
    {
        $this->IdSalida = $id_salida;
               
        $query = "Delete From SalidasVentas where IdSalida ='$this->IdSalida'";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
    }

    public function ConsultarSalidas_SalidasVentas_Cliente_Encargado()
    {
        $con = Conexion();
        $query = "Select S.ID as IdSalida,S.Fecha,CF.NombreCliente,U.Nombre,U.Apellidos from Salidas S join SalidasVentas SV on S.ID=SV.IdSalida
          join ClientesFacturas CF on CF.ID=SV.IdCliente
          join Usuarios U on SV.IdUsuario=U.Id";
        
        $temporal_ventas = array();
        $salidasVentas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $temporal_ventas = array(
                "IdSalida" => $Datos['IdSalida'],
                "Fecha" => date_format($Datos['Fecha'],'d/m/Y'),
                "NombreCliente" => utf8_encode($Datos['NombreCliente']),
                "Nombre" => utf8_encode($Datos['Nombre']),
                "Apellidos" => utf8_encode($Datos['Apellidos']),
                
            );
            array_push($salidasVentas, $temporal_ventas);
            
        }
            sqlsrv_close($con);
            return $salidasVentas;
    }

    public function ConsultarSalidas_SalidasVentas_Cliente_EncargadoPorID($id_salida)
    {
        $con = Conexion();
        $query = "Select S.ID as IdSalida,S.Fecha,CF.NombreCliente,U.Nombre,U.Apellidos from Salidas S join SalidasVentas SV on S.ID=SV.IdSalida
          join ClientesFacturas CF on CF.ID=SV.IdCliente
          join Usuarios U on SV.IdUsuario=U.Id where S.ID=$id_salida ";
        
       
        $salidasVentas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $salidasVentas = array(
                "IdSalida" => $Datos['IdSalida'],
                "Fecha" => date_format($Datos['Fecha'],'d/m/Y'),
                "NombreCliente" => utf8_encode($Datos['NombreCliente']),
                "Nombre" => utf8_encode($Datos['Nombre']),
                "Apellidos" => utf8_encode($Datos['Apellidos']),
                
            );
//            array_push($salidasVentas, $temporal_ventas);
            
        }
            sqlsrv_close($con);
            return $salidasVentas;
    }
    
}//clase
