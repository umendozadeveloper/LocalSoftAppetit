<?php

require_once 'Clases/ConexionBD.php';
require_once './Clases/Comanda.php';
require_once './Clases/ClientesFacturas.php';
require_once './Clases/CatalogoEstado.php';
require_once './Clases/CatalogoMunicipio.php';
require_once './Clases/ClientesFacturas.php';
require_once './Clases/Ventas.php';
require_once './Clases/Facturas.php';
require_once './Clases/TipoFactura.php';
require_once './Clases/VentasFacturadas.php';
include_once './Header.php';

/* Cargar los elementos de la base de datos en los select */
?>
<title>Facturación electrónica </title>
<?php
if (!empty($_SESSION['msjSelloDigital'])) {
    echo "<script>swal('" . $_SESSION['titulo'] . "','" . $_SESSION['msjSelloDigital'][0] . "','" . $_SESSION['tipo'] . "');</script>";
/*     * ***Limpio variables de sesion*** */
    $_SESSION['msjSelloDigital'] = null;
    unset($_SESSION['msjSelloDigital']);
    $_SESSION['titulo'] = null;
    unset($_SESSION['titulo']);
    $_SESSION['tipo'] = null;
    unset($_SESSION['tipo']);
}
if (isset($_GET['IdFactura'])) {
    $ID = $_GET['IdFactura'];
    $objFactura = new Facturas();
    $objFactura->ObtenerPorId($ID);
    if($objFactura->IdStatus != 1)
    {
        echo $objFactura->IdStatus;
        echo "<script>window.location='F_A_ConsultarFacturas.php';</script>";
        //header("Location: F_A_ConsultarFacturas.php");
    }
    
    //echo "<input type='text' class='ocultar' id='IdClienteI' name='IdClienteI' value='$objCliente->ID'/>";
} else {
    echo "<script>window.location='F_A_ConsultarFacturas.php';</script>";
    //header("Location: F_A_ConsultarFacturas.php");
}





?>
<form action="Validaciones_Lado_Servidor/N_Validar_EditarFactura.php" method="POST" enctype="multipart/form-data" id='form'>
        <?php 
        echo "<input type='text' class='ocultar' name='IdFactura' id='IdFactura' value='$objFactura->ID'/>";
        ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
            <table border="0" style="text-align: center;" >
                <tr>
                    <!--<td><button type="button" class="textoOpcionesMenuFacturacion"><span class="glyphicon" style="font-size:22px; color:#0000CD;"></span>Folio: 100</button></td>-->
                <td>Tipo de Factura
                    <select id="TipoFactura" name="TipoFactura" onclick="MostrarConsumo();">
                        
                        <?php 
                        $objTipoFactura = new TipoFactura();
                        $Tipos = array();
                        $Tipos = $objTipoFactura->ObtenerTodo();
                        foreach($Tipos as $T)
                        {
                            if($objFactura->IdTipoFactura == $T->ID)
                            {
                                echo "<option value='$T->ID' selected>$T->Nombre</option>";
                            }
                            else
                            {
                                echo "<option value='$T->ID'>$T->Nombre</option>";
                            }
                        }
                        
                        ?>

                    </select>
                </td>
                <td><button type="button" onclick="RedirigirNuevo();" class="textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-file" style="font-size:22px; color:#0000CD;"></span>Nuevo</button></td>
                <td><button value="Guardar" id="Facturar" name="Facturar" onclick="AsignarValoresPost();" class="Guardar textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-floppy-disk" style="font-size:22px; color:#4B0082;"></span> Guardar</button></td>
                <td><button value="Timbrar" id="Facturar" name="Facturar" onclick="AsignarValoresPost();" class="Timbrar textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-qrcode" style="font-size:22px; color:#4B0082;"></span> Timbrar</button></td>
                <td><button type="button" onclick="Eliminar(<?php echo $objFactura->ID; ?>);" class="textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-remove" style="font-size:22px; color:red;"></span> Eliminar</button></td>
                <td><button type="button" class="textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-print" style="font-size:22px; color:#008080;"></span> Imprimir</button></td>
                <td><button type="button" class="textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-envelope" style="font-size:22px; color:#DAA520;"></span> Enviar</button></td>
                </tr>
            </table>
        </div>    
