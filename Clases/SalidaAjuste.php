<?php

include_once  'SQL_DML.php';
include_once 'Entrada.php';
include_once 'Kardex.php';
include_once 'DetalleEntrada.php';

class SalidaAjuste {
    
    public $ID;
    public $IdSalida;
    public $Observaciones;
    public $IdUsuario;
    public $CostoTotal;
    
    public function Insertar($id,$id_salida, $observaciones, $id_usuario,$costo_total) {
        
        $this->ID = $id;
        $this->IdSalida = $id_salida;
        $this->Observaciones = $observaciones;
        $this->IdUsuario = $id_usuario;
        $this->CostoTotal = $costo_total;
       
               
        
//        $objSQL = new SQL_DML();
//        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from SalidasAjustes");
//        $this->ID = $resultado;
        
        $query = "insert into SalidasAjustes ".
        "(ID,IdSalida,Observaciones,IdUsuario,CostoTotal) ".
         "values ('".$this->ID."','".$this->IdSalida."','".$this->Observaciones."','".$this->IdUsuario."','$this->CostoTotal')";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
    }
    

//    public function Eliminar($id_salida)
//    {
//        $this->IdSalida = $id_salida;
//               
//        $query = "Delete From SalidasVentas where IdSalida ='$this->IdSalida'";
//        
//        $objSQL = new SQL_DML();
//        if($objSQL->Execute($query))
//        {
//            
//            return true;
//        }
//        else{
//            return FALSE;
//            
//        }
//    }

    

    
}//clase
