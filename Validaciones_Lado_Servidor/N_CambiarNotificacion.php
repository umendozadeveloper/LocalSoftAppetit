<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Empresa.php';
include_once '../Clases/Fecha.php';


class N_CambiarNotificacion {
    public $objEmpresa;// = new Empresa();
    public $errores;
    public $Tono;




    public function __construct() {
        $this->errores = array();
        $this->objEmpresa = new Empresa();
    }
    
    public function main(){
        if(!isset($_FILES['txtNotificacion'])){
            array_push($this->errores, "No se ingresó archivo");
        }
        if($this->errores){
            foreach($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_ConfiguracionGeneral.php");
        }
        else{
            $this->objEmpresa->ObtenerPorID(1);            
//            clearstatcache(true,$this->objEmpresa->TonoCocina);
//            unlink($this->objEmpresa->TonoCocina);
            
            $this->Tono = $_FILES['txtNotificacion']['name'];
            $extension = explode(".",  $this->Tono);
            $rutaTmp = $_FILES['txtNotificacion']['tmp_name'];
            $objFecha = new Fecha();
            
            $fecha = $objFecha->ObtenerFechaYHora();
            $this->objEmpresa->TonoCocina = "../bd_Fotos/App/TonoCocina".$this->FechaHoraTono($fecha).".".$extension[1];
            if($this->objEmpresa->EditarNotificacion($this->objEmpresa->TonoCocina)){
                if(copy($rutaTmp, $this->objEmpresa->TonoCocina))
                {
                    
                    //unlink($this->objEmpresa->TonoCocina);
                    setSuccessMessage("Archivo actualizado correctamente");
                }
                else{
                    setFailureMessage("Error, asegurese de que el archivo no sobrepasa los 8mb de tamaño");
                }
            }
            else{
                setFailureMessage("Error al actualizar el archivo, intente nuevamente");
            }
            header("Location: ../F_A_ConfiguracionGeneral.php");
        }
        
        
    
    }
    
    
    public function FechaHoraTono($fecha){
        $cadena = "";
        $fechaTMP = explode("/", $fecha);
        foreach ($fechaTMP as $f)
        {
            $cadena.= $f;
        }
        $fechaTMP = explode(":", $cadena);
        $cadena = "";
        foreach ($fechaTMP as $f)
        {
        $cadena.= $f;
        }

        $fechaTMP = explode(" ", $cadena);
        $cadena = "";
        foreach ($fechaTMP as $f)
        {
        $cadena.= $f;
        }
        return $cadena;
}

}

$objN_CambiarNotificacion = new N_CambiarNotificacion();
$objN_CambiarNotificacion->main();
