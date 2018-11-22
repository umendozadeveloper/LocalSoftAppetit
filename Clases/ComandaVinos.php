<?php

include_once  'SQL_DML.php';
class ComandaVinos {
    public $IdVino;
    public $NombreVino;
    public $CantidadBotellas;
    public $CantidadCopas;
    public $PrecioCopa;
    public $PrecioBotella;
    public $EstadoPedidoDescripcion;
    public $ID;
    public $Comentarios;
    public $ValorEstrellas;


    public function CalificarPorID($ID,$ValorEstrellas){
        $con = Conexion();
        $this->ID = $ID;
        $this->ValorEstrellas = $ValorEstrellas;
        $query = "update ComandaVinos set ValorEstrellas = '$this->ValorEstrellas' where ID = '$this->ID'";
        $objSQL = new SQL_DML();
        return $objSQL->Execute($query);
    }

//    public function ConsultarPorID($ID){
//      $con = Conexion();   
//      $query = "select * from ComandaVinos";
//      $valor = sqlsrv_query($con,$query);
//      $res = false;
//      while($Datos = sqlsrv_fetch_array($valor)){
//            $this->ID = utf8_encode($Datos['ID']);
//            $this->IdComanda = utf8_encode($Datos['IdComanda']);
//            $this->IdVino = utf8_encode($Datos['IdVino']);
//            $this->CantidadBotellas = utf8_encode($Datos['CantidadBotellas']);
//            $this->CantidadCopas = utf8_encode($Datos['CantidadCopas']);
//            $this->PrecioCopa = utf8_encode($Datos['PrecioCopa']);
//            $this->PrecioBotella = utf8_encode($Datos['PrecioBotella']);
//            $this->Comentarios = utf8_encode($Datos['Comentarios']);
//            $this->PedidoPorCliente = utf8_encode($Datos['PedidoPorCliente']);
//            $this->IdEstado = utf8_encode($Datos['IdEstado']);
//            $this->ValorEstrellas = utf8_encode($Datos['ValorEstrellas']);
//            $res = true;
//        }
//        return $res;
//        
//      
//    }
    public function ConsultarPorID($ID){
      $con = Conexion();   
      $this->ID = $ID;
      $query = "select * from ComandaVinos where ID = '$this->ID'";
      $valor = sqlsrv_query($con,$query);
      $res = false;
      $this->ID = null;
      while($Datos = sqlsrv_fetch_array($valor)){
            $this->ID = utf8_encode($Datos['ID']);
            $this->IdComanda = utf8_encode($Datos['IdComanda']);
            $this->IdVino = utf8_encode($Datos['IdVino']);
            $this->CantidadBotellas = utf8_encode($Datos['CantidadBotellas']);
            $this->CantidadCopas = utf8_encode($Datos['CantidadCopas']);
            $this->PrecioBotella = utf8_encode($Datos['PrecioBotella']);
            $this->PrecioCopa = utf8_encode($Datos['PrecioCopa']);
            $this->Comentarios = utf8_encode($Datos['Comentarios']);
            $this->PedidoPorCliente = utf8_encode($Datos['PedidoPorCliente']);
            $this->IdEstado = utf8_encode($Datos['IdEstado']);
            $this->ValorEstrellas = utf8_encode($Datos['ValorEstrellas']);
            $res = true;
        }
        return $res;  
    }
    

    public function ConsultarPorIdComanda($ID){
        
        $con = Conexion();
        $query ="select ComandaVinos.ID,ComandaVinos.IdVino,ComandaVinos.ValorEstrellas, Vinos.Nombre,CantidadBotellas,CantidadCopas,
                CAST (ComandaVinos.PrecioBotella as decimal (6,2)) as 'PrecioBotella',
                CAST (ComandaVinos.PrecioCopa as decimal (6,2)) as 'PrecioCopa',
                ComandaVinos.Comentarios,
                EstadosPedidos.Descripcion from ComandaVinos join Vinos 
                on Vinos.ID = ComandaVinos.IdVino 
                join EstadosPedidos on EstadosPedidos.ID = ComandaVinos.IdEstado
                where ComandaVinos.IdComanda = $ID
                ";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaVinos();
            $objComanda->IdVino = utf8_encode($Datos['IdVino']);
            $objComanda->ID = utf8_encode( $Datos['ID']);
            $objComanda->NombreVino = utf8_encode($Datos['Nombre']);
            $objComanda->CantidadBotellas = utf8_encode($Datos['CantidadBotellas']);
            $objComanda->CantidadCopas =utf8_encode( $Datos['CantidadCopas']);
            $objComanda->PrecioBotella =utf8_encode($Datos['PrecioBotella']);
            $objComanda->PrecioCopa = utf8_encode($Datos['PrecioCopa']);
            $objComanda->Comentarios =utf8_encode( $Datos['Comentarios']);
            $objComanda->EstadoPedidoDescripcion =utf8_encode( $Datos['Descripcion']);
            $objComanda->ValorEstrellas =utf8_encode( $Datos['ValorEstrellas']);
            array_push($comandas, $objComanda);
        }
        
        
        return $comandas;
    }
    
    public function ConsultarPorIdComandaPedido($ID){
        
        $con = Conexion();
        $query ="select ComandaVinos.ID,ComandaVinos.IdVino,ComandaVinos.ValorEstrellas, Vinos.Nombre,CantidadBotellas,CantidadCopas,
                CAST (ComandaVinos.PrecioBotella as decimal (6,2)) as 'PrecioBotella',
                CAST (ComandaVinos.PrecioCopa as decimal (6,2)) as 'PrecioCopa',
                ComandaVinos.Comentarios,
                ComandaVinos.IdEstado,
                EstadosPedidos.Descripcion from ComandaVinos join Vinos 
                on Vinos.ID = ComandaVinos.IdVino 
                join EstadosPedidos on EstadosPedidos.ID = ComandaVinos.IdEstado
                where ComandaVinos.IdComanda = $ID and ComandaVinos.IdEstado = 1
                ";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaVinos();
            $objComanda->IdVino = utf8_encode($Datos['IdVino']);
            $objComanda->ID = utf8_encode( $Datos['ID']);
            $objComanda->NombreVino = utf8_encode($Datos['Nombre']);
            $objComanda->CantidadBotellas = utf8_encode($Datos['CantidadBotellas']);
            $objComanda->CantidadCopas =utf8_encode( $Datos['CantidadCopas']);
            $objComanda->PrecioBotella =utf8_encode($Datos['PrecioBotella']);
            $objComanda->PrecioCopa = utf8_encode($Datos['PrecioCopa']);
            $objComanda->Comentarios =utf8_encode( $Datos['Comentarios']);
            $objComanda->EstadoPedidoDescripcion =utf8_encode( $Datos['Descripcion']);
            $objComanda->ValorEstrellas =utf8_encode( $Datos['ValorEstrellas']);
            $objComanda->IdEstado =utf8_encode( $Datos['IdEstado']);
            array_push($comandas, $objComanda);
        }
        
        
        return $comandas;
    }
    
    public function InsertarPorMesero($idComanda, $idPlatillo,$cantidadCopas,$cantidadBotellas,$precioCopa,$precioBotella,$comentarios){
        $objSQL = new SQL_DML();
        $this->ID = $objSQL->GetScalar("select MAX(ID) as ID from ComandaVinos");
        $this->IdComanda = $idComanda;
        $this->IdVino = $idPlatillo;
        $this->CantidadCopas = $cantidadCopas;
        $this->CantidadBotellas = $cantidadBotellas;
        $this->PrecioCopa = $precioCopa;
        $this->PrecioBotella = $precioBotella;
        $this->Comentarios = $comentarios;
        $this->PedidoPorCliente = 0;
        $this->IdEstado = 1;
        $query  ="insert into ComandaVinos (ID, IdComanda, IdVino, CantidadBotellas, CantidadCopas, PrecioCopa,"
                . " PrecioBotella, Comentarios, PedidoPorCliente, IdEstado) values"
                . " ($this->ID,$this->IdComanda,$this->IdVino,"
                . "$this->CantidadBotellas,$this->CantidadCopas,$this->PrecioCopa,"
                . "$this->PrecioBotella,'$this->Comentarios',$this->PedidoPorCliente,"
                . "$this->IdEstado)";
        //echo $query;
        if($objSQL->Execute($query))
        {
            return true;
        }
        else
            return FALSE;
        //return $objSQL->Insertar($query);
    }
    
    
    public function BorrarComandaV($ID){
        $objSQL = new SQL_DML();
        $query = "delete ComandaVinos where ID = $ID";
        echo "<script>alert('$query')</script>";
        if($objSQL->Execute($query))
            return TRUE;
        else {
        return FALSE;    
        }
    }
    
    public function EditarComandaV($ID,$cantidadCopas,$cantidadBotellas){
        $objSQL = new SQL_DML();
        $query = "update ComandaVinos set CantidadCopas = $cantidadCopas, CantidadBotellas = $cantidadBotellas  where ID = $ID";
        if($objSQL->Execute($query))
            return TRUE;
        else {
        return FALSE;    
        }
    }
    
    public function EditarComandaP_VinoListo($ID){
        $objSQL = new SQL_DML();
        $query = "update ComandaVinos set IdEstado = 2 where ID = $ID";
        if($objSQL->Execute($query))
            return TRUE;
        else {
        return FALSE;    
        }
    }

     public function EditarEstado($ID,$IdEstado){
        $objSQL = new SQL_DML();
        $this->IdEstado = $IdEstado;
        $this->ID = $ID;
        $query = "update ComandaVinos set IdEstado = '$this->IdEstado' where ID = '$this->ID'";
        if($objSQL->Execute($query))
            return TRUE;
        else {
        return FALSE;    
        }
    }
    
    
    
    public function ConsultarCalificacionPorIDVino($IdVino){
        $objSQL = new SQL_DML();
        $this->IdVino = $IdVino;
        $query = "select AVG(ComandaVinos.ValorEstrellas) as ID from ComandaVinos where IdVino = '$this->IdVino'";
        $Calificacion = $objSQL->GetScalar($query)-1;
        return $Calificacion;
    }
    
}
