<?php
include_once './Header.php';
include_once './Clases/Empresa.php';
$objEmpresa = new Empresa();
$objEmpresa->ObtenerPorID(1);

?>
<title>Sellos digitales </title>
<?php        
        if(!empty($_SESSION['msjSelloDigital'])){
            
            echo "<script>swal('" . $_SESSION['titulo'] . "','" . $_SESSION['msjSelloDigital'][0] . "','" . $_SESSION['tipo'] . "');</script>";
            
            /*****Limpio variables de sesion****/
            $_SESSION['msjSelloDigital'] = null;
            unset($_SESSION['msjSelloDigital']);
            $_SESSION['titulo'] = null;
            unset($_SESSION['titulo']);
            $_SESSION['tipo'] = null;
            unset($_SESSION['tipo']);
            
        }
        

?>
    <body>
        <form action="Validaciones_Lado_Servidor/Validar_AgregarSelloDigital.php" method="POST" enctype="multipart/form-data" id='form'>
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Configuración de sello digital</label></center></h4></div>
            </td>
        </table>
        </div>   
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <table class="table-hover">
                        <tr>
                            <td><div class="etiquetas2">Archivo (.CER)</div></td>
                             <?php
                                if(!isset($_SESSION['archivoCer']) && (empty($_SESSION['archivoCer'])))
                                {
                                
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' id='archivoCer'  name='archivoCer'   class='filestyle' accept='.cer' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['archivoCer'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' id='archivoCer'  name='archivoCer'    class='filestyle' accept='.cer' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value=' $valor'></div></td>";
                                    $_SESSION['archivoCer']=null;
                                }
                            ?>
                        </tr>                        
                        
                        <tr>
                            <td><div class="etiquetas2">Archivo (.KEY)</div></td>
                            <?php
                                 if(!isset($_SESSION['archivoKey']) && (empty($_SESSION['archivoKey'])))
                                 {

                                     echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' id='archivoKey'  name='archivoKey'   class='filestyle' accept='.key' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value=''></div></td>";
                                 }
                                 else{
                                     $valor = $_SESSION['archivoKey'];
                                     echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' id='archivoKey'  name='archivoKey'    class='filestyle' accept='.key' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value='$valor'></div></td>";
                                     $_SESSION['archivoKey']=null;
                                 }
                             ?>
                        </tr>                        
                        
                        <tr>
                            <td><div class="etiquetas2">Contraseña</div></td>
                           
                            <?php
                            if(!isset($_SESSION['valContrasenaSello']) && (empty($_SESSION['valContrasenaSello'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='password' id='txtContrasenaSello'  name='txtContrasenaSello'    class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valContrasenaSello'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='password' id='txtContrasenaSello'  name='txtContrasenaSello'    class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valDescripcionCorta']=null;
                                }
                            ?>
                        </tr>                        
                        

                        
                         
                    </table>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
                    <table class="table-hover">
                        <tr>
                            <td colspan="4"><div class="campos"><input type="text" value="<?php //echo $objEmpresa->ArchivoCer;?>" name="certificadoCer" title="Ingresar Datos" class="form-control" readonly="readonly"></div></td>
                        </tr> 
                        <tr>
                            <td colspan="4"><div class="campos"><input type="text" value="<?php //echo $objEmpresa->ArchivoKey;?>" name="llaveKey" title="Ingresar Datos" class="form-control" readonly="readonly"></div></td>
                        </tr> 
                        <tr>
                            <td><div class="etiquetas2">Número de certificado</div></td>
                             <?php
                            if(!isset($_SESSION['valNumCertificado']) && (empty($_SESSION['valNumCertificado'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNumCertificado'  name='txtNumCertificado'    class='form-control' value=''></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valNumCertificado'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNumCertificado'  name='txtNumCertificado'    class='form-control' value='$valor'></div></td>";
                                    $_SESSION['valNumCertificado']=null;
                                }
                            ?>
                            </td>
                        </tr>
                        
                        
                    </table> 
                </div>
                
                
                        
            
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                    <br>
                <br>
                
                <button type="submit" id="btnAceptar" name="btnModificar" style="float: right" class="btn btn-Bixa btn-ms" >Guardar</button>
                
                <br>
               
                </div>
            </form>                
    </body>
    
    <script>
        $(document).ready(function (){
           
           
           
           $( "#form" ).validate( {
				rules: {
                                        archivoCer:{
                                            required: true
                                        },
                                        archivoKey:{
                                            required: true
                                        },
                                        txtContrasenaSello:{
                                            required: true,
                                        }
                                        
                                        
				},
				messages: {
                                    archivoCer:{
                                            required: "Seleccionar archivo .cer"
                                        },
                                    archivoKey:{
                                            required: "Seleccionar archivo .key"
                                        },
                                    txtContrasenaSello:{
                                        required: "Es necesario ingresar la contraseña"
                                    }
                                        
                                        
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".campos" ).addClass( "has-feedback" );

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
					$( element ).parents( ".campos" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".campos" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
           
           
        });
    </script>
</html>


