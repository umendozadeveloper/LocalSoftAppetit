<?php

session_start();
include_once '../Clases/Comanda.php';
include_once '../Clases/Mesa.php';
include_once '../Clases/Vista_DetalleVentas.php';
include_once '../Clases/ConfiguracionFacturas.php';
include_once '../Clases/Ventas.php';
include_once '../Clases/CatalogoFormaPago.php';
include_once '../Clases/DetalleVentas.php';
include_once '../Clases/DetallePago.php';
include_once '../Clases/Seguridad.php';
//include_once './N_ImprimirTicket.php';


$idComanda = $_POST['txtComandaVM'];
$Status = $_POST['cmbStatus'];
$seguridad = new Seguridad();
$mensajes = array();
$objComanda = new Comanda();
if ($objComanda->ActualizarCambiarStatus($idComanda, $Status)) {

    switch ($Status) {
        case 1:
            array_push($mensajes, "Estado Activa seleccionado");
           if(isset($_POST['btnAceptarM'])){
                header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
            }else if(isset ($_POST['btnAceptarA'])){
                 header("Location: ../F_A_Comanda_A_Detalle.php?idComanda=$idComanda");
            }
            break;
        case 2:
            $objConfiguracionFacturas = new ConfiguracionFacturas();
            $objConfiguracionFacturas->ObtenerPorId(1);
            $objVentas = new Ventas();
            $IdFormaPago = $_POST['IdFormaPago'];
            $IdMetodoPago = $_POST['cmbMetodoPago'];
            if (isset($_POST['NumCuentas'])) {
                $NumeroCuenta = $_POST['NumCuentas'];
                $NumeroCuenta = explode(",", $NumeroCuenta);
            } else {
                $NumeroCuenta = null;
            }

            $Propina = $_POST['txtPropina'];
            $Descuento = $_POST['txtDescuento'];
            if(is_numeric($Propina)==false)
            {
                $Propina = 0.00;
            }
            if(is_numeric($Descuento)==false)
            {
                $Descuento = 0.00;
            }
            
            $MetodosPago = explode(",", $IdMetodoPago);
            $FormasPago = explode(",", $IdFormaPago);
            
            $idUsuario= NULL;
            if(isset($_POST['btnAceptarA'])){
                $idUsuario = $seguridad->CurrentUserID();
            }
            
            if ($objVentas->RegistarVenta($idComanda,$idUsuario, $IdMetodoPago, $Propina, $Descuento)) {
                
                $Iva = 0;
                $objDetalleVentas = new DetalleVentas();
                $objVistaVenta = new Vista_DetalleVentas();
                $Platillos = $objVistaVenta->ObtenerDetallePlatillo($idComanda);
                foreach ($Platillos as $P) {
                    if ($P->IVA == null) {
                        $P->IVA = $objConfiguracionFacturas->IVA;
                    }

                    $objDetalleVentas->PrecioSinIva = $P->PrecioCarta/(1+($P->IVA/100));
                    $objDetalleVentas->SubTotal = $objDetalleVentas->PrecioSinIva * $P->Cantidad;
                    $objDetalleVentas->Total = $P->PrecioCarta * $P->Cantidad;

                    $objDetalleVentas->RegistrarDetalleVentas($objVentas->ID, NULL, $P->IdPlatillo, $P->Descripcion, $P->Cantidad, $P->PrecioCarta, $objDetalleVentas->PrecioSinIva, $P->IVA, $objDetalleVentas->SubTotal, $objDetalleVentas->Total);
                }

                $Vinos = $objVistaVenta->ObtenerDetalleVino($idComanda);
                foreach ($Vinos as $V) {
                    if ($V->IVA == null) {
                        $V->IVA = $objConfiguracionFacturas->IVA;
                    }

                    $objDetalleVentas->PrecioSinIva = $V->PrecioCarta/(1+($V->IVA/100));
                    $objDetalleVentas->SubTotal = $objDetalleVentas->PrecioSinIva * $V->Cantidad;
                    $objDetalleVentas->Total = $V->PrecioCarta * $V->Cantidad;
                    $objDetalleVentas->RegistrarDetalleVentas($objVentas->ID, $V->IdVino, NULL, $V->Descripcion, $V->Cantidad, $V->PrecioCarta, $objDetalleVentas->PrecioSinIva, $V->IVA, $objDetalleVentas->SubTotal, $objDetalleVentas->Total);
                }
                $_SESSION['VentaId']= $objVentas->ID;
//                $objetoImprimir = new N_ImprimirTicket();
//                $objetoImprimir->Imprimir($objVentas->ID);
                if(RegistrarPagos($objVentas->ID,$FormasPago, $NumeroCuenta))
                {
                $objComanda->CerrarComanda($idComanda);
                array_push($mensajes, "Estado Pagada seleccionado");
                array_push($mensajes, "No es posible agregar más productos a la comanda");
                    if(isset($_POST['btnAceptarM'])){
                        header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
                    }else if(isset ($_POST['btnAceptarA'])){
                         header("Location: ../F_A_Comanda_A_Detalle.php?idComanda=$idComanda");
                    }
                }
            }
            break;
        case 3:
            $objMesa = new Mesa();
            $mesas = $objMesa->ConsultarMesaPorIDComanda($idComanda);
            $objMesa->LiberarMesas($mesas);
            $objComanda->CerrarComanda($idComanda);
            array_push($mensajes, "Estado Finalizada seleccionado");
            array_push($mensajes, "No es posible agregar más productos a la comanda");
            array_push($mensajes, "Las mesas han sido liberadas");
            if(isset($_POST['btnAceptarM'])){
                header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=$idComanda");
            }else if(isset ($_POST['btnAceptarA'])){
                 header("Location: ../F_A_Comanda_A_Detalle.php?idComanda=$idComanda");
            }
            
            break;

        default :
            break;
    }


    $_SESSION['msjEstadoComanda'] = $mensajes;
} else
    Echo "NO";

