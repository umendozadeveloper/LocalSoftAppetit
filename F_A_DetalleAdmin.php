
          <?php
         
          require 'Header.php';
          
          
          ?>                
            
            <title>Editar administrador</title>

        <?php
        require './Clases/Usuario.php';
        
                if( isset($_GET['Id_Admin'])){
                        $ID = $_GET['Id_Admin'];
                    
                            $objAdmin = new Usuario();
                            $objAdmin->ConsultarPorID($ID); 
                }
                else {
                    header("Location: F_A_ConsultarAdmin.php");
                }

            ?>
        
            <form action="Validaciones_Lado_Servidor/N_EditarAdmin.php" method="POST" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla"></label></center></h4></div>
            </td>
        </table>        
                </div>
                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <div class="FotoMesero"><img src="<?php echo $objAdmin->Foto;?>" class="img-rounded img-responsive img-responsive-static"></div>
                    <div class="etiquetas2">Observaciones</div></td>
                    <?php
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea disabled class='claseTextArea' rows='4' id='txtObservaciones' name='txtObservaciones'>". $objAdmin->Observaciones ."</textarea></div></td>";
                     ?>
                      
                    </div>
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12  col-lg-5">
                    <table class="table-hover">    
                        <tr>
                            <td><div class="etiquetas2">Nombre de usuario</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombreUsuario" required title="Ingresar Datos" readonly="" class="form-control" value="<?php echo $objAdmin->Usuario;?>"></div></td>
                        </tr>                        
                        
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $objAdmin->Id;?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Nombre</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombre" required title="Ingresar Datos" readonly="" class="form-control" value="<?php echo $objAdmin->Nombre;?>"></div></td>
                        
                        </tr>                        
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Apellidos</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtApellidos" readonly="" class="form-control" value="<?php echo $objAdmin->Apellidos;?>"></div></td>
                        </tr>                        
                        <tr>
                            
                        </tr>
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Dirección</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtDireccion" readonly="" required title="Ingresar Datos" class="form-control" value="<?php echo $objAdmin->Direccion;?>"></div></td>
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Teléfono</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtTelefono" readonly="" class="form-control" value="<?php echo $objAdmin->Telefono;?>"></div></td>
                        </tr> 
                        
                        
                        <tr>
                            <td><div class="etiquetas2">E-mail</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtCorreo"  readonly="" required title="Ingresar Datos" class="form-control" value="<?php echo $objAdmin->Correo;?>"></div></td>
                            
                        </tr>
                        <tr>
                            <td><div class="etiquetas2">Estatus</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtCorreo"  readonly="" required title="Ingresar Datos" class="form-control" value="<?php if($objAdmin->Estatus == 0){echo "Inactivo";}else {echo "Activo";} ?>"></div></td>
                            
                        </tr>
                        <tr>
                            <td><div class="etiquetas2">Añadir cuenta a mesero</div></td>
                            <td colspan="4"><div class="campos"><select id="cmbPrivilegiosM" name="cmbPrivilegiosM" class="input-group form-control" disabled=""><option value="<?php echo $objAdmin->PrivilegiosMesero; ?>"><?php if($objAdmin->PrivilegiosMesero==0 || is_null($objAdmin->PrivilegiosMesero)){echo "No";}else{echo "Sí";} ?></option></select></div></td>
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
                    <a href="F_A_RegistrarAdministrador.php"  class="btn btn-Bixa" name="btnModificar" style="float: right;">Registrar otro administrador</a>
                    
                    <a class="btn btn-Regresar"  href="F_A_ConsultarAdmin.php">
                      &larr;  Ver listado de administradores
                    </a>
                    
                    <a class="btn btn-Bixa" href="F_A_EditarAdmin.php?Id_Admin=<?php echo $ID;?>">Editar</a>
                    
                    </div>
                    
                    
                    <div class="visible-xs">
                        <a class="btn btn-Bixa" href="F_A_EditarAdmin.php?Id_Admin=<?php echo $ID;?>">Editar</a>    
                    
                    <br>
                    <br>
                    <a href="F_A_RegistrarAdministrador.php"  class="btn btn-Bixa" name="btnModificar" >Registrar otro administrador</a>
                    <br>
                    <br>
                    <a class="btn btn-Regresar"  href="F_A_ConsultarAdmin.php">
                      &larr;  Ver listado de administradores
                    </a>    
                    </div>
                    
                    
                    <br>
                    <br>
                </div>
            </form>            
        
            
        
            
    
    </body>
    
</html>
