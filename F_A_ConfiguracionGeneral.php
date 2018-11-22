<TITLE>Configuración</TITLE>
<?php

include_once 'Header.php';
include_once './Clases/Configuracion.php';
$Configuracion = new Configuracion();
$Configuracion->Consultar();


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
//echo $objEmpresa->TonoCocina;
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <input type="text" name="txtFondoAdministrador" id="txtFondoAdministrador" value="<?php echo $objEmpresa->FondoAdministrador;?>" class="ocultar">
        <input type="text" name="txtFondoComensal" id="txtFondoComensal" value="<?php echo $objEmpresa->FondoComensal;?>" class="ocultar">
        <input type="text" name="txtFondoMesero" id="txtFondoMesero" value="<?php echo $objEmpresa->FondoMesero;?>" class="ocultar">
        <input type="text" name="txtLogo" id="txtLogo" value="<?php echo $objEmpresa->Logo;?>" class="ocultar">
        <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Personalizar aplicación</label></center></h4></div>
            </td>
        </table>
    
    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th><div class="centrar"><label>Función</label></div></th>
                <th><div class="centrar"><label>Información</label></div></th>
                <th><div class="centrar"><label>Mostrar/Opciones</label></div></th>
            </tr>
        </thead>
        
        <tbody>
            <tr>
                <td class="campos">Calificación de los platillos</td>
                <td class="campos">Muestra la calificación promedio que tiene el platillo al comensal, al visualizar el producto</td>
                <td><center>
                    <?php 
                    if($Configuracion->CalificacionPlatillos){
                        echo "<input class='myCheck' id='Check1' onchange='cambiarConfiguracion(1);'  type='checkbox' name='myCheckName' value='1' checked>";
                    }else{
                        echo "<input class='myCheck' id='Check1' onchange='cambiarConfiguracion(1);'  type='checkbox' name='myCheckName' value='0'>";
                    }
                    ?>
                </center></td>
            </tr>
            
            <tr>
                <td class="campos">Calificación de las bebidas</td>
                <td class="campos">Muestra la calificación promedio que tiene la bebida al comensal, al visualizar el producto</td>
                <td><center>
                    <?php 
                    if($Configuracion->CalificacionBebidas){
                        echo "<input class='myCheck' id='Check2' onchange='cambiarConfiguracion(2);'  type='checkbox' name='myCheckName' value='1' checked>";
                    }else{
                        echo "<input class='myCheck' id='Check2' onchange='cambiarConfiguracion(2);'  type='checkbox' name='myCheckName' value='0'>";
                    }
                    ?>
                </center></td>
            </tr>
            
            <tr>
                <td class="campos">Clientes VIP</td>
                <td class="campos">Muestra el campo de entrada en la interfaz inicial del comensal para ingresar
                    el correo (que está ligado a una cuenta "VIP" dentro del sistema) además de ofrecer la función de unirse a dicho club al momento de finalizar la comanda (solo se ofrece unirse si no se inició comanda como cliente VIP).</td>
                <td><center>
                    <?php                        
                    if($Configuracion->ClientesVIP){
                        echo "<input class='myCheck' id='Check3' onchange='cambiarConfiguracion(3);'  type='checkbox' name='myCheckName' value='1' checked>";
                    }else{
                        echo "<input class='myCheck' id='Check3' onchange='cambiarConfiguracion(3);'  type='checkbox' name='myCheckName' value='0'>";
                    }
                    ?>
                </center></td>
            </tr>
                       
            <tr>
                <td class="campos">Publicidad</td>
                <td class="campos">Muestra las imágenes cargadas a la publicidad en la aplicación para el comensal, dichas imágenes aparecerán en la parte inferior de la pantalla en toda la aplicación, exceptuando la interfaz de login.</td>
                <td><center>
                    <?php 
                    if($Configuracion->Publicidad){
                        echo "<input class='myCheck' id='Check4' onchange='cambiarConfiguracion(4);'  type='checkbox' name='myCheckName' value='1' checked>";
                    }else{
                        echo "<input class='myCheck' id='Check4' onchange='cambiarConfiguracion(4);'  type='checkbox' name='myCheckName' value='0'>";
                    }
                    ?>
                </center></td>
            </tr>
            
            <tr>
                                <td class="campos">Papel tapiz administrador</td>
                                <td class="campos"><div class="imagenesTabla"><img src="<?php echo substr($objEmpresa->FondoAdministrador,3);?>"></div></td>
                                <td class="campos">
                                    <button type="button" class="btn btn-Bixa" onclick="modificarFondo(1)"><span class="glyphicon glyphicon-edit"></span></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="campos">Papel tapiz mesero</td>
                                <td class="campos"><div class="imagenesTabla"><img src="<?php echo substr($objEmpresa->FondoMesero,3);?>"></div></td>
                                <td class="campos">
                                    <button type="button" class="btn btn-Bixa" onclick="modificarFondo(2)"><span class="glyphicon glyphicon-edit"></span></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="campos">Papel tapiz comensal</td>
                                <td class="campos"><div class="imagenesTabla"><img src="<?php echo substr($objEmpresa->FondoComensal,3);?>"></div></td>
                                <td class="campos">
                                    <button type="button" class="btn btn-Bixa" onclick="modificarFondo(3)"><span class="glyphicon glyphicon-edit"></span></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="campos">Logo</td>
                                <td class="campos"><div class="imagenesTabla"><img src="<?php echo substr($objEmpresa->Logo,3);?>"></div></td>
                                <td class="campos">
                                    <button type="button" class="btn btn-Bixa" onclick="modificarFondo(4)"><span class="glyphicon glyphicon-edit"></span></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="campos">Notificación Cocina/Bar</td>
                                <td class="campos"><div><audio class="my_audio" controls preload="none">
                                            <source src="<?php echo substr($objEmpresa->TonoCocina, 3); ?>" type="audio/mp3" >
                                </audio></div></td>
                                <td class="campos">
                                    <button type="button" class="btn btn-Bixa" onclick="ModificarNotificacion()"><span class="glyphicon glyphicon-edit"></span></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="campos">Texto de bienvenida al club VIP</td>
                                <td class="campos">Texto del cuerpo del correo que se le envía al cliente al registrarse.<br>El cuerpo del correo siempre tendrá en su primer línea lo siguiente: Su número de folio es (no. folio único).
                                    <textarea class="claseTextArea" rows="5" id="txtBienvenidaVIP" name="txtBienvenidaVIP"><?php echo $objEmpresa->TextoBienvenidaVIP;?></textarea>
                                </td>
                                <td class="campos">
                                    <button type="button" name="btnBienvenidaVIP" id='btnBienvenidaVIP' class="btn btn-Bixa"><span class="glyphicon glyphicon-edit"></span> Guardar</button>
                                </td>
                            </tr>
                            
                            
                            
                            <tr>
                                <td class="campos">Texto al ingresar a la aplicación (Bienvenida del chef)</td>
                                <td class="campos">Texto que se muestra al ingresar en la aplicación del cliente.<br>
                                    <textarea class="claseTextArea" rows="5" id="txtBienvenidaChef" name="txtBienvenidaChef"><?php echo $objEmpresa->TextoBienvenidaChef;?></textarea>
                                </td>
                                <td class="campos">
                                    <button type="button" name="btnBienvenidaChef" id="btnBienvenidaChef" class="btn btn-Bixa"><span class="glyphicon glyphicon-edit"></span> Guardar</button>
                                </td>
                            </tr>
                            
            
            
        </tbody>
    </table>    
