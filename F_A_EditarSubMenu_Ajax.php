
<?php

include_once './Clases/SubMenu.php';

$idMenu = $_POST['idMenu'];
$tipo = $_POST['tipoMenu'];
$objSubMenu = new SubMenu();
$objSubMenu->ConsultarSubMenuPorID($idMenu);

?>
<script src="js/jquery.validate.min.js"></script>
<script src="js/bootstrap-filestyle.js"></script>
<script src="js/bootstrap-filestyle.min.js"></script>
<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="editarPlatilloTitulo"><?php echo $objSubMenu->Clave; ?></h4>
</div>


<div class="panel-body no-padding-top no-padding-bottom">
    <form action="Validaciones_Lado_Servidor/N_EditarSubMenu.php" method="POST" id="formEditSubMenu" enctype="multipart/form-data">
    <!--Cajas para pasar datos al action-->
    <input type="text" name="IdSubMenu" class="ocultar" value="<?php echo $idMenu;?>">
    <input type="text" name="txtIdPadreOriginal" class="ocultar" value="<?php echo $objSubMenu->IdSubMenuPadre;?>">
    <input type="text" name="txtFotoOriginal" class="ocultar" value="<?php echo $objSubMenu->Foto;?>">
    <!--Aqui termina-->
    
    
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-8 col-sm-8 col-md-8 col-lg-8">
                <img src="<?php echo $objSubMenu->Foto;?>">
                <hr>
                
                
                <?php if($idMenu!=1 && $idMenu!=2){?>
                Ruta Actual: <?php echo $objSubMenu->Ruta;?><br>¿Cambiar ruta?
                
                        <select id="cmbCambiarRuta">
                            <option value="2">No</option>
                            <option value="1">Si</option>
                        </select>
                
                <br>
                <br>
                <div id="tablaSubMenu" class="ocultar">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">    
            <table  class="table table-bordered">
            <thead class="EncabezadoTablaPersonalizada">
        <tr>
            <th colspan="3" style="text-align: center;color: white;">Seleccionar menú</th>
        </tr>
        <tr>
            <th style="color: white; ">Nombre del menú</th>
            <th style="color: white; text-align: center;"></th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $submenus = $objSubMenu->ConsultarRutaPlatillos_Vinos($tipo);
        foreach($submenus as $s){
            
            if($s->ID!=$objSubMenu->ID){
                echo "<tr>";
                echo "<td>$s->Ruta</td>";
                echo "<td><input type='radio' name='radioMenu' id='radioMenu' value='$s->ID'></td>";
            }
            }
            echo "</tr>";
        ?>
    </tbody>
                                </table>
                        </div>
                    </div>
                <?php }?>
                        ¿Editar foto?<select id="cmbFoto">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                
                        <div id="divFoto" class="ocultar">
                            <div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file'  id='archivo'  name='archivo'></div>
                        </div>
                
                
            </div>
    
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-4 col-sm-4 col-md-4 col-lg-4">
                <center>
                    Nombre del menú:<div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNombreSubMenu'  name='txtNombreSubMenu'    class='form-control' value='<?php echo $objSubMenu->Clave;?>'></div>
                    Descripción<div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class="claseTextArea" name="txtDescripcion" rows="5"><?php echo $objSubMenu->Descripcion;?></textarea></div>
                    <button class="btn btn-default">Guardar</button>
                        
                    
                    
                        </center>
                </div>
    </form>
    <form method="POST" action="Validaciones_Lado_Servidor/N_EliminarMenu.php" id='formBorrar'>
        <input type="text" name="IdSubMenu" class="ocultar" value="<?php echo $idMenu;?>">
        <input type="text" name="txtIdPadreOriginal" class="ocultar" value="<?php echo $objSubMenu->IdSubMenuPadre;?>">
        <?php if($idMenu!=1 && $idMenu!=2){?>
        <center><button type="button" class="btn btn-Bixa" id="btnEliminar"><span class="glyphicon glyphicon-warning-sign"></span> Eliminar</button></center>
    <?php } ?>
</form>
    </div>

    



<script>
            $(document).ready(function(){
                
                $("#btnEliminar").click(function (){
                   swal({   
		title: '¿Seguro que desea eliminar el menú?',   
		text: 'Una vez borrado es imposible revertir la acción',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonColor: '#AA1927',   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            

		function(isConfirm){   
			if (isConfirm) {
                    $('#formBorrar').submit();
                                        
			} else {     
				swal('Acción cancelada', 
					'', 
				'error');   
			} 
		});
                });
                
                $("#cmbCambiarRuta").change(function (){
                    if($(this).val()==1){
                        $("#tablaSubMenu").addClass("mostrar");
                        $("#tablaSubMenu").removeClass("ocultar");
                    }
                    else{
                        $("#tablaSubMenu").addClass("ocultar");
                        $("#tablaSubMenu").removeClass("mostrar");
                    }
                });
                
                $("#cmbFoto").change(function (){
                    if($(this).val()==1){
                        $("#divFoto").addClass("mostrar");
                        $("#divFoto").removeClass("ocultar");
                    }
                    else{
                        $("#divFoto").addClass("ocultar");
                        $("#divFoto").removeClass("mostrar");
                    }
                });
                
                
                

        $("#formEditSubMenu").validate( {
				rules: {
					txtNombreSubMenu: {
						required: true,
                                                maxlength: 30
					},
					radioMenu: {
						required: function() {
                                                    return $("#cmbCambiarRuta>option:selected").val() == 1;
                                                }
					},
                                        
                                        archivo:{
						required: function() {
                                                    return $("#cmbFoto>option:selected").val() == 1;
                                                }
					}
                                        
                                        
                                        
				},
				messages: {
                                        txtNombreSubMenu: {
						required: "Introducir nombre del menú",
                                                maxlength: "La longitud máxima son 30 caracteres"
					},
					radioMenu: {
						required: "Seleccionar un menú"

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



        







