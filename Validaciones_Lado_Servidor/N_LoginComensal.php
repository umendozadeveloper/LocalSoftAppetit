<?php
include_once '../Clases/Comanda.php';
include_once '../Clases/Seguridad.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Mesero.php';
include_once '../Clases/Cliente.php';

class LoginComensal{
    public $errores;
    public $objComanda;
    public $objMesero;
    public $BanderaVIP;
    //public $objCliente;
            
    function __construct() {
        $this->errores = array();
        $this->objComanda = new Comanda();
        $this->objMesero = new Mesero();
        $this->BanderaVIP = false;
        //$this->objCliente = new Cliente();
    }
    
    function main(){
        if(isset($_POST['txtComanda'])){
            $this->objComanda->Folio = $_POST['txtComanda'];
        }
        else {
            array_push($this->errores, "No se ingresó folio de la comanda");
        }
        if(isset($_POST['txtContrasena'])){
            $this->objMesero->Contrasena = $_POST['txtContrasena'];
        }
        else{
            array_push($this->errores, "No se ingresó contraseña");
        }
        if(isset($_POST['txtClienteVIP'])){
            $this->BanderaVIP = true;
            $this->objCliente->Correo = $_POST['txtClienteVIP'];
        }
        
        if($this->errores){
            foreach($this->errores as $e){
                setSwalFailureMessage($e);
            }
        }
        else{
            if($this->objComanda->ConsultarPorFolio($this->objComanda->Folio)){
                switch($this->objComanda->IdEstado){
                    case 1: 
                        //"Comanda Activa";
                        $objSeguridad = new Seguridad();
                        $comandear = false;
                        
                        
                        if($this->BanderaVIP){
                            if(count($this->objCliente->Correo)>0 && $this->objCliente->Correo!=""){
                                if(!$this->objCliente->ConsultarPorCorreo($this->objCliente->Correo)){
                                    setSwalFailureMessage("La cuenta de E-mail no está registrada como cliente VIP");
                                    header("Location: ../F_C_LoginComensal.php");
                                    break;
                                    
                                }
                                else{
                                    
                                    switch ($this->objCliente->Status){
                                        case 0:
                                            setSwalFailureMessage("El cliente no recibió correo, reenviar correo desde la interfaz de listado de clientes");
                                            header("Location: ../F_C_LoginComensal.php");
                                            break;
                                        
                                        case 1:
                                            setSwalFailureMessage("El cliente no ha comprobado su folio");
                                            header("Location: ../F_C_LoginComensal.php");
                                            break;
                                        case 2:
                                            goto Continuar;
                                            break;
                                        case 3:
                                            setSwalFailureMessage("El cliente está inactivo");
                                            header("Location: ../F_C_LoginComensal.php");
                                            break;
                                    }
                                    return 0;
                                }
                            }
                            else{
                                $this->BanderaVIP=false;
                            }
                        }
                        Continuar:
                        if(count($this->objMesero->Contrasena)>0 && $this->objMesero->Contrasena!=""){
                            if($this->objMesero->LoginPorID($this->objComanda->IdMesero, $this->objMesero->Contrasena)){
                                $comandear = true;
                            }
                            else{
                                setSwalFailureMessage("Contraseña del usuario incorrecta");
                                header("Location: ../F_C_LoginComensal.php");
                                break;
                            }   
                        }
                        $objSeguridad->asigna($this->objComanda->Id, 3, $this->objComanda->Folio,$this->objComanda->IdMesero,true,$comandear,  $this->BanderaVIP);
                        header("Location: ../F_C_Bienvenida.php?idComanda=".$this->objComanda->Id);
                        break;
                    case 2:
                        //"Comanda Pagada";
                        $_SESSION['folioComanda']=  null;
                        setSwalFailureMessage("Comanda Pagada");
                        header("Location: ../F_C_LoginComensal.php");
                        break;
                    case 3:
                        //"Comanda Finalizada";
                        $_SESSION['folioComanda']=  null;
                        setSwalFailureMessage("Comanda Finalizada");
                        header("Location: ../F_C_LoginComensal.php");
                        break;
                    default :
                        //"No existe la comanda";
                        setSwalFailureMessage("No existe la comanda");
                        $_SESSION['folioComanda']=  null;
                        header("Location: ../F_C_LoginComensal.php");
                        break;
                }
                
            }
            else{
                    header("Location: ../F_C_LoginComensal.php");
                    setSwalFailureMessage("No existe la comanda");
                }
        }
    }
    
}


$objLoginComensal = new LoginComensal();
$objLoginComensal->main();

?>


