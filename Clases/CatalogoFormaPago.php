<?php
include_once 'SQL_DML.php';

class CatalogoFormaPago{
    public $Id;
    public $Nombre;


    public function ConsultarTodo(){
        $con = Conexion();
        $query = "Select * from FormaPago";
        $formas_pago = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objFormaPago = new CatalogoFormaPago();
            $objFormaPago->Id = utf8_encode($Datos['Id']);
            $objFormaPago->Nombre = utf8_encode($Datos ['Nombre']);
           
            array_push($formas_pago, $objFormaPago);
        }
        return $formas_pago;

    }
    public function MostrarNoSeleccionados($Seleccionados){
        $con = Conexion();
        $Bandera = false;
        $Condicion="''";
        $Seleccionados = explode(",", $Seleccionados);
        foreach ($Seleccionados as $S)
        {
            if(!$Bandera)
            {
                $Condicion = "'". $S . "'";
                $Bandera = true;
            }
            else {
            $Condicion =  $Condicion . ",'" . $S . "'";
            }
        }
        
        $query = "Select * from FormaPago where Nombre not in ($Condicion)";
        $metodos_pago = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objMetodoPago = new CatalogoMetodoPago();
            $objMetodoPago->Id = utf8_encode($Datos['Id']);
            $objMetodoPago->Nombre = utf8_encode($Datos ['Nombre']);
           
            array_push($metodos_pago, $objMetodoPago);
        }
        return $metodos_pago;

    }
    
    public function ConsultarPorId($id){
        $con = Conexion();
        $query = "Select * from FormaPago where Id='$id'";
        $valor = sqlsrv_query($con,$query);

        while ($Datos = sqlsrv_fetch_array($valor))
        {
            
            $this->Id = utf8_encode($Datos['Id']);
            $this->Nombre = utf8_encode($Datos['Nombre']);
        }
        sqlsrv_close($con);
    }
    
    public function ConsultarPorNombre($Nombre){
        $con = Conexion();
        //$Nombre = utf8_decode($Nombre);
        $query = "Select * from FormaPago where Nombre='$Nombre'";
        $valor = sqlsrv_query($con,$query);

        while ($Datos = sqlsrv_fetch_array($valor))
        {
            
            $this->Id = utf8_encode($Datos['Id']);
            $this->Nombre = utf8_encode($Datos['Nombre']);
        }
        sqlsrv_close($con);
    }
    
    
    
}



