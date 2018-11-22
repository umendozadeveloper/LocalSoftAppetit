<?php
include_once '../Clases/ComandaMensajes.php';
$Id_Comanda = $_POST['Id_Comanda'];
$objComandaMensajes = new ComandaMensajes();
echo $objComandaMensajes->ultimoId($Id_Comanda);

