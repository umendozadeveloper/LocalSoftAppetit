<?php
include_once 'Clases/Platillo.php';
include_once 'Clases/Sommelier.php';
include_once 'Clases/Vino.php';
include_once './Clases/Seguridad.php';
$seguridad = new Seguridad();
$idPlatilloEd= $_POST['idPlatillo'];
$idMenu = $_POST['idMenu'];
$idVino = $_POST['idVino'];
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
                      <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    
                    <input type='text' name='txtCantidad' readonly="" id='txtCantidad' class='editarComandaP_and_V' value='1'>
                        <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMas' value=''>
                        <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    
                    <br>
                    
                    
                        <input class="ocultar" type="text" name="txtPlatillo" value="<?php echo $objPlatillo->ID;?>">
                        <input class="ocultar" type="text" name="txtPrecio" value="<?php echo $objPlatillo->Precio;?>">
                        <input class="ocultar" type="text" name="txtVino" value="<?php echo $idVino;?>">
                        <input type="text" value='<?php echo $_POST['idMenu']; ?>' name="txtMenu" class="ocultar">
                        
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



<script>
    
        $("button[name=btnMenos]").click(function (){
        var nombretxt ="input[id=txtCantidad]";
        var numPlatillos = $(nombretxt).val();
        if(numPlatillos>0)
           numPlatillos -=1;  
           $(nombretxt).val(numPlatillos);
        });
        
            $("button[name=btnMas]").click(function (){
        var nombretxt ="input[id=txtCantidad]";
        var numPlatillos = $(nombretxt).val();
        numPlatillos = parseInt(numPlatillos);
           numPlatillos +=1;  
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

        


