<?php
include_once  'SQL_DML.php';
class ComandaEstados {
    public $Id;
    public $Clave;
    public $Descripcion;
    
    
    function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from ComandasEstados order by Id";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaEstados();
            $objComanda->Id = $Datos['Id'];
            $objComanda->Clave = $Datos['Clave'];
            $objComanda->Descripcion = $Datos['Descripcion'];
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }
    
}
