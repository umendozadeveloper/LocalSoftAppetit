
        <?php require 'Header.php';?>
        
        <title></title>
            
            
            <?php

require './Clases/VistaMPV.php';
/*
if(isset($_SESSION['msjSolicitarPlatillo']) && !empty($_SESSION['msjSolicitarPlatillo'])){
    echo "<script>swal('".$_SESSION['msjSolicitarPlatillo']."');</script>";
    $_SESSION['msjSolicitarPlatillo']=null;
}*/
//echo $_SESSION['idComanda'];
$ruta = "";

    if(isset($_POST['btnPlatillo'])){
        
        $idPlatillo = $_POST['btnPlatillo'];
        //header("Location: SolicitarPlatillo.php?idPlatillo=$idPlatillo");
    
    }
    
    if(isset($_POST['btnVino'])){
            $idVino = $_POST['btnVino'];
            header("Location: SolicitarVino.php?idVino=$idVino");
        }

if(isset($_GET['btnAceptar'])){
            $ID = $_GET['btnAceptar'];
            $objVista = new VistaMPV();
            $submenus = $objVista->ConsultarPVS($ID);
            $ruta = $objVista->ConsultarRuta($ID);
            $banderaRuta = true;
            foreach ($ruta as $r){
                $ruta = $r->Ruta;
            }

        }
else {
$objVista = new VistaMPV();
$submenus = $objVista->ConsultarSinPadre();
$ruta = $objVista->ConsultarRuta("_");
$banderaRuta = false;
/*$idComanda = $_GET['idComanda'];
echo $idComanda;*/
}

if(isset($_GET['msjSolicitarPlatillo'])){
    if($_GET['msjSolicitarPlatillo']==1){
        session_start();
        if(isset($_SESSION['msjSolicitarPlatillo'])&&!empty($_SESSION['msjSolicitarPlatillo']))
        {
            echo "<script>swal('Correcto','".$_SESSION['msjSolicitarPlatillo']."','success');</script>";
            $_SESSION['msjSolicitarPlatillo']=null;
        }
        $_GET['msjSolicitarPlatillo']=0;
    }
}



?>
        
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
              <br>
        <label>Carpeta actual: 
                <?php if($banderaRuta==true)
                echo $r->Ruta;
                else{
                    echo "Raíz";
                    
                }
            ?></label>
        <?php if($banderaRuta==true){?>
        
                    <button onclick="javascript:history.go(-1);" type="button" class="btn btn-default btn-ms" style="float: right">
                        Una carpeta atrás
                    </button>
            
              <br>
              <br>
              <a class="btn btn-default btn-ms" href="F_A_MenuBixaAdmin.php" style="float: right;">
                        Inicio
                    </a>
            </div>    
        
        
        <?php
        }
        ?>
        
        
            <div class="panel"><div class="panel-body no-padding-top no-padding-bottom">
            <form method="GET" name="formMenu" action="<?php echo $_SERVER['PHP_SELF'];?>">   
  <!--              <input type="text" name='txtIDC' value='<?php //echo $idComanda; ?>'>
  -->
  
  
        <?php
        if($banderaRuta==true){
            echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10'>";
        }
        else{
            echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-12'>";
        }
            
            echo "<br>";
                foreach ($submenus as $s){       
                    if($banderaRuta==true){
                        echo "<div class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-6 col-lg-3'>";
                    }
                    else{
                        echo "<div class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-offset-1 col-lg-5'>";
                    }
                        
                    
                    switch ($s->Tipo){
                        case "SubMenu":
                        echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnAceptar' value='$s->ID'>";
                        break;  
                    
                        case "Platillos":
                        //echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnPlatillo' value='$s->ID'>";
                            echo "<button type='button' class='open-Modal noboton' data-id='$s->ID' data-toggle='modal' data-target='#myModalDialog'>";
                        break;
                    
                        case "Vinos";
                        //echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnVino' value='$s->ID'>";
                            echo "<button type='button' class='open-Modal2 noboton' data-id='$s->ID' data-toggle='modal' data-target='#login-modal'>";
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
        
                  
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-11">
            <?php
            if($ruta=="Raíz"){
                echo "<a class='btn btn-default btn-ms' href='F_A_PaginaPrincipal.php' style='float: right;'>
                        Menú Principal
                    </a>";
                
                ?>

            <?php }
            else{
            ?>
            <button onclick="javascript:history.go(-1);" type="button" class="btn btn-default btn-ms" style="float: left">
                        Una carpeta atrás
            </button>
            <?php
            }
            ?>
                    <br>
                    <br>
                    <br>
            </div>  
                
        
            
            
            
            <!-- VENTANA MODAL QUE USA EL SCRIPT DE ARRIBA PARA PASARLE VALORES -->        
        			<div class="modal fade" id="myModalDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Datos del platillo</h4>
						</div>

                                                <div class="modal-body">
                                                 
                                                    <input class="ocultar" type="text" name="DNI" id="DNI"/>
                                                <div id="cmbMunicipio">
                                                        
                                                </div>
                                                    
                                                    
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                
                $(document).on("click", ".open-Modal", function () {

                var myDNI = $(this).data('id');               
                $(".modal-body #DNI").val( myDNI );
                
                $.ajax({
              url: "platilloModal_P.php",
              type: 'POST',
              data: {"idPlatillo":myDNI},
              success: function (data) {
                  $("#cmbMunicipio").html(data);
                
                }
                });
                });

            </script>
            
            
            
            
            
            
                     
						<div class="modal-footer">
							<button class="btn btn-Bixa" id="vmPlatillo" data-dismiss="#myModalDialog">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
                                </div>
            
            
            <script>
                $("#vmPlatillo").click(function (){
                   $('#myModalDialog').modal('hide');
                   $('#myModalDialog').data('modal', null);
                   
                });
            </script>
            
            
                    			<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Datos del vino</h4>
						</div>

                                                <div class="modal-body" id='bodyVino'>
                                                    <input class="ocultar" type="text" name="DNI" id="vino"/>
                                                <div id="vinoAConsultar">
                                                        
                                                </div>
                                                    
                                                    
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".open-Modal2", function () {
                var vino = $(this).data('id');               
                $("#bodyVino #vino").val(vino);
                
                
                
                
                $.ajax({
              url: "vinoModal_P.php",
              type: 'POST',
              data: {"idVino":vino},
              success: function (data) {
                  $("#vinoAConsultar").html(data);
                
                }
                });
                });
                
                
                

            </script>
                     
						<div class="modal-footer">
							<button class="btn btn-Bixa" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
                                </div>
            
                        
    </body>
</html>
