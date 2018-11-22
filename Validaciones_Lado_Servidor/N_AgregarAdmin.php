<?php
include_once '../Clases/Usuario.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once '../Clases/Seguridad.php';
include_once '../Clases/Mesero.php';

class N_AgregarAdmin{
    public $objAdmin;
    public $errores;
    
    public function __construct() {
        $this->objAdmin = new Usuario();
        $this->errores = array();
    }
    
    public function main(){
        if(isset($_POST['txtUsuario'])){
            $this->objAdmin->Usuario = $_POST['txtUsuario'];
        }
        else{
            array_push($this->errores, "Favor de ingresar nombre de usuario");
        }
        
        if(isset($_POST['txtContrasena'])){
            $this->objAdmin->Contrasena = $_POST['txtContrasena'];
        }
        else{
            array_push($this->errores, "Favor de ingresar contraseña");
        }
        
        if(isset($_POST['txtNombre'])){
            $this->objAdmin->Nombre = $_POST['txtNombre'];
        }
        else{
            array_push($this->errores, "Favor de ingresar nombre");
        }
        
        if(isset($_POST['txtApellidos'])){
            $this->objAdmin->Apellidos = $_POST['txtApellidos'];
        }
        else{
            array_push($this->errores, "Favor de ingresar apellidos");
        }
        if(isset($_POST['txtDireccion']) && $_POST['txtDireccion']!=""){
            $this->objAdmin->Direccion = $_POST['txtDireccion'];
        }
        else{
//            array_push($this->errores, "Favor de ingresar dirección");
            $this->objAdmin->Direccion="";
        }
        if(isset($_POST['txtTelefono'])){
            $this->objAdmin->Telefono = $_POST['txtTelefono'];
        }
        else{
//            array_push($this->errores, "Favor de ingresar teléfono");
             $this->objAdmin->Telefono = "";
        }
        
        
        if(isset($_POST['txtCorreo'])){
            $this->objAdmin->Correo = $_POST['txtCorreo'];
        }
        else{
//            array_push($this->errores, "Favor de ingresar correo");
            $this->objAdmin->Correo = "";
        }
        if(isset($_POST['txtObservaciones'])){
            $this->objAdmin->Observaciones = $_POST['txtObservaciones'];
        }
        else{
//            array_push($this->errores, "Favor de ingresar teléfono");
            $this->objAdmin->Observaciones = "";
        }
        
         if(isset($_POST['cmbEstatus'])){
            $this->objAdmin->Estatus = $_POST['cmbEstatus'];
        }
        else{
//            array_push($this->errores, "Favor de ingresar teléfono");
            $this->objAdmin->Estatus = "1";
        }
        
        if(isset($_POST['cmbPrivilegiosM'])){
            $this->objAdmin->PrivilegiosMesero = $_POST['cmbPrivilegiosM'];
        }
        else{
//            array_push($this->errores, "Favor de ingresar teléfono");
            $this->objAdmin->PrivilegiosMesero = "0";
        }
        
        $imagen= $_FILES['archivo'];
        
        
         if(isset($_FILES['archivo']) && $imagen['size']!=0 && $imagen['name']!=""){
            $foto = $_FILES['archivo']['name'];
            $extensionFoto = explode(".", $foto);
            $destino ="bd_Fotos/Usuarios/".$this->objAdmin->obtenerId()."Foto.".$extensionFoto[1]."";
            $ruta = $_FILES['archivo']['tmp_name'];
            $this->objAdmin->Foto = $destino;
        }
        else{
//            array_push($this->errores,"Ingresar foto");
            $this->objAdmin->Foto="";
        }
        
        if($this->errores){
            foreach($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarAdministrador.php");
        }
        
        else{
            $_SESSION['valUsuario'] = $this->objAdmin->Usuario;
            $_SESSION['valContrasena'] = $this->objAdmin->Contrasena;
            $_SESSION['valFoto'] = $this->objAdmin->Foto;
            $_SESSION['valNombre'] = $this->objAdmin->Nombre;
            $_SESSION['valApellidos'] = $this->objAdmin->Apellidos;
            $_SESSION['valDireccion'] = $this->objAdmin->Direccion;
            $_SESSION['valTelefono'] = $this->objAdmin->Telefono;
            $_SESSION['valCorreo'] = $this->objAdmin->Correo;
            $_SESSION['valObservac'] = $this->objAdmin->Observaciones;
            $_SESSION['valEstatus'] = $this->objAdmin->Estatus;
            $_SESSION['valPrivilegiosMesero'] = $this->objAdmin->PrivilegiosMesero;
            if(!$this->objAdmin->ConsultarPorUsuario($this->objAdmin->Usuario)){
                $objSQL = new SQL_DML();
                $IdAdmin = $objSQL->GetScalar("select MAX (ID) as ID from Usuarios");
                if($this->objAdmin->Insertar($IdAdmin,$this->objAdmin->Usuario,
                    $this->objAdmin->Contrasena, $this->objAdmin->Nombre,
                    $this->objAdmin->Apellidos, $this->objAdmin->Direccion, $this->objAdmin->Telefono,
                    $this->objAdmin->Correo, $this->objAdmin->Foto, $this->objAdmin->Observaciones,
                    $this->objAdmin->Estatus, $this->objAdmin->PrivilegiosMesero)){
                   
                    if($this->objAdmin->Foto!="")
                    {
                        if($foto!="")
                        if(copy($ruta, "../".$destino))
                        {
                            echo "";
                        }
                        
                    }   
                    if($this->objAdmin->PrivilegiosMesero=='1')
                    {
                        $objMesero = new Mesero();
                        $objMesero->InsertarMeseroPorAdmin($this->objAdmin->Usuario, $this->objAdmin->Contrasena, 
                        "../".$this->objAdmin->Foto, $this->objAdmin->Nombre, $this->objAdmin->Apellidos, 
                        $this->objAdmin->Direccion, $this->objAdmin->Telefono, $this->objAdmin->Correo,
                        $this->objAdmin->Observaciones, $this->objAdmin->Estatus,$IdAdmin);
                    }
                        $_SESSION['valUsuario'] = NULL;
                        $_SESSION['valContrasena'] = NULL;
                        $_SESSION['valFoto'] = NULL;
                        $_SESSION['valNombre'] = NULL;
                        $_SESSION['valApellidos'] = NULL;
                        $_SESSION['valDireccion'] = NULL;
                        $_SESSION['valTelefono'] = NULL;
                        $_SESSION['valCorreo'] = NULL;
                        $_SESSION['valObservac'] = null;
                        $_SESSION['valEstatus'] = null;
                        $_SESSION['valPrivilegiosMesero'] = NULL;
                        
                        
                    
                        setSuccessMessage("Administrador registrado correctamente");   
                        header("Location: ../F_A_DetalleAdmin.php?Id_Admin=".$this->objAdmin->Id);
                    }
                    else{
                        setFailureMessage("Error en el registro");
                        header("Location: ../F_A_RegistrarAdministrador.php");
                    }
            }
                    else{
                        setFailureMessage("Error el nombre de usuario ya existe, favor de ingresar nombre usuario diferente.");
                        header("Location: ../F_A_RegistrarAdministrador.php");
                    }
        }
        
        
    }
}

$objAgregarAdmin = new N_AgregarAdmin();
$objAgregarAdmin->main();


?>