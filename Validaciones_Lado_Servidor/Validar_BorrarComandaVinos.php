<?php    
    $idComandaV = $_POST['txtNUMCOMANDA'];
    
    $idComandaV = explode("|",$idComandaV);
    $idComandaV = $idComandaV[0];
    
    
                
    $objComandaVinos = new ComandaVinos();
            if ($objComandaVinos->BorrarComandaV($idComandaV))
            {
                echo "<script>";
                echo "swal({
                title: 'Vino borrado',   
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
    


