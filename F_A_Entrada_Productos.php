<?php
include_once './Header.php';
require_once 'Clases/ConexionBD.php';
require_once 'Clases/LlenadoCombos.php';
require_once './Clases/Comanda.php';
require_once './Clases/ClientesFacturas.php';
require_once './Clases/CatalogoEstado.php';
require_once './Clases/CatalogoMunicipio.php';
require_once './Clases/ClientesFacturas.php';
require_once './Clases/Ventas.php';
require_once './Clases/TipoFactura.php';

/* Cargar los elementos de la base de datos en los select */
?>

<title>Facturación electrónica </title>
<?php


if (isset($_GET['IdCliente'])) {
    $ID = $_GET['IdCliente'];
    $objCliente = new ClientesFacturas();
    $objCliente->obtenerPorID($ID);
    echo "<input type='text' class='ocultar' id='IdClienteI' name='IdClienteI' value='$objCliente->ID'/>";
} else {
    $objCliente = new ClientesFacturas();
    $objCliente->obtenerPorID(0);
    echo "<input type='text' class='ocultar' id='IdClienteI' name='IdClienteI' value='$objCliente->ID'/>";
}
    
?>
    <form action="" method="POST" enctype="multipart/form-data" id='form'>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
                <td class="tdEncabezadoTabla">
                    <div><h4><center><label class="textoEncabezadoTabla">Inventario: Registrar entrada de productos</label></center></h4></div>
                </td>
            </table>
        </div>
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
            <table border="0" style="text-align: center;" >
                <tr>
                    <!--<td><button type="button" class="textoOpcionesMenuFacturacion"><span class="glyphicon" style="font-size:22px; color:#0000CD;"></span>Folio: 100</button></td>-->
                <td>Fecha:  <?php echo date('d/m/Y'); ?></td>
               
                <td><a href="./F_A_Registrar_Producto_Inventario.php" style="text-decoration:none; color: black;" class="nounderline"><span class="glyphicon glyphicon-plus-sign" style="font-size:22px; color:#419C67;"></span> Registrar producto</a></td>
                <td><a href="./F_A_Consultar_Productos.php" style="text-decoration:none; color: black;" class="nounderline"><span class="glyphicon glyphicon-search" style="font-size:22px; color:#9437B2;"></span> Consultar productos</a></td>
                <td><button type="button" name="btnEntradas" id="btnEntradas" class="textoOpcionesMenuFacturacion" data-toggle="modal" data-target="#CatalogoClientes" onclick=""><span class="glyphicon glyphicon-plus" style="font-size:22px; color:#0000CD;"></span> Agregar entrada</button></td>
                <td><a href="./F_A_Bitacora_Entradas_Inventario.php" style="text-decoration:none; color: black;" class="nounderline"><span class="glyphicon glyphicon-book" style="font-size:22px; color:#E69C41;"></span> Bitácora de entradas</a></td>
               
                </tr>
            </table>
         
     </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <div  class="table-responsive Comandas" style="float: left">
            <br>
            <table border='0' >
                <tr>
                    <td style="background-color:#FEFCA7; text-align: center;border-top-left-radius: 2em 0.5em;border-top-right-radius: 1em 3em;">Notas</td>
                </tr>
                <tr>
                    <td><textarea id="txtNotas" name="txtNotas" class="form-control" type="text" style="resize: none; background-color:#FEFCA7;"></textarea></td> 
                </tr>
            </table>
            <br>
            <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Proveedor</strong></td>
                </tr>
                <tr>
                    <td><select id="cmbProveedor" name="cmbProveedor" class="form-control"><option value="1">Coca-Cola</option></select</td>
                </tr>
                    
            </table>
            <br>
            <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Encargado</strong></td>
                </tr>
                <tr>
                    <td><input type="text" name="txtEncargado" id="txtEncargado" value="" class="form-control" /></td>
                </tr>
                    
            </table>
        </div>
        <br>
        <div class="table-responsive">
                <div id="DatosClientes" name="DatosClientes">
                    <table class="table table-striped">
                        <th colspan="4"><center>Entrada de insumos</center></th>
                        <tr>
                        <input type="text" id="IdClienteI" name="IdClienteI" class="ocultar" value="<?php echo $objCliente->ID; ?>"/>
                        <td id="RFC" name="RFC"><?php echo "RFC: " . $objCliente->RFC; ?></td>
                        <td id="Nombre" name="Nombre"><?php echo "Cliente: " . $objCliente->NombreCliente; ?></td>
                        <td id="Direccion" name="Direccion"><?php echo "Ubicación: " . $objCliente->Calle . " " . $objCliente->NumeroExterior . " " . $objCliente->Colonia . " " . $objCliente->Pais . " "; ?></td>
