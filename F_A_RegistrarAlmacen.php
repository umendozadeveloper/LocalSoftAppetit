          <?php
          require 'Header.php';
          ?>        
            <title>Registrar Almacén</title>

        <form action="Validaciones_Lado_Servidor/Validar_AgregarAlmacen.php" method="POST" name="form" id="form">
            
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Registrar almacén</label></center></h4></div>
            </td>
        </table>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">
                <tr>                                             
                <td><div class="etiquetas2">Clave</div></td>
                <?php
                            if(!isset($_SESSION['valClaveAlmacen']) && (empty($_SESSION['valClaveAlmacen'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveAlmacen'  name='txtClaveAlmacen'  title='Ingresar Datos' class='form-control' value=''></div></td>";
                                }
                                else{
                                    $mesa = $_SESSION['valClaveAlmacen'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtClaveAlmacen'  name='txtClaveAlmacen'  title='Ingresar Datos' class='form-control' value='$mesa'></div></td>";
                                    $_SESSION['valClaveAlmacen']=null;
                                }
                            ?>
            </tr>

            <tr>                                             
                <td><div class="etiquetas2">Descripción</div></td>
                <?php
                            if(!isset($_SESSION['valDescrAlmacen']) && (empty($_SESSION['valDescrAlmacen'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDescrAlmacen' name='txtDescrAlmacen'  title='Ingresar Datos' class='form-control' value=''></div></td>";
                                }
                                else{
                                    $cantidad = $_SESSION['valDescrAlmacen'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text'  id='txtDescrAlmacen'  name='txtDescrAlmacen'  title='Ingresar Datos' class='form-control' value='$cantidad'></div></td>";
                                    $_SESSION['valDescrAlmacen']=null;
                                }
                            ?>
            </tr> 
            </table>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover">
                 <tr>
                            <td ><div class="etiquetas2">Observaciones</div></td>
                        <?php
                            if(!isset($_SESSION['valObservac']) && (empty($_SESSION['valObservac'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'></textarea></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valObservac'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='2' id='txtObservaciones' name='txtObservaciones'>$valor</textarea></div></td>";
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
            <br>
            <button type="submit" style="float: right;" id="btnAceptar" name="btnMesa" class="btn btn-Bixa btn-ms" >Guardar</button>
                <a href="F_A_ConsultarAlmacen.php" type="button" class="btn btn-Regresar btn-ms">
                        &larr; Ver listado de almacenes
                </a>
                <br>
                <br>
       </div>
            
            

            </form>            
            

        <script>
            $( document ).ready( function () {
			$( "#form" ).validate( {
				rules: {
					txtClaveAlmacen: {
						required: true,
						
					},
					txtDescrAlmacen: {
						required: true,
						
					}
				},
				messages: {
					txtClaveAlmacen: {
						required: "Por favor capture la clave del clasificador",
						
					},
					txtDescrAlmacen: {
						required: "Por favor capture el nombre del clasificador",
						
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
		} );
            
        </script>
    </body>
</html>

