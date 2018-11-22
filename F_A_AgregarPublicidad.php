<?php
require_once 'Header.php';
ShowMessage();
?>

<form action="Validaciones_Lado_Servidor/N_AgregarPublicidad.php" method="POST"  enctype="multipart/form-data" id='form'>
                
                    <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                        <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Registrar imagenes para publicidad</label></center></h4></div>
                            </td>
                        </table>
                    </div>
                        
                        
                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-offset-2 col-lg-8">
                        
                        <table>
                        <tr>
                            <td width="20%"><div class="etiquetas2">Nombre de imagen</div></td>
                
                                
                                <?php
                                if(!isset($_SESSION['valtxtNombreImagen']) && (empty($_SESSION['valtxtNombreImagen'])))
                                {
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNombreImagen'  name='txtNombreImagen'   class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valtxtNombreImagen'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNombreImagen'  name='txtNombreImagen'  class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valtxtNombreImagen']=null;
                                }
                                ?>
                        </tr>                        
                        
                        <tr>
                        
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
                        
                        
                        
            </table>
                    
                    <br><br>    
                        <button type="submit" style="float: right;" id="btnAceptar" name="btnMesa" class="btn btn-Bixa btn-ms">Guardar</button>
                        <a href='F_A_Publicidad.php' type="button" class="btn btn-Regresar btn-ms" >
                         &larr; Consultar publicidad
                    </a>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                    
                    <br>
                    
                    <br>
                    
                    </div>
                    
                
            </form>            

<script>
    $(document).ready(function (){
       $( "#form" ).validate( {
				rules: {
					txtNombreImagen: {
						required: true
					},
					
                                        archivo:{
                                            required: true
                                        }

				},
				messages: {
                                        txtNombreImagen: {
						required: "Introducir nombre a la imagen a cargar"
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
			}); 
    });
</script>

</body>
</html>