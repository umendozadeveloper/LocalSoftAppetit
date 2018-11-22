<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/Empresa.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once '../Clases/ClientesFacturas.php';

class N_EditarEmpresa{
    public $errores;
    public $objEmpresa;
    
    function __construct() {
        $this->errores = array();
        $this->objEmpresa = new Empresa();
    }
    
    function main(){
       
        $this->objEmpresa->ObtenerPorID(1);
        
        isset($_POST['NombreComercial'])
        ? $this->objEmpresa->NombreComercial=$_POST['NombreComercial']:array_push($this->errores,"Ingresar nombre comercial");
        
        isset($_POST['RazonSocial']) 
        ? $this->objEmpresa->RazonSocial=$_POST['RazonSocial'] : array_push($this->errores,"Ingresar razón social");
        
        isset($_POST['RFC']) 
        ? $this->objEmpresa->RFC=$_POST['RFC'] : array_push($this->errores,"Ingresar RFC");
        
        isset($_POST['Calle']) 
        ? $this->objEmpresa->Calle=$_POST['Calle'] : array_push($this->errores,"Ingresar calle");
        
        isset($_POST['Colonia']) 
        ? $this->objEmpresa->Colonia=$_POST['Colonia'] : array_push($this->errores,"Ingresar Colonia");
        
        isset($_POST['NumeroInterior']) 
        ? $this->objEmpresa->NumeroInterior=$_POST['NumeroInterior'] : array_push($this->errores,"Ingresar numero interior");
        
        isset($_POST['CodigoPostal']) 
        ? $this->objEmpresa->CodigoPostal=$_POST['CodigoPostal'] : array_push($this->errores,"Ingresar código postal");
        
        isset($_POST['Telefono']) 
        ? $this->objEmpresa->Telefono=$_POST['Telefono'] : array_push($this->errores,"Ingresar teléfono");
        
        isset($_POST['Correo']) 
        ? $this->objEmpresa->Correo=$_POST['Correo'] : array_push($this->errores,"Ingresar correo");
        
        isset($_POST['PaginaWeb']) 
        ? $this->objEmpresa->PaginaWeb=$_POST['PaginaWeb'] : array_push($this->errores,"Ingresar página web");
        
        isset($_POST['RegimenFiscal']) 
        ? $this->objEmpresa->RegimenFiscal=$_POST['RegimenFiscal'] : array_push($this->errores,"Ingresar régimen fiscal");
        
        isset($_POST['Password']) 
        ? $this->objEmpresa->Password=$_POST['Password'] : array_push($this->errores,"Ingresar contraseña");
        
        isset($_POST['Pais']) 
        ? $this->objEmpresa->Pais=$_POST['Pais'] : array_push($this->errores,"Ingresar país");
        
        isset($_POST['cmbEstado']) 
        ? $this->objEmpresa->IdEstado=$_POST['cmbEstado'] : array_push($this->errores,"Ingresar estado");
        
          isset($_POST['cmbMunicipio']) 
        ? $this->objEmpresa->IdMunicipio=$_POST['cmbMunicipio'] : array_push($this->errores,"Ingresar municipio");
        
        isset($_POST['Eslogan']) 
        ? $this->objEmpresa->Eslogan=$_POST['Eslogan'] : array_push($this->errores,"Ingresar eslogan");
        
        
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
                
            }
            header("Location: ../F_A_Empresa.php");
        }
        else{
            $this->objEmpresa->NumeroExterior=$_POST['NumeroExterior'];
            if($this->objEmpresa->EditarEmpresa(1,$this->objEmpresa->NombreComercial, $this->objEmpresa->RazonSocial,
                    $this->objEmpresa->RFC, $this->objEmpresa->Calle, $this->objEmpresa->Colonia, 
                    $this->objEmpresa->NumeroInterior, $this->objEmpresa->NumeroExterior,
                    $this->objEmpresa->CodigoPostal, $this->objEmpresa->Telefono,
                    $this->objEmpresa->Correo, $this->objEmpresa->PaginaWeb, 
                    $this->objEmpresa->Eslogan, $this->objEmpresa->RegimenFiscal, $this->objEmpresa->Password, 
                    $this->objEmpresa->IdEstado, $this->objEmpresa->IdMunicipio, $this->objEmpresa->Pais)){
                
                    $objCliente = new ClientesFacturas();
                    #ID=1 es Público en general
                    $objCliente->EditarCliente(1, "PÚBLICO EN GENERAL", "XAXX10101000", $this->objEmpresa->Calle, 
                    $this->objEmpresa->Colonia, $this->objEmpresa->NumeroInterior, $this->objEmpresa->NumeroExterior, 
                            $this->objEmpresa->CodigoPostal, $this->objEmpresa->Correo, $this->objEmpresa->Telefono, 
                            $this->objEmpresa->Pais, $this->objEmpresa->IdEstado, $this->objEmpresa->IdMunicipio);
                    
                     #ID=2 es Restaurante
                    $objCliente->EditarCliente(2, $this->objEmpresa->NombreComercial, $this->objEmpresa->RFC, $this->objEmpresa->Calle, 
                    $this->objEmpresa->Colonia, $this->objEmpresa->NumeroInterior, $this->objEmpresa->NumeroExterior, 
                            $this->objEmpresa->CodigoPostal, $this->objEmpresa->Correo, $this->objEmpresa->Telefono, 
                             $this->objEmpresa->Pais, $this->objEmpresa->IdEstado, $this->objEmpresa->IdMunicipio);
                
                    setSuccessMessage("Datos editados correctamente");
                    
                    header("Location: ../F_A_Empresa.php");

                    }
                    else{
                        setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
                        header("Location: ../F_A_Empresa.php");
                        
                    }        
        }
        
    }
    
    function validar($NombreComercial,$RazonSocial,
            $RFC,$Direccion,$Telefono,$Correo,$PaginaWeb,$Logo,$Eslogan,$NombreAplicacion){
        
        
    }
    
    
}

$objN_EditarEmpresa = new N_EditarEmpresa();
$objN_EditarEmpresa->main();

?>

