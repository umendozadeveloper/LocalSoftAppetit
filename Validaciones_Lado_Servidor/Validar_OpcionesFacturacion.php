<?php

include_once  '../Clases/XML.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/IntegracionTimbrado.php';
include_once '../Clases/Ventas.php';
include_once '../Clases/DetallePago.php';
include_once '../Clases/XML.php';
include_once '../Clases/Correo.php';
include_once '../Clases/Empresa.php';
include_once '../Clases/IntegracionTimbrado.php';

class GenerarXml{
    public $errores;
    public $objXml;
    public $objVentas;
            
    function __construct() {
        $this->errores = array();
        $this->objXml = new Xml(); 
        $this->objVentas = new Ventas();

    }
    
    function main(){

    
        if(isset($_POST['btnNuevo']))
        {
            $objMpdf = new XmlMpdf();
            $fecha="";
            $fecha_archivo = $objMpdf->GenerarXml('2', '19', '38', '6', 'PUE', '6660', '2');
            $objTimbrado = new IntegracionTimbrado();
            $objTimbrado->Timbrar($fecha_archivo);
            $objMpdf->GenerarPdf($fecha_archivo, '2');
        }
        else if(isset ($_POST['btnGuardar']))
        {
            $objVentas = new Ventas();
            $array_id_ventas= array();
            $array_total_subtotal= array();
            $array_pagos = array();
            $array_id_ventas = $objVentas->ObtenerVentasParaFacturaGlobal("2017-12-05 00:00:00.000", "2017-19-05 23:00:00.000");
            $array_total_subtotal = $objVentas->ObtenerIvaSubtotalParaFacturaGlobal($array_id_ventas);
            
            $objDetallePago = new DetallePago();
            $array_pagos =  $objDetallePago->ObtenerPagosParaFacturaGlobal($array_id_ventas);
            
            
        }
        else if(isset ($_POST['btnTimbrar']))
        {
            $this->objXml->RfcReceptor = "5";
            $array_id_comandas = array ("3");
            $this->objXml->Folio = "hey";

            $formasPago = array("01");
            $cuentasPago = array("");
            $fecha_hora_archivo="";
            $tipoFactura ="DETALLADO";
            $descuento = 0.00;

                //GenerarXml(idCliente, array_id_comandas, folio, metodo_pago, formas_pago, cuentasPago,tipoFactura)
            $fecha_hora_archivo = $this->objXml->GenerarXml($this->objXml->RfcReceptor,$array_id_comandas,
                    $this->objXml->Folio, '01', $formasPago, $cuentasPago, $descuento, $tipoFactura);
             setSuccessMessage("El timbrado fue realizado correctamente");
             header("Location: ../F_A_FacturasFiscales.php");
        }
        else if(isset ($_POST['btnCancelar'])){
            echo '<script language="javascript">alert("Cancelar");</script>';
        }
        else if(isset ($_POST['btnImprimir'])){
            $this->objXml->CargarPdf('C:\\xampp\\htdocs\\Sistema_BIXA\\xml\\FacturaTimbrada2017-05-29T09-28-42.pdf');
        }
        else if(isset ($_POST['btnEnviar'])){
            $objcorreo = new Correo();
            $objEmpresa = new Empresa();
            $objEmpresa->ObtenerPorID(1);
            $se_envio=0;
            $se_envio = $objcorreo->EnviarFactura("bere.nice@live.com", 
                        'C:\\xampp\\htdocs\\Sistema_BIXA\\xml\\ARCHIVO.xml',
                        'C:\\xampp\\htdocs\\Sistema_BIXA\\xml\\ARCHIVO.pdf',
                        '¡Gracias por su visita! Vuelva pronto.');
            if($se_envio==1)
            {
                setSuccessMessage("El CFDI fue enviado por correo al cliente.");
                
            }else{
                setFailureMessage("No se pudo enviar el correo.");
            }
            header("Location: ../F_A_BarraMenu_facturacion.php");
        }
    
    }
}

$objGenerarXml = new GenerarXml();
$objGenerarXml->main();
?>
