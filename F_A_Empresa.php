<?php 
include_once './Header.php';
include_once './Clases/Empresa.php';
require_once 'Clases/LlenadoCombos.php';
require_once './Clases/ClientesFacturas.php';
require_once './Clases/CatalogoEstado.php';
require_once './Clases/CatalogoMunicipio.php';
$objEmpresa = new Empresa();
$objEmpresa->ObtenerPorID(1);

$objLlenadoCombos= new LlenadoCombos();

$lista_regimenFiscal= utf8_encode($objLlenadoCombos->LlenarCombosElementoSeleccionado("Select * from RegimenFiscal", "Id", "Nombre",$objEmpresa->ObtenerRegimenFiscal(1)));


?>    
<title>Editar datos de la empresa </title>
    <body>
        <form action="Validaciones_Lado_Servidor/N_EditarEmpresa.php" method="POST" enctype="multipart/form-data" id='form'>
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
                <td class="tdEncabezadoTabla">
                    <div><h4><center><label class="textoEncabezadoTabla">Editar datos de empresa</label></center></h4></div>
                </td>
            </table>
        </div>
               
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">
                <tr>
                    <td><div class="etiquetas2">Nombre Comercial</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->NombreComercial;?>" name="NombreComercial" title="Ingresar Datos" class="form-control"></div></td>
                </tr>                        
                        
                <tr>
                    <td><div class="etiquetas2">Razón Social</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->RazonSocial;?>"  name="RazonSocial" title="Ingresar Datos" class="form-control"></div></td>
                </tr>                        
                        
                <tr>
                    <td><div class="etiquetas2">RFC</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->RFC;?>" name="RFC" id="RFC" title="Ingresar Datos" class="form-control"></div></td>
                </tr>                        
                        
                <tr>
                    <td><div class="etiquetas2">Calle</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->Calle;?>" name="Calle" title="Ingresar Datos" class="form-control"></div></td>
                </tr> 
                <tr>
                    <td><div class="etiquetas2">Número exterior</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->NumeroExterior;?>" name="NumeroExterior" title="Ingresar Datos" class="form-control"></div></td>
                </tr>      
                <tr>
                    <td><div class="etiquetas2">Número interior</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->NumeroInterior;?>" name="NumeroInterior" title="Ingresar Datos" class="form-control"></div></td>
                </tr>  
                <tr>
                    <td><div class="etiquetas2">Colonia</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->Colonia;?>" name="Colonia" title="Ingresar Datos" class="form-control"></div></td>
                </tr>
               
                        
                 <tr>
                    <td><div class="etiquetas2">Código postal</div></td>
                    <td colspan="4"><div class="campos"><input id="CodigoPostal" type="text" value="<?php echo $objEmpresa->CodigoPostal;?>" name="CodigoPostal" title="Ingresar Datos" class="form-control"></div></td>
                </tr>
               
                         
            </table>
        </div>
                        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover">
                 <tr>
                    <td><div class="etiquetas2">País</div></td>
                    <td colspan='4'><div class='campos'><input type='text' id="Pais"  name='Pais' title='Ingresar Datos' class='form-control' value="<?php echo $objEmpresa->Pais; ?>"></div></td>

                </tr>
                <tr>
                    <td><div class="etiquetas2">Estado</div></td>

                    <td colspan="4"><div class='combos'>
                        <select name='cmbEstado' id='cmbEstado' class='form-control'>
                        
                        <?php
                            $objEstado = new CatalogoEstado();
                            $estados = $objEstado->ObtenerDisponibles();
                            foreach ($estados as $e) {
                                if ($e->Id_Estado == $objEmpresa->IdEstado) {
                                        echo "<option value ='" . $e->Id_Estado . "' selected>" . $e->DESCRIP . "</option>";
                                } 
                                else {
                                        echo "<option value ='" . $e->Id_Estado . "'>" . $e->DESCRIP . "</option>";
                                }
                            }
                           
                        ?>    
                    </select></div></td>

                </tr> 
               <tr>
                    <td><div class="etiquetas2">Municipio</div></td>
                    <td colspan="4" style="width: 60%">
                        <div class='campos'>
                            <select  id="cmbMunicipio" class="form-control" name="cmbMunicipio">
                                <?php
                                $objMunicipios = new CatalogoMunicipio();
                                $MPO = 0;

                                $objMunicipios = $objMunicipios->ObtenerDisponibles();
                                foreach ($objMunicipios as $Municipios) {
                                    if ($objEmpresa->IdMunicipio == $Municipios->Id_Municipio) {
                                        //echo "<input type='text' id='Direccion' name='Direccion' value='$ObjUsuario->Direccion'  class='ocultar' >";
                                        $MPO = $Municipios->MPO;
                                        echo "<option value ='" . $Municipios->Id_Municipio . "' selected>$Municipios->DESCRIP</option>";
                                    } else {
                                        echo "<option value ='" . $Municipios->Id_Municipio . "'>$Municipios->DESCRIP</option>";
                                    }
                                }
                                echo "<input type='text' id='Municipio' name='Municipio' value='$MPO'  class='ocultar' >";
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
               
                <tr>
                    <td><div class="etiquetas2">Teléfono</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->Telefono;?>"  name="Telefono" title="Ingresar Datos" class="form-control"></div></td>
                </tr>                        

                <tr>
                    <td><div class="etiquetas2">Correo</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->Correo;?>"  name="Correo" title="Ingresar Datos" class="form-control"></div></td>
                </tr>                        
                <tr>
                    <td><div class="etiquetas2">Contraseña</div></td>
                    <td colspan="4"><div class="campos"><input type="password" value="<?php echo $objEmpresa->Password; ?>"  name="Password" title="Ingresar Datos" class="form-control"></div></td>
                </tr>
                <tr>
                    <td><div class="etiquetas2">Página Web</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->PaginaWeb;?>" name="PaginaWeb" title="Ingresar Datos" class="form-control"></div></td>
                </tr>                        
                                      
                <tr>
                    <td colspan="6"><div  id='controlLogo' class='campos ocultar'><input type='file' class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' id='Logo'  name='Logo'  value=''></div></td>
                </tr>                
                        
                <tr>
                    <td><div class="etiquetas2">Eslogan</div></td>
                    <td colspan="4"><div class="campos"><input type="text" value="<?php echo $objEmpresa->Eslogan;?>"  name="Eslogan" title="Ingresar Datos" class="form-control"></div></td>
                </tr>                        
                        
                 
              <tr>
                    <td><div class="etiquetas2">Régimen fiscal</div></td>

                    <td colspan="4"><div class='combos'><select name='RegimenFiscal' id='RegimenFiscal' class='form-control'>
                                <?php echo $lista_regimenFiscal;?>
                    </select></div></td>

                </tr> 
                        
                        
            </table>
        </div>
                        
                        
                        
            
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                    <br>
                <br>
                <br>
                    <button type="submit" id="btnAceptar" name="btnModificar" style="float: right" class="btn btn-Bixa btn-ms" >Guardar</button>
                
                    <a href='F_A_PaginaPrincipal.php' type="button" class="btn btn-Regresar btn-ms" >
                        &larr; Menú principal
                    </a>
                
                <br>
                
                <br>
                </div>
            </form>                
    </body>
    <script>
    $("#cmbEstado").change(function () {
        var estado = document.getElementById("cmbEstado").value;
        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Consulta_Estado_Municipio.php",
            type: 'POST',
            data: {"estado": estado},
            success: function (data) {
                $("#cmbMunicipio").html(data);

            }
        });

    });

    $("#cmbEstado").ready(function () {
        var estado = document.getElementById("cmbEstado").value;
        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Consulta_Estado_Municipio.php",
            type: 'POST',
            data: {"estado": estado},
            success: function (data) {
                $("#cmbMunicipio").html(data);
                $("#cmbMunicipio").prop("selectedIndex", $("#Municipio").val() - 1);

            }
        });

    });


</script>
    <script>
        $(document).ready(function (){
           
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
           
           $( "#form" ).validate( {
				rules: {
                                        Logo:{
                                            required: true
                                        },
                                        CodigoPostal:{
                                            required: true,
                                            number: true,
                                            minlength: 5,
                                            maxlength: 5
                                        },
                                        
                                        RFC:{
                                            minlength: 12,
                                            maxlength: 13
                                        },
                                        RegimenFiscal:{
                                            required:true
                                        }
                                        
                                        
				},
				messages: {
                                    Logo:{
                                            required: "Es necesario ingresar imagen"
                                        },
                                        CodigoPostal:{
                                            required: "Ingresar el código postal",
                                            number: "Ingresar sólo números",
                                            minlength:"Solo 5 dígitos",
                                            maxlength: "Solo 5 dígitos"
                                        },
                                        
                                        RFC:{
                                            minlength: "Error RFC incorrecto",
                                            maxlength: "Error RFC incorrecto"
                                        },
                                        RegimenFiscal:{
                                            required:"Ingresar el régimen fiscal"
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
