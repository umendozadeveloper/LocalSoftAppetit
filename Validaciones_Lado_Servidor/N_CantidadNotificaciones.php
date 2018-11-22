<?php
include_once '../Clases/ComandaMensajes.php';
include_once '../Clases/Seguridad.php';
$seguridad = new Seguridad();
$objComandaMensajes = new ComandaMensajes();
echo $objComandaMensajes->consultarNotificaciones($seguridad->CurrentUserID());
echo "|";
?>