<!--                        <td style="float: right;"><button type='button' name='btnClientes' id='btnClientes' class='btn btn-Bixa'data-toggle='modal' data-target='#CatalogoClientes'onClick='' >Clientes...</button></td>-->

                        </tr>
                    </table>
                </div>
            </div>
                
    </div>
                  

            <div class="etiquetas2"></div>

            <div id="DatosClientes" name="DatosClientes" class="table-responsive ocultar">
                <table class='table table-bordered'> 
                </table>


            </div>
            <div id="CatalogoClientes" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Catálogo de clientes</h4>
                        </div>
                        <div class="modal-body">
                            <div id=""class="table-responsive">
                                <table  id="TablaClientes" class="tablesorter  table-bordered" cellspacing="0" style="">
                                
                                    <thead style="margin-bottom: 10px; overflow-x: scroll;" >
                                    <tr>
                                        <th style="padding-right: 89.5px;">Nombre</th>
                                        <th style="padding-right: 89.5px;">Descripción</th>
                                        <th style="padding-right: 89.5px;">Contenido</th>
                                        <th style="padding-right: 89.5px;">Agregar</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$objClientes = new ClientesFacturas();
$Clientes = $objClientes->obtenerTodo();
foreach ($Clientes as $C) {
    echo "<tr>"
    . "<td>$C->RFC</td>"
    . "<td>$C->NombreCliente</td>"
    . "<td>$C->Calle ", "$C->NumeroExterior ", " $C->Colonia</td>"
    . "<td><center><input type='radio' name='Cliente' id='Cliente' value='$C->ID'/></center></td></tr>";
}
?>
                                </tbody>
                                
                            </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>
            <div>

<!--                <input type="text" class="ocultar" id="IdMPagoI" name="IdMPagoI" value=""/>
                <input type="text" class="ocultar" id="IdFPagosI" name="IdFPagosI" value=""/>
                <input type="text" class="ocultar" id="NumCuentasI" name="NumCuentasI" value=""/>-->
