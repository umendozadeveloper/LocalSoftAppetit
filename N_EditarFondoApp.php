<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Empresa.php';
include_once '../Clases/Fecha.php';

class N_EditarFondoApp {
    public $objEmpresa;
    public $errores;
    public $ruta;
    public $extension;
    public $destino;
    public $foto;
    public $modulo;
    public $fecha;
    public $objFecha;
            
    function __construct() {
        $this->objEmpresa = new Empresa();
        $this->errores = array();
        
        
        
    }
    
    

    function main(){
        
        if(!isset($_POST['Modulo'])){
            array_push($this->errores, "Es necesario seleccionar modulo del cual se quiere editar el papel tapiz");
        }
        if(isset($_FILES['txtArchivoFondo'])){
            $this->foto = $_FILES['txtArchivoFondo']['name'];
            $this->extension = explode(".", $this->foto);
            $this->ruta = $_FILES['txtArchivoFondo']['tmp_name'];
        }
        else{
            array_push($this->errores, "Por favor ingrese imagen");
        }
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_ConfiguracionGeneral.php");
        }
        else{
            $this->modulo = $_POST['Modulo'];
            alert('Modulo: '+$this->modulo);
            $this->objEmpresa->ObtenerPorID(1);
            $this->objFecha = new Fecha();
            $this->fecha = $this->objFecha->ObtenerFechaYHora();
            $this->fecha = $this->objFecha->RedefinirFechaYHora($this->fecha);
            switch ($this->modulo){
            
            //1 es Administrador
            case "1":
                    if(file_exists($this->objEmpresa->FondoAdministrador)){
                        unlink($this->objEmpresa->FondoAdministrador);
                    }
                    $this->destino = "../bd_Fotos/App/FondoAdmin".$this->fecha.".".$this->extension[1];
                    $this->objEmpresa->FondoAdministrador = $this->destino;
                        if($this->foto!=""){
                            if(copy($this->ruta, $this->destino)){
                                if($this->objEmpresa->EditarFondos($this->objEmpresa->FondoAdministrador,
                                        $this->objEmpresa->FondoComensal, $this->objEmpresa->FondoMesero,
                                        $this->objEmpresa->Logo)){
                                            setSuccessMessage("Edición correcta");
                                            header("Location: ../F_A_ConfiguracionGeneral.php");
                                        }
                            }
                        }
                break;
                
                case "2":
                    if(file_exists($this->objEmpresa->FondoMesero)){
                        unlink($this->objEmpresa->FondoMesero);
                    }
                    $this->destino = "../bd_Fotos/App/FondoMesero".$this->fecha.".".$this->extension[1];
                    $this->objEmpresa->FondoMesero = $this->destino;
                        if($this->foto!=""){
                            if(copy($this->ruta, $this->destino)){
                                if($this->objEmpresa->EditarFondos($this->objEmpresa->FondoAdministrador,
                                        $this->objEmpresa->FondoComensal, $this->objEmpresa->FondoMesero,
                                        $this->objEmpresa->Logo)){
                                            setSuccessMessage("Edición correcta");
                                            header("Location: ../F_A_ConfiguracionGeneral.php");
                                        }
                            }
                        }
                break;
                
                case "3":
                    if(file_exists($this->objEmpresa->FondoComensal)){
                        unlink($this->objEmpresa->FondoComensal);
                    }
                    $this->destino = "../bd_Fotos/App/FondoComensal".$this->fecha.".".$this->extension[1];
                    $this->objEmpresa->FondoComensal = $this->destino;
                        if($this->foto!=""){
                            if(copy($this->ruta, $this->destino)){
                                if($this->objEmpresa->EditarFondos($this->objEmpresa->FondoAdministrador,
                                        $this->objEmpresa->FondoComensal, $this->objEmpresa->FondoMesero,
                                        $this->objEmpresa->Logo)){
                                            setSuccessMessage("Edición correcta");
                                            header("Location: ../F_A_ConfiguracionGeneral.php");
                                        }
                            }
                        }
                break;
                
                case "4":
                    if(file_exists($this->objEmpresa->Logo)){
                        unlink($this->objEmpresa->Logo);
                    }
                    $this->destino = "../bd_Fotos/App/LogoApp".$this->fecha.".".$this->extension[1];
                    $this->objEmpresa->Logo = $this->destino;
                        if($this->foto!=""){
                            if(copy($this->ruta, $this->destino)){
                                if($this->objEmpresa->EditarFondos($this->objEmpresa->FondoAdministrador,
                                        $this->objEmpresa->FondoComensal, $this->objEmpresa->FondoMesero,
                                        $this->objEmpresa->Logo)){
                                            setSuccessMessage("Edición correcta");
                                            header("Location: ../F_A_ConfiguracionGeneral.php");
                                        }
                            }
                        }
                break;
                
                
            default:
                break;
            }
                
        }
        
    }
    
    
}

$objEditarFondoApp = new N_EditarFondoApp();
$objEditarFondoApp->main();

