          <?php
          include_once './Clases/Concepto.php';
            if(isset($_GET['IdConcepto'])){
            
                  $ID= $_GET['IdConcepto'];
//                }
                $objConcepto = new Concepto();
                $objConcepto->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_ConsultarConceptos.php");
            }
          require 'Header.php';
          
          
          ?>                
        <script src="js/fijo.js"></script>        
        <title>Editar concepto</title>

        <form action="Validaciones_Lado_Servidor/Validar_EditarConcepto.php" method="POST" enctype="multipart/form-data">
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar concepto</label></center></h4></div>
            </td>
        </table>
        </div>


         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
             <table class="table-hover">
                 <tr>
                    <td> <input type="text" style="color: black;" class="ocultar" name="txtID" value="<?php echo $objConcepto->ID;?>"></td>
                </tr>
                       
                    
            <tr>                                             
                <td><div class="etiquetas2">Clave</div></td>
               <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveConcepto'  name='txtClaveConcepto'  title='Ingresar Datos' class='form-control' value='<?php echo $objConcepto->Clave; ?>'></div></td>
                               
            </tr>

            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDescrConcepto' name='txtDescrConcepto'  title='Ingresar Datos' class='form-control' value='<?php echo $objConcepto->Descripcion; ?>'></div></td>
                               
            </tr>    
            <tr>                                             
                <td><div class="etiquetas2">¿Es una entrada o salida?</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'>
                    <select id="cmbES" name="cmbES" class="form-control">
                    <?php
                    if (!isset($_SESSION['valES']) && empty($_SESSION['valES'])) {
                        if($objConcepto->ES == '0')
                        {
                           echo "<option value='1'>Entrada</option><option value='0' selected>Salida</option>"; 
                    }else{
                        echo "<option value='1' selected>Entrada</option><option value='0'>Salida</option>";
                    }
                        
                         $_SESSION['valES']=null;
                    }
                    else{

                         if ($_SESSION['valES']=='0')
                        {
                            echo "<option value='1'>Entrada</option>";
                            echo "<option value='0' selected>Salida</option>";


                        }else if($_SESSION['valES']=='1'){

                            echo "<option value='0'>Salida</option>";
                            echo "<option value='1' selected>Entrada</option>";


                        }
                    }
                ?>
                    </select>
                </div></td>          
            </tr> 
            
             </table>
         </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
              <table class="table-hover" >
                 <tr>
                    <td ><div class="etiquetas2">Observaciones</div></td>
                <?php
                   echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$objConcepto->Observaciones</textarea></div></td>";

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
                            if($objConcepto->Estatus =='0')
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
                   echo '<button type="submit" disabled id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>'; 
                }
            ?>
            
            <a class="btn btn-Regresar"  href="F_A_ConsultarConceptos.php">
                  &larr; Ver listado de conceptos
                </a>
            <br>
            <br>
        </div>
            </form>            
        
    </body>
</html>