<!--                <button  onclick="PruebaFactura();" class="btn btn-Bixa"  style="float: right" >Guardar</button>-->
                <script>
                    function AsignarValoresPost()
                    {
                        var ClienteCargado = document.getElementById("IdClienteI").value;
//                        var MetodoPago = document.getElementById("IdMPago").value;
//                        var FormasPago = document.getElementById("IdFPagos").value;
//                        var NumCuentas = document.getElementById("NumCuentas").value;

                        $("#IdClienteI").val(ClienteCargado);
                        //alert($("#IdClienteI").val());
//                        $("IdMPagoI").val(MetodoPago);
//                        //alert(MetodoPago);
//                        $("IdFPagosI").val(FormasPago);
//                        //alert(FormasPago);
//                        $("NumCuentasI").val(NumCuentas);
                        //alert(NumCuentas);

                    }
                </script>

            </div>


        </div>


       
        <!-- Sirve para validar si seleccinó alguna venta o no -->
        <input id="VentaSeleccionada" name="VentaSeleccionada" value="0" class="ocultar"/>
        <button type='button' name='btnEditar' id='btnEditar' class='ocultar btn btn-Bixa'data-toggle='modal' data-target='#Clientes' onclick="CargarDatosVentanaModal();">Editar</button>
    </form>
    <script>
        $(document).ready(function() {
            
            $('#TablaClientes').DataTable();
             //$('#TablaClientes').dataTable();
            ValidarBotonFacturar();
            //CrearPDF();
            

        });
        
        
        
        function ValidarBotonFacturar()
        {

            var ClienteCargado = document.getElementById("IdClienteI").value;
            var VentaSeleccionada = document.getElementById("VentaSeleccionada").value;

            if (ClienteCargado == 0 || VentaSeleccionada == 0)
            {
                $("#Facturar.Timbrar").attr("disabled", true);
                $("#Facturar.Guardar").attr("disabled", true);
            }
            else
            {
                 $("#Facturar.Timbrar").attr("disabled", false);
                $("#Facturar.Guardar").attr("disabled", false);
            }
        }

    </script>


    <script>

        function CargarDatosVentanaModal()
        {
            CargarIds();
            var Seleccionados = document.getElementById("txtForma").value;

            $.ajax({
                url: "./Validaciones_Lado_Servidor/N_Mostrar_Pagos.php",
                type: 'POST',
                data: {"Seleccionados": Seleccionados},
                success: function(data) {
                    $("#ModalBody").html(data);

                }
            });
            var FormaPago = document.getElementById("txtForma").value;
            var MetodoPago = document.getElementById("txtMetodo").value;
            var Cuenta = document.getElementById("Cuenta").value;

            $("#txtEdMPago").html(MetodoPago);
            $("#txtEdFPago").html(FormaPago);
            $("#txtEdCuenta").html(Cuenta);
        }


        function AplicarEditarPago()
        {
            
            $("#GuardarEd").attr("disabled", false);
            var FormaPago = $("#cmbFormaPago option:selected").text();
            var MetodoPago = $("#cmbMetodoPago option:selected").text();
            var Cuenta = document.getElementById("txtCuenta");
            var FormasTmp = [];
            FormasTmp.push($("#cmbFormaPago option:selected").val());
            //alert(FormasTmp);
            var EdFormaPago = document.getElementById("txtEdFPago").value;
            var EdMetodoPago = document.getElementById("txtEdMPago").value;
            var EdCuenta = document.getElementById("txtEdCuenta").value;

            var TmpForma = $("#cmbFormaPago option:selected").val();
            var TmpCuenta = Cuenta.value;


            if($("#cmbFormaPago option:selected").val()==1 || $("#cmbFormaPago option:selected").val() == 8)
            {
                ArreglosTemporales(TmpForma, TmpCuenta);


            if (EdFormaPago == "")
                {
                    $("#txtEdFPago").html(FormaPago);
                }
                else
                {
                    EdFormaPago = EdFormaPago + "," + FormaPago;
                    $("#txtEdFPago").html(EdFormaPago);

                }
            

            if (MetodoPago != "Ninguno")
            {
                if (EdMetodoPago == "")
                {
                    $("#txtEdMPago").html(MetodoPago);
                }
                else
                {
                    $("#txtEdMPago").html(EdMetodoPago);

                }
            }

            if (Cuenta.className != "ocultar form-control")
            {
                if (EdCuenta == "")
                {

                    $("#txtEdCuenta").html(Cuenta.value);

                }
                else
                {
                    EdCuenta = EdCuenta + "," + Cuenta.value;
                    $("#txtEdCuenta").html(EdCuenta);
                }
            }
            }
            
            else
            {
                //Valida si es número, si no está vacía la caja de texto y si la longitus es de 4 para agregar el número de cuenta
                if( Cuenta.value.length>0 && isNaN(Cuenta.value)==false && Cuenta.value.length==4 )
                {
                    ArreglosTemporales(TmpForma, TmpCuenta);


                if (EdFormaPago == "")
                    {
                        $("#txtEdFPago").html(FormaPago);
                    }
                    else
                    {
                        EdFormaPago = EdFormaPago + "," + FormaPago;
                        $("#txtEdFPago").html(EdFormaPago);

                    }


                    if (MetodoPago != "Ninguno")
                    {
                        if (EdMetodoPago == "")
                        {
                            $("#txtEdMPago").html(MetodoPago);
                        }
                        else
                        {
                            $("#txtEdMPago").html(EdMetodoPago);

                        }
                    }

                    if (Cuenta.className != "ocultar form-control")
                    {
                        if (EdCuenta == "")
                        {

                            $("#txtEdCuenta").html(Cuenta.value);

                        }
                        else
                        {
                            EdCuenta = EdCuenta + "," + Cuenta.value;
                            $("#txtEdCuenta").html(EdCuenta);
                        }
                    }
                }
                else
                {
                    Cuenta.focus();
                    Cuenta.title = "Error";
                    
                }
            
            }
            $("#txtCuenta").val("");
        }


        
        function CargarIds()
        {
            var IdMPago = document.getElementById("IdFPagos").value;
            var Cuentas = document.getElementById("NumCuentas").value;
            
            $("#ArregloEditadoPagos").val(IdMPago);
            $("#ArregloEditadoCuentas").val(Cuentas);
            
            
        }


    </script>

    <script>



        $("#cmbCliente").change(function() {
            if ($(this).val() != 0) {
                $("#DatosClientes").removeClass("ocultar");
                $("#DatosClientes").addClass("mostrar");
            }
            else {
                $("#DatosClientes").removeClass("mostrar");
                $("#DatosClientes").addClass("ocultar");
            }
        });



        $("input[name='Cliente']").click(function() {

            var id_cliente = $("input[name='Cliente']:checked").val();
            $("#IdClienteI").val(id_cliente);
            ValidarBotonFacturar();
            $.ajax({
                url: "js/DatosCliente/getInformacionCliente.php",
                type: 'POST',
                data: {"id_cliente": id_cliente},
                success: function(data) {
                    var Div = document.getElementById("DatosClientes");
                    Div.className = "table-responsive mostrar";
                    $("#DatosClientes").html(data);

                }
            });



        });


        //$("input.active").click(function () {
        function MostrarConsumo()
        {
            
            var IDS = [];
            var TipoFactura = $("#TipoFactura").val();
            
            
            if(TipoFactura == 3)
            {
                $.ajax({
                url: "./Validaciones_Lado_Servidor/N_ClienteGlobal.php",
                type: 'POST',
                success: function(data) {
                    var Div = document.getElementById("DatosClientes");
                    Div.className = "table-responsive mostrar";
                    $("#DatosClientes").html(data);

                }
            });
            }
            
            $(".Comandas input[type=checkbox]").each(function() {

                if (this.checked) {
                    $("#VentaSeleccionada").val(1);
                    if($(this).val()>0)
                    {
                        IDS.push($(this).val());
                        $("#IdVentas").val(IDS);
                    }
                }

            });
            if (IDS.length == 0)
            {
                IDS.push(0);
                $("#VentaSeleccionada").val(0);
                $("#IdVentas").val(IDS);
            }

            $.ajax({
                url: "./Validaciones_Lado_Servidor/N_Mostrar_Consumo.php",
                type: "POST",
                data: {"IDS": IDS, "TipoFactura": TipoFactura},
                success: function(data) {
                    $("#Comandas").html(data);

                }
            });
            ValidarBotonFacturar();
        }

        //});

    </script>




