<?php

include_once  'SQL_DML.php';

class CatalogoEstado {

    public $Id_Estado;
    public $EDO;
    public $DESCRIP;
    public $Visible;
    private $Conexion;
    

    public function Catalogo_Estados() {
        $this->Visible = 1;
        
    }
    

    public function ObtenerPorId($Id_Estado) {
        $this->Id_Estado = $Id_Estado;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM CatalogoEstado WHERE Id_Estado = ' $this->Id_Estado '";

        $valor = sqlsrv_query($this->Conexion,$query);

        
         while($Datos = sqlsrv_fetch_array($valor)){
            $this->Id_Estado = utf8_encode($Datos['Id_Estado']);
            $this->EDO = utf8_encode($Datos['EDO']);
            $this->DESCRIP = utf8_encode($Datos['DESCRIP']);
            $this->Visible = utf8_encode($Datos['Visible']);

            
        } 
        sqlsrv_close($this->Conexion);
    }

    public function ObtenerDisponibles() {
        $this->Conexion = Conexion();
        $Estados = array();
        $query = "SELECT * FROM CatalogoEstado WHERE Visible = 1";

         $valor = sqlsrv_query($this->Conexion,$query);
        
        while($Datos = sqlsrv_fetch_array($valor)){
            $estados = new CatalogoEstado();
            $estados->Id_Estado = utf8_encode($Datos['Id_Estado']);
            $estados->EDO = utf8_encode($Datos['EDO']);
            $estados->DESCRIP = utf8_encode($Datos['DESCRIP']);
            $estados->Visible = utf8_encode($Datos['Visible']);

            array_push($Estados, $estados);
            
        }
        sqlsrv_close($this->Conexion);
        return $Estados;
    }

    public function ObtenerTodo() {
        $this->Conexion = Conexion();
        $Estados = array();
        $query = "SELECT * FROM CatalogoEstado";

        $valor = sqlsrv_query($this->Conexion,$query);
        
        while($Datos = sqlsrv_fetch_array($valor)){
            $estados = new Catalogo_Estados();
            $estados->Id_Estado = utf8_encode($Datos['Id_Estado']);
            $estados->EDO = utf8_encode($Datos['EDO']);
            $estados->DESCRIP = utf8_encode($Datos['DESCRIP']);
            $estados->Visible = utf8_encode($Datos['Visible']);

            array_push($Estados, $estados);
            
        }
        sqlsrv_close($this->Conexion);
        return $Estados;
    }

    public function Agregar($EDO, $DESCRIP) {
        $this->EDO = $EDO;
        $this->DESCRIP = $DESCRIP;
        $this->Visible = 1;

        $this->Conexion = ew_Connect();
        $query = "INSERT INTO `catalogo_estado`(Id_Estado, EDO, DESCRIP, Visible)"
                . "VALUES "
                . "('" . ew_AdjustSql($this->Id_Estado) . "',"
                . "'" . ew_AdjustSql($this->EDO) . "',"
                . "'" . ew_AdjustSql($this->DESCRIP) . "',"
                . "'" . ew_AdjustSql($this->Visible) . "')";

        $this->Conexion->Execute($query);
        $this->Id_Estado = $this->Conexion->Insert_ID();
        $this->CierraConexion();
        $this->bitacora->RegistrarActividad($this->seguridad->CurrentUserID(), basename($_SERVER['PHP_SELF']), $query, ew_CurrentUserIP());
        return $this->Id_Estado;
    }

    public function Modificar($Id_Estado, $EDO, $DESCRIP, $Visible = 1) {
        $this->ObtenerPorId($Id_Estado);
        $this->EDO = $EDO;
        $this->DESCRIP = $DESCRIP;
        $this->Visible = 1;
        $retorno = FALSE;

        if ($this->Id_Estado) {
            $this->Conexion = ew_Connect();
            $query = "UPDATE `catalogo_estado` SET "
                    . "EDO = '" . ew_AdjustSql($this->EDO) . "',"
                    . "DESCRIP = '" . ew_AdjustSql($this->DESCRIP) . "',"
                    . "Visible = '" . ew_AdjustSql($this->Visible) . "' "
                    . "WHERE Id_Estado = '" . ew_AdjustSql($this->Id_Estado) . "'";
            $retorno = $this->Conexion->Execute($query);
            $this->CierraConexion();
            $this->bitacora->RegistrarActividad($this->seguridad->CurrentUserID(), basename($_SERVER['PHP_SELF']), $query, ew_CurrentUserIP());
        }
        return $retorno;
    }

    public function BorradoLogico($Id_Estado) {
        $this->ObtenerPorId($Id_Estado);
        $this->Visible = 0;

        $retorno = false;

        if ($this->Id_Estado) {
            $this->Conexion = ew_Connect();
            $query = "UPDATE `catalogo_estado` SET `Visible` = '" . ew_AdjustSql($this->Visible) . "'"
                    . " WHERE `Id_Estado` = '" . ew_AdjustSql($this->Id_Estado) . "'";
            $retorno = $this->Conexion->Execute($query);
            $this->CierraConexion();
        }
        $this->bitacora->RegistrarActividad($this->seguridad->CurrentUserID(), basename($_SERVER['PHP_SELF']), $query, ew_CurrentUserIP());
        return $retorno;
    }

    public function BorradoFisico($Id_Estado) {
        $this->ObtenerPorId($Id_Estado);
        $this->Visible = 0;

        $retorno = false;

        if ($this->Id_Estado) {
            $this->Conexion = ew_Connect();
            $query = "DELETE FROM `catalogo_estado`"
                    . " WHERE `Id_Estado` = '" . ew_AdjustSql($this->Id_Estado) . "'";
            $retorno = $this->Conexion->Execute($query);
            $this->CierraConexion();
        }
        $this->bitacora->RegistrarActividad($this->seguridad->CurrentUserID(), basename($_SERVER['PHP_SELF']), $query, ew_CurrentUserIP());
        return $retorno;
    }

    

}
