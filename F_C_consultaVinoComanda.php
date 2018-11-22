<?php
include_once './Clases/Vino.php';

$idVino= $_POST['idVino'];

$objVino = new Vino();
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
                
                <form action="Validaciones_Lado_Servidor/N_AgregarComandaVino.php" method="POST" id="formComandaVino">
                  
                    <input type="text" value='<?php echo $idVino;?>' name='txtVino' class="ocultar">
                    <input type="text" value='<?php echo $objVino->PrecioCopa;?>' name='txtPrecioC' class="ocultar">
                    <input type="text" value='<?php echo $objVino->PrecioBotella;?>' name='txtPrecioB' class="ocultar">
                    
                    
                    
                    
                    
                
                    <br>
                Precio por botella:<div class="editarPlatilloPrecio"><label class="editarPlatilloPrecio"><?php  echo "$".$objVino->PrecioBotella;?></label></div>
                
                
                  
                    <BR>
                    
                    
                    
                    
                </center>
                
                
                    
                    <br>
                    <br>
                    
                    </form>            
                        
                </div>
    </div>


