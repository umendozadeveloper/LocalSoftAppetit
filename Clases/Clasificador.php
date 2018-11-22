<?php

include_once  'SQL_DML.php';


class Clasificador {
    
    public $ID;
    public $Clave;
    public $Descripcion;
    public $EsBebida;
    public $Observaciones;
    public $Estatus;
    
    public function Clasificador(){
            
    }

    public function InsertarClasificador($clave, $descripcion,$esbebida,$observaciones,$estatus){
        $this->Clave = $clave;
        $this->Descripcion = $descripcion;
        $this->EsBebida = $esbebida;
        $this->Observaciones = $observaciones;
        $this->Estatus = $estatus;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Clasificador");

        $query = "insert into Clasificador ".
        "(ID,Clave,Descripcion,EsBebida,Observaciones,Status) ".
         "values ('".$resultado."','".$this->Clave."','".$this->Descripcion."','".$this->EsBebida."',"
                . "'$this->Observaciones', '$this->Estatus')";
        
        if($objSQL->Execute($query))
        {
            $this->ID = $resultado;
            return true;
        }
        else
            return FALSE;
   
        
    }
        

        
        public function ConsultarTodo(){
            $con = Conexion();
            $query = "select * from Clasificador";
            $clasificadores = array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $objClasificador = new Clasificador();
                $objClasificador->ID = utf8_encode($Datos['ID']);
                $objClasificador->Clave = utf8_encode($Datos['Clave']);
                $objClasificador->Descripcion = utf8_encode($Datos['Descripcion']);
                $objClasificador->EsBebida = utf8_encode($Datos['EsBebida']);
                $objClasificador->Observaciones = utf8_encode($Datos['Observaciones']);
                $objClasificador->Estatus = utf8_decode($Datos['Status']);
                array_push($clasificadores, $objClasificador);
            }
            sqlsrv_close($con);
            return $clasificadores;
        }





        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from Clasificador where ID = $ID";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->EsBebida = utf8_encode($Datos['EsBebida']);
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Estatus = utf8_encode($Datos['Status']);
          
            $res = true;
            }
             sqlsrv_close($con);
            return $res;
        }
        
        public function ConsultarPorClave($Clave){
         
            $con = Conexion();
            $this->Clave = $Clave;
            $query = "select * from Clasificador where Clave = '$this->Clave'";
    //        $clasificadores = array();
            $valor = sqlsrv_query($con,$query);
            $res = false;
            while($Datos = sqlsrv_fetch_array($valor)){

                $this->ID = utf8_encode($Datos['ID']);
                $this->Clave = utf8_encode($Datos['Clave']);
                $this->Descripcion = utf8_encode($Datos['Descripcion']);
                $this->EsBebida = utf8_encode($Datos['EsBebida']);
                $this->Observaciones = utf8_encode($Datos['Observaciones']);
                $this->Estatus = utf8_encode($Datos['Status']);

                $res = true;
            }
                sqlsrv_close($con);
                return $res;
        }

        public function ModificarPorID($ID,$clave, $descripcion, $esbebida,$observaciones, $estatus) {
            $res = FALSE;
            if ($this->ConsultarSiHayClave($ID, $clave)){
                return FALSE;
            }else{
                $this->ID = $ID;
                $this->Clave = $clave;
                $this->Descripcion = $descripcion;
                $this->Observaciones = $observaciones;
                $this->Estatus = $estatus;
                
                $query = "Update Clasificador set Clave='".$this->Clave."',Descripcion='".$this->Descripcion.
                         "', EsBebida='".$this->EsBebida."', Observaciones='$this->Observaciones',"
                        . " Status='$this->Estatus' where ID='".$this->ID."'";
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
            $query = "select * from Clasificador where Clave ='$clave' and ID!='$id'";
    //        $clasificadores = array();
            $valor = sqlsrv_query($con,$query);
            $res = false;
            while($Datos = sqlsrv_fetch_array($valor)){

                $this->ID = utf8_encode($Datos['ID']);
                $this->Clave = utf8_encode($Datos['Clave']);
                $this->Descripcion = utf8_encode($Datos['Descripcion']);
                $this->EsBebida = utf8_encode($Datos['EsBebida']);
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
        
            $query = "delete Clasificador where ID ='".$this->ID."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }

        
       
}


