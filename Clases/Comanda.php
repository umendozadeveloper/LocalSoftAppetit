<?php

include_once 'SQL_DML.php';
include_once 'Mesa.php';

class Comanda {

    public $Id;
    public $Folio;
    public $IdMesero;
    public $Fecha;
    public $IdEstado;
    public $Comentarios;
    public $Cerrada;
    //Propiedad para Join
    public $Clave;

    /**
     * Constructor Mesa
     * @param int $numero
     * @param int $cantidad
     * @param int $ubicacion
     */
    public function NumeroComanda() {
        $objSQL = new SQL_DML();
        $resultado = $objSQL->GetScalar("select MAX (ID) as ID from Comanda");
        return $resultado;
    }

    public function ConsultarFecha() {
        $con = Conexion();
        $resultado = sqlsrv_query($con, "SELECT CONVERT (date, SYSDATETIME()) as Fecha");
        $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC);
        $resultado = $row['Fecha'];
        $resultado = date_format($resultado, 'Y-m-d');
        return $resultado;
        //return $resultado;
    }

    public function ConsultarComandasDelDia($nombreUsuario) {
        $objSQL = new SQL_DML();
        $objComanda = new Comanda();
        $fechaActual = $objComanda->ConsultarFecha();
        $idMesero = $objSQL->ConsultarTabla("select Meseros.ID from Meseros where Meseros.Usuario = '$nombreUsuario'");
        $idMesero = explode("°", $idMesero);
        $idMesero = $idMesero[0];
        return $objSQL->ConsultarTabla("select Comanda.ID,Comanda.Folio,Mesas.Numero,Mesas.Ubicacion as 'Numero Mesa'," .
                        " ComandasEstados.Clave  from Comanda join ComandaMesas on Comanda.Id = ComandaMesas.IdComanda " .
                        " join Mesas on ComandaMesas.IdMesa = Mesas.ID " .
                        " join ComandasEstados on ComandasEstados.Id = Comanda.IdEstado " .
                        " where ComandaMesas.Principal = 1 and Comanda.Fecha = '$fechaActual' and Comanda.IdMesero = $idMesero");
    }

    public function ConsultarImporteComanda($idComanda) {
        $objSQL = new SQL_DML();
        $query = "select CAST(SUM(Cantidad*Precio) as decimal(6,2)) from ComandaPlatillos where ComandaPlatillos.IdComanda = $idComanda" .
                " union" .
                " select CAST (SUM (CantidadBotellas*PrecioBotella) as decimal(6,2)) from ComandaVinos where ComandaVinos.IdComanda = $idComanda " .
                " union" .
                " select CAST (SUM (CantidadCopas*PrecioCopa)as decimal(6,2)) from ComandaVinos where ComandaVinos.IdComanda = $idComanda ";
        $resultado = $objSQL->ConsultarTabla($query);
        $resultado = explode("°", $resultado);
        $suma = 0;

        for ($i = 0; $i < count($resultado) - 1; $i++) {
            $suma += floatval($resultado[$i]);
        }

        return $suma;
    }

    public function ConsultarComandaADetalle($idComanda) {
        
    }

    /**
     * Funcion que regresa el id y folio de la comanda
     * @param type $idComanda
     */
    public function Detalle_Uno($idComanda) {
        $objSQL = new SQL_DML();
        $query = "select Folio from Comanda where Id = $idComanda";
        return $objSQL->ConsultarTabla($query);
    }

    /**
     * Funcion que regresa Id de la mesa,Numero Mesa y Mesa principal 
     * @param type $idComanda
     */
    public function Detalle_Dos($idComanda) {
        $objSQL = new SQL_DML();
        $query = "select ComandaMesas.IdMesa, Mesas.Numero, Mesas.Ubicacion, ComandaMesas.Principal from ComandaMesas
                      join Mesas on Mesas.ID = ComandaMesas.IdMesa where ComandaMesas.IdComanda = $idComanda";
        return $objSQL->ConsultarTabla($query);
    }

    /**
     * Funcion que regresa Importe de la comanda
     * @param type $idComanda
     */
    public function Detalle_Tres($idComanda) {
        $objComanda = new Comanda();
        return $objComanda->ConsultarImporteComanda($idComanda);
    }

    /**
     * Funcion que regresa 
     * @param type $idComanda
     */
    public function Detalle_Cuatro($idComanda) {
        $objSQL = new SQL_DML();
        $query = "select ComandaPlatillos.IdPlatillo,Platillos.Nombre, Cantidad, ComandaPlatillos.Precio, EstadosPedidos.Descripcion as 'Status' from ComandaPlatillos join Platillos " .
                "on Platillos.ID = ComandaPlatillos.IdPlatillo join EstadosPedidos " .
                "on EstadosPedidos.ID = ComandaPlatillos.IdEstado " .
                "where ComandaPlatillos.IdComanda = 1";
        echo $query;
        return $objSQL->ConsultarTabla($query);
    }

    public function Insertar($id_comanda,$folioComanda, $fecha, $idMesero, $arregloMesas, $mesaPrincipal) {
        $objSQL = new SQL_DML();
        $this->Cerrada = 0;
//        $id_comanda = $objSQL->GetScalar("select MAX (ID) as ID from Comanda");
        $bandera = FALSE;
        $query = "insert into Comanda values ($id_comanda,'$folioComanda',$idMesero,'$fecha',1,'', $this->Cerrada)";

        if ($objSQL->Execute($query)) {

            $bandera = true;
        } else {

            $bandera = FALSE;
        }
        //echo $query;

        if ($bandera == TRUE)
            for ($i = 0; $i < count($arregloMesas); $i++) {
                //  echo "<br>Mesas: ".$arregloMesas[$i]."<br>";
                $alterarMesa = "update Mesas set Status = 1 where Mesas.ID = $arregloMesas[$i]";
                $objSQL->Execute($alterarMesa);
                if ($arregloMesas[$i] == $mesaPrincipal) {
                    $insertar = "insert into ComandaMesas values ($id_comanda,$arregloMesas[$i],1)";
                } else {
                    $insertar = "insert into ComandaMesas values ($id_comanda,$arregloMesas[$i],0)";
                }

                if ($objSQL->Execute($insertar)) {
                    $bandera = TRUE;

                    //    echo "<br>Insert: ".$insertar;
                } else {
                    //  echo "<br>Error: ".$insertar;
                    $bandera = FALSE;
                }
            }

        return $bandera;
    }

    public function ConsultarTodo() {
        $con = Conexion();
        $query = "select * from Comanda";
        $comandas = array();
        $valor = sqlsrv_query($con, $query);
        while ($Datos = sqlsrv_fetch_array($valor)) {
            $objComanda = new Comanda();
            $objComanda->Id = $Datos['Id'];
            $objComanda->Folio = $Datos['Folio'];
            $objComanda->IdMesero = $Datos['IdMesero'];
            $objComanda->Fecha = date_format($Datos['Fecha'], 'Y-m-d');
            $objComanda->IdEstado = $Datos['IdEstado'];
            $objComanda->Comentarios = $Datos['Comentarios'];
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }

    public function ConsultarComandasPagadas() {
        $con = Conexion();
        $query = "select * from Comanda where IdEstado = 2 order by Fecha desc";
        $comandas = array();
        $valor = sqlsrv_query($con, $query);
        while ($Datos = sqlsrv_fetch_array($valor)) {
            $objComanda = new Comanda();
            $objComanda->Id = $Datos['Id'];
            $objComanda->Folio = $Datos['Folio'];
            $objComanda->IdMesero = $Datos['IdMesero'];
            $objComanda->Fecha = date_format($Datos['Fecha'], 'Y-m-d');
            $objComanda->IdEstado = $Datos['IdEstado'];
            $objComanda->Comentarios = $Datos['Comentarios'];
            array_push($comandas, $objComanda);
        }
        return $comandas;
    }

    public function ConsultarPorID($ID) {
        $con = Conexion();
        $query = "select Comanda.*,ComandasEstados.Clave from Comanda join ComandasEstados" .
                " on Comanda.IdEstado = ComandasEstados.Id where Comanda.ID = $ID";

        $valor = sqlsrv_query($con, $query);
        $res = false;
        while ($Datos = sqlsrv_fetch_array($valor)) {
            $this->Id = $Datos['Id'];
            $this->Folio = $Datos['Folio'];
            $this->IdMesero = $Datos['IdMesero'];
            $this->Fecha = date_format($Datos['Fecha'], 'Y-m-d');
            $this->IdEstado = $Datos['IdEstado'];
            $this->Comentarios = utf8_encode($Datos['Comentarios']);
            $this->Clave = $Datos['Clave'];
            $this->Cerrada = $Datos['Cerrada'];
            $res = true;
        }

        return $res;
    }

    public function ConsultarMesasLibres() {
        $objSQL = new SQL_DML();
        $query = "select distinct Mesas.ID, Mesas.Numero, Mesas.CantidadPersonas, Mesas.Ubicacion  from Mesas where Mesas.Status is NULL or Mesas.Status = 0";
        return $objSQL->ConsultarTabla($query);
    }

    public function ConsultarPorFolio($Folio) {
        $con = Conexion();
        $this->Folio = $Folio;
        $query = "select * from Comanda where Folio = '$this->Folio'";
        $res = false;
        $valor = sqlsrv_query($con, $query);

        while ($Datos = sqlsrv_fetch_array($valor)) {
            $this->Id = utf8_encode($Datos['Id']);
            $this->Folio = $Datos['Folio'];
            $this->IdMesero = $Datos['IdMesero'];
            $this->Fecha = date_format($Datos['Fecha'], 'Y-m-d');
            $this->IdEstado = $Datos['IdEstado'];
            $this->Comentarios = $Datos['Comentarios'];
            $res = true;
        }
        return $res;
    }

    public function ActualizarCambiarStatus($ID, $Status) {
        $objSQL = new SQL_DML();
        $this->Id = $ID;
        $this->IdEstado = $Status;
        $query = "update Comanda set IdEstado = $this->IdEstado where Id = $this->Id";
        echo $query;
        if ($objSQL->Execute($query)) {
            return true;
        } else
            return FALSE;
    }

    public function CerrarComanda($ID) {
        $objSQL = new SQL_DML();
        $this->Id = $ID;
        $this->IdEstado = $Status;
        $query = "update Comanda set Cerrada = 1 where Id = $this->Id";
        echo $query;
        if ($objSQL->Execute($query)) {
            return true;
        } else
            return FALSE;
    }

}
