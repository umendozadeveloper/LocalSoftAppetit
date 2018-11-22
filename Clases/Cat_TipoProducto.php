<?php 
include_once 'SQL_DML.php';

class TipoProducto{
    
    public $ID;
    public $Descripcion;
    
    public function ConsultarTodo(){
       
       $con = Conexion();
       $query = "SELECT * FROM Cat_TipoProductoSA";
       $TiposProductos = array();
       $valor = sqlsrv_query($con,$query);
       while($Datos = sqlsrv_fetch_array($valor)){
          $objTipoProductos = new TipoProducto();
          $objTipoProductos->ID = utf8_encode($Datos['ID']);
          $objTipoProductos->Descripcion = utf8_encode($Datos['Descripcion']);
          array_push($TiposProductos, $objTipoProductos);
       }
    }
    
    public function ConsultarPorID($ID){
       $con = Conexion();
       $this->ID = $ID;
       $query = "SELECT * FROM Cat_TipoProductoSA where ID = '$this->ID'";
       $res = false;
       $valor = sqlsrv_query($con,$query);
       while($Datos = sqlsrv_fetch_array($valor)){
           $this->ID = utf8_encode($Datos['ID']);
           $this->Descripcion = utf8_encode($Datos['Descripcion']);
           $res = true;
       } 
       return $res;
    }
    
}

?>
