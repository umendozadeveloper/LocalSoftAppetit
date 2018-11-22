<?php
include_once '../Clases/Seguridad.php';
include_once '../Clases/Publicidad.php';
include_once './Funciones/Mensajes_Bootstrap.php';

$objPublicidad = new Publicidad();
$publicidad = $objPublicidad->Consultar();

$imagenesMostradas = 0;
for($i = 0; $i<count($publicidad);$i++){
    $nombreCheck = "check".$publicidad[$i]->ID;
    if(isset($_POST[$nombreCheck])){
        $imagenesMostradas++;
        $objPublicidad->Mostrar_OcultarPublicidad($publicidad[$i]->ID, 1);
    }
    else{
        $objPublicidad->Mostrar_OcultarPublicidad($publicidad[$i]->ID, 0);
    }
    
    header("Location: ../F_A_Publicidad.php");
}    
    
/*
foreach ($publicidad as $p){
    $nombrePOST = "check".$p->ID;
    if(isset($_POST[$nombrePOST])){
        insertaCedula($p->ID,$proyecto->ID);
    }
}*/

switch ($imagenesMostradas){
    case 0:
        setSuccessMessage("No se mostrará publicidad debido a que no se seleccionaron imágenes a mostrar");
        break;
    
    case 1:
            setSuccessMessage("Se ha editado correctamente ahora se mostrará $imagenesMostradas imagen en la publicidad");
            break;
    case $imagenesMostradas>1:
        setSuccessMessage("Se ha editado correctamente ahora se mostrarán $imagenesMostradas imágenes en la publicidad");
        break;
    
}
            
    
    



?>

