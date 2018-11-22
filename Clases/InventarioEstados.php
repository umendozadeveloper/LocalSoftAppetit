<?php

include_once  'SQL_DML.php';


class InventarioEstados {
    
    public $ID;
    public $Clave;
    public $Descripcion;


    public function InventarioEstados(){
            
    }

       public function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from InventariosEstados";
        $estadosInventario = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objEstadoInventario = new InventarioEstados();
            $objEstadoInventario->ID = utf8_encode($Datos['ID']);
            $objEstadoInventario->Clave = utf8_encode($Datos['Clave']);
            $objEstadoInventario->Descripcion = utf8_encode($Datos['Descripcion']);
                      
            array_push($estadosInventario, $objEstadoInventario);
            }
            return $estadosInventario;
        }


        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from InventariosEstados where ID = $ID";

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


