          <?php
          include_once './Clases/Almacen.php';
            if(isset($_GET['IdAlmacen'])){

                    $ID= $_GET['IdAlmacen'];
//                }
                $objAlmacen = new Almacen();
                $objAlmacen->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_ConsultarAlmacen.php");
            }
          require 'Header.php';
          
          
          ?>                
        <script src="js/fijo.js"></script>        
        <title>Editar almacén</title>

        <form action="Validaciones_Lado_Servidor/Validar_EditarAlmacen.php" method="POST" enctype="multipart/form-data">
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar almacén</label></center></h4></div>
            </td>
        </table>
        </div>
                        
               
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
             <table class="table-hover">
                  <tr>
                    <td> <input type="text" style="color: black;" class="ocultar" name="txtID" value="<?php echo $objAlmacen->ID;?>"></td>
                </tr>
                       
                    
            <tr>                                             
                <td><div class="etiquetas2">Clave</div></td>
                <?php
                if(!isset($_SESSION['valClaveAlmacen']) && (empty($_SESSION['valClaveAlmacen'])))
                    {

                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveAlmacen'  name='txtClaveAlmacen'  title='Ingresar Datos' class='form-control' value='$objAlmacen->Clave'></div></td>";
                    }
                    else{
                        $mesa = $_SESSION['valClaveAlmacen'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveAlmacen'  name='txtClaveAlmacen'  title='Ingresar Datos' class='form-control' value='$mesa'></div></td>";
                        $_SESSION['valClaveAlmacen']=null;
                    }
                ?>             
            </tr>

            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
                <?php
                if(!isset($_SESSION['valDescrAlmacen']) && (empty($_SESSION['valDescrAlmacen'])))
                    {

                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDescrAlmacen' name='txtDescrAlmacen'  title='Ingresar Datos' class='form-control' value='$objAlmacen->Descripcion'></div></td>";
                    }
                    else{
                        $cantidad = $_SESSION['valDescrAlmacen'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text'  id='txtDescrAlmacen'  name='txtDescrAlmacen'  title='Ingresar Datos' class='form-control' value='$cantidad'></div></td>";
                        $_SESSION['valDescrAlmacen']=null;
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
                   echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objAlmacen->Observaciones</textarea></div></td>";

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
                            if($objAlmacen->Estatus =='0')
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
                if($ID>2)
                {
                    echo '<button type="submit" id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>';
                }
                else{
                    echo '<button disabled type="submit" id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>';
                }
            ?>
            
            <a class="btn btn-Regresar"  href="F_A_ConsultarAlmacen.php">
                  &larr; Ver listado de almacenes
                </a>
            <br>
            <br>
        </div>  
    </form>            
        
    </body>
</html>
