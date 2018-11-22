<?php

include_once  'SQL_DML.php';

class ConfiguracionFacturas {
    
    public $ID;
    public $SerieFolios;
    public $ConsecutivoInicio;
    public $ConsecutivoFinal;
    public $ConceptoDescripcion;
    public $IdUnidad;
    public $IdMoneda;
    public $ArchivoCER;
    public $ArchivoKEY;
    public $Pass;
    public $NumeroCertificado;
    public $IVA;
    private $Conexion;
    public $Certificado;
    public $VigenciaInicio;
    public $VigenciaFin;
    
 
    
    
    public function Agregar($SerieFolios, $ConsecutivoInicio,
            $ConsecutivoFinal, $ConceptoDescripcion, $IdUnidad,
            $IdMoneda, $ArchivoCER, $ArchivoKEY, $Pass, $NumeroCertificado,
            $Certificado, $VigenciaInicio, $VigenciaFin, $IVA)

    {
        $this->ID = 1;
        $this->SerieFolios = $SerieFolios;
        $this->ConsecutivoInicio = $ConsecutivoInicio;
        $this->ConsecutivoFinal = $ConsecutivoFinal;
        $this->ConceptoDescripcion = $ConceptoDescripcion;
        $this->IdUnidad = $IdUnidad;
        $this->IdMoneda = $IdMoneda;
        $this->ArchivoCER = $ArchivoCER;
        $this->ArchivoKEY = $ArchivoKEY;
        $this->Pass = $Pass;
        if($NumeroCertificado != NULL)
        {
        $this->NumeroCertificado = $NumeroCertificado;
        }
        else 
        {
            $this->NumeroCertificado = 1;
        }
        $this->Certificado = $Certificado;
        $this->VigenciaInicio = $VigenciaInicio;
        $this->VigenciaFin = $VigenciaFin;
        $this->IVA = $IVA;
        
        
        $objSQL = new SQL_DML();
        $query = "INSERT INTO ConfiguracionFacturas "
                . "("
                . "ID"
                . ",SerieFolios"
                . ",ConsecutivoInicio"
                . ",ConsecutivoFinal"
                . ",ConceptoDescripcion"
                . ",IdUnidad"
                . ",IdMoneda"
                . ",ArchivoCER"
                . ",ArchivoKEY"
                . ",Pass"
                . ",NumeroCertificado, VigenciaInicio, VigenciaFin, IVA) "
                . " VALUES "
                . "("
                . "'$this->ID'"
                . ",'$this->SerieFolios'"
                . ",'$this->ConsecutivoInicio'"
                . ",'$this->ConsecutivoFinal'"
                . ",'$this->ConceptoDescripcion'"
                . ",'$this->IdUnidad'"
                . ",'$this->IdMoneda'"
                . ",'$this->ArchivoCER'"
                . ",'$this->ArchivoKEY'"
                . ",'$this->Pass'"
                . ",'$this->NumeroCertificado', '$this->VigenciaInicio', '$this->VigenciaFin', "
                . "'$this->IVA')";
        
        if($objSQL->Execute($query))
        {
            return true;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function EditarSinArchivos($SerieFolios, $ConsecutivoInicio, $ConsecutivoFinal, $ConceptoDescripcion,
            $IdUnidad, $IdMoneda, $IVA)
    {
        $this->ID = 1;
        $this->SerieFolios = $SerieFolios;
        $this->ConsecutivoInicio = $ConsecutivoInicio;
        $this->ConsecutivoFinal = $ConsecutivoFinal;
        $this->ConceptoDescripcion = $ConceptoDescripcion;
        $this->IdUnidad = $IdUnidad;
        $this->IdMoneda = $IdMoneda;
        $this->IVA = $IVA;
        $this->RFCGlobal = $RFCGlobal;
        
        $objSQL = new SQL_DML();
        $query = "UPDATE ConfiguracionFacturas SET "
                . "SerieFolios = '$this->SerieFolios'"
                . ",ConsecutivoInicio = '$this->ConsecutivoInicio'"
                . ",ConsecutivoFinal = '$this->ConsecutivoFinal'"
                . ",ConceptoDescripcion = '$this->ConceptoDescripcion'"
                . ",IdUnidad = '$this->IdUnidad'"
                . ",IdMoneda = '$this->IdMoneda'"
                . ",IVA = '$this->IVA'"
                . " WHERE ID = '$this->ID'";
        echo $query;
        if($objSQL->Execute($query))
        {
            echo "<script>alert('entró');</script>";
            return TRUE;
        }
        else
        {
            echo "<script>alert('no entró');</script>";
            return FALSE;
        }
        
    }
    
    
    public function Editar($SerieFolios, $ConsecutivoInicio,
            $ConsecutivoFinal, $ConceptoDescripcion, $IdUnidad,
            $IdMoneda, $ArchivoCER, $ArchivoKEY, $Pass, $NumeroCertificado, 
            $Certificado, $VigenciaInicio, $VigenciaFin, $IVA)

    {
        $this->ID = 1;
        $this->SerieFolios = $SerieFolios;
        $this->ConsecutivoInicio = $ConsecutivoInicio;
        $this->ConsecutivoFinal = $ConsecutivoFinal;
        $this->ConceptoDescripcion = $ConceptoDescripcion;
        $this->IdUnidad = $IdUnidad;
        $this->IdMoneda = $IdMoneda;
        $this->ArchivoCER = $ArchivoCER;
        $this->ArchivoKEY = $ArchivoKEY;
        $this->Pass = $Pass;
        $this->NumeroCertificado = $NumeroCertificado;
        $this->IVA = $IVA;
        $this->VigenciaInicio = $VigenciaInicio;
        $this->VigenciaFin = $VigenciaFin;
        $this->Certificado = $Certificado;
        
        
        $objSQL = new SQL_DML();
        $query = "UPDATE ConfiguracionFacturas SET "
                . "SerieFolios = '$this->SerieFolios'"
                . ",ConsecutivoInicio = '$this->ConsecutivoInicio'"
                . ",ConsecutivoFinal = '$this->ConsecutivoFinal'"
                . ",ConceptoDescripcion = '$this->ConceptoDescripcion'"
                . ",IdUnidad = '$this->IdUnidad'"
                . ",IdMoneda = '$this->IdMoneda'"
                . ",ArchivoCER = '$this->ArchivoCER'"
                . ",ArchivoKEY = '$this->ArchivoKEY'"
                . ",Pass = '$this->Pass'"
                . ",NumeroCertificado = '$this->NumeroCertificado', Certificado = '$this->Certificado', "
                . "VigenciaInicio='$this->VigenciaInicio', VigenciaFin='$this->VigenciaFin'"
                . ",IVA = '$this->IVA'"
                
                . " WHERE ID = '$this->ID'";
        echo $query;
        if($objSQL->Execute($query))
        {
            echo "<script>alert('entró');</script>";
            return TRUE;
        }
        else
        {
            echo "<script>alert('no entró');</script>";
            return FALSE;
        }
    }
    
    public function ObtenerTodo()
    {
        $this->Conexion = Conexion();
        $query = "SELECT * FROM ConfiguracionFacturas";
        $valor = sqlsrv_query($this->Conexion, $query);
        $Configuraciones = array();
        
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $objConf = new ConfiguracionFacturas();
            $objConf->ID = utf8_encode($Datos['ID']);
            $objConf->SerieFolios = utf8_encode($Datos['SerieFolios']);
            $objConf->ConsecutivoInicio = utf8_encode($Datos['ConsecutivoInicio']);
            $objConf->ConsecutivoFinal = utf8_encode($Datos['ConsecutivoFinal']);
            $objConf->ConceptoDescripcion = utf8_encode($Datos['ConceptoDescripcion']);
            $objConf->IdUnidad = utf8_encode($Datos['IdUnidad']);
            $objConf->IdMoneda = utf8_encode($Datos['IdMoneda']);
            $objConf->ArchivoCER = utf8_encode($Datos['ArchivoCER']);
            $objConf->ArchivoKEY = utf8_encode($Datos['ArchivoKEY']);
            $objConf->Pass = utf8_encode($Datos['Pass']);
            $objConf->NumeroCertificado = utf8_encode($Datos['NumeroCertificado']);
            $objConf->Certificado = $Datos['Certificado'];
            $objConf->VigenciaInicio = $Datos['VigenciaInicio'];
            $objConf->VigenciaFin = $Datos['VigenciaFin'];
            $objConf->IVA = utf8_encode($Datos['IVA']);
            
            array_push($Configuraciones, $objConf);
        }
        sqlsrv_close($this->Conexion);
    return $Configuraciones;
        
    }
    
    public function ObtenerPorId($ID)
    {
        $resultado = FALSE;
        $this->ID = $ID;
        $this->Conexion = Conexion();
        $query = "SELECT * FROM ConfiguracionFacturas WHERE ID = '$this->ID'";
        $valor = sqlsrv_query($this->Conexion,$query);
        
        while ($Datos = sqlsrv_fetch_array($valor))
        {
            $this->ID = utf8_encode($Datos['ID']);
            $this->SerieFolios = utf8_encode($Datos['SerieFolios']);
            $this->ConsecutivoInicio = utf8_encode($Datos['ConsecutivoInicio']);
            $this->ConsecutivoFinal = utf8_encode($Datos['ConsecutivoFinal']);
            $this->ConceptoDescripcion = utf8_encode($Datos['ConceptoDescripcion']);
            $this->IdUnidad = utf8_encode($Datos['IdUnidad']);
            $this->IdMoneda = utf8_encode($Datos['IdMoneda']);
            $this->ArchivoCER = utf8_encode($Datos['ArchivoCER']);
            $this->ArchivoKEY = utf8_encode($Datos['ArchivoKEY']);
            $this->Pass = utf8_encode($Datos['Pass']);
            $this->NumeroCertificado = utf8_encode($Datos['NumeroCertificado']);
            $this->Certificado = $Datos['Certificado'];
            $this->VigenciaInicio = $Datos['VigenciaInicio'];
            $this->VigenciaFin = $Datos['VigenciaFin'];
            $this->IVA = utf8_encode($Datos['IVA']);
            
            $resultado = TRUE;
        }
        sqlsrv_close($this->Conexion);
        return $resultado;
    }
}
