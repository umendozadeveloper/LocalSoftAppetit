          <?php
         
          require 'Header.php';
          
          
          ?>                
            <title>Bebida a detalle</title>
        <?php
          
        
        include_once  './Clases/Vino.php';
        include_once './Clases/Platillo.php';
        include_once './Clases/Maridaje.php';
        include_once './Clases/SubMenu.php';
        include_once './Clases/VinosSubMenu.php';
        include_once './Clases/ProductoCompuesto.php';
        ?>
        
        
        <?php
        
            if(isset($_POST['btnAceptar']) || isset($_GET['IdVino'])){
                if(isset($_POST['btnAceptar'])&& $_POST['btnAceptar']){
                    $idPlatilloEd= $_REQUEST['btnAceptar'];
                }
                else{
                    $idPlatilloEd= $_GET['IdVino'];
                    if(!empty($_SESSION['msjEditarVino'])){       
                        echo "<script>swal('".$_SESSION['msjEditarVino'][0]."');</script>";
                        $_SESSION['msjEditarVino']="";
                            }
                        
                }
                $objVino = new Vino();
                $objVino->ConsultarPorID($idPlatilloEd);                
                
            }
            else{
                header("Location: F_A_ConsultarVinos.php");
            }

            ?>
            
            <form action="Validaciones_Lado_Servidor/Validar_EditarVino.php" method="POST" enctype="multipart/form-data">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Datos de la bebida</label></center></h4></div>
            </td>
        </table>
        </div>    

                        
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <table class="table-hover">
                
                        <tr>
                            <td><div class="etiquetas2">Nombre del vino</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombrePlatillo" required title="Ingresar Datos" class="form-control" readonly="" value="<?php echo $objVino->Nombre;?>"></div></td>
                            
                        </tr>                        
                        
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $objVino->ID;?>"></td>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosPNombre" value="<?php echo $objVino->Nombre?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción corta</div></td>
                            <td colspan="4"><textarea class='claseTextArea form-control' rows='3' readonly="" name='txtDescripcionCorta'><?php echo $objVino->DescripcionCorta;?></textarea></td>
                            
                            
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción larga</div></td>
                            <td colspan="4"><textarea class='claseTextArea form-control' readonly="" rows='5' name='txtDescripcionLarga'><?php echo $objVino->DescripcionLarga?></textarea></td>
                            
                            
                        </tr>                        
                        <tr>
                            <td> <label></label></td>
                        </tr> 
                        
                        <tr>
                                     <td><div class="etiquetas2">¿Doble presentación? (Botella/Copa)</div></td>
                
                                <td><select disabled name="txtDoble" id="txtDoble" class="input-group form-control">
                                        <option value="0" <?php if(!$objVino->DoblePresentacion){echo "selected";}?>>No</option>
                                        <option value="1" <?php if($objVino->DoblePresentacion){echo "selected";}?>>Sí</option>
                                    </select>
                                </td>                                   
                        </tr>
                        
                         <tr id="trPrecio">
                            <td><div class="etiquetas2">Precio </div></td>
                            <td colspan="4"><div class="campos"><input readonly="" type="text"  name="txtPrecio" required title="Ingresar Datos" class="form-control" value="<?php echo $objVino->PrecioBotella;?>"></div></td>
                            
                        </tr>        
                       
                        
                        
                        <tr id="trCopa">
                            <td><div class="etiquetas2">Precio copa</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly=""  name="txtPrecioCopa" required title="Ingresar Datos" class="form-control" value="<?php echo $objVino->PrecioCopa;?>"></div></td>
                            
                        </tr>                        
                        
                        
                        <tr id="trBotella">
                            <td><div class="etiquetas2">Precio botella</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly=""  name="txtPrecioBotella" required title="Ingresar Datos" class="form-control" value="<?php echo $objVino->PrecioBotella;?>"></div></td>
                            
                        </tr>                        
                        <tr>
                            <td><div class="etiquetas2">IVA</div></td>
                            <?php 
                            
                            echo "<td><select disabled name='txtIVA' id='txtIVA' class='input-group form-control'>";
                    
                    if($objVino->Iva==16)
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
                    
                    if($objVino->Iva==0)
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
                    
                    
                    if($objVino->Iva==1)
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
                        
                        <tr>
                            <td> <label></label></td>
                        </tr>
                          <tr>
                            <td> <label></label></td>
                        </tr>
                        <tr>
                            <td><div class="etiquetas2">¿Es producto compuesto?</div></td>
                            <td>
                                <select disabled class='input-group form-control'>
                                    <?php 
                                    echo "<option>";
                                    if($objVino->Compuesto){
                                        echo "Sí";
                                    }
                                    else{
                                        echo "No";
                                    }
                                    echo "</option>";
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <?php
                        if ($objVino->Compuesto) {
                            ?>
                        
                        <tr>
                            <td> <label></label></td>
                        </tr>
                          <tr>
                            <td> <label></label></td>
                        </tr>
                        <tr>
                            <td> <label></label></td>
                        </tr>
                          <tr>
                            <td> <label></label></td>
                        </tr>
                            <tr>
                            <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                                <thead style="margin-bottom: 10px;">

                                    <tr>
                                        <th style=""><div class="centrar"><label>Nombre</label></div></th>
                                        <th style=""><div class="centrar"><label>Cantidad</label></div></th>                    
                                        <th style=""><div class="centrar"><label>Tipo</label></div></th>                         

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $compuesto = new ProductoCompuesto();
                                    $productos = $compuesto->ConsultarPorIDProducto_IDTipo($objVino->ID, 1);
                                    foreach($productos as $pc){
                                        echo "<tr>";
                                        echo "<td>$pc->Nombre</td>";
                                        echo "<td>$pc->Cantidad</td>";
                                        echo "<td>$pc->Tipo</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                    }
                    ?>
                        </tr>
                        
                    </table>
                        </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
                    <table class="table-hover">
                        <tr>
                            <td><div class="etiquetas2">Ícono</div></td>
                            <td><div class='imagenesTablaFoto'><img class='' src='<?php echo $objVino->Icono;?>'></div></td>
                        </tr> 
                        
                        <tr>
                            <td><div class="etiquetas2">Foto</div></td>
                            <td><div class='imagenesTablaFoto'><img class='' src='<?php echo $objVino->Foto;?>'></div></td>
                        </tr> 
                        
                        
            
            </table>
            </div>
                
                    <div class="visible-lg visible-md col-md-12 col-lg-offset-1 col-lg-10">
                <br>
                <br>
                <a href="F_A_RegistrarVino.php" style="float: right" class="btn btn-Bixa" >Registrar otra bebida</a>
                    <a class="btn btn-Regresar"  href="F_A_ConsultarVinos.php">
                        Ver listado de bebidas
                    </a>
                
                    <a class='btn btn-Bixa' href="F_A_EditarVino.php?IdVino=<?php echo $idPlatilloEd;?>">Editar</a>
                    <br>
                    <br>
                </div>        
                
                <div class="visible-xs visible-sm col-md-12 col-lg-offset-1 col-lg-10">
                <br>
                <br>
                <a class='btn btn-Bixa' href="F_A_EditarVino.php?IdVino=<?php echo $idPlatilloEd;?>">Editar</a>
                <br>
                <br>
                <a href="F_A_RegistrarVino.php" class="btn btn-Bixa" >Registrar otra bebida</a>
                <br>
                <br>
                    <a class="btn btn-Regresar"  href="F_A_ConsultarVinos.php">
                        Ver listado de bebidas
                    </a>
                <br>
                    
                    <br>
                    <br>
                </div>        
            </form>            
        
        
    </body>
    
    <script>
        function doblePresentacion(){
                if ($("#txtDoble").val() == 1) {
                    $("#trCopa").removeClass("ocultar");
                    $("#trCopa").addClass("mostrarTableRow");
                    $("#trBotella").removeClass("ocultar");
                    $("#trBotella").addClass("mostrarTableRow");
                    $("#trPrecio").removeClass("mostrarTableRow");
                    $("#trPrecio").addClass("ocultar");
                    
                } else {
                    $("#trCopa").removeClass("mostrarTableRow");
                    $("#trCopa").addClass("ocultar");
                    $("#trBotella").removeClass("mostrarTableRow");
                    $("#trBotella").addClass("ocultar");
                    $("#trPrecio").removeClass("ocultar");
                    $("#trPrecio").addClass("mostrarTableRow");

                }
            }
            
            $(document).ready(function (){                               
               doblePresentacion();
            });
    </script>
</html>
