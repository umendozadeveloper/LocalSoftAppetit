<?php
if(isset($_GET['Id_Publicidad'])){
    $Id_Publicidad = $_GET['Id_Publicidad'];
}
else{
    header("Location: F_A_Publicidad.php");
}
include_once 'Header.php';
echo "<title>Editar Publicidad</title>";
include_once './Clases/Publicidad.php';
$objPublicidad = new Publicidad();
$objPublicidad->ConsultarPorId($Id_Publicidad);
ShowMessage();

?>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-ms-12">
    <img src='<?php echo $objPublicidad->Imagen;?>' style='width: 100%; height:100px;' class='img-responsive'>
</div>



<form action="Validaciones_Lado_Servidor/N_EditarPublicidadUnique.php" method="POST"  enctype="multipart/form-data" id='form'>
                
                    <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                        <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Editar publicidad</label></center></h4></div>
                            </td>
                        </table>
                    </div>
                        
    
    <input type="text" class="ocultar" name="Id_Publicidad" value="<?php echo $objPublicidad->ID;?>">
                        
                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-offset-2 col-lg-8">
                        
                        <table>
                        <tr>
                            <td width="20%"><div class="etiquetas2">Nombre de imagen</div></td>
                            <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNombreImagen'  name='txtNombreImagen'  class='form-control' value='<?php echo $objPublicidad->Nombre ;?>'></div></td>
                        </tr>                        
                        
                        <tr>
                            <td width="20%"><div class="etiquetas2">¿Cambiar imagen?</div></td>
                                    <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'>
                                            <select id="cmbFoto" name="cmbFoto" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Si</option>
                                            </select>
                                </div></td>
                        </tr>                        
                        
                        
                        
                        <tr>
                            <td ><div class="etiquetas2 ocultar" id="lbFoto">Subir foto (.png)</div></td>
                            <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group ocultar' id="txtFoto"><input type='file' class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' id='archivo'  name='archivo'  value=''></div></td>
                        </tr>
                        
                        
                        
            </table>
                    
                    <br><br>    
                        <button type="submit" id="btnAceptar" name="btnMesa" class="btn btn-Bixa btn-ms">Registrar</button>
                        <a href='F_A_Publicidad.php' type="button" class="btn btn-default btn-ms" style="float: right;">
                        Consultar publicidad
                    </a>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                    
                    <br>
                    
                    <br>
                    
                    </div>
                    
                
            </form>            

</body>

<script>
    $(document).ready(function (){
        
        $("#cmbFoto").change(function (){
            
           if($(this).val()==1){
               $("#lbFoto").removeClass("ocultar");
               $("#txtFoto").removeClass("ocultar");
               $("#lbFoto").addClass("mostrar");
               $("#txtFoto").addClass("mostrar");
           } 
           else{
               $("#lbFoto").removeClass("mostrar");
               $("#txtFoto").removeClass("mostrar");
               $("#lbFoto").addClass("ocultar");
               $("#txtFoto").addClass("ocultar");
           }
        });
    });
    
</script>
</html>

