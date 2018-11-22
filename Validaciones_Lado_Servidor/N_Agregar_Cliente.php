<?php

include_once '../Clases/ClientesFacturas.php';
include_once '../Clases/Seguridad.php';
include_once './Funciones/Mensajes_Bootstrap.php';

class N_Agregar_Cliente {

    public $errores;
    public $objClientes;

    function __construct() {
        $this->errores = array();
        $this->objClientes = new ClientesFacturas();
    }

    function main() {

        if ($_POST['NombreCliente'] != "")
            $this->objClientes->NombreCliente = $_POST['NombreCliente'];
        else
            array_push($this->errores, "Ingresar Nombre del cliente");


        if ($_POST['RFC'] != "")
            $this->objClientes->RFC = $_POST['RFC'];
        else
            array_push($this->errores, "Ingresar RFC del cliente");


        if ($_POST['Calle'] != "")
            $this->objClientes->Calle = $_POST['Calle'];
        else
            array_push($this->errores, "Ingresar Calle del cliente");


        if ($_POST['Colonia'] != "")
            $this->objClientes->Colonia = $_POST['Colonia'];
        else
            array_push($this->errores, "Ingresar Colonia del cliente");


        if ($_POST['CodigoPostal'] != "")
            $this->objClientes->CodigoPostal = $_POST['CodigoPostal'];
        else
            array_push($this->errores, "Ingresar CodigoPostal del cliente");


        if ($_POST['NumeroExterior'] != "")
            $this->objClientes->NumeroExterior = $_POST['NumeroExterior'];
        else
            array_push($this->errores, "Ingresar NumeroExterior del cliente");


        if ($_POST['Correo'] != "")
            $this->objClientes->Correo = $_POST['Correo'];
        else
            array_push($this->errores, "Ingresar Correo del cliente");
        
        
        if ($_POST['cmbMunicipio'] != "")
            $this->objClientes->IdMunicipio = $_POST['cmbMunicipio'];
        else
            array_push($this->errores, "Ingresar Municipio del cliente");
        
        
        if ($_POST['Pais'] != "")
            $this->objClientes->Pais = $_POST['Pais'];
        else
            array_push($this->errores, "Ingresar Pais del cliente");
        
        
        if ($_POST['cmbEstado'] != "")
            $this->objClientes->IdEstado = $_POST['cmbEstado'];
        else
            array_push($this->errores, "Ingresar Estado del cliente");
        
       
          
        

        $this->objClientes->NumeroInterior = $_POST['NumeroInterior'];
        $this->objClientes->Telefono = $_POST['Telefono'];
        $this->objClientes->Observaciones = $_POST['txtObservaciones'];
        $this->objClientes->DatosContacto= $_POST['txtContacto'];
        $this->objClientes->Estatus = $_POST['cmbEstatus'];

        if ($this->errores) {
            foreach ($this->errores as $e) {
                setFailureMessage($e);
            }
        } else {
            $_SESSION['valNombreCliente'] = $this->objClientes->NombreCliente;
            $_SESSION['valRFC'] = $this->objClientes->RFC;
            $_SESSION['valCalle'] = $this->objClientes->Calle;
            $_SESSION['valColonia'] = $this->objClientes->Colonia;
            $_SESSION['valCodigoPostal'] = $this->objClientes->CodigoPostal;
            $_SESSION['valNumeroExterior'] = $this->objClientes->NumeroExterior;
            $_SESSION['valNumeroInterior'] = $this->objClientes->NumeroInterior;
            $_SESSION['valCorreo'] = $this->objClientes->Correo;
            $_SESSION['valTelefono'] = $this->objClientes->Telefono;
            $_SESSION['valPais'] = $this->objClientes->Pais;
            $_SESSION['valId_Estado'] = $this->objClientes->IdEstado;
            $_SESSION['valId_Municipio'] = $this->objClientes->IdMunicipio;
            $_SESSION['valObservac'] = $this->objClientes->Observaciones;
            $_SESSION['valContacto'] = $this->objClientes->DatosContacto;
            $_SESSION['valEstatus'] = $this->objClientes->Estatus;

            $objSQL = new SQL_DML();
            $id= $objSQL->GetScalar("select MAX (ID) as ID from ClientesFacturas");
            
            if ($this->objClientes->Agregar($id,$this->objClientes->NombreCliente, 
                    $this->objClientes->RFC, $this->objClientes->Calle, 
                    $this->objClientes->Colonia, $this->objClientes->NumeroInterior, 
                    $this->objClientes->NumeroExterior, $this->objClientes->CodigoPostal, 
                    $this->objClientes->Correo, $this->objClientes->Telefono,
                    $this->objClientes->Pais, $this->objClientes->IdEstado,
                    $this->objClientes->IdMunicipio, $this->objClientes->DatosContacto, $this->objClientes->Observaciones,
                    $this->objClientes->Estatus)) 
            {
                $_SESSION['valNombreCliente'] = NULL;
                $_SESSION['valRFC'] = NULL;
                $_SESSION['valCalle'] = NULL;
                $_SESSION['valColonia'] = NULL;
                $_SESSION['valCodigoPostal'] = NULL;
                $_SESSION['valNumeroExterior'] = NULL;
                $_SESSION['valNumeroInterior'] = NULL;
                $_SESSION['valCorreo'] = NULL;
                $_SESSION['valTelefono'] = NULL;
                $_SESSION['valPais'] = NULL;
                $_SESSION['valId_Estado'] = NULL;
                $_SESSION['valId_Municipio'] = NULL;
                $_SESSION['valObservac'] = null;
                $_SESSION['valContacto'] = null;
                $_SESSION['valEstatus'] = null;
                
                setSuccessMessage("Cliente registrado correctamente");
                header("Location: ../F_A_DetalleCliente.php?IdCliente=$id");
            } else {
                setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");

                header("Location: ../F_A_RegistrarCliente.php");
            }
        }
    }

}

$objAgregarClientes = new N_Agregar_Cliente();
$objAgregarClientes->main();
