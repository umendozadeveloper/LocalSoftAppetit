<?php

ini_set('max_execution_time', 60); #Tiempo límite de espera para la ejecución del proceso. 
#El generar la factura en pdf tarda más de 30 seg.

include_once '../Clases/XML.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/IntegracionTimbrado.php';
include_once '../Clases/Ventas.php';
include_once '../Clases/Seguridad.php';
include_once '../Clases/Facturas.php';
include_once '../Clases/VentasFacturadas.php';
include_once '../Clases/PagosFacturas.php';
/* --------------- */include_once '../Clases/IntegracionCancelaFactura.php';

class N_Validar_EditarFactura {

    public $errores;
    public $objXml;
    public $objVentas;
    public $IdCliente;
    public $IdVentas;
    public $IdMPago;
    public $IdFPagos;
    public $NumCuentas;
    public $TipoFactura;
    public $Folio;
    public $objSeguridad;

    function __construct() {
        $this->errores = array();
        $this->objXml = new Xml();
        $this->objSeguridad = new Seguridad();
    }

    function main() {

        if (isset($_POST['Facturar'])) {
            $Opcion = $_POST['Facturar'];
            $IdFactura = $_POST['IdFactura'];

            if (isset($_POST['IdClienteI'])) {
                $this->IdCliente = $_POST['IdClienteI'];
            }

            if (isset($_POST['IdVentas'])) {
                $this->IdVentas = $_POST['IdVentas'];
            }
            if (isset($_POST['IdMPago'])) {
                $this->IdMPago = $_POST['IdMPago'];
            }
            if (isset($_POST['IdFPagos'])) {
                $this->IdFPagos = $_POST['IdFPagos'];
            }
            if (isset($_POST['NumCuentas'])) {
                $this->NumCuentas = $_POST['NumCuentas'];
            }
            if (isset($_POST['TipoFactura'])) {
                $this->TipoFactura = $_POST['TipoFactura'];
            }
            /*if (isset($_POST['Folio'])) {
                $this->Folio = $_POST['Folio'];
            }*/

            switch ($Opcion) {
                case "Timbrar":
                    //        if(isset($_POST['cmbCliente'])){
                    //            $this->objXml->RfcReceptor = $_POST['cmbCliente'];
                    //        }
                    //        else{
                    //            array_push($this->errores, "Debe seleccionar un cliente");
                    //        }
                    //        
                    //        if(isset($_POST['txtFolioFactura'])){
                    //            $this->objXml->Folio = $_POST['txtFolioFactura'];
                    //        }
                    //        else{
                    //           array_push($this->errores, "Debe insertar el valor del folio");
                    //        }
                    //***********************************************************************************************
                    //         $array_id_ventas = array();
                    //         $this->objVentas = new Ventas();
                    //           $ventas = $this->objVentas->ObtenerTodosNoFacturados();
                    //           $contador=0;
                    //           foreach($ventas as $Datos)
                    //           {
                    //
    //               $nombrePOST = "chkComanda" . $Datos->IdComanda;
                    //               if(isset($_POST[$nombrePOST]) && $_POST[$nombrePOST]!=NULL){
                    //                  $array_id_ventas[$contador] = $Datos->ID;
                    //                   $contador++;
                    //               }
                    //           }
                    //         if(count($array_id_comandas)== 0)
                    //         {
                    //             array_push($this->errores, "No se seleccionó ninguna venta para facturar");
                    //         }
                    //**********************************************************************************************
                    if ($this->errores) {
                        foreach ($this->errores as $e) {
                            setFailureMessage($e);
                        }
                        header("Location: ../F_A_FacturasFiscales.php");
                    } else {
                        //            $_SESSION['valFolio'] = $this->objXml->Folio;
                        //            $_SESSION['valCliente'] = $this->objXml->RfcReceptor;

                        $objSQL = new SQL_DML();
                        $objFacturas = new Facturas();
                        $objFacturas->ObtenerPorId($IdFactura);
                        $this->Folio = $objFacturas->Folio;
                        $objCancelaFactura = new IntegracionCancelaFactura();
                        //            $objCancelaFactura->CancelarFactura("LAN7008173R5", "5F3EED96-FD46-447B-816F-4B4DDEFD091A", "mvpNUXmQfK8=");


                        $fecha_hora_archivo = "";
                        //            $this->TipoFactura ="3";//1->Consumo, 2->Detallado, 3->global

                        if ($this->TipoFactura == "3") {#factura global
                            $fecha_hora_archivo = $this->objXml->GenerarXmlParaFacturaGlobal($this->IdCliente, $this->IdVentas, $this->Folio);
                            $objTimbrado = new IntegracionTimbrado();

                            if ($objTimbrado->Timbrar($fecha_hora_archivo) === true) {
                                $_SESSION['Factura'] = $fecha_hora_archivo;
                                $_SESSION['TipoFactura'] = $this->TipoFactura;
                                $this->GuardarFactura(2, $objTimbrado->RutaCodigoQr, $objTimbrado->RutaXml, $objTimbrado->RutaPdf, $objTimbrado->UUID, $objFacturas);
                                /*if ($this->objXml->GenerarPdfFacturaGlobal($fecha_hora_archivo) === true) {
                                    
                                    $_SESSION['valFolio'] = null;
                                    $_SESSION['valCliente'] = NULL;

                                    $_SESSION['FacturaCorrecta'] = "OK";*/
                                    //                $objVenta = new Ventas();
                                    //                $objVenta->MarcarComoFacturada($array_id_comandas);

                                    setSuccessMessage("La facturación fue realizada correctamente");
                                    header("Location: ../F_A_FacturasFiscales.php");
                                //}
                            }
                            else
                            {
                                $this->GuardarFactura(1, NULL, NULL, NULL, NULL, $objFacturas);
                                setFailureMessage("Ocurrió un error al realizar la factura, verifique los datos");
                                    header("Location: ../F_A_FacturasFiscales.php");
                            }
                        } else {#factura por consumo o factura detallada
                            //GenerarXml(idCliente, array_ventas, folio, metodo_pago, formas_pago, cuentasPago,tipoFactura)
                            $fecha_hora_archivo = $this->objXml->GenerarXml($this->IdCliente, $this->IdVentas, $this->Folio, $this->IdMPago, $this->IdFPagos, $this->NumCuentas, $this->TipoFactura);
                            $fue_facturado = false;

                            $objTimbrado = new IntegracionTimbrado();

                            if ($objTimbrado->Timbrar($fecha_hora_archivo) === true) {
                                $_SESSION['Factura'] = $fecha_hora_archivo;
                                $_SESSION['TipoFactura'] = $this->TipoFactura;
                                $this->GuardarFactura(2, $objTimbrado->RutaCodigoQr, $objTimbrado->RutaXml, $objTimbrado->RutaPdf, $objTimbrado->UUID, $objFacturas);
//                $this->objXml->GenerarPdf($fecha_hora_archivo,$this->TipoFactura);           
                                /*if ($this->objXml->GenerarPdf($fecha_hora_archivo, $this->TipoFactura) === true) {
                                    
                                    $_SESSION['valFolio'] = null;
                                    $_SESSION['valCliente'] = NULL;

                                    $_SESSION['FacturaCorrecta'] = "OK";*/
                                    //        //                $objVenta = new Ventas();
                                    //        //                $objVenta->MarcarComoFacturada($array_id_comandas);
                                    //
                        setSuccessMessage("La facturación fue realizada correctamente");
                                    header("Location: ../F_A_DetalleFactura.php?IdFactura=$objFacturas->ID");
                                //}
                            }
                            else
                            {
                                $this->GuardarFactura(1, NULL, NULL, NULL, NULL, $objFacturas);
                                setFailureMessage("Ocurrió un error al realizar la factura, verifique los datos");
                                    header("Location: ../F_A_DetalleFactura.php?IdFactura=$objFacturas->ID");
                            }
                        }
                    }       
                    break;
                case "Guardar":
                    $objFacturas = new Facturas();
                        $objFacturas->ObtenerPorId($IdFactura);
                    $this->GuardarFactura(1,null,null,null,null,$objFacturas);
                    break;
            }
        } else {
            setFailureMessage("No se han seleccionado datos para factura");
            header("Location: ../F_A_FacturasFiscales.php");
        }
    }
    
