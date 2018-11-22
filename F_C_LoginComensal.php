   
    <?php
    require_once './reedirigir.php';
    include 'Header.php';
    include_once './Clases/Configuracion.php';
    $objEmpresa = new Empresa();
    $objEmpresa->ObtenerPorID(1);
    $objConfig = new Configuracion();
    $objConfig->Consultar();
    ?>
    <title>Bienvenido</title>
    <link href="css/landing-page.css" rel="stylesheet">
</head>

<body>
   
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation" style="background-color: black">
        <div class="container topnav" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >
                
                <a class="navbar-brand topnav" href="#" style="color: white">Comandero Digital - Comensal</a>
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
                                <p class="text-center"><a href="#" class="btn btn-default btn-lg" role="button" data-toggle="modal" data-target="#login-modal">Iniciar</a></p>
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
                                    <div class="imagenesTablaFoto"><img class="" id="img_logo" src="<?php echo substr($objEmpresa->Logo,3);?>"></div>
					
				</div>

                
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                
                    <!-- Begin # Login Form -->
                    <form id="login-form" method="POST" action="Validaciones_Lado_Servidor/N_LoginComensal.php">
		                <div class="modal-body">
				    		<div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">Ingresar folio de la comanda</span>
                            </div>
				    
                                    <div class="input-group">
                                        <div class="divInput">
                                        <input type="password" id="txtComanda" name="txtComanda" class="form-control" placeholder="Folio de comanda">
                                        </div>
                                        <span class="input-group-btn">
                                            <button id="btnVerComanda" tabindex="-1" class="btn btn-default" type="button"><span class="glyphicon glyphicon-eye-open"></span></button>
                                        </span>
                                    </div>
                            
                                    
                            <div id="div-login-msg">
                                <br>
                                <br>
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">Ingresar contraseña de mesero (solo si se desea comandear)</span>
                                <div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'>
                                    <input id="txtContrasena" class="form-control" type="password" placeholder='Contraseña' name="txtContrasena">
                                 <span class="input-group-btn">
                                    <button id="btnVerMesero" tabindex="-1" class="btn btn-default" type="button"><span class="glyphicon glyphicon-eye-open"></span></button>
                                </span>
                                </div>
                               
                            </div>
                                    
                                    
                                    <?php 
                                    /*if($objConfig->ClientesVIP==1){
                                    ?>
                                    <div id="ClienteVIP">
                                <div id="" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="">Ingresar E-mail (Clientes VIP)</span>
                                <div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input id="txtClienteVIP" class="form-control" type="text" placeholder='E-mail' name="txtClienteVIP"></div>
                            </div>
                                    
                                    <?php }*/?>
                                    
                            
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-Bixa btn-lg btn-block" name="btnLogin" style="">Iniciar</button>
                            </div>
			
				        </div>
                    </form>
                </div>
            </div>                                        
        </div>
</div>

	    
</body>

<script>
            $(document).ready(function(){
                $("#btnVerComanda").hover(function (){
                   $("#txtComanda").attr("type",'text');
                },function (){
                    $("#txtComanda").attr("type",'password');
                });
                
                
                $("#btnVerMesero").hover(function (){
                   $("#txtContrasena").attr("type",'text');
                },function (){
                    $("#txtContrasena").attr("type",'password');
                });
            });
            
        </script>

</html>

