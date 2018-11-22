<?php
  require 'Header.php';
  include_once './Clases/Platillo.php';
  include_once './Clases/Vino.php';
  include_once './Clases/Clasificador.php';
  include_once './Clases/UnidadMedidaInsumos.php';
  include_once './Clases/UMContent.php';
  include_once './Clases/Ubicacion.php';
?>
            
            
            <title>Registrar Insumo</title>
    

<?php        
//if(!empty($_SESSION['msjRegistrarPlatillo'])){
//
//    echo "<script>swal('" . $_SESSION['titulo'] . "','" . $_SESSION['msjRegistrarPlatillo'][0] . "','" . $_SESSION['tipo'] . "');</script>";
//
//    /*****Limpio variables de sesion****/
//    $_SESSION['msjRegistrarPlatillo'] = null;
//    unset($_SESSION['msjRegistrarPlatillo']);
//    $_SESSION['titulo'] = null;
//    unset($_SESSION['titulo']);
//    $_SESSION['tipo'] = null;
//    unset($_SESSION['tipo']);
//
//}
?>
            <form action="Validaciones_Lado_Servidor/Validar_AgregarInsumo.php" method="POST" enctype="multipart/form-data" id="form">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <table class="encabezadoTabla" >
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Registrar insumo</label></center></h4></div>
            </td>
        </table>
    </div>
                            
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
    <table border='0'>
      
    <tr>
        <td colspan="1"><div class="etiquetas2">Descripción</div></td>


            <?php
            if(!isset($_SESSION['valDescripcion']) && (empty($_SESSION['valDescripcion'])))
            {
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='1' id='txtDescripcion' name='txtDescripcion'></textarea></div></td>";
            }
            else{
                $valor = $_SESSION['valDescripcion'];
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='1' id='txtDescripcion' name='txtDescripcion'>$valor</textarea></div></td>";
                $_SESSION['valDescripcion']=null;
            }
            ?>
    </tr>   
    <tr>
        <td width="20%"><div class="etiquetas2">Presentación</div></td>
         <?php
        if(!isset($_SESSION['valPresentacion']) && (empty($_SESSION['valPresentacion'])))
        {
            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtPresentacion'  name='txtPresentacion'    class='form-control' value=''></div></td>";
        }
        else{
            $valor = $_SESSION['valPresentacion'];
            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtPresentacion'  name='txtPresentacion'    class='form-control' value='$valor'></div></td>";
            $_SESSION['valPresentacion']=null;
        }
        ?>   
            
    </tr> 
    
    <tr>
      <td width="20%"><div class="etiquetas2">Unidad de medida</div></td>
      <td><div class='campos'><select id="cmbUnidadMedida" class="form-control" name="cmbUnidadMedida">
            <?php
                $objUnidad = new UnidadMedidaInsumo();
                $unidades = $objUnidad->ConsultarTodo();
                foreach ($unidades as $u) {
                if (isset($_SESSION['valId_Unidad']) && !empty($_SESSION['valId_Unidad'])) {
                    $dato = $_SESSION['valId_Unidad'];
                    if ($u->ID == $dato) {
                        echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                    } else {
                        echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                    }
                } else {
                    
                    echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                    
                }
            }
            $_SESSION['valId_Unidad'] = null;
            ?>
              </select>
          </div>
    </tr>
    <tr><td><div class="etiquetas2">Contenido</div></td><td><div class="etiquetas2">Unidad</div></td></tr>
    <tr>        
            <?php
        if(!isset($_SESSION['valContenido']) && (empty($_SESSION['valContenido'])))
        {
            echo "<td style='width:40%;'><input type='text' id='txtContenido'  name='txtContenido'  class='form-control' value=''></td>";
        }
        else{
            $valor = $_SESSION['valContenido'];
            echo "<td style='width:40%;'><input type='text' id='txtContenido'  name='txtContenido'    class='form-control' value='$valor'></td>";
            $_SESSION['valContenido']=null;
        }
        ?>   
        <td style="width:60%;"><select class='form-control' name="cmbUMContenido" id="cmbUMContenido">
            <?php
                $objUMC = new UMContent();
                $UMC = $objUMC->ConsultarTodo();
                foreach ($UMC as $u) {
                    if (isset($_SESSION['valUMContent']) && !empty($_SESSION['valUMContent'])) {
                        $dato = $_SESSION['valUMContent'];
                        if ($u->ID == $dato) {
                            echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                        } else {
                            echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                        }
                    } else {

                        echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                        
                    }
                }
                $_SESSION['valUMContent'] = null;
            ?>
                    </select></td>
                    
    </tr>
        <tr>
        <td ><div class="etiquetas2">Clasificador</div></td>
        <td><div class='campos'><select id="cmbClasificacion" class="form-control" name="cmbClasificacion">
                    
        <?php
            $objClasificador = new Clasificador();
            $clasificadores = $objClasificador->ConsultarTodo();
            foreach ($clasificadores as $clasif) {
                if (isset($_SESSION['valId_Clasif']) && !empty($_SESSION['valId_Clasif'])) {
                    $dato = $_SESSION['valId_Clasif'];
                    if ($clasif->ID == $dato) {
                        echo "<option value ='" . $clasif->ID . "' selected>" . $clasif->Descripcion . "</option>";
                    } else {
                        echo "<option value ='" . $clasif->ID . "'>" . $clasif->Descripcion . "</option>";
                    }
                } else {
                    
                    echo "<option value ='" . $clasif->ID . "'>" . $clasif->Descripcion . "</option>";
                   
                }
            }
            $_SESSION['valId_Clasif'] = null;
        ?>     
    </tr>      
    </table>


