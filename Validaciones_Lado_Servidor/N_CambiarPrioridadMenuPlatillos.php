<?php
include_once '../Clases/Seguridad.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/SubMenu.php';

class Prioridad_MenuPlatillos{
    public $errores;
    public $objSubMenuOrigen;
    public $objSubMenuDestino;
    public $Ubicacion;
            
    function __construct() {
        $this->errores = array();
        $this->objSubMenuOrigen = new SubMenu();
        $this->objSubMenuDestino = new SubMenu();
        $this->Ubicacion;
    }
    
    function main(){
        
        
        if(isset($_POST['txtID'])){
            $this->objSubMenuOrigen->ID = $_POST['txtID'];
            $this->objSubMenuOrigen->ConsultarSubMenuPorID($this->objSubMenuOrigen->ID);
        }
        else{
            array_push($this->errores, "Seleccionar menú origen");
        }
        if(isset($_POST['txtID_Destino'])){
            $this->objSubMenuDestino->ID = $_POST['txtID_Destino'];
            $this->objSubMenuDestino->ConsultarSubMenuPorID($this->objSubMenuDestino->ID);
        }
        else{
            array_push($this->errores, "Ingresar menú destino");
        }
        
        if(isset($_POST['txtUbicacion'])){
            $this->Ubicacion = $_POST['txtUbicacion'];
        }
        else{
            array_push($this->errores, "Ingresar menú destino");
        }
        
        
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_OpcionesMenuPlatillos.php");
        }
        else{
        
            if($this->objSubMenuOrigen->IntercambiarPrioridad($this->objSubMenuOrigen->ID,
                        $this->objSubMenuDestino->ID, $this->Ubicacion)){
                header("Location: ../F_A_OpcionesMenuBebidas.php");
                     setSuccessMessage("Prioridad reasignada correctamente");
                        }
            else{
                 header("Location: ../F_A_OpcionesMenuBebidas.php");
                 setSwalFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
             }
            
            
            /*if($this->objSubMenuOrigen->Editar($this->objSubMenuOrigen->ID,
                     $this->objSubMenuOrigen->Clave,
                     $this->objSubMenuOrigen->Descripcion,
                     "../".$this->objSubMenuOrigen->Foto,
                     $this->objSubMenuOrigen->IdSubMenuPadre, $this->objSubMenuOrigen->Prioridad)){
                     header("Location: ../F_A_OpcionesMenuPlatillos.php");
                     setSuccessMessage("Prioridad reasignada correctamente");
             }
             else{
                 header("Location: ../F_A_OpcionesMenuPlatillos.php");
                 setSwalFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
             }*/
        }
        
    }
    
}

$objCambiarP = new Prioridad_MenuPlatillos();
$objCambiarP->main();

?>
