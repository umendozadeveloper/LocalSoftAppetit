<?php
include_once 'Clases/Platillo.php';
include_once 'Clases/Sommelier.php';
include_once 'Clases/Vino.php';
include_once './Clases/Seguridad.php';
include_once './Clases/Tiempos.php';
$seguridad = new Seguridad();

$idPlatilloEd= $_POST['idPlatillo'];
$idMenu = $_POST['idMenu']; 
$objPlatillo = new Platillo();
$objPlatillo->ConsultarPorID($idPlatilloEd);
$objVino = new Vino();


     ?>     

<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="editarPlatilloTitulo"><?php echo $objPlatillo->Nombre; ?></h4>
</div>

<div class="panel-body no-padding-top no-padding-bottom">
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-8 col-sm-8 col-md-8 col-lg-8">
                <img src="<?php echo $objPlatillo->Foto;?>">
                <hr >
                <label class="editarPlatilloCuerpo"><?php echo $objPlatillo->DescripcionLarga;?></label>
                
            </div>
    
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-4 col-sm-4 col-md-4 col-lg-4">
                <center>
                Precio por platillo:<div class="editarPlatilloPrecio"><label class="editarPlatilloPrecio"><?php  echo "$".$objPlatillo->Precio;?></label></div>
                
                <?php if($seguridad->CurrentUserPerfil()!=1 && $seguridad->CurrentPermisoComandear()){?>
                    <form action="Validaciones_Lado_Servidor/N_AgregarComandaPlatillo.php" method="POST" id="formComandaPlatillo">
                  <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMenos' value=''>
                        <img src='img/menos2.png'>
                        </button>
                    
                    <input type='text' name='txtCantidad' readonly="" id='txtCantidad' class='editarComandaP_and_V' value='0'>
                        <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMas' value=''>
                        <img src='img/mas2.png'>
                        </button>
                    
                    
                    
                    
                        <input class="ocultar" type="text" name="txtPlatillo" value="<?php echo $objPlatillo->ID;?>">
                        <input class="ocultar" type="text" name="txtPrecio" value="<?php echo $objPlatillo->Precio;?>">
                        <input class="ocultar" type="text" name="txtMenu" value="<?php echo $idMenu?>">
                        
                        <br>
                    <br>
                    <?php 
                    
                    ?>
                    
                    Seleccione el tiempo de su platillo
                    <select class="form-control" id="txtIdTiempo" name="txtIdTiempo">
                        <?php
                        $objTiempo = new Tiempos();
                        $tiempos = $objTiempo->ConsultarTodo();
                        $objPlatillo->ConsultarPorID($idPlatilloEd);
                        foreach($tiempos as $t){
                            
                            if($objPlatillo->IdTiempo==$t->ID){
                                echo "<option value='$t->ID' selected>$t->Clave</option>";
                            }
                            else{
                                echo "<option value='$t->ID'>$t->Clave</option>";
                            }
                            
                        }
                        ?>
                    </select>
                    
                    ¿Agregar comentarios a la orden?
                    <select class="form-control" id="cmbComentariosP">
                    <option>No</option>
                    <option>Si</option>
                    </select>
                    
                    
                    
                    <div id="divComentariosP" class="ocultar">
                        <textarea class="claseTextArea" rows="5" placeholder="Comentarios"  name="txtComentarios"></textarea>
                    </div>
                        
                    
                    
                        <button type="button" class="btn btn-Bixa btn-lg" value="" name='btnAgregar' role="button" >
                    Ordenar
                </button>    
                    <?php } ?>
                    </form>            
                        </center>
                </div>
    </div>

<?php 
$objSommelier = new Sommelier();
$vinosS = $objSommelier->ConsultarPorIdPlatillo($idPlatilloEd);

