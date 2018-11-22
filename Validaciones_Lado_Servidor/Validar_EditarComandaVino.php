<?php
if ($thisPost->postBlock($_POST['postID'])) {  
$idComandaV = $_POST['txtNUMCOMANDA'];
    $idComandaV = explode("|",$idComandaV);
    $idComandaV = $idComandaV[0];
    $nombretxtNumCopas = "txtNumCopas".$idComandaV;
    $cantidadCopas = $_POST[$nombretxtNumCopas];
    //echo "<script>alert('');</script>"; ;
    //echo "<script>alert('$nombretxtP');</script>";
    
    $nombretxtNumBotellas = "txtNumBotellas".$idComandaV;
    $cantidadBotellas = $_POST[$nombretxtNumBotellas];
    
        $objComandaVinos = new ComandaVinos();
                    if ($objComandaVinos->EditarComandaV($idComandaV,$cantidadCopas,$cantidadBotellas))
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

        }
?>
    

