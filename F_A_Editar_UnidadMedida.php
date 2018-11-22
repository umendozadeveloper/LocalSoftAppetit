          <?php
          include_once './Clases/UnidadMedidaInsumos.php';
            if(isset($_GET['IdUnidad'])){

                    $ID= $_GET['IdUnidad'];
//                }
                $objUnidad = new UnidadMedidaInsumo();
                $objUnidad->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_Consultar_UnidadMedida.php");
            }
          require 'Header.php';
          
          
          ?>                
        <script src="js/fijo.js"></script>        
        <title>Editar unidades de medida</title>

        <form action="Validaciones_Lado_Servidor/Validar_EditarUnidadMedida.php" method="POST" enctype="multipart/form-data">
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar unidad de medida</label></center></h4></div>
            </td>
        </table>
        </div>
                        
                
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
             <table class="table-hover">
                 <tr>
                    <td> <input type="text" style="color: black;" class="ocultar" name="txtID" value="<?php echo $objUnidad->ID;?>"></td>
                </tr>
                 <tr>                                             
                    <td><div class="etiquetas2">Clave</div></td>
                  <?php
                    if(!isset($_SESSION['valClaveUM']) && (empty($_SESSION['valClaveUM'])))
                    {

                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveUM'  name='txtClaveUM'  title='Ingresar Datos' class='form-control' value='$objUnidad->Clave'></div></td>";
                    }
                    else{
                        $mesa = $_SESSION['valClaveUM'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveUM'  name='txtClaveUM'  title='Ingresar Datos' class='form-control' value='$mesa'></div></td>";
                        $_SESSION['valClaveUM']=null;
                    }
                ?>             
            </tr>
            
            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
                <?php
                    if(!isset($_SESSION['valDescrUM']) && (empty($_SESSION['valDescrUM'])))
                        {

                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDescrUM' name='txtDescrUM'  title='Ingresar Datos' class='form-control' value='$objUnidad->Descripcion'></div></td>";
                        }
                        else{
                            $cantidad = $_SESSION['valDescrUM'];
                            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text'  id='txtDescrUM'  name='txtDescrUM'  title='Ingresar Datos' class='form-control' value='$cantidad'></div></td>";
                            $_SESSION['valDescrUM']=null;
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
                   echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objUnidad->Observaciones</textarea></div></td>";

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
                            if($objUnidad->Estatus =='0')
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
                if($ID>5)
                {
                    echo '<button type="submit" id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>';
                }
                else{
                    echo '<button type="submit" disabled id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>';
                
                }
             ?>   
            <a class="btn btn-Regresar"  href="F_A_Consultar_UnidadMedida.php">
                  &larr; Ver listado de unidades de medida
                </a>
            <br>
            <br>
        </div>
                
        </div>
        
            </form>            
        
    </body>
</html>
