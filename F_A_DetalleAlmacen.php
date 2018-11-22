 <?php
          include_once './Clases/Almacen.php';
            if(isset($_GET['IdAlmacen'])){

                $ID= $_GET['IdAlmacen'];
                $objAlmacen = new Almacen();
                $objAlmacen->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_ConsultarAlmacen.php");
            }
          require 'Header.php';
          
          
?>                
        <script src="js/fijo.js"></script>        
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
                <td class="tdEncabezadoTabla">
                    <div><h4><center><label class="textoEncabezadoTabla">Detalle de almacén</label></center></h4></div>
                </td>
            </table>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">
                <tr>                                             
                <td><div class="etiquetas2">Clave</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly="" type='text' id='txtClaveAlmacen'  name='txtClaveAlmacen'  title='Ingresar Datos' class='form-control' value='<?php echo $objAlmacen->Clave; ?>'></div></td>
                                                          
            </tr>

            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly="" type='text' id='txtDescrAlmacen' name='txtDescrAlmacen'  title='Ingresar Datos' class='form-control' value='<?php echo $objAlmacen->Descripcion; ?>'></div></td>
                                                           
            </tr> 
            </table>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover" width="84.5%">
                <tr>
                    <td ><div class="etiquetas2">Observaciones</div></td>
                    <?php
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea disabled class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objAlmacen->Observaciones</textarea></div></td>";
                                
                    ?>
                </tr>
                
                <tr>
                    <td width="20%"><div class="etiquetas2">Estatus</div></td>
                    <td><select disabled="" name="cmbEstatus" id="cmbEstatus" class="input-group form-control">
                    <?php
                       if($objAlmacen->Estatus = '0')
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
            <a href="F_A_RegistrarAlmacen.php" style="float: right" class="btn btn-Bixa btn-ms" >Agregar otro almacén</a>
            <a class="btn btn-Regresar"  href="F_A_ConsultarAlmacen.php">
                        &larr; Ver listado de almacenes
            </a>
            <?php 
                if($ID>2)
                {
                  echo '<a href="F_A_EditarAlmacen.php?IdAlmacen='.$ID.'" class="btn btn-Bixa">Editar</a>';
                }
                else{
                    echo '<a href="F_A_EditarAlmacen.php?IdAlmacen='.$ID.'" onclick="return false" disabled class="btn btn-Bixa">Editar</a>';
                }
            ?>
            
            <br>
            <br>
        </div>
    </form>                
</body>
</html>
