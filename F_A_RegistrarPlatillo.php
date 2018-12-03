<?php
require 'Header.php';
include_once './Clases/SubMenu.php';
include_once './Clases/Sommelier.php';
include_once './Clases/Vino.php';
include_once './Clases/Insumo.php';
include_once './Clases/Clasificador.php';
include_once './Clases/Tiempos.php';

?>


<title>Registrar Platillo</title>
    <script>
        var arregloCompuesto = [];
    </script>

<?php
if (!empty($_SESSION['msjRegistrarPlatillo'])) {

    echo "<script>swal('" . $_SESSION['titulo'] . "','" . $_SESSION['msjRegistrarPlatillo'][0] . "','" . $_SESSION['tipo'] . "');</script>";

    /*     * ***Limpio variables de sesion*** */
    $_SESSION['msjRegistrarPlatillo'] = null;
    unset($_SESSION['msjRegistrarPlatillo']);
    $_SESSION['titulo'] = null;
    unset($_SESSION['titulo']);
    $_SESSION['tipo'] = null;
    unset($_SESSION['tipo']);
}
?>
<form action="Validaciones_Lado_Servidor/Validar_AgregarPlatillo.php" method="POST" enctype="multipart/form-data" id="form">


    

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Registrar alimento</label></center></h4></div>
            </td>
        </table>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
        <table>
            <tr>
                <td width="20%"><div class="etiquetas2">Nombre de platillo</div></td>


<?php
if (!isset($_SESSION['valNombre']) && (empty($_SESSION['valNombre']))) {
    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNombrePlatillo'  name='txtNombrePlatillo'    class='form-control' value=''></div></td>";
} else {
    $valor = $_SESSION['valNombre'];
    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtNombrePlatillo'  name='txtNombrePlatillo'    class='form-control' value='$valor'></div></td>";
    $_SESSION['valNombre'] = null;
}



if (!isset($_SESSION['valArrayProductos']) && (empty($_SESSION['valArrayProductos']))) {
    echo "<input type='hidden' id='txtArrayProductos'  name='txtArrayProductos'    class='form-control' value=''>";
} else {
    $valor = json_encode($_SESSION['valArrayProductos']);
    echo "<input type='hidden' id='txtArrayProductos'  name='txtArrayProductos'   class='form-control' value='$valor'>";
    $_SESSION['valArrayProductos'] = null;
}
?>
            </tr>                        

            <tr>
                <td ><div class="etiquetas2">Descripción corta</div></td>
                <?php
                if (!isset($_SESSION['valDescripcionCorta']) && (empty($_SESSION['valDescripcionCorta']))) {

                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDescripcionCorta'  name='txtDescripcionCorta'    class='form-control' value=''></div></td>";
                } else {
                    $valor = $_SESSION['valDescripcionCorta'];
                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtDescripcionCorta'  name='txtDescripcionCorta'    class='form-control' value='$valor'></div></td>";
                    $_SESSION['valDescripcionCorta'] = null;
                }
                ?>
            </tr>

            <tr>
                <td ><div class="etiquetas2">Descripción larga</div></td>
                <?php
                if (!isset($_SESSION['valDescripcionLarga']) && (empty($_SESSION['valDescripcionLarga']))) {

                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='5' id='txtDescripcionLarga' name='txtDescripcionLarga'></textarea></div></td>";
                } else {
                    $valor = $_SESSION['valDescripcionLarga'];
                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='5' id='txtDescripcionLarga' name='txtDescripcionLarga'>$valor</textarea></div></td>";
                    $_SESSION['valDescripcionLarga'] = null;
                }
                ?>
            </tr>

        </table>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
        <table>
            <tr>
                <td width="20%"><div class="etiquetas2">Precio</div></td>


