                      <title>Editar Platillo</title>
            <?php
                if(isset($_GET['IdPlatillo'])){

                    $IdPlatillo= $_GET['IdPlatillo'];                
                }
                else{
                    header("Location: F_A_ConsultarPlatillos.php");
                }
                require 'Header.php';  
                require_once './Clases/Vino.php';
                require_once './Clases/Platillo.php';
                include_once './Clases/Sommelier.php';
                include_once './Clases/SubMenu.php';
                include_once './Clases/PlatillosSubMenu.php';
                include_once './Clases/Tiempos.php';
                $objPlatillo = new Platillo();
                $objPlatillo->ConsultarPorID($IdPlatillo);                
            ?>
        
        
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar datos del platillo: <?php echo $objPlatillo->Nombre?></label></center></h4></div>
            </td>
        </table>
        </div>    
            
        
        
        
            
            
            

                      <form action="Validaciones_Lado_Servidor/Validar_EditarPlatillo.php" method="POST" enctype="multipart/form-data" id="form">
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <table class="table-hover">
                        
                        
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Nombre del platillo</div></td>
                            <td colspan="4"><div class="campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group"><input type="text"  name="txtNombrePlatillo" required title="Ingresar Datos" class="form-control" value="<?php echo $objPlatillo->Nombre?>"></div></td>
                        </tr>                        
                        <tr>
                            <td> <label></label></td>
                        </tr>
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $objPlatillo->ID?>"></td>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosPNombre" value="<?php echo $objPlatillo->Nombre?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción corta</div></td>
                            <td colspan="4"><div class="campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group"><textarea class='claseTextArea form-control' rows='3' name='txtDescripcionCorta'><?php echo $objPlatillo->DescripcionCorta?></textarea></div></td>    
                        </tr>                        
                        
                        <tr>
                            <td><label></label></td>
                        </tr>
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción larga</div></td>
                            <td colspan="4"><div class="campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group"><textarea class='claseTextArea form-control col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group' rows='5' name='txtDescripcionLarga'><?php echo $objPlatillo->DescripcionLarga?></textarea></div></td>
                        </tr>                        
                        
                        <tr>
                            <td><div class="etiquetas2">Precio</div></td>
                            <td colspan="4"><div class="campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group"><input type="text"  name="txtPrecio" required title="Ingresar Datos" class="form-control" value="<?php echo $objPlatillo->Precio?>"></div></td>
                        </tr>
                        
                        <tr>
                            <td><div class="etiquetas2">IVA</div></td>
                            <?php 
                            
                            echo "<td><select name='txtIVA' id='txtIVA' class='input-group form-control'>";
                    
                    if($objPlatillo->Iva==16)
                    {
                        echo "<option value='16' selected=''>
                        16%
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='16'>
                        16%
                    </option>";
                    }
                    
                    if($objPlatillo->Iva==0)
                    {
                        echo "<option value='0' selected=''>
                        Tasa 0
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='0'>
                        Tasa 0
                    </option>";
                    }
                    
                    
                    if($objPlatillo->Iva==1)
                    {
                        echo "<option value='1' selected=''>
                        Exento
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='1'>
                        Exento
                    </option>";
                    }
                            
                            ?>
                        </tr>
                        
                        <tr>
                                <td><div class="etiquetas2">¿Visualizar sommelier?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirSommelier" name="cmbSommelier"  class="form-control" onchange="mostrarListadoVinoSommelier();">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                        
                        
                        
                        <tr>
                                <td><div class="etiquetas2">¿Visualizar menús?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirSubMenu" name="cmbSubMenus"  class="form-control" onchange="mostrarListadoSubMenu();">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                    </table>
                </div>
                        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
                    <table class="table-hover">
                        <tr>
                            <td><div class="etiquetas2">Ícono</div></td>
                            <td><div class='imagenesTablaFoto'><img class='' src='<?php echo $objPlatillo->Icono;?>'></div></td>
                        </tr>                        
                        
                        <tr>
                                <td><div class="etiquetas2">¿Modificar ícono?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirIco" name="cmbIcono"  class="form-control" onchange="mostrarFileIcono();">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                        
                        <tr>
                                <td><div id="tablaIco" class="ocultar"><input type='file' name="archivoIco"></div></td>
                        </tr>                
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Foto</div></td>
                            <td><div class='imagenesTablaFoto'><img class='img-responsive' src='<?php echo $objPlatillo->Foto;?>'></div></td>
                        </tr>
                        
                        
                        
                        
                        <tr>
                                <td><div class="etiquetas2">¿Modificar foto?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirFoto" name="cmbFoto"  class="form-control" onchange="mostrarFileFoto();">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                        
                        
                            <tr>
                                <td><div id="tablaFoto" class="ocultar"><input type='file' name="archivo"></div></td>
                            </tr>                
                      <td><div class="etiquetas2">Tiempo</div></td>
      <td><div class='campos'><select id="cmbTiempo" class="form-control" name="cmbTiempo">
            <?php
                $objTiempo = new Tiempos();
                $tiempos = $objTiempo->ConsultarTodo();
                foreach ($tiempos as $time) {
                if (isset($_SESSION['valTiempo']) && !empty($_SESSION['valTiempo'])) {
                    $dato = $_SESSION['valTiempo'];
                    if ($time->ID == $dato) {
                        echo "<option value ='" . $time->ID . "' selected>" . $time->Clave . "</option>";
                    } else {
                        echo "<option value ='" . $time->ID . "'>" . $time->Clave . "</option>";
                    }
                } else {
                    if($objPlatillo->IdTiempo == $time->ID){
                        echo "<option selected value ='" . $time->ID . "'>" . $time->Clave . "</option>";
                    }
                    else{
                        echo "<option value ='" . $time->ID . "'>" . $time->Clave . "</option>";
                    }
                    
                    
                }
            }
            $_SESSION['valTiempo'] = null;
            ?>
              </select>
          </div>
    </tr>
                        
                        
                </table>
                </div>
                    
                    <div id="tablaSommelier" class="ocultar">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">    
            <table  class="table table-bordered">
            <thead>
        <tr>
            <th class="EncabezadoTablaPersonalizada"colspan="3" style="text-align: center;">Agregar Sommelier</th>
        </tr>
        <tr>
            <th style="">Nombre del vino</th>
            <th style="text-align: center;">Si</th>
            <th style="text-align: center;">No</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $objVino = new Vino();
        $vinos = $objVino->ConsultarTodos();
        $objSommelier = new Sommelier();
        foreach($vinos as $v){
            $sommelier = $objSommelier->ConsultarPorIds($IdPlatillo, $v->ID);
            echo "<tr>";
            echo "<td>$v->Nombre</td>";
            if(count($sommelier)>0){
                 echo "<td><center><input type='radio' name='Vino$v->ID' value='$v->ID' checked=''></center></td>";
                 echo "<td><center><input type='radio' name='Vino$v->ID' value=''></center></td>";
            }
            else
            {
                echo "<td><center><input type='radio' name='Vino$v->ID' value='$v->ID'></center></td>";
                echo "<td><center><input type='radio' name='Vino$v->ID' value='' checked=''></center></td>";
            }
            echo "</tr>";
        }

        ?>
    </tbody>
                                </table>
                        </div>
                    </div>

                    <div id="tablaSubMenu" class="ocultar">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">    
            <table  class="table table-bordered">
            <thead>
        <tr>
            <th class="EncabezadoTablaPersonalizada"colspan="3" style="text-align: center;">Cargar a Menú</th>
        </tr>
        <tr>
            <th style="">Nombre del menú</th>
            <th style="text-align: center;">Si</th>
            <th style="text-align: center;">No</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $objSubMenu = new SubMenu();
        $submenus = $objSubMenu->ConsultarSubMenuPlatillosDisponibles();
        $objPlatilloSubMenu = new PlatillosSubMenu();
        foreach($submenus as $s){
            $platillosSub = $objPlatilloSubMenu->ConsultarPorIdPlatillo_IdSubMenu($IdPlatillo, $s->ID);
            echo "<tr>";
            echo "<td>$s->Ruta</td>";
            if(count($platillosSub)>0){
                echo "<td><center><input type='radio' name='SubMenu$s->ID' value='$s->ID' checked=''></center></td>";
                echo "<td><center><input type='radio' name='SubMenu$s->ID' value=''></center></td>";  
            }
            else{
                echo "<td><center><input type='radio' name='SubMenu$s->ID' value='$s->ID'></center></td>";
                echo "<td><center><input type='radio' name='SubMenu$s->ID' value='' checked=''></center></td>";  
            }
            echo "</tr>";
        }
        ?>
    </tbody>
                                </table>
                        </div>
                    </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <br>
                <br>
                <button  class="btn btn-Bixa"  style="float: right" >Guardar</button>
                    <a class="btn btn-Regresar"  href="F_A_ConsultarPlatillos.php">
                        &larr; Ver listado de platillos
                    </a>
                    <br>
                    <br>
                </div>
            </form>            
    </body>
    
    <script>
            $(document).ready(function (){
               
               $("#cmbAnadirFoto").change(function (){
                   var tablaFoto = document.getElementById("tablaFoto");
                    switch($(this).val()){
                        case "Si":
                            tablaFoto.className="mostrar";
                            break;
                            
                        case "No":
                            tablaFoto.className="ocultar";
                            break;
                    }
               });
               
               
               $("#cmbAnadirIco").change(function (){
                   var tablaIco = document.getElementById("tablaIco");
                    switch($(this).val()){
                        case "Si":
                            tablaIco.className="mostrar";
                            break;
                            
                        case "No":
                            tablaIco.className="ocultar";
                            break;
                    }
               });
               
               $("#cmbAnadirSubMenu").change(function (){
                   var tablaSub = document.getElementById("tablaSubMenu");
                    switch($(this).val()){
                        case "Si":
                            tablaSub.className="mostrar";
                            break;
                            
                        case "No":
                            tablaSub.className="ocultar";
                            break;
                    }
               });
               
               $("#cmbAnadirSommelier").change(function (){
                   var tablaSub = document.getElementById("tablaSommelier");
                    switch($(this).val()){
                        case "Si":
                            tablaSub.className="mostrar";
                            break;
                            
                        case "No":
                            tablaSub.className="ocultar";
                            break;
                    }
               });
               
               $("#cmbAnadirSommel").change(function (){
                   var tablaSub = document.getElementById("tablaSommelier");
                    switch($(this).val()){
                        case "Si":
                            tablaSub.className="mostrar";
                            break;
                            
                        case "No":
                            tablaSub.className="ocultar";
                            break;
                    }
               });
               
               
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
