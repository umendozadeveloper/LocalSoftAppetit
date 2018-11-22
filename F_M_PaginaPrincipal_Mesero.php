<html>
    <head>
        <meta charset="UTF-8">
        <?php
        require 'Header.php';
        ?>
        
        
        <title>Página Principal</title>
        
        <script src="js/fijo.js"></script>
    </head>
    <body style="background-color: #fff">
<?php
//require './ComprobarSesion.php';
//require './PartesHTML/LogoBIXA_Barra.php';
?>
        
        <div class="panel-body no-padding-top no-padding-bottom">
                
            <div class="thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-3">
                <button class="noboton" data-toggle='modal' data-target='#VMMesas'>
                <img src="img/Mesa.jpg"  class="img-rounded img-responsive img-responsive-static" >                
                </button>
                <div class="menuSAdmin" ><label>COMANDA</label></div>
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
                                                    <button title="Permite registrar mesas en el sistema." data-placement="right"  class="btn btn-Bixa mitooltip" onclick="window.location='RegistrarComanda.php'">Agregar</button>
                                                    <button title="Permite consultar el listado de mesas registrado en el sistema, además permite editar algún registro o eliminarlo." data-placement="right"  class="btn btn-Bixa mitooltip" onclick="window.location='ConsultarComandas.php'">Consultar</button>
						</div>

						<div class="modal-footer">
							<button class="btn btn-Bixa" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
            
            			</div>
			
        
        </body>
</html>