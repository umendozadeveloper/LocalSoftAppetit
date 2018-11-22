<?php

include_once 'SQL_DML.php';
include_once 'Fecha.php';
include_once 'Mesero.php';

class VistaComanda_Mesa_ComMesas {
    
    public $Folio;
    public $IdComanda;
    public $NumeroMesa;
    public $Importe;
    public $IdMesero;
    public $Ubicacion;
    public $ClaveEstadoComanda;
    public $Fecha;
    public $NombreMesero;
            
            
    function ConsultarComandasDelDia($idMesero){
        $con = Conexion();
        $objFecha = new Fecha();
        $objMesero = new Mesero();
        //$idMesero = $objMesero->ConsultarPorNombre($nombreMesero);
        $fechaActual = $objFecha->ObtenerFecha();
        $comandas = array();
        $query="select Comanda.ID,Comanda.Fecha,Comanda.Folio,Mesas.Numero,Mesas.Ubicacion,".
                    " ComandasEstados.Clave  from Comanda join ComandaMesas on Comanda.Id = ComandaMesas.IdComanda ".
                    " join Mesas on ComandaMesas.IdMesa = Mesas.ID ".
                    " join ComandasEstados on ComandasEstados.Id = Comanda.IdEstado ".
                    " where ComandaMesas.Principal = 1 and (Comanda.Fecha = '$fechaActual' or Comanda.IdEstado=1) and Comanda.IdMesero = $idMesero";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objVista = new VistaComanda_Mesa_ComMesas();
            $objVista->Folio = utf8_encode($Datos['Folio']);
            $objVista->NumeroMesa = utf8_encode($Datos['Numero']);
            $objVista->IdComanda= utf8_encode($Datos['ID']);
            $objVista->Ubicacion = utf8_encode($Datos['Ubicacion']);
            $objVista->ClaveEstadoComanda = utf8_encode($Datos['Clave']);
            $fecha = $Datos['Fecha'];
            $fecha = date_format($fecha, 'Y-m-d');
            $objVista->Fecha = $fecha;
            array_push($comandas, $objVista);
        }
        return $comandas;

    }
    
    function ConsultarPorID($ID){
        $con = Conexion();
        $objFecha = new Fecha();
        $fechaActual = $objFecha->ObtenerFecha();
        $res = FALSE;
        $query="select Comanda.ID,Comanda.Fecha,Comanda.Folio,Mesas.Numero,Mesas.Ubicacion,".
                    " ComandasEstados.Clave  from Comanda join ComandaMesas on Comanda.Id = ComandaMesas.IdComanda ".
                    " join Mesas on ComandaMesas.IdMesa = Mesas.ID ".
                    " join ComandasEstados on ComandasEstados.Id = Comanda.IdEstado ".
                    " where ComandaMesas.Principal = 1 and Comanda.Id = $ID";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->Folio = utf8_encode($Datos['Folio']);
            $this->NumeroMesa = utf8_encode($Datos['Numero']);
            $this->IdComanda= utf8_encode($Datos['ID']);
            $this->Ubicacion = utf8_encode($Datos['Ubicacion']);
            $this->ClaveEstadoComanda = utf8_encode($Datos['Clave']);
            $fecha = $Datos['Fecha'];
            $fecha = date_format($fecha, 'd/m/Y');
            $this->Fecha = $fecha;
            $res = true;
        }
        return $res;
        
    }
    
    function ConsultarComandasDelDiaAdmin(){
        $con = Conexion();
        $objFecha = new Fecha();
        $fechaActual = $objFecha->ObtenerFecha();
        $comandas = array();
        $query="select Comanda.ID,Meseros.Usuario,Comanda.Fecha,Comanda.Folio,Mesas.Numero,Mesas.Ubicacion,".
            "ComandasEstados.Clave  from Comanda join ComandaMesas on Comanda.Id = ComandaMesas.IdComanda ".
            "join Mesas on ComandaMesas.IdMesa = Mesas.ID ".
            "join ComandasEstados on ComandasEstados.Id = Comanda.IdEstado ".
            "join Meseros on Comanda.IdMesero = Meseros.ID ".
                    " where ComandaMesas.Principal = 1 and (Comanda.Fecha = '$fechaActual' or Comanda.IdEstado=1)";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objVista = new VistaComanda_Mesa_ComMesas();
            $objVista->Folio = utf8_encode($Datos['Folio']);
            $objVista->NumeroMesa = utf8_encode($Datos['Numero']);
            $objVista->IdComanda= utf8_encode($Datos['ID']);
            $objVista->NombreMesero =utf8_encode($Datos['Usuario']);
            $objVista->Ubicacion = utf8_encode($Datos['Ubicacion']);
            $objVista->ClaveEstadoComanda = utf8_encode($Datos['Clave']);
            $fecha = $Datos['Fecha'];
            $fecha = date_format($fecha, 'Y-m-d');
            $objVista->Fecha = $fecha;
            array_push($comandas, $objVista);
        }
        return $comandas;

    }
    
   
}
