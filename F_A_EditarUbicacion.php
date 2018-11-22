          <?php
          include_once './Clases/Ubicacion.php';
            if(isset($_GET['IdUbicacion'])){
            
                    
                    $ID= $_GET['IdUbicacion'];
//                }
                $objUbicacion = new Ubicacion();
                $objUbicacion->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_ConsultarUbicacion.php");
            }
          require 'Header.php';
          
          
          ?>                
        <script src="js/fijo.js"></script>        
        <title>Editar ubicación</title>

        <form action="Validaciones_Lado_Servidor/Validar_EditarUbicacion.php" method="POST" enctype="multipart/form-data">
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar ubicación</label></center></h4></div>
            </td>
        </table>
        </div>


      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
          <table class="table-hover">
              <tr>
                    <td> <input type="text" style="color: black;" class="ocultar" name="txtID" value="<?php echo $objUbicacion->ID;?>"></td>
                </tr>
                       
                    
            <tr>                                             
                <td><div class="etiquetas2">Clave</div></td>
               <?php
                if(!isset($_SESSION['valClaveUbicacion']) && (empty($_SESSION['valClaveUbicacion'])))
                    {

                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveUbicacion'  name='txtClaveUbicacion'  title='Ingresar Datos' class='form-control' value='$objUbicacion->Clave'></div></td>";
                    }
                    else{
                        $mesa = $_SESSION['valClaveUbicacion'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveUbicacion'  name='txtClaveUbicacion'  title='Ingresar Datos' class='form-control' value='$mesa'></div></td>";
                        $_SESSION['valClaveUbicacion']=null;
                    }
                ?>              
            </tr>

            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
             <?php
                if(!isset($_SESSION['valDescrUbicacion']) && (empty($_SESSION['valDescrUbicacion'])))
                    {

                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDescrUbicacion' name='txtDescrUbicacion'  title='Ingresar Datos' class='form-control' value='$objUbicacion->Descripcion'></div></td>";
                    }
                    else{
                        $cantidad = $_SESSION['valDescrUbicacion'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text'  id='txtDescrUbicacion'  name='txtDescrUbicacion'  title='Ingresar Datos' class='form-control' value='$cantidad'></div></td>";
                        $_SESSION['valDescrUbicacion']=null;
                    }
                ?>             
            </tr>
          </table>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
              <table class="table-hover" >
                 <tr>
                    <td ><div class="etiquetas2">Observaciones</div></td>
                <?php
                   echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objUbicacion->Observaciones</textarea></div></td>";

                    ?>
                </tr>
                
                <tr>
                    <td><div class="etiquetas2">Estatus</div></td>
                    <td><div class='campos'><select id="cmbEstatus" class="form-control" name="cmbEstatus">
                        <?php
                        if (isset($_SESSION['valStatus']) && !empty($_SESSION['valStatus'])) {
                            if ($_SESSION['valStatus']=='0')
                            {
                                echo "<option value='1'>Activo</option>
                                      <option value='0' selected>Inactivo</option>";
                            }else{
                                echo "<option value='1' selected>Activo</option>
                                      <option value='0'>Inactivo</option>";
                            }
                        }
                        else{
                            if($objUbicacion->Estatus =='0')
                            {
                                echo "<option value='1'>Activo</option>
                                      <option value='0' selected>Inactivo</option>";
                            }
                            else{
                                 echo "<option value='1' selected>Activo</option>
                                      <option value='0'>Inactivo</option>";
                            }

                             $_SESSION['valStatus']=null;
                        }
                    ?>


                    </select>
                    </div></td>

                </tr>  
              </table>
          </div>
                       
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <br>
            <?php 
                if($objUbicacion->ID>0)
                {
                   echo '<button type="submit" id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>';
             
                }
                else{
                    echo '<button type="submit" disabled id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>';
             
                }
            ?>
            
            
            <a class="btn btn-Regresar"  href="F_A_ConsultarUbicacion.php">
                  &larr; Ver listado de ubicaciones
                </a>
            <br>
            <br>
        </div>
        
        </form>            
        
    </body>
</html>
