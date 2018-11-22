<?php

include_once  '../Clases/Inventario.php';
include_once '../Clases/InventarioConteo.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class Validar_CapturaConteo{
    public $errores;
   
    
    function __construct() {
        $this->errores = array();
       
    }
   
    function main(){
        if(isset($_POST['todos_capturados'])){
            $TodosCapturados = $_POST['todos_capturados'];
        }
         if(isset($_POST['ID'])){
            $IdInventario = $_POST['ID'];
        }
        
       
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_CapturarConteoInventario.php?IdInventario=$IdInventario");
        }
        else{
           
            $bandera=true;
            $Capturados = split("├", $TodosCapturados);
            
            $objInventario = new Inventario();
            $objInventario->ActualizarEstado(2, $IdInventario);
            $contador=0;
            
           
            foreach ($Capturados as $insum)
            {
                if($contador!=0)
                {
                    $elemento = split(":",$insum);
                    $objInventarioConteo = new InventarioConteo();
                    if(!$objInventarioConteo->ActualizarInventario($elemento[0], $elemento[1], $elemento[2])){
                        $bandera = false;
                    }     
                }
                $contador++;
                
            }
           
           echo $bandera;
        }
    }    
}

$objCapturarConteo = new Validar_CapturaConteo();
$objCapturarConteo->main();