</div>


<form id="formBienvenidaChef" action="Validaciones_Lado_Servidor/N_EditarBienvenidaChef.php" method="POST">
    <textarea name="txtBienvenidaChef" id="txtBienvenidaChef" style="opacity: 0;" class=""></textarea>
    <textarea name="txtBienvenidaVIP" id="txtBienvenidaVIP" class="ocultar"></textarea>
    <INPUT name="txtTipoBienvenida" id="txtTipoBienvenida" class="ocultar">
</form>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <br><br>
<form action="Validaciones_Lado_Servidor/N_EditarApp.php" method="POST" enctype="multipart/form-data" id='form'>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-6">
                
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
                    <th><center><button type="button" class="textoOpcionesMenuFacturacion" data-toggle="modal" data-target="#Colores"><span class="glyphicon glyphicon-tint"></span></button></center></th>
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
                
                
            
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-6">
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
                    <th><center><button type="button" class="textoOpcionesMenuFacturacion" data-toggle="modal" data-target="#Colores"><span class="glyphicon glyphicon-tint"></span></button></center></th>
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
        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table-hover">
                                                                  
                            <tr>
                                <td colspan="6"><div  id='controlLogo' class='campos ocultar'><input type='file' class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' id='Logo'  name='Logo'  value=''></div></td>
                            </tr>                

                        <tr>
                            <td><div class="etiquetas2">Nombre Aplicación</div></td>
                            <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->NombreAplicacion;?>"  name="NombreAplicacion" title="Ingresar Datos" class="form-control"></div></td>
                        </tr>                        
                        
                        
                            </table>
                        <button type="submit" id="btnAceptar" name="btnModificar" style="float: right" class="btn btn-Bixa btn-ms" >Guardar</button>
                        <br><br><br>
                        </div>

                        </form>

