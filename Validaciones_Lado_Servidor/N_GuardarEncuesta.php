<?php
include_once '../Clases/Encuesta.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class N_GuardarEncuesta {
    public $objEncuesta;
    public $errores;
    
    public function __construct() {
        $this->errores = array();
        $this->objEncuesta = new Encuesta();
    }
    
    public function main(){
        if(isset($_POST['txtID'])){
            $this->objEncuesta->ID = $_POST['txtID'];
        }
        else{
            array_push($this->errores, "Es necesario que la comanda esté activa");
        }
        
        if(isset($_POST['txtCocina'])){
            $this->objEncuesta->Cocina = $_POST['txtCocina'];
        }
        else{
            array_push($this->errores, "Por favor ingrese valor a la clasificación \"Cocina\"");
        }
        
        
        if(isset($_POST['txtAmbiente'])){
            $this->objEncuesta->Ambiente = $_POST['txtAmbiente'];
        }
        else{
            array_push($this->errores, "Por favor ingrese valor a la clasificación \"Ambiente\"");
        }
        
        
        if(isset($_POST['txtPrecio'])){
            $this->objEncuesta->Precio = $_POST['txtPrecio'];
        }
        else{
            array_push($this->errores, "Por favor ingrese valor a la clasificación \"Precio\"");
        }
        
        if(isset($_POST['txtServicio'])){
             $this->objEncuesta->Servicio = $_POST['txtServicio'];
        }
        else{
            array_push($this->errores, "Por favor ingrese valor a la clasificación \"Servicio\"");
        }
        
        
        if(isset($_POST['txtValoracionGeneral'])){
            $this->objEncuesta->ValoracionGeneral = $_POST['txtValoracionGeneral'];
        }
        else{
            array_push($this->errores, "Por favor ingrese valor a la clasificación \"Valoración general\"");
        }
        
        if(isset($_POST['txtComentario'])){
            $this->objEncuesta->Comentario = $_POST['txtComentario'];
        }
        else{
            array_push($this->errores, "Los comentarios no fueron agregados correctamente");
        }
        
        $tempo = $this->objEncuesta->Cocina;
        
        if($this->errores){
            foreach($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_C_CerrarComanda.php");
        }
        else{
            
            if($this->objEncuesta->ConsultarPorID($this->objEncuesta->ID))
            {
                $tempo= $this->objEncuesta->Cocina;
                if($this->objEncuesta->ModificarPorID($_POST['txtID'],  $_POST['txtCocina'],
                $_POST['txtAmbiente'], $_POST['txtPrecio'],
                $_POST['txtServicio'], $_POST['txtValoracionGeneral'],
                $_POST['txtComentario'])){
                        setSuccessMessage("Muchas gracias por haber realizado la evaluación");
                    }
                else{
                    setFailureMessage("No se ha podido realizar la evaluación");
                }
            }
            else{
                if($this->objEncuesta->Insertar($this->objEncuesta->ID, $this->objEncuesta->Cocina,
                    $this->objEncuesta->Ambiente, $this->objEncuesta->Precio,
                    $this->objEncuesta->Servicio, $this->objEncuesta->ValoracionGeneral,
                    $this->objEncuesta->Comentario)){
                        setSuccessMessage("Muchas gracias por haber realizado la evaluación");
                    }
                else{
                    setFailureMessage("No se ha podido realizar la evaluación");
                }
            }
            
            
            header("Location: ../F_C_CerrarComanda.php");
        }
    }
}


$objGuardarEncuesta = new N_GuardarEncuesta();
$objGuardarEncuesta->main();
