        <?php
        require 'Header.php';
        
        ?>

        <title>Agregar Menús</title>
    
        
        
        
        <?php

        include_once  './Clases/SubMenu.php';

$r = new SubMenu();
$banderaRuta = false;


if(isset($_GET['btnAceptar'])){    
    $ID = $_GET['btnAceptar'];
    $objSubMenu = new SubMenu();
    $submenus =  $objSubMenu->ConsultarSubMenuPorIDPadre($ID);
    $r->ConsultarRutaActual($ID);
    
    $banderaRuta = true;
    
}
else if(isset ($_GET['idSubMenu'])){
    $ID = $_GET['idSubMenu'];
    $objSubMenu = new SubMenu();
    $submenus =  $objSubMenu->ConsultarSubMenuPorIDPadre($ID);
    $r->ConsultarRutaActual($ID);
    if(isset($_SESSION['msjSubMenu']) && !empty($_SESSION['msjSubMenu'])){
        echo "<script>swal('Correcto','Menú agregado correctamente','success');</script>";
        $_SESSION['msjSubMenu']=null;
    }
    
    //Sesion creada en N_EditarSubmenu (Validaciones)
    if(isset($_SESSION['mjsEditarMenu'])&& !empty($_SESSION['mjsEditarMenu'])){
        echo "<script>swal('Correcto','Menú editado correctamente','success');</script>";
        $_SESSION['mjsEditarMenu']=null;
    }
    
    //Sesion creada en N_EliminarMenu (Validaciones)
    if(isset($_SESSION['eliminarMenu'])&& !empty($_SESSION['eliminarMenu'])){
        echo "<script>swal('Correcto','El menú ha sido eliminado correctamente','success');</script>";
        $_SESSION['eliminarMenu']=null;
    }
    
    if(isset($_SESSION['errorMenu'])&& !empty($_SESSION['errorMenu'])){
        echo "<script>swal('Error','El menú no ha sido eliminado debido a que contiene submenús','error');</script>";
        $_SESSION['errorMenu']=null;
    }
    
    
    $banderaRuta = true;
}

else {
$ID = "";
$objSubMenu = new SubMenu();
$submenus = $objSubMenu->ConsultarSubMenusSinPadre();
$banderaRuta = false;
if(isset($_SESSION['mjsEditarMenu'])&& !empty($_SESSION['mjsEditarMenu'])){
        echo "<script>swal('Correcto','Menú editado correctamente','success');</script>";
        $_SESSION['mjsEditarMenu']=null;
    }
}

?>
        <nav class="navbar navbar-inverse" role="navigation" style=" margin-top: -9px;">
			<div class="container-fluit">
				
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target="#MenuAColapsar">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="collapse navbar-collapse" id="MenuAColapsar">
					<ul class="nav navbar-nav">
                                            <li><a href="F_A_ConsultarSubMenus.php"><span class="glyphicon glyphicon-backward"></span> Menú principal</a></li>
                                            <?php if($banderaRuta==true){ ?>
						<li><a href="javascript:history.back(1);"><span class=""></span> Una pantalla atrás</a></li>
                                                
                                                <li><a href="" data-toggle="modal" data-target="#login-modal"><span class=""></span> Agregar menú aquí</a></li>
                                                
                                            <?php } ?>
                                                
					</ul>

				</div>

			</div>
		</nav>
        
       
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <label>Carpeta actual: 
                <?php if($banderaRuta==true)
                echo $r->Ruta;
                else
                    echo "Raíz";
            ?></label>
                </div>    
        
        <?php    
        
            echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10'>";
        
            ?>
            <div class="panel"><div class="panel-body no-padding-top no-padding-bottom"><!-- HEADER -->
            <form method="GET" name="formMenu" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="text" class="ocultar" id="txtIdTipo" name="txtIdTipo" value="<?php if($banderaRuta==true) echo $r->IdTipo;?>">
        <?php
                foreach ($submenus as $s){       
                    
                    if($banderaRuta==true){
                        echo "<div class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-6 col-lg-3'>";
                    }
                    else {
                        echo "<div class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-6 col-lg-offset-1 col-lg-5'>";
                    }
                    echo "<button class='noboton img-rounded img-responsive img-responsive-static' type='submit' name='btnAceptar' value='$s->ID'>";
                    echo "<img src='$s->Foto' class='img-rounded img-responsive img-responsive-static'>";
                    echo "</button>";
                    
                    echo "<div class='menuSAdminVPM'><label>$s->Clave<br>$s->Descripcion</label></div>";
                    echo "<a href='#'  data-id='".$s->ID."' class='editSubMenu  btn btn-default' style='float:right;' role='button' data-toggle='modal' data-target='#editarSubMenuVM'>Editar</a>";
                    echo "</div>";
                }          
        ?>
        </form>
        </div>
                </div>
