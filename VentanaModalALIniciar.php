<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './Header.php';
        ?>
        
        
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
                                                    
                                                    
            					<div class="modal-footer">
							<button class="btn btn-Bixa" id="vmPlatillo" data-dismiss="#myModalDialog">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
                                </div>

        
        <script>
            
            $(document).ready(function (){
                
                $('#myModalDialog').modal('show');
                
                $("#vmPlatillo").click(function (){
                   $('#myModalDialog').modal('hide');
                   $('#myModalDialog').data('modal', null);
                   
                });
            });
                
            </script>
                             
                                                    
        
    </body>
</html>
