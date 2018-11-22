
          <?php
         
          require 'Header.php';
          
          
          ?>                
            
            <title>Editar meseros</title>

        <?php
        require './Clases/Mesero.php';
        
                if( isset($_GET['IdMesero'])){
                        $ID = $_GET['IdMesero'];
                    
                            $objMesero = new Mesero();
                            $objMesero->ConsultarPorID($ID); 
                }
                else {
                    header("Location: F_A_ConsultarMeseros.php");
                }

            ?>
        
    <form action="Validaciones_Lado_Servidor/Validar_EditarMesero.php" method="POST" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Mesero registrado:  <?php echo $objMesero->Nombre?></label></center></h4></div>
            </td>
        </table>        
                </div>
                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <div class="FotoMesero"><img src="<?php echo $objMesero->Foto;?>" class="img-rounded img-responsive img-responsive-static"></div>
                    <div class="etiquetas2">Observaciones</div></td>
                    <?php
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea disabled class='claseTextArea' rows='4' id='txtObservaciones' name='txtObservaciones'>". $objMesero->Observaciones ."</textarea></div></td>";
                     ?>
                        </tr>
                    </div>
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12  col-lg-5">
                    <table class="table-hover">    
                        <tr>
                            <td><div class="etiquetas2">Nombre de usuario</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombreUsuario" required title="Ingresar Datos" readonly="" class="form-control" value="<?php echo $objMesero->Usuario;?>"></div></td>
                        </tr>                        
                        
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $objMesero->ID;?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Nombre</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombre" required title="Ingresar Datos" readonly="" class="form-control" value="<?php echo $objMesero->Nombre;?>"></div></td>
                        
                        </tr>                        
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Apellidos</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtApellidos" readonly="" class="form-control" value="<?php echo $objMesero->Apellidos;?>"></div></td>
                        </tr>                        
                        <tr>
                            
                        </tr>
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Dirección</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtDireccion" readonly="" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->Direccion;?>"></div></td>
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Teléfono</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtTelefono" readonly="" class="form-control" value="<?php echo $objMesero->Telefono;?>"></div></td>
                        </tr> 
                        
                        
                        <tr>
                            <td><div class="etiquetas2">E-mail</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtCorreo"  readonly="" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->CorreoElectronico;?>"></div></td>
                            
                        </tr>  
                         <tr>
                            <td><div class="etiquetas2">Estatus</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtCorreo"  readonly="" required title="Ingresar Datos" class="form-control" value="<?php if($objMesero->Estatus == 0){echo "Inactivo";}else{echo "Activo";} ?>"></div></td>
                            
                        </tr>
                    </table>
                    </div>
                
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                            <table class="table-hover">    
                        
                        
            </table>
            
                    
                    <div id="tablaFoto" class="ocultar">                    
                    <table class="table-hover">

                            <tr>
                            <td><div class="etiquetas2">Fotografía</div></td>
                            <td colspan="4"><div class="campos"><input type="file"  name="archivo" class="form-control"></div></td>
                            </tr>                
                                   
                                </table>
                            </div>
                    <br><br>
                    
                    <div class="visible-lg visible-md visible-sm ">
                    <a href="F_A_RegistrarMesero.php"  class="btn btn-Bixa" name="btnModificar" style="float: right;">Registrar otro mesero</a>
                    
                    <a class="btn btn-Regresar"  href="F_A_ConsultarMeseros.php">
                      &larr;  Ver listado de meseros
                    </a>
                    
                <?php 
                       
                        if($objMesero->IdAdmin=='-9999' || $objMesero->IdAdmin==NULL)
                        {
                            echo '<a class="btn btn-Bixa" href="F_A_EditarMeseros.php?IdMesero='.$ID.'">Editar</a>';                           
                        }
                        else{
                           
                           echo '<a class="btn btn-Bixa" href="F_A_EditarMeseros.php?IdMesero='.$ID.'" disabled onclick="return false">Editar</a>'; 
                        }
                      
                    ?>
                    
                    </div>

                    
                    
                    <br>
                    <br>
                </div>
            </form>            
        
            
        
            
    
    </body>
    
</html>
