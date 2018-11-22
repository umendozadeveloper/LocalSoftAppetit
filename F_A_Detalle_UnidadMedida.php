 <?php
          include_once './Clases/UnidadMedidaInsumos.php';
            if(isset($_GET['IdUnidad'])){

                $ID= $_GET['IdUnidad'];
                $objUnidad = new UnidadMedidaInsumo();
                $objUnidad->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_Consultar_UnidadMedida.php");
            }
          require 'Header.php';
          
          
?>                
        <script src="js/fijo.js"></script>  
        <title>Detalle Unidades Medida</title>
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
                <td class="tdEncabezadoTabla">
                    <div><h4><center><label class="textoEncabezadoTabla">Detalle de unidad de medida registrada</label></center></h4></div>
                </td>
            </table>
        </div>


         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
             <table class="table-hover">
                  <tr>                                             
                <td><div class="etiquetas2">Clave</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input disabled="" type='text' id='txtClaveUM'  name='txtClaveUM'  title='Ingresar Datos' class='form-control' value='<?php echo $objUnidad->Clave; ?>'></div></td>
                               
            </tr>

            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input disabled="" type='text' id='txtDescrUM' name='txtDescrUM'  title='Ingresar Datos' class='form-control' value='<?php echo $objUnidad->Descripcion; ?>'></div></td>
                               
            </tr> 
             </table>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover" width="84.5%">
                <tr>
                    <td ><div class="etiquetas2">Observaciones</div></td>
                    <?php
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea disabled class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objUnidad->Observaciones</textarea></div></td>";
                                
                    ?>
                </tr>
                
                <tr>
                    <td width="20%"><div class="etiquetas2">Estatus</div></td>
                    <td><select disabled="" name="cmbEstatus" id="cmbEstatus" class="input-group form-control">
                    <?php
                       if($objUnidad->Estatus = '0')
                       {
                           echo '<option value="0" selected>Inactivo</option>';
                           echo '<option value="1">Activo</option>';
                       }
                       else{
                           echo '<option value="0">Inactivo</option>';
                           echo '<option value="1" selected>Activo</option>';
                       }
                           
                        
                    ?>

                   </select></td>
                </tr> 
            </table>
         </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <br>
            <br>
            <a href="F_A_Registrar_UnidadMedida.php" style="float: right" class="btn btn-Bixa btn-ms" >Agregar otra unidad de medida</a>
            <a class="btn btn-Regresar"  href="F_A_Consultar_UnidadMedida.php">
                        &larr; Ver listado de unidades de medida
                </a>
            <?php 
                if($ID>5)
                {
                    echo '<a href="F_A_Editar_UnidadMedida.php?IdUnidad='.$ID.'" class="btn btn-Bixa">Editar</a>';
                }
                else{
                    echo '<a href="F_A_Editar_UnidadMedida.php?IdUnidad='.$ID.'" onclick="return false" disabled class="btn btn-Bixa">Editar</a>';
                }
            ?>
                
                <br>
                <br>
        </div>
    </form>                
</body>
</html>
