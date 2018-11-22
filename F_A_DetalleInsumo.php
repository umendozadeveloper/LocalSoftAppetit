 <?php
          include_once './Clases/Insumo.php';
          require_once './Clases/UnidadMedidaInsumos.php';
          require_once './Clases/UMContent.php';
          require_once './Clases/Clasificador.php';
          require_once './Clases/Ubicacion.php';
            if(isset($_GET['IdInsumo'])){

                $ID= $_GET['IdInsumo'];
                $objInsumo = new Insumo();
                $objInsumo->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_Consultar_Insumos.php");
            }
          require 'Header.php';
          
          
?>                
        <script src="js/fijo.js"></script>        
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
                <td class="tdEncabezadoTabla">
                    <div><h4><center><label class="textoEncabezadoTabla">Detalle de insumo</label></center></h4></div>
                </td>
            </table>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
    <table border='0'>
      
    <tr>
        <td colspan="1"><div class="etiquetas2">Descripción</div></td>

        <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' disabled="" rows='1' id='txtDescripcion' name='txtDescripcion'><?php echo $objInsumo->Descripcion; ?></textarea></div></td>
           
    </tr>   
    <tr>
        <td width="20%"><div class="etiquetas2">Presentación</div></td>
        <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtPresentacion' readonly=""  name='txtPresentacion'    class='form-control' value='<?php echo $objInsumo->Presentacion; ?>'></div></td>
    </tr> 
    
    <tr>
      <td width="20%"><div class="etiquetas2">Unidad de medida</div></td>
      <td><div class='campos'><select id="cmbUnidadMedida" class="form-control" name="cmbUnidadMedida" disabled="">
            <?php
                
                $objUnidad = new UnidadMedidaInsumo();
                $unidades = $objUnidad->ConsultarTodo();
                foreach ($unidades as $u) {
                    if ($objInsumo->IdUnidadMedida == $u->ID) {
                            echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                    } else {
                        echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                    }
               
                }
            
            ?>
              </select>
          </div>
    </tr>
    <tr><td><div class="etiquetas2">Contenido</div></td><td><div class="etiquetas2">Unidad</div></td></tr>
    <tr>        
        <td style="width:40%;"><input class="form-control" name="txtContenido" id='txtContenido' value="<?php echo $objInsumo->Contenido; ?>" disabled=""></td>
        <td style="width:60%;"><select class='form-control' name="cmbUMContenido" id="cmbUMContenido" disabled="">
                <?php 
                  $objUMC = new UMContent();
                  $UMC = $objUMC->ConsultarTodo();
                  foreach ($UMC as $u)
                  {
                      if($objInsumo->IdUMContent == $u->ID){
                          echo '<option value="'.$u->ID.'" selected>'.$u->Clave.'</option>';
                      }else{
                          echo '<option value="'.$u->ID.'">'.$u->Clave.'</option>';
                      }
                      
                  }
                  
                ?>
                    </select></td>
    </tr>
       <tr>
        <td ><div class="etiquetas2">Clasificador</div></td>
        <td><div class='campos'><select id="cmbClasificacion" class="form-control" name="cmbClasificacion" disabled="">
                    
        <?php
            $objClasificador = new Clasificador();
            $clasificadores = $objClasificador->ConsultarTodo();
            foreach ($clasificadores as $clasif) {
                if ($objInsumo->IdClasificador == $clasif->ID) {
                    echo "<option value ='" . $clasif->ID . "' selected>" . $clasif->Descripcion . "</option>";
                } 
                else {
                    echo "<option value ='" . $clasif->ID . "'>" . $clasif->Descripcion . "</option>";
                }
                
            }
         
        ?>     
    </tr>      
    </table>


</div>
                    
                    
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
    <table>
                           
                      

         <tr>
            <td ><div class="etiquetas2">Stock mínimo</div></td> 
            <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input  disabled="" type='text' id='txtMinimo'  name='txtMinimo' class='form-control' value='<?php echo $objInsumo->StockMinimo; ?>'></div></td>
            
        </tr>
       <tr>
        <td ><div class="etiquetas2">Stock máximo</div></td>
        <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input disabled="" type='text' id='txtMaximo'  name='txtMaximo' class='form-control' value='<?php echo $objInsumo->StockMaximo; ?>'></div></td>
        
    </tr>              
            
        
    <tr>
        <td><div class="etiquetas2">Ubicación</div></td>
        <td><div class='campos'><select id="cmbUbicacion" class="form-control" name="cmbUbicacion" disabled="">
        <?php
             $objUbicacion = new Ubicacion();
            $ubicaciones = $objUbicacion->ConsultarTodo();
            foreach ($ubicaciones as $u) {
                if ($objInsumo->IdUbicacion == $u->ID) {
                    echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                } 
                else {
                    echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                }
                
            }
        ?>     
    </tr> 
      <tr>
        <td ><div class="etiquetas2">Observaciones</div></td>
    <?php
        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' disabled='' rows='3' id='txtObservaciones' name='txtObservaciones'>$objInsumo->Observaciones</textarea></div></td>";
            
        ?>
    </tr>
    <tr>
        <td><div class="etiquetas2">Estatus</div></td>
        <td><div class='campos'><select id="cmbEstatus" class="form-control" name="cmbEstatus" disabled="">
            <?php 
                if($objInsumo->Status == '0')
                {
                    echo "<option value='1'>Activo</option>";
                    echo "<option value='0' selected>Inactivo</option>";
                }else if($objInsumo->Status == '1'){
                    echo "<option value='1' selected>Activo</option>";
                    echo "<option value='0'>Inactivo</option>";
                }
            ?>
                    
                    
        </select>
        </div></td>
        
    </tr>                    
              

    </table>
</div>
              
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">  
            <br><br>
            <a href="F_A_Registrar_Insumo_Inventario.php" style="float: right" class="btn btn-Bixa btn-ms" >Agregar otro insumo</a>
            <a class="btn btn-Regresar"  href="F_A_Consultar_Insumos.php">
                        &larr; Ver listado de insumos
                </a>
                <a href="F_A_EditarInsumo.php?IdInsumo=<?php echo $ID;?>" class="btn btn-Bixa">Editar</a>
                <br>
                <br>
        </div>
    </form>                
</body>
</html>
