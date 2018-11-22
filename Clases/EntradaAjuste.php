<?php

include_once  'SQL_DML.php';

class EntradaAjuste {
    
   public $ID;
   public $IdEntrada;
   public $Documento;
   public $Observaciones;
   public $CostoTotal;
   public $IdEncargado;
   public $IdProveedor;

   public function EntradaAjuste(){
            
    }

    public function Insertar($id,$id_entrada, $documento, $observaciones, $costo_total, $id_encargado,$id_proveedor){
       
        $this->IdEntrada = $id_entrada;
        $this->Documento = $documento;
//        $this->IdConcepto = $id_concepto;
        $this->Observaciones = $observaciones;
        $this->CostoTotal = $costo_total;
        $this->IdEncargado = $id_encargado;
        $this->ID = $id;
        $this->IdProveedor = $id_proveedor;
        
//        $objSQL = new SQL_DML();
//        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from [EntradasAjustes]");
//        $this->ID = $resultado;
             
        $query= "  Insert into EntradasAjustes (ID,IdEntrada,Documento,Observaciones,CostoTotal,IdEncargado,IdProveedor) "
                . "values ('$this->ID','$this->IdEntrada','$this->Documento','$this->Observaciones','$this->CostoTotal','$this->IdEncargado','$this->IdProveedor')";
//        $query = "insert into [EntradasAjustes] ".
//        "(ID,IdEntrada,Documento,IdProveedor,Observaciones,CostoTotal,IdEncargado) ".
//         "values ('".$this->ID."','".$this->IdEntrada."','".$this->Documento."','".$this->IdProveedor."','"
//                .$this->Observaciones."','".$this->CostoTotal."','".$this->IdEncargado."')";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
   
    }
        
    
    public function ConsultarEntradas_Ajuste_Proveedor()
    {
        $con = Conexion();
        $query = "select E.ID as IdEntrada,E.Fecha, P.Nombre as Proveedor,EA.Documento,EA.Observaciones, EA.CostoTotal  
		from Entradas E join EntradasAjustes EA on E.ID= EA.IdEntrada
		join Proveedores P on EA.IdProveedor= P.ID";
        
        $temporal_entradas= array();
        $entradasAjuste = array();
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
           
            array_push($entradasAjuste, $temporal_entradas);
            }
            sqlsrv_close($con);
            return $entradasAjuste;
    }    
    
    public function ConsultarEntradas_Ajuste_ProveedorPorID($id_entrada)
    {
        $con = Conexion();
        $query = "select E.ID as IdEntrada, E.Fecha, P.Nombre as Proveedor, EA.Documento, EA.Observaciones, EA.CostoTotal, U.Nombre as Usuario, U.Apellidos
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
    
    
    public function ConsultarPorIdEntrada($id_entrada){
        $con = Conexion();
        $query = "select * from EntradasAjustes where IdEntrada=$id_entrada";
        
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
//            $objEntradaAjuste = new Almacen();
            $this->ID = utf8_encode($Datos['ID']);
            $this->IdEntrada = utf8_encode($Datos['IdEntrada']);
            $this->Documento = utf8_encode($Datos['Documento']);
            $this->IdEncargado = $Datos['IdEncargado'];
            $this->CostoTotal = number_format($Datos['CostoTotal'],2,'.','');
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->IdProveedor = $Datos['IdProveedor'];
           
            
        }
        sqlsrv_close($con);
        
    }
}


