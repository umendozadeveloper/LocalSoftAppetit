 <?php
          include_once './Clases/Clasificador.php';
            if(isset($_GET['IdClasificador'])){

                $ID= $_GET['IdClasificador'];
                $objClasificador = new Clasificador();
                $objClasificador->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_ConsultarClasificador.php");
            }
          require 'Header.php';
          
          
?>                
        <script src="js/fijo.js"></script> 
        <title>Detalle Clasificador</title>
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
                <td class="tdEncabezadoTabla">
                    <div><h4><center><label class="textoEncabezadoTabla">Detalle de clasificador registrado</label></center></h4></div>
                </td>
            </table>
        </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
        <table class="table-hover">
             <tr>                                             
                <td><div class="etiquetas2">Clave</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly="" type='text' id='txtClaveClasif'  name='txtClaveClasif'  title='Ingresar Datos' class='form-control' value='<?php echo $objClasificador->Clave; ?>'></div></td>
                                             
            </tr>

            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly="" type='text' id='txtDescrClasif' name='txtDescrClasif'  title='Ingresar Datos' class='form-control' value='<?php echo $objClasificador->Descripcion; ?>'></div></td>
                                             
            </tr> 
            <tr>                                             
                <td><div class="etiquetas2">¿Se sirve en copas(ml)?</div></td>
               
                 <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'>
                         <select disabled="" id="cmbEsBebida" name="cmbEsBebida" class="form-control">
                    <?php
                       if($objClasificador->EsBebida == '0')
                       {
                           echo '<option value="0" selected>No</option>';
                           echo '<option value="1">Sí</option>';
                       }else{
                            echo '<option value="0">No</option>';
                            echo '<option value="1" selected>Sí</option>'; 
                       }
                        
                        
                    ?>
                    </select>
                </div></td> 

            </tr>  
        </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
        <table class="table-hover" width="84.5%">
            <tr>
                    <td ><div class="etiquetas2">Observaciones</div></td>
                    <?php
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea disabled class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objClasificador->Observaciones</textarea></div></td>";
                                
                    ?>
                </tr>
                
                <tr>
                    <td width="20%"><div class="etiquetas2">Estatus</div></td>
                    <td><select disabled="" name="cmbEstatus" id="cmbEstatus" class="input-group form-control">
                    <?php
                       if($objClasificador->Estatus = '0')
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
        <a href="F_A_RegistrarClasificador.php" style="float: right" class="btn btn-Bixa btn-ms" >Agregar otro clasificador</a>
        <a class="btn btn-Regresar"  href="F_A_ConsultarClasificador.php">
                        &larr; Ver listado de clasificadores
        </a>
        <?php 
            if($ID>1){
               echo '<a href="F_A_Editar_Clasificador.php?IdClasificador='.$ID.'" class="btn btn-Bixa">Editar</a>';
            }
            else{
               echo '<a href="F_A_Editar_Clasificador.php?IdClasificador='.$ID.'" onclick="return false" disabled class="btn btn-Bixa">Editar</a>';
            }
        ?>
        
        <br>
        <br>
    </div>
    </form>                
</body>
</html>
