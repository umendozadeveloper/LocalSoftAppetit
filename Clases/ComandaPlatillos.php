<?php

include_once  'SQL_DML.php';
class ComandaPlatillos {
    public $ID;
    public $IdComanda;
    public $IdPlatillo;
    public $NombrePlatillo;
    public $Cantidad;
    public $Precio;
    public $Comentarios;
    public $EstadoPedidoDescripcion;
    public $PedidoPorCliente;
    public $IdEstado;
    public $ValorEstrellas;
    public $IdTiempo;

    public function CalificarPorID($ID,$ValorEstrellas){
        $con = Conexion();
        $this->ID = $ID;
        $this->ValorEstrellas = $ValorEstrellas;
        $query = "update ComandaPlatillos set ValorEstrellas = '$this->ValorEstrellas' where ID = '$this->ID'";
        $objSQL = new SQL_DML();
        return $objSQL->Execute($query);
    }
    
//    public function ConsultarPorID($ID){
//      $con = Conexion();   
//      $query = "select * from ComandaPlatillos";
//      $valor = sqlsrv_query($con,$query);
//      $res = false;
//      while($Datos = sqlsrv_fetch_array($valor)){
//            $this->ID = utf8_encode($Datos['ID']);
//            $this->IdComanda = utf8_encode($Datos['IdComanda']);
//            $this->IdPlatillo = utf8_encode($Datos['IdPlatillo']);
//            $this->Cantidad = utf8_encode($Datos['Cantidad']);
//            $this->Precio = utf8_encode($Datos['Precio']);
//            $this->Comentarios = utf8_encode($Datos['Comentarios']);
//            $this->PedidoPorCliente = utf8_encode($Datos['PedidoPorCliente']);
//            $this->IdEstado = utf8_encode($Datos['IdEstado']);
//            $this->ValorEstrellas = utf8_encode($Datos['ValorEstrellas']);
//            $this->IdTiempo = $Datos['IdTiempo'];
//            $res = true;
//        }
//        return $res;
//        
//      
//    }
    
     public function ConsultarPorID($ID){
      $con = Conexion();   
      $this->ID = $ID;
      $query = "select * from ComandaPlatillos where ID = '$this->ID'";
      $valor = sqlsrv_query($con,$query);
      $res = false;
      while($Datos = sqlsrv_fetch_array($valor)){
            $this->ID = utf8_encode($Datos['ID']);
            $this->IdComanda = utf8_encode($Datos['IdComanda']);
            $this->IdPlatillo = utf8_encode($Datos['IdPlatillo']);
            $this->Cantidad = utf8_encode($Datos['Cantidad']);
            $this->Precio = utf8_encode($Datos['Precio']);
            $this->Comentarios = utf8_encode($Datos['Comentarios']);
            $this->PedidoPorCliente = utf8_encode($Datos['PedidoPorCliente']);
            $this->IdEstado = utf8_encode($Datos['IdEstado']);
            $this->ValorEstrellas = utf8_encode($Datos['ValorEstrellas']);
            $this->IdTiempo = utf8_encode($Datos['IdTiempo']);
            $res = true;
        }
        return $res;  
    }
    
    public function ConsultarPorIdComanda($ID){
        
        $con = Conexion();
        $query ="  select ComandaPlatillos.ID ,ComandaPlatillos.ValorEstrellas,ComandaPlatillos.IdPlatillo,Platillos.Nombre, Cantidad,
                    CAST (ComandaPlatillos.Precio as decimal (6,2)) as 'Precio',
                    EstadosPedidos.Descripcion, ComandaPlatillos.Comentarios 
                    from ComandaPlatillos join Platillos 
                    on Platillos.ID = ComandaPlatillos.IdPlatillo 
                    join EstadosPedidos on EstadosPedidos.ID = ComandaPlatillos.IdEstado 
                    where ComandaPlatillos.IdComanda = $ID
                    ";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaPlatillos();
            $objComanda->ID = utf8_encode($Datos['ID']);
            $objComanda->IdPlatillo = utf8_encode($Datos['IdPlatillo']);
            $objComanda->NombrePlatillo = utf8_encode($Datos['Nombre']);
            $objComanda->Cantidad = utf8_encode($Datos['Cantidad']);
            $objComanda->Precio = utf8_encode($Datos['Precio']);
            $objComanda->Comentarios = utf8_encode($Datos['Comentarios']);
            $objComanda->EstadoPedidoDescripcion = utf8_encode($Datos['Descripcion']);
            $objComanda->ValorEstrellas = utf8_encode($Datos['ValorEstrellas']);
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }
    
        
     public function ConsultarPorIdComandaPedido($ID){
        
        $con = Conexion();
        $query ="  select ComandaPlatillos.ID ,ComandaPlatillos.ValorEstrellas,ComandaPlatillos.IdPlatillo,Platillos.Nombre, Cantidad,
                    CAST (ComandaPlatillos.Precio as decimal (6,2)) as 'Precio',
                    ComandaPlatillos.IdEstado,
                    EstadosPedidos.Descripcion, ComandaPlatillos.Comentarios 
                    from ComandaPlatillos join Platillos 
                    on Platillos.ID = ComandaPlatillos.IdPlatillo 
                    join EstadosPedidos on EstadosPedidos.ID = ComandaPlatillos.IdEstado 
                    where ComandaPlatillos.IdComanda = '$ID' and ComandaPlatillos.IdEstado = '1'
                    ";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objComanda = new ComandaPlatillos();
            $objComanda->ID = utf8_encode($Datos['ID']);
            $objComanda->IdPlatillo = utf8_encode($Datos['IdPlatillo']);
            $objComanda->NombrePlatillo = utf8_encode($Datos['Nombre']);
            $objComanda->Cantidad = utf8_encode($Datos['Cantidad']);
            $objComanda->Precio = utf8_encode($Datos['Precio']);
            $objComanda->Comentarios = utf8_encode($Datos['Comentarios']);
            $objComanda->EstadoPedidoDescripcion = utf8_encode($Datos['Descripcion']);
            $objComanda->ValorEstrellas = utf8_encode($Datos['ValorEstrellas']);
            $objComanda->IdEstado = utf8_encode($Datos['IdEstado']);
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }
    
