<?php

include_once  'SQL_DML.php';


class Ubicacion {
    
    public $ID;
    public $Clave;
    public $Descripcion;
    public $Observaciones;
    public $Estatus;
    
    public function Ubicacion(){
            
    }

    public function Insertar($clave, $descripcion,$observaciones,$estatus){
        $this->Clave = $clave;
        $this->Descripcion = $descripcion;
        $this->Observaciones = $observaciones;
        $this->Estatus = $estatus;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Ubicacion");

        $query = "insert into Ubicacion ".
        "(ID,Clave,Descripcion,Observaciones,Status) ".
         "values ('".$resultado."','".$this->Clave."','".$this->Descripcion."',"
                . "'$this->Observaciones','$this->Estatus')";
        
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
        $query = "select * from Ubicacion";
        $ubicaciones = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objUbicacion = new Ubicacion();
            $objUbicacion->ID = utf8_encode($Datos['ID']);
            $objUbicacion->Clave = utf8_encode($Datos['Clave']);
            $objUbicacion->Descripcion = utf8_encode($Datos['Descripcion']);
            $objUbicacion->Observaciones = utf8_encode($Datos['Observaciones']);
            $objUbicacion->Estatus = utf8_encode($Datos['Status']);
            array_push($ubicaciones, $objUbicacion);
            }
            return $ubicaciones;
        }





        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from Ubicacion where ID = $ID";
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
       

         public function ModificarPorID($ID,$clave, $descripcion,$obsevaciones, $estatus) {
            $res = FALSE;
            if ($this->ConsultarSiHayClave($ID, $clave)){
                return FALSE;
            }else{
                $this->ID = $ID;
                $this->Clave = $clave;
                $this->Descripcion = $descripcion;
                $this->Observaciones = $obsevaciones;
                $this->Estatus = $estatus;
                
                $query = "Update Ubicacion set Clave='".$this->Clave."',Descripcion='".$this->Descripcion.
                         "', Observaciones='$this->Observaciones',Status='$this->Estatus' where ID='".$this->ID."'";
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
            $query = "select * from Ubicacion where Clave ='$clave' and ID!=$id";
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
        
            $query = "delete Ubicacion where ID ='".$this->ID."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }

        
        
       
}


