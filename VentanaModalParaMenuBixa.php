<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'Header.php';?>
        <meta charset="UTF-8">
        <title>Menú digital</title>
    </head>
    <body>
            
            
            <?php
require './Clases/VistaMPV.php';
include_once './Clases/Configuracion.php';
include_once './Clases/ComandaPlatillos.php';
include_once './Clases/ComandaVinos.php';
include_once './Clases/SubMenu.php';
$objConfig = new Configuracion();
$objConfig->Consultar();

/******************SE ocuaprá en comensal//////////////////
*/

$iniciarVentana = "0";
$producto ="0";
if(isset($_SESSION['msjSolicitarPlatillo']) && !empty($_SESSION['msjSolicitarPlatillo'])){
    echo "<script>swal('Correcto','".$_SESSION['msjSolicitarPlatillo']."','success');</script>";
    $_SESSION['msjSolicitarPlatillo']=null;
}
/*if(isset($_GET['ventanaModal'])&& $_GET['ventanaModal']==1){
    $iniciarVentana = "1";
}*/
if(isset($_SESSION['ventanaModal']) && !empty($_SESSION['ventanaModal'])){
    if($_SESSION['ventanaModal']){
        $iniciarVentana = "1";
        $_SESSION['ventanaModal']=null;
        $producto = $_GET['producto'];
        //echo "<script>alert('$producto');</script>";
        
    }
}
$ruta = "";
$banderaRuta = false;

//Clic en cualquier submenú
if(isset($_GET['Busqueda'])){
    $Busqueda = $_GET['Busqueda'];
    $objVista = new VistaMPV();
    $submenus = $objVista->ConsultarPVSPorBusqueda($Busqueda);
    $idComanda = $_GET['idComanda'];
    $ID = 9999;
    $_SESSION['ScriptMenu']=$_SERVER['REQUEST_URI'];
    $uri = $_SESSION['ScriptMenu'];
    
    
}
else if(isset($_GET['idMenu'])){
    //Obtengo el id del submenú 
            $ID = $_GET['idMenu'];
            //$_SESSION['idComanda']=;
            $objVista = new VistaMPV();
            $submenus = $objVista->ConsultarPVS($ID);
            $ruta = $objVista->ConsultarRuta($ID);
            $banderaRuta = true;
            foreach ($ruta as $r){
                $ruta = $r->Ruta;
            }
            $idComanda = $_GET['idComanda'];
        }
else if(isset($_GET['idComanda'])){
$idComanda = $_GET['idComanda'];
$objVista = new VistaMPV();
$submenus = $objVista->ConsultarSinPadre();
$ruta = $objVista->ConsultarRuta("_");
$banderaRuta = false;
}

if(isset($_GET['msjSolicitarPlatillo'])){
    if($_GET['msjSolicitarPlatillo']==1){
        //session_start();
        if(isset($_SESSION['msjSolicitarPlatillo'])&&!empty($_SESSION['msjSolicitarPlatillo']))
        {
            echo "<script>swal('Correcto','".$_SESSION['msjSolicitarPlatillo']."','success');</script>";
            $_SESSION['msjSolicitarPlatillo']=null;
        }
        $_GET['msjSolicitarPlatillo']=0;
    }
}

