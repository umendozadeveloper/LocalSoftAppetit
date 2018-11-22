<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/ClientesFacturas.php';
include_once './Funciones/Mensajes_Bootstrap.php';

class N_EditarCliente{
    public $errores;
    public $objCliente;
    
    function __construct() {
        $this->errores = array();
        $this->objCliente = new ClientesFacturas();
    }
    
    function main(){
       
        
        isset($_POST['NombreCliente'])
        ? $this->objCliente->NombreCliente=$_POST['NombreCliente']:array_push($this->errores,"Ingresar nombre del cliente");
        
        
        
        
        isset($_POST['RFC']) 
        ? $this->objCliente->RFC=$_POST['RFC'] : array_push($this->errores,"Ingresar RFC");
        
        isset($_POST['Calle']) 
        ? $this->objCliente->Calle=$_POST['Calle'] : array_push($this->errores,"Ingresar calle");
        
        isset($_POST['Colonia']) 
        ? $this->objCliente->Colonia=$_POST['Colonia'] : array_push($this->errores,"Ingresar Colonia");
        
        isset($_POST['NumeroInterior']) 
        ? $this->objCliente->NumeroInterior=$_POST['NumeroInterior'] : array_push($this->errores,"Ingresar numero interior");
        
        isset($_POST['CodigoPostal']) 
        ? $this->objCliente->CodigoPostal=$_POST['CodigoPostal'] : array_push($this->errores,"Ingresar código postal");
        
        
        isset($_POST['Correo']) 
        ? $this->objCliente->Correo=$_POST['Correo'] : array_push($this->errores,"Ingresar correo");
        
        isset($_POST['Pais']) 
        ? $this->objCliente->Pais=$_POST['Pais'] : array_push($this->errores,"Ingresar País");
        
        isset($_POST['cmbEstado']) 
        ? $this->objCliente->IdEstado=$_POST['cmbEstado'] : array_push($this->errores,"Ingresar Estado");
        
        isset($_POST['cmbMunicipio']) 
        ? $this->objCliente->IdMunicipio=$_POST['cmbMunicipio'] : array_push($this->errores,"Ingresar Municipio");
        
        if(isset($_POST['ID']))
        {
            $this->objCliente->ID = $_POST['ID'];
        }
      
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
                
            }
            header("Location: ../F_A_EditarClientes.php?IdCliente=".$this->objCliente->ID);
        }
        else{
            $this->objCliente->NumeroExterior=$_POST['NumeroExterior'];
            $this->objCliente->Telefono  =$_POST['Telefono'];
//            $this->objCliente->ID = $_POST['ID'];
            $this->objCliente->Observaciones = $_POST['txtObservaciones'];
            $this->objCliente->DatosContacto = $_POST['txtContacto'];
            $this->objCliente->Estatus = $_POST['cmbEstatus'];
            
            if($this->objCliente->EditarCliente($this->objCliente->ID, $this->objCliente->NombreCliente, $this->objCliente->RFC, 
            $this->objCliente->Calle, $this->objCliente->Colonia, $this->objCliente->NumeroInterior, $this->objCliente->NumeroExterior, 
            $this->objCliente->CodigoPostal, $this->objCliente->Correo, $this->objCliente->Telefono, $this->objCliente->Pais,
            $this->objCliente->IdEstado, $this->objCliente->IdMunicipio, $this->objCliente->DatosContacto, $this->objCliente->Observaciones,
            $this->objCliente->Estatus))
            {
                setSuccessMessage("Datos editados correctamente");

                header("Location: ../F_A_EditarClientes.php?IdCliente=".$this->objCliente->ID);

            }
            else{
                setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
                header("Location: ../F_A_ConsultarClientes.php");

            }        
        }
        
    }
    
    function validar($NombreComercial,$RazonSocial,
            $RFC,$Direccion,$Telefono,$Correo,$PaginaWeb,$Logo,$Eslogan,$NombreAplicacion){
        
        
    }
    
    
}

$objN_EditarCliente = new N_EditarCliente();
$objN_EditarCliente->main();

?>

