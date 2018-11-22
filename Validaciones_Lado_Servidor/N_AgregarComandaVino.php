<?php

include_once '../Clases/ComandaVinos.php';
include_once '../Clases/Comanda.php';
session_start();
//$cantidadCopas= $_POST['txtNumC'];
//$cantidadBotellas= $_POST['txtNumB'];
$cantidadCopas= $_POST['txtCantidadCopas'];
$cantidadBotellas= $_POST['txtCantidadBotellas'];
$idComanda = $_SESSION['idComanda'];
$idMenu =$_POST['txtMenu'];
echo "ID de la comanda".$idComanda."<br>";
$idVino = $_POST['txtVino'];
$precioC =$_POST['txtPrecioCopa'];
$precioB =$_POST['txtPrecioBotella'];
$comentarios = $_POST['txtComentarios'];
$objComandaVinos = new ComandaVinos();
$objComanda = new Comanda();
$objComanda->ConsultarPorID($idComanda);

if($objComanda->Cerrada == 0)
{
if($objComandaVinos->InsertarPorMesero($idComanda, $idVino, $cantidadCopas,$cantidadBotellas, $precioC,$precioB, $comentarios)){
$_SESSION['msjSolicitarPlatillo']="Vino ordenado correctamente";    


if(isset($_POST['txtPlatillo'])){
    $_SESSION['ventanaModal']=true;
    $idPlatillo = $_POST['txtPlatillo'];
    header("Location: ../VentanaModalParaMenuBixa.php?idComanda=$idComanda&msjSolicitarPlatillo=1&idMenu=$idMenu&idPlatillo=$idPlatillo&producto=1");
}
 else {
    header("Location: ../VentanaModalParaMenuBixa.php?idComanda=$idComanda&msjSolicitarPlatillo=1&idMenu=$idMenu");
}
        
}
}
 else {
     $objSeguridad->Destruye();
    session_destroy();
    header("Location: ../F_C_LoginComensal.php");
}

?>