<?php

include_once  'SQL_DML.php';

class EntradaCompras {
    
   public $ID;
   public $IdEntrada;
   public $Documento;
   public $IdProveedor;
   public $Observaciones;
   public $CostoTotal;
   public $IdEncargado;

   public function EntradaCompras(){
            
    }

    public function Insertar($id_entrada, $documento, $id_proveedor, $observaciones, $costo_total, $id_encargado){
       
        $this->IdEntrada = $id_entrada;
        $this->Documento = $documento;
        $this->IdProveedor = $id_proveedor;
        $this->Observaciones = $observaciones;
        $this->CostoTotal = $costo_total;
        $this->IdEncargado = $id_encargado;
        
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from [EntradasCompras]");
        $this->ID = $resultado;
             
        
        $query = "insert into [EntradasCompras] ".
        "(ID,IdEntrada,Documento,IdProveedor,Observaciones,CostoTotal,IdEncargado) ".
         "values ('".$this->ID."','".$this->IdEntrada."','".$this->Documento."','".$this->IdProveedor."','"
                .$this->Observaciones."','".$this->CostoTotal."','".$this->IdEncargado."')";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
   
    }
        
    public function ConsultarEntradas_Compras_Proveedor()
    {
        $con = Conexion();
        $query = "select E.ID as IdEntrada,E.Fecha,P.Nombre as Proveedor, EC.Documento,EC.Observaciones, EC.CostoTotal 
        from Entradas E join EntradasCompras EC on E.ID=EC.IdEntrada
        join Proveedores P on EC.IdProveedor= P.ID";
        
        $temporal_entradas= array();
        $entradasCompras = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $temporal_entradas = array(
                "IdEntrada" => $Datos['IdEntrada'],
                "Fecha" => date_format($Datos['Fecha'],'d/m/Y'),
                "Proveedor" => utf8_encode($Datos['Proveedor']),
                "Documento" => utf8_encode($Datos['Documento']),
                "Observaciones" => utf8_encode($Datos['Observaciones']),
                "CostoTotal" => number_format($Datos['CostoTotal'],2,'.',''),
            );
           
            array_push($entradasCompras, $temporal_entradas);
            }
            sqlsrv_close($con);
            return $entradasCompras;
    }
        
    
    public function ConsultarEntradas_Compras_ProveedorPorID($id_entrada)
    {
        $con = Conexion();
        $query = "select E.ID as IdEntrada, E.Fecha, P.Nombre as Proveedor, EA.documento, EA.Observaciones, EA.CostoTotal, U.Nombre as Usuario, U.Apellidos
		from Entradas E join EntradasAjustes EA on E.ID=EA.IdEntrada
		join Proveedores P on EA.IdProveedor=P.ID
		join Usuarios U on EA.IdEncargado= U.Id
		where E.ID=$id_entrada";
        
        
        $entradasCompras = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $entradasCompras = array(
                "IdEntrada" => $Datos['IdEntrada'],
                "Fecha" => date_format($Datos['Fecha'],'d/m/Y'),
                "Proveedor" => utf8_encode($Datos['Proveedor']),
                "Documento" => utf8_encode($Datos['Documento']),
                "Observaciones" => utf8_encode($Datos['Observaciones']),
                "CostoTotal" => number_format($Datos['CostoTotal'],2,'.',''),
                "Usuario" => utf8_encode($Datos['Usuario']),
                "Apellidos" => utf8_encode($Datos['Apellidos']),
            );
           
            
        }
        sqlsrv_close($con);
        return $entradasCompras;
    }
}


