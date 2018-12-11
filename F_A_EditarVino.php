          <?php
         
          require 'Header.php';
          
          
          ?>            

            <title>Editar Vino</title>
            
            <script>
                var arregloCompuesto = [];
                let alimentoCompuesto = {};
            </script>
        <?php
          
        
        include_once  './Clases/Vino.php';
        include_once './Clases/Platillo.php';
        include_once './Clases/Maridaje.php';
        include_once './Clases/SubMenu.php';
        include_once './Clases/VinosSubMenu.php';
        include_once './Clases/ProductoCompuesto.php';
        ?>
        
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
        
        
        <?php
            $productos = [];
            if(isset($_POST['btnAceptar']) || isset($_GET['IdVino'])){
                if(isset($_POST['btnAceptar'])&& $_POST['btnAceptar']){
                    $idPlatilloEd= $_REQUEST['btnAceptar'];
                }
                else{
                    $idPlatilloEd= $_GET['IdVino'];
                    if(!empty($_SESSION['msjEditarVino'])){       
                        echo "<script>swal('".$_SESSION['msjEditarVino'][0]."');</script>";
                        $_SESSION['msjEditarVino']="";
                            }
                        
                }
                $objVino = new Vino();
                $objVino->ConsultarPorID($idPlatilloEd);
                
                
                if ($objVino->Compuesto) {
    $compuesto = new ProductoCompuesto();
    $productos = $compuesto->ConsultarPorIDProducto_IDTipo($objVino->ID, 1);
    foreach($productos as $cp){
        
    
    ?>
    <script>
        
    alimentoCompuesto = {IdSubProducto : <?php echo $cp->IdSubProducto;?>, IdTipoSubProducto : <?php echo $cp->IdTipoSubProducto;?>, Cantidad:<?php echo $cp->Cantidad;?>, Nombre:'<?php echo $cp->Nombre;?>'};
    arregloCompuesto.push(alimentoCompuesto); 
    
    </script>
                <?php }
                
    }
                
            }
            else{
                header("Location: F_A_ConsultarVinos.php");            
            }

            ?>
            
            <form action="Validaciones_Lado_Servidor/Validar_EditarVino.php" method="POST" enctype="multipart/form-data" name="form" id="form">
                <input type='hidden' id='txtArrayProductos'  name='txtArrayProductos'    class='form-control' value=''>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar datos del vino: <?php echo $objVino->Nombre?></label></center></h4></div>
            </td>
        </table>
        </div>    

                        
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <table class="table-hover">
                
                        <tr>
                            <td><div class="etiquetas2">Nombre del vino</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombrePlatillo" required title="Ingresar Datos" class="form-control" value="<?php echo $objVino->Nombre;?>"></div></td>
                            
                        </tr>                        
                        
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $objVino->ID;?>"></td>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosPNombre" value="<?php echo $objVino->Nombre?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción corta</div></td>
                            <td colspan="4"><textarea class='claseTextArea' rows='3' name='txtDescripcionCorta'><?php echo $objVino->DescripcionCorta;?></textarea></td>
                            
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción larga</div></td>
                            <td colspan="4"><textarea class='claseTextArea' rows='5' name='txtDescripcionLarga'><?php echo $objVino->DescripcionLarga;?></textarea></td>
                            
                        </tr>                        
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Precio copa</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtPrecioCopa" required title="Ingresar Datos" class="form-control" value="<?php echo $objVino->PrecioCopa;?>"></div></td>
                            
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Precio botella</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtPrecioBotella" required title="Ingresar Datos" class="form-control" value="<?php echo $objVino->PrecioBotella;?>"></div></td>
                            
                        </tr>
                        
                        <tr>
                            <td><div class="etiquetas2">IVA</div></td>
                           <?php 
                            
                            echo "<td><select name='txtIVA' id='txtIVA' class='input-group form-control'>";
                    
                    if($objVino->Iva==16)
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
                    
                    if($objVino->Iva==0)
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
                    
                    
                    if($objVino->Iva==1)
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
                                <td><div class="etiquetas2">¿Visualizar maridaje?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirSommelier" name="cmbMaridaje"  class="form-control" onchange="mostrarListadoVinoSommelier();">
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
                            <td><div class='imagenesTablaFoto'><img class='' src='<?php echo $objVino->Icono;?>'></div></td>
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
                            <td><div class='imagenesTablaFoto'><img class='' src='<?php echo $objVino->Foto;?>'></div></td>
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
                        
                        
                        
                        
                        
            </table>
            </div>
                
            
                    
                            
                    
                    
                    <div id="tablaSommelier" class="ocultar">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">    
            <table  class="table table-bordered">
                <thead>
        <tr>
            <th colspan="3" style="text-align: center;">Agregar Maridaje</th>
        </tr>
        <tr>
            <th style="">Nombre del platillo</th>
            <th style="text-align: center;">Si</th>
            <th style="text-align: center;">No</th>
            
        </tr>
    </thead>
    <tbody>
        <?php

        $objPlatillo = new Platillo();
        $platillos = $objPlatillo->ConsultarTodo();
        $objMaridaje = new Maridaje();
        foreach($platillos as $p){
            $maridaje = $objMaridaje->ConsultarPorIds($p->ID,$idPlatilloEd);
            echo "<tr>";
            echo "<td>$p->Nombre</td>";
            if(count($maridaje)>0){
                 echo "<td><center><input type='radio' name='Platillo$p->ID' value='$p->ID' checked=''></center></td>";
                 echo "<td><center><input type='radio' name='Platillo$p->ID' value=''></center></td>";
            }
            else
            {
                echo "<td><center><input type='radio' name='Platillo$p->ID' value='$p->ID'></center></td>";
                echo "<td><center><input type='radio' name='Platillo$p->ID' value='' checked=''></center></td>";
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
            <th colspan="3" style="text-align: center;">Cargar a Menú</th>
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
        $submenus = $objSubMenu->ConsultarSubMenuBebidasDisponibles();
        $objVinosSubMenu = new VinosSubMenu();
        foreach($submenus as $s){
            $vinosSub = $objVinosSubMenu->ConsultarPorIdVino_IdSubMenu($idPlatilloEd, $s->ID);
            echo "<tr>";
            echo "<td>$s->Ruta</td>";
            if(count($vinosSub)>0){
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

        <div class="etiquetas2">¿Es un producto compuesto? </div>
        <div class='campos  '>
            <select class="form-control" id='cmbProductoCompuesto' name="cmbProductoCompuesto">
                <option value="0"   <?php if(!$objVino->Compuesto){ echo "selected";}?>   >No</option>
                <option value="1" <?php if($objVino->Compuesto){ echo "selected";}?>  >Si</option>
            </select>
        </div>
    </div>     


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10 ocultar " id='tablaProductoCompuesto'>
        <div style="width: 100%; overflow-x: auto;">
            <table  class="table table-bordered">
                <thead class="EncabezadoTablaPersonalizada">
                    <tr>

                        <th><a type="button" class="" style="float:left" data-toggle='modal' data-target='#VMProductoCompuesto'>
                                <span class='glyphicon glyphicon-plus-sign' style='font-size:22px; color:#419C67; cursor:pointer'></span>
                            </a></th>
                        <th colspan="" style="text-align: center;">
                            
                            
                        </th>
                        <th>
                               Tope de productos por paquete
                

                        <div class=''><input type='text' id='txtTope'  name='txtTope'    class='form-control' value='<?php echo $objVino->Tope;?>'></div>
                </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="">Nombre del producto</th>
                        <th style="text-align: center;">Cantidad tope de producto por paquete</th>    
                    </tr>
                </thead>
                <tbody id="tablaProductoAgregados">
                 
                 <?php
                                    
                                    foreach($productos as $pc){
                                        echo "<tr>";
                                        //onclick=\"BorrarProductoCompuesto('"+arregloCompuesto[i].IdTipoSubProducto+"','"+arregloCompuesto[i].IdSubProducto+"'
                                        echo "<td><a onclick=\"BorrarProductoCompuesto('$pc->IdTipoSubProducto','$pc->IdSubProducto')\"><span class='glyphicon glyphicon-minus-sign' style='font-size:22px; color:#AB1414; cursor:pointer'></span></a></td>";
                                        echo "<td>$pc->Nombre</td>";
                                        echo "<td>$pc->Cantidad</td>";                                        
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
                    <input type="submit" style="float: right" value="Guardar" class="btn btn-Bixa" name="btnModificar" >
                    <a class="btn btn-Regresar"  href="F_A_ConsultarVinos.php">
                        &larr; Ver listado de bebidas
                    </a>
                    <br>
                    <br>
                </div>        
            </form>            
        
        
    </body>
    
    
    <script>
            var tope = <?php echo $objVino->Tope;?>;
            
    $("button[name='btnAgregarCompuesto']").click(function () {
        let eleccion = $("#cmbCompuesto option:selected").val(); //0 platillos, 1 bebidas
        var urlAjax = "";
        $("#tableConsulta").addClass("mostrar");
        if (eleccion === 0) {
        //    urlAjax = "Validaciones_Lado_Servidor/Ajax/N_A_ConsultarPlatillos.php";
        }
        $.ajax({
            url: "Validaciones_Lado_Servidor/Ajax/N_A_ConsultarProductos.php",
            type: 'POST',
            data: {"Tipo": eleccion},
            success: function (data) {
                var response = data;
                $("#divConsulta").html(response);
                $("#tableConsulta").DataTable();
            }
        });
        
        
    });
    
    
    $("#txtTope").change(function (){
       let cantidad = tope;
       tope = $("#txtTope").val();
       let mayor = ObtenerMayorCantidad();
       if(!parseInt(tope,10)){
           swal('Error','El valor no es numérico','error');
           $("#txtTope").val(cantidad);   
       }
       
       else if(tope < ObtenerMayorCantidad()){
           swal('Error', 'Hay un producto con cantidad = '+mayor+' que rebasa la cantidad tope que está tratando de asignar('+tope+') por lo tanto se quedará el antiguo valor, verifique los datos e intente nuevamente');
           $("#txtTope").val(cantidad);
       }
       
       
       
    });
    
    function ObtenerMayorCantidad(){
        
        let cantidadMayor = 0;
        for(let i = 0; i< arregloCompuesto.length; i++){
            if(arregloCompuesto[i].Cantidad>cantidadMayor){
                cantidadMayor = arregloCompuesto[i].Cantidad;
            }
        }
        return cantidadMayor; 
        
    }
    
    
    function AgregarProductoCompuesto(id, tipo,nombre){  //ID del producto, Tipo 0 = Alimento, 1 = Bebida
       
        
        if(!(tope && tope>0)){
            swal('Error','Debe asignar un tope al producto principal antes de agregar productos','error');
            return;
        }
            
        let valor = parseInt(prompt("Ingresar cantidad de productos", "0"), 10);
        
        if(valor && valor>0){
            
            if(valor <= tope){
                let eleccion = $("#cmbCompuesto option:selected").val(); //0 platillos, 1 bebidas 
                let alimentoCompuesto = {IdSubProducto : id, IdTipoSubProducto : tipo, Cantidad:valor, Nombre:nombre};
                arregloCompuesto.push(alimentoCompuesto);
                ActualizarTablaProductoCompuesto();
                swal('Correcto','Producto agregado','success');
            }
            else{
                swal('Error', 'La cantidad ingresada ('+valor+') sobrepasa el tope ('+tope+') del producto','error');
            }
        }
        else{
            swal('Error','Ingresar valor numérico entero mayor a 0','error');
        }
    }
                                                        
                                                        
                                                        
                                                        
            function BorrarProductoCompuesto(IdTipo, IdSubProducto){                
                for(let i = 0; i< arregloCompuesto.length; i++){
                    if(arregloCompuesto[i].IdSubProducto==IdSubProducto && arregloCompuesto[i].IdTipoSubProducto==IdTipo){
                        arregloCompuesto.splice(i,1);
                        break;
                    }
                }
                ActualizarTablaProductoCompuesto();
            }
            
            
            function ActualizarTablaProductoCompuesto(){
                let tabla = "";
                $("#txtArrayProductos").val(JSON.stringify(arregloCompuesto));
                for(let i = 0; i<arregloCompuesto.length; i++){
                    tabla+="<tr>";   
                    tabla+="<td><a onclick=\"BorrarProductoCompuesto('"+arregloCompuesto[i].IdTipoSubProducto+"','"+arregloCompuesto[i].IdSubProducto+"')\"><span class='glyphicon glyphicon-minus-sign' style='font-size:22px; color:#AB1414; cursor:pointer'></span></a></td>";

                    tabla+="<td>"+arregloCompuesto[i].Nombre+"</td>";
                    tabla+="<td>"+arregloCompuesto[i].Cantidad+"</td>";
                    tabla+="</tr>";
                }
                if(arregloCompuesto.length==0){
                    tabla="<th colspan='4'><center>No se encontraron registros</center></th>";
                }
                $("#tablaProductoAgregados").html(tabla);        
            }
            
            
            function mostrarTabla(){
                if ($("#cmbProductoCompuesto").val() == 1) {
                    $("#tablaProductoCompuesto").removeClass("ocultar");
                    $("#tablaProductoCompuesto").addClass("mostrar");
                } else {
                    $("#tablaProductoCompuesto").removeClass("mostrar");
                    $("#tablaProductoCompuesto").addClass("ocultar");

                }
            }
        
            $(document).ready(function (){
                
                $("#txtArrayProductos").val(JSON.stringify(arregloCompuesto));
                $("#cmbProductoCompuesto").change(function () {
                    mostrarTabla();
               });

               mostrarTabla();
            });
            </script>
    
    
</html>
