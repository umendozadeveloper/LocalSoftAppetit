<?php

include_once  'SQL_DML.php';
class Almacen {
    
    public $ID;
    public $Clave;
    public $Descripcion;
    public $Observaciones;
    public $Estatus;
    
    public function Almacen(){
            
    }

    public function Insertar($clave, $descripcion, $observaciones, $estatus){
        $this->Clave = $clave;
        $this->Descripcion = $descripcion;
        $this->Observaciones = $observaciones;
        $this->Estatus = $estatus;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Almacenes");

        $query = "insert into Almacenes ".
        "(ID,Clave,Descripcion, Observaciones, Status) ".
         "values ('".$resultado."','".$this->Clave."','".$this->Descripcion."'"
                . ",'$this->Observaciones','$this->Estatus')";
        
        if($objSQL->Execute($query))
        {
            $this->ID = $resultado;
            return true;
        }
        else{
            return FALSE;
            
        }
   
    }
        

        
        public function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from Almacenes";
        $almacenes = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objAlmacen = new Almacen();
            $objAlmacen->ID = utf8_encode($Datos['ID']);
            $objAlmacen->Clave = utf8_encode($Datos['Clave']);
            $objAlmacen->Descripcion = utf8_encode($Datos['Descripcion']);
            $objAlmacen->Observaciones = utf8_encode($Datos['Observaciones']);
            $objAlmacen->Estatus = utf8_encode($Datos['Status']);
           
            array_push($almacenes, $objAlmacen);
            }
            return $almacenes;
        }





        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from Almacenes where ID = $ID";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Estatus = utf8_encode($Datos['Status']);
           
            $res = true;
            }
            return $res;
        }
       

         public function ModificarPorID($ID,$clave, $descripcion, $observaciones, $estatus) {
            $res = FALSE;
            if ($this->ConsultarSiHayClave($ID, $clave)){
                return FALSE;
            }else{
                $this->ID = $ID;
                $this->Clave = $clave;
                $this->Descripcion = $descripcion;
                $this->Observaciones = $observaciones;
                $this->Estatus = $estatus;
                
                $query = "Update Almacenes set Clave='".$this->Clave."',Descripcion='".$this->Descripcion.
                         "',Observaciones='$this->Observaciones', Status='$this->Estatus' where ID='".$this->ID."'";
                $objSQL = new SQL_DML();
                if($objSQL->Execute($query))
                    return true;
                else
                    return false;
            
            }
        }
        
        public function ConsultarSiHayClave($id,$clave)
        {
            $con = Conexion();
            $query = "select * from Almacenes where Clave ='$clave' and ID!=$id";
    //        $clasificadores = array();
            $valor = sqlsrv_query($con,$query);
            $res = false;
            while($Datos = sqlsrv_fetch_array($valor)){

                $this->ID = utf8_encode($Datos['ID']);
                $this->Clave = utf8_encode($Datos['Clave']);
                $this->Descripcion = utf8_encode($Datos['Descripcion']);
                $this->Observaciones = utf8_encode($Datos['Observaciones']);
                $this->Estatus = utf8_encode($Datos['Status']);

                $res = true;
            }
            sqlsrv_close($con);
            return $res;
        }
        
        
        public function Eliminar($id)
        {
            $this->ID = $id;
            
            $objSQL = new SQL_DML();
        
            $query = "delete Almacenes where ID ='".$this->ID."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }

        
         
}


