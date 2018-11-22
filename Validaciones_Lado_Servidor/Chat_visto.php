<?php 
include_once '../Clases/ComandaMensajes.php';
$objComandaMensajes = new ComandaMensajes();
$idComanda = $_POST['comandaV'];
$objComandaMensajes->Visto($idComanda);


?>