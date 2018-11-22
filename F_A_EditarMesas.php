          <?php
          include_once './Clases/Mesa.php';
          include_once './Clases/ZonaUbicacion.php';
            if(isset($_POST['btnMesa']) || isset($_GET['IdMesa'])){
            
                if(isset($_POST['btnMesa'])&& $_POST['btnMesa'])    
                {
                    $ID= $_REQUEST['btnMesa'];
                }
                else
                {
                    
                    if(!empty($_SESSION['msjEditarMesas'])){
                        
                        echo "<script>swal('".$_SESSION['msjEditarMesas'][0]."');</script>";
                        $_SESSION['msjEditarMesas']="";
                            }
                    
                    $ID= $_GET['IdMesa'];
                }
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

        <form action="Validaciones_Lado_Servidor/Validar_EditarMesa.php" method="POST" enctype="multipart/form-data">
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar datos de la mesa <?php echo $objMesa->Numero?></label></center></h4></div>
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
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNumeroMesa" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesa->Numero;?>"></div></td>
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Cantidad de personas</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtCantidadPersonas" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesa->CantidadPersonas;?>"></div></td>                            
                        </tr>                        

                       <tr>
      <td width="20%"><div class="etiquetas2">Zona de ubicación</div></td>
      <td><div class='campos'><select id="txtUbicacion" class="form-control" name="txtUbicacion">
            <?php
                $objZonaUbicacion = new ZonaUbicacion();
                $zonasUbicacion = $objZonaUbicacion->ConsultarTodo();
                foreach ($zonasUbicacion as $u) {
                if (isset($_SESSION['valUbicacion']) && !empty($_SESSION['valUbicacion'])) {
                    $dato = $_SESSION['valUbicacion'];
                    if ($u->ID == $dato) {
                        echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                    } else {
                        echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                    }
                } else {
                    
                    if($u->ID == $objMesa->Ubicacion)
                    {
                        echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                     
                    }
                    else{
                        echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                     
                    }
                  
                }
            }
            $_SESSION['valUbicacion'] = null;
            ?>
              </select>
          </div>
    </tr>
            </table>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
              <table class="table-hover" >
                 <tr>
                    <td ><div class="etiquetas2">Observaciones</div></td>
                <?php
                   echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objMesa->Observaciones</textarea></div></td>";

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
                            if($objMesa->Activo =='0')
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
            <button type="submit" id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>
                <a class="btn btn-Regresar"  href="F_A_ConsultarMesas.php">
                      &larr; Ver listado de mesas
                    </a>
                <br>
                <br>
        </div>
        
            </form>            
        
    </body>
</html>
