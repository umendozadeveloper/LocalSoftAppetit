<?php

include_once  'SQL_DML.php';


class Mesa {
    
    public $ID;
    public $Numero;
    public $CantidadPersonas;
    public $Ubicacion;
//    public $IdZonaUbicacion;
    public $Status;
    public $Visible;
    public $Activo;
    public $Observaciones;




    //Variables para consultas con Join
    public $MesaPrincipal;

    /**
     * Constructor Mesa
     * @param int $numero
     * @param int $cantidad
     * @param int $ubicacion
     */
        public function Mesa(){
            
    }

        public function InsertarMesa($numero, $cantidad,$id_zona_ubicacion,$observaciones,$activo){
        $this->Numero = $numero;
        $this->CantidadPersonas = $cantidad;
        $this->Ubicacion = $id_zona_ubicacion;
        $this->Observaciones = $observaciones;
        $this->Activo = $activo;
        $this->Visible = 1;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Mesas");

        $query = "insert into Mesas ".
        "(ID,Numero,CantidadPersonas,Ubicacion,Visible,Observaciones,Activo) ".
         "values (".$resultado.",$this->Numero,$this->CantidadPersonas,'$this->Ubicacion','"
                . "$this->Visible','$this->Observaciones','$this->Activo')";
        
        if($objSQL->Execute($query))
        {
            $this->ID = $resultado;
            return true;
        }
        else
            return FALSE;
   
    }
        

