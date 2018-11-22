<?php 
include_once '../Clases/ComandaMensajes.php';
$objComandaMensajes = new ComandaMensajes();
$comandas = $_POST['arregloC'];
echo ",";
for($i=0; $i<count($comandas);$i++){
    $tam = $objComandaMensajes->ConsultarNoVistasPorID($comandas[$i]);
    if(count($tam)>0){
        echo $comandas[$i];
        if($i<count($comandas))
            echo ",";
    }
}
?>