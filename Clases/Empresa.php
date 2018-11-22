<?php
include_once  'SQL_DML.php';

class Empresa{
    public $ID;
    public $NombreComercial;
    public $RazonSocial;
    public $RFC;
    public $Calle;
    public $Colonia;
    public $NumeroInterior;
    public $NumeroExterior;
    public $CodigoPostal;
    public $Telefono;
    public $Correo;
    public $PaginaWeb;    
    public $Eslogan;
    public $RegimenFiscal;
    
    public $ColorFondoBoton;
    public $ColorTextoBoton;
    public $ColorFondoBarra;
    public $ColorTextoBarra;
    public $Logo;
    public $NombreAplicacion;
    
    public $Password;
    
    public $FondoAdministrador;
    public $FondoComensal;
    public $FondoMesero;
    public $TonoCocina;
    public $TextoBienvenidaVIP;
    public $TextoBienvenidaChef;
    
    public $Pais;
    public $IdEstado;
    public $IdMunicipio;


    public function ObtenerPorID($ID){
        $con = Conexion();
        $this->ID = $ID;
        $query = "select * from Empresa where ID = '$this->ID'";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->NombreComercial = utf8_encode($Datos['NombreComercial']);
            $this->RazonSocial =  utf8_encode($Datos['RazonSocial']);
            $this->RFC =  utf8_encode($Datos['RFC']);
            $this->Calle =  utf8_encode($Datos['Calle']);
            $this->Colonia =  utf8_encode($Datos['Colonia']);
            $this->NumeroInterior =  utf8_encode($Datos['NumeroInterior']);
            $this->NumeroExterior =  utf8_encode($Datos['NumeroExterior']);
            $this->CodigoPostal =  utf8_encode($Datos['CodigoPostal']);
            $this->Telefono =  utf8_encode($Datos['Telefono']);
            $this->Correo =  utf8_encode($Datos['Correo']);
            $this->PaginaWeb =  utf8_encode($Datos['PaginaWeb']);
            $this->Logo =  utf8_encode($Datos['Logo']);
            $this->Eslogan =  utf8_encode($Datos['Eslogan']);
            $this->RegimenFiscal =  utf8_encode($Datos['RegimenFiscal']);
            $this->NombreAplicacion =  utf8_encode($Datos['NombreAplicacion']);
            $this->ColorFondoBoton = utf8_encode($Datos['ColorFondoBoton']);
            $this->ColorTextoBoton = utf8_encode($Datos['ColorTextoBoton']);
            $this->ColorFondoBarra= utf8_encode($Datos['ColorFondoBarra']);
            $this->ColorTextoBarra= utf8_encode($Datos['ColorTextoBarra']);
            $this->Password = utf8_encode($Datos['Password']);
            $this->FondoAdministrador = (utf8_encode($Datos['FondoAdministrador']));
            $this->FondoComensal = (utf8_encode($Datos['FondoComensal']));
            $this->FondoMesero = (utf8_encode($Datos['FondoMesero']));
            $this->TonoCocina = (utf8_encode($Datos['TonoCocina']));
            $this->TextoBienvenidaChef = (utf8_encode($Datos['TextoBienvenidaChef']));
            $this->TextoBienvenidaVIP = (utf8_encode($Datos['TextoBienvenidaVIP']));
            $this->Pais = utf8_encode($Datos['Pais']);
            $this->IdEstado = $Datos['IdEstado'];
            $this->IdMunicipio = $Datos['IdMunicipio'];
        }
        sqlsrv_close($con);        
    }

    public function EditarEmpresa($ID,$NombreComercial,$RazonSocial,
            $RFC,$Calle,$Colonia,$NumeroInterior,$NumeroExterior,
            $CodigoPostal,$Telefono,$Correo,$PaginaWeb,$Eslogan, $RegimenFiscal, $Password, $id_estado, $id_municipio, $pais){
        $this->ID = $ID;
        $this->NombreComercial = $NombreComercial;
        $this->RazonSocial = $RazonSocial;
        $this->RFC = $RFC;
        $this->Calle = $Calle;
        $this->Colonia = $Colonia;
        $this->NumeroInterior = $NumeroInterior;
        $this->NumeroExterior = $NumeroExterior;
        $this->CodigoPostal = $CodigoPostal;
        $this->Telefono = $Telefono;
        $this->Correo = $Correo;
        $this->PaginaWeb = $PaginaWeb;
        $this->Eslogan = $Eslogan;
        $this->RegimenFiscal = $RegimenFiscal;
        $this->Password = $Password;
        $this->IdEstado = $id_estado;
        $this->IdMunicipio = $id_municipio;
        $this->Pais = $pais;
        
        $objSQL = new SQL_DML();
        $query = "UPDATE Empresa SET ".
                "[NombreComercial] = '$this->NombreComercial'" .
                ",[RazonSocial] = '$this->RazonSocial'".
                ",[RFC] = '$this->RFC'".
                ",[Calle] = '$this->Calle'".
                ",[Colonia] = '$this->Colonia'".
                ",[NumeroInterior] = '$this->NumeroInterior'".
                ",[NumeroExterior] = '$this->NumeroExterior'".
                ",[CodigoPostal] = '$this->CodigoPostal'".
                ",[Telefono] = '$this->Telefono'".
                ",[Correo] = '$this->Correo'".
                ",[PaginaWeb] = '$this->PaginaWeb'".
                ",[Eslogan] = '$this->Eslogan'".
                ",[RegimenFiscal] = '$this->RegimenFiscal' ".
               ",[Password] = '$this->Password'".
               ",[IdEstado] = '$this->IdEstado'".
               ",[IdMunicipio] = '$this->IdMunicipio'".
                ",[Pais] = '$this->Pais'".
                " WHERE ID = 1";
        echo $query;
        if($objSQL->Execute($query)){
            return true;
        }
        else{
            return FALSE;
        }
    }
    
    public function EditarApp($NombreAplicacion,$Logo,$ColorFondoBoton,
            $ColorTextoBoton,$ColorFondoBarra,$ColorTextoBarra,$ID=1){
        $this->ID = $ID;
        $this->Logo = $Logo;
        $this->NombreAplicacion = $NombreAplicacion;
        $this->ColorFondoBoton = $ColorFondoBoton;
        $this->ColorTextoBoton=$ColorTextoBoton;
        $this->ColorTextoBarra = $ColorTextoBarra;
        $this->ColorFondoBarra=$ColorFondoBarra;
        
        
        $objSQL = new SQL_DML();
        $query = "UPDATE Empresa SET ".
                "[ColorFondoBoton] = '$this->ColorFondoBoton'" .                
                ",[ColorTextoBoton] = '$this->ColorTextoBoton'" .
                ",[ColorTextoBarra] = '$this->ColorTextoBarra'" .
                ",[ColorFondoBarra] = '$this->ColorFondoBarra'" .
                ",[Logo] = '$this->Logo'".
                ",[NombreAplicacion] = '$this->NombreAplicacion'".
                " WHERE ID = 1";
        echo $query;
        if($objSQL->Execute($query)){
            return true;
        }
        else{
            return FALSE;
        }
    }
    
    Public function ObtenerRegimenFiscal($ID){
        $con = Conexion();
        $this->ID = $ID;
        $query = "select RegimenFiscal from Empresa where ID = '$this->ID'";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->RegimenFiscal = utf8_encode($Datos['RegimenFiscal']);
        }    
        return $this->RegimenFiscal;
    }
    
    public function EditarNotificacion($Notifificacion){
        $obSQL = new SQL_DML();
        $this->TonoCocina = $Notifificacion;
        $query = "UPDATE Empresa SET Empresa.TonoCocina = '$this->TonoCocina' WHERE ID = '1'";
        //echo $query;
        return $obSQL->Execute($query);
    }
    
    
    public function EditarTextoBienvenidaChef($TextoBienvenidaChef){
        $objSQL = new SQL_DML();
        $this->TextoBienvenidaChef = $TextoBienvenidaChef;
        $query = "Update Empresa set TextoBienvenidaChef ='$this->TextoBienvenidaChef' where ID='1'";
        //echo $query;
        return $objSQL->Execute($query);
    }
    
    public function EditarTextoBienvenidaVIP($TextoBienvenidaVIP){
        $objSQL = new SQL_DML();
        $this->TextoBienvenidaVIP = $TextoBienvenidaVIP;
        $query = "Update Empresa set TextoBienvenidaVIP ='$this->TextoBienvenidaVIP' where ID='1'";
        //echo $query;
        return $objSQL->Execute($query);
    }
    
    public function EditarFondos($FondoAdministrador,$FondoComensal, $FondoMesero,$Logo){
        $this->FondoAdministrador = $FondoAdministrador;
        $this->FondoComensal = $FondoComensal;
        $this->FondoMesero = $FondoMesero;
        $this->Logo = $Logo;
        
        $objSQL = new SQL_DML();
        $query = "UPDATE Empresa set FondoAdministrador = '$this->FondoAdministrador', "
                . "FondoComensal = '$this->FondoComensal', "
                . "Logo = '$this->Logo', "
                . "FondoMesero = '$this->FondoMesero' where ID = 1";
        return $objSQL->Execute($query);
    }
}//clase


?>