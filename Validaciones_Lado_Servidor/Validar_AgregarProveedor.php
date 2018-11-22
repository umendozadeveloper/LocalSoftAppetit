<?php

include_once '../Clases/Proveedor.php';
include_once '../Clases/Seguridad.php';
include_once './Funciones/Mensajes_Bootstrap.php';

class Validar_AgregarProveedor {

    public $errores;
    public $objProveedor;

    function __construct() {
        $this->errores = array();
        $this->objProveedor = new Proveedor();
    }

    function main() {

        if ($_POST['NombreCliente'] != "")
            $this->objProveedor->Nombre = $_POST['NombreCliente'];
        else
            array_push($this->errores, "Ingresar Nombre del cliente");


        if ($_POST['RFC'] != "")
            $this->objProveedor->RFC = $_POST['RFC'];
        else
            array_push($this->errores, "Ingresar RFC del cliente");


        if ($_POST['Calle'] != "")
            $this->objProveedor->Calle = $_POST['Calle'];
        else
            array_push($this->errores, "Ingresar Calle del cliente");


        if ($_POST['Colonia'] != "")
            $this->objProveedor->Colonia = $_POST['Colonia'];
        else
            array_push($this->errores, "Ingresar Colonia del cliente");


        if ($_POST['CodigoPostal'] != "")
            $this->objProveedor->CodigoPostal = $_POST['CodigoPostal'];
        else
            array_push($this->errores, "Ingresar CodigoPostal del cliente");


        if ($_POST['NumeroExterior'] != "")
            $this->objProveedor->NumeroExterior = $_POST['NumeroExterior'];
        else
            array_push($this->errores, "Ingresar NumeroExterior del cliente");


        if ($_POST['Correo'] != "")
            $this->objProveedor->Correo = $_POST['Correo'];
        else
            array_push($this->errores, "Ingresar Correo del cliente");
        
        
        if ($_POST['cmbMunicipio'] != "")
            $this->objProveedor->IdMunicipio = $_POST['cmbMunicipio'];
        else
            array_push($this->errores, "Ingresar Municipio del cliente");
        
        
        if ($_POST['Pais'] != "")
            $this->objProveedor->Pais = $_POST['Pais'];
        else
            array_push($this->errores, "Ingresar Pais del cliente");
        
        
        if ($_POST['cmbEstado'] != "")
            $this->objProveedor->IdEstado = $_POST['cmbEstado'];
        else
            array_push($this->errores, "Ingresar Estado del cliente");
        
       
          
        
        
        $this->objProveedor->NumeroInterior = $_POST['NumeroInterior'];
        $this->objProveedor->Telefono = $_POST['Telefono'];
        $this->objProveedor->Observaciones = $_POST['txtObservaciones'];
        $this->objProveedor->DatosContacto= $_POST['txtContacto'];

        if ($this->errores) {
            foreach ($this->errores as $e) {
                setFailureMessage($e);
            }
        } else {
            $_SESSION['valNombreCliente'] = $this->objProveedor->Nombre;
            $_SESSION['valRFC'] = $this->objProveedor->RFC;
            $_SESSION['valCalle'] = $this->objProveedor->Calle;
            $_SESSION['valColonia'] = $this->objProveedor->Colonia;
            $_SESSION['valCodigoPostal'] = $this->objProveedor->CodigoPostal;
            $_SESSION['valNumeroExterior'] = $this->objProveedor->NumeroExterior;
            $_SESSION['valNumeroInterior'] = $this->objProveedor->NumeroInterior;
            $_SESSION['valCorreo'] = $this->objProveedor->Correo;
            $_SESSION['valTelefono'] = $this->objProveedor->Telefono;
            $_SESSION['valPais'] = $this->objProveedor->Pais;
            $_SESSION['valId_Estado'] = $this->objProveedor->IdEstado;
            $_SESSION['valId_Municipio'] = $this->objProveedor->IdMunicipio;
            $_SESSION['valObservac'] = $this->objProveedor->Observaciones;
            $_SESSION['valContacto'] = $this->objProveedor->DatosContacto;

            $objSQL = new SQL_DML();
            $this->objProveedor->ID= $objSQL->GetScalar("select MAX (ID) as ID from Proveedores");
            
            if ($this->objProveedor->Insertar($this->objProveedor->ID,$this->objProveedor->Nombre, $this->objProveedor->Telefono, $this->objProveedor->Correo,
                    $this->objProveedor->RFC, $this->objProveedor->Calle, $this->objProveedor->Colonia, $this->objProveedor->NumeroInterior, 
                    $this->objProveedor->NumeroExterior, $this->objProveedor->CodigoPostal, $this->objProveedor->Pais, $this->objProveedor->IdEstado,
                    $this->objProveedor->IdMunicipio, $this->objProveedor->DatosContacto, $this->objProveedor->Observaciones)) 
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
                
                
                setSuccessMessage("Proveedor registrado correctamente");
                header("Location: ../F_A_DetalleProveedor.php?IdProveedor=".$this->objProveedor->ID);
            } else {
                setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");

                header("Location: ../F_A_RegistrarProveedor.php");
            }
        }
    }

}

$objAgregarProveedor = new Validar_AgregarProveedor();
$objAgregarProveedor->main();