?>
        <script>
            function decirNombre(Nombre){
                var NombreVariable = Nombre;
                //alert(NombreVariable);
            }
            
            $(document).ready(function (){
                
            });
        </script>       
        
        
        
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
              
              <!--
              <div class="visible-lg">
                  <img src="img/AcceptBI.png">
                </div>
              -->
              
              
              <div class="input-group col-lg-2">
                  <?php if(isset($_GET['Busqueda'])){
                      ?>
                  
                  
                  <a href="VentanaModalParaMenuBixa.php?<?php echo "idComanda=$idComanda";?>" class="btn btn-Regresar">Sin filtro <span class="glyphicon glyphicon-zoom-out"></span></a>
                  <?php }?>
                  </div>
              <form method="GET" name="formMenu" action="<?php echo $_SERVER['PHP_SELF'];?>">  
                  
                  
                  
              <div class="input-group col-lg-2 col-lg-offset-10 ">
                                        
                  
                                        <div class="divInput">
                                            <input type="text" name="idComanda" class="ocultar" value="<?php echo $idComanda;?>">
                                            <input autocomplete="off" type="text" id="Busqueda" name="Busqueda" class="form-control" placeholder="">
                                        </div>
                  
                                        <span class="input-group-btn">
                                            <button id="btnVerComanda" tabindex="0" class="btn btn-default" type=""><span class="glyphicon glyphicon-search"></span></button>
                                        </span>
              </div>
              </form>
        <label>Carpeta actual: 
                <?php if($banderaRuta==true)
                {
                    
                    
                    //echo $_SESSION['SCRIPTMENU'];
                    $Menus = explode("\\",$r->Ruta);
                    //echo count($Menus);
                    echo "<a href='VentanaModalParaMenuBixa.php?idComanda=$idComanda'>Inicio</a>\\";
                    $objSubMenu = new SubMenu();
                    foreach ($Menus as $M){
                        
                        $objSubMenu->ConsultarSubMenuPorClave($M);
                        echo "<a href='VentanaModalParaMenuBixa.php?idComanda=$idComanda&idMenu=$objSubMenu->ID'>$M</a>";
                        //echo "<button onclick=\"decirNombre('$M');\">$M</button>";
                        echo "\\";
                    }
                    
                    echo "</div>";
                }
                else
                    echo "Raíz";
                
            ?></label>    
              <?php 
              
              ?>
              
              
              
              
              
              
                  </div>
                  
              
              
        
        
            <div class="panel"><div class="panel-body no-padding-top no-padding-bottom">
            <form method="GET" name="formMenu" action="<?php echo $_SERVER['PHP_SELF'];?>">   
                <input type="text" name="idComanda" class="ocultar" value="<?php echo $idComanda;?>">
                
                
  
  
  
        <?php
        if($banderaRuta==true || isset($_GET['Busqueda'])){
            echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10'>";
        }
        else{
            echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10'>";
        }
            
            echo "<br>";
                foreach ($submenus as $s){       
                    if($banderaRuta==true || isset($_GET['Busqueda'])){
                        echo "<div class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-4 col-md-4 col-lg-3'>";
                    }
                    else{
                        echo "<div class=' no-boxshadow no-margin-bottom col-xs-12 col-ms-12 col-sm-6 col-md-6 col-lg-offset-1 col-lg-5'>";
                    }
                    
                        
                    
                    switch ($s->Tipo){
                        case "SubMenu":
                        echo "<button style='width:100%;' class='noboton bordeImg' type='submit' name='idMenu' value='$s->ID'>";
                        break;  
                    
                        case "Platillos":
                        //echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnPlatillo' value='$s->ID'>";
                        echo "<button style='width:100%;' type='button' class='noboton open-Modal ' data-id='$s->ID' data-toggle='modal' data-target='#myModalDialog'>";
                        break;
                    
                        case "Vinos";
                        //echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnVino' value='$s->ID'>";
                            echo "<button style='width:100%;' type='button' class='open-Modal2 noboton img-rounded img-responsive img-responsive-static' data-id='$s->ID' data-toggle='modal' data-target='#login-modal'>";
                        break;
                    }
                    echo "<img style='width:100%;' src='$s->Foto' class='img-responsive'>";
                    echo "</button>";
                    
                    //Pintar estrellas si la tabla de config lo indica
                    switch ($s->Tipo){
                        case "Platillos":
                            if($objConfig->CalificacionPlatillos==1){
                                $objComandaPlatillos = new ComandaPlatillos();
                                $CalificacionP = $objComandaPlatillos->ConsultarCalificacionPorIDPlatillo($s->ID);
                                if($CalificacionP==0){
                                    echo "<div style='font-size:15px; '><center><br><label></label></div>";
                                    
                                }
                                else{
                                    echo "<div style=''><center><input class='rating rating-loading' value='$CalificacionP' dir='ltr' data-size='xs' readonly=''></div>";
                                }
                                
                            }
                            break;
                        
                        case "Vinos":
                            if($objConfig->CalificacionBebidas){
                            $objComandaVinos = new ComandaVinos();
                            $CalificacionV = $objComandaVinos->ConsultarCalificacionPorIDVino($s->ID);
                            if($CalificacionV==0){
                                    echo "<div style='font-size:15px; '><center><br><label></label></div>";
                            }
                            else{
                                    echo "<div style=''><center><input class='rating rating-loading' value='$CalificacionV' dir='ltr' data-size='xs' readonly=''></div>";
                                }
                            
                            }
                            
                            break;
                            
                        case "SubMenu":
                            if($s->IdTipo==1 && $objConfig->CalificacionPlatillos==1){
                                echo "<div style='font-size:15px; '><center><br><label></label></div>";
                            }
                            break;
                    }
                    
                    if($s->Tipo =="SubMenu"){
                        echo "<div class='menuSAdminVPM' >"
                        . "<div class='menuContenedor'>"
                                . "<label>$s->Clave"
                                . "<div style='width:90%; margin-left: 5%; height:1px;'>"
                                . "</div>"
                                . "$s->Descripcion</label>"
                                . "</div>"
                                . "</div>";
                    }
                    else {
                        echo "<div class='platillosVinoSAdmin' style='overflow-y: auto;' ><label class='textoSistema'>$s->Clave</lable><div style='width:90%; margin-left: 5%; height:1px; background-color:black;'></div><label style='color:black;'>$s->Descripcion</label></div>";
                    }
                    echo "</div>";
                    
                }          
        ?>

        </form>
                </div>
            </div>
        
                  
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-11 ">

            <?php
            
            //$_SESSION['SCRIPTMENU']=$_SERVER['REQUEST_URI'];
            
            if($seguridad->CurrentUserPerfil()==3)//Comensal
            if(isset($_SERVER['HTTP_REFERER'])){
                        echo "<a class='btn btn-Regresar' href='".$_SERVER['HTTP_REFERER']."'>Regresar</a>";                
            }
            //if($ruta=="Raíz"){
                if(isset($_GET['idComanda'])){
                $_SESSION['idComanda']=$_GET['idComanda'];
                
                if($seguridad->CurrentUserPerfil()==2){
            ?>
                <a class="btn btn-Regresar btn-ms" href="F_M_Comanda_A_Detalle.php?idComanda=<?php echo $idComanda;?>" style="">
                        Regresar a la comanda
                    </a>
            <?php }}
            ?>
                    <br>
                    <br>
                    <br>
            </div>  
        
        <script>
            $(document).ready(function (){
            
            
    $(".rating").ready(function (){
       $(".rating").rating("refresh", {disabled:true, showClear:false,showCaption:false});
   });
            
            var iniciarVentana = <?php echo $iniciarVentana; ?>;
            var idPlatillo = <?php if(isset($_GET['idPlatillo']))
                {echo $_GET['idPlatillo']; 
                }
                else{
                    echo "0";
                }
            ?>;
            var idMenu = <?php echo $ID; ?>;
            var producto = <?php echo $producto; ?>;
            if(iniciarVentana==1){             
                /*Producto = 1 cuando es platillo*/
                 if(producto==1){
             $.ajax({
              url: "platilloModal_P.php",
              type: 'POST',
              data: {"idPlatillo":idPlatillo,"idMenu":idMenu},
              success: function (data) {
                  $("#cmbMunicipio").html(data);
                  
                }
                });
             
            }
            /*Producto = 2 cuando es vino*/
            else{
                $.ajax({
              url: "vinoModal_P.php",
              type: 'POST',
              data: {"idVino":idPlatillo,"idMenu":idMenu},
              success: function (data) {
                  $("#cmbMunicipio").html(data);
                  
                }
                });
            }
            $('#myModalDialog').modal('show');    
        }
            });
            
        </script>
                
        
            
            
            
            <!-- VENTANA MODAL QUE USA EL SCRIPT DE ARRIBA PARA PASARLE VALORES -->        
            
        			<div class="modal fade" id="myModalDialog"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="height: 100%; overflow-y: auto;">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						

                                                <div class="modal-body">
                                                 
                                                    <input class="ocultar" type="text" name="DNI" id="DNI"/>
                                                <div id="cmbMunicipio">
                                                        
                                                </div>
                                                    
                                                    
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                $(document).ready(function (){
             var idMenu = <?php echo $ID;?>;   
                $(document).on("click", ".open-Modal", function () {
                var myDNI = $(this).data('id');               
                $(".modal-body #DNI").val( myDNI );
                
                $.ajax({
              url: "platilloModal_P.php",
              type: 'POST',
              data: {"idPlatillo":myDNI,"idMenu":idMenu},
              success: function (data) {
                  $("#cmbMunicipio").html(data);
                  
                }
                });
                });
            });

            </script>
						<div class="modal-footer">
							<button class="btn btn-Regresar" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
                                </div>
                
            
            
            
                    			<div class="modal fade" id="login-modal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="height: 100%; overflow-y: auto;">
					<div class="modal-content">
                                            <div class="modal-body" id='bodyVino'>
                                                    <input class="ocultar" type="text" name="DNI" id="vino"/>
						<!-- 3 divs básicos  para cada ventana modal -->
                                                <div id="vinoAConsultar">
						
                                                
                                                
                                                        
                                                </div>
                                                    
                                                    
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".open-Modal2", function () {
                    
                var idMenu = <?php echo $ID;?>;
                var vino = $(this).data('id');               
                $("#bodyVino #vino").val(vino);
                $.ajax({
              url: "vinoModal_P.php",
              type: 'POST',
              data: {"idVino":vino,"idMenu":idMenu},
              success: function (data) {
                  $("#vinoAConsultar").html(data);
                
                }
                });
                });
            </script>

						<div class="modal-footer">
							<button class="btn btn-Regresar" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
                                </div>
            
            
            <?php 
                
                require_once './_banner.php';
            ?>
                        
    </body>
</html>
