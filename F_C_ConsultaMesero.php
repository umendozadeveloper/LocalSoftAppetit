          <?php
          require 'Header.php'
          ?>                
            
    
            <title>Datos Mesero</title>

        <?php
        require './Clases/Mesero.php';
                            $objMesero = new Mesero();
                            $resultado = $objMesero->ConsultarPorIDComanda($seguridad->CurrentUserID()); 
                                foreach($resultado as $mesero){}
                

            ?>
        
    
            
        
            
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
                </div>
                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <div class="FotoMesero"><img src="<?php echo $mesero->Foto;?>" class="img-rounded img-responsive img-responsive-static"></div>
                    </div>
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12  col-lg-5">
                    <table class="table-hover">    
                        
                        
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $mesero->ID;?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Nombre</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly=""  name="txtNombre" required title="Ingresar Datos" class="form-control" value="<?php echo $mesero->Nombre;?>"></div></td>
                        
                        </tr>                        
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Apellidos</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly="" name="txtApellidos" required title="Ingresar Datos" class="form-control" value="<?php echo $mesero->Apellidos;?>"></div></td>
                        </tr>                        
                        <tr>
                            
                        </tr>
                        
                        
                        <!--
                        <tr>
                            <td><div class="etiquetas2">Dirección</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtDireccion" required title="Ingresar Datos" class="form-control" value="<?php echo $mesero->Calle;?>"></div></td>
                        </tr>                        
                        -->
                        
                        
                        <tr>
                            <td><div class="etiquetas2">E-mail</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly="" name="txtCorreo" required title="Ingresar Datos" class="form-control" value="<?php echo $mesero->CorreoElectronico;?>"></div></td>
                            
                        </tr>                        
                    </table>
                    </div>
                
                        
                
            
<?php
        require_once './_banner.php';
        ?>        
    
    </body>
    
</html>