</div>



<div class="modal fade"   id="IdMiVentanaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="height: 100%; overflow-y: auto;">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                        
                                                        Editar Fondo
						</div>
                                                <form action="Validaciones_Lado_Servidor/N_EditarFondoApp.php" method="POST" enctype="multipart/form-data">
						<div class="modal-body">                                            
                                                    <input type="text" name="Modulo" value="" id="Modulo" class="ocultar" >
                                                    <div class="col-lg-12 col-md-12 col-xs-12 col-ms-12 col-sm-12">
                                                        <img class="editarImagen col-lg-12 col-md-12 col-xs-12 col-ms-12 col-sm-12 img-responsive" src="" id="txtImagen">
                                                    </div>
                                                        
                                                    <div class="col-lg-12 col-md-12 col-xs-12 col-ms-12 col-sm-12">   
                                                        <div class="etiquetas2">Elegir nuevo papel tapiz</div>
                                                        <input type="file" name="txtArchivoFondo">
                                                        <br>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            
                                                
                                                
						<div class="modal-footer">
                                                        <button class="btn btn-Bixa">Guardar</button>
                                                        <button class="btn btn-Regresar" style="float: left;" data-dismiss="modal">Cerrar</button>
						</div>
                                                
                                                </form>

					</div>
				</div>
			</div>
        

<div class="modal fade"   id="VM_ModificarFondo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="height: 100%; overflow-y: auto;">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                                        
                                                        Editar notificación
						</div>
                                                <form id="formNotificacion" action="Validaciones_Lado_Servidor/N_CambiarNotificacion.php" method="POST" enctype="multipart/form-data">
						<div class="modal-body">                                            
                                                <div class="col-lg-12 col-md-12 col-xs-12 col-ms-12 col-sm-12">   
                                                        <div class="etiquetas2">Elegir nuevo tono de notificación</div>
                                                        <input type="file" name="txtNotificacion" accept=".mp3">
                                                        <br>
                                                    </div>    
                                                </div>
						<div class="modal-footer">
                                                        <button class="btn btn-Bixa">Guardar</button>
                                                        <button class="btn btn-Regresar" style="float: left;" data-dismiss="modal">Cerrar</button>
						</div>
                                                
                                                </form>

					</div>
				</div>
			</div>

        
<div id="Colores" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <h4 class="modal-title">Tabla de colores muestra RGB</h4>
                        </div>
                        <div class="modal-body">
                            <div id="" class="table-responsive">
                                <img class='img-responsive' src='bd_Fotos/colores_de_muestra.png'>
                                
                            </div>
                          
                           
                                 
                           
                            
                                
                           
                            
                            
                        </div>
                        
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-Bixa" data-dismiss="modal" name="btnAgregarInsumo" id="btnAgregarInsumo">Agregar</button>-->
                        </div>
                    </div>
                </div>
            </div>
        

<script>
    function cambiarConfiguracion(ID){
        var IdCheck = "#Check"+ID;
        var Visible = $(IdCheck).val();
        if(Visible == 1){
            $(IdCheck).val(0);
            Visible = 0;
        }else{
            $(IdCheck).val(1);
            Visible = 1;
        }
        $.ajax({
           url: "Validaciones_Lado_Servidor/N_ConfiguracionGeneral.php",
           type: 'POST',
           data: {"Visible":Visible,"Campo":ID}, 
           success: function (data) {
                        console.log(data);
           }
        });
        
        
        
        
    }
    
    
    
    $(document).ready(function (){
       $('.tablaPaginado input[type=checkbox]').bootstrapSwitch(); 
    });
    
    
     $('.myCheck').each(function(){
            $('.myCheck').bootstrapSwitch();
        })
    
    
