<?php
include_once '../Clases/SubMenu.php';
session_start();

$idMenu = $_POST['IdSubMenu'];
$menuPadre = $_POST['txtIdPadreOriginal'];
$objSubMenu = new SubMenu();
$objSubMenu->ConsultarSubMenuPorID($idMenu);
if((file_exists("../".$objSubMenu->Foto))){                    
                    unlink("../".$objSubMenu->Foto);
}
if($objSubMenu->Eliminar($idMenu)){
    $_SESSION['eliminarMenu']="1";
    
}
else{
    $_SESSION['errorMenu']="si";
  
}
header("Location: ../F_A_ConsultarSubMenus.php?idSubMenu=$menuPadre");

?>

