<?php 
include_once '../Clases/ComandaMensajes.php';
include_once '../Clases/Seguridad.php';
include_once '../Clases/Mesa.php';
$seguridad = new Seguridad();
$objComandaMensajes = new ComandaMensajes();
$comandas = $objComandaMensajes->ConsultaSolitaCuenta($seguridad->CurrentUserID());

$objMesa = new Mesa();
$cantidad = 0;
$principal = "";
foreach ($comandas as $c){
    $mesa = $objMesa->ConsultarMesaPorIDComanda($c->IdComanda);
    foreach ($mesa as $m){
        if($m->MesaPrincipal==1)
        $principal = $m->Numero;
    }
    echo "<li><a href='F_M_Comanda_A_Detalle.php?idComanda=$c->IdComanda'> Se solicita cuenta en la mesa ".$principal."<label style='color: red; font-size: 18px;'></label></a></li>";
    $cantidad++;
}
echo "||";
echo $cantidad;
echo "||";
?>

