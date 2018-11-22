<?php
include_once '../Clases/Platillo.php';
include_once '../Clases/ComandaPlatillos.php';
include_once '../Clases/ComandaVinos.php';
session_start();
echo $_POST['txtNUMCOMANDA'];
    

if(isset($_POST['txtNUMCOMANDA'])){
    
    $idComanda = $_POST['txtComanda'];
    $banderaP_V = $_POST['txtNUMCOMANDA'];
    $banderaP_V = explode("|", $banderaP_V);
    $banderaP_V = $banderaP_V[1];
    $alerta = array();
    $idComandaP_V = $_POST['txtNUMCOMANDA'];
    $idComandaP_V = explode("|",$idComandaP_V);
    $idComandaP_V = $idComandaP_V[0];
    switch ($banderaP_V){
        
        
    case "Platillo":
        $nombretxtP = "txtNumPlatillos".$idComandaP_V;
        $cantidadCP = $_POST[$nombretxtP];
    $objComandaPlatillos = new ComandaPlatillos();
            if ($objComandaPlatillos->BorrarComandaP($idComandaP_V))
            {
                array_push($alerta, "Platillo Borrado");
                header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
            }
            else
            {
                array_push($alerta, "Error");
                header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
            }
    break;
                        
    case "Vino":
    $objComandaVinos = new ComandaVinos();
            if ($objComandaVinos->BorrarComandaV($idComandaP_V))
                    {
                        array_push($alerta, "Vino Borrado");
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
                    }
                    else
                    {
                        array_push($alerta, "Error");
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
                    }
    break;
                    
    case "PlatilloGuardar":        
        $nombretxtP = "txtNumPlatillos".$idComandaP_V;
        $cantidadCP = $_POST[$nombretxtP];
            $objComandaPlatillos = new ComandaPlatillos();
                    if ($objComandaPlatillos->EditarComandaP($idComandaP_V,$cantidadCP))
                    {
                        array_push($alerta, "Platillo Editado Correctamente");
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");       
                    }
                    else
                    {
                        array_push($alerta, "Error");
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
                    }
        break;
    
    case "VinoGuardar":
        $nombretxtNumCopas = "txtNumCopas".$idComandaP_V;
        $cantidadCopas = $_POST[$nombretxtNumCopas];
        $nombretxtNumBotellas = "txtNumBotellas".$idComandaP_V;
        $cantidadBotellas = $_POST[$nombretxtNumBotellas];
        $objComandaVinos = new ComandaVinos();
            if ($objComandaVinos->EditarComandaV($idComandaP_V,$cantidadCopas,$cantidadBotellas))
            {
                array_push($alerta, "Vino Editado Correctamente");
                header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");

            }
            else
            {
                array_push($alerta, "Error");
                header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
                
            }
    break;
    
    
    case "VinoListo":
        $objComandaVinos = new ComandaVinos();
                    if ($objComandaVinos->EditarComandaP_VinoListo($idComandaP_V))
                    {
                        array_push($alerta, "Vino Editado Correctamente");
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");       
                    }
                    else
                    {
                        array_push($alerta, "Error");
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
                    }
        break;
        
    case "PlatilloListo":
            $objComandaPlatillos = new ComandaPlatillos();
                    if ($objComandaPlatillos->EditarComandaP_PlatilloListo($idComandaP_V))
                    {
                        array_push($alerta, "Platillo Editado Correctamente");
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");       
                    }
                    else
                    {
                        array_push($alerta, "Error");
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
                    }
                    break;
                }
                
                
                
                $_SESSION['alertaDetalle'] = $alerta;
}
else{
    header("Location: ../F_M_ConsultarComandas.php");
}

?>
