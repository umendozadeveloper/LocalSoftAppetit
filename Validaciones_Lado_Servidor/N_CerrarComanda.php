<?php
require_once '../Clases/Mesero.php';
include_once '../Clases/Seguridad.php';

$objSeguridad = new Seguridad();
$idMeseroReal = $objSeguridad->CurrentOtroUsuario();
$contrasena = $_POST['txtContrasena'];
$objMesero = new Mesero();
$correcto = $objMesero->LoginPorID($idMeseroReal, $contrasena);

if(count($correcto)>0){
    $objSeguridad->Destruye();
    session_destroy();
    header("Location: ../F_C_LoginComensal.php");
    
}
 else {
     $mensaje = "Contraseña incorrecta";
    header("Location: ../F_C_CerrarComanda.php");
    
}

$_SESSION['mensajeCerrarC']=$mensaje;

?>
