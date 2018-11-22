<?php

include_once  'SQL_DML.php';

class InventarioConteo {
    
    public $ID;
    public $IdInventario;
    public $IdInsumo;
    public $Sistema;
    public $Fisico;

   public function InventarioConteo(){
            
    }

    public function Insertar($id_inventario, $id_insumo){
        $this->IdInventario = $id_inventario;
        $this->IdInsumo = $id_insumo;
     
        $this->Sistema = NULL;
        $this->Fisico = NULL;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from InventariosConteo");
        $this->ID = $resultado;

        $query = "insert into InventariosConteo ".
        "(ID,IdInventario,IdInsumo,Sistema,Fisico) ".
         "values ('".$this->ID."','".$this->IdInventario."','".$this->IdInsumo."',NULL,NULL)";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
   
    }
        
    
     public function ConsultarTodo()
     {
        $con = Conexion();
        $query = "select * from InventariosConteo";
        $inventarios_conteo = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objInventarioConteo = new InventarioConteo();
            $objInventarioConteo->ID = utf8_encode($Datos['ID']);
            $objInventarioConteo->IdInventario = utf8_encode($Datos['IdInventario']);
            $objInventarioConteo->IdInsumo = utf8_encode($Datos['IdInsumo']);
            $objInventarioConteo->Sistema = utf8_encode($Datos['Sistema']);
            $objInventarioConteo->Fisico = utf8_encode($Datos['Fisico']);
           
            array_push($inventarios_conteo, $objInventarioConteo);
        }
        sqlsrv_close($con);
        return $inventarios_conteo;
     }
   
     
     public function ActualizarInventario($id, $existencia, $conteo)
     {
                
        $query = "Update InventariosConteo Set  Sistema = $existencia, Fisico = $conteo Where Id =$id ";
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
            return true;
        else
            return false;
     }
       
}




