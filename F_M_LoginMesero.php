<!DOCTYPE html>
<html>

<head>
    <title>Login Mesero</title>
    <?php
    require_once './reedirigir.php';
    include 'Header.php';
    $objEmpresa = new Empresa();
    $objEmpresa->ObtenerPorID(1);
    ?>
    <link href="css/landing-page.css" rel="stylesheet">
</head>

<body>
    <?php
    
    if($seguridad->isLoggedIn()){
        header("Location: ConsultarComandas.php");
    }
    
    //session_start();
    if(!empty($_SESSION['msjLoginAd'])){
       $mensaje = $_SESSION['msjLoginAd'];
       echo "<script>swal('$mensaje[0]','','error');</script>";
       $_SESSION['msjLoginAd'] = "";
   }
    
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation" style="background-color: black">
        <div class="container topnav" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >
                
                <a class="navbar-brand topnav" href="#" style="color: white">Comandero Digital - Mesero</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                
            </div>
        </div>
    </nav>


    <!-- Header -->
    
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Menú Digital</h1>
                        <h3>SOFTAPPETIT</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <p class="text-center"><a href="#" class="btn btn-default btn-lg" role="button" data-toggle="modal" data-target="#login-modal">Login</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" align="center">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
                                    <div class="imagenesTablaFoto"><img class="img-rounded" id="img_logo" src="<?php echo substr($objEmpresa->Logo,3);?>"></div>
					
				</div>

                
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                
                    <!-- Begin # Login Form -->
                    <form id="login-form" method="POST" action="Validaciones_Lado_Servidor/Validar_LoginMesero.php">
		                <div class="modal-body">
				    		<div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">Ingresar Nombre de Usuario y Contraseña</span>
                            </div>
				    		<div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input id="login_username" class="form-control" type="text" placeholder="Nombre de Usuario" name="txtUsuario" ></div>
                                    <div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'>		<input id="login_password" class="form-control" type="password" placeholder="Password" name="txtContrasena" >
                                    <span class="input-group-btn">
                                    <button id="btnVerLogin" tabindex="-1" class="btn btn-default" type="button"><span class="glyphicon glyphicon-eye-open"></span></button>
                                </span>
                                    </div>
                            <div class="checkbox">
                                <label>
                                    
                                </label>
                            </div>
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-Bixa btn-lg btn-block" name="btnLogin" style="">Login</button>
                            </div>
			
				        </div>
                    </form>
                </div>
            </div>                                        
        </div>
</div>

<?php
            

            ?>
    
    

</body>
<script>
    $(document).ready(function(){
        $("#btnVerLogin").hover(function (){
           $("#login_password").attr("type",'text');
        },function (){
            $("#login_password").attr("type",'password');
        });
        
        
        $( "#login-form" ).validate( {
				rules: {
                                    txtUsuario:{
                                        required:true
                                    },
                                    txtContrasena:{
                                        required:true
                                    }
                                        
				},
				messages: {
                                    txtUsuario:{
                                        required:"Ingresar usuario"
                                    },
                                    txtContrasena:{
                                        required:"Ingresar contraseña"
                                    }
                                        
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".input-group" ).addClass( "has-feedback" );

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
					$( element ).parents( ".input-group" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".input-group" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );

            });
            
        </script>
</html>