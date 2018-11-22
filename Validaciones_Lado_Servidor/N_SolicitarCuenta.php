<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/ComandaMensajes.php';

$objComandaMensajes = new ComandaMensajes();
$seguridad = new Seguridad();
$objComandaMensajes->Insertar($seguridad->CurrentUserID(), 'Cuenta', 'Cliente', 0, 2);
header("Location: ../F_C_CerrarComanda.php");
$_SESSION['cuenta']=1;
?>