<?php
if (!isset($_SESSION['valPrecio']) && (empty($_SESSION['valPrecio']))) {
    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtPrecio'  name='txtPrecio'    class='form-control' value=''></div></td>";
} else {
    $valor = $_SESSION['valPrecio'];
    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtPrecio'  name='txtPrecio'    class='form-control' value='$valor'></div></td>";
    $_SESSION['valPrecio'] = null;
}
?>
            </tr>                        

            <tr>
                <td ><div class="etiquetas2">Subir ícono</div></td>
                <?php
                if (!isset($_SESSION['valIcono']) && (empty($_SESSION['valIcono']))) {

                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' id='archivoIco'  name='archivoIco'   class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value=''></div></td>";
                } else {
                    $valor = $_SESSION['valIcono'];
                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' id='archivoIco'  name='archivoIco'    class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value='$valor'></div></td>";
                    $_SESSION['valIcono'] = null;
                }
                ?>
            </tr>

            <tr>
                <td ><div class="etiquetas2">Subir foto</div></td>
                <?php
                if (!isset($_SESSION['valFoto']) && (empty($_SESSION['valFoto']))) {

                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' id='archivo'  name='archivo'  value=''></div></td>";
                } else {
                    $valor = $_SESSION['valFoto'];
                    echo $valor;
                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='file' class='filestyle' accept='image/jpeg,image/x-png,image/png' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' id='archivo'  name='archivo' value='$valor'></div></td>";
                    $_SESSION['valFoto'] = null;
                }
                ?>
            </tr>

            <tr>
                <td width="20%"><div class="etiquetas2">IVA</div></td>

                <td><select name="txtIVA" id="txtIVA" class="input-group form-control">
                        <option value="16" selected="">
                            16%
                        </option>
                        <option value="0">
                            Tasa 0
                        </option>
                        <option value="1">
                            Exento
                        </option>
                    </select></td>

            </tr> 

            <tr>
                <td width="20%"><div class="etiquetas2">Tiempo</div></td>
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

        echo "<option value ='" . $time->ID . "'>" . $time->Clave . "</option>";
    }
}
$_SESSION['valTiempo'] = null;
?>
                        </select>
                    </div>
            </tr>

        </table>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">

        <div class="etiquetas2">¿Cargar a menú?</div>
        <div class='campos  '>
            <select class="form-control" id='cmbMenu' name="cmbMenu">
                <option value="0">No</option>
                <option value="1">Si</option>
            </select>
        </div>
    </div>        


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10 ocultar" id='tablaMenus'>
        <div style="width: 100%; overflow-x: auto;">
            <table  class="table table-bordered">
                <thead class="EncabezadoTablaPersonalizada">
                    <tr>
                        <th colspan="4" style="text-align: center;">Seleccionar menú</th>
                    </tr>
                    <tr>
                        <th style="">Nombre del menú</th>
                        <th style="text-align: center;"></th>
                        <th style="">Nombre del menú</th>
                        <th style="text-align: center;"></th>
                    </tr>
                </thead>
                <tbody>
