<?php

include_once  '../Clases/Vino.php';
include_once '../Clases/SubMenu.php';
include_once '../Clases/VinosSubMenu.php';
include_once '../Clases/Maridaje.php';
include_once '../Clases/Platillo.php';
include_once './Funciones/Mensajes_Bootstrap.php';

$errores = array();
function Validar($nombre, $descripcionCorta,$descripcionLarga,$precioCopa,$precioBotella,$icono,$foto){
        global $errores;
        if(is_null($nombre))
        {
            array_push($errores, "El número de mesas no puede estar vacío");
        }
        if(is_null($descripcionCorta))
        {
            array_push($errores, "La cantidad de personas por mesa no puede estar vacía");
        }
        
        if(is_null($descripcionLarga))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        
        if(is_null($precioBotella))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        
        if(is_null($precioCopa))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        
        if(is_null($icono))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        
        if(is_null($foto))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        
        
        if($errores)
        {
            $_SESSION['tipo'] = "error";
            $_SESSION['titulo'] = "Error";
            return FALSE;
        }
        else
        {   
            return TRUE;
        }
    }



if($_POST){
    
        $objVino = new Vino();
        $nombre = $_REQUEST['txtNombreVino'];
        $descripcionCorta = $_REQUEST['txtDescripcionCorta'];
        $descripcionLarga = $_REQUEST['txtDescripcionLarga'];
        $precioCopa = $_REQUEST['txtPrecioCopa'];
        $precioBotella = $_REQUEST['txtPrecioBotella'];
        $icono = $_FILES['archivoIco']['name'];
        $extensionIco = explode(".", $icono);
        $destinoIco ="../bd_Fotos/Vinos/".$objVino->obtenerId()."Ico.".$extensionIco[1]."";
        //$destinoIco = "../bd_Fotos/Vinos/".$nombre.$icono;
        $rutaIco = $_FILES['archivoIco']['tmp_name'];
        $foto = $_FILES['archivo']['name'];
        //$destino ="../bd_Fotos/Vinos/".$nombre.$foto;
        $extensionFoto = explode(".", $foto);
        $destino ="../bd_Fotos/Vinos/".$objVino->obtenerId()."Foto.".$extensionFoto[1]."";
        $ruta = $_FILES['archivo']['tmp_name'];
        $iva = $_REQUEST['txtIVA'];
        
        
        //$objVino->Vino();
        $mensajes=array();
        $banderaSubMenu = $_POST['cmbMenu'];
        $banderaMaridaje = $_POST['cmbMaridaje'];
        if(Validar($nombre, $descripcionCorta,$descripcionLarga,$precioCopa,$precioBotella,$icono,$foto)){
            
            $_SESSION['valNombre'] = $nombre;
            $_SESSION['valDescripcionCorta'] = $descripcionCorta;
            $_SESSION['valDescripcionLarga'] = $descripcionLarga;
            $_SESSION['valPrecioCopa'] = $precioCopa;
            $_SESSION['valPrecioBotella'] = $precioBotella;
            $_SESSION['valIcono'] = $icono;
            $_SESSION['valFoto'] = $foto;
            $_SESSION['valIVA'] = $iva;

            if ($objVino->Insertar($nombre, $descripcionCorta, $descripcionLarga, $precioCopa,$precioBotella, $destinoIco, $destino, $iva))
            {
                
                if($foto!=""){
                    if(copy($ruta, $destino))
                        echo "";
                }
                
                if($icono!=""){
                    if(copy($rutaIco, $destinoIco))
                            echo "";
                }
                
                if($banderaSubMenu==1){
                    $objSubMenu = new SubMenu();
                    $submenus = $objSubMenu->ConsultarSubMenuBebidasDisponibles();
                    $objVinosSubMenu = new VinosSubMenu();
                    foreach($submenus as $s){
                        $nombrePOST = "subMenu".$s->ID;
                        if(isset($_POST[$nombrePOST]) && $_POST[$nombrePOST]!=NULL){
                            $objVinosSubMenu->Insertar($objVino->ID, $s->ID);
                        }
                    }
                }
                
                
                if($banderaMaridaje==1){
                    $objPlatillo = new Platillo();
                    $platillos = $objPlatillo->ConsultarTodo();
                    $objMaridaje = new Maridaje();
                    foreach($platillos as $p){
                        $nombrePOST = "platillo".$p->ID;
                        if(isset($_POST[$nombrePOST]) && $_POST[$nombrePOST]!=NULL){
                            $objMaridaje->Insertar($objVino->ID, $p->ID);
                        }
                    }
                }
            
                
                $_SESSION['valNombre'] = null;
                $_SESSION['valDescripcionCorta'] = null;
                $_SESSION['valDescripcionLarga'] = null;
                $_SESSION['valPrecioCopa'] = null;
                $_SESSION['valPrecioBotella'] = null;
                $_SESSION['valIVA'] = null;
                $_SESSION['valIcono'] = null;
                $_SESSION['valFoto'] = null;
                $_SESSION['tipo'] = "success";
                $_SESSION['titulo'] = "Correcto";
                setSuccessMessage("Vino registrado correctamente");
                header("Location: ../F_A_DetalleBebida.php?IdVino=$objVino->ID");
                
   
            }
            else
            {
                $_SESSION['tipo'] = "error";
                $_SESSION['titulo'] = "Error";
                array_push($mensajes, "El nombre de vino ya está registrado, favor de ingresar otro nombre.");
                header("Location: ../F_A_RegistrarVino.php");
                
            }

        }
        else 
        {
                $mensajes=$errores;
                header("Location: ../F_A_RegistrarVino.php");
        }
        $_SESSION['msjRegistrarVino']=$mensajes;
    }
?>
    

