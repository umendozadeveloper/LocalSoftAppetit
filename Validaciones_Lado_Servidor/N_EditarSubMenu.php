<?php
include_once '../Clases/SubMenu.php';
include_once '../Clases/Seguridad.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
$objSubMenu = new SubMenu();

$idSubMenuPadre = "";
if(isset($_POST['radioMenu'])){
    $idSubMenuPadre= $_POST['radioMenu'];
}
else{
    $idSubMenuPadre= $_POST['txtIdPadreOriginal'];
}


$Id = $_POST['IdSubMenu'];
$destinoFoto = "../".$_POST['txtFotoOriginal'];
if(isset($_FILES['archivo'])){
    if($_FILES['archivo']['name']!=""){
        $foto = $_FILES['archivo']['name'];
        $extensionFoto = explode(".", $foto);
        $destinoFoto ="../bd_Fotos/SubMenu/".$Id."Foto.".$extensionFoto[1]."";
        $ruta = $_FILES['archivo']['tmp_name'];
    }
}

$subMenuHijos = $objSubMenu->ConsultarSubMenuPorIDPadre($Id);
$imposibleInsert = false;
foreach ($subMenuHijos as $s){
    if($idSubMenuPadre == $s->ID){
        $imposibleInsert = true;
    }
}


$nombre = $_POST['txtNombreSubMenu'];
$descripcion = $_POST['txtDescripcion'];

if($imposibleInsert){
    setFailureMessage("No fue posible editar el menú ya que seleccionó como ruta una subcategoría del menú que ha elegido");
    
       if($idSubMenuPadre==""){
        header("Location: ../F_A_ConsultarSubMenus.php?MenuPadre=1");    
    }
 else {
    header("Location: ../F_A_ConsultarSubMenus.php?idSubMenu=$idSubMenuPadre");    
 }
}

else{
$objSubMenu->ConsultarSubMenuPorID($Id);

if($objSubMenu->Editar($Id, $nombre, $descripcion, $destinoFoto, $idSubMenuPadre,$objSubMenu->Prioridad)){
    
    if(isset($foto) && $foto!=""){
        if(copy($ruta, $destinoFoto)){
            
        }
    }
    $_SESSION['mjsEditarMenu']="Correcto";
    
    if($idSubMenuPadre==""){
        header("Location: ../F_A_ConsultarSubMenus.php?MenuPadre=1");    
    }
 else {
    header("Location: ../F_A_ConsultarSubMenus.php?idSubMenu=$idSubMenuPadre");    
 }
    
}
else{
    if($idSubMenuPadre==""){
        header("Location: ../F_A_ConsultarSubMenus.php?MenuPadre=1");    
    }
 else {
    header("Location: ../F_A_ConsultarSubMenus.php?idSubMenu=$idSubMenuPadre");    
 }
 setSwalFailureMessage("No fue posible editar el menú verifique los datos ingresados");
 //setFailureMessage("No fue posible editar el menú verifique los datos ingresados");
   
 
}
    }
?>