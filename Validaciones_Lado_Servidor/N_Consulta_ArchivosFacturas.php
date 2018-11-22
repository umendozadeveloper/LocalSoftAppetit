<?php

require_once '../Clases/ArchivosFacturas.php';

$CER = $_POST['CER'];
$KEY = $_POST['KEY'];
$Pass = $_POST['Pass'];

$objArchivosFacturas = new ArchivosFacturas();
$objArchivosFacturas->ObtenerDatos($KEY, $CER, $Pass);