    function GuardarFactura($StatusFactura, $RutaCodigoQR = null, $RutaXML = null,$RutaPDF=null , $UUID=null, $objFacturas) {
        $IdVentas = array();
        $IdFormaPagos = array();
        $NumeroCuentas = array();
        //Aplicar este proceso en el timbrado: De preferencia hacer una función
        if ($objFacturas->Editar($objFacturas->ID,$objFacturas->Folio, $this->objSeguridad->CurrentUserID(), $this->IdCliente, $this->IdMPago, $StatusFactura, $RutaCodigoQR, $RutaXML, $RutaPDF, $UUID, $this->TipoFactura)) {
            $IdVentas = explode(",", $this->IdVentas);
            $IdFormaPagos = explode(",", $this->IdFPagos);
            $NumeroCuentas = explode(",", $this->NumCuentas);
            if ($this->RegistrarPagos($objFacturas->ID, $IdFormaPagos, $NumeroCuentas) && $this->RegistrarVentasFcturadas($IdVentas, $objFacturas)) {
                setSuccessMessage("Se ha guardado correctamente la factura");
                header("Location: ../F_A_DetalleFactura.php?IdFactura=$objFacturas->ID");
            } else {
                setFailureMessage("Error al registrar formas de pago y ventas");
                header("Location: ../F_A_DetalleFactura.php?IdFactura=$objFacturas->ID");
            }
        } else {
            setFailureMessage("Error al guardar la factura, datos incorrectos");
            header("Location: ../F_A_DetalleFactura.php?IdFactura=$objFacturas->ID");
        }
    }

