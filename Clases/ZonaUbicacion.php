<?php

include_once  'SQL_DML.php';


class ZonaUbicacion {
    
    public $ID;
    public $Descripcion;
    public $Observaciones;
    public $Estatus;
    
    public function ZonaUbicacion(){
            
    }

    public function Insertar($descripcion,$observaciones,$estatus){
        
        $this->Descripcion = $descripcion;
        $this->Observaciones = $observaciones;
        $this->Estatus = $estatus;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from ZonaUbicacion");

        $query = "insert into ZonaUbicacion ".
        "(ID,Descripcion,Observaciones,Status) ".
         "values ('".$resultado."','".$this->Descripcion."',"
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
        $query = "select * from ZonaUbicacion";
        $ubicaciones = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objUbicacion = new ZonaUbicacion();
            $objUbicacion->ID = utf8_encode($Datos['ID']);
            $objUbicacion->Descripcion = utf8_encode($Datos['Descripcion']);
            $objUbicacion->Observaciones = utf8_encode($Datos['Observaciones']);
            $objUbicacion->Estatus = utf8_encode($Datos['Status']);
            array_push($ubicaciones, $objUbicacion);
            }
            return $ubicaciones;
        }





        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from ZonaUbicacion where ID = $ID";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Estatus = utf8_encode($Datos['Status']);
            
            $res = true;
            }
            return $res;
        }
       

         public function ModificarPorID($ID,$descripcion,$obsevaciones, $estatus) {
            $res = FALSE;
            
                $this->ID = $ID;
                $this->Descripcion = $descripcion;
                $this->Observaciones = $obsevaciones;
                $this->Estatus = $estatus;
                
                $query = "Update ZonaUbicacion set Descripcion='".$this->Descripcion.
                         "', Observaciones='$this->Observaciones',Status='$this->Estatus' where ID='".$this->ID."'";
                $objSQL = new SQL_DML();
                if($objSQL->Execute($query))
                    return true;
                else
                    return false;
            
            
        }
        
        
        
        
        public function Eliminar($id)
        {
            $this->ID = $id;
            
            $objSQL = new SQL_DML();
        
            $query = "delete ZonaUbicacion where ID ='".$this->ID."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }

        
        
       
}



