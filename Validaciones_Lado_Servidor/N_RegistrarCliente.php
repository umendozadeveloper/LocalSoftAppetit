<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Cliente.php';
include_once '../Clases/CorreoMarketing.php';

class N_RegistrarCliente {
    public $objCliente;
    public $errores;
    public $objCorreo;


    public function __construct() {
        $this->errores = array();
        $this->objCliente = new Cliente();
        
    }
    
    public function main(){
        
        if(isset($_POST['txtNombre'])){
            $this->objCliente->Nombre = $_POST['txtNombre'];
        }
        else{
            array_push($this->errores, "No se ingresó nombre");
        }
        
        if(isset($_POST['txtApellidos'])){
            $this->objCliente->Apellidos = $_POST['txtApellidos'];
        }
        else{
            array_push($this->errores, "No se ingresaron apellidos");
        }
        
        if(isset($_POST['txtTelefono'])){
            $this->objCliente->Telefono = $_POST['txtTelefono'];
        }
        else{
            array_push($this->errores, "No se ingresó teléfono");
        }
        
        if(isset($_POST['txtCorreo'])){
            $this->objCliente->Correo = $_POST['txtCorreo'];
        }
        else{
            array_push($this->errores, "No se ingresó correo");
        }
        
        if(isset($_POST['txtPromos']) && $_POST['txtPromos']==1){
            
            if(isset($_POST['txtAlimentos'])){
                $this->objCliente->PAlimentos = 1;
            }
            else{
                $this->objCliente->PAlimentos = 0;
            }
            if(isset($_POST['txtVinos'])){
                $this->objCliente->PVino = 1;
            }
            else{
                $this->objCliente->PVino = 0;
            }
            if(isset($_POST['txtEventos'])){
                $this->objCliente->PEventos = 1;
            }
            else{
                $this->objCliente->PEventos = 0;
            }
            if(isset($_POST['txtCursos'])){
                $this->objCliente->PCursos = 1;
            }
            else{
                $this->objCliente->PCursos = 0;
            }
            
        }
        else{
            $this->objCliente->PAlimentos = 0;
            $this->objCliente->PVino = 0;
            $this->objCliente->PEventos = 0;
            $this->objCliente->PCursos = 0;
        }
        if($this->errores){
            foreach($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_C_CerrarComanda.php");
        }
        else{
            
            
            if($this->objCliente->ConsultarPorCorreo($_POST['txtCorreo'])){
                $_SESSION['MostrarModalRegistro'] = 1;
                $_SESSION['txtNombre']= $this->objCliente->Nombre;
                $_SESSION['txtCorreo']= $this->objCliente->Correo;
                $_SESSION['txtApellidos']= $this->objCliente->Apellidos;
                $_SESSION['txtTelefono']= $this->objCliente->Telefono;
                $_SESSION['txtPromos']= 1;
                $_SESSION['txtPVinos']=  $this->objCliente->PVino;
                $_SESSION['txtPAlimentos']=  $this->objCliente->PAlimentos;
                $_SESSION['txtPCursos']=$this->objCliente->PCursos;
                $_SESSION['txtPEventos']=$this->objCliente->PEventos;
                setSwalFailureMessage("El correo que ingresó ya existe, favor de ingresar uno diferente");
                header("Location: ../F_C_CerrarComanda.php");
            }
            else{
                
            
            if($this->objCliente->Insertar($this->objCliente->Nombre, $this->objCliente->Apellidos,
                    $this->objCliente->Telefono, $this->objCliente->Correo,  $this->objCliente->PVino,
                    $this->objCliente->PAlimentos,$this->objCliente->PEventos,$this->objCliente->PCursos)){
                setSwalSuccessMessage("Se ha registrado correctamente al club de clientes VIP, para terminar el proceso de registro de cliente VIP "
                        . "verifique el correo en su cuenta de E-mail");
                $_SESSION['vip']=  $this->objCliente->ID;
                $this->objCorreo = new Correo();
                if($this->objCorreo->EnviarCorreoBienvenidaVIP($this->objCliente->FolioRegistro, $this->objCliente->Correo)){
                    $this->objCliente->MarcarCorreoEnviado($this->objCliente->ID);
                }
            }
            else{
                setFailureMessage("Ha ocurrido un error en el registro");
            }
            header("Location: ../F_C_CerrarComanda.php");
        }
    }
    }
}




    $objRegistrarCliente = new N_RegistrarCliente();
    $objRegistrarCliente->main();
    

