<?php
include_once 'SQL_DML.php';

class UnidadMedida{
    public $Id;
    public $Clave;
    public $Descripcion;


    public function ConsultarTodo(){
        $con = Conexion();
        $query = "Select * from UnidadMedida";
        $unidades = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objUnidad = new UnidadMedida();
            $objUnidad->Id = utf8_encode($Datos['Id']);
            $objUnidad->Clave = utf8_encode($Datos ['Clave']);
            $objUnidad->Descripcion = utf8_encode($Datos ['Descripcion']);
           
            array_push($unidades, $objUnidad);
        }
        
        sqlsrv_close($con);
        return $unidades;

    }
    
    public function ConsultarPorId($id){
        $con = Conexion();
        $query = "Select * from UnidadMedida where Id='$id'";
        $valor = sqlsrv_query($con,$query);
//        $unidad = array();
        while ($Datos = sqlsrv_fetch_array($valor))
        {
            
            $this->Id = utf8_encode($Datos['Id']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            
//            array_push($unidad, $objUnidad);
        }
        sqlsrv_close($con);
    }
    
    
    


}

