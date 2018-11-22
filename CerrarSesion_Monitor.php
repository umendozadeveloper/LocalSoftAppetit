<?php
include_once './Clases/Seguridad.php';
$objSeguridad = new Seguridad();
$objSeguridad->Destruye();
session_destroy();
header("Location: F_A_LoginCocina.php");
?>
