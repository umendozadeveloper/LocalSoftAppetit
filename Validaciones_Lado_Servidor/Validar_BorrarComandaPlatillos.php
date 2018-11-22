<?php
    $idComandaP = $_POST['txtNUMCOMANDA'];
    $idComandaP = explode("|",$idComandaP);
    $idComandaP = $idComandaP[0];
        $objComandaPlatillos = new ComandaPlatillos();
                    if ($objComandaPlatillos->BorrarComandaP($idComandaP))
            {
                echo "<script>";
                echo "swal({
                title: 'Platillo borrado',   
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
    


