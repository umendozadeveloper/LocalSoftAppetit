<?php
include_once '../Clases/Empresa.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';


class N_EditarBienvenidaChef {
    public $objEmpresa;
    public $errores;
    public $TipoBienvenida;
            
    function __construct() {
        $this->errores = array();
        $this->objEmpresa = new Empresa();
    }
    
    function main(){

        
        if(isset($_POST['txtTipoBienvenida'])){
            $this->TipoBienvenida = $_POST['txtTipoBienvenida'];
        }
        else{
//            array_push($this->errores, "No se ingresó tipo de  bienvenida");
        }
       
        if($this->TipoBienvenida == '1')#texto de bienvenida al chef
        {
            if(isset($_POST['txtBienvenidaChef'])){
            $this->objEmpresa->TextoBienvenidaChef = $_POST['txtBienvenidaChef'];
            }
            else{
    //            array_push($this->errores, "No se ingresó texto de  bienvenida");
            }
        }
        else{ #texto de bienvenida para VIP
            if(isset($_POST['TextoBienvenidaVIP'])){
            $this->objEmpresa->TextoBienvenidaVIP = $_POST['TextoBienvenidaVIP'];
            }
            else{
//                array_push($this->errores, "No se ingresó texto de bienvenida");
            }
        }
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_ConfiguracionGeneral.php");
        }
        else{
            switch ($this->TipoBienvenida){
                case 1:
                    //$this->objEmpresa->TextoBienvenidaChef = str_replace("\"", "*", $this->objEmpresa->TextoBienvenidaChef);
                    if($this->objEmpresa->EditarTextoBienvenidaChef($this->objEmpresa->TextoBienvenidaChef)){
//                        setSuccessMessage("Bienvenida del chef editada correctamente");
                        echo 1;
                    }
                    else{
//                        setFailureMessage("Ha ocurrido un error al editar la bienvenida del chef, por favor vuelva a intentarlo");
                        echo 0;
                        
                    }
//                    header("Location: ../F_A_ConfiguracionGeneral.php");
                    break;
                    
                case 2:
                    $this->objEmpresa->TextoBienvenidaVIP = str_replace("\"", "*", $this->objEmpresa->TextoBienvenidaVIP);
                    if($this->objEmpresa->EditarTextoBienvenidaVIP($this->objEmpresa->TextoBienvenidaVIP)){
//                        setSuccessMessage("Bienvenida al cliente VIP editada correctamente");
                        echo 1;
                    }
                    else{
//                        setFailureMessage("Ha ocurrido un error al editar la bienvenida al cliente VIP, por favor vuelva a intentarlo");
                        echo 0;
                        
                    }
//                    header("Location: ../F_A_ConfiguracionGeneral.php");
                    break;
                    
            }
            
            
        }
    }
}

$objN_EditarBienvenidaChef = new N_EditarBienvenidaChef();
$objN_EditarBienvenidaChef->main();