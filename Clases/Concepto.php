<?php

include_once  'SQL_DML.php';


class Concepto {
    
    public $ID;
    public $Clave;
    public $Descripcion;
    public $ES;#Entrada o salida
    public $Observaciones;
    public $Estatus;
    
    public function Concepto(){
            
    }

    public function Insertar($clave, $descripcion,$es,$observaciones, $estatus){
        $this->Clave = $clave;
        $this->Descripcion = $descripcion;
        $this->ES = $es;
        $this->Observaciones = $observaciones;
        $this->Estatus = $estatus;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Conceptos");

        $query = "insert into Conceptos ".
        "(ID,Clave,Descripcion,ES,Observaciones,Status) ".
         "values ('".$resultado."','".$this->Clave."','".$this->Descripcion."','".$this->ES."',"
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
        $query = "select * from Conceptos";
        $conceptos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objConcepto = new Concepto();
            $objConcepto->ID = utf8_encode($Datos['ID']);
            $objConcepto->Clave = utf8_encode($Datos['Clave']);
            $objConcepto->Descripcion = utf8_encode($Datos['Descripcion']);
            $objConcepto->ES = utf8_encode($Datos['ES']);
            $objConcepto->Observaciones = utf8_encode($Datos['Observaciones']);
            $objConcepto->Estatus = utf8_encode($Datos['Status']);
           
            array_push($conceptos, $objConcepto);
            }
            return $conceptos;
        }

        public function ConsultarEntradas(){
        $con = Conexion();
        $query = "select * from Conceptos where ES='1' and ID!='1'";
        $conceptos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objConcepto = new Concepto();
            $objConcepto->ID = utf8_encode($Datos['ID']);
            $objConcepto->Clave = utf8_encode($Datos['Clave']);
            $objConcepto->Descripcion = utf8_encode($Datos['Descripcion']);
            $objConcepto->ES = utf8_encode($Datos['ES']);
            $objConcepto->Observaciones = utf8_encode($Datos['Observaciones']);
            $objConcepto->Estatus = utf8_encode($Datos['Status']);
           
            array_push($conceptos, $objConcepto);
            }
            return $conceptos;
        }

        public function ConsultarSalidas(){
        $con = Conexion();
        $query = "select * from Conceptos where ES='0' and ID!='2'";
        $conceptos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objConcepto = new Concepto();
            $objConcepto->ID = utf8_encode($Datos['ID']);
            $objConcepto->Clave = utf8_encode($Datos['Clave']);
            $objConcepto->Descripcion = utf8_encode($Datos['Descripcion']);
            $objConcepto->ES = utf8_encode($Datos['ES']);
            $objConcepto->Observaciones = utf8_encode($Datos['Observaciones']);
            $objConcepto->Estatus = utf8_encode($Datos['Status']);
           
           
            array_push($conceptos, $objConcepto);
            }
            return $conceptos;
        }

        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from Conceptos where ID = $ID";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->ES = utf8_encode($Datos['ES']);
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Estatus = utf8_encode($Datos['Status']);
            
            $res = true;
            }
            return $res;
        }
       

         public function ModificarPorID($ID,$clave, $descripcion, $es, $observaciones,$estatus) {
            $res = FALSE;
            if ($this->ConsultarSiHayClave($ID, $clave)){
                return FALSE;
            }else{
                $this->ID = $ID;
                $this->Clave = $clave;
                $this->Descripcion = $descripcion;
                $this->ES = $es;
                $this->Observaciones =$observaciones;
                $this->Estatus = $estatus;
                
                $query = "Update Conceptos set Clave='".$this->Clave."',Descripcion='".$this->Descripcion.
                         "',ES='".$this->ES."',Observaciones='$this->Observaciones',Status='$this->Estatus' "
                        . "where ID='".$this->ID."'";
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
            $query = "select * from Conceptos where Clave ='$clave' and ID!=$id";
    //        $clasificadores = array();
            $valor = sqlsrv_query($con,$query);
            $res = false;
            while($Datos = sqlsrv_fetch_array($valor)){

                $this->ID = utf8_encode($Datos['ID']);
                $this->Clave = utf8_encode($Datos['Clave']);
                $this->Descripcion = utf8_encode($Datos['Descripcion']);
                $this->ES = utf8_encode($Datos['ES']);
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
        
            $query = "delete Conceptos where ID ='".$this->ID."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }

        
        
       
}


