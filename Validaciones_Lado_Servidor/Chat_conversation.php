<?php

include_once '../Clases/ComandaMensajes.php';
$objComandaMensajes = new ComandaMensajes();
$idComanda = $_POST['idComanda'];
$mensajes = $objComandaMensajes->ConsultarPorID($idComanda);
foreach($mensajes as $m){
    echo "<p><label style='color:rgb(170,25,39);'>".$m->Usuario."</label>: ".$m->Mensaje."</p>";
}
