<?php 
include_once '../Clases/ComandaMensajes.php';
include_once '../Clases/Comanda.php';
include_once '../Clases/Mesa.php';
include_once '../Clases/Seguridad.php';
$seguridad = new Seguridad();
$objComandaMensajes = new ComandaMensajes();
$comandas = $objComandaMensajes->ConsultarPresencia($seguridad->CurrentUserID());
$objMesa = new Mesa();
$principal = "";
$script= $_POST['txtScript'];

$cantidad = 0;
foreach ($comandas as $c){
    $mesa = $objMesa->ConsultarMesaPorIDComanda($c->IdComanda);
    foreach ($mesa as $m){
        if($m->MesaPrincipal==1)
        {
            $principal = $m->Numero;
        }
    }
    echo "<li><a href='Validaciones_Lado_Servidor/N_PresenciaLista.php?idComanda=$c->IdComanda&scrp=$script'> Se solicita presencia en la mesa ".$principal."<label style='color: red; font-size: 18px;'></label></a></li>";
    $cantidad++;
}
echo "||";
echo $cantidad;
echo "||";
?>