<?php
$objSubMenu = new SubMenu();
$submenus = $objSubMenu->ConsultarSubMenuPlatillosDisponibles();
$fila = 0;
foreach ($submenus as $s) {

    if ($fila == 2) {
        echo "<tr>";
        $fila = 0;
    }
    echo "<td>$s->Ruta</td>";
    echo "<td><center><input type='checkbox' name='subMenu$s->ID' id='radioMenu' value='$s->ID'></center></td>";
    if ($fila == 2) {
        echo "</tr>";
    }
    //echo "<script>alert($fila);</script>";
    $fila++;
}
?>
                </tbody>
            </table>
        </div>
    </div>







    <!--        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
    
                <div class="etiquetas2">¿Es un producto compuesto?</div>
                    <div class='campos  '>
                            <select class="form-control" id='cmbInsumos' name="cmbInsumos">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                    </div>
    
            </div>        -->
    <!--***************************************************************************************************************************-->                    



    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10 table-responsive ocultar" name="div_ProductoCompuesto" id="div_ProductoCompuesto">

        <button type="button"  name="btnAgregar" style="color:#0000CD; position: relative; left:80%;" id="btnAgregar" class="textoOpcionesMenuFacturacion" onclick=""><span class="glyphicon glyphicon-plus" style="font-size:22px; color:#0000CD;"></span> Agregar Insumo</button>

        <br>
        <table border='0' style="width:100%;"class='tableEncabezadoFijo' >

            <thead>
                <tr>
                    <th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
                    <th style="width:23%;" class='EncabezadoTablaPersonalizada'><center>Descripción insumo</center></th>
            <th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
            <th style="width:23%;" class='EncabezadoTablaPersonalizada'><center>Presentación</center></th>
            <th style="width:21%;"class='EncabezadoTablaPersonalizada'><center>Contenido</center></th>
            <th style="width:1.5%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
            <th style="width:12%;" class='EncabezadoTablaPersonalizada'>No. de Copas</th>
            <th style="width:15%;" class='EncabezadoTablaPersonalizada'>Equivalente ml</th>
            <th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
            </tr>
            </thead>
        </table>

        <div style="overflow-y: scroll; height:auto; max-height:176px;">
            <table border='0' style="width:100%;" id='tabla_editable' >

            </table>

        </div></div>

    <script>
        $(document).ready(function () {
            AgregarFila();
        });




        var cont = 0;
        function AgregarFila() {


            cont++;

            var fila = '<tr id="fila' + cont + '" >' +
                    '<td style="width:2%; font-size: 9px; text-align:center;"></td>' +
                    '<td style="width:0.1%; font-size: 9px; text-align:center;" class="mostrar">' + cont + '</td>' +
                    '<td style="width:23%;"><input type="text" class="form-control" id="txtDescripcion' + cont + '" name="txtDescripcion' + cont + '" readonly="" style="text-align:center;" /></td>' +
                    '<td style="width:0.1%;"><input type="text" class="mostrar" id="txtIdDescripcion' + cont + '" name="txtIdDescripcion' + cont + '" readonly="" /></td>' +
                    '<td style="width:2%;"><button type="button" class="textoOpcionesMenuFacturacion" name="btnMas' + cont + '" id="btnMas' + cont + '" onclick="ColocarIdElegido(this.id);" data-toggle="modal" data-target="#CatalogoClientes"><span class="glyphicon glyphicon-search"></span></button></td></td>' +
    //                alert("entra");
                    '<td style="width:23%;"><input readonly="" value="" type="text" class="form-control"  id="txtPresentacion' + cont + '" name="txtPresentacion' + cont + '" style="text-align:center;" /></td>' +
                    '<td style="width:23%;"><input readonly="" value="" type="text" class="form-control" id="txtContenido' + cont + '" name="txtContenido' + cont + '"  style="text-align:center;"/></td>' +
                    //                 
                    '<td style="width:12%;"><input value="0" type="text" class="form-control" id="txtNumCopas' + cont + '" name="txtNumCopas' + cont + '"  style="text-align:center;" /></td>' +
                    '<td style="width:13%;"><input value="0" type="text" class="form-control" id="txtEquivalenteMl' + cont + '" name="txtEquivalenteMl' + cont + '" style="text-align:center;" /></td>' +
    //                '<td style="width:15%;"><select class="form-control" id="cmbConcepto'+cont+'" name="cmbConcepto'+cont+'"><option value="0">Seleccione..</option><option value="1">Compra</option><option value="2">Artículos promocionales</option></select></td>'+

                    '<td style="width:2%;"><button type="button" id="btn' + cont + '" class="textoOpcionesMenuFacturacion" onclick="eliminar(this.id)"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';

            $('#tabla_editable').append(fila);
            reordenar();
        }
        function eliminar(id_fila) {

            var arreglo_nombre_boton = id_fila.split("n");
    //        alert(arreglo_nombre_boton[1]);
            var id = arreglo_nombre_boton[1];
            $('#fila' + id).remove();
            reordenar();
            CalcularCostoTotal();
        }

        function reordenar() {
            var num = 1;
            $('#tabla_editable tbody tr').each(function () {
                $(this).find('td').eq(0).text(num);
                num++;
            });
        }
        function eliminarTodasFilas() {
            $('#tabla_editable tbody tr').each(function () {
                $(this).remove();
            });

        }
        function ColocarIdElegido(id_elegido) {

            $("#txtIdElegido").val(id_elegido);
        }
    </script>


    <!--*****************************************ventana modal-->
    <!--       <div id="CatalogoClientes" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                                <h4 class="modal-title">Catálogo de insumos</h4>
                            </div>
                            <div class="modal-body">
                                <div id="" class="table-responsive">
                                    <table name='TablaInsumos' id="TablaInsumos" class="tablesorter table-bordered" cellspacing="0" style="">
                                    
                                        <thead style="margin-bottom: 10px; overflow-x: scroll;" >
                                        <tr>
                                            <th style="padding-right: 89.5px;">Descripción</th>
                                            
                                            <th style="padding-right: 89.5px;">Presentación</th>
                                            
                                            <th style="padding-right: 65px;">Clasificador</th>
                                            
                                            <th style="padding-right: 20px;">Selección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$objInsumos = new Insumo();
