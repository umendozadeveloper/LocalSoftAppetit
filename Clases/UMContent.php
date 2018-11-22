<?php

include_once  'SQL_DML.php';


class UMContent {
    
    public $ID;
    public $Clave;
    public $Descripcion;
    
    public function UMContent(){
            
    }

    public function Insertar($clave, $descripcion){
        $this->Clave = $clave;
        $this->Descripcion = $descripcion;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from UMContent");

        $query = "insert into UMContent ".
        "(ID,Clave,Descripcion) ".
         "values (".$resultado.",$this->Clave,$this->Descripcion)";
        
        if($objSQL->Execute($query))
        {
            $this->ID = $resultado;
            return true;
        }
        else{
            return FALSE;
            
        }
   
    }
        

        
        public function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from UMContent";
        $unidadesMedida = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objUM = new UnidadMedidaInsumo();
            $objUM->ID = utf8_encode($Datos['ID']);
            $objUM->Clave = utf8_encode($Datos['Clave']);
            $objUM->Descripcion = utf8_encode($Datos['Descripcion']);
           
            array_push($unidadesMedida, $objUM);
            }
            return $unidadesMedida;
        }





        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from UMContent where ID = $ID";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
           
            $res = true;
            }
            return $res;
        }
        
        

        
        
        
       
}
