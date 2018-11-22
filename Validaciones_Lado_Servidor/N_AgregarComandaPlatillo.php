<?php
include_once '../Clases/ComandaPlatillos.php';
include_once '../Clases/Comanda.php';
include_once '../Clases/Seguridad.php';

session_start();
$comentarios = NULL;
$objSeguridad = new Seguridad(); 
$cantidad= $_POST['txtCantidad'];
$idComanda = $_SESSION['idComanda'];
//echo "ID de la comanda".$idComanda."<br>";
$idPlatillo = $_POST['txtPlatillo'];

$idMenu =$_POST['txtMenu'];
$precio =$_POST['txtPrecio'];
$comentarios = "'".$_POST['txtComentarios']."'";
$objComandaPlatillos = new ComandaPlatillos();
$objComanda = new Comanda();
$objComanda->ConsultarPorID($idComanda);
echo $objComanda->Cerrada;
if($objComanda->Cerrada == 0)
{
if($objComandaPlatillos->InsertarPorMesero($idComanda, $idPlatillo, $cantidad, $precio, $comentarios)){


    $_SESSION['msjSolicitarPlatillo']="Platillo ordenado correctamente";

    if(isset($_POST['txtVino'])){
        $_SESSION['ventanaModal']=true;
        $idVino = $_POST['txtVino'];
        header("Location: ../VentanaModalParaMenuBixa.php?idComanda=$idComanda&msjSolicitarPlatillo=1&idMenu=$idMenu&idPlatillo=$idVino&producto=2");
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