    function RegistrarVentasFcturadas($IdVentas, $objFacturas) {
        $Bandera = true;
        $objVentasFacturadas = new VentasFacturadas();
        $objVentasFacturadas->Eliminar($objFacturas->ID);
        $objVentas = new Ventas();
        foreach ($IdVentas as $Ventas) {
            if($objVentasFacturadas->RegistrarVentaFacturada($Ventas, $objFacturas->ID))
            {
                $objVentas->VentaFacturada($Ventas);
            }
            else
            {
                $Bandera = FALSE;
            }
        }
        return $Bandera;
    }

    function RegistrarPagos($Factura, $FormasPago, $NumeroCuenta)
{
    $Bandera  = true;
    $Contador = 0;
    $objPagosFacturas = new PagosFacturas();
    $objPagosFacturas->Eliminar($Factura);
    foreach($FormasPago as $Pagos)
    {
        
        switch ($Pagos)
        {
            case 1:
                if(!$objPagosFacturas->Agregar($Pagos, NULL, $Factura))
                {
                    $Bandera = FALSE;
                }    
                break;
            case 8:
                if(!$objPagosFacturas->Agregar($Pagos, NULL, $Factura))
                {
                    $Bandera = FALSE;
                }    
                break;
            case 99:
                if(!$objPagosFacturas->Agregar($Pagos, NULL, $Factura))
                {
                    $Bandera = FALSE;
                }    
                break;
            default :
                if(!$objPagosFacturas->Agregar($Pagos, $NumeroCuenta[$Contador], $Factura))
                {
                    $Bandera = FALSE;
                }    
               
                $Contador++;
                break;
        }
    }
    return $Bandera;
        
}

}

$objGenerarXml = new N_Validar_EditarFactura();
$objGenerarXml->main();

