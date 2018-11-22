<?php
include_once 'SQL_DML.php';

class RegimenFiscal{
    public $Id;
    public $Nombre;


    public function ConsultarTodo(){
        $con = Conexion();
        $query = "Select * from RegimenFiscal";
        $regimenFiscal = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objRegimen = new RegimenFiscal();
            $objRegimen->Id = utf8_encode($Datos['Id']);
            $objRegimen->Nombre = utf8_encode($Datos ['Nombre']);
           
            array_push($regimenFiscal, $objRegimen);
        }
        
        sqlsrv_close($con);
        return $regimenFiscal;

    }
    
    public function ConsultarPorId($id){
        $con = Conexion();
        $query = "Select * from RegimenFiscal where Id='$id'";
        $valor = sqlsrv_query($con,$query);
//        $unidad = array();
        while ($Datos = sqlsrv_fetch_array($valor))
        {
            
            $this->Id = utf8_encode($Datos['Id']);
            $this->Nombre = utf8_encode($Datos['Nombre']);
//            array_push($unidad, $objUnidad);
        }
        sqlsrv_close($con);
    }
    
    
    


}

