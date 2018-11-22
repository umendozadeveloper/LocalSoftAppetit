<?php 
include_once '../Clases/Seguridad.php';
include_once '../Clases/ComandaMensajes.php';
$seguridad = new Seguridad();

$script= $_GET['txtScript'];
$idComanda = $seguridad->CurrentUserID();
$objComandaMensajes = new ComandaMensajes();
$seguridad = new Seguridad();
$objComandaMensajes->Insertar($seguridad->CurrentUserID(), 'Cuenta', 'Cliente', 0, 3);
$_SESSION['comensalPresencia'] = 1;
header("Location: ../$script?idComanda=$idComanda");
?>