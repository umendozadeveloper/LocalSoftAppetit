<?php
include_once '../Clases/Vino.php';
include_once '../Clases/VinosSubMenu.php';
include_once '../Clases/SubMenu.php';
include_once '../Clases/Platillo.php';
include_once '../Clases/Maridaje.php';
include_once '../Clases/ProductoCompuesto.php';
session_start();
$errores = array();
function Validar($nombre, $descripcionCorta,$descripcionLarga,$precioCopa,$precioBotella){
        global $errores;
        if(is_null($nombre))
        {
            array_push($errores, "El número de mesas no puede estar vacío");
        }
        
        
        if(is_null($precioBotella))
        {
            array_push($errores, "El el precio no puede estar vacío");
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



if($_POST){
    try{
        $objVino = new Vino();
        
        $id = $_REQUEST['respaldoDatosP'];
        $objVino->ConsultarPorID($id);
        $nombre = $_REQUEST['txtNombrePlatillo'];
        $nombreOriginal = $_REQUEST['respaldoDatosPNombre'];
        $descripcionCorta = $_REQUEST['txtDescripcionCorta'];
        $descripcionLarga = $_REQUEST['txtDescripcionLarga'];
        $precioCopa = $_REQUEST['txtPrecioCopa'];
        $precioBotella = $_REQUEST['txtPrecioBotella'];
        $iva = $_REQUEST['txtIVA'];
        $compuesto = $_POST['cmbProductoCompuesto'];
        $tope = $_POST['txtTope'];
        $doblePresentacion = $_POST['txtDoble'];

        
        $banderaIco = $_REQUEST['cmbIcono'];
        if($banderaIco=="Si")
        {
            $icono = $_FILES['archivoIco']['name'];
            //$destinoIco = "../bd_Fotos/Vinos/".$nombre.$icono;
            $extensionIco = explode(".", $icono);
            
            if((file_exists("../".$objVino->Icono))){                    
                    unlink("../".$objVino->Icono);
            }
            
            $destinoIco ="../bd_Fotos/Vinos/".$id."_". rand(0, 999999)."_Ico.".$extensionIco[1]."";
            $rutaIco = $_FILES['archivoIco']['tmp_name'];
        
}

        else{
            $destinoIco="";
            $icono = "";
        }

        
        $banderaFoto = $_REQUEST['cmbFoto'];
        if($banderaFoto=="Si"){
            $foto = $_FILES['archivo']['name'];
            //$destino ="../bd_Fotos/Vinos/".$nombre.$foto;
            $extensionFoto = explode(".", $foto);
            
            if((file_exists("../".$objVino->Foto))){                    
                    unlink("../".$objVino->Foto);
            }
            $destinoFoto ="../bd_Fotos/Vinos/".$id."_". rand(0, 999999)."_Foto.".$extensionFoto[1]."";
            $rutaFoto = $_FILES['archivo']['tmp_name'];

        }
        else{
            $destinoFoto="";
            $foto = "";
        }
        
        $mensajes=array();
        
        
        $banderaSommelier = $_REQUEST['cmbMaridaje'];
        if($banderaSommelier=="Si"){
            $arregloPlatillos = array();
            $objPlatillo = new Platillo();
            $platillos = $objPlatillo->ConsultarTodo();
            $objMaridaje = new Maridaje();
            $maridaje = $objMaridaje->ConsultarPorIdVino($id);
            foreach ($platillos as $p){
                $nombrePOST = "Platillo".$p->ID;
                if($_POST[$nombrePOST]!=NULL){
                    array_push($arregloPlatillos,$_POST[$nombrePOST]);
                }
            }
            $objMaridaje->BorradoFisico($id);
            for($i=0;$i<count($arregloPlatillos);$i++){
                $objMaridaje->Insertar($id,$arregloPlatillos[$i]);
            }
                
        }
        
        
        $banderaSubMenu = $_REQUEST['cmbSubMenus'];
        if($banderaSubMenu=="Si"){
            $arregloSubMenus = array();
            $objSubMenu = new SubMenu();
            $objVinosSubMenu = new VinosSubMenu();
            $submenus = $objSubMenu->ConsultarSubMenuBebidasDisponibles();
            foreach($submenus as $s){
                $nombrePOST = "SubMenu".$s->ID;
                if($_POST[$nombrePOST]!=NULL){
                    
                    array_push($arregloSubMenus, $_POST[$nombrePOST]);
                }
            }
            $objVinosSubMenu->BorradoFisico($id);
            for($i=0;$i<count($arregloSubMenus);$i++){
                $objVinosSubMenu->Insertar($id, $arregloSubMenus[$i]);
            }
        }
        
        
        
        
        
        
        if(Validar($nombre, $descripcionCorta,$descripcionLarga,$precioCopa,$precioBotella)){
            
            if ($objVino->ModificarVinoPorID($id,$nombre, $descripcionCorta, $descripcionLarga, $precioCopa,$precioBotella, $banderaIco, $banderaFoto, $destinoIco, $destinoFoto, $iva, $compuesto, $tope,$doblePresentacion))

            {
                
                if($foto!=""){
                    if(copy($rutaFoto, $destinoFoto))
                        echo "";
                }
                
                if($icono!=""){
                    if(copy($rutaIco, $destinoIco))           
                            echo "";
                }
                
                if($compuesto==1){
                    $arregloProductos = json_decode($_POST['txtArrayProductos']);
                      $objProductoCompuesto = new ProductoCompuesto();
                      if($objProductoCompuesto->borradoFisicoPorIdProducto($id, 1)){
                            foreach($arregloProductos as $producto){
                                $objProductoCompuesto->Insertar($id, 1, $producto->IdSubProducto, $producto->IdTipoSubProducto, $producto->Cantidad);                                
                            }
                      }
                }
           
                
                array_push($mensajes, "Bebida editada correctamente");
                header("Location: ../F_A_EditarVino.php?IdVino=$id");
                
                
   
            }
            else
            {
                array_push($mensajes, "Error, el nombre de la bebida ya está registrado favor de introducir otro nombre");
                //header("Location: ../F_A_EditarVino.php?IdVino=$id");
                
            }

        }
        else 
        {
                $mensajes=$errores;
 //               header("Location: Login.php");
        }
        $_SESSION['msjEditarVino']=$mensajes;
    }catch(Exception $e){
        echo "Error: ";
        echo $e->getMessage();
    }
}
?>
    