</div>
                    
                    
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
    <table>
                           
                     

         <tr>
            <td ><div class="etiquetas2">Stock mínimo</div></td>
            <?php
            if(!isset($_SESSION['valMinimo']) && (empty($_SESSION['valMinimo'])))
            {
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtMinimo'  name='txtMinimo'    class='form-control' value=''></div></td>";
            }
            else{
                $valor = $_SESSION['valMinimo'];
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtMinimo'  name='txtMinimo'    class='form-control' value='$valor'></div></td>";
                $_SESSION['valMinimo']=null;
            }
            ?>
        </tr>
       <tr>
        <td ><div class="etiquetas2">Stock máximo</div></td>
        <?php
        if(!isset($_SESSION['valMaximo']) && (empty($_SESSION['valMaximo'])))
        {
            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtMaximo'  name='txtMaximo'    class='form-control' value=''></div></td>";
        }
        else{
            $valor = $_SESSION['valMaximo'];
            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtMaximo'  name='txtMaximo'    class='form-control' value='$valor'></div></td>";
            $_SESSION['valMaximo']=null;
        }
        ?>
    </tr>              
            
        
    <tr>
        <td><div class="etiquetas2">Ubicación</div></td>
        <td><div class='campos'><select id="cmbUbicacion" class="form-control" name="cmbUbicacion">
        <?php
            $objUbicacion = new Ubicacion();
            $ubicaciones = $objUbicacion->ConsultarTodo();
            foreach ($ubicaciones as $e) {
                if (isset($_SESSION['valId_Ubicacion']) && !empty($_SESSION['valId_Ubicacion'])) {
                    $dato = $_SESSION['valId_Ubicacion'];
                    if ($e->ID == $dato) {
                        echo "<option value ='" . $e->ID . "' selected>" . $e->Descripcion . "</option>";
                    } else {
                        echo "<option value ='" . $e->ID . "'>" . $e->Descripcion . "</option>";
                    }
                } else {
                    
                        echo "<option value ='" . $e->ID . "'>" . $e->Descripcion . "</option>";
                        
                    
                }
            }
            $_SESSION['valId_Ubicacion'] = null;
        ?>     
    </tr>  
     <tr>
        <td ><div class="etiquetas2">Observaciones</div></td>
    <?php
        if(!isset($_SESSION['valObservac']) && (empty($_SESSION['valObservac'])))
            {

            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='3' id='txtObservaciones' name='txtObservaciones'></textarea></div></td>";
            }
            else{
                $valor = $_SESSION['valObservac'];
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='3' id='txtObservaciones' name='txtObservaciones'>$valor</textarea></div></td>";
                $_SESSION['valObservac']=null;
            }
        ?>
    </tr>
    <tr>
        <td><div class="etiquetas2">Estatus</div></td>
        <td><div class='campos'><select id="cmbEstatus" class="form-control" name="cmbEstatus">
        <?php
            if (isset($_SESSION['valStatus']) && !empty($_SESSION['valStatus'])) {
                if ($_SESSION['valStatus']=='0')
                {
                    echo "<option value='1'>Activo</option>
                          <option value='0' selected>Inactivo</option>";
                }else{
                    echo "<option value='1' selected>Activo</option>
                          <option value='0'>Inactivo</option>";
                }
            }
            else{
                 echo "<option value='1'>Activo</option>
                          <option value='0'>Inactivo</option>";
                 $_SESSION['valSatatus']=null;
            }
        ?>
                    
        </select>
        </div></td>
        
    </tr>                    
              

    </table>