</script>

<script>
        function modificarFondo(ID){
            $('#IdMiVentanaModal').modal({
                show: 'true'
            }); 
            
            switch(ID){
                case 1:
                    var FondoAdmin = $("#txtFondoAdministrador").val();
                    FondoAdmin = FondoAdmin.substring(3);
                    $("#Modulo").val(ID);
                    $("#txtImagen").attr("src",FondoAdmin);
                    break;
                    
                case 2:
                    var Fondo = $("#txtFondoMesero").val();
                    Fondo = Fondo.substring(3);
                    $("#Modulo").val(ID);
                    $("#txtImagen").attr("src",Fondo);
                    break;
                    
                case 3:
                    var Fondo = $("#txtFondoComensal").val();
                    Fondo = Fondo.substring(3);
                    $("#Modulo").val(ID);
                    $("#txtImagen").attr("src",Fondo);
                    break;
                    
                case 4:
                    var Fondo = $("#txtLogo").val();
                    Fondo = Fondo.substring(3);
                    $("#Modulo").val(ID);
                    $("#txtImagen").attr("src",Fondo);
                    break;
                    
                    
                    
            }
        }
        
        function ModificarNotificacion(){
            $("#VM_ModificarFondo").modal({
                show:true
                });
        }
        
        $("#btnBienvenidaVIP").click(function (){
//               $("#txtTipoBienvenida").val(2);
//               $("#formBienvenidaChef").submit();
            var bienvenida = document.getElementById("txtBienvenidaVIP").value; 
//            alert(bienvenida);
            if(bienvenida!=undefined || bienvenida!="" || bienvenida!=" ")
            {
                $.ajax({
                    url: "Validaciones_Lado_Servidor/N_EditarBienvenidaChef.php",
                    type: 'POST',
                    data: {"TextoBienvenidaVIP":bienvenida, "txtTipoBienvenida":2}, 
                    success: function (data) {
                        if(data==1)
                        {
                             swal("¡Correcto!", "Bienvenida al cliente VIP editada correctamente.", "success"); 
                        }
                        else{
                             swal("¡Error!", "Ha ocurrido un error al editar la bienvenida al cliente VIP, por favor vuelva a intentarlo.", "error")
                        }
                    }
                 });
            }
            else{
                 swal("¡Error!", "No se ingresó texto de bienvenida", "error");
                        
            }
        });
        
         $("#btnBienvenidaChef").click(function (){
//               $("#txtTipoBienvenida").val(1);
//               $("#formBienvenidaChef").submit();
            var bienvenida = document.getElementById("txtBienvenidaChef").value;
            if(bienvenida!=undefined || bienvenida!="" || bienvenida!=" ")
            {
                $.ajax({
                    url: "Validaciones_Lado_Servidor/N_EditarBienvenidaChef.php",
                    type: 'POST',
                    data: {"txtBienvenidaChef":bienvenida, "txtTipoBienvenida":1}, 
                    success: function (data) {
                        if(data==1)
                        {
                             swal("¡Correcto!", "Bienvenida del chef editada correctamente.", "success"); 
                        }
                        else{
                             swal("¡Error!", "Ha ocurrido un error al editar la bienvenida del chef, por favor vuelva a intentarlo.", "error")
                        }
                    }
                 });
            }
            else{
                 swal("¡Error!", "No se ingresó texto de bienvenida", "error");
                        
            }
            
    });
        
        
        $(document).ready(function (){
            $("#txtChef").blur(function (){
             $("#txtBienvenidaChef").val($(this).val());
             
            });

            
            $("#txtClienteVIP").blur(function (){
             $("#txtBienvenidaVIP").val($(this).val());
             
            });
            
            
           
          
            
            
            
            
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
           
           
           
           
           $("#formNotificacion").validate( {
				rules: {
                                        txtNotificacion:{
                                            required: true
                                        }
				},
				messages: {
                                    txtNotificacion:{
                                            required: "Es necesario ingresar archivo"
                                        }
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
			});
        });
    </script>