<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        //require './ComprobarSesion.php';
        require './PartesHTML/Header.php';
        ?>

        <title>Menú BIXA</title>
    </head>
    <body style="background-color: #fff">
        
        <?php
require './PartesHTML/LogoBIXA_Barra.php';
require './Clases/VistaMPV.php';
//echo $_SESSION['idComanda'];
$ruta = "";





    
    if(isset($_POST['btnPlatillo'])){
        
        $idPlatillo = $_POST['btnPlatillo'];
        //echo "<script>alert('Platillo con id = $idPlatillo');</script>";
        header("Location: SolicitarPlatillo.php?idPlatillo=$idPlatillo");
    
    }
    
    if(isset($_POST['btnVino'])){
            $idVino = $_POST['btnVino'];
            echo "<script>alert('Vino con id = $idVino');</script>";
            header("Location: SolicitarVino.php?idVino=$idVino");
        }

if(isset($_POST['btnAceptar'])){
            $ID = $_POST['btnAceptar'];
            $objVista = new VistaMPV();
            $submenus = $objVista->ConsultarPVS($ID);
            $ruta = $objVista->ConsultarRuta($ID);
            //$idComanda = $_POST['txtIDC'];
            //echo $idComanda;

            foreach ($ruta as $r){
                $ruta = $r->Ruta;
            }

        }
else {
$objVista = new VistaMPV();
$submenus = $objVista->ConsultarSinPadre();
$ruta = $objVista->ConsultarRuta("_");
//$idComanda = $_GET['idComanda'];
//echo $idComanda;
}



?>
        <div class="container">
            <br><label>Carpeta actual: 
                <?php 
                echo $ruta;
                ?></label>      
            </div>
            <div class="container">
            <div class="panel"><div class="panel-body no-padding-top no-padding-bottom"><!-- HEADER -->
            <form method="POST" name="formMenu" action="<?php echo $_SERVER['PHP_SELF'];?>">   
  <!--              <input type="text" name='txtIDC' value='<?php //echo $idComanda; ?>'>
  -->
        <?php
        
                foreach ($submenus as $s){       
                    echo "<div class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-4 col-md-4 col-lg-3'>";
                    
                    switch ($s->Tipo){
                        case "SubMenu":
                        echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnAceptar' value='$s->ID'>";
                        break;  
                    
                        case "Platillos":
                        echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnPlatillo' value='$s->ID'>";
                        break;
                    
                        case "Vinos";
                        echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnVino' value='$s->ID'>";
                        break;
                    }
                    echo "<img src='$s->Foto' class='img-rounded img-responsive img-responsive-static'>";
                    echo "</button>";
                    if($s->Tipo =="SubMenu"){
                        echo "<div class='menuSAdminVPM' ><label style='color: white'>$s->Clave<br>$s->Descripcion</label></div>";
                    }
                    else {
                        echo "<div class='platillosVinoSAdmin' ><label style='color: black'>$s->Clave<br>$s->Descripcion</label></div>";
                    }
                    echo "</div>";
                }          
        ?>

        </form>
        </div>
                </div>
                  
            <div class="container">
            <?php
            if($ruta=="Raíz"){
                echo "<a href='Comanda_A_Detalle.php'>Volver una carpeta atrás</a>";
            }
            else{
            ?>
            <a href="javascript:history.go(-1);">Volver una carpeta atrás</a>
            <?php
            }
            ?>
            <a href="PaginaPrincipal_Mesero.php" class="cerrarSesion" style="color: black;">Volver al menú Principal</a>
            </div>
            </div>
        
        


        

    </body>
</html>