</div>
         
      
                    
                    

                
               
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                    
                    <br>
                    
                    <button type="submit" id="btnAceptar" style="float: right" name="btnMesa" class="btn btn-Bixa btn-ms">Guardar</button>
                    <a class="btn btn-Regresar"  href="F_A_Consultar_Insumos.php">
                        &larr; Ver listado de insumos
                    </a>
                    <br>
                    <br>
                    
                    
                    </div>
                    
            </form>            
        
    </body>
    <script>
    $(document).ready(function(){
    
    $("#cmbPertenecePlatillos").change(function (){
        if($(this).val()==1){
            $("#tablaPertenecePlatillos").removeClass("ocultar");
            $("#tablaPertenecePlatillos").addClass("mostrar");
        }
        else{
            $("#tablaPertenecePlatillos").removeClass("mostrar");
            $("#tablaPertenecePlatillos").addClass("ocultar");
        }
    });
    
    
    $("#cmbPerteneceBebidas").change(function (){
        
        if($(this).val()==1){
            $("#tablaPerteneceBebidas").removeClass("ocultar");
            $("#tablaPerteneceBebidas").addClass("mostrar");
        }
        else{
            $("#tablaPerteneceBebidas").removeClass("mostrar");
            $("#tablaPerteneceBebidas").addClass("ocultar");
        }
    });
    
//    $("#cmbUnidadMedida").change(function (){
//        var seleccionado = $("#cmbUnidadMedida option:selected").val();
////        alert(seleccionado);
//        if(seleccionado == 1)
//        {
//            $("#tablaContenido").removeClass("ocultar");
//            $("#tablaContenido").addClass("mostrar");
//        }else{
//           $("#tablaContenido").removeClass("mostrar");
//           $("#tablaContenido").addClass("ocultar"); 
//        }
//        
//      
//    });
            
    
    
        $( "#form" ).validate( {
				rules: {
					txtNombrePlatillo: {
						required: true
					},
					txtDescripcionCorta: {
						required: true

					},
                                        
                                        txtIVA:{
                                            number: true
                                        },
                                        
                                        txtDescripcionLarga: {
						required: true
						
					},
                                        
                                        txtPrecio:{
                                            required: true,
                                            number:true
                                        },
                                        archivo:{
                                            required: true
                                        },
                                        
                                        archivoIco:{
                                            required: true
                                        }
                                        
                                        
				},
				messages: {
                                        txtNombrePlatillo: {
						required: "Introducir nombre de platillo"
					},
					txtDescripcionCorta: {
						required: "Introducir descripción corta"

					},
                                        
                                        txtDescripcionLarga: {
						required: "Introducir descripción larga"
						
					},
                                        
                                        txtPrecio:{
                                            required: "Introducir precio",
                                            number:"Ingresar un valor númerico aceptable"
                                        },
                                        
                                        txtIVA:{
                                            number: "Ingresar valor numérico"
                                        },
                                                
                                        
                                        archivo:{
                                            required: "Seleccionar archivo"
                                        },
                                        
                                        archivoIco:{
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
    
    
</html>
