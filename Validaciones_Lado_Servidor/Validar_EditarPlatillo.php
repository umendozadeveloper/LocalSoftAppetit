<?php
include_once '../Clases/Platillo.php';
include_once '../Clases/Sommelier.php';
include_once '../Clases/Vino.php';
include_once '../Clases/PlatillosSubMenu.php';
include_once '../Clases/SubMenu.php';
include_once '../Clases/Seguridad.php';
include_once './Funciones/Mensajes_Bootstrap.php';

$errores = array();
function Validar($nombre, $descripcionCorta,$descripcionLarga,$precio/*, $iva*/){
        global $errores;
        if(is_null($nombre))
        {
            array_push($errores, "El nombre no puede estar vacío");
        }
        if(is_null($descripcionCorta))
        {
            array_push($errores, "La descripción corta no puede estar vacía");
        }
        
        if(is_null($descripcionLarga))
        {
            array_push($errores, "La descripción larga no puede estar vacía");
        }
        
        if(is_null($precio))
        {
            array_push($errores, "El campo precio no puede estar vacio");
        }
//        if(is_null($iva))
//        {
//            array_push($errores, "");
//        }
        
       
        
        
        
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
    
        $idOriginal = $_REQUEST['respaldoDatosP'];
        $nombreOriginal = $_POST['respaldoDatosPNombre'];
        $nombre = $_REQUEST['txtNombrePlatillo'];
        $descripcionCorta = $_REQUEST['txtDescripcionCorta'];
        $descripcionLarga = $_REQUEST['txtDescripcionLarga'];
        $precio = $_REQUEST['txtPrecio'];
        $iva = $_POST['txtIVA'];
        $id_tiempo = $_POST['cmbTiempo'];

        
        $banderaIco = $_REQUEST['cmbIcono'];
        if($banderaIco=="Si")
        {
            $icono = $_FILES['archivoIco']['name'];
            $extensionIco = explode(".", $icono);
            $destinoIco ="../bd_Fotos/Platillos/".$idOriginal."Ico.".$extensionIco[1]."";
            $rutaIco = $_FILES['archivoIco']['tmp_name'];
        
}

        else{
            $destinoIco="";
            $icono = "";
        }

        
        $banderaFoto = $_POST['cmbFoto'];
        if($banderaFoto=="Si"){
            $foto = $_FILES['archivo']['name'];
            //$destinoFoto ="../bd_Fotos/Platillos/".$nombre.$foto;
            //$rutaFoto = $_FILES['archivo']['tmp_name'];
            
            $extensionFoto = explode(".", $foto);
            $destinoFoto ="../bd_Fotos/Platillos/".$idOriginal."Foto.".$extensionFoto[1]."";
            $rutaFoto = $_FILES['archivo']['tmp_name'];
            
        }
        else{
            $destinoFoto="";
            $foto = "";
        }
        $objPlatillo = new Platillo();
        $mensajes=array();
        
        
        $banderaSommelier = $_POST['cmbSommelier'];
        
        /**SOMMELIER***/
        if($banderaSommelier=="Si"){
            $arregloVino = array();
            $objVino = new Vino();
            $vinos = $objVino->ConsultarTodos();
            $objSommelier = new Sommelier();
            $sommelier = $objSommelier->ConsultarPorIdPlatillo($idOriginal);
            foreach ($vinos as $v){
                $nombrePOST = "Vino".$v->ID;
                if($_POST[$nombrePOST]!=NULL){
                    array_push($arregloVino,$_POST[$nombrePOST]);
                }
            }
            $objSommelier->BorradoFisico($idOriginal);
            for($i=0;$i<count($arregloVino);$i++){
                $objSommelier->Insertar($arregloVino[$i], $idOriginal);
            }
        }
        
        /*Sub Menús*/
        $banderaSubMenu = $_REQUEST['cmbSubMenus'];
        if($banderaSubMenu=="Si"){
            $arregloSubMenus = array();
            $objSubMenu = new SubMenu();
            $objPlatilloSubMenu = new PlatillosSubMenu();
            $submenus = $objSubMenu->ConsultarSubMenuPlatillosDisponibles();
            foreach($submenus as $s){
                $nombrePOST = "SubMenu".$s->ID;
                if($_POST[$nombrePOST]!=NULL){
                    
                    array_push($arregloSubMenus, $_POST[$nombrePOST]);
                }
            }
            $objPlatilloSubMenu->BorradoFisico($idOriginal);
            for($i=0;$i<count($arregloSubMenus);$i++){
                $objPlatilloSubMenu->Insertar($idOriginal, $arregloSubMenus[$i]);
            }
        }
        
        
        
        
        
        if(Validar($nombre, $descripcionCorta,$descripcionLarga,$precio/*, $iva*/)){
            
            if ($objPlatillo->ModificarPlatilloPorID($idOriginal,$nombre, $descripcionCorta,
                    $descripcionLarga, $precio, $banderaIco, $banderaFoto, $destinoIco,
                    $destinoFoto, $iva, $id_tiempo))
            {
                if($foto!=""){
                    if(copy($rutaFoto, $destinoFoto))
                        echo "";
                }
                
                if($icono!=""){
                    if(copy($rutaIco, $destinoIco))           
                            echo "";
                }
                setSuccessMessage("Platillo editado correctamente");
                header("Location: ../F_A_EditarPlatillo.php?IdPlatillo=$idOriginal");

            }
            else
            {
                array_push($mensajes, "Error, el nombre de platillo ya está registrado favor de introducir otro nombre");
                header("Location: ../F_A_EditarPlatillo.php?IdPlatillo=$idOriginal");
                
            }

        }
        else 
        {
                $mensajes=$errores;
 //               header("Location: Login.php");
        }
        
    }
?>
    


