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
        
        require_once './Clases/CatalogoFormaPago.php';
        require_once './Clases/CatalogoMetodoPago.php';
        require_once './Clases/Ventas.php';
        
        
        if (isset($_POST['btnComanda']) || isset($_GET['idComanda'])) {
            if (isset($_POST['btnComanda'])) {
                $idComanda = $_POST['btnComanda'];
            } else {
                $idComanda = $_GET['idComanda'];
            }
        } else {
            header("Location: F_A_ConsultarComandas.php");
        }
        
        
        

        //require_once './ComprobarSesion.php';
        require 'Header.php';
        ?>
<?php
//$_SESSION['VentaId']= NULL;
        if(isset($_SESSION['VentaId'])){ 
            $IdVenta = $_SESSION['VentaId']; 
            echo "<input type='text' class='ocultar' id='VentaId' name='VentaId' value='$IdVenta' />";
            }  
            $_SESSION['VentaId']= NULL;
         ?>
        <script src="js/comandaDinamica.js" type="text/javascript"></script>
        <title>Consultar comanda a detalle</title>
    


    </head>
    <body style="background-color: #fff">



<?php
if (!empty($_SESSION['alertaDetalle'])) {
    echo "<script>swal('" . $_SESSION['alertaDetalle'][0] . "');</script>";
    $_SESSION['alertaDetalle'] = null;
}
if (!empty($_SESSION['msjEstadoComanda'])) {
    $mensajes = $_SESSION['msjEstadoComanda'];
    $imprimir = "<script>swal('Edición Correcta','";
    foreach ($mensajes as $m) {
        $imprimir .= "-$m\\n";
    }
    $imprimir.= "','success');</script>";
    echo $imprimir;
    $_SESSION['msjEstadoComanda'] = null;
}






//require './PartesHTML/LogoBIXA_Barra.php';
include_once './Clases/Comanda.php';
include_once './Clases/Mesa.php';
include_once './Clases/ComandaPlatillos.php';
include_once './Clases/ComandaVinos.php';
include_once './Clases/ComandaEstados.php';



//$_SESSION['idComanda']=$idComanda;
?>



        <form action="Validaciones_Lado_Servidor/N_Detalle_Comanda.php" method="POST" id="form">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <table class="encabezadoTabla">
                    <td class="tdEncabezadoTabla">
                        <div><h4><center><label class="textoEncabezadoTabla">Comanda a detalle</label></center></h4></div>
                    </td>
                </table>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">

                <table>
<?php
$objComanda = new Comanda();
//echo "<script>alert('$idComanda');</script>";
//$comandaUMR = $objComanda->ConsultarPorID($idComanda);
$objComanda->ConsultarPorID($idComanda);
/* foreach ($comandaUMR as $co) {

  } */
echo "<tr>";
echo "<td class='ocultar'><input name='txtComanda' value='$objComanda->Id'></td>";
echo "<td><div class='etiquetas2'>Folio de la comanda</div></td>";
echo "<td><center>$objComanda->Folio</center></td>";
echo "</tr>";



echo "<tr>";
echo "<td><div class='etiquetas2'>Estado</div></td>";
echo "<td ><center>";
if($objComanda->Clave == 'Finalizada')
{
    echo "<button disabled='' onclick='CargarCajasPagada();'type='button'class='btn btn-default btn-ms' role='button' data-toggle='modal' data-target='#vmCambiarEstado'>";
    echo "$objComanda->Clave";
    echo "</button></center></td></tr>";
}else{
    echo "<button onclick='CargarCajasPagada();'type='button'class='btn btn-default btn-ms' role='button' data-toggle='modal' data-target='#vmCambiarEstado'>";
    echo "$objComanda->Clave";
    echo "</button></center></td></tr>";
}


