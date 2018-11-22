<?php

require_once '../Clases/Comanda.php';
require_once '../Clases/ComandaPlatillos.php';
require_once '../Clases/ComandaVinos.php';
require_once '../Clases/ConfiguracionFacturas.php';
require_once '../Clases/DetalleVentas.php';
require_once '../Clases/Ventas.php';
require_once '../Clases/DetallePago.php';
require_once '../Clases/CatalogoMetodoPago.php';
require_once '../Clases/CatalogoFormaPago.php';
require_once '../Clases/Platillo.php';
require_once '../Clases/Vino.php';
require_once '../Clases/PagosFacturas.php';
require_once '../Clases/VentasFacturadas.php';
require_once '../Clases/UnidadMedida.php';

class N_Mostrar_Consumo {

    public $IDS;
    public $IdForma;
    public $IdMetodo;
    public $Editada;
    public $TipoFactura;
    public $IdFactura;

    public function __construct() {
        $this->main();
    }
    
    
    public function main() {
        $Ventas = array();
        $this->IDS = $_POST['IDS'];
        $this->TipoFactura = $_POST['TipoFactura'];
        //$this->Editada = $_POST['Editada'];

        
        foreach ($this->IDS as $ID) {
            $objVentas = new Ventas();
            $objVentas = $objVentas->ObtenerPorId($ID);
            array_push($Ventas, $objVentas);
        }

        if($this->TipoFactura==1)
        {
            $this->ObtenerPorConsumo($Ventas);
        }
        elseif($this->TipoFactura == 2) {
            $this->obtenerDetallado($Ventas);
        }
        else 
        {
            $this->obtenerGlobal($Ventas);
        }
        
    }

