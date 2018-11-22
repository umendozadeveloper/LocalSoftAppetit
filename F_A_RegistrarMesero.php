         <?php
          require 'Header.php';
          ?>                
            <title>Registrar Mesero</title>
    
    

        
        
        
        <?php

if(!empty($_SESSION['msjRegistrarMesero'])) {
            echo "<script>swal('" . $_SESSION['titulo'] . "','" . $_SESSION['msjRegistrarMesero'][0] . "','" . $_SESSION['tipo'] . "');</script>";
            
            /*****Limpio variables de sesion****/
            $_SESSION['msjRegistrarMesero'] = null;
            unset($_SESSION['msjRegistrarMesero']);
            $_SESSION['titulo'] = null;
            unset($_SESSION['titulo']);
            $_SESSION['tipo'] = null;
            unset($_SESSION['tipo']);
        }
        ?>
        

        <form action="Validaciones_Lado_Servidor/Validar_AgregarMesero.php" method="POST"  enctype="multipart/form-data" id='form'>
                
                    <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                        <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Registrar mesero</label></center></h4></div>
                            </td>
                        </table>
                    </div>
                        
                        
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-1 col-lg-5">
                        
                        <table>
                        <tr>
                            <td width="20%"><div class="etiquetas2">Nombre de usuario</div></td>
                
                                
                                <?php
                                if(!isset($_SESSION['valUsuario']) && (empty($_SESSION['valUsuario'])))
                                {
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtUsuario'  name='txtUsuario'   class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valUsuario'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtUsuario'  name='txtUsuario'  class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valUsuario']=null;
                                }
                                ?>
                        </tr>                        
                        
                        <tr>
                            <td ><div class="etiquetas2">Contraseña</div></td>
                <?php
                            if(!isset($_SESSION['valContrasena']) && (empty($_SESSION['valContrasena'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='password' id='txtContrasena' name='txtContrasena'   class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valContrasena'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='password' id='txtContrasena' name='txtContrasena'  class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valContrasena']=null;
                                }
                            ?>
                        </tr>
                        
                        <tr>
                            <td ><div class="etiquetas2">Repetir contraseña</div></td>
                <?php
                            if(!isset($_SESSION['valContrasena']) && (empty($_SESSION['valContrasena'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='password' id='txtReContrasena'  name='txtReContrasena'     class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valContrasena'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='password' id='txtReContrasena'  name='txtReContrasena'     class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valContrasena']=null;
                                }
                            ?>
                        </tr>
                        
                        <tr>
                            
                            <td ><div class="etiquetas2">Nombre</div></td>
                <?php
                            if(!isset($_SESSION['valNombre']) && (empty($_SESSION['valNombre'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNombre'  name='txtNombre'     class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valNombre'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNombre'  name='txtNombre'     class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valNombre']=null;
                                }
                            ?>
                        </tr>
                        
                        <tr>
                            <td ><div class="etiquetas2">Apellidos</div></td>
                <?php
                            if(!isset($_SESSION['valApellidos']) && (empty($_SESSION['valApellidos'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtApellidos'  name='txtApellidos'     class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valApellidos'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtApellidos'  name='txtApellidos'     class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valApellidos']=null;
                                }
                            ?>
                        </tr>
                        <tr>
                            <td width="20%"><div class="etiquetas2">Dirección</div></td>
                <?php
                            if(!isset($_SESSION['valDireccion']) && (empty($_SESSION['valDireccion'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDireccion'  name='txtDireccion'     class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valDireccion'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDireccion'  name='txtDireccion'     class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valDireccion']=null;
                                }
                            ?>
                        </tr>
                        
                        </table>
                        </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-6  col-lg-5">
                        <table>
                        
                        
                        <tr>
                            <td ><div class="etiquetas2">Teléfono</div></td>
                        <?php
                            if(!isset($_SESSION['valTelefono']) && (empty($_SESSION['valTelefono'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtTelefono'  name='txtTelefono'     class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valTelefono'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtTelefono'  name='txtTelefono'     class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valTelefono']=null;
                                }
                            ?>
                        </tr>
                        
                        
                                <tr>
                            <td ><div class="etiquetas2">Correo</div></td>
                        <?php
                            if(!isset($_SESSION['valCorreo']) && (empty($_SESSION['valCorreo'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtCorreo'  name='txtCorreo'     class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valCorreo'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtCorreo'  name='txtCorreo'     class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valCorreo']=null;
                                }
                            ?>
                        </tr>
                        
                        
                        <tr>
                            <td ><div class="etiquetas2">Subir foto</div></td>
                        <?php
                            if(!isset($_SESSION['valFoto']) && (empty($_SESSION['valFoto'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' id='archivo'  name='archivo'  value=''></div></td>";
                                ?>
                            
                            <?php
                                }
                                else{
                                    $valor = $_SESSION['valFoto'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo'  id='archivo'  name='archivo'  value='$valor'></div></td>";
                                    $_SESSION['valFoto']=null;
                                }
                            ?>
                        </tr>
                        
                        <tr>
                            <td ><div class="etiquetas2">Observaciones</div></td>
                        <?php
                            if(!isset($_SESSION['valObservac']) && (empty($_SESSION['valObservac'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='4' id='txtObservaciones' name='txtObservaciones'></textarea></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valObservac'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='4' id='txtObservaciones' name='txtObservaciones'>$valor</textarea></div></td>";
                                    $_SESSION['valObservac']=null;
                                }
                            ?>
                        </tr>
                        <tr>
                            <td width="20%"><div class="etiquetas2">Estatus</div></td>
                            <td><select name="cmbEstatus" id="cmbEstatus" class="input-group form-control">
                            <?php
                                if(!isset($_SESSION['valEstatus']) && (empty($_SESSION['valEstatus'])))
                                {
                                   
                                   echo '<option value="1">Activo</option>';
                                   echo '<option value="0">Inactivo</option>';
                                }
                                else{
                                   $valor = $_SESSION['valEstatus'];
                                   if($valor = '0')
                                   {
                                       echo '<option value="0" selected>Inactivo</option>';
                                       echo '<option value="1">Activo</option>';
                                   }
                                   else{
                                       echo '<option value="0">Inactivo</option>';
                                       echo '<option value="1" selected>Activo</option>';
                                   }
                                   $_SESSION['valEstatus'] = null;
                                }
                            ?>
                                
                           </select></td>
                        </tr> 
                        
            </table>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                    
                    <br>
                    <button type="submit" id="btnAceptar" name="btnMesa" style="float: right;" class="btn btn-Bixa btn-ms">Guardar</button>
                    <a href='F_A_ConsultarMeseros.php' type="button" class="btn btn-Regresar btn-ms">
                    &larr; Ver listado de meseros
                </a>
                    <br><br>
                    <br>
                    
                    </div>
                    
                
            </form>            
        
        

             
            
        <script>
            $(document).ready(function(){
        $( "#form" ).validate( {
				rules: {
					txtUsuario: {
						required: true,
						minlength: 2
                                                
					},
					txtContrasena: {
						required: true,
						minlength: 8,
                                                
					},
                                        
                                        txtReContrasena: {
						required: true,
						minlength: 8,
                                                equalTo: "#txtContrasena"
					},
                                        
                                        txtNombre:{
                                            required: true
                                        },
                                        
                                        txtApellidos:{
                                            required: true
                                        },
                                        
                                        
                                        
                                        
				},
				messages: {
						txtUsuario: {
						required: "Ingrese el nombre de usuario",
						minlength: "Al menos debe tener dos caracteres"
                                                
					},
					txtContrasena: {
						required: "Ingresar contraseña",
						minlength: "Al menos ocho caracteres",
                                                
                                                
					},
                                        txtReContrasena: {
						required: "Ingresar contraseña",
						minlength: "Al menos ocho caracteres",
                                                equalTo: "Las contraseñas no coinciden"
                                                
					},
                                        txtNombre:{
                                            required: "Ingresar nombre"
                                        },
                                        
                                        txtApellidos:{
                                            required: "Ingresar apellidos"
                                        },
                                        
                                        
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-12" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-12" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-12" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );

            });
            
        </script>
        	    
    </body>
</html>
