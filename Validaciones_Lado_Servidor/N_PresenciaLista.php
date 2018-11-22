<?php
session_start();
include_once '../Clases/ComandaMensajes.php';
$objComandaMensajes = new ComandaMensajes();

$idComanda = $_GET['idComanda'];
$objComandaMensajes->EliminarSolicitarPresencia($idComanda);
$script = $_GET['scrp'];


header("Location: ../$script");
$_SESSION['valPresencia'] = "Presente";
echo $script;