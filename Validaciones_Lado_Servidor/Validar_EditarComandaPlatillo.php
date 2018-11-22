<?php


    include_once 'Clases/Platillo.php';
    $idComandaP = $_POST['txtNUMCOMANDA'];
    $idComandaP = explode("|",$idComandaP);
    $idComandaP = $idComandaP[0];
    $nombretxtP = "txtNumPlatillos".$idComandaP;
    $cantidadCP = $_POST[$nombretxtP];
    //echo "<script>alert('');</script>"; ;
    //echo "<script>alert('$nombretxtP');</script>";
    
        $objComandaPlatillos = new ComandaPlatillos();
            if ($objComandaPlatillos->EditarComandaP($idComandaP,$cantidadCP))
            {
                echo "<script>";
                echo "swal({
                title: 'Edición Correcta',   
		text: '',   
		timer: 1700,   
		showConfirmButton: false });";
                echo "setTimeout(function() {window.location = 'F_M_Comanda_A_Detalle.php'}, 1700);";
                echo "</script>"; 
            }
            else
            {
                echo "<script>";
                echo "swal('Error');";
                echo "</script>"; 
                
            }

        
?>
    