$todos_insumos = $objInsumos->ConsultarTodo();
foreach ($todos_insumos as $ins) {
    $objClasificador = new Clasificador();
    $objClasificador->ConsultarPorID($ins->IdClasificador);
    echo "<tr>"
    . "<td>$ins->Descripcion</td>"
    . "<td>$ins->Presentacion</td>"
    . "<td>$objClasificador->Descripcion</td>"
    . "<td><center><input type='radio' name='Insumo' id='Insumo' value='$ins->ID'/></center></td></tr>";
}
echo "</table>";
?>
                                    </tbody>
                                    
                                </table>
                                </div>
                              
                                <input type="text" id="txtIdElegido" name="txtIdElegido" class="ocultar" >
       
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-Bixa" data-dismiss="modal" name="btnAgregarInsumo" id="btnAgregarInsumo">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>-->

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10" id="DivTablaInsumos" name="DivTablaInsumos">

    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">

        <div class="etiquetas2">¿Agregar a sommelier?</div>
        <div class='campos  '>
            <select class="form-control" id='cmbSommelier' name="cmbSommelier">
                <option value="0">No</option>
                <option value="1">Si</option>
            </select>
        </div>
    </div>        


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10 ocultar " id='tablaSommelier'>
        <div style="width: 100%; overflow-x: auto;">
            <table  class="table table-bordered">
                <thead class="EncabezadoTablaPersonalizada">
                    <tr>
                        <th colspan="4" style="text-align: center;">Seleccionar bebidas</th>
                    </tr>
                    <tr>
                        <th style="">Nombre de la bebida</th>
                        <th style="text-align: center;"></th>
                        <th style="">Nombre de la bebida</th>
                        <th style="text-align: center;"></th>
                    </tr>
                </thead>
                <tbody>
<?php
$objVino = new Vino();
$vinos = $objVino->ConsultarTodos();
$fila = 0;
foreach ($vinos as $v) {

    if ($fila == 2) {
        echo "<tr>";
        $fila = 0;
    }
    echo "<td>$v->Nombre</td>";
    echo "<td><center><input type='checkbox' name='vino$v->ID' id='radioMenu' value='$v->ID'></center></td>";
    if ($fila == 2) {
        echo "</tr>";
    }
    //echo "<script>alert($fila);</script>";
    $fila++;
}
?>
                </tbody>
            </table>
        </div>
    </div>



    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">

        <div class="etiquetas2">¿Es un producto compuesto?</div>
        <div class='campos  '>
            <select class="form-control" id='cmbProductoCompuesto' name="cmbProductoCompuesto">
                <option value="0">No</option>
                <option value="1">Si</option>
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
                               Tope de productos por paquete<?php
                if (!isset($_SESSION['valTope']) && (empty($_SESSION['valTope']))) {

                        echo "<div class=''><input type='text' id='txtTope'  name='txtTope'    class='form-control' value=''></div>";
                } else {
                    $valor = $_SESSION['valTope'];
                    echo "<div class=''><input type='text' id='txtTope'  name='txtTope'    class='form-control' value='$valor'></div>";
                    $_SESSION['valTope'] = null;
                }
                ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th style="">Nombre del producto</th>
                        <th style="text-align: center;">Cantidad tope de producto por paquete</th>    
                    </tr>
                </thead>
                <tbody id="tablaProductoAgregados">
                <th colspan="3"><center>No se encontraron registros</center></th>
                        
                </tbody>
            </table>
        </div>
        
        
           
               
            
    </div>






    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">

        <br>

        <button type="submit" id="btnAceptar" style="float: right" name="btnMesa" class="btn btn-Bixa btn-ms">Guardar</button>
        <a class="btn btn-Regresar"  href="F_A_ConsultarPlatillos.php">
            &larr; Listado de platillos
        </a>
        <br>


        <br>
    </div>

</form>            



<!-- Ventana Modal Para Mesas-->
<div class="modal fade" id="VMProductoCompuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- 3 divs básicos  para cada ventana modal -->

            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>AGREGAR PRODUCTOS</h4>
            </div>

            <div class="modal-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



                    <div class="etiquetas2">Seleccione el tipo de producto y de clic en buscar</div>

                    <div class='campos'>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                            <select class="form-control" id='cmbCompuesto' name="cmbCompuesto">
                                <option value="0">Platillos</option>
                                <option value="1">Bebidas</option>
                            </select>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <button type="submit" id="btnAgregarCompuesto" style="float: right" name="btnAgregarCompuesto" class="btn btn-Bixa btn-ms">Buscar</button>
                        </div>


                    </div>
                    <br><br><br>


                </div> 
                
                <div id="divConsulta">

                </div>
        



            </div>

            <div class="modal-footer">
                <button class="btn btn-Bixa" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</body>