</div>            
            
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" align="center">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
                                    <img style="width: 35%;"class="img-rounded img-responsive" id="img_logo" src="img/submenu.jpeg">
					
				</div>

                
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                
                    <!-- Begin # Login Form -->
                    <form  method="POST" action="Validaciones_Lado_Servidor/Validar_AgregarSubMenus.php" enctype="multipart/form-data" id="formAddSubMenu">
		                <div class="modal-body">
				    		<div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">Se creará un nuevo Submenú con la siguiente ruta : <?php if($banderaRuta==true)
                echo $r->Ruta;
                else
                    echo "Raíz";?></span>
                            </div>
                                    <label class="campos" >Nombre</label>
                                    <div class="inputs"><input class="form-control" type="text" placeholder="Nombre del submenú" name="txtNombre" id="txtNombre"></div>
                                                <label class="campos" >Descripción</label>
                                                <textarea style="border: #aaa solid 1px;" class='claseTextArea' placeholder="Ingresar descripción del submenú" rows='3' name='txtDescripcion'></textarea>
                                                <label class="campos" >Foto</label>
                                                <div class="inputs"  ><input class="inputs" type='file' name="archivo" id="archivo"></div>
                                                <input type="text" class="ocultar" name="cmbTipo" value="<?php if($banderaRuta==true) echo $r->IdTipo;?>">
                                                <input type="text" class="ocultar"  name="cmbMenu" value="<?php echo $ID;?>">
                                                <br><br>

                            
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block btn-Bixa" name="btnRegistrar">Agregar Submenú</button>
                            </div>
			
				        </div>
                    </form>
                </div>
            </div>                                        
        </div>
</div>
      

<script>
    $(document).ready(function(){

    
        $("#formAddSubMenu").validate({
				rules: {
					txtNombre: {
						required: true,
                                                maxlength: 30
					},
                                        archivo:{
						required: true
					}       
				},
				messages: {
                                        txtNombre: {
						required: "Introducir nombre del menú",
                                                maxlength: "La longitud máxima son 30 caracteres"
					},
                                        archivo:{
                                            required: "Seleccionar archivo"
                                        }
                                        
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".inputs" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".inputs" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".inputs" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );

            });
</script>
<div class="modal fade" id="editarSubMenuVM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog" style="height: 100%;  overflow-y: auto;">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						
                                                <div class="modal-body" id='bodyPlatilloDetalle'>
                                                    <input class="ocultar" type="text" name="DNI" id="mostrarDatosPlatillo"/>
                                                <div id="platilloConsultaDetalle">
                                                        
                                                </div>
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".editSubMenu", function () {
                var menu = $(this).data('id');   
                var tipo = $("#txtIdTipo").val();
                $("#bodyPlatilloDetalle #mostrarDatosPlatillo").val(menu);
                $.ajax({
              url: "F_A_EditarSubMenu_Ajax.php",
              type: 'POST',
              data: {"idMenu":menu, "tipoMenu":tipo},
              success: function (data) {
                  $("#platilloConsultaDetalle").html(data);
                
                }
                });
                });
            </script>       
						<div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-Bixa">Cerrar</button>
						</div>
					</div>
				</div>
                                </div>
    </div>



            
            <br>
            <br>
            
            

    </body>
</html>
