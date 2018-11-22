          <?php
          include_once './Clases/Mesa.php';
            if(isset($_GET['IdMesa'])){

                $ID= $_GET['IdMesa'];
                $objMesa = new Mesa();
                $objMesa->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_ConsultarMesas.php");
            }
          require 'Header.php';
          require_once './Clases/ZonaUbicacion.php';
          
          
          ?>                
        <script src="js/fijo.js"></script>        
        <title>Editar Mesas</title>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Detalle de mesa registrada</label></center></h4></div>
            </td>
        </table>
        </div>
                        

         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">
                 <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="txtID" value="<?php echo $objMesa->ID;?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">No. Mesa</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly=""  name="txtNumeroMesa" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesa->Numero;?>"></div></td>
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Cantidad de personas</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  readonly="" name="txtCantidadPersonas" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesa->CantidadPersonas;?>"></div></td>                            
                        </tr>                        

                        <tr>
                            <?php 
                                $objZonaUbicacion = new ZonaUbicacion();
                                $objZonaUbicacion->ConsultarPorID($objMesa->Ubicacion);
                            ?>
                            
                            <td><div class="etiquetas2">Ubicación</div></td>    
                            <td colspan="4"><div class="campos"><select disabled="" name="txtUbicacion" required title="Ingresar Datos" class="form-control"><option value="<?php echo $objMesa->Ubicacion; ?>"><?php echo $objZonaUbicacion->Descripcion; ?></option></select></div></td>
                            
                        </tr>  
            </table>
         </div>
         
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover" width="84.5%">
                <tr>
                    <td ><div class="etiquetas2">Observaciones</div></td>
                    <?php
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea disabled class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objMesa->Observaciones</textarea></div></td>";
                                
                    ?>
                </tr>
                
                <tr>
                    <td width="20%"><div class="etiquetas2">Estatus</div></td>
                    <td><select disabled="" name="cmbEstatus" id="cmbEstatus" class="input-group form-control">
                    <?php
                       if($objMesa->Activo = '0')
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
           <a href="F_A_RegistrarMesa.php" style="float: right" class="btn btn-Bixa btn-ms" >Agregar otra mesa</a>
                <a class="btn btn-Regresar"  href="F_A_ConsultarMesas.php">
                        &larr; Ver listado de mesas
                </a>
                <a href="F_A_EditarMesas.php?IdMesa=<?php echo $ID;?>" class="btn btn-Bixa">Editar</a>
                <br>
                <br>
        </div>
        
            </form>            
        
    </body>
</html>
