<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/Banner.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
$Visible = $_POST['visible'];
$objBanner = new Banner();
$objBanner->Mostrar_OcultarPublicidad($Visible);
if($Visible == 1){
    echo "Se mostrará la barra de publicidad";
}
else
    echo "Se ocultará la barra de publicidad";

?>
