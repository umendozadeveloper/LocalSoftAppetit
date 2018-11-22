<?php 
include_once 'Clases/Platillo.php';
$idPlatilloEd= $_POST['idPlatillo'];
$objPlatillo = new Platillo();
$objPlatillo->ConsultarPorID($idPlatilloEd);

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
                
                    <form action="Validaciones_Lado_Servidor/N_AgregarComandaPlatillo.php" method="POST" id="formComandaPlatillo">
                    
                        <input class="ocultar" type="text" name="txtPlatillo" value="<?php echo $objPlatillo->ID;?>">
                        <input class="ocultar" type="text" name="txtPrecio" value="<?php echo $objPlatillo->Precio;?>">
                    <br>
                    </form>            
                        </center>
                </div>
    </div>