    function ObtenerPorConsumo($Venta) {
        $Bandera = false;
        $objConfiguracionFacura = new ConfiguracionFacturas();
        $objConfiguracionFacura->ObtenerPorId(1);
        $objMetodoPago = new CatalogoMetodoPago();
        $objFormaPago = new CatalogoFormaPago();
        $IVA = 0;
        $SubTotal = 0;
        $Total = 0;
        $MetodoPago = "";
        $FormaPago = "";
        $Cuenta = "";
        $IdMetodoPago = array();
        $IdFormaPago = array();
        $Detalles = array();
        $Pagos = array();
        $Cuentas = array();
        $objMetodoPago = new CatalogoMetodoPago();
        $objFormaPago = new CatalogoFormaPago();
        $objDetallePago = new DetallePago();
        $objDetallePagoFactura = new PagosFacturas();
        $objVentasFacturadas = new VentasFacturadas();
        $Importe = 0;
        $Descuentos = 0;
        $bandera_pagos_nuevos= FALSE;
        $bandera_pagos_editados= false;
        foreach ($Venta as $Ventas) {

            $Descuentos = $Descuentos + $Ventas->Descuento;
            $objMetodoPago->ConsultarPorClave($Ventas->IdMetodoPago);
            
            if(!$objVentasFacturadas->ObtenerPorVenta($Ventas->ID))
            {
                $Pagos = $objDetallePago->ObtenerPorVenta($Ventas->ID);
                $bandera_pagos_nuevos= true;
            }
            else
            {
                if($bandera_pagos_editados == false)
                {
                    $this->IdFactura = $_POST['IdFactura'];
                    $Pagos = $objDetallePagoFactura->ObtenerPorFactura($this->IdFactura);
                }
            }
            

            if ($MetodoPago == "") {
                $MetodoPago = $objMetodoPago->Nombre;
            } else {
               $MetodoPago = $objMetodoPago->Nombre;
            }
            if($bandera_pagos_editados == false){
            foreach ($Pagos as $P) {
                array_push($IdFormaPago, $P->IdFormaPago);
                $objFormaPago->ConsultarPorId($P->IdFormaPago);
                if ($FormaPago == "") {
                    $FormaPago = $objFormaPago->Nombre;
                } else {
                    $FormaPago = $FormaPago . "," . $objFormaPago->Nombre;
                }
                
                if ( $P->NumeroCuenta > 0) {
                    array_push($Cuentas, $P->NumeroCuenta);
                    if ($Cuenta == "") {
                        $Cuenta = $P->NumeroCuenta;
                    } else {
                        $Cuenta = $Cuenta . "," . $P->NumeroCuenta;
                    }
                }
            }
            if($bandera_pagos_nuevos == true)
            {
                 $bandera_pagos_editados= false;
            }else{
                $bandera_pagos_editados= true;
            }
        }
//            $objDetalleVenta = new DetalleVentas();
//            $Detalles = $objDetalleVenta->ObtenerPorIdVenta($Ventas->ID);
//            foreach ($Detalles as $D) {
//
//                $Bandera = true;
//                $D->IVA = $this->ValidarIVA($D->IdVino, $D->IdPlatillo);
////                $IVA = $IVA + (($D->Total * $D->IVA)/(100 + $D->IVA));
////                $SubTotal = $SubTotal + $D->SubTotal;
//                $Total = $Total + $D->Total;
//               $Importe= $D->PrecioSinIva * $D->Cantidad;
//                $PrecioUnitario = $D->PrecioSinIva;
//                
//                
//            }
//            $Total = $Total - $Ventas->Descuento;
//            $SubTotal = $Total/(1+($D->IVA/100));
//            if($D->IVA != 0){
//                $IVA = $SubTotal * ($D->IVA/100);
//            }else{
//                $IVA = $SubTotal;
//            }
            
            $objDetalleVenta = new DetalleVentas();
            $Detalles = $objDetalleVenta->ObtenerPorIdVenta($Ventas->ID);
            $iva =0;
            foreach ($Detalles as $D) {

                $Bandera = true;
                
                $D->IVA = $this->ValidarIVA($D->IdVino, $D->IdPlatillo);
                if($D->IVA == 16)
                {
                    $iva = $D->IVA;
                }
                $Total = $Total + $D->Total;
                $Importe= $D->PrecioSinIva * $D->Cantidad;
                $PrecioUnitario = $D->PrecioSinIva;
               
            }
            
            if($iva != 0){
                $Total = $Total - $Ventas->Descuento;
            
            $SubTotal = $Total/(1+($iva/100));
                $IVA = $SubTotal * ($iva/100);
            }else{
                $Total = $Total - $Ventas->Descuento;
            
            $SubTotal = $Total/(1+($iva/100));
                $IVA = $SubTotal;
            }
            
            echo "<input type='text' class='ocultar' id='PorcentajeIva' name='PorcentajeIva' value='$iva'/>";
        }
            
        $IdFormaPago = implode(",", $IdFormaPago);
        $Cuentas = implode(",", $Cuentas);
        echo "<div id='Comandas' class='table table-bordered table-striped'>
                
                <table class='table' style='text-align: center'>
                    <th colspan='6'><center>Productos Consumidos</center></th>
                    <tr>
                    <th colspan='4'><center>Descripción</center></th>
                    <th></th>
                    <th colspan='3'><center>Importe</center></th>
                    </tr>
                
                    <tr>
                    <td colspan='4'rowspan='5'>$objConfiguracionFacura->ConceptoDescripcion</td>
                    <td></td>
                    <td colspan='3'>".number_format($SubTotal,2,'.','')."</td>
                    
                    <tr>
                    <td>SubTotal: </td><td colspan='3'>".number_format($SubTotal,2,'.','')."</td></tr>
                    <tr><td>IVA: </td><td colspan='3'>".number_format($IVA,2,'.','')."</td></tr>
                    <tr><td>Descuento: </td><td colspan='3'>".number_format($Descuentos,2,'.','')."</td></tr>    
                    <tr><td>Total: </td><td colspan='3'>".number_format($Total,2,'.','')."</td></tr>
                    
                </table>
                <table class='table table-striped'>
                <th colspan='2'><center>Información del pago<center></th>
                <tr>
                
                <input type='text' class='ocultar' id='IdMPago' name='IdMPago' value='$objMetodoPago->Clave'/>
                <td>Método de Pago</td><td><textarea class='form-control' type='text' readonly='' value='$MetodoPago' id='txtMetodo' name='txtMetodo' style='resize: none;'>$MetodoPago</textarea></td></tr>
                <input type='text' class='ocultar' id='IdFPagos' name='IdFPagos' value='$IdFormaPago'/>
                <tr><td>Forma de Pago</td><td><textarea class='form-control' type='text' readonly='' value='$FormaPago' id='txtForma' name ='txtForma' style='resize: none;'>$FormaPago</textarea></td></tr>
                <input type='text' class='ocultar' id='NumCuentas' name='NumCuentas' value='$Cuentas'/>
                <tr><td>Numero de cuenta</td><td><textarea class='form-control' type='text' readonly='' value='$Cuenta' id='Cuenta' name='Cuenta'style='resize: none;'>$Cuenta</textarea></td>
                </tr>";
                if ($Bandera) {
            echo "<tr><td><button type='button' name='btnEditar' id='btnEditar' class='btn btn-Bixa'data-toggle='modal' data-target='#myModal'onClick='CargarDatosVentanaModal();' >Editar</button></td><td></td></tr>
                
                </table>
                
                </div>
            </div>";
        } else {
            echo "
                
                </table>
                
                </div>
            </div>";
        }
    }

