<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/Empresa.php';
include_once './Funciones/Mensajes_Bootstrap.php';

class N_EditarEmpresa{
    public $errores;
    public $objEmpresa;
    
    function __construct() {
        $this->errores = array();
        $this->objEmpresa = new Empresa();
    }
    
    function main(){
        $foto = "";
        $this->objEmpresa->ObtenerPorID(1);

        
        
        if(!isset($_POST['ColorBotonesFondoR']))
            array_push($this->errores,"Ingresar valor para R en color de fondo del botón");
        else{
            $BotonFondoR = $_POST['ColorBotonesFondoR'];
        }
        
        if(!isset($_POST['ColorBotonesFondoG']))
            array_push($this->errores,"Ingresar valor para G en color de fondo del botón");
        else{
            $BotonFondoG = $_POST['ColorBotonesFondoG'];
        }
        
        if(!isset($_POST['ColorBotonesFondoB']))
            array_push($this->errores,"Ingresar valor para B en color de fondo del botón");
        else{
            $BotonFondoB= $_POST['ColorBotonesFondoB'];
        }
        
        if(!isset($_POST['ColorBotonesTextoR']))
            array_push($this->errores,"Ingresar valor para R en color de texto del botón");
        else{
            $BotonTextoR = $_POST['ColorBotonesTextoR'];
        }
        
        
        if(!isset($_POST['ColorBotonesTextoG']))
            array_push($this->errores,"Ingresar valor para G en color de texto del botón");
        else{
            $BotonTextoG = $_POST['ColorBotonesTextoG'];
        }
        
        if(!isset($_POST['ColorBotonesTextoB']))
            array_push($this->errores,"Ingresar valor para B en color de texto del botón");
        else{
            $BotonTextoB = $_POST['ColorBotonesTextoB'];
        }
        
        
        
        if(!isset($_POST['ColorBarraFondoR']))
            array_push($this->errores,"Ingresar valor para R en color de texto de la barra");
        else{
            $BarraFondoR = $_POST['ColorBarraFondoR'];
        }
        if(!isset($_POST['ColorBarraFondoG']))
            array_push($this->errores,"Ingresar valor para G en color de texto de la barra");
        else{
            $BarraFondoG = $_POST['ColorBarraFondoG'];
        }
        if(!isset($_POST['ColorBarraFondoB']))
            array_push($this->errores,"Ingresar valor para B en color de texto de la barra");
        else{
            $BarraFondoB = $_POST['ColorBarraFondoB'];
        }
        
        
         if(!isset($_POST['ColorBarraTextoR']))
            array_push($this->errores,"Ingresar valor para B en color de texto de la barra de opciones");
        else{
            $BarraTextoR = $_POST['ColorBarraTextoR'];
        }
        if(!isset($_POST['ColorBarraTextoG']))
            array_push($this->errores,"Ingresar valor para B en color de texto de la barra de opciones");
        else{
            $BarraTextoG = $_POST['ColorBarraTextoG'];
        }
        if(!isset($_POST['ColorBarraTextoB']))
            array_push($this->errores,"Ingresar valor para B en color de texto de la barra de opciones");
        else{
            $BarraTextoB = $_POST['ColorBarraTextoB'];
        }
        
        
        
        
        
        isset($_POST['NombreAplicacion']) 
        ? $this->objEmpresa->NombreAplicacion=$_POST['NombreAplicacion'] : array_push($this->errores,"Ingresar nombre de aplicación");
        
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_ConfiguracionGeneral.php");
        }
        else{
            
            $this->objEmpresa->ColorFondoBoton = "rgb($BotonFondoR,$BotonFondoG,$BotonFondoB)";
            $this->objEmpresa->ColorTextoBoton = "rgb($BotonTextoR,$BotonTextoG,$BotonTextoB)";
            $this->objEmpresa->ColorFondoBarra = "rgb($BarraFondoR,$BarraFondoG,$BarraFondoB)";
            $this->objEmpresa->ColorTextoBarra = "rgb($BarraTextoR,$BarraTextoG,$BarraTextoB)";
            
            if($this->objEmpresa->EditarApp($this->objEmpresa->NombreAplicacion,
                    $this->objEmpresa->Logo,  $this->objEmpresa->ColorFondoBoton,  
                    $this->objEmpresa->ColorTextoBoton,  $this->objEmpresa->ColorFondoBarra,
                    $this->objEmpresa->ColorTextoBarra)){
                    setSuccessMessage("Datos editados correctamente");
                    if($foto!=""){
                        $_SESSION['Recargar']=1;
                        copy($rutaFoto, $destinoFoto);

                    }
                    header("Location: ../F_A_ConfiguracionGeneral.php");

                    }
                    else{
                        setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
                        header("Location: ../F_A_ConfiguracionGeneral.php");
                    }
        }
        
        
    }
    
    
    
    
}

$objN_EditarEmpresa = new N_EditarEmpresa();
$objN_EditarEmpresa->main();

?>

