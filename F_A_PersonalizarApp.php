<?php 
if (session_id()==""){
     session_start();
 }
include_once './Validaciones_Lado_Servidor/Funciones/Mensajes_Bootstrap.php';
 
if(isset($_SESSION['Recargar']) && $_SESSION['Recargar']==1){
    /*setSuccessMessage("Datos editados correctamente");*/
    $_SESSION['Recargar'] = null;
    $_SESSION['Recargar2'] = 1;
    echo "<script>window.location='F_A_PersonalizarApp.php?Actualiza=1';</script>";
    
    //echo "<script>javascript:href='www.php';</script>";
}


include_once './Header.php';

include_once './Clases/Empresa.php';
if(isset($_GET['Actualiza']) && $_GET['Actualiza']==1){
    if(isset($_SESSION['Recargar2']) && $_SESSION['Recargar2']==1){
        echo "<div class=\"alert alert-success\">Datos editados correctamente</div>";
        $_SESSION['Recargar2']=null;
    }
}





$objEmpresa = new Empresa();
$objEmpresa->ObtenerPorID(1);

$objEmpresa->ColorFondoBoton = substr($objEmpresa->ColorFondoBoton, 4);
$objEmpresa->ColorFondoBoton = str_replace(")","", $objEmpresa->ColorFondoBoton);
$ColorFondoBoton = explode(",", $objEmpresa->ColorFondoBoton);


$objEmpresa->ColorTextoBoton = substr($objEmpresa->ColorTextoBoton, 4);
$objEmpresa->ColorTextoBoton = str_replace(")","", $objEmpresa->ColorTextoBoton);
$ColorTextoBoton = explode(",", $objEmpresa->ColorTextoBoton);

$objEmpresa->ColorFondoBarra = substr($objEmpresa->ColorFondoBarra, 4);
$objEmpresa->ColorFondoBarra = str_replace(")","", $objEmpresa->ColorFondoBarra);
$ColorFondoBarra = explode(",", $objEmpresa->ColorFondoBarra);

$objEmpresa->ColorTextoBarra = substr($objEmpresa->ColorTextoBarra, 4);
$objEmpresa->ColorTextoBarra = str_replace(")","", $objEmpresa->ColorTextoBarra);
$ColorTextoBarra = explode(",", $objEmpresa->ColorTextoBarra);