function RegistrarPagos($Comanda, $FormasPago, $NumeroCuenta)
{
    $Bandera  = true;
    $Contador = 0;
    $objDetallePagos = new DetallePago();
    foreach($FormasPago as $Pagos)
    {
        
        switch ($Pagos)
        {
            case 1:
                $objFormaPago = new CatalogoFormaPago();
                $objFormaPago->ConsultarPorId($Pagos);
                $objDetallePagos->IdFormaPago = $objFormaPago->Id;
                $objDetallePagos->IdVenta = $Comanda;
                if(!$objDetallePagos->RegistrarPago($objDetallePagos->IdVenta, $objDetallePagos->IdFormaPago, NULL))
                {
                    $Bandera = FALSE;
                }    
                break;
            case 8:
                $objFormaPago = new CatalogoFormaPago();
                $objFormaPago->ConsultarPorId($Pagos);
                $objDetallePagos->IdFormaPago = $objFormaPago->Id;
                $objDetallePagos->IdVenta = $Comanda;
                if(!$objDetallePagos->RegistrarPago($objDetallePagos->IdVenta, $objDetallePagos->IdFormaPago, NULL))
                {
                    $Bandera = FALSE;
                }
                break;
            case 99:
                $objFormaPago = new CatalogoFormaPago();
                $objFormaPago->ConsultarPorId($Pagos);
                $objDetallePagos->IdFormaPago = $objFormaPago->Id;
                $objDetallePagos->IdVenta = $Comanda;
                if(!$objDetallePagos->RegistrarPago($objDetallePagos->IdVenta, $objDetallePagos->IdFormaPago, NULL))
                {
                    $Bandera = FALSE;
                }
                break;
            default :
                $objFormaPago = new CatalogoFormaPago();
                $objFormaPago->ConsultarPorId($Pagos);
                $objDetallePagos->IdFormaPago = $objFormaPago->Id;
                $objDetallePagos->IdVenta = $Comanda;
                if(!$objDetallePagos->RegistrarPago($objDetallePagos->IdVenta, $objDetallePagos->IdFormaPago, $NumeroCuenta[$Contador]))
                {
                    $Bandera = FALSE;
                }
                $Contador++;
                break;
        }
    }
    return $Bandera;
        
}
