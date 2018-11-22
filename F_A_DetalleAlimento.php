                      <title>Alimento a detalle</title>
            <?php
                if(isset($_GET['IdPlatillo'])){

                    $IdPlatillo= $_GET['IdPlatillo'];                
                }
                else{
                    header("Location: F_A_ConsultarPlatillos.php");
                }
                require 'Header.php';  
                require_once './Clases/Vino.php';
                require_once './Clases/Platillo.php';
                include_once './Clases/Sommelier.php';
                include_once './Clases/SubMenu.php';
                include_once './Clases/PlatillosSubMenu.php';
                include_once './Clases/Tiempos.php';
                $objPlatillo = new Platillo();
              
                $objPlatillo->ConsultarPorID($IdPlatillo);  
                
            ?>
        
        
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Datos del alimento</label></center></h4></div>
            </td>
        </table>
        </div>    
            
        
        
        
            
            
            

        
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <table class="table-hover">
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Nombre del platillo</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombrePlatillo" required title="Ingresar Datos" class="form-control" readonly="" value="<?php echo $objPlatillo->Nombre?>"></div></td>
                        </tr>                        
                        <tr>
                            <td> <label></label></td>
                        </tr>
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $objPlatillo->ID;?>"></td>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosPNombre" value="<?php echo $objPlatillo->Nombre;?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción corta</div></td>
                            <td colspan="4"><textarea class='claseTextArea form-control' rows='3' readonly=""  name='txtDescripcionCorta'><?php echo $objPlatillo->DescripcionCorta;?></textarea></td>    
                        </tr>                        
                        
                        <tr>
                            <td><label></label></td>
                        </tr>
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción larga</div></td>
                            <td colspan="4"><textarea class='claseTextArea form-control' readonly="" rows='5' name='txtDescripcionLarga'><?php echo $objPlatillo->DescripcionLarga;?></textarea></td>
                        </tr>                        
                        
                        <tr>
                            <td><div class="etiquetas2">Precio</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly=""  name="txtPrecio" required title="Ingresar Datos" class="form-control" value="<?php echo $objPlatillo->Precio;?>"></div></td>
                        </tr>
                        <tr>
                            <td><div class="etiquetas2">IVA</div></td>

                            <?php 
                            
                            echo "<td><select disabled name='txtIVA' id='txtIVA' class='input-group form-control'>";
                    
                    if($objPlatillo->Iva==16)
                    {
                        echo "<option value='16' selected=''>
                        16%
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='16'>
                        16%
                    </option>";
                    }
                    
                    if($objPlatillo->Iva==0)
                    {
                        echo "<option value='0' selected=''>
                        Tasa 0
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='0'>
                        Tasa 0
                    </option>";
                    }
                    
                    
                    if($objPlatillo->Iva==1)
                    {
                        echo "<option value='1' selected=''>
                        Exento
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='1'>
                        Exento
                    </option>";
                    }
                            
                            ?>

                        </tr>
                    </table>
                </div>
                        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
                    <table class="table-hover">
                        <tr>
                            <td><div class="etiquetas2">Ícono</div></td>
                            <td><div class='imagenesTablaFoto'><img class='' src='<?php echo $objPlatillo->Icono;?>'></div></td>
                        </tr>                        
                        
                        <tr>
                            <td><div class="etiquetas2">Foto</div></td>
                            <td><div class='imagenesTablaFoto'><img class='img-responsive' src='<?php echo $objPlatillo->Foto;?>'></div></td>
                        </tr>
                       <td width="20%"><div class="etiquetas2">Tiempo</div></td>
      <td width='84%'><div class='campos'><select disabled id="cmcTiempo" class="form-control" name="cmbTiempo">
            <?php
                $objTiempo = new Tiempos();
                $objTiempo->ConsultarPorID($objPlatillo->IdTiempo);
                echo "<option value='$objTiempo->ID'>$objTiempo->Clave</option>";
            
            ?>
              </select>
          </div>
    </tr> 
                        
                </table>
                </div>
                    
                    
                    
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <br>
                <br>
                <a href="F_A_RegistrarPlatillo.php" class="btn btn-Bixa"  style="float: right" >Agregar otro alimento</a>
                    <a class="btn btn-Regresar"  href="F_A_ConsultarPlatillos.php">
                        &larr; Ver listado de platillos
                    </a>
                
                <a class="btn btn-Bixa" href="F_A_EditarPlatillo.php?IdPlatillo=<?php echo $IdPlatillo;?>">Editar</a>
                    <br>
                    <br>
                </div>
            
    </body>
    

        
</html>
