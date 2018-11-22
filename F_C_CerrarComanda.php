<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        
        require 'Header.php';
        include_once './Clases/Encuesta.php';
        include_once './Clases/Configuracion.php';
        $objEncuesta = new Encuesta();
        $objConfig = new Configuracion();
        $objConfig->Consultar();
        ?>
        
        <script src="js/comandaDinamica.js" type="text/javascript"></script>
        <title>Consultar comanda a detalle</title>
        
        
    </head>
    <body style="background-color: #fff">

        
        <?php
        
        require_once './opcionesComensal.php';
        
        if(isset($_SESSION['cuenta']) && !empty($_SESSION['cuenta'])){
            echo "<script>swal('Ha solicitado su cuenta','El mesero se presentará a la brevedad, gracias.','success');</script>";
            $_SESSION['cuenta']=null;
        }
        
        
        if(isset($_SESSION['mensajeCerrarC']) && !empty($_SESSION['mensajeCerrarC'])){
            
            echo "<script>swal('Error','Contraseña incorrecta','error');</script>";
            $_SESSION['mensajeCerrarC']=null;
            
        }
        
        
        ?>
        
        <div class="panel panel-default" style="margin-top: -20px;">
                            <div class="panel-body textoReq">
                                Esta opción es únicamente para el mesero si desea cerrar la orden, contáctelo dando clic en: Contactar al mesero/Solicitar cuenta.
                           </div> 
        </div>
        <?php 
//        if(!$objEncuesta->ConsultarPorID($seguridad->CurrentUserID()))
//        {
        ?>
        <div class="panel panel-default" style="margin-top: -20px;">
                            <div class="panel-body textoReq">
                                Cuéntenos que le ha parecido el servicio.  <button class="btn btn-Regresar" id='btnAbrirCalificar'>Calificar</button>
                           </div> 
        </div>
        <?php // } ?>
        
        <input type="text" name="mostrarModal" id='mostrarModal'
               value="<?php 
//               if(isset($_SESSION['MostrarModalRegistro']) && $_SESSION['MostrarModalRegistro']==1){
//                   echo "1";
//                   unset($_SESSION['MostrarModalRegistro']);
//               }
               ?>" class="ocultar">

        <form action="Validaciones_Lado_Servidor/N_CerrarComanda.php" method="POST" name="form" id="form">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Cerrar comanda</label></center></h4></div>
            </td>
        </table>
        </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <table class="table-hover">
            <tr>                                             
                <td><div class="etiquetas2">Contraseña</div></td>
                <td><div class='campos'><input type='password' id='txtNumeroMesa'  name='txtContrasena'  title='Ingresar Datos' class='form-control' value=''></div></td>
            </tr>
                </table>
                <br>
                <button type="submit" id="btnAceptar" style="float: right;" name="btnAceptar" class="btn btn-default btn-ms" >Aceptar</button>
                <br>
                <br>
                <br>
            </div>
        </form>
        
        <?php 
        
        
