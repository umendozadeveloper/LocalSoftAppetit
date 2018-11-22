
          <?php
          require 'Header.php';
          ?>        
            <title>Correo prueba</title>

            <form action="Validaciones_Lado_Servidor/N_Prueba.php" method="POST" name="form" id="form">
            
            
       
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <br>
            <br>
            <button type="submit" style="float: right;" id="btnAceptar" name="btnMesa" class="btn btn-Bixa btn-ms" >Guardar</button>
<!--                <a href="F_A_ConsultarUbicacion.php" type="button" class="btn btn-Regresar btn-ms">
                        &larr; Ver listado de ubicaciones
                </a>-->
                <br>
                <br>
       </div>
            </form>            
            

<!--        <script>
            $( document ).ready( function () {
			$( "#form" ).validate( {
				rules: {
					txtClaveUbicacion: {
						required: true,
						
					},
					txtDescrUbicacion: {
						required: true,
						
					}
				},
				messages: {
					txtClaveUbicacion: {
						required: "Por favor capture la clave de la ubicación",
						
					},
					txtDescrUbicacion: {
						required: "Por favor capture el nombre de la ubicación",
						
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
            
        </script>-->
    </body>
</html>

