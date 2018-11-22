<?php
include_once 'SQL_DML.php';

class Moneda{
    public $Id;
    public $Clave;
    public $Descripcion;
    public $Decimales;


    public function ConsultarTodo(){
        $con = Conexion();
        $query = "Select * from Moneda";
        $monedas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objMoneda = new Moneda();
            $objMoneda->Id = utf8_encode($Datos['Id']);
            $objMoneda->Clave = utf8_encode($Datos ['Clave']);
            $objMoneda->Descripcion = utf8_encode($Datos ['Descripcion']);
            $objMoneda->Decimales = utf8_encode($Datos ['Decimales']);
           
            array_push($monedas, $objMoneda);
        }
        sqlsrv_close($con);
        return $monedas;

    }
    
    public function ConsultarPorId($id){
        $con = Conexion();
        $query = "Select * from Moneda where Id='$id'";
        $valor = sqlsrv_query($con,$query);

        while ($Datos = sqlsrv_fetch_array($valor))
        {
            
            $this->Id = utf8_encode($Datos['Id']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->Decimales = utf8_encode($Datos['Decimales']);
            

        }
        sqlsrv_close($con);
    }
    
    public function ConsultarPorClave($clave)
    {
        $con = Conexion();
        $query = "Select * from Moneda where Clave='$clave'";
        $valor = sqlsrv_query($con,$query);

        while ($Datos = sqlsrv_fetch_array($valor))
        {
            
            $this->Id = utf8_encode($Datos['Id']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->Decimales = utf8_encode($Datos['Decimales']);
            

        }
        sqlsrv_close($con);
    }
}

