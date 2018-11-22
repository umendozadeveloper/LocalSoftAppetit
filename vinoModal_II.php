<?php
include_once './Clases/Vino.php';
include_once './Clases/Maridaje.php';
include_once './Clases/Platillo.php';
include_once './Clases/Seguridad.php';
$seguridad = new Seguridad();
$idVino= $_POST['idVino'];
$idPlatillo = $_POST['idPlatillo'];
$objVino = new Vino();
$objPlatillo = new Platillo();
$objMaridaje = new Maridaje();
$objVino->ConsultarPorID($idVino);
?>

<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="editarPlatilloTitulo"><?php echo $objVino->Nombre; ?></h4>
</div>

<div class="panel-body no-padding-top no-padding-bottom">
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-8 col-sm-8 col-md-8 col-lg-8">
                <img src="<?php echo $objVino->Foto;?>">
                <hr >
                <label class="editarPlatilloCuerpo"><?php echo $objVino->DescripcionLarga;?></label>
                
            </div>
            
    
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-4 col-sm-4 col-md-4 col-lg-4">
                <center>
                Precio por copa:<div class="editarPlatilloPrecio"><label class="editarPlatilloPrecio"><?php  echo "$".$objVino->PrecioCopa;?></label></div>
                
                <?php if($seguridad->CurrentUserPerfil()!=1 && $seguridad->CurrentPermisoComandear()){?>
                <form action="Validaciones_Lado_Servidor/N_AgregarComandaVino.php" method="POST" id="formComandaVino">
                  
                    <input type="text" value='<?php echo $idVino;?>' name='txtVino' class="ocultar">
                    <input type="text" value='<?php echo $objVino->PrecioCopa;?>' name='txtPrecioCopa' class="ocultar">
                    <input type="text" value='<?php echo $objVino->PrecioBotella;?>' name='txtPrecioBotella' class="ocultar">
                    <input type="text" value='<?php echo $_POST['idMenu']; ?>' name="txtMenu" class="ocultar">
                    <input type="text" value='<?php echo $idPlatillo; ?>' name="txtPlatillo" class="ocultar">
                    
                    
                    <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMenosC' value=''>
                        <img src='img/menos2.png'>
                        </button>
                    <input type='tel' name='txtCantidadCopas' readonly="" id='txtCantidadCopas' class='editarComandaP_and_V' value='0'>
                        <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMasC' value=''>
                        <img src='img/mas2.png'>
                        </button>
                
                    <br>
                    <?php } ?>
                Precio por botella:<div class="editarPlatilloPrecio"><label class="editarPlatilloPrecio"><?php  echo "$".$objVino->PrecioBotella;?></label></div>
                
                
                <?php if($seguridad->CurrentUserPerfil()!=1 && $seguridad->CurrentPermisoComandear()){?>
                  <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMenosB' value=''>
                        <img src='img/menos2.png'>
                        </button>
                    <input type='tel' name='txtCantidadBotellas' readonly="" id='txtCantidadBotellas' class='editarComandaP_and_V' value='0'>
                        <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMasB' value=''>
                        <img src='img/mas2.png'>
                        </button>
                    <BR>
                    ¿Agregar comentarios a la orden?
                    <select class="form-control" id="cmbComentarios">
                    <option>No</option>
                    <option>Si</option>
                    </select>
                    
                    <div id="divComentarios" class="ocultar">
                        <textarea class="claseTextArea" rows="5" placeholder="Comentarios"  name="txtComentarios"></textarea>
                    </div>
                </center>
                
                
                    
                    <br>
                    <br>
                    <center>
                        
                        <button type="button" class="btn btn-Bixa btn-ms" value="" name='btnAgregar' role="button" >
                    Ordenar
                </button>   
                        <?php } ?>
                    </center>
                    </form>            
                        
                </div>
    </div>


<script>
        $("button[name=btnMenosC]").click(function (){
        var nombretxt ="input[id=txtCantidadCopas]";
        var numPlatillos = $(nombretxt).val();
        if(numPlatillos>0)
           numPlatillos -=1;  
           $(nombretxt).val(numPlatillos);
        });
        
            $("button[name=btnMasC]").click(function (){
        var nombretxt ="input[id=txtCantidadCopas]";
        var numPlatillos = $(nombretxt).val();
        numPlatillos = parseInt(numPlatillos);
           numPlatillos +=1;  
           $(nombretxt).val(numPlatillos);
        });
        
        
        $("#cmbComentarios").change(function (){
           var divComentarios = document.getElementById("divComentarios");
           if($(this).val()==="Si"){
               divComentarios.className = "mostrar";
           }
           else{
               divComentarios.className = "ocultar";
           }
           
        });
        
        
        
        $("button[name=btnMenosB]").click(function (){
        var nombretxt ="input[id=txtCantidadBotellas]";
        var numPlatillos = $(nombretxt).val();
        if(numPlatillos>0)
           numPlatillos -=1;  
           $(nombretxt).val(numPlatillos);
        });
        
            $("button[name=btnMasB]").click(function (){
        var nombretxt ="input[id=txtCantidadBotellas]";
        var numPlatillos = $(nombretxt).val();
        numPlatillos = parseInt(numPlatillos);
           numPlatillos +=1;  
           $(nombretxt).val(numPlatillos);
        });
        
        $("button[name=btnAgregar]").click(function (){
            swal({   
		title: 'Corfirmar Orden',   
		text: '¿Desea ordenar el vino seleccionado?',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: '¡Claro!',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false }, 

		function(isConfirm){   
			if (isConfirm) {     
                            $("#formComandaVino").submit();
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