<script>
        
       function RedirigirNuevo()
       {
        window.location = "F_A_FacturasFiscales.php";
    }
        
        </script>
    <script>
    
        
function Eliminar(ID)
{
    var IdFactura = ID;
    swal({
  title: "¿Desea eliminar la factura?",
  text: "Los tickets de la factura estarán disponibles para facturar",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
},
function(){
    swal({
  title: "Espere",
  text: "Eliminando factura...",
  showConfirmButton: false
});
  setTimeout(function(){
    $.ajax({
            url: "./Validaciones_Lado_Servidor/N_EliminarFactura.php",
            type: "POST",
            data: {"IdFactura": IdFactura},
            success: function () {
                swal("Correcto!", "La factura fue eliminada!", "success");
                swal({
  title: "Correcto!",
  text: "La factura fue eliminada!",
  type: "success",
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Ok"
},
function(){
  location.reload();
});
                
            }
        });
  }, 2000);
  
});

}
    
    </script>
        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">  
                <tr>
                    <td><div class="etiquetas2">Folio factura</div></td>
                    <td><div><input type='text' id='txtFolioFactura'  name='txtFolioFactura' class='form-control' value='<?php ?>'></div>100</td>
                </tr>

            </table>
            <div class="etiquetas2">Folio factura: 100</div>
        </div>-->

        <div class=" ocultar col-xs-12 col-sm-12  col-md-12 col-lg-offset-0 col-lg-5">

            <table class="table-hover">
                <tr>
                    <td><div class="etiquetas2">Fecha y hora</div></td>
                    <td><div><input type='text' readonly="readonly" id='txtFechaYhora'  name='txtFechaYhora' class='form-control' value='<?php
$hora = date("H:i:s");
$fecha = date("Y-m-d");
echo $fecha.= 'T' . $hora;
?>'>
                        </div></td>
                </tr>


            </table>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">

            <br>
            <div  class="table-responsive Comandas" style="float: left">
                <div class="table-bordered">
                    <center> Tickets
                        <select id="cmbTickets" name="cmbTickets">
                            <option value="1">Todas</option>
                            <option value="2">Esta semana</option>
                            <option value="3">Este mes</option>
                            <option value="4">Hoy</option>
                        </select>
                        Todos <input type="checkbox" class="Todos" id="SelTodos" name="SelTodos" value="" onclick="MostrarTodosTickets()"/>
                    </center>
                    <script>
                    function MostrarTodosTickets()
                    {
                        
                        if($("#SelTodos").prop("checked"))
                        {
                        $(".Comandas input[type=checkbox]").each(function() {
                            $(".Comandas input[type=checkbox]").prop("checked", "checked");
                        });
                        MostrarConsumo();
                        }
                        else
                        {
                            $(".Comandas input[type=checkbox]").each(function() {
                            $(".Comandas input[type=checkbox]").prop("checked", "");
                            
                            });
                            MostrarConsumo();
                        }
                        
                        
                    }
                    </script>
                </div>
                <div id="ComandasDiv" name="ComandasDiv" style="overflow-y: scroll; height: auto; max-height:300px;">
                    <table class="table table-bordered">
                        <thead>


                            <tr>
                                <th>Fecha</th>
                                <th>Comanda</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <input type="text" class="ocultar" id="IdVentas" name="IdVentas"/>

