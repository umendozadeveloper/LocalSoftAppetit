<?php

include_once  'SQL_DML.php';

class CatalogoMunicipio {
    public $Id_Municipio;
    public $EDO;
    public $MPO;
    public $DESCRIP;
    public $Id_Estado;
    public $Visible;
    private $Conexion;
    

    public function __construct() {
        $this->Visible = 1;
        
    }


    public function ObtenerPorId($Id_Municipio)
    {
        $this->Id_Municipio = $Id_Municipio;
        $this->Conexion = Conexion();        
        $query = "SELECT * FROM CatalogoMunicipio WHERE Id_Municipio = ' $this->Id_Municipio'";
        
        $valor = sqlsrv_query($this->Conexion,$query);
                
         
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->Id_Municipio = utf8_encode($Datos['Id_Municipio']);
            $this->EDO = utf8_encode($Datos['EDO']);
            $this->MPO = utf8_encode($Datos['MPO']);
            $this->DESCRIP = utf8_encode($Datos['DESCRIP']);
            $this->Id_Estado = utf8_encode($Datos['Id_Estado']);
            $this->Visible = utf8_encode($Datos['Visible']);
            
        }
        sqlsrv_close($this->Conexion);
    }
    
    public function ObtenerDisponibles()
    {
        $this->Conexion = Conexion();
        $Municipios = array();
        $query = "SELECT * FROM CatalogoMunicipio WHERE Visible = 1";
        
        $valor = sqlsrv_query($this->Conexion,$query);
                
         
        while($Datos = sqlsrv_fetch_array($valor)){
            $municipios = new CatalogoMunicipio();
            $municipios->Id_Municipio = utf8_encode($Datos['Id_Municipio']);
            $municipios->Id_Estado = utf8_encode($Datos['Id_Estado']);
            $municipios->MPO = utf8_encode($Datos['MPO']);
            $municipios->EDO = utf8_encode($Datos['EDO']);
            $municipios->DESCRIP = utf8_encode($Datos['DESCRIP']);
            $municipios->Visible = utf8_encode($Datos['Visible']);
            
            array_push($Municipios, $municipios);
            
        }
        sqlsrv_close($this->Conexion);
        return $Municipios;
        
    }


    public function ObtenerTodo()
    {
        $this->Conexion = Conexion();
        $Municipios = array();
        $query = "SELECT * FROM CatalogoMunicipio";
        
        $valor = sqlsrv_query($this->Conexion,$query);
                
         
        while($Datos = sqlsrv_fetch_array($valor)){
            $municipios = new CatalogoMunicipio();
            $municipios->Id_Municipio = utf8_encode($Datos['Id_Municipio']);
            $municipios->Id_Estado = utf8_encode($Datos['Id_Estado']);
            $municipios->MPO = utf8_encode($Datos['MPO']);
            $municipios->EDO = utf8_encode($Datos['EDO']);
            $municipios->DESCRIP = utf8_encode($Datos['DESCRIP']);
            $municipios->Visible = utf8_encode($Datos['Visible']);
            
            array_push($Municipios, $municipios);
           
        }
        sqlsrv_close($this->Conexion);
        return $Municipios;
    }
    
    
    
    public function ConsultarPorIdEstado($Id_Estado){
        
        $this->Conexion = Conexion();
        $this->Id_Estado = $Id_Estado;
        $Municipios = array();
        
        $query = "SELECT CatalogoMunicipio.Id_Estado, CatalogoMunicipio.DESCRIP,
                CatalogoMunicipio.Id_Municipio, 
                CatalogoMunicipio.MPO,CatalogoMunicipio.EDO,
                CatalogoMunicipio.Visible FROM CatalogoMunicipio JOIN
                 CatalogoEstado ON CatalogoEstado.Id_Estado = CatalogoMunicipio.Id_Estado
                WHERE CatalogoEstado.Id_Estado = '$this->Id_Estado'";
        
        $valor = sqlsrv_query($this->Conexion,$query);
                
         
        while($Datos = sqlsrv_fetch_array($valor)){
            $municipios = new CatalogoMunicipio();
            $municipios->Id_Municipio = utf8_encode($Datos['Id_Municipio']);
            $municipios->Id_Estado = utf8_encode($Datos['Id_Estado']);
            $municipios->MPO = utf8_encode($Datos['MPO']);
            $municipios->EDO = utf8_encode($Datos['EDO']);
            $municipios->DESCRIP = utf8_encode($Datos['DESCRIP']);
            $municipios->Visible = utf8_encode($Datos['Visible']);
            
            array_push($Municipios, $municipios);
            
        }
        sqlsrv_close($this->Conexion);
        return $Municipios;
        
    }
    

    
    
    public function Agregar($EDO, $MPO, $DESCRIP, $Id_Estado)
    {
        
        $this->MPO = $MPO;
        $this->Id_Estado = $Id_Estado;
        $this->EDO = $EDO;
        $this->DESCRIP = $DESCRIP;
        $this->Visible = 1;
        
        $this->Conexion = ew_Connect();
        $query = "INSERT INTO `catalogo_municipio`(EDO, MPO, DESCRIP, Id_Estado, Visible)"
                . "VALUES "
                . "('".  ew_AdjustSql($this->EDO)."',"
                . "'".  ew_AdjustSql($this->MPO)."',"
                . "'".  ew_AdjustSql($this->DESCRIP)."',"
                . "'".  ew_AdjustSql($this->Id_Estado)."',"
                . "'".  ew_AdjustSql($this->Visible)."')";
        
        $this->Conexion->Execute($query);
        $this->Id_Municipio = $this->Conexion->Insert_ID();
        
        return $this->Id_Municipio;
    }
    
    
    public function Modificar($Id_Municipio, $EDO, $MPO, $DESCRIP, $Id_Estado, $Visible = 1)
    {
        $this->ObtenerPorId($Id_Municipio);
        $this->MPO = $MPO;
        $this->EDO = $EDO;
        $this->DESCRIP = $DESCRIP;
        $this->Visible = 1;
        $retorno = FALSE;
        
        if($this->Id_Municipio)
        {
            $this->Conexion = ew_Connect();
            $query = "UPDATE `catalogo_municipio` SET "
                    . "MPO = '".  ew_AdjustSql($this->MPO)."',"
                    . "Id_Estado = '".  ew_AdjustSql($this->Id_Estado)."',"
                    . "EDO = '".  ew_AdjustSql($this->EDO)."',"
                    . "DESCRIP = '".  ew_AdjustSql($this->DESCRIP)."',"
                    . "Visible = '".  ew_AdjustSql($this->Visible)."' "
                    . "WHERE Id_Municipio = '".  ew_AdjustSql($this->Id_Municipio)."'";
            $retorno = $this->Conexion->Execute($query);
            $this->CierraConexion();
            $this->bitacora->RegistrarActividad($this->seguridad->CurrentUserID(),
                        basename($_SERVER['PHP_SELF']), 
                         $query, ew_CurrentUserIP());
        }
        return $retorno;
    }


    public function BorradoLogico($Id_Municipio)
    {
        $this->ObtenerPorId($Id_Municipio);
        $this->Visible = 0;
        
        $retorno = false;
        
        if($this->Id_Municipio)
        {
            $this->Conexion = ew_Connect();
            $query = "UPDATE `catalogo_municipio` SET `Visible` = '".ew_AdjustSql($this->Visible)."'"
                    . " WHERE `Id_Municipio` = '".  ew_AdjustSql($this->Id_Municipio)."'";
            $retorno = $this->Conexion->Execute($query);
            
            $this->CierraConexion();
        }
        $this->bitacora->RegistrarActividad($this->seguridad->CurrentUserID(),
                        basename($_SERVER['PHP_SELF']), 
                         $query, ew_CurrentUserIP());
        return $retorno;
    }
    
    public function BorradoFisico($Id_Municipio)
    {
        $this->ObtenerPorId($Id_Municipio);
        $this->Visible = 0;
        
        $retorno = false;
        
        if($this->Id_Municipio)
        {
            $this->Conexion = ew_Connect();
            $query = "DELETE FROM `catalogo_municipio`"
                    . " WHERE `Id_Municipio` = '".  ew_AdjustSql($this->Id_Municipio)."'";
            $retorno = $this->Conexion->Execute($query);
            $this->CierraConexion();
            
        }
        $this->bitacora->RegistrarActividad($this->seguridad->CurrentUserID(),
                        basename($_SERVER['PHP_SELF']), 
                         $query, ew_CurrentUserIP());
        return $retorno;
    }
    
    
   
    
    
    
}
