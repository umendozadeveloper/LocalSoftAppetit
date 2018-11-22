<?php
include_once './Header.php';
include_once './Clases/Encuesta.php';
$objEncuesta = new Encuesta();
$objEncuesta->ConsultarGeneral();
?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                        <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Resultado de encuesta</label></center></h4></div>
                            </td>
                        </table>
</div>

<div class="col-xs-12 col-sm-offset-1 col-sm-5 col-md-5 col-md-offset-1 col-lg-offset-1 col-lg-5">
    <div style="width: 100%; overflow-x: auto;">
        <table class="table table-striped ">
        <tbody>
        <tr>
            <td><div class="etiquetas2">Cocina</div></td>
            <td><input id="input-2-ltr-star-sm" name="input-2-ltr-star-sm" class="rating rating-loading" value="<?php echo $objEncuesta->Cocina;?>" dir="ltr" data-size="xs" readonly=""></td>
        </tr>
        
        <tr>
            <td width="150px"><div class="etiquetas2">Servicio</div></td>
            <td><input id="input-2-ltr-star-sm" name="input-2-ltr-star-sm" class="rating rating-loading" value="<?php echo $objEncuesta->Servicio;?>" dir="ltr" data-size="xs" readonly=""></td>
        </tr>
        </tbody>
    </table>
</div>
    </div>

<div class="col-xs-12 col-sm-5 col-md-5 col-md-offset-0 col-lg-offset-0 col-lg-5">
    <div style="width: 100%; overflow-x: auto;">
    <table class="table table-striped ">
        
        <tbody>
        <tr>
            <td width="150px"><div class="etiquetas2">Ambiente</div></td>
            <td><input id="input-2-ltr-star-sm" name="input-2-ltr-star-sm" class="rating rating-loading" value="<?php echo $objEncuesta->Ambiente;?>" dir="ltr" data-size="xs" readonly=""></td>
        </tr>
        
        <tr>
            <td><div class="etiquetas2">Precio</div></td>
            <td><input id="input-2-ltr-star-sm" name="input-2-ltr-star-sm" class="rating rating-loading" value="<?php echo $objEncuesta->Precio;?>" dir="ltr" data-size="xs" readonly=""></td>
        </tr>
        </tbody>
    </table>
</div>
</div>


<div class="col-xs-12 col-sm-12 col-sm-offset-2 col-md-12 col-md-offset-3 col-lg-offset-3 col-lg-6">
    <div style="width: 100%; overflow-x: auto; background-color: <?php echo $objEmpresa->ColorFondoBoton;?>;">
    <table class="table table-striped">
        <tbody>
        <tr>
            <td width="150px"><div class="etiquetas2">Valoracion general</div></td>
            <td><input id="input-2-ltr-star-sm" name="input-2-ltr-star-sm" class="rating rating-loading" value="<?php echo $objEncuesta->Ambiente;?>" dir="ltr" data-size="xs" readonly=""></td>
        </tr>
        </tbody>
    </table>
</div>
</div>


