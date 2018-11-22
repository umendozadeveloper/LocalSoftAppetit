<?php

include_once 'SQL_DML.php';

class ClientesFacturas {

    public $ID;
    public $NombreCliente;
    public $RFC;
    public $Calle;
    public $Colonia;
    public $NumeroInterior;
    public $NumeroExterior;
    public $CodigoPostal;
    public $Correo;
    public $Telefono;
    public $Pais;
    public $IdEstado;
    public $IdMunicipio;
    public $DatosContacto;
    public $Observaciones;
    public $Estatus;

    public function obtenerPorID($ID) {
        $con = Conexion();
        $this->ID = $ID;
        $query = "SELECT * FROM ClientesFacturas WHERE ID = '$this->ID'";
        $valor = sqlsrv_query($con, $query);
        while ($Datos = sqlsrv_fetch_array($valor)) {
            $this->NombreCliente = utf8_encode($Datos['NombreCliente']);
            $this->RFC = utf8_encode($Datos['RFC']);
            $this->Calle = utf8_encode($Datos['Calle']);
            $this->Colonia = utf8_encode($Datos['Colonia']);
            $this->NumeroInterior = utf8_encode($Datos['NumeroInterior']);
            $this->NumeroExterior = utf8_encode($Datos['NumeroExterior']);
            $this->CodigoPostal = utf8_encode($Datos['CodigoPostal']);
            $this->Correo = utf8_encode($Datos['Correo']);
            $this->Telefono = utf8_encode($Datos['Telefono']);
            $this->Pais = utf8_encode($Datos['Pais']);
            $this->IdEstado = utf8_encode($Datos['IdEstado']);
            $this->IdMunicipio = utf8_encode($Datos['IdMunicipio']);
            $this->DatosContacto = utf8_encode($Datos['DatosContacto']);
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Estatus = utf8_encode($Datos['Status']);
        }
        sqlsrv_close($con);
    }

