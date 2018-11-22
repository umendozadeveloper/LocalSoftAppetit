 <?php
          include_once './Clases/Ubicacion.php';
            if(isset($_GET['IdUbicacion'])){

                $ID= $_GET['IdUbicacion'];
                $objUbicacion = new Ubicacion();
                $objUbicacion->ConsultarPorID($ID); 
                
                
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
                    <div><h4><center><label class="textoEncabezadoTabla">Detalle de ubicación</label></center></h4></div>
                </td>
            </table>
        </div>

<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <table class="table-hover">
                  
        </table>  

      
            <br>
                
            
        </div>-->
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">
                <tr>                                             
                <td><div class="etiquetas2">Clave</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly="" type='text' id='txtClaveUbicacion'  name='txtClaveUbicacion'  title='Ingresar Datos' class='form-control' value='<?php echo $objUbicacion->Clave; ?>'></div></td>
                                                          
            </tr>

            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly="" type='text' id='txtDescrUbicacion' name='txtDescrUbicacion'  title='Ingresar Datos' class='form-control' value='<?php echo $objUbicacion->Descripcion; ?>'></div></td>
                                                           
            </tr> 
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover" width="84.5%">
                <tr>
                    <td ><div class="etiquetas2">Observaciones</div></td>
                    <?php
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea disabled class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objUbicacion->Observaciones</textarea></div></td>";
                                
                    ?>
                </tr>
                
                <tr>
                    <td width="20%"><div class="etiquetas2">Estatus</div></td>
                    <td><select disabled="" name="cmbEstatus" id="cmbEstatus" class="input-group form-control">
                    <?php
                       if($objUbicacion->Estatus = '0')
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
            <a href="F_A_RegistrarUbicacion.php" style="float: right" class="btn btn-Bixa btn-ms" >Agregar otra ubicación</a>
            <a class="btn btn-Regresar"  href="F_A_ConsultarUbicacion.php">
                &larr; Ver listado de ubicación
            </a>
            <?php 
                if($objUbicacion->ID >0)
                {
                   echo '<a href="F_A_EditarUbicacion.php?IdUbicacion='.$ID.'" class="btn btn-Bixa">Editar</a>'; 
                }
                else{
                   echo '<a href="F_A_EditarUbicacion.php?IdUbicacion='.$ID.'" onclick="return false" disabled class="btn btn-Bixa">Editar</a>'; 
                }
            ?>
            
                <br>
                <br>
        </div>
    </form>                
</body>
</html>