//        if(!$objEncuesta->ConsultarPorID($seguridad->CurrentUserID()))
//        {
        ?>
        
        <div class="modal fade"   id="IdMiVentanaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" style="height: 100%; overflow-y: auto;">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3>Calificar</h3>
                                                        <hr>
                                                        <label class="fuenteBixa" style="font-size: 30px;">Gracias por su preferencia</label>
                                                        
                                                        <?php 
                                                        if(!$seguridad->EsVIP() && $objConfig->ClientesVIP==1){
                                                        ?>
                                                        <br>
                                                        <label class="fuenteBixa" style="font-size: 20px;">¿Desea obtener promociones y descuentos?
                                                            <br>Forma parte del club de clientes VIP y obten bonificaciones desde tu primera visita
                                                            <br>
                                                            
                                                            <button style="float: right;"  class='btn btn-Bixa' role='button' data-toggle='modal' data-target='#modalUnirse'>UNETE</button>
                                                            
                                                        </label>
                                                        
                                                        <?php 
//                                                        }
//                                                        ?>
                                                        
						</div>
<form action="Validaciones_Lado_Servidor/N_GuardarEncuesta.php" method="POST">
						<div class="modal-body">
                                                    
                                                        <input type="text" name="txtID" value="<?php echo $seguridad->CurrentUserID();?>" class="ocultar" >
                                                    <table>
                                                        <tr>
                                                            <td class="etiquetas2">Cocina</td>
                                                            <td><div class="campos">
                                                                    <input id="txtCocina"  name="txtCocina" class="rating rating-loading" data-min="0" data-max="5" data-size='xs' data-step="1">
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="etiquetas2">Ambiente</td>
                                                            <td><div class="campos">
                                                            <input id="txtAmbiente" name="txtAmbiente" class="rating rating-loading" data-min="0" data-max="5" data-size='xs' data-step="1">
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="etiquetas2">Precio</td>
                                                            <td><div class="campos">
                                                            <input id="txtPrecio" name="txtPrecio" class="rating rating-loading" data-min="0" data-max="5" data-size='xs' data-step="1">
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="etiquetas2">Servicio</td>
                                                            <td><div class="campos">
                                                            <input id="txtServicio" name="txtServicio" class="rating rating-loading" data-min="0" data-max="5" data-size='xs' data-step="1">
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="etiquetas2">Valoración general</td>
                                                            <td><div class="campos" id='PintarEstrella'>
                                                                    <input id='txtValoracionGeneral' name="txtValoracionGeneral" class='rating rating-loading' data-min='0' data-max='5' data-size='xs' data-step='1' readonly="">                         
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="etiquetas2">Comentario</td>
                                                            <td><div class="campos">
                                                                    <textarea  rows="5" id="txtComentario"  name="txtComentario" placeholder="Comentenos que le ha parecido, sugerencias, quejas, etc." class="form-control claseTextArea"></textarea>
                                                            </div></td>
                                                        </tr>
                                                        
                                                    </table>   
                                                    
                                                    
                                                </div>
                                            
                                                
                                                
						<div class="modal-footer">
                                                        <button class="btn btn-Bixa">Calificar</button>
                                                        <button class="btn btn-Regresar" style="float: left;" data-dismiss="modal">Cerrar</button>
						</div>
                                                
                                                </form>

					</div>
				</div>
			</div>
            </div>
        
        
        <script>
            $(document).ready(function (){
                $(".rating").rating("refresh", {showCaption:false});
                
            $('#IdMiVentanaModal').modal({
                show: 'true'
            }); 
            
            
            $("#btnAbrirCalificar").click(function(){
                
                $('#IdMiVentanaModal').modal({
                show: 'true'
            });
            });
            
            if($("#mostrarModal").val()==1){
                $('#modalUnirse').modal({
                show: 'true'
            }); 
            }
            
            
            
            
            $(".rating").change(function (){

                var Ambiente = parseFloat($("#txtAmbiente").val());
                var Cocina = parseFloat($("#txtCocina").val());
                var Precio =parseFloat ($("#txtPrecio").val());
                var Servicio = parseFloat($("#txtServicio").val());
                var ValoracionGeneral = (Cocina+Ambiente+Precio+Servicio);
                ValoracionGeneral = ValoracionGeneral/4;
                //swal(ValoracionGeneral.toString());
                
                $("#txtValoracionGeneral").rating("update", ValoracionGeneral); 
                 
                /*$("#PintarEstrella").html("<input id='dinamic' value='"+ValoracionGeneral+"'  class='rating rating-loading' data-min='0' data-max='5' data-size='xs' data-step='1'> ");
                $("#dinamic").rating({});*/
                
                /*$("#txtAmbiente").rating("refresh", {value:1});*/
                
                //
                
                
                /*$("#txtValoracionGeneral").val(ValoracionGeneral);*/
                /*swal(ValoracionGeneral.toString()); */
            });
    });
            
            
        </script>
        
        <?php
        }
        
        
        
        if(!$seguridad->EsVIP())
        {
        ?>
        
        <div class="modal fade"   id="modalUnirse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Unete al club VIP</h4>
						</div>
                                                <form action="Validaciones_Lado_Servidor/N_RegistrarCliente.php" method="POST" id="formRegistro">
						<div class="modal-body">
                                                
                                                        <input type="text" name="txtID" value="//<?php echo $seguridad->CurrentUserID();?>" class="ocultar" >
                                                    <table>
                                                        <tr>
                                                            <td class="etiquetas2">Nombre</td>
                                                            <td><div class="campos">
                                                                    <?php 
                                                                    if(isset($_SESSION['txtNombre'])){
                                                                        echo "<input type='text' name='txtNombre' value='".$_SESSION['txtNombre']."' id='txtNombre' class='form-control'>";
                                                                        unset($_SESSION['txtNombre']);
                                                                    }
                                                                    else
                                                                    {
//                                                                    ?>
                                                                    <input type="text" name="txtNombre" id="txtNombre" class="form-control">
                                                                    <?php 
                                                                    }
//                                                                    ?>
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="etiquetas2">Apellidos</td>
                                                            <td><div class="campos">
                                                                    <?php 
                                                                    if(isset($_SESSION['txtApellidos'])){
                                                                        echo "<input type='text' name='txtApellidos' value='".$_SESSION['txtApellidos']."' id='txtApellidos' class='form-control'>";
                                                                        unset($_SESSION['txtApellidos']);
                                                                    }
                                                                    else
                                                                    {
//                                                                    ?>
                                                                    <input type="text" name="txtApellidos" id="txtApellidos" class="form-control">
                                                                    <?php 
                                                                    }
//                                                                    ?>
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="etiquetas2">Teléfono</td>
                                                            <td><div class="campos">
                                                                    <?php 
                                                                    if(isset($_SESSION['txtTelefono'])){
                                                                        echo "<input type='text' name='txtTelefono' value='".$_SESSION['txtTelefono']."' id='txtTelefono' class='form-control'>";
                                                                        unset($_SESSION['txtTelefono']);
                                                                    }
                                                                    else
                                                                    {
//                                                                    ?>
                                                                    <input type="text" name="txtTelefono" id="txtTelefono" class="form-control">
                                                                    <?php 
                                                                    }
//                                                                    ?>
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="etiquetas2">E-mail</td>
                                                            <td><div class="campos">
                                                                    <?php 
                                                                    if(isset($_SESSION['txtCorreo'])){
                                                                        echo "<input type='text' name='txtCorreo' value='".$_SESSION['txtCorreo']."' id='txtCorreo' class='form-control'>";
                                                                        unset($_SESSION['txtCorreo']);
                                                                    }
                                                                    else
                                                                    {
//                                                                    ?>
                                                                    <input type="text" name="txtCorreo" id="txtCorreo" class="form-control">
                                                                    <?php 
                                                                    }
//                                                                    ?>
                                                                    
                                                            </div></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            
                                                            <td><div class="campos">
                                                                    <?php
                                                        if(isset($_SESSION['txtPromos']))
                                                        {
                                                                    echo "<input type='checkbox' name='txtPromos' id='txtPromos' value='1' class='' checked>";
                                                                            
                                                        }else{
                                                            echo "<input type='checkbox' name='txtPromos' id='txtPromos' value='0' class=''>";
                                                        }
//                                                        ?>
                                                            </div></td>
                                                            <td class=""><div class="etiquetasOferta"><label for="txtPromos">Recibir promociones y descuentos</label></div></td>
                                                        </tr>
                                                    </table>   
                                                        
                                                        
                                                        <?php
                                                        if(isset($_SESSION['txtPromos']))
                                                        {
                                                            echo "<table id='tablaPromos' class='table table-responsive table-condensed table-bordered'>";
                                                            unset($_SESSION['txtPromos']);
                                                        }
                                                        else{
                                                            echo "<table id='tablaPromos' class='table table-responsive table-condensed table-bordered ocultar'>";
                                                        }
//                                                        ?>
                                                        
                                                            
                                                            
                                                            <tr>
                                                                <td><div class="campos">
                                                                        <input type="checkbox" name="txtVinos" id="txtVinos" placeholder="" class="checkOpciones" 
                                                                               <?php if(isset($_SESSION['txtPVinos']) && $_SESSION['txtPVinos']==1) echo "checked"; unset($_SESSION['txtPVinos']); ?>
                                                                        >
                                                                </div></td>
                                                                <td class=""><div class="etiquetasOferta"><label for="txtVinos">Vinos</label></div></td>
                                                                
                                                                <td><div class="campos">
                                                                <input type="checkbox" name="txtAlimentos" id="txtAlimentos" placeholder="" class="checkOpciones"
                                                                       <?php if(isset($_SESSION['txtPAlimentos']) && $_SESSION['txtPAlimentos']==1) echo "checked"; unset($_SESSION['txtPAlimentos']); ?>
                                                                       >
                                                                </div></td>
                                                                <td class=""><div class="etiquetasOferta"><label for="txtAlimentos">Alimentos</label></div></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td><div class="campos">
                                                                <input type="checkbox" name="txtEventos" id="txtEventos" placeholder="" class="checkOpciones"
                                                                       <?php if(isset($_SESSION['txtPEventos']) && $_SESSION['txtPEventos']==1) echo "checked"; unset($_SESSION['txtPEventos']); ?>
                                                                       >
                                                                </div></td>
                                                                <td class=""><div class="etiquetasOferta"><label for="txtEventos">Eventos</label></div></td>
                                                                
                                                                <td><div class="campos">
                                                                <input type="checkbox" name="txtCursos" id="txtCursos" class="checkOpciones"
                                                                       <?php if(isset($_SESSION['txtPCursos']) && $_SESSION['txtPCursos']==1) echo "checked"; unset($_SESSION['txtPCursos']); ?>
                                                                       >
                                                                </div></td>
                                                                <td class=""><div class="etiquetasOferta"><label for="txtCursos">Cursos</label></div></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td><div class="campos">
                                                                <input type="checkbox" name="txtTodos" id="txtTodos" value='0' placeholder="" class="">
                                                                </div></td>
                                                                <td class=""><div class="etiquetasOferta"><label for="txtTodos">Todos</label></div></td>
                                                            </tr>
                                                    </table> 
                                                    
                                                

                                                </div>

						<div class="modal-footer">
                                                    <button class="btn btn-Bixa" id='btnRegistrarse' onclick="revisarCorreo();" >Registrarse</button>
                                                        <button style="float: left;" class="btn btn-Regresar" data-dismiss="modal">Cerrar</button>
						</div>
                                                </form>    
					</div>
				</div>
			</div>
        
        <?php 
        }