    public function ConsultarDisponibles() {
        $con = Conexion();
        $query = "select * from Mesas where Visible = 1";
        $mesas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objMesa = new Mesa();
            $objMesa->ID = utf8_encode($Datos['ID']);
            $objMesa->CantidadPersonas = utf8_encode($Datos['CantidadPersonas']);
            $objMesa->Numero = utf8_encode($Datos['Numero']);
            $objMesa->Status =utf8_encode( $Datos['Status']);
            $objMesa->Ubicacion = utf8_encode($Datos['Ubicacion']);
            $objMesa->Visible = utf8_encode($Datos['Visible']);
            $objMesa->Observaciones = utf8_encode($Datos['Observaciones']);
            $objMesa->Activo = utf8_encode($Datos['Activo']);
            array_push($mesas, $objMesa);
            }
            return $mesas;
        }
        
        public function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from Mesas";
        $mesas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objMesa = new Mesa();
            $objMesa->ID = utf8_encode($Datos['ID']);
            $objMesa->CantidadPersonas = utf8_encode($Datos['CantidadPersonas']);
            $objMesa->Numero = utf8_encode($Datos['Numero']);
            $objMesa->Status =utf8_encode( $Datos['Status']);
            $objMesa->Ubicacion = utf8_encode($Datos['Ubicacion']);
            $objMesa->Visible = utf8_encode($Datos['Visible']);
            $objMesa->Observaciones = utf8_encode($Datos['Observaciones']);
            $objMesa->Activo = utf8_encode($Datos['Activo']);
            array_push($mesas, $objMesa);
            }
            return $mesas;
        }




        public function ModificarPorID($ID,$mesa,$cantidadPersonas,$id_zona_ubicacion,$activo,$obsevaciones) {
            $res = FALSE;
            if ($this->ConsultarPorNumero($mesa,$ID)){
                return FALSE;
            }
            $this->ID = $ID;
            $this->Numero = $mesa;
            $this->CantidadPersonas = $cantidadPersonas;
            $this->Ubicacion = $id_zona_ubicacion;
            $this->Activo = $activo;
            $this->Observaciones = $obsevaciones;
            
            $query = "update Mesas set Numero = '$this->Numero', "
                    . " CantidadPersonas  = '$this->CantidadPersonas',"
                    . " Ubicacion = '$this->Ubicacion',"
                    . " Observaciones='$this->Observaciones', "
                    . "Activo='$this->Activo' where Mesas.ID = '$this->ID'";
            $objSQL = new SQL_DML();
            if($objSQL->Execute($query))
                return true;
            else
                return false;
        }
        
        public function ConsultarLibres(){
            
        $con = Conexion();
        $query = "select * from Mesas where Mesas.Status is NULL or Mesas.Status = 0 order by Numero";
        $mesas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objMesa = new Mesa();
            $objMesa->ID = utf8_encode($Datos['ID']);
            $objMesa->CantidadPersonas = utf8_encode($Datos['CantidadPersonas']);
            $objMesa->Numero = utf8_encode($Datos['Numero']);
            $objMesa->Status =utf8_encode( $Datos['Status']);
            $objMesa->Ubicacion = utf8_encode($Datos['Ubicacion']);
            $objMesa->Visible = utf8_encode($Datos['Visible']);
            $objMesa->Observaciones = utf8_encode($Datos['Observaciones']);
            $objMesa->Activo = utf8_encode($Datos['Activo']);
            array_push($mesas, $objMesa);
            }
            return $mesas;
            
        }




        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from Mesas where ID = $ID";
        $mesas = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->CantidadPersonas = utf8_encode($Datos['CantidadPersonas']);
            $this->Numero = utf8_encode($Datos['Numero']);
            $this->Status =utf8_encode( $Datos['Status']);
            $this->Ubicacion = utf8_encode($Datos['Ubicacion']);
            $this->Visible = utf8_encode($Datos['Visible']);
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Activo = utf8_encode($Datos['Activo']);
            $res = true;
            }
            return $res;
        }
        
        public function ConsultarPorNumero($Numero,$ID = ""){
         
        $con = Conexion();
        $this->Numero = $Numero;
        $this->ID = $ID;
        $query = "select * from Mesas where Numero = '$this->Numero' and Visible = 1 and ID != '$this->ID'";
        $mesas = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->CantidadPersonas = utf8_encode($Datos['CantidadPersonas']);
            $this->Numero = utf8_encode($Datos['Numero']);
            $this->Status =utf8_encode( $Datos['Status']);
            $this->Ubicacion = utf8_encode($Datos['Ubicacion']);
            $this->Visible = utf8_encode($Datos['Visible']);
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Activo = utf8_encode($Datos['Activo']);
            $res = true;
            }
            return $res;
        }
        
        public function ConsultarMesaPorIDComanda($ID){
            $con = Conexion();
            //$query = "select ComandaMesas.IdMesa, Mesas.Visible, Mesas.Numero, Mesas.Ubicacion, Principal from ComandaMesas
            //              join Mesas on Mesas.ID = ComandaMesas.IdMesa where ComandaMesas.IdComanda = $ID";
            $query = "select ComandaMesas.IdMesa, Mesas.Visible, Mesas.Numero, Mesas.Ubicacion, Principal, Mesas.Observaciones, Mesas.Activo from ComandaMesas
                          join Mesas on Mesas.ID = ComandaMesas.IdMesa where ComandaMesas.IdComanda = $ID";
            $mesas = array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $objMesa = new Mesa();
                $objMesa->ID = utf8_encode($Datos['IdMesa']);
                $objMesa->MesaPrincipal = utf8_encode($Datos['Principal']);
                $objMesa->Numero = utf8_encode($Datos['Numero']);
                $objMesa->Ubicacion = utf8_encode($Datos['Ubicacion']);
                $objMesa->Visible = utf8_encode($Datos['Visible']);
                $objMesa->Observaciones = utf8_encode($Datos['Observaciones']);
                $objMesa->Activo = utf8_encode($Datos['Activo']);
                array_push($mesas, $objMesa);
                }
                return $mesas;
            
        }
        
        function LiberarMesas($arreglo){
            $con = Conexion();
            $objSQL = new SQL_DML();
            foreach ($arreglo as $mesas){
                $query = "update Mesas set Status = 0 where Mesas.ID = $mesas->ID";
                $objSQL->Execute($query);
            }
        }
        
        
        function BorradoLogico($ID){
            $con = Conexion();
            $this->ID = $ID;
            $objSQL = new SQL_DML();
            $query = "update Mesas set Visible = 0 where ID = '$this->ID'";
            return $objSQL->Execute($query);
        }
}