<!--Script para consultar listado de platillos o bebidas segun la elección del usuario-->
<script>
    var tope = 0;
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
        console.log("Id Tipo: ", IdTipo);
        console.log("Id Sub: ", IdSubProducto);
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
            tabla="<th colspan='3'><center>No se encontraron registros</center></th>";
        }
        $("#tablaProductoAgregados").html(tabla);         
    }
   
</script>


<script>

    $("button[name='btnAgregarInsumo']").click(function () {
//         
        var id_insumo = $("input[name='Insumo']:checked").val();
        if (id_insumo === undefined) {
            id_insumo = "0";
        }


        $.ajax({
            url: "Validaciones_Lado_Servidor/N_MostrarInsumos_PlatilloBebida.php",
            type: 'POST',
            data: {"id_insumo": id_insumo},
            success: function (data) {
                var insumo = data;

                var separacion_insumo = insumo.split("├");
                var descripcion = separacion_insumo[0];
                var presentacion = separacion_insumo[1];
                var contenido = separacion_insumo[2];

                var boton_elegido = document.getElementById("txtIdElegido").value;

                var arreglo_id_boton = boton_elegido.split("s");


                $("#txtDescripcion" + arreglo_id_boton[1]).val(descripcion);
                $("#txtPresentacion" + arreglo_id_boton[1]).val(presentacion);
                $("#txtContenido" + arreglo_id_boton[1]).val(contenido);

                //Coloca el id del insumo en la tabla
                var id_insumo = $("input[name='Insumo']:checked").val();
                $("#txtIdDescripcion" + arreglo_id_boton[1]).val(id_insumo);



            }
        });

    });
</script>



<script>
      
    $(document).ready(function () {
        

    
        $('#TablaInsumos').DataTable();

        $('#btnAgregar').click(function () {
            AgregarFila();

        });

        $("#cmbMenu").change(function () {
            if ($(this).val() == 1) {
                $("#tablaMenus").removeClass("ocultar");
                $("#tablaMenus").addClass("mostrar");
            } else {
                $("#tablaMenus").removeClass("mostrar");
                $("#tablaMenus").addClass("ocultar");
            }
        });


        $("#cmbProductoCompuesto").change(function () {
            if ($(this).val() == 1) {
                $("#tablaProductoCompuesto").removeClass("ocultar");
                $("#tablaProductoCompuesto").addClass("mostrar");
            } else {
                $("#tablaProductoCompuesto").removeClass("mostrar");
                $("#tablaProductoCompuesto").addClass("ocultar");
            }
        });

        $("#cmbSommelier").change(function () {

            if ($(this).val() == 1) {
                $("#tablaSommelier").removeClass("ocultar");
                $("#tablaSommelier").addClass("mostrar");
            } else {
                $("#tablaSommelier").removeClass("mostrar");
                $("#tablaSommelier").addClass("ocultar");
            }
        });

        $("#cmbInsumos").change(function () {

            if ($(this).val() == 1) {

                $("#div_ProductoCompuesto").removeClass("ocultar");
                $("#div_ProductoCompuesto").addClass("mostrar");
            } else {

                $("#div_ProductoCompuesto").removeClass("mostrar");
                $("#div_ProductoCompuesto").addClass("ocultar");
            }
        });

        $("#form").validate({
            rules: {
                txtNombrePlatillo: {
                    required: true
                },
                txtDescripcionCorta: {
                    required: true

                },

                txtIVA: {
                    number: true
                },

                txtDescripcionLarga: {
                    required: true

                },

                txtPrecio: {
                    required: true,
                    number: true
                },
                archivo: {
                    required: true
                },

                archivoIco: {
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

                txtPrecio: {
                    required: "Introducir precio",
                    number: "Ingresar un valor númerico aceptable"
                },

                txtIVA: {
                    number: "Ingresar valor numérico"
                },

                archivo: {
                    required: "Seleccionar archivo"
                },

                archivoIco: {
                    required: "Seleccionar archivo"
                }
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents(".col-sm-12").addClass("has-feedback");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!element.next("span")[ 0 ]) {
                    $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                }
            },
            success: function (label, element) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!$(element).next("span")[ 0 ]) {
                    $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".col-sm-12").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".col-sm-12").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
            }
        });

    }); 

</script>


</html>