?>
<?php 
    if(count($vinosS)>0){
?>
<div class="panel">
    
    <center><h1 class='editarPlatilloTitulo'>Sommelier</h1></center>
    
            
    <div class="thumbnail panel-body no-padding-top no-margin-bottom">
<div class="thumbnail  col-xs-12 col-ms-offset-2 col-ms-7 col-sm-offset-2 col-sm-7 col-md-offset-2 col-md-7 col-lg-offset-2 col-lg-7">
        <?php 
        echo "<div class='carousel slide' id='myCarouselP' data-ride='carousel'>";				
				echo "<ol class='carousel-indicators'>";
					echo "<li class='active' data-slide-to='0' data-target='#myCarouselP'></li>";
                                        
                                        $incremento = 0;
                                        
                                        foreach($vinosS as $vino){
                                            if($incremento>0)
                                            {
                                                echo "<li data-slide-to='$incremento' data-target='#myCarouselP'></li>";
                                            }
                                            $incremento++;
                                        }
                                        $incremento=0;
                                        
                                        
				echo "</ol>";
                                
				echo "<div class='carousel-inner' role='listbox'>";			
                                    foreach ($vinosS as $vino){
                                        $objVino->ConsultarPorID($vino->IdVino);
                                        if($incremento>0){
                                    echo "<div class='item' id='slide"."$incremento"."'>";
                                        }
                                        else
                                        {
                                            echo "<div class='item active' id='slide0'>";
                                        }
                                    echo "<center><h4 class='editarPlatilloTitulo'>".$objVino->Nombre."</h4></center>";
                                    echo "<a href='#' data-id='".$objVino->ID."' class='open-ModalV btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#login-modalVi'>";
                                    echo "<img src='".$objVino->Foto."' class='img-responsive'>";
                                    echo "</a>";
                                    echo "</div>";
                                    
                                        $incremento++;
                                    }

				echo "</div>";				
                                echo "</div>";				
                                
                                if($incremento>1){
                                
?>

    <div class="thumbnail" style="position: relative; float: left;">
                <a href="#myCarouselP" data-slide="prev"  class="btn btn-Bixa">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>    
            </div>          		
    
	<div class="thumbnail" style="position: relative; float: right;">
                <a href="#myCarouselP" data-slide="next"  class="btn btn-Bixa">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>    
            </div>          		
    
                                <?php }
                                ?>
        
</div>
        
</div>
</div>

    <?php } ?>
    
    <style>
    </style>

    <div class="modal fade" id="login-modalVi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
                                                <div class="modal-body" id='bodyVinoV'>
                                                    <input class="ocultar" type="text" name="DNI" id="vinoV"/>
						
                                                
                                                <div id="vinoAConsultarV">
                                                        
                                                </div>
                                                    
            <script>
                
                
                $(document).ready(function (){
                   var idMenu = <?php echo $idMenu;?>; 
                   var idPlatillo = <?php echo $idPlatilloEd;?>;
                   
    /*alert('s');*/

                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".open-ModalV", function () {
                var vino = $(this).data('id');               
                $("#bodyVinoV #vinoV").val(vino);
                $.ajax({
              url: "vinoModal_II.php",
              type: 'POST',
              data: {"idVino":vino,"idMenu":idMenu,"idPlatillo":idPlatillo},
              success: function (data) {
                  $("#vinoAConsultarV").html(data);
                
                }
                });
                });
                });
            </script>
            
                                                    
                                                    
                                                    
						<div class="modal-footer">
                                                    <button id='platilloM_P'  class="btn btn-Regresar">Cerrar</button>
						</div>
					</div>
				</div>
                                </div>
    </div>
    
    <script>
        $("#platilloM_P").click(function (){
                   $('#login-modalVi').modal('hide');
                   $('#login-modalVi').data('modal', null);
                });
                
        
        </script>
    
    

<script>
    
        $("button[name=btnMenos]").click(function (){
        var nombretxt ="input[id=txtCantidad]";
        var numPlatillos = $(nombretxt).val();
        if(numPlatillos>0)
           numPlatillos -=1;  
           $(nombretxt).val(numPlatillos);
        });
        
        
        $("#cmbComentariosP").change(function (){
           var divComentarios = document.getElementById("divComentariosP");
           if($(this).val()==="Si"){
               divComentarios.className = "mostrar";
           }
           else{
               divComentarios.className = "ocultar";
           }
           
        });
        
            $("button[name=btnMas]").click(function (){
        var nombretxt ="input[id=txtCantidad]";
        var numPlatillos = $(nombretxt).val();
        numPlatillos = parseInt(numPlatillos);
           numPlatillos +=1;  
           $(nombretxt).val(numPlatillos);
        });
        
        $("button[name=btnAgregar]").click(function (){
            swal({   
		title: 'Corfirmar Orden',   
		text: '¿Desea ordenar el platillo seleccionado?',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: '¡Claro!',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false }, 

		function(isConfirm){   
			if (isConfirm) {     
                            $("#formComandaPlatillo").submit();
                            /*
				swal('¡Hecho!', 
					'Platillo Ordenado', 
					'success');   */
			} else {     
				swal('Cancelado', 
					'', 
				'error');   
			} 
		});
        });
    
        
        </script>

        

        


