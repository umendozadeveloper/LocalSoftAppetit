<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/Proveedor.php';
include_once './Funciones/Mensajes_Bootstrap.php';

class Validar_EditarProveedor{
    public $errores;
    public $objProveedor;
    
    function __construct() {
        $this->errores = array();
        $this->objProveedor = new Proveedor();
    }
    
    function main(){
       
        
        isset($_POST['NombreCliente'])
        ? $this->objProveedor->Nombre=$_POST['NombreCliente']:array_push($this->errores,"Ingresar nombre del cliente");
        
        
        
        
        isset($_POST['RFC']) 
        ? $this->objProveedor->RFC=$_POST['RFC'] : array_push($this->errores,"Ingresar RFC");
        
        isset($_POST['Calle']) 
        ? $this->objProveedor->Calle=$_POST['Calle'] : array_push($this->errores,"Ingresar calle");
        
        isset($_POST['Colonia']) 
        ? $this->objProveedor->Colonia=$_POST['Colonia'] : array_push($this->errores,"Ingresar Colonia");
        
        isset($_POST['NumeroExterior']) 
        ? $this->objProveedor->NumeroExterior=$_POST['NumeroExterior'] : array_push($this->errores,"Ingresar numero exterior");
        
//        isset($_POST['CodigoPostal']) 
//        ? $this->objProveedor->CodigoPostal=$_POST['CodigoPostal'] : array_push($this->errores,"Ingresar código postal");
        
        
//        isset($_POST['Correo']) 
//        ? $this->objProveedor->Correo=$_POST['Correo'] : array_push($this->errores,"Ingresar correo");
        
//        isset($_POST['Pais']) 
//        ? $this->objProveedor->Pais=$_POST['Pais'] : array_push($this->errores,"Ingresar País");
        
        isset($_POST['cmbEstado']) 
        ? $this->objProveedor->IdEstado=$_POST['cmbEstado'] : array_push($this->errores,"Ingresar Estado");
        
        isset($_POST['cmbMunicipio']) 
        ? $this->objProveedor->IdMunicipio=$_POST['cmbMunicipio'] : array_push($this->errores,"Ingresar Municipio");
        
         isset($_POST['ID']) 
        ? $this->objProveedor->ID=$_POST['ID'] : array_push($this->errores,"Debe seleccionar un proveedor");
      
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
                
            }
            header("Location: ../F_A_EditarProveedor.php?IdProveedor=".$this->objProveedor->ID);
        }
        else{
            $this->objProveedor->NumeroInterior=$_POST['NumeroInterior'];
            $this->objProveedor->Telefono  =$_POST['Telefono'];
            $this->objProveedor->CodigoPostal = $_POST['CodigoPostal'];
            $this->objProveedor->Observaciones = $_POST['txtObservaciones'];
            $this->objProveedor->DatosContacto = $_POST['txtContacto'];
            $this->objProveedor->Correo = $_POST['Correo'];
            $this->objProveedor->Pais = $_POST['Pais'];
            $this->objProveedor->Estatus = $_POST['cmbEstatus'];
            
            if($this->objProveedor->ModificarPorID($this->objProveedor->ID, $this->objProveedor->Nombre, $this->objProveedor->RFC, 
                    $this->objProveedor->Telefono, $this->objProveedor->Correo, 
                    $this->objProveedor->Calle, $this->objProveedor->Colonia, $this->objProveedor->NumeroExterior, $this->objProveedor->NumeroInterior,
                    $this->objProveedor->CodigoPostal, $this->objProveedor->Pais, $this->objProveedor->IdEstado, $this->objProveedor->IdMunicipio, 
                    $this->objProveedor->Observaciones, $this->objProveedor->DatosContacto, $this->objProveedor->Estatus))
            {
                setSuccessMessage("Datos editados correctamente");

                header("Location: ../F_A_ConsultarProveedor.php");

            }
            else{
                setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
                header("Location: ../F_A_ConsultarProveedor.php");

            }        
        }
        
    }
    
    function validar($NombreComercial,$RazonSocial,
            $RFC,$Direccion,$Telefono,$Correo,$PaginaWeb,$Logo,$Eslogan,$NombreAplicacion){
        
        
    }
    
    
}

$objEditarProveedor = new Validar_EditarProveedor();
$objEditarProveedor->main();

?>

