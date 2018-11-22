<?php

include_once  'SQL_DML.php';


class KardexTipoMovimiento {
    
    public $ID;
    public $Clave;
    public $Descripcion;
    public $EntradaSalida;
    public $Cancelacion;
    public $Sistema;
    
    public function KardexTipoMovimiento(){
            
    }

    public function ConsultarTodo(){
    $con = Conexion();
    $query = "select * from KardexTipoMovimiento";
    $tipo_movimiento = array();
    $valor = sqlsrv_query($con,$query);
    while($Datos = sqlsrv_fetch_array($valor)){
        $objTipoMovimiento = new KardexTipoMovimiento();
        $objTipoMovimiento->ID = utf8_encode($Datos['ID']);
        $objTipoMovimiento->Clave = utf8_encode($Datos['Clave']);
        $objTipoMovimiento->Descripcion = utf8_encode($Datos['Descripcion']);
        $objTipoMovimiento->EntradaSalida = utf8_encode($Datos['EntradaSalida']);
        $objTipoMovimiento->Cancelacion = utf8_encode($Datos['Cancelacion']);
        $objTipoMovimiento->Sistema = utf8_encode($Datos['Sistema']);
        array_push($tipo_movimiento, $objTipoMovimiento);
        }
        return $tipo_movimiento;
    }

    public function ConsultarPorID($ID){

    $con = Conexion();
    $query = "select * from KardexTipoMovimiento where ID = $ID";
//        $clasificadores = array();
    $valor = sqlsrv_query($con,$query);
    $res = false;
    while($Datos = sqlsrv_fetch_array($valor)){

        $this->ID = utf8_encode($Datos['ID']);
        $this->Clave = utf8_encode($Datos['Clave']);
        $this->Descripcion = utf8_encode($Datos['Descripcion']);
        $this->EntradaSalida = utf8_encode($Datos['EntradaSalida']);
        $this->Cancelacion = utf8_encode($Datos['Cancelacion']);
        $this->Sistema = utf8_encode($Datos['Sistema']);
        $res = true;
        }
        return $res;
    }
       

         
        
       
        
       
}