//        ?>

        
        <script>
            
            
            
            $(document).ready(function(){
                
                
/*                
                function revisarCorreo(){
                var Correo = $("#txtCorreo").val();
                
                $.ajax({
              url: "Validaciones_Lado_Servidor/N_ComprobarCorreoDif.php",
              type: 'POST',
              data: {"txtCorreo":Correo},
              success: function (data) {
                  console.log(data);
                    if(data==1){
                        swal('Error','La cuenta de E-mail que estás ingresando ya existe, favor de ingresar otra cuenta','error');
                        $("#txtCorreoIgual").val('');
                        
                    }else{
                        $("#txtCorreoIgual").val('1');
                    }
                    
                    }
                });
            }
            $("#btnRegistrarse").click(function (){
                revisarCorreo();
            });*/
                
                $("#txtPromos").change(function (){
                   if($(this).val()==0){
                       $("#tablaPromos").removeClass("ocultar");
                       $("#tablaPromos").addClass("mostrar3");
                       $(this).val(1);
                   }
                   else{
                       $("#tablaPromos").removeClass("mostrar3");
                       $("#tablaPromos").addClass("ocultar");
                       $(this).val(0);
                   }
                });
                
                $("#txtTodos").change(function (){
                   if($(this).val()==0){
                       $(".checkOpciones").prop('checked', $(this).prop("checked"));
                       $(".checkOpciones").attr("disabled",true);
                       $(this).val(1);
                   }
                   else{
                       $(".checkOpciones").removeAttr("disabled");
                       $(".checkOpciones").removeAttr("checked");
                       $(this).val(0);
                   } 
                });
                
                           
        $( "#formRegistro" ).validate( {
				rules: {
					txtNombre: {
						required: true
					},
					txtApellidos: {
						required: true
					},
                                        
                                        
                                        txtCorreo:{
                                            
                                            required: true,
                                            email:true
                                        },
                                        
                                        txtTelefono:{
                                            required: true
                                        }
                                        
                                        
				},
				messages: {
						
                                        txtNombre:{
                                            required: "Por favor ingrese nombre"
                                        },
                                        
                                        txtApellidos:{
                                            required: "Por favor ingrese apellidos"
                                        },
                                        
                                        
                                        txtTelefono:{
                                            required: "Ingresar número telefónico",
                                            digits:"Ingresar números"
                                        },
                                        
                                        txtCorreo:{
                                            required: "Ingresar dirección de correo",
                                            email:"Ingresar una dirección de correo válida"
                                            
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
        
        <?php
        require_once './_banner.php';
        ?>