<?php
$objVentas = new Ventas();
$Ventas = $objVentas->ObtenerTodosNoFacturadosPorFactura($objFactura->ID);
$objComanda = new Comanda();
$objVentasFacturadas = new VentasFacturadas();
foreach ($Ventas as $Com) {
    $Com->Fecha = $Com->Fecha->format('Y-m-d');
    $objComanda->ConsultarPorID($Com->IdComanda);
    if($objVentasFacturadas->ObtenerPorVenta($Com->ID))
    {
        echo "<tr class=''><td>$Com->Fecha</td><td>$objComanda->Folio</td><td><center><input onclick='MostrarConsumo();'class='active' name='chkComanda$Com->ID' type='checkbox' value='$Com->ID' checked/></center></td></tr>";
    }
 else {
        echo "<tr class=''><td>$Com->Fecha</td><td>$objComanda->Folio</td><td><center><input onclick='MostrarConsumo();'class='active' name='chkComanda$Com->ID' type='checkbox' value='$Com->ID'/></center></td></tr>";
    }
}
?>
                    </table>
                </div>
            </div>
        
            <script>
                $("#cmbTickets").change(function() {
                    var Filtro = this.value;
                    $.ajax({
                        url: "./Validaciones_Lado_Servidor/N_Mostrar_Tickets.php",
                        type: 'POST',
                        data: {"Filtro": Filtro},
                        success: function(data) {
                            $("#ComandasDiv").html(data);

                        }
                    });
                });

            </script>
            <div class="table-responsive">
                <div id="DatosClientes" name="DatosClientes">
                    <table class="table table-striped">
                        <th colspan="4"><center>Datos del cliente</center></th>
                        <tr>
                            <?php 
                            $objCliente = new ClientesFacturas();
                            $objCliente->obtenerPorID($objFactura->IdCliente);
                            ?>
                        <input type="text" id="IdClienteI" name="IdClienteI" class="ocultar" value="<?php echo $objCliente->ID; ?>"/>
                        <td id="RFC" name="RFC"><?php echo "RFC: " . $objCliente->RFC; ?></td>
                        <td id="Nombre" name="Nombre"><?php echo "Cliente: " . $objCliente->NombreCliente; ?></td>
                        <td id="Direccion" name="Direccion"><?php echo "Ubicación: " . $objCliente->Calle . " " . $objCliente->NumeroExterior . " " . $objCliente->Colonia . " " . $objCliente->Pais . " "; ?></td>
                        <td style="float: right;"><button type='button' name='btnClientes' id='btnClientes' class='btn btn-Bixa'data-toggle='modal' data-target='#CatalogoClientes'onClick='' >Clientes...</button></td>

                        </tr>
                    </table>
                </div>
            </div>
                <div id="Comandas"class="table-responsive">

                    <table class="table table-striped" style="text-align: center">
                        <th><center>Descripción</center></th>
                        <th><center></center></th>
                        <tr>
                            <td></td>
                            <td></td>
                        <tr>
                    </table>
                </div>
            

            <div class="etiquetas2"></div>

            <!--<div id="DatosClientes" name="DatosClientes" class="table-responsive ocultar">
                <table class='table table-bordered'> 
                </table>


            </div>-->
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
                                        <th style="padding-right: 89.5px;">RFC</th>
                                        <th style="padding-right: 89.5px;">Nombre</th>
                                        <th style="padding-right: 89.5px;">Domicilio</th>
                                        <th style="padding-right: 89.5px;">Facturar</th>
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

                <input type="text" class="ocultar" id="IdMPagoI" name="IdMPagoI" value=""/>
                <input type="text" class="ocultar" id="IdFPagosI" name="IdFPagosI" value=""/>
                <input type="text" class="ocultar" id="NumCuentasI" name="NumCuentasI" value=""/>
                <!--<button  onclick="PruebaFactura();" class="btn btn-Bixa"  style="float: right" >Guardar</button>-->
                <script>
                    function AsignarValoresPost()
                    {
                        var ClienteCargado = document.getElementById("IdClienteI").value;
                        var MetodoPago = document.getElementById("IdMPago").value;
                        var FormasPago = document.getElementById("IdFPagos").value;
                        var NumCuentas = document.getElementById("NumCuentas").value;

                        $("#IdClienteI").val(ClienteCargado);
                        //alert($("#IdClienteI").val());
                        $("IdMPagoI").val(MetodoPago);
                        //alert(MetodoPago);
                        $("IdFPagosI").val(FormasPago);
                        //alert(FormasPago);
                        $("NumCuentasI").val(NumCuentas);
                        //alert(NumCuentas);

                    }
                </script>

            </div>


        </div>


        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Datos de pago</h4>
                    </div>
                    <div class="modal-body">
                        <div id="ModalBody" name="ModalBody">
                            <table class="table">
                                <thead>
                                <th>
                                </th>
                                <th>
                                </th>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Método de Pago</td>
                                        <td>
                                            <div id="MPago" name="MPago">
                                                <select class="input-group" name="cmbMetodoPago" id="cmbMetodoPago">

                                                </select>
                                            </div>
                                        </td>

                                    <tr>
                                        <td>Forma de Pago</td>
                                        <td>
                                            </select>
                                            <div id="FPago" name="FPago">
                                                <select class="input-group" name="cmbFormaPago" id="cmbFormaPago">
                                                </select>

                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Número de cuenta</td>
                                        <td>
                                            <input maxlength="4" type="text" class="ocultar form-control" type="text"id="txtCuenta" name="txtCuenta"/>
                                            

                                        </td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td><button type="button" class="btn btn-Bixa" id="Aplicar" name="Aplicar" onclick="AplicarEditarPago();">Aplicar</button></td>

                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="table">
                            <tr>
                                <td>Método de Pago</td>
                                <td><textarea readonly="" class="form-control"type="text" id="txtEdMPago" name="txtEdMPago" style="resize: none" ></textarea></td>

                            </tr>
                            <tr>
                            <input class="ocultar" id="ArregloEditadoPagos" name="ArregloEditadoPagos" value=""/>
                            <td>Forma de Pago</td>
                            <td><textarea readonly="" class="form-control"type="text" id="txtEdFPago" name="txtEdFPago" style="resize: none"></textarea></td>

                            </tr>
                            <tr>
                            <input class="ocultar" id="ArregloEditadoCuentas" name="ArregloEditadoCuentas" value=""/>
                            <td>Números de cuenta</td>
                            <td> <textarea readonly=""class="form-control" type="text"id="txtEdCuenta" name="txtEdCuenta" style="resize: none"></textarea></td>

                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-Bixa" id="BorrarMetodo" name="BorrarMetodo"onclick="Borrar();">Borrar Forma de Pago</button>
                        <button type="button" class="btn btn-Bixa" id="GuardarEd" name="GuardarEd"onclick="GuardarFormasPagoEditados();">Guardar Formas de Pago</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <input type="text" name="ArregloCuentas" id="ArregloCuentas" value="" class="ocultar"/>
                    <input type="text" name="ArregloFormas" id="ArregloFormas" value="" class="ocultar"/>
                    <input type="text" name="ArregloVentas" id="ArregloVentas" value="" class="ocultar"/>
                    <input type="text" name="ClienteFactura" id="ClienteFactura" value="<?php echo $objCliente->ID; ?>" class="ocultar"/>

                </div>

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
            MostrarConsumo();
            ValidarBotonFacturar();
            CrearPDF();
            
            

        });
        
        function CrearPDF()
            {
                
                var Factura = document.getElementById("ArchivoFactura").value;
                var TipoFactura = document.getElementById("TipoFacturaPDF").value;
                
                alert(Factura);
                if(Factura.length > 0)
                {
                    alert('Entró');
                              $.ajax({
                                url: "./Validaciones_Lado_Servidor/N_GenerarPDF.php",
                                type: 'POST',
                                data: {"Factura": Factura, "TipoFactura": TipoFactura},
                                success: function(data) {
                                alert('Correcto');

                }
            });
                }
                else
                {
                    alert('No Entró');
                }
            }
        
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


        function GuardarFormasPagoEditados()
        {

            var EdFormaPago = document.getElementById("txtEdFPago").value;
            var EdMetodoPago = document.getElementById("txtEdMPago").value;
            var EdCuenta = document.getElementById("txtEdCuenta").value;
            
            var ArregloPagos = document.getElementById("ArregloEditadoPagos").value;
            var ArregloCuentas = document.getElementById("ArregloEditadoCuentas").value;
            
            

            $("#txtMetodo").html(EdMetodoPago);
            $("#txtForma").html(EdFormaPago);
            $("#Cuenta").html(EdCuenta);
            
            
            $("#IdFPagos").val(ArregloPagos);
            $("#NumCuentas").val(ArregloCuentas);
            
            




        }
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



        function MostrartxtCuenta()
        {
            var Opciones = document.getElementById("txtCuenta");

            switch ($("#cmbFormaPago option:selected").text()) {

                case "Efectivo":
                    Opciones.className = "ocultar form-control";
                    break;
                case "Vales de despensa":
                    Opciones.className = "ocultar form-control";
                    break;
                case "Por definir":
                    Opciones.className = "ocultar form-control";
                    break;

                default:
                    Opciones.className = "mostrar form-control input-group";
                    break;
            }

        }

        function Borrar()
        {


            $("#txtEdFPago").html("");
            $("#txtEdMPago").html("");
            $("#txtEdCuenta").html("");
            $("#ArregloEditadoPagos").val("");
            $("#ArregloEditadoCuentas").val("");
            $("#GuardarEd").attr("disabled", true);

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

        /*
         * Método para Guardar de manera temporal los Ids y cuentas de las formas de pago que se agreguen
         * @param {type} FormaPago
         * @param {type} Cuenta
         * @returns {undefined}
         */
        function ArreglosTemporales(FormaPago, Cuenta)
        {
            var FormasPago = document.getElementById("ArregloEditadoPagos").value;
            var Cuentas = document.getElementById("ArregloEditadoCuentas").value;
            
            
            if (FormasPago == "")
            {
                //alert('Entró y la forma de pago es :' + FormaPago);
                $("#ArregloEditadoPagos").val(FormaPago);
            }
            else
            {
                //alert('No Entró y la forma de pago es :'+ $("#ArregloEditadoPagos").val() + ' Adicionando ' + FormaPago);
                $("#ArregloEditadoPagos").val($("#ArregloEditadoPagos").val() + ',' + FormaPago);

            }
            if (Cuenta != "")
            {
                
                if (Cuentas == "")
                {
                    $("#ArregloEditadoCuentas").val(Cuenta);
                }
                else
                {
                    $("#ArregloEditadoCuentas").val($("#ArregloEditadoCuentas").val() + ',' + Cuenta);

                }
            }
            
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
            var IdFactura = $("#IdFactura").val();
            
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
                data: {"IDS": IDS, "TipoFactura": TipoFactura, "Editada":0, "IdFactura": IdFactura},
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





    $("#form").validate({
        rules: {
            txtFolioFactura: {
                required: true
            },
//                                        cboxCliente:{
//                                            required: true
//                                        },
//                                        cboxFormaPago:{
//                                            required: true
//                                        },
//                                        cboxMetodoPago:{
//                                            required: true,
//                                        }
            txtIva: {
                required: true,
            }

        },
        messages: {
            txtFolioFactura: {
                required: "Es necesario ingresar un folio"
            },
            cboxCliente: {
                required: "Seleccionar nombre del cliente"
            },
            cboxFormaPago: {
                required: "Seleccionar forma de pago"
            },
            cboxMetodoPago: {
                required: "Seleccionar método de pago"
            },
            txtIva: {
                required: "Seleccionar forma de pago"
            }


        },
        errorElement: "em",
        errorPlacement: function(error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents(".campos").addClass("has-feedback");

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
        success: function(label, element) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if (!$(element).next("span")[ 0 ]) {
                $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).parents(".campos").addClass("has-error").removeClass("has-success");
            $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents(".campos").addClass("has-success").removeClass("has-error");
            $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
        }
    });



</script>

<script>

    $("#cmbEstado").change(function() {
        var estado = document.getElementById("cmbEstado").value;
        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Consulta_Estado_Municipio.php",
            type: 'POST',
            data: {"estado": estado},
            success: function(data) {
                $("#cmbMunicipio").html(data);

            }
        });

    });

    $("#cmbEstado").ready(function() {
        var estado = document.getElementById("cmbEstado").value;
        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Consulta_Estado_Municipio.php",
            type: 'POST',
            data: {"estado": estado},
            success: function(data) {
                $("#cmbMunicipio").html(data);

            }
        });

    });
</script>
</html>