echo "<tr><td class='etiquetas2'>Importe Total</td>";
echo "<td class='detalle'>$" . $objComanda->Detalle_Tres($idComanda) . "</td></tr>";
?>
                </table>
            </div>

                    <?php
                    $objMesa = new Mesa();
                    $mesas = $objMesa->ConsultarMesaPorIDComanda($idComanda);
                    //echo "Tamaño del array Mesas:".count($mesas)."<br>";
                    $numFilas = ((count($mesas) + 1) * 2) / 2;
                    ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
                <table id="myTable" class="tablesorter table-bordered tablaConsulta table-responsive" >
                    <thead style="margin-bottom: 10px;">
                        <tr>
                            <th colspan='3'><div class="etiquetas2"><center>Mesas utilizadas</center></div></th>
                
                    </tr>
                    </thead>
                    <tbody>
            <?php
            echo "<tr>";
            echo "<td class='etiquetas2 ' >Mesa</td>";
            echo "<td class='etiquetas2 ' >Ubicación</td>";
            echo "<td class='etiquetas2' >Mesa<br>Principal</td>";
            echo "</tr>";
            foreach ($mesas as $mComanda) {
                echo "<tr>";
                echo "<td class='detalle'>" . $mComanda->Numero . "</td>";
                echo "<td class='detalle'>" . $mComanda->Ubicacion . "</td>";
                if ($mComanda->MesaPrincipal == 1)
                    echo "<td ><center><img src=img/AcceptBIXA.png></center></td>";
                else
                    echo "<td><center></center></td>";
                echo "</tr>";
            }
            ?>
                    </tbody>
                </table>
            </div>

                        <?php
                        $objComandaPlatillos = new ComandaPlatillos();
                        $comandaPlatillos = $objComandaPlatillos->ConsultarPorIdComanda($idComanda);
                        ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <br>

                <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">

                        <tr>
                            <th><div class="centrar"><label>Nombre de platillo</label></div></th>
                    <th ><div class="centrar"><label>Cantidad</div></label></th>
                    <th><div class="centrar"><label>Precio</div></label></th>
                    <th><div class="centrar"><label>Opciones</div></label></th>

                    </tr>
                    </thead>


                    <tbody>
            <?php
            foreach ($comandaPlatillos as $cPlatillos) {
                echo "<tr>";
                if ($cPlatillos->EstadoPedidoDescripcion == "Producto pedido") {
                    echo "<td><img src='img/Time.png'><a href='#' data-id='" . $cPlatillos->IdPlatillo . "' class='detallePlatilloVM noboton btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalPlatilloDetalle'>$cPlatillos->NombrePlatillo</a>";
                    if (strlen($cPlatillos->Comentarios) > 0) {
                        echo "<button type='button' style='float:right;' data-id='" . $cPlatillos->Comentarios . "' class='botonComentarios btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalComentarios'><img src='img/info.png'></button>";
                    }
                    echo "</td>";
                } else {
                    echo "<td><a href='#' data-id='" . $cPlatillos->IdPlatillo . "' class='detallePlatilloVM noboton btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalPlatilloDetalle'>$cPlatillos->NombrePlatillo</a></td>";
                }
                if ($cPlatillos->EstadoPedidoDescripcion == "Producto pedido" && $objComanda->IdEstado == 1) {
                    echo "<td ><center>"
                    . "       <button type='button' class='btn btn-Bixa btnComandaDetalle'  name='btnMenosP' value='$cPlatillos->ID'>"
                    . "<img src='img/menos2.png'>"
                    . "</button>"
                    . "<input type='text' name='txtNumPlatillos$cPlatillos->ID'  id='txtNumPlatillos$cPlatillos->ID' class='editarComandaP_and_V' readonly='readonly' value='$cPlatillos->Cantidad'>"
                    . "<button type='button' class='btn btn-Bixa btnComandaDetalle'  name='btnMasP' value='$cPlatillos->ID'>"
                    . "<img src='img/mas2.png'>"
                    . "</button>"
                    . "</center>"
                    . "</td>";
                } else {
                    echo "<td><center>$cPlatillos->Cantidad</td>";
                }
                echo "<td><center>$$cPlatillos->Precio</td>";
                if ($cPlatillos->EstadoPedidoDescripcion == "Producto pedido" && $objComanda->IdEstado == 1) {
                    echo "<td><center>"
                    . "<button type='button' class='btn btn-default btn-xs' value=$cPlatillos->ID name='btnComandaPGuardar' data-placement='left' data-toggle='tooltip' title='Guardar cantidad editada del producto'><img src='img/Save.png'></button>"
                    . "<button type='button' class='btn btn-default btn-xs' value=$cPlatillos->ID name='btnComandaP' data-placement='left' data-toggle='tooltip' title='Eliminar producto de la comanda' ><img src='img/Delete.png'></button>"
                    . "<button type='button' class='btn btn-default btn-xs' value=$cPlatillos->ID name='btnComandaPListo' data-placement='left' data-toggle='tooltip' title='Marcar producto como servido' ><img src='img/AcceptBIXA.png'></button>"
                    . "</td>";
                } else {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            ?>
                    </tbody>
                </table>

            </div>



            <!--Consulto detalle 5 (Vinos pedidos/servidos)-->
                        <?php
                        $objComandaVinos = new ComandaVinos();
                        $comandaVinos = $objComandaVinos->ConsultarPorIdComanda($idComanda);
                        ?>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <br>

                <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">

                        <tr>
                            <th><div class="centrar"><label>Nombre de vino</label></div></th>
                    <th><div class="centrar"><label>Cantidad botellas</div></label></th>
                    <th><div class="centrar"><label>Precio botella</div></label></th>
                    <th><div class="centrar"><label>Cantidad copas</div></label></th>
                    <th><div class="centrar"><label>Precio copa</div></label></th>
                    <th><div class="centrar"><label>Opciones</div></label></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($comandaVinos as $cVinos) {
                            echo "<tr>";
                            if ($cVinos->EstadoPedidoDescripcion == "Producto pedido") {
                                echo "<td><img src='img/Time.png'><a href='#' data-id='" . $cVinos->IdVino . "' class='detalleVinoVM noboton btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalVinoDetalle'>$cVinos->NombreVino</a>";
                                if (strlen($cVinos->Comentarios) > 0) {
                                    echo "<button type='button' style='float:right;' data-id='" . $cVinos->Comentarios . "' class='botonComentarios btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalComentarios'><img src='img/info.png'></button>";
                                }
                                echo "</td>";
                            } else {
                                echo "<td><a href='#' data-id='" . $cVinos->IdVino . "' class='detalleVinoVM noboton btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalVinoDetalle'>$cVinos->NombreVino</a></td>";
                            }
                            if ($cVinos->EstadoPedidoDescripcion == "Producto pedido" && $objComanda->IdEstado == 1) {
                                echo "<td><center>"
                                . "       <button type='button' class='btn btn-Bixa btnComandaDetalle'  name='btnMenosBotella' value='$cVinos->ID'>"
                                . "<img src='img/menos2.png'>"
                                . "</button>"
                                . "<input type='text' name='txtNumBotellas$cVinos->ID' id='txtNumBotellas$cVinos->ID' class='editarComandaP_and_V' readonly='readonly' value='$cVinos->CantidadBotellas'>"
                                . "<button type='button' class='btn btn-Bixa btnComandaDetalle'  name='btnMasBotella' value='$cVinos->ID'>"
                                . "<img src='img/mas2.png'>"
                                . "</button>"
                                . "</center>"
                                . "</td>";
                            } else {
                                echo "<td><center>$cVinos->CantidadBotellas</td>";
                            }
                            echo "<td><center>$$cVinos->PrecioBotella</td>";
                            if ($cVinos->EstadoPedidoDescripcion == "Producto pedido" && $objComanda->IdEstado == 1) {
                                echo "<td><center>"
                                . "       <button type='button' class='btn btn-Bixa btnComandaDetalle'  name='btnMenosCopa' value='$cVinos->ID'>"
                                . "<img src='img/menos2.png'>"
                                . "</button>"
                                . "<input type='text' name='txtNumCopas$cVinos->ID'  id='txtNumCopas$cVinos->ID' class='editarComandaP_and_V' readonly='readonly' value='$cVinos->CantidadCopas'>"
                                . "<button type='button' class='btn btn-Bixa btnComandaDetalle'  name='btnMasCopa' value='$cVinos->ID'>"
                                . "<img src='img/mas2.png'>"
                                . "</button>"
                                . "</center>"
                                . "</td>";
                            } else {
                                echo "<td><center>$cVinos->CantidadCopas</td>";
                            }
                            echo "<td><center>$$cVinos->PrecioCopa</td>";

                            if ($cVinos->EstadoPedidoDescripcion == "Producto pedido" && $objComanda->IdEstado == 1) {
                                echo "<td ><center>"
                                . "<button type='button' class='btn btn-default btn-xs' value=$cVinos->ID name='btnComandaVGuardar' data-placement='left' data-toggle='tooltip' title='Guardar cantidad editada del producto'><img src='img/Save.png'></button>"
                                . "<button type='button' class='btn btn-default btn-xs' value=$cVinos->ID name='btnComandaV' data-placement='left' data-toggle='tooltip' title='Eliminar producto de la comanda' ><img src='img/Delete.png'></button>"
                                . "<button type='button' class='btn btn-default btn-xs' value=$cVinos->ID name='btnComandaVListo' data-placement='left' data-toggle='tooltip' title='Marcar producto como servido'><img src='img/AcceptBixa.png'></button>"
                                . "</td>";
                            } else {
                                echo "<td></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>


                        <?php
                        echo "<input type='text' id='txtIDCOMANDA' name='txtNUMCOMANDA' class='ocultar'>";
                        ?>

        </div>
    </form>        

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <br>
        <br>




        <input type='text'  name='txtNUMCOMANDA' class='ocultar'>
        <?php 
            $objVenta = new Ventas();
            $objVenta->ObtenerPorComanda($idComanda);
        ?>
        
        
        
        
        <a class="btn btn-Regresar"  href="F_A_ConsultarComandas.php">
            &larr; Consultar comandas
        </a>
        <br><br>

    </div>
        
    <script>
        $(document).ready(function() {
            ImprimirTicket();
        });
        
        function ImprimirTicket(){
            var IdVenta = document.getElementById("VentaId").value;
//            alert(IdVenta);
            if(IdVenta > 0)
            {

              $.ajax({
                url: "./Validaciones_Lado_Servidor/N_ImprimirTicket.php",
                type: 'POST',
                data: {"VentaId": IdVenta},
                success: function() {

                    }
                });

            }
             
        }
    </script>


    <!--Ventana modal para comentarios de un producto-->
    <div class="modal fade" id="modalComentarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 3 divs básicos  para cada ventana modal -->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>Comentarios</h4>
                </div>
                <div class="modal-body" id='bodyComentarios'>
                    <textarea name="DNI" id="txtComentarios" style="resize: none"></textarea>
                        <?php
                        ?>


                    <script>

                        /*Script para pasar datos a ventana Modal*/
                        $(document).on("click", ".botonComentarios", function () {
                            var vino = $(this).data('id');
                            $("#bodyComentarios #txtComentarios").val(vino);


                        });
                    </script>




                    <div class="modal-footer">
                        <button id='platilloM_P' data-dismiss="modal" class="btn btn-Bixa">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ventana modal para cambiar estado a la comanda -->
    <div class="modal fade" id="vmCambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-backdrop fade in" style="height: 1250px;" data-backdrop="true"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </div>



                <!-- Begin # DIV Form -->
                <div id="div-forms">

                    <!-- Begin # Login Form -->
                    <form id="login-form" method="POST" action="Validaciones_Lado_Servidor/N_CambiarStatusComanda.php">
                        <div class="modal-body">
                            <div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                               <span id="text-login-msg">
                                    Activa (Descripción):Los comensales se encuentran en la(s) mesa(s), con opción de realizar orden.
                                    <br>Funciones:
                                    <li>Editar la comanda (asignar estado como Activa, Pagada, Finalizada.
                                    <li>Agregar productos.
                                    <li>Modificar productos en espera (eliminación o marcar como entregado).
                                    <li>NOTA:Las mesas que usa la comanda están marcadas como ocupadas.

                                        <br>
                                        <br>

                                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>


                                        Pagada(Descripción): Los comensales ya pagaron pero aún se encuentran ocupando las mesas por lo tanto las mesas permaneces como ocupadas.
                                        <br>Funciones:
                                    <li>Editar la comanda (asignar estado como Pagada o Finalizada.
                                    <li>NOTA:Las mesas que usa la comanda están marcadas como ocupadas.
                                        <br>
                                        <br>
                                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>


                                        Finalizada(Descripción): Los comensales han pagado y se han retirado.
                                        <br>Funciones:
                                    <li>Editar la comanda (asignar estado como Finalizada).
                                    <li>NOTA:Las mesas que usa la comanda están marcadas como libres.

                                </span>


                            </div>
                            <br><br>
                            Seleccionar Opción
                            <input type="text" class="ocultar" name="txtComandaVM" value='<?php echo $idComanda; ?>'>
                            <select class="form-control" name="cmbStatus" id="cmbStatus">
                            <?php
                            $objComandaEstados = new ComandaEstados();
                            $bandera = false;
                            $cEstados = $objComandaEstados->ConsultarTodo();
                            foreach ($cEstados as $cE) {
                                if ($objComanda->Clave == $cE->Clave) {
                                    $bandera = true;
                                }
                                if ($bandera == true && $objComanda->Clave != $cE->Clave) {
                                    echo "<option value='$cE->Id'>$cE->Clave</option>";
                                    
                                }
                                
                            }
                            ?>
                                
                                <script>
    $(document).ready(function () {

        $("#login-form").validate({
            rules: {
                txtDescuento:{
                   number: true,
                   required:true,
                   min: 0
                },
                txtPropina:{
                   number: true,
                   required:true,
                   min:0
                }
            },
            messages: {
                txtDescuento:{
                   number: "Ingresar solo números",
                   required:"Ingresar descuento.",
                   min: "Solo números positivos"
                },
                txtPropina:{
                   number: "Ingresar solo números",
                   required: "Ingresar descuento.",
                   min: "Solo números positivos"
                },


            },
            errorElement: "em",
            errorPlacement: function (error, element) {
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
            success: function (label, element) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!$(element).next("span")[ 0 ]) {
                    $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".campos").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".campos").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
            }
        });


    });
</script>
                                
                                <script>
                                function CargarCajasPagada()
                                {
                                    var Opciones = document.getElementById('divPago');
                                    var Pago = document.getElementById('CajasPagos');
                                    
                            
                            switch ($('#cmbStatus option:selected').text()) {

                                case 'Pagada':
                                    Opciones.className = 'mostrar';
                                    Pago.className = 'mostrar';
                                    break;

                                default:
                                    Opciones.className = 'ocultar';
                                    Pago.className = 'ocultar';
                                    break;



                                    }
                                ValidarBotonCambiarEstado();
                                }
                                function ValidarBotonCambiarEstado()
                                {
                                    var Opcion = $("#cmbStatus option:selected").val();
                                    var txtEdFPago = document.getElementById("txtEdFPago").value;
                                    var txtEdMPago = document.getElementById("txtEdMPago").value;
                                    //var txtEdCuenta = document.getElementById("txtEdCuenta").text;
                                    
                                    if(Opcion == 2)
                                    {
                                        
                                        if((txtEdFPago  && txtEdMPago ))
                                        {
                                            
                                            $("#btnAceptarA").attr("disabled", false);
                                        }
                                        else
                                        {
                                            
                                            $("#btnAceptarA").attr("disabled", true);
                                        }
                                    }
                                    else
                                    {
                                        
                                        $("#btnAceptarA").attr("disabled", false);
                                    }
                                }
                                
                                </script>
                            </select>

                            <div class="ocultar" name="divPago" id="divPago">
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
                                                <select class="form-control" name="
                                                        " id="cmbMetodoPago">
                                                    <?php
                                                    $objMetodoPagos = new CatalogoMetodoPago();
                                                    
                                                    $cMetodos = $objMetodoPagos->ConsultarTodo();
                                                    foreach ($cMetodos as $cE) {
                                                        if ($cE->Id == 1) {
                                                            echo "<option value='$cE->Clave' selected>$cE->Nombre</option>";
                                                        }
                                                       else {
                                                            echo "<option value='$cE->Clave'>$cE->Nombre</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        <tr><td>Forma de Pago</td>
                                            <td>
                                                <select class="form-control" name="cmbFormaPago" id="cmbFormaPago">
                                                    <?php
                                                    $objFormaPago = new CatalogoFormaPago();
                                                    
                                                    $cMetodos = $objFormaPago->ConsultarTodo();
                                                    foreach ($cMetodos as $cE) {
                                                        if ($cE->Id == 1) {
                                                            echo "<option value='$cE->Id' selected>$cE->Nombre</option>";
                                                        }
                                                       else {
                                                            echo "<option value='$cE->Id'>$cE->Nombre</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td>Número de cuenta</td><td><input maxlength="4" class="ocultar form-control" id="Cuenta" name="Cuenta" type="text"/></td>
                                        </tr>
                                        <tr>
                                            <td><button type="button" class="btn btn-Bixa" id="Aplicar" name="Aplicar" onclick="AplicarEditarPago();">Aplicar</button></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ocultar" id="CajasPagos" name="CajasPagos">    
                                <table class="table">
                                    <tr>
                                        <td>Método de Pago</td>
                                        <td><textarea readonly="" class="form-control"type="text" id="txtEdMPago" name="txtEdMPago" style="resize: none" ></textarea></td>

                                    </tr>
                                    <tr>
                                        <td>Forma de Pago</td>
                                        <td><textarea readonly="" class="form-control"type="text" id="txtEdFPago" name="txtEdFPago" style="resize: none"></textarea></td>

                                    </tr>
                                    <tr>
                                        <td>Números de cuenta</td>
                                        <td> <textarea readonly=""class="form-control" type="text"id="txtEdCuenta" name="txtEdCuenta" style="resize: none"></textarea></td>

                                    </tr>
                                    
                                </table>
                                <table class="table">
                                    <tr>
                                        <td>Descuento</td>
                                        <td><input required="" class="form-control input-group" id="txtDescuento" name="txtDescuento" type="text" value="0.00"/></td>
                                        <td>Propina</td>
                                        <td><input required="" class="form-control input-group" id="txtPropina" name="txtPropina" type="text" value="0.00"/></td>

                                    </tr>
                                </table>
                            </div>
                            <input name="IdFormaPago" id="IdFormaPago" value="" class="ocultar"/>
                            <input name="NumCuentas" id="NumCuentas" value="" class="ocultar"/>
                                   
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" id="btnAceptarA" class="btn btn-primary btn-lg btn-block btn-Bixa" name="btnAceptarA" onclick="" >Cambiar Estado</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>                                        
        </div>
    </div>


    <!--Ventana modal para consulta de platillos-->
    <div class="modal fade" id="modalPlatilloDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 3 divs básicos  para cada ventana modal -->

                <div class="modal-body" id='bodyPlatilloDetalle'>
                    <input class="ocultar" type="text" name="DNI" id="mostrarDatosPlatillo"/>
                    <div id="platilloConsultaDetalle">

                    </div>
                    
                    
                    
                    
                    <script>
                    
                    /*
         * Método para Guardar de manera temporal los Ids y cuentas de las formas de pago que se agreguen
         * @param {type} FormaPago
         * @param {type} Cuenta
         * @returns {undefined}
         */
        function ArreglosTemporales(FormaPago, Cuenta)
        {
            var FormasPago = document.getElementById("IdFormaPago").value;
            var Cuentas = document.getElementById("NumCuentas").value;
            
            
            if (FormasPago == "")
            {
                //alert('Entró y la forma de pago es :' + FormaPago);
                $("#IdFormaPago").val(FormaPago);
            }
            else
            {
                //alert('No Entró y la forma de pago es :'+ $("#ArregloEditadoPagos").val() + ' Adicionando ' + FormaPago);
                $("#IdFormaPago").val($("#IdFormaPago").val() + ',' + FormaPago);

            }
            if (Cuenta != "")
            {
                
                if (Cuentas == "")
                {
                    $("#NumCuentas").val(Cuenta);
                }
                else
                {
                    $("#NumCuentas").val($("#NumCuentas").val() + ',' + Cuenta);

                }
            }
            
        }
        
                    
                    </script>
                    <script>
                    //Ventas Ventana modal
                    function Borrar()
        {
            
            
                   $("#txtEdFPago").html("");
                   $("#txtEdMPago").html("");
                   $("#txtEdCuenta").html("");
            
        }
        
           
//        function VerificarDescuentoPropina(){
////           
//           var Descuento = document.getElementById('txtDescuento');
//           var Propina = document.getElementById('txtPropina');
//           
//                      
//           if(Descuento.value.length == 0 || isNaN(Descuento.value)==true)
//           {
//                Descuento.focus();
//                Descuento.title = "El campo no puede quedar vacío";
//           }
//           else if(Propina.value.length==0 || isNaN(Propina.value)==true){
//               Propina.focus();
//               Propina.title = "El campo no puede quedar vacío";
//           }
//           
//        }


        $("#txtDescuento").change(function(){
            
        });
        
        function AplicarEditarPago()
        {
            /*var FormaPago = $("#cmbFormaPago option:selected").text();
            var IdFormaPago = $("#cmbFormaPago option:selected").val();
            var MetodoPago = $("#cmbMetodoPago option:selected").text();
            var Cuenta = document.getElementById("Cuenta");
            
            var txtAuxFPago = "";
            txtAuxFPago = $("#IdFormaPago").val();
            
            if(txtAuxFPago.length == 0)
            {
                alert(IdFormaPago);
                    $("#IdFormaPago").val(IdFormaPago);
                }
                else
                {
                    alert('No');
                    txtAuxFPago = txtAuxFPago + "," + IdFormaPago;
                    $("#IdFormaPago").val(txtAuxFPago);
                    
                }
            
            
            var EdFormaPago = document.getElementById("txtEdFPago").value;
            var EdMetodoPago = document.getElementById("txtEdMPago").value;
            var EdCuenta = document.getElementById("txtEdCuenta").value;
            
            
            if(FormaPago != "Ninguno")
            {
                if(EdFormaPago == "")
                {
                    $("#txtEdFPago").html(FormaPago);
                }
                else
                {
                    EdFormaPago = EdFormaPago + "," + FormaPago;
                    $("#txtEdFPago").html(EdFormaPago);
                    
                }
            }
            
            if(MetodoPago != "Ninguno")
            {
                if(EdMetodoPago == "")
                {
                    $("#txtEdMPago").html(MetodoPago);
                }
                else
                {
                    EdMetodoPago = EdMetodoPago + "," + MetodoPago;
                    $("#txtEdMPago").html(EdMetodoPago);
                    
                }
            }
            
            if(Cuenta.className != "ocultar form-control")
            {
                
                if(EdCuenta == "")
                {
                    
                    $("#txtEdCuenta").html(Cuenta.value);
                    
                }
                else
                {
                    EdCuenta = EdCuenta + "," + Cuenta.value;
                    $("#txtEdCuenta").html(EdCuenta);
                }
            }*/
        
        //$("#GuardarEd").attr("disabled", false);
            
            var FormaPago = $("#cmbFormaPago option:selected").text();
            var MetodoPago = $("#cmbMetodoPago option:selected").text();
            var Cuenta = document.getElementById("Cuenta");
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

            if (Cuenta.className != "ocultar")
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
            $("#Cuenta").val(""); 
            ValidarBotonCambiarEstado();
            
        }
        
        
      

        </script>
<!--                    </script>-->
                    
                    
                    <script>

                    
                        /*Script para pasar datos a ventana Modal*/
                        $(document).on("click", ".detallePlatilloVM", function () {
                            var vino = $(this).data('id');
                            $("#bodyPlatilloDetalle #mostrarDatosPlatillo").val(vino);
                            $.ajax({
                                url: "F_C_consultaPlatilloComanda.php",
                                type: 'POST',
                                data: {"idPlatillo": vino},
                                success: function (data) {
                                    $("#platilloConsultaDetalle").html(data);

                                }
                            });
                        });

                        $("#cmbStatus").change(function () {

                            var Opciones = document.getElementById("divPago");
                            var Pago = document.getElementById("CajasPagos");
                            ValidarBotonCambiarEstado();
                            
                            switch ($("#cmbStatus option:selected").text()) {

                                case "Pagada":
                                    Opciones.className = "mostrar";
                                    Pago.className = "mostrar";
                                    break;

                                default:
                                    Opciones.className = "ocultar";
                                    Pago.className = "ocultar";
                                    break;



                            }
                        });
                        
                        $("#cmbFormaPago").change(function () {

                            var Opciones = document.getElementById("Cuenta");

                            switch ($("#cmbFormaPago option:selected").text()) {

                                case "Efectivo":
                                    Opciones.className = "ocultar";
                                    break;
                                    case "Vales de despensa":
                                    Opciones.className = "ocultar";
                                    break;
                                    case "Por definir":
                                    Opciones.className = "ocultar";
                                    break;

                                default:
                                    Opciones.className = "mostrar form-control input-group";
                                    break;



                            }
                        });


                    </script>       
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-Bixa">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Ventana modal para consulta de vinos-->
    <div class="modal fade" id="modalVinoDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 3 divs básicos  para cada ventana modal -->

                <div class="modal-body" id='bodyVinoDetalle'>
                    <input class="ocultar" type="text" name="txtVinoDetalle" id="mostrarDatosVino"/>
                    <div id="vinoConsultaDetalle">

                    </div>
                    <script>

                        /*Script para pasar datos a ventana Modal*/
                        $(document).on("click", ".detalleVinoVM", function () {
                            var vino = $(this).data('id');
                            $("#bodyVinoDetalle #mostrarDatosVino").val(vino);
                            $.ajax({
                                url: "F_C_consultaVinoComanda.php",
                                type: 'POST',
                                data: {"idVino": vino},
                                success: function (data) {
                                    $("#vinoConsultaDetalle").html(data);

                                }
                            });
                        });
                    </script>       
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-Bixa">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
</html>