    function obtenerDetallado($Venta) {
        $IVA = 0;
        $this->IdForma = array();
        $Bandera = false;
        $SubTotal = 0;
        $Total = 0;
        $MetodoPago = "";
        $FormaPago = "";
        $Cuenta = "";
        $IdMetodoPago = array();
        $IdFormaPago = array();
        $Detalles = array();
        $Cuentas = array();
        $Pagos = array();
        $objMetodoPago = new CatalogoMetodoPago();
        $objFormaPago = new CatalogoFormaPago();
        $objDetallePago = new DetallePago();
        $objDetallePagoFactura = new PagosFacturas();
        $objVentasFacturadas = new VentasFacturadas();
        $Descuentos = 0;
        $bandera_pagos_editados= false;
        $bandera_pagos_nuevos = false;
        echo "<div id='Comandas' class='table table-bordered table-striped'>
            <table class='tableEncabezadoFijo table-striped' style='text-align: center;'>
                <thead>
                <th colspan='6' class='Bixa'><center>Productos Consumidos</center></th>
                <tr></tr>   
                <th><center>Cantidad</center></th>
                <th style='text-align:right;'>Descripción</th>
                <th></th>
                <th></th>
                <th><center>Precio Unitario</center></th>
                <th><center>Importe</center></th></thead></table>
            <div style='height:auto; max-height:150px;overflow-y:auto;'>
                <table class='tableEncabezadoFijo table-striped' style='text-align: center;'>
                <tbody>
                ";
        foreach ($Venta as $Ventas) {
            $objMetodoPago->ConsultarPorClave($Ventas->IdMetodoPago);
            
            $Descuentos = $Descuentos + $Ventas->Descuento;
            if(!$objVentasFacturadas->ObtenerPorVenta($Ventas->ID))
            {
                $Pagos = $objDetallePago->ObtenerPorVenta($Ventas->ID);
                $bandera_pagos_nuevos= true;
            }
            else
            {
                if($bandera_pagos_editados == false)
                {
                    $this->IdFactura = $_POST['IdFactura'];
                    //$bandera_pagos_editados = true;
                    $Pagos = $objDetallePagoFactura->ObtenerPorFactura($this->IdFactura);
            
                }    
            }
            
            

            if ($MetodoPago == "") {
                $MetodoPago = $objMetodoPago->Nombre;
            } else {
                $MetodoPago = $MetodoPago . "," . $objMetodoPago->Nombre;
            }
            if($bandera_pagos_editados == false){
                foreach ($Pagos as $P) {
                    array_push($IdFormaPago, $P->IdFormaPago);

                    $objFormaPago->ConsultarPorId($P->IdFormaPago);
                    if ($FormaPago == "") {
                        $FormaPago = $objFormaPago->Nombre;
                    } else {
                        $FormaPago = $FormaPago . "," . $objFormaPago->Nombre;
                    }

                    if ( $P->NumeroCuenta > 0) {
                        array_push($Cuentas, $P->NumeroCuenta);
                        if ($Cuenta == "") {
                            $Cuenta = $P->NumeroCuenta;
                        } else {
                            $Cuenta = $Cuenta . "," . $P->NumeroCuenta;
                        }
                    }
                }
                if($bandera_pagos_nuevos == true)
                {
                     $bandera_pagos_editados= false;
                }else{
                    $bandera_pagos_editados= true;
                }
                
            }

            $objDetalleVenta = new DetalleVentas();
            $Detalles = $objDetalleVenta->ObtenerPorIdVenta($Ventas->ID);
            $iva =0;
            foreach ($Detalles as $D) {

                $Bandera = true;
                
                $D->IVA = $this->ValidarIVA($D->IdVino, $D->IdPlatillo);
                if($D->IVA == 16)
                {
                    $iva = $D->IVA;
                }
                
//                $IVA = $IVA + (($D->Total * $D->IVA)/(100 + $D->IVA));
//                $IVA = $IVA + ($D->Total - $D->SubTotal) ; 
//                $SubTotal = $SubTotal + $D->SubTotal;
                $Total = $Total + $D->Total;
                $Importe= $D->PrecioSinIva * $D->Cantidad;
                $PrecioUnitario = $D->PrecioSinIva;
                echo "
                    
                    <tr>
                    <td></td>
                    <td style='text-align:right;'>$D->Cantidad</td>
                    <td style='text-align:center;'>$D->Descripcion</td>
                    <td style='text-align:left;'>".number_format($PrecioUnitario,2,'.','')."</td><td>".number_format($Importe,2,'.','')."</td>
                    
                    </tr>";
            }
            
            if($iva != 0){
                $Total = $Total - $Ventas->Descuento;
            
            $SubTotal = $Total/(1+($iva/100));
                $IVA = $SubTotal * ($iva/100);
            }else{
                $Total = $Total - $Ventas->Descuento;
            
            $SubTotal = $Total/(1+($iva/100));
                $IVA = $SubTotal;
            }
            
            echo "<input type='text' class='ocultar' id='PorcentajeIva' name='PorcentajeIva' value='$iva'/>";
            
            
    }
        $IdFormaPago = implode(",", $IdFormaPago);
        $Cuentas = implode(",", $Cuentas);
        //Código para asignar valor a textarea $("textarea#ExampleMessage").html(result.exampleMessage)
        echo "</tbody></table>
                    </div>
                    </div>
                    <table class='tableEncabezadoFijo' style='text-align: center'>
                <tr></tr>
               
                    
                <tr style='background-color:#E8ECEC;'>
                    <td>      </td>
                    <td>      </td>
                    <td></td><td></td><td></td><td></td>
                    <td style='text-align:right;'>SubTotal</td><td></td><td><center>".number_format($SubTotal,2,'.','')."</center></td>
                    
                    </tr >
                    <tr style='background-color:#E8ECEC;'>
                    <td>      </td>
                    <td>      </td>
                    <td></td><td></td><td></td><td></td>
                    <td style='text-align:right;'>IVA</td><td></td><td><center>".number_format($IVA,2,'.','')."</center></td>
                    
                    </tr>
                    </tr >
                    <tr style='background-color:#E8ECEC;'>
                    <td>      </td>
                    <td>      </td>
                    <td></td><td></td><td></td><td></td>
                    <td style='text-align:right;'>Descuento</td><td></td><td><center>".number_format($Descuentos,2,'.','')."</center></td>
                    
                    </tr>
                    <tr style='background-color:#E8ECEC;'>
                    <td>      </td>
                    <td>      </td>
                    <td></td><td></td><td></td><td></td>
                    <td style='text-align:right;'>Total</td><td></td><td><center>".number_format($Total,2,'.','')."</center></td>
                    
                    </tr>

                    </table>
                    <div class='table'>
                    <table class='table table-striped'>
                <th colspan='2'><center>Información del pago<center></th>
                <tr>
                
                <input type='text' class='ocultar' id='IdMPago' name='IdMPago' value='$objMetodoPago->Clave'/>
                <td>Método de Pago</td><td><textarea class='form-control' type='text' readonly='' value='$MetodoPago' id='txtMetodo' name='txtMetodo' style='resize: none;'>$objMetodoPago->Nombre</textarea></td></tr>
                <input type='text' class='ocultar' id='IdFPagos' name='IdFPagos' value='$IdFormaPago'/>
                <tr><td>Forma de Pago</td><td><textarea class='form-control' type='text' readonly='' value='$FormaPago' id='txtForma' name ='txtForma' style='resize: none;'>$FormaPago</textarea></td></tr>
                <input type='text' class='ocultar' id='NumCuentas' name='NumCuentas' value='$Cuentas'/>
                <tr><td>Numero de cuenta</td><td><textarea class='form-control' type='text' readonly='' value='$Cuenta' id='Cuenta' name='Cuenta'style='resize: none;'>$Cuenta</textarea></td>
                </tr>";
        if ($Bandera) {
            echo "<tr><td><button type='button' name='btnEditar' id='btnEditar' class='btn btn-Bixa'data-toggle='modal' data-target='#myModal'onClick='CargarDatosVentanaModal();' >Editar</button></td><td></td></tr>
                
                </table>
                
                </div>
            </div>";
        } else {
            echo "
                
                </table>
                
                </div>
            </div>";
        }
    }
    
    
    
    
    function obtenerGlobal($Venta) {
        $IVA = 0;
        $this->IdForma = array();
        $Bandera = false;
        $SubTotal = 0;
        $SubTotalU=0;
        $SubT = 0;
        $Total = 0;
        $MetodoPago = "";
        $FormaPago = "";
        $Cuenta = "";
        $TotalU=0;
        $IdMetodoPago = array();
        $IdFormaPago = array();
        $Detalles = array();
        $Cuentas = array();
        $Pagos = array();
        $objMetodoPago = new CatalogoMetodoPago();
        $objFormaPago = new CatalogoFormaPago();
        $objDetallePago = new DetallePago();
        $objDetallePagoFactura = new PagosFacturas();
        $objVentasFacturadas = new VentasFacturadas();
        $objConfiguracion = new ConfiguracionFacturas();
        $objConfiguracion->ObtenerPorId(1);
        $objUnidad = new UnidadMedida();
        $objUnidad->ConsultarPorId($objConfiguracion->IdUnidad);
        $Descuentos = 0;
        $bandera_pagos_editados= false;
        $bandera_pagos_nuevos = false;
        echo "<div id='Comandas' class='table table-bordered table-striped'>
            <table class='tableEncabezadoFijo table-striped' style='text-align: center;'>
                <thead>
                <th colspan='6' class='Bixa'><center>Productos Consumidos</center></th>
                <tr></tr>   
                <th><center>Cantidad</center></th>
                <th><center>Unidad</center></th>
                <th style='text-align:right;'>Descripción</th>
                <th></th>
                <th></th>
                <th><center>Precio Unitario</center></th>
                <th><center>Importe</center></th></thead></table>
            <div style='height:auto; max-height:150px;overflow-y:auto;'>
                <table class='tableEncabezadoFijo table-striped' style='text-align: center;'>
                <tbody>
                ";
        foreach ($Venta as $Ventas) {
            $objMetodoPago->ConsultarPorClave($Ventas->IdMetodoPago);
            $SubTotal=0;
            $Descuentos = $Descuentos + $Ventas->Descuento;
            if(!$objVentasFacturadas->ObtenerPorVenta($Ventas->ID))
            {
                $Pagos = $objDetallePago->ObtenerPorVenta($Ventas->ID);
                $bandera_pagos_nuevos= true;
            }
            else
            {
                if($bandera_pagos_editados == false)
                {
                    $this->IdFactura = $_POST['IdFactura'];
                    $Pagos = $objDetallePagoFactura->ObtenerPorFactura($this->IdFactura);
                }
            }
            
            

            if ($MetodoPago == "") {
                $MetodoPago = $objMetodoPago->Nombre;
            } else {
                $MetodoPago = $MetodoPago . "," . $objMetodoPago->Nombre;
            }
            if($bandera_pagos_editados == false){
                foreach ($Pagos as $P) {
                    array_push($IdFormaPago, $P->IdFormaPago);

                    $objFormaPago->ConsultarPorId($P->IdFormaPago);
                    if ($FormaPago == "") {
                        $FormaPago = $objFormaPago->Nombre;
                    } else {
                        $FormaPago = $FormaPago . "," . $objFormaPago->Nombre;
                    }

                    if ( $P->NumeroCuenta > 0) {
                        array_push($Cuentas, $P->NumeroCuenta);
                        if ($Cuenta == "") {
                            $Cuenta = $P->NumeroCuenta;
                        } else {
                            $Cuenta = $Cuenta . "," . $P->NumeroCuenta;
                        }
                    }
                }
            
                if($bandera_pagos_nuevos == true)
                {
                     $bandera_pagos_editados= false;
                }else{
                    $bandera_pagos_editados= true;
                }
            }

            $objDetalleVenta = new DetalleVentas();
            $Detalles = $objDetalleVenta->ObtenerPorIdVenta($Ventas->ID);
            $iva =0;
            foreach ($Detalles as $D) {

                $Bandera = true;
                
                $D->IVA = $this->ValidarIVA($D->IdVino, $D->IdPlatillo);
                if($D->IVA == 16)
                {
                    $iva = $D->IVA;
                }
                
//                $IVA = $IVA + (($D->Total * $D->IVA)/(100 + $D->IVA));
//                $IVA = $IVA + ($D->Total - $D->SubTotal) ; 
//                $SubTotal = $SubTotal + $D->SubTotal;
                $Total = $Total + $D->Total;
                $Importe= $D->PrecioSinIva * $D->Cantidad;
                $PrecioUnitario = $D->PrecioSinIva;
                $TotalU = $TotalU + $D->Total;
                
            }
            
            
            if($iva != 0){
                $Total = $Total - $Ventas->Descuento;
                $TotalU = $TotalU - $Ventas->Descuento;
                $SubTotal =$Total/(1+($iva/100));
                $SubTotalU=$TotalU/(1+($iva/100));
                $IVA = $SubTotal * ($iva/100);
                
            }else{
                $Total = $Total - $Ventas->Descuento;
            $TotalU = $TotalU - $Ventas->Descuento;
            $SubTotalU=$TotalU;
            $SubTotal = $Total;///(1+($iva/100));
                $IVA = 0;
            }
            
            $SubT = $SubTotal;
            
            
            echo "
                    
                    <tr>
                    <td></td>
                    <td style='text-align:right;'>1</td>
                    <td style='text-align:center;'>$objUnidad->Descripcion</td>
                    <td style='text-align:center;'>Folio $Ventas->ID</td>
                        <td style='text-align:center;'>".number_format($SubTotalU,2,'.','')."</td>
                            <td style='text-align:center;'>".number_format($SubTotalU,2,'.','')."</td>
                    
                    
                    </tr>";
           $SubT=0;
           $SubTotalU=0;
           $TotalU=0;
            
            echo "<input type='text' class='ocultar' id='PorcentajeIva' name='PorcentajeIva' value='$iva'/>";
            
            
    }
        $IdFormaPago = implode(",", $IdFormaPago);
        $Cuentas = implode(",", $Cuentas);
        //Código para asignar valor a textarea $("textarea#ExampleMessage").html(result.exampleMessage)
        echo "</tbody></table>
                    </div>
                    </div>
                    <table class='tableEncabezadoFijo' style='text-align: center'>
                <tr></tr>
               
                    
                <tr style='background-color:#E8ECEC;'>
                    <td>      </td>
                    <td>      </td>
                    <td></td><td></td><td></td><td></td>
                    <td style='text-align:right;'>SubTotal</td><td></td><td><center>".number_format($SubTotal,2,'.','')."</center></td>
                    
                    </tr >
                    <tr style='background-color:#E8ECEC;'>
                    <td>      </td>
                    <td>      </td>
                    <td></td><td></td><td></td><td></td>
                    <td style='text-align:right;'>IVA</td><td></td><td><center>".number_format($IVA,2,'.','')."</center></td>
                    
                    </tr>
                    </tr >
                    <tr style='background-color:#E8ECEC;'>
                    <td>      </td>
                    <td>      </td>
                    <td></td><td></td><td></td><td></td>
                    <td style='text-align:right;'>Descuento</td><td></td><td><center>".number_format($Descuentos,2,'.','')."</center></td>
                    
                    </tr>
                    <tr style='background-color:#E8ECEC;'>
                    <td>      </td>
                    <td>      </td>
                    <td></td><td></td><td></td><td></td>
                    <td style='text-align:right;'>Total</td><td></td><td><center>".number_format($Total,2,'.','')."</center></td>
                    
                    </tr>

                    </table>
                    <div class='table'>
                    <table class='table table-striped'>
                <th colspan='2'><center>Información del pago<center></th>
                <tr>
                
                <input type='text' class='ocultar' id='IdMPago' name='IdMPago' value='$objMetodoPago->Clave'/>
                <td>Método de Pago</td><td><textarea class='form-control' type='text' readonly='' value='$MetodoPago' id='txtMetodo' name='txtMetodo' style='resize: none;'>$objMetodoPago->Nombre</textarea></td></tr>
                <input type='text' class='ocultar' id='IdFPagos' name='IdFPagos' value='$IdFormaPago'/>
                <tr><td>Forma de Pago</td><td><textarea class='form-control' type='text' readonly='' value='$FormaPago' id='txtForma' name ='txtForma' style='resize: none;'>$FormaPago</textarea></td></tr>
                <input type='text' class='ocultar' id='NumCuentas' name='NumCuentas' value='$Cuentas'/>
                <tr><td>Numero de cuenta</td><td><textarea class='form-control' type='text' readonly='' value='$Cuenta' id='Cuenta' name='Cuenta'style='resize: none;'>$Cuenta</textarea></td>
                </tr>";
        if ($Bandera) {
            echo "<tr><td><button type='button' name='btnEditar' id='btnEditar' class='btn btn-Bixa'data-toggle='modal' data-target='#myModal'onClick='CargarDatosVentanaModal();' >Editar</button></td><td></td></tr>
                
                </table>
                
                </div>
            </div>";
        } else {
            echo "
                
                </table>
                
                </div>
            </div>";
        }
    }

    public function ValidarIVA($IdVino, $IdPlatillo) {
        $objConfiguracionFacura = new ConfiguracionFacturas();
        $objConfiguracionFacura->ObtenerPorId(1);
        if ($IdPlatillo == NULL || $IdPlatillo == 0) {
            $objVino = new Vino();
            $objVino->ConsultarPorID($IdVino);
            if ($objVino->Iva == null or $objVino->Iva == "") {
                return $objConfiguracionFacura->IVA;
            } else {
                return $objVino->Iva;
            }
        }
        else
        {
            $objPlatillo = new Platillo();
            $objPlatillo->ConsultarPorID($IdPlatillo);
            
            if ($objPlatillo->Iva == null || $objPlatillo->Iva == "") {
                return $objConfiguracionFacura->IVA;
            } else {
                return $objPlatillo->Iva;
            }  
        }
    }

}

$objDatos = new N_Mostrar_Consumo();
//$objDatos->main();

