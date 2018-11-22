<?php
include_once '../Clases/Mesa.php';
include_once '../Clases/Comanda.php';
include_once '../Clases/Seguridad.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

//session_start();
$seguridad= new Seguridad();
$errores = array();
$mensajeEstado = "";
global $mensajeEstado;
function Validar($comanda,$fecha){
        global $errores;
        if(is_null($comanda))
        {
            array_push($errores, "El número de mesas no puede estar vacío");
        }
        if(is_null($fecha))
        {
            array_push($errores, "La cantidad de personas por mesa no puede estar vacía");
        }
        
        
        
        if($errores)
        {
            return FALSE;
        }
        else
        {   
            return TRUE;
        }
    }

/*
    require("postClass.php");
$thisPost = new Post_Block;
*/

if ($_POST) {
    
    $comanda = $_REQUEST['txtComanda'];
    $fecha = $_REQUEST['txtFecha'];
    $idUsuario = $seguridad->CurrentUserID();
    $mesaPrincipal = $_REQUEST['radio'];
    $mensajes = array();
    
        $mesasEnComanda = array();
        $objMesa = new Mesa();
        $mesaslibres = $objMesa->ConsultarLibres();
        for($i=0; $i<count($mesaslibres);$i++){
                //echo $mesaslibres[$i]->Numero;
                $idMesa = "check".$mesaslibres[$i]->ID;
                    if(isset($_REQUEST[$idMesa])){
                        array_push($mesasEnComanda, $_REQUEST[$idMesa]);
                }
            }
        
        $objComanda = new Comanda();

        if(Validar($comanda,$fecha)){
            
            $id_comanda = $objComanda->NumeroComanda();
            
            if ($objComanda->Insertar($id_comanda,$comanda,$fecha,$idUsuario,$mesasEnComanda,$mesaPrincipal))
            {
                
//                array_push($mensajes, "Comanda registrada correctamente");
//                $mensajeEstado = "success";
                setSuccessMessage("Comanda registrada correctamente");
                header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$id_comanda");
            }
            else
            {
                
//                array_push($mensajes, "Error en el registro");
//                $mensajeEstado = "error";
                setSwalFailureMessage("Error en el registro. Intente más tarde.");
                header("Location: ../F_M_RegistrarComanda.php");
                
            }

        }
        else 
        {
                $mensajes=$errores;
                $mensajeEstado = "error";
        }
        
        $_SESSION['uri']=$mensajes;
        $_SESSION['mjsEstadoAgCo']=$mensajeEstado;
    }
    

?>
    








