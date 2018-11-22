<?php

include_once  'SQL_DML.php';

class Entrada {
    
    public $ID;
    public $Fecha;
    public $Referencia;
    public $IdTipoMovimiento;
    public $IdEntradaEstatus;
    

    public function Entrada(){
            
    }

    public function InsertarEntrada($ID, $fecha, $referencia, $idTipoMovimiento, $idEntradaStatus){
        $this->Fecha = $fecha;
        $this->Referencia = $referencia;
        $this->IdTipoMovimiento = $idTipoMovimiento;
        $this->IdEntradaEstatus = $idEntradaStatus;
        $this->ID = $ID;
//        $objSQL = new SQL_DML();
//        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Entradas");

        $query = "insert into Entradas ".
        "(ID,Fecha,Referencia,IdTipoMovimiento,IdEntradaEstatus) ".
         "values ('".$this->ID."','".$this->Fecha."','".$this->Referencia."','".$this->IdTipoMovimiento."','".$this->IdEntradaEstatus."')";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
   
    }
        
    
        
    public function CancelarEntrada(){
        
    }   
    
    public function ObtenerPEPS($id_insumo){
        $con = Conexion();
        $query = "select ed.IdInsumo as IDInsumo, ed.DisponiblePEPS as Disponible, ed.Costo as Precio, ed.ID as IdEntradaDetalle  from EntradasDetalle as ed  where ed.IdInsumo =$id_insumo and ed.DisponiblePEPS > 0";
        $PEPS = array();
        $entradas_detalle= array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $entradas_detalle = array(
                "IDInsumo" => utf8_encode($Datos['IDInsumo']),
                "Disponible" => utf8_encode($Datos['Disponible']),
                "Precio" => utf8_encode($Datos['Precio']) ,
                "IdEntradaDetalle" => utf8_encode($Datos['IdEntradaDetalle']),
            );
          
           
            array_push($PEPS, $entradas_detalle);
        }
        sqlsrv_close($con);
        return $PEPS;

    }
  
       
}


