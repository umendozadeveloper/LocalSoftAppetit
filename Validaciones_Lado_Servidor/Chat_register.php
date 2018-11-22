<?php
echo "<script>alert('s');</script>";
include_once '../Clases/ComandaMensajes.php';
$objComandaMensajes = new ComandaMensajes();

$user = $_POST['user'];
$mensajes = $_POST['message'];
$idComanda = $_POST['txtComanda'];
if($user=="Mesero"){
    $objComandaMensajes->Insertar($idComanda, $mensajes, $user,1);
    $objComandaMensajes->Visto($idComanda);
}
else{
    $objComandaMensajes->Insertar($idComanda, $mensajes, $user);
    
}



?>