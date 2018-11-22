<?php 
include_once './LlamadoLibrerias.php';
include_once './Personalizacion.php';
include_once './Clases/Platillo.php';
include_once './Clases/Vino.php';
if(isset($_POST['IdProducto']) && isset($_POST['IdTipo'])
        && isset($_POST['ID']))
    {
        
        $ID = $_POST['ID'];
        $IDProducto = $_POST['IdProducto'];
        if($_POST['IdTipo']==1){    
            $Tipo = 1;
            $objProducto = new Platillo();
            $objProducto->ConsultarPorID($IDProducto);
            
        }
        if($_POST['IdTipo']==2){
            $Tipo = 2;
            $objProducto = new Vino();
            $objProducto->ConsultarPorID($IDProducto);
        }
        ?>
        
<div class="col-lg-12 col-md-12 col-xs-12 col-ms-12 col-sm-12">
    <img class="col-lg-12 col-md-12 col-xs-12 col-ms-12 col-sm-12 img-responsive" src="<?php echo $objProducto->Foto;?>">    
</div>
        
        <form action="Validaciones_Lado_Servidor/N_Calificar.php" method="POST">
            <input type="text" name="txtID" class="ocultar" value='<?php echo $ID;?>'>
            <input type="text" name="txtIdTipo" class="ocultar" value='<?php echo $Tipo;?>'>
            
        
        <div class="center-block">
        <input id="txtValorEstrellas" name="txtValorEstrellas" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
        <br>
        <br>
        
        
        <button data-dismiss="modal" class="btn btn-Regresar">Cerrar</button>
        <button  class="btn btn-Bixa" style="float: right;">Calificar</button>
        <br>
        
        <br>
        </div>
            

        </form>
    
        <?php 
    }