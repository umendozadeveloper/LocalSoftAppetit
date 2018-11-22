        <?php
        require 'Header.php';
        
        
        //require './comprobarSesionAd.php';
        /*
        echo"Id usuario:". $_SESSION['id_usuario'];
        echo "   Id Perfil: " .$_SESSION['id_perfil']; 
        echo "  Nombre de usuario: " .$_SESSION['username'];*/
        ?>
        
        
        <title>Inicio</title>
                
        <div class="panel-body no-padding-top no-padding-bottom">
                
            <div class="thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-3">
                <button class="noboton img-rounded img-responsive img-responsive-static" data-toggle='modal' data-target='#VMMesas'>
                    <img src="img/Mesa2.jpg"  class="img-rounded img-responsive img-responsive-static" >                
                </button>
                <div class="menuSAdmin" ><label >Mesas</label></div>
            </div>
            
            <!-- Ventana Modal Para Mesas-->
            <div class="modal fade" id="VMMesas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>OPCIONES PARA MESAS</h4>
						</div>

						<div class="modal-body">
                                                    <a title="Permite registrar mesas en el sistema." data-placement="right"  class="btn btn-Bixa mitooltip" href="F_A_RegistrarMesa.php">Agregar</a>
                                                    <a title="Permite consultar el listado de mesas registrado en el sistema, además permite editar algún registro o eliminarlo." data-placement="right"  class="btn btn-Bixa mitooltip" href="F_A_ConsultarMesas.php">Consultar</a>
						</div>

						<div class="modal-footer">
							<button class="btn btn-Bixa" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
            
            <div class="thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-3">
                <button class="noboton img-rounded img-responsive img-responsive-static" data-toggle='modal' data-target='#VMMeseros'>
                    <img src="img/Mesero.png"  class="img-rounded img-responsive img-responsive-static" >                
                </button>
                <div class="menuSAdmin" ><label >Meseros</label></div>
            </div>

            <!-- Ventana Modal Para Meseros-->
            <div class="modal fade" id="VMMeseros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>OPCIONES PARA MESEROS</h4>
						</div>

						<div class="modal-body">
                                                    <a title="Permite registrar meseros en el sistema." data-placement="right"  class="btn btn-Bixa mitooltip" href="F_A_RegistrarMesero.php">Agregar</a>
                                                    <a title="Permite consultar el listado de meseros registrado en el sistema, además permite editar algún registro o eliminarlo." data-placement="right"  class="btn btn-Bixa mitooltip" href="F_A_ConsultarMeseros.php">Consultar</a>
						</div>

						<div class="modal-footer">
							<button class="btn btn-Bixa" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
            
            
            
            
            <div class="thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-3">
                <button class="noboton img-rounded img-responsive img-responsive-static" data-toggle='modal' data-target='#VMPlatillos'>
                    <img src="img/Platillo.jpg"  class="img-rounded img-responsive img-responsive-static" >                
                </button>
                <div class="menuSAdmin" ><label>Alimentos</label></div>
            </div>
            
            <!-- Ventana Modal Para Platillos-->
            <div class="modal fade" id="VMPlatillos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>OPCIONES PARA ALIMENTOS</h4>
						</div>

						<div class="modal-body">
                                                    <a data-toggle='tooltip'  title="Permite registrar alimentos en el sistema." data-placement="bottom"  class="btn btn-Bixa mitooltip" href="F_A_RegistrarPlatillo.php">Agregar</a>
                                                    <a data-toggle='tooltip' title="Permite consultar el listado de alimentos registrado en el sistema, además permite editar algún registro o eliminarlo." data-placement="right"  class="btn btn-Bixa mitooltip" href="F_A_ConsultarPlatillos.php">Consultar</a>
						</div>

						<div class="modal-footer">
							<button class="btn btn-Bixa" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
            
            
            
            <div class="thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-3">
                <button class="noboton img-rounded img-responsive img-responsive-static" data-toggle='modal' data-target='#VMVinos'>
                    <img src="img/Vino.jpg"  class="img-rounded img-responsive img-responsive-static" >                
                </button>
                <div class="menuSAdmin" ><label >Bebidas</label></div>
            </div>
            
            <!-- Ventana Modal Para Vinos-->
            <div class="modal fade" id="VMVinos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>OPCIONES PARA BEBIDAS</h4>
						</div>

						<div class="modal-body">
                                                    <a title="Permite registrar bebidas en el sistema." data-toggle='tooltip'  data-placement="bottom"  class="btn btn-Bixa mitooltip" href="F_A_RegistrarVino.php">Agregar</a>
                                                    <a data-toggle='tooltip'  title="Permite consultar el listado de bebidas registrado en el sistema, además permite editar algún registro o eliminarlo." data-placement="right"  class="btn btn-Bixa mitooltip" href="F_A_ConsultarVinos.php">Consultar</a>
						</div>

						<div class="modal-footer">
							<button class="btn btn-Bixa" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
            
            
            

            <div class="thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-3">
                <a class="noboton img-rounded img-responsive img-responsive-static"  href='F_A_ConsultarSubMenus.php'>
                    <img src="img/Menu2.jpg"  class="img-rounded img-responsive img-responsive-static" >                
                </a>
                <div class="menuSAdmin" ><label>Menús</label></div>
            </div>
            
            
            <div class="thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-3">
                <a class='noboton img-rounded img-responsive img-responsive-static ' href='VentanaModalParaMenuBixa.php?idComanda=-1' >
                    <img src="img/emenu2.png"class="img-rounded img-responsive img-responsive-static" >
                    </a>
                <div class="menuSAdmin" ><label>Ver Menú</label></div>
            </div>
            
            

        </div>
    
    
    
    </body>
</html>
