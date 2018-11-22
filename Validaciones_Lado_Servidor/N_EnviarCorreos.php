<?php
echo "JA";

include_once '../Clases/CorreoMarketing.php';
include_once '../Clases/Cliente.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/ContactoClientes.php';


class N_EnviarCorreos {
    public $objCorreo;
    public $errores;
    public $objClientes;
    public $preferencia;
    public $objContactoClientes;
            
    function __construct() {
        $this->objCorreo = new CorreoMarketing();
        $this->objClientes = new Cliente();
        $this->errores = array();
    }

    
    function main(){
        if(isset($_POST['asunto'])){
            $this->objCorreo->Asunto = $_POST['asunto'];
        }
        else{
            array_push($this->errores, "No se ingresó asunto");
        }
        
        if(isset($_POST['cuerpo_correo'])){
            $this->objCorreo->Cuerpo = $_POST['cuerpo_correo'];
        }
        else{
            array_push($this->errores, "No se ingresó cuerpo");
        }
        
        if(isset($_POST['tipo'])){
            $this->preferencia = $_POST['tipo'];
        }
        else{
            array_push($this->errores, "No se seleccionó el tipo de clientes");
        }
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            //header("Location: ../F_A_EnviarCorreos.php");
            echo "||--$e";
        }
        else {
            
            $this->objContactoClientes = new ContactoClientes();
            $destinatarios = array();
            $clientes = $this->objClientes->ConsultarPorPrefencia($this->preferencia);
            foreach ($clientes as $c){
                //echo $c->Correo."<br>";
                array_push($destinatarios, $c->Correo);
            }
            
            switch ($this->preferencia){
                
                case "PVino":
                    $this->objContactoClientes->Clientes = "Interesados en vinos";
                    break;
                
                case "PAlimentos":
                    $this->objContactoClientes->Clientes = "Interesados en platillos";
                    break;
                
                case "PEventos":
                    $this->objContactoClientes->Clientes = "Interesados en eventos";
                    break;
                
                case "PCursos":
                    $this->objContactoClientes->Clientes = "Interesados en cursos";
                    break;
                
                case "Todos":
                    $this->objContactoClientes->Clientes = "A todos los cientes";
                    break;
                
                default :
                    $this->objContactoClientes->Clientes = "";
                    break;
                
                
            }            
            if($this->objContactoClientes->Insertar($this->objContactoClientes->Clientes,
                $this->objCorreo->Asunto, $this->objCorreo->Cuerpo)){
                
                   if($this->objCorreo->EnviarCorreoPorPreferencias($this->objCorreo->Asunto,
                        $this->objCorreo->Cuerpo, $destinatarios)){
                        
                        //setSuccessMessage("Correo enviado correctamente");
                        echo "--||1";
                    }
                    else{
                        echo "--||Error al enviar correo";
                    }
            }
            else{
                echo "--||Error con insert";
                //setFailureMessage("Error con correo");
            }            
            //header("Location: ../F_A_EnviarCorreos.php");
        }

    }
}

$objN_EnviarCorreos = new N_EnviarCorreos();
$objN_EnviarCorreos->main();
