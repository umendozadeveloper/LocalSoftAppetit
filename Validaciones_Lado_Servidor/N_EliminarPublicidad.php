<?php
include_once '../Clases/Publicidad.php';
$objPublicidad = new Publicidad();
$ID = $_POST['txtId_Publcidad'];
$objPublicidad->BorradoFisico($ID);
header("Location: ../F_A_Publicidad.php");
?>