    public function Agregar($id,$NombreCliente, $RFC, $Calle, $Colonia, 
            $NumeroInterior, $NumeroExterior, $CodigoPostal, $Correo,
            $Telefono, $Pais, $IdEstado, $IdMunicipio, $DatosContacto, $Observaciones, $estatus) {
        $con = Conexion();
        $objSQL = new SQL_DML();
//        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from ClientesFacturas");

        $this->NombreCliente = $NombreCliente;
        $this->RFC = $RFC;
        $this->Calle = $Calle;
        $this->Colonia = $Colonia;
        $this->NumeroInterior = $NumeroInterior;
        $this->NumeroExterior = $NumeroExterior;
        $this->CodigoPostal = $CodigoPostal;
        $this->Correo = $Correo;
        $this->Telefono = $Telefono;
        $this->Pais = $Pais;
        $this->IdEstado = $IdEstado;
        $this->IdMunicipio = $IdMunicipio;
        $this->DatosContacto = $DatosContacto;
        $this->Observaciones = $Observaciones;
        $this->ID = $id;
        $this->Estatus = $estatus;
                

        $query = "INSERT INTO ClientesFacturas"
                . "([ID],[RFC]"
                . ",[NombreCliente]"
                . ",[Calle]"
                . ",[Colonia]"
                . ",[NumeroInterior]"
                . ",[NumeroExterior]"
                . ",[CodigoPostal]"
                . ",[Correo]"
                . ",[Telefono]"
                . ",[Pais]"
                . ",[IdEstado]"
                . ",[IdMunicipio]"
                . ",[DatosContacto]"
                . ",[Observaciones]"
                . ",[Status])"
                . " VALUES ("
                . " $this->ID, '$this->RFC', "
                . " '$this->NombreCliente', "
                . " '$this->Calle', "
                . " '$this->Colonia', "
                . " '$this->NumeroInterior', "
                . " '$this->NumeroExterior', "
                . " '$this->CodigoPostal', "
                . " '$this->Correo', "
                . " '$this->Telefono', "
                . " '$this->Pais', "
                . " '$this->IdEstado', "
                . " '$this->IdMunicipio', "
                . " '$this->DatosContacto', "
                . " '$this->Observaciones', "
                . " '$this->Estatus')";


        if ($objSQL->Execute($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerPorRFC($RFC) {
        $con = Conexion();
        $this->RFC = $RFC;
        $query = "SELECT * FROM ClientesFacturas WHERE RFC = '$this->RFC'";
        $valor = sqlsrv_query($con, $query);
        while ($Datos = sqlsrv_fetch_array($valor)) {
            $this->ID = utf8_encode($Datos['ID']);
            $this->RFC = utf8_encode($Datos['RFC']);
            $this->NombreCliente = utf8_encode($Datos['NombreCliente']);
            $this->Calle = utf8_encode($Datos['Calle']);
            $this->Colonia = utf8_encode($Datos['Colonia']);
            $this->NumeroInterior = utf8_encode($Datos['NumeroInterior']);
            $this->NumeroExterior = utf8_encode($Datos['NumeroExterior']);
            $this->CodigoPostal = utf8_encode($Datos['CodigoPostal']);
            $this->Correo = utf8_encode($Datos['Correo']);
            $this->Telefono = utf8_encode($Datos['Telefono']);
            $this->Pais = utf8_encode($Datos['Pais']);
            $this->IdEstado = utf8_encode($Datos['IdEstado']);
            $this->IdMunicipio = utf8_encode($Datos['IdMunicipio']);
            $this->DatosContacto = utf8_encode($Datos['DatosContacto']);
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Estatus = utf8_encode($Datos['Status']);
        }
        sqlsrv_close($con);
    }

    public function obtenerTodo() {
        $con = Conexion();
        $Clientes = array();
        $query = "SELECT * FROM ClientesFacturas ";
        $valor = sqlsrv_query($con, $query);
        while ($Datos = sqlsrv_fetch_array($valor)) {
            $objClientes = new ClientesFacturas();
            $objClientes->ID = utf8_encode($Datos['ID']);
            $objClientes->RFC = utf8_encode($Datos['RFC']);
            $objClientes->NombreCliente = utf8_encode($Datos['NombreCliente']);
            $objClientes->Calle = utf8_encode($Datos['Calle']);
            $objClientes->Colonia = utf8_encode($Datos['Colonia']);
            $objClientes->NumeroInterior = utf8_encode($Datos['NumeroInterior']);
            $objClientes->NumeroExterior = utf8_encode($Datos['NumeroExterior']);
            $objClientes->CodigoPostal = utf8_encode($Datos['CodigoPostal']);
            $objClientes->Correo = utf8_encode($Datos['Correo']);
            $objClientes->Telefono = utf8_encode($Datos['Telefono']);
            $objClientes->Pais = utf8_encode($Datos['Pais']);
            $objClientes->IdEstado = utf8_encode($Datos['IdEstado']);
            $objClientes->IdMunicipio = utf8_encode($Datos['IdMunicipio']);
            $objClientes->DatosContacto = utf8_encode($Datos['DatosContacto']);
            $objClientes->Observaciones = utf8_encode($Datos['Observaciones']);
            $objClientes->Estatus = utf8_encode($Datos['Status']);
            array_push($Clientes, $objClientes);
        }
        sqlsrv_close($con);
        return $Clientes;
    }

    public function EditarCliente($ID, $NombreCliente, $RFC, $Calle, $Colonia, 
            $NumeroInterior, $NumeroExterior, $CodigoPostal, $Correo,
            $Telefono, $Pais, $IdEstado, $IdMunicipio, $datos_contacto, $observaciones, $estatus) {

        $this->ID = $ID;
        $this->NombreCliente = $NombreCliente;
        $this->RFC = $RFC;
        $this->Calle = $Calle;
        $this->Colonia = $Colonia;
        $this->NumeroInterior = $NumeroInterior;
        $this->NumeroExterior = $NumeroExterior;
        $this->CodigoPostal = $CodigoPostal;
        $this->Correo = $Correo;
        $this->Telefono = $Telefono;
        $this->Pais = $Pais;
        $this->IdEstado = $IdEstado;
        $this->IdMunicipio = $IdMunicipio;
        $this->DatosContacto = $datos_contacto;
        $this->Observaciones = $observaciones;
        $this->Estatus = $estatus;

        
        $objSQL = new SQL_DML();
        $query = "UPDATE ClientesFacturas "
                . "SET [RFC] = '$this->RFC'"
                . ",[NombreCliente] = '$this->NombreCliente'"
                . ",[Calle] = '$this->Calle'"
                . ",[Colonia] = '$this->Colonia'"
                . ",[NumeroInterior] = '$this->NumeroInterior'"
                . ",[NumeroExterior] = '$this->NumeroExterior'"
                . ",[CodigoPostal] = '$this->CodigoPostal'"
                . ",[Correo] = '$this->Correo'"
                . ",[Telefono] = '$this->Telefono'"
                . ",[Pais] = '$this->Pais'"
                . ",[IdEstado] = '$this->IdEstado'"
                . ",[IdMunicipio] = '$this->IdMunicipio'"
                . ",[DatosContacto] = '$this->DatosContacto'"
                . ",[Observaciones] = '$this->Observaciones'"
                . ",[Status] = '$this->Estatus'"      
                . " WHERE ID = '$this->ID'";
        echo $query;
        if($objSQL->Execute($query))
        {
            return true;
        }
        else
        {
            return FALSE;
        }
        
    }
        
     public function Eliminar($id)
        {
            $this->Id = $id;
            
            $objSQL = new SQL_DML();
        
            $query = "delete ClientesFacturas where ID ='".$this->Id."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        } 

}
