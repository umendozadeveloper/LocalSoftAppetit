<?php

include_once  'SQL_DML.php';

class Salida {
    
    public $ID;
    public $Fecha;
    public $Referencia;
    public $IdTipoMovimiento;
    public $IdEntradaEstatus;
//    public $IdAlmacen;



    public function Salida(){
            
    }

    public function InsertarSalida($ID, $fecha, $referencia, $idTipoMovimiento, $idSalidaStatus){
        $this->Fecha = $fecha;
        $this->Referencia = $referencia;
        $this->IdTipoMovimiento = $idTipoMovimiento;
        $this->IdEntradaEstatus = $idSalidaStatus;
        $this->ID = $ID;
//        $this->IdAlmacen = $idAlmacen;

        $query = "insert into Salidas ".
        "(ID,Fecha,Referencia,IdTipoMovimiento,IdSalidaEstatus) ".
         "values ('".$this->ID."','".$this->Fecha."','".$this->Referencia."','".$this->IdTipoMovimiento."','".$this->IdEntradaEstatus
                ."')";
        
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
        $this->ID = $id_salida;
               
        $query = "Delete From Salidas where ID='$this->ID'";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
    }   
}