</form>                
</body>

<script>





//    $("#form").validate({
//        rules: {
//            txtFolioFactura: {
//                required: true
//            },
////                                        cboxCliente:{
////                                            required: true
////                                        },
////                                        cboxFormaPago:{
////                                            required: true
////                                        },
////                                        cboxMetodoPago:{
////                                            required: true,
////                                        }
//            txtIva: {
//                required: true,
//            }
//
//        },
//        messages: {
//            txtFolioFactura: {
//                required: "Es necesario ingresar un folio"
//            },
//            cboxCliente: {
//                required: "Seleccionar nombre del cliente"
//            },
//            cboxFormaPago: {
//                required: "Seleccionar forma de pago"
//            },
//            cboxMetodoPago: {
//                required: "Seleccionar método de pago"
//            },
//            txtIva: {
//                required: "Seleccionar forma de pago"
//            }
//
//
//        },
//        errorElement: "em",
//        errorPlacement: function(error, element) {
//            // Add the `help-block` class to the error element
//            error.addClass("help-block");
//
//            // Add `has-feedback` class to the parent div.form-group
//            // in order to add icons to inputs
//            element.parents(".campos").addClass("has-feedback");
//
//            if (element.prop("type") === "checkbox") {
//                error.insertAfter(element.parent("label"));
//            } else {
//                error.insertAfter(element);
//            }
//
//            // Add the span element, if doesn't exists, and apply the icon classes to it.
//            if (!element.next("span")[ 0 ]) {
//                $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
//            }
//        },
//        success: function(label, element) {
//            // Add the span element, if doesn't exists, and apply the icon classes to it.
//            if (!$(element).next("span")[ 0 ]) {
//                $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
//            }
//        },
//        highlight: function(element, errorClass, validClass) {
//            $(element).parents(".campos").addClass("has-error").removeClass("has-success");
//            $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
//        },
//        unhighlight: function(element, errorClass, validClass) {
//            $(element).parents(".campos").addClass("has-success").removeClass("has-error");
//            $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
//        }
//    });



</script>


</html>