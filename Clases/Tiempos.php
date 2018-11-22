<?php
include_once 'SQL_DML.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tiempos
 *
 * @author URIEL
 */
class Tiempos {
    //put your code here
    public $ID;
    public $Clave;
    public $Descripcion;
    
    public function ConsultarPorID($ID){
            $con = Conexion();
            $this->ID = $ID;
            $query = "select * from Tiempos where ID = '$this->ID'";
            $res = false;
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $this->ID  = utf8_encode($Datos ['ID']);
                $this->Clave = utf8_encode($Datos ['Clave']);
                $this->Descripcion = utf8_encode($Datos ['Descripcion']);
                $res = true;
            }
            return $res;
    }
    
    public function ConsultarTodo(){
            $con = Conexion();
            $query = "select * from Tiempos";
            $tiempos = array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $objTiempo = new Tiempos();
                $objTiempo->ID  = utf8_encode($Datos ['ID']);
                $objTiempo->Clave = utf8_encode($Datos ['Clave']);
                $objTiempo->Descripcion = utf8_encode($Datos ['Descripcion']);
                array_push($tiempos, $objTiempo);
            }
            return $tiempos;
    }
    
    
    
    
    
    
}
