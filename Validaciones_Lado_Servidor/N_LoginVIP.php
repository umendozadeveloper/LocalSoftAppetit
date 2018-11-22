<?php
include_once '../Clases/Cliente.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Seguridad.php';

class N_LoginVIP {
    
    public $objCliente;
    public $errores;
    public $script;
    public $objSeguridad;
            
    function __construct() {
        $this->errores = array();
        $this->objCliente = new Cliente();
        $this->script = $_SESSION['ScriptActual'];
    }
    
    function main(){
        if(isset($_POST['txtCorreo'])){
            $this->objCliente->Correo = $_POST['txtCorreo'];
        }
        else {
            array_push($this->errores, "No se ingresó correo");
        }
        if($this->errores){
            foreach($this->errores as $e){
                setFailureMessage($e);
            }
        }
        else{
            
            if($this->objCliente->ConsultarPorCorreo($this->objCliente->Correo)){
                switch($this->objCliente->Status){
                    case 0:
                        setSwalFailureMessage("No recibió correo de invitación por favor solicitelo al mesero");
                        header("Location: ../$this->script");
                        break;

                    case 1:
                        setSwalFailureMessage("Es necesario presentarle su folio (".$this->objCliente->FolioRegistro.") al mesero para poder ingresar");
                        header("Location: ../$this->script");
                        break;

                    case 2:
                        setSwalSuccessMessage("Ha ingresado como Cliente VIP correctamente");
                        $_SESSION['vip']=true;
                        header("Location: ../$this->script");
                    break;

                    case 3:
                        setSwalFailureMessage("Su usuario está marcado como inactivo");
                        header("Location: ../$this->script");
                        break;
                }
            }
            else{
                setFailureMessage("La cuenta de E-mail no está registrada como cliente VIP");
                header("Location: ../$this->script");
            }
            
        }
        
    }
}

$objN_LoginVIP = new N_LoginVIP();
$objN_LoginVIP->main();
