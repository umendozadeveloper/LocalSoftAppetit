<?php

include_once  'SQL_DML.php';

class ComandaMensajes {
    public $Id;
    public $IdComanda;
    public $Mensaje;
    public $Visto;
    public $Usuario;
    public $TipoMensaje;


    public function Insertar($idComanda, $mensaje,$usuario,$visto=0,$tipo = 1){
        $objSQL = new SQL_DML();
        $this->IdComanda = $idComanda;
        $this->Mensaje = $mensaje;
        $this->Visto = $visto;
        $this->Usuario = $usuario;
        $this->TipoMensaje=$tipo;
        $this->Id = $objSQL->GetScalar("select MAX(id) as ID from ComandaMensajes");
        $query = "insert into ComandaMensajes values ($this->Id,$this->IdComanda,'$this->Mensaje',$this->Visto,'$this->Usuario',$this->TipoMensaje)";
        if($objSQL->Execute($query)){
            return true;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function Consultar(){
        $con = Conexion();
        $query ="select * from ComandaMensajes";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaMensajes();
            $objComanda->Id = utf8_encode($Datos['Id']);
            $objComanda->IdComanda = utf8_encode($Datos['IdComanda']);
            $objComanda->Mensaje = utf8_encode($Datos['Mensaje']);
            $objComanda->Usuario = utf8_encode($Datos['Usuario']);
            $objComanda->Visto = utf8_encode($Datos['Visto']);
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }
    
    public function ConsultarPorID($idComanda){
        $con = Conexion();
        $query ="select * from ComandaMensajes where IdComanda = $idComanda and TipoMensaje = 1";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaMensajes();
            $objComanda->Id = utf8_encode($Datos['Id']);
            $objComanda->IdComanda = utf8_encode($Datos['IdComanda']);
            $objComanda->Mensaje = utf8_encode($Datos['Mensaje']);
            $objComanda->Usuario = utf8_encode($Datos['Usuario']);
            $objComanda->Visto = utf8_encode($Datos['Visto']);
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }
    
    
    public function EliminarSolicitarPresencia($IdComanda){
        $objSQL = new SQL_DML();
        $this->IdComanda = $IdComanda;
        $query = "delete ComandaMensajes where IdComanda = $this->IdComanda and TipoMensaje = 3";
        if($objSQL->Execute($query)){
            return true;
        }
        else
        {
            return FALSE;
        }
        
    }

    



    public function Visto($idComanda){
        $objSQL = new SQL_DML();
        $this->IdComanda = $idComanda;
        $query = "update ComandaMensajes set Visto = 1 where IdComanda = $idComanda";
        if($objSQL->Execute($query)){
            return true;
        }
        else
        {
            return FALSE;
        }
    }
    
    
    public function ConsultaSolitaCuenta($Id_Mesero){
        $con = Conexion();
        $query ="select distinct IdComanda,Folio from"
                . " ComandaMensajes join Comanda on ComandaMensajes.IdComanda = Comanda.Id "
                . " where TipoMensaje = 2 and Comanda.IdEstado = 1 and Comanda.IdMesero = $Id_Mesero";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaMensajes();
            $objComanda->IdComanda = utf8_encode($Datos['IdComanda']);
            
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }
    
    
    public function ConsultarPresencia($Id_Mesero){
        $con = Conexion();
        $query ="   select distinct IdComanda,Folio from".
                    " ComandaMensajes join Comanda on ComandaMensajes.IdComanda = Comanda.Id".
                    " where TipoMensaje = 3 and Comanda.IdEstado = 1 and Comanda.IdMesero = $Id_Mesero";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaMensajes();
            $objComanda->IdComanda = utf8_encode($Datos['IdComanda']);
            
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }

        public function ConsultarNoVistasPorID($idComanda){
        $con = Conexion();
        $query ="select * from ComandaMensajes where IdComanda = $idComanda and Visto = 0";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaMensajes();
            $objComanda->Id = utf8_encode($Datos['Id']);
            $objComanda->IdComanda = utf8_encode($Datos['IdComanda']);
            $objComanda->Mensaje = utf8_encode($Datos['Mensaje']);
            $objComanda->Usuario = utf8_encode($Datos['Usuario']);
            $objComanda->Visto = utf8_encode($Datos['Visto']);
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }

    public function ultimoId($Id_Comanda){
        $objSQL = new SQL_DML();
        $id = $objSQL->GetScalar("select MAX(id) as ID from ComandaMensajes where IdComanda = $Id_Comanda");
        $id = $id-1;
        return $id;
    }
    
    public function consultarNotificaciones($Id_Mesero){
        $con = Conexion();
        $notificaciones = 0;
        $mensaje = 0;
        $query ="select distinct IdComanda from ComandaMensajes join Comanda ".
                "on ComandaMensajes.IdComanda = Comanda.Id ".
              "where ComandaMensajes.Visto = 0 and ComandaMensajes.TipoMensaje = 1 ".
                "and Comanda.IdMesero = $Id_Mesero";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $notificaciones++;
            $mensaje=1;
        }
        
        $query ="select distinct IdComanda, Folio from ComandaMensajes join Comanda 
             on ComandaMensajes.IdComanda = Comanda.Id
             where TipoMensaje = 3 and Comanda.IdEstado = 1 and Comanda.IdMesero = $Id_Mesero";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $notificaciones++;
        }
        
        
        $query ="select distinct IdComanda, Folio from ComandaMensajes join "
                . "Comanda on ComandaMensajes.IdComanda = Comanda.Id "
                . "where TipoMensaje = 2 and Comanda.IdEstado = 1 and Comanda.IdMesero = $Id_Mesero";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $notificaciones++;
        }
        return $notificaciones."|".$mensaje;
    }
    
    
}






?>