    public function InsertarPorMesero($idComanda, $idPlatillo,$cantidad,$precio,$comentarios){
        $objSQL = new SQL_DML();
        $this->ID = $objSQL->GetScalar("select MAX(ID) as ID from ComandaPlatillos");
        $this->IdComanda = $idComanda;
        $this->IdPlatillo = $idPlatillo;
        $this->Cantidad = $cantidad;
        $this->Precio = $precio;
        $this->Comentarios = $comentarios;
        $this->PedidoPorCliente = 0;
        $this->IdEstado = 1;
        
        $query = "Insert into ComandaPlatillos (ID,IdComanda, IdPlatillo, Cantidad, Precio,Comentarios, "
                . "PedidoPorCliente, IdEstado) values"
                . " ($this->ID,$this->IdComanda,$this->IdPlatillo,"
                . "$this->Cantidad,$this->Precio,"
                . "$this->Comentarios,$this->PedidoPorCliente,"
                . "$this->IdEstado)";
        
        if($objSQL->Execute($query))
        {
            return true;
        }
        else
        {
           return FALSE; 
        }
            
        //return $objSQL->Insertar($query);
        
    }
    
    public function InsertarPorCliente($idComanda, $idPlatillo,$cantidad,$precio,$comentarios){
        $objSQL = new SQL_DML();
        $this->ID = $objSQL->GetScalar("select MAX(ID) as ID from ComandaPlatillos");
        $this->IdComanda = $idComanda;
        $this->IdPlatillo = $idPlatillo;
        $this->Cantidad = $cantidad;
        $this->Precio = $precio;
        $this->Comentarios = $comentarios;
        $this->PedidoPorCliente = 0;
        $this->PedidoPorCliente = 1;
        return $objSQL->Execute($query);
    }


    public function BorrarComandaP($ID){
        $objSQL = new SQL_DML();
        $query = "delete ComandaPlatillos where ID = $ID";
        if($objSQL->Execute($query))
            return TRUE;
        else {
        return FALSE;    
        }
    }
    
    public function EditarComandaP($ID,$cantidad){
        $objSQL = new SQL_DML();
        $query = "update ComandaPlatillos set Cantidad = $cantidad where ID = $ID";
        if($objSQL->Execute($query))
            return TRUE;
        else {
        return FALSE;    
        }
    }
    
    public function EditarComandaP_PlatilloListo($ID){
        $objSQL = new SQL_DML();
        $query = "update ComandaPlatillos set IdEstado = 2 where ID = $ID";
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
        $query = "update ComandaPlatillos set IdEstado = '$this->IdEstado' where ID = '$this->ID'";
        if($objSQL->Execute($query))
            return TRUE;
        else {
        return FALSE;    
        }
    }
    
    
    public function ConsultarCalificacionPorIDPlatillo($IdPlatillo){
        $objSQL = new SQL_DML();
        $this->IdPlatillo = $IdPlatillo;
        $query = "select AVG(ComandaPlatillos.ValorEstrellas) as ID from ComandaPlatillos where IdPlatillo = '$this->IdPlatillo'";
        $Calificacion = $objSQL->GetScalar($query)-1;
        return $Calificacion;
    }
    
    
}