?>    
<title>Editar datos de la empresa </title>
    <body>
        <form action="Validaciones_Lado_Servidor/N_EditarApp.php" method="POST" enctype="multipart/form-data" id='form'>
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Configuración general</label></center></h4></div>
            </td>
        </table>
        </div>
                        
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                <div style="overflow-x: auto;">
                <table class="table-condensed table-bordered tabla_Personalizacion">
                <thead>
                    
                    <tr>
                        <th colspan="5"><div class="tabla_Personalizacion">Colores de los botones de la aplicación</div></th>
                    </tr>
                    <tr>
                    <th></th>
                    <th><div class="tabla_Personalizacion">R</div></th>
                    <th><div class="tabla_Personalizacion">G</div></th>
                    <th><div class="tabla_Personalizacion">B</div></th>
                    <th></th>
                    </tr>
                    
                </thead>
                
                <tbody>
                    <tr>
                        <td rowspan="1">Color de fondo</td>
                        <td><div class="campos2"><input type="text" value="<?php echo $ColorFondoBoton[0];?>" maxlength="3"  name="ColorBotonesFondoR" id="ColorBotonesFondoR"  class="form-control ColorBotonesRGB"></div></td>
                        <td><div class="campos2"><input type="text" value="<?php echo $ColorFondoBoton[1];?>" maxlength="3"  name="ColorBotonesFondoG" id="ColorBotonesFondoG"  class="form-control ColorBotonesRGB"></div></td>
                        <td><div class="campos2"><input type="text"  value="<?php echo $ColorFondoBoton[2]?>" maxlength="3"  name="ColorBotonesFondoB" id="ColorBotonesFondoB" class="form-control ColorBotonesRGB"></div></td>
                        <td rowspan="2"><center><button class="btn btn-Bixa" id="btnResultado">Guardar</button></center></td>
                    </tr>
                    
                    <tr>
                        <td rowspan="3">Color de texto</td>
                        <td><div class="campos2"><input type="text" value="<?php echo $ColorTextoBoton[0];?>" maxlength="3"  name="ColorBotonesTextoR" id="ColorBotonesTextoR"  class="form-control ColorBotonesTextoRGB"></div></td>
                        <td><div class="campos2"><input type="text" value="<?php echo $ColorTextoBoton[1];?>" maxlength="3"  name="ColorBotonesTextoG" id="ColorBotonesTextoG"  class="form-control ColorBotonesTextoRGB"></div></td>
                        <td><div class="campos2"><input type="text"  value="<?php echo $ColorTextoBoton[2];?>" maxlength="3"  name="ColorBotonesTextoB" id="ColorBotonesTextoB" class="form-control ColorBotonesTextoRGB"></div></td>
                    </tr>
                </tbody>
            </table>
            </div>    
                </div>    
                
                
            
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
                    <div style="overflow-x: auto;">
                <table class="table-condensed table-bordered tabla_Personalizacion">
                <thead>
                    
                    <tr>
                        <th colspan="5"><div class="tabla_Personalizacion">Colores de la barra de opciones</div></th>
                    </tr>
                    <tr>
                    <th></th>
                    <th><div class="tabla_Personalizacion">R</div></th>
                    <th><div class="tabla_Personalizacion">G</div></th>
                    <th><div class="tabla_Personalizacion">B</div></th>
                    <th></th>
                    </tr>
                    
                </thead>
                
                <tbody>
                    <tr>
                        <td rowspan="1">Color de fondo</td>
                        <td><div class="campos2"><input type="text" value="<?php echo $ColorFondoBarra[0];?>" maxlength="3"  name="ColorBarraFondoR" id="ColorBarraFondoR"  class="form-control ColorBarraFondoRGB"></div></td>
                        <td><div class="campos2"><input type="text" value="<?php echo $ColorFondoBarra[1];?>" maxlength="3"  name="ColorBarraFondoG" id="ColorBarraFondoG"  class="form-control ColorBarraFondoRGB"></div></td>
                        <td><div class="campos2"><input type="text"  value="<?php echo $ColorFondoBarra[2]?>" maxlength="3"  name="ColorBarraFondoB" id="ColorBarraFondoB"  class="form-control ColorBarraFondoRGB"></div></td>
                        <td rowspan="2">
                            
                            <div id="barraAdminApp" style="  background-color:  <?php echo "rgb(".$objEmpresa->ColorFondoBarra.");"?>;">
                                <a  class="colorTextoBarraApp" style="color:<?php echo "rgb(".$objEmpresa->ColorTextoBarra.");"?> ;"><span class="glyphicon glyphicon-home"></span> Inicio</a>
                                            <br>
                                            <a  class="colorTextoBarraApp" style="color:<?php echo "rgb(".$objEmpresa->ColorTextoBarra.");"?> ;"><span class="glyphicon glyphicon-cutlery"></span> Menú Bixa</a>
				</div>

			</div>
                            
                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td rowspan="3">Color de texto</td>
                        <td><div class="campos2"><input type="text" value="<?php echo $ColorTextoBarra[0];?>"  maxlength="3"  name="ColorBarraTextoR" id="ColorBarraTextoR"  class="form-control ColorBarraTextoRGB"></div></td>
                        <td><div class="campos2"><input type="text" value="<?php echo $ColorTextoBarra[1];?>"  maxlength="3"  name="ColorBarraTextoG" id="ColorBarraTextoG"  class="form-control ColorBarraTextoRGB"></div></td>
                        <td><div class="campos2"><input type="text"  value="<?php echo $ColorTextoBarra[2];?>" maxlength="3"  name="ColorBarraTextoB" id="ColorBarraTextoB"  class="form-control ColorBarraTextoRGB"></div></td>
                    </tr>
                </tbody>
            </table>    
                        <br><br>
            </div>
                </div>
            
                    
            
            
                        
                        
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-3 col-lg-6">
                    <table class="table-hover">
                        
                        <tr>
                                <td><div class="etiquetas2">¿Modificar logo?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbFoto" name="cmbFoto"  class="form-control" onchange="">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                        
                                          
                            <tr>
                                <td colspan="6"><div  id='controlLogo' class='campos ocultar'><input type='file' class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' id='Logo'  name='Logo'  value=''></div></td>
                            </tr>                

                        <tr>
                            <td><div class="etiquetas2">Nombre Aplicación</div></td>
                            <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->NombreAplicacion;?>"  name="NombreAplicacion" title="Ingresar Datos" class="form-control"></div></td>
                        </tr>                        
                        
                        <tr>
                                <td><div class="etiquetas2">¿Modificar notificación Cocina/Bar?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAudio" name="cmbAudio"  class="form-control" onchange="">
                                            <option value="0">No</option>
                                            <option value="1">Sí</option>
                                        </select>
                                        </div></td>
                        </tr>
                        
                                          
                            <tr>
                                <td colspan="6"><div  id='controlAudio' class='campos ocultar'><input type='file' class='filestyle' accept='audio/*' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' id='Audio'  name='Audio'  value=''></div></td>
                            </tr>                

                            </table>
                        </div>
                        
                        
            
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                    <br>
                <br>
                
                <button type="submit" id="btnAceptar" name="btnModificar" style="float: right" class="btn btn-Bixa btn-ms" >Guardar</button>
                
                <br>
                <br>
                </div>
            </form>                
    </body>
    
    <script>
        $(document).ready(function (){
            
           $(".ColorBotonesRGB").on("keypress keyup",function (){
               var R = $("#ColorBotonesFondoR").val();
               var G = $("#ColorBotonesFondoG").val();
               var B = $("#ColorBotonesFondoB").val();
               /*if(B === ""){
                    $("#ColorBotonesFondoB").val(0);
                }*/
               var color = "rgb("+R+","+G+","+B+")";
               
                    $("#btnResultado").css("background-color",color);
                    
              
           });
           
           
           $(".ColorBotonesRGB").on("blur",function (){
               var R = $("#ColorBotonesFondoR").val();
               var G = $("#ColorBotonesFondoG").val();
               var B = $("#ColorBotonesFondoB").val();
               if(B === ""){
                    $("#ColorBotonesFondoB").val("?");
                }
                if(R===""){
                    $("#ColorBotonesFondoR").val("?");
                }
                if(G===""){
                    $("#ColorBotonesFondoG").val("?");
                }
               
                    
              
           });
           
           
           $(".ColorBotonesTextoRGB").on("keypress keyup",function (){
               var R = $("#ColorBotonesTextoR").val();
               var G = $("#ColorBotonesTextoG").val();
               var B = $("#ColorBotonesTextoB").val();
               
               var color = "rgb("+R+","+G+","+B+")";
               
                    $("#btnResultado").css("color",color);
                    $("#btnResultado").css("border-color",color);
              
           });
           
           
           $(".ColorBarraFondoRGB").on("keypress keyup",function (){
               var R = $("#ColorBarraFondoR").val();
               var G = $("#ColorBarraFondoG").val();
               var B = $("#ColorBarraFondoB").val();
               
               var color = "rgb("+R+","+G+","+B+")";
               
                    
                    $("#barraAdminApp").css("background-color",color);
              
           });
           
           
           
           $(".ColorBarraTextoRGB").on("keypress keyup",function (){
               var R = $("#ColorBarraTextoR").val();
               var G = $("#ColorBarraTextoG").val();
               var B = $("#ColorBarraTextoB").val();
               
               var color = "rgb("+R+","+G+","+B+")";
               
                    $(".colorTextoBarraApp").css("color",color);
                    
                    $("#opcionesAdmin").css("color",color);
              
           });
           
           $("#cmbFoto").change(function (){
               
               if($("#cmbFoto").val()==1)
               {
                   
                    $("#textoLogo").removeClass("ocultar");
                    $("#textoLogo").addClass("mostrar");
                    $("#controlLogo").removeClass("ocultar");
                    $("#controlLogo").addClass("mostrar");
                }
                else{
                    $("#textoLogo").removeClass("mostrar");
                    $("#textoLogo").addClass("ocultar");
                    $("#controlLogo").removeClass("mostrar");
                    $("#controlLogo").addClass("ocultar");
                }
           });
           $("#cmbAudio").change(function (){
               
               if($("#cmbAudio").val()==1)
               {
                   
                    $("#textoAudio").removeClass("ocultar");
                    $("#textoAudio").addClass("mostrar");
                    $("#controlAudio").removeClass("ocultar");
                    $("#controlAudio").addClass("mostrar");
                }
                else{
                    $("#textoAudio").removeClass("mostrar");
                    $("#textoAudio").addClass("ocultar");
                    $("#controlAudio").removeClass("mostrar");
                    $("#controlAudio").addClass("ocultar");
                }
           });
           
           $( "#form" ).validate( {
				rules: {
                                        Logo:{
                                            required: true
                                        },
                                        ColorBotonesFondoR:{
                                        required: true,
                                        max:255,
                                        min:0,
                                        maxlength:3
                                        },
                                        ColorBotonesFondoG:{
                                        required: true,
                                        max:255,
                                        min:0,
                                        maxlength:3
                                        },
                                        
                                        ColorBotonesFondoB:{
                                        required: true,
                                        max:255,
                                        min:0,
                                        maxlength:3
                                        },
                                        ColorBotonesTextoR:{
                                        required: true,
                                        max:255,
                                        min:0,
                                        maxlength:3  
                                        },
                                        ColorBotonesTextoG:{
                                        required: true,
                                        max:255,
                                        min:0,
                                        maxlength:3  
                                        },
                                        ColorBotonesTextoB:{
                                        required: true,
                                        max:255,
                                        min:0,
                                        maxlength:3  
                                        }
                                        
				},
				messages: {
                                    Logo:{
                                            required: "Es necesario ingresar imagen"
                                        },
                                        
                                        ColorBotonesFondoR:{
                                        required: "Ingresar númerico valor entre 0 y 255",
                                        max:"Ingresar númerico valor entre 0 y 255",
                                        min:"Ingresar númerico valor entre 0 y 255",
                                        maxlength:""
                                        },
                                        ColorBotonesFondoG:{
                                            required: "Ingresar númerico valor entre 0 y 255",
                                        max:"Ingresar númerico valor entre 0 y 255",
                                        min:"Ingresar númerico valor entre 0 y 255",
                                        maxlength:3
                                        },
                                        
                                        ColorBotonesFondoB:{
                                            required: "Ingresar númerico valor entre 0 y 255",
                                        max:"Ingresar númerico valor entre 0 y 255",
                                        min:"Ingresar númerico valor entre 0 y 255",
                                        maxlength:3
                                        },
                                        ColorBotonesTextoR:{
                                            required: "Ingresar númerico valor entre 0 y 255",
                                        max:"Ingresar númerico valor entre 0 y 255",
                                        min:"Ingresar númerico valor entre 0 y 255",
                                        maxlength:3
                                        },
                                        ColorBotonesTextoG:{
                                            required: "Ingresar númerico valor entre 0 y 255",
                                        max:"Ingresar númerico valor entre 0 y 255",
                                        min:"Ingresar númerico valor entre 0 y 255",
                                        maxlength:3
                                        },
                                        ColorBotonesTextoB:{
                                        required: "Ingresar númerico valor entre 0 y 255",
                                        max:"Ingresar númerico valor entre 0 y 255",
                                        min:"Ingresar númerico valor entre 0 y 255",
                                        maxlength:3
                                        },
                                        
                                        
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".campos2" ).addClass( "has-feedback" );

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
					$( element ).parents( ".campos2" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".campos2" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
           
           
        });
    </script>
</html>
