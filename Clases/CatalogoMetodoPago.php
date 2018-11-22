<?php
include_once 'SQL_DML.php';

class CatalogoMetodoPago{
    public $Id;
    public $Clave;
    public $Nombre;


    public function ConsultarTodo(){
        $con = Conexion();
        $query = "Select * from MetodoPago";
        $metodos_pago = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objMetodoPago = new CatalogoMetodoPago();
            $objMetodoPago->Id = utf8_encode($Datos['ID']);
            $objMetodoPago->Clave = utf8_encode($Datos ['Clave']);
            $objMetodoPago->Nombre = utf8_encode($Datos ['Nombre']);
           
            array_push($metodos_pago, $objMetodoPago);
        }
        return $metodos_pago;

    }
    
    
    public function ConsultarPorId($id){
        $con = Conexion();
        $query = "Select * from MetodoPago where ID='$id'";
        $valor = sqlsrv_query($con,$query);

        while ($Datos = sqlsrv_fetch_array($valor))
        {
            $this->Id = utf8_encode($Datos['ID']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Nombre = utf8_encode($Datos['Nombre']);

        }
        sqlsrv_close($con);
    }
    
    public function ConsultarPorClave($clave)
    {
        $con = Conexion();
        $query = "Select * from MetodoPago where Clave='$clave'";
        
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->Id = utf8_encode($Datos['ID']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Nombre = utf8_encode($Datos['Nombre']);
        }
        sqlsrv_close($con);
        return $this;
    }
    
}

