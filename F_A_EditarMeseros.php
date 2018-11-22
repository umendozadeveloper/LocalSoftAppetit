
          <?php
         
          require 'Header.php';
          
          
          ?>                
            <script>
        $(document).ready(function (){
             $("#cmbAnadirFoto").change(function (){
//                alert($(this).val());
                var tablaFoto = document.getElementById("tablaFoto");
                switch($(this).val()){
                    
            case "Si":
                    tablaFoto.className = "mostrar";
                    break;
                case "No":
                    tablaFoto.className = "ocultar";
                    break;
                    
            default:break;
                    
                }
             });
        });
    </script>
    
            <title>Editar Meseros</title>

        <?php
        require './Clases/Mesero.php';
        
                if(isset($_POST['btnMesero']) || isset($_GET['IdMesero'])){
                    if(isset($_POST['btnMesero'])&& $_POST['btnMesero'])
                    {
                        $ID = $_REQUEST['btnMesero'];
                    }
                    else
                    {
                        if(!empty($_SESSION['msjEditarMesero'])){       
                        echo "<script>swal('".$_SESSION['msjEditarMesero'][0]."');</script>";
                        $_SESSION['msjEditarMesero']="";
                            }
                        $ID = $_GET['IdMesero'];
                    }
                            $objMesero = new Mesero();
                            $objMesero->ConsultarPorID($ID); 
                                
                }
                else {
                    header("Location: F_A_ConsultarMeseros.php");
                }

            ?>
        
            <form action="Validaciones_Lado_Servidor/Validar_EditarMesero.php" method="POST" enctype="multipart/form-data" id="form">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar datos del mesero:  <?php echo $objMesero->Nombre?></label></center></h4></div>
            </td>
        </table>        
                </div>
                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <div class="FotoMesero"><img src="<?php echo $objMesero->Foto;?>" class="img-rounded img-responsive img-responsive-static"></div>
                    </div>
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12  col-lg-5">
                    <table class="table-hover">    
                        <tr>
                            <td><div class="etiquetas2">Nombre de usuario</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombreUsuario" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->Usuario;?>"></div></td>
                        </tr>                        
                        
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $objMesero->ID;?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Nombre</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombre" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->Nombre;?>"></div></td>
                        
                        </tr>                        
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Apellidos</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtApellidos" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->Apellidos;?>"></div></td>
                        </tr>                        
                        <tr>
                            
                        </tr>
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Dirección</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtDireccion" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->Direccion;?>"></div></td>
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Teléfono</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtTelefono" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->Telefono;?>"></div></td>
                        </tr> 
                    </table>
                    </div>
                
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                            <table class="table-hover">    
                        <tr>
                            <td><div class="etiquetas2">E-mail</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtCorreo" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->CorreoElectronico;?>"></div></td>
                            
                        </tr>                        
                        
                        <tr>
                            <td><div class="etiquetas2">Contraseña</div></td>
                            <td colspan="4"><div class="campos"><input type="password" id="txtContrasena" name="txtContrasena" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->Contrasena;?>"></div></td>
                        </tr>                        
                        
                        <tr>
                            <td><div class="etiquetas2">Repetir Contraseña</div></td>
                            <td colspan="4"><div class="campos"><input type="password" id="txtReContrasena" name="txtReContrasena" required title="Ingresar Datos" class="form-control" value="<?php echo $objMesero->Contrasena;?>"></div></td>
                        </tr>                        
                        
                        <tr>
                            <td ><div class="etiquetas2">Observaciones</div></td>
                        <?php
                            
                            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='4' id='txtObservaciones' name='txtObservaciones'>$objMesero->Observaciones</textarea></div></td>";
                        ?>
                        </tr>
                        <tr>
                            <td><div class="etiquetas2">Estatus</div></td>
                            <td colspan="4"><div class="campos"><select id="cmbEstatus" name="cmbEstatus"  class="form-control" onchange="">
                           <?php 
                                if($objMesero->Estatus == true)
                                {
                                   echo "<option value='0'>Inactivo</option>"; 
                                   echo "<option value='1' selected>Activo</option>"; 
                                }
                                else{
                                   echo "<option value='0' selected>Inactivo</option>"; 
                                   echo "<option value='1'>Activo</option>"; 
                                }
                           ?>
                            </select>
                            </div></td>
                        </tr>
                        
                        
                        
                        <tr>
                                <td><div class="etiquetas2">¿Modificar fotografía?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirFoto" name="cmbFoto"  class="form-control" onchange="">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
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
                    <input type="submit" value="Guardar" class="btn btn-Bixa" name="btnModificar" style="float: right;">
                    <a class="btn btn-Regresar"  href="F_A_ConsultarMeseros.php">
                         &larr; Ver listado de meseros
                    </a>
                    
                    
                    <br>
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
                                        
                                        txtDireccion:{
                                            required: true
                                        },
                                        
                                        txtTelefono:{
                                            required: true,
                                            digits:true
                                        },
                                        
                                        txtCorreo:{
                                            required: true,
                                            email:true
                                            
                                        },
                                        archivo:{
                                            required: true
                                        }
                                        
                                        
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
                                        
                                        txtDireccion:{
                                            required: "Ingresar dirección"
                                        },
                                        
                                        txtTelefono:{
                                            required: "Ingresar número telefónico",
                                            digits:"Ingresar números"
                                        },
                                        
                                        txtCorreo:{
                                            required: "Ingresar dirección de correo",
                                            email:"Ingresar una dirección de correo válida"
                                            
                                        },
                                        archivo:{
                                            required: "Seleccionar archivo"
                                        }
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
