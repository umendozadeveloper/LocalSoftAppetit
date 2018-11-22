<?php

    require_once '../Clases/XML.php';

class N_GenerarPDF{
    
    
    public function __construct(){
        $this->main();
    }

    public function main(){


        $fecha_hora_archivo = $_POST['Factura'];
        $TipoFactura = $_POST['TipoFactura'];
        $objXML = new Xml();
        switch ($TipoFactura)
        {
        case 3:
            if ($objXML->GenerarPdfFacturaGlobal($fecha_hora_archivo) === true) {
                //$this->GuardarFactura(2, $objTimbrado->RutaCodigoQr, $objTimbrado->RutaXml, $objTimbrado->RutaPdf, $objTimbrado->UUID, $objFacturas);
                $_SESSION['valFolio'] = null;
                $_SESSION['valCliente'] = NULL;

                $_SESSION['FacturaCorrecta'] = "OK";
                $_SESSION['Factura'] = NULL;
                $_SESSION['TipoFactura'] = NULL;
            }
            break;
        case 2:
            if ($objXML->GenerarPdf($fecha_hora_archivo, 2) === true) {
                //$this->GuardarFactura(2, $objTimbrado->RutaCodigoQr, $objTimbrado->RutaXml, $objTimbrado->RutaPdf, $objTimbrado->UUID, $objFacturas);
                $_SESSION['valFolio'] = null;
                $_SESSION['valCliente'] = NULL;

                $_SESSION['FacturaCorrecta'] = "OK";
                $_SESSION['Factura'] = NULL;
                $_SESSION['TipoFactura'] = NULL;
            }
            break;
            case 1:
                if ($objXML->GenerarPdf($fecha_hora_archivo, 1) === true) {
                //$this->GuardarFactura(2, $objTimbrado->RutaCodigoQr, $objTimbrado->RutaXml, $objTimbrado->RutaPdf, $objTimbrado->UUID, $objFacturas);
                $_SESSION['valFolio'] = null;
                $_SESSION['valCliente'] = NULL;

                $_SESSION['FacturaCorrecta'] = "OK";
                $_SESSION['Factura'] = NULL;
                $_SESSION['TipoFactura'] = NULL;
            }
            break;
        }
//        $_SESSION['Factura'] = NULL;
//        $_SESSION['TipoFactura'] = NULL;
    }
}


$objGenerarPDF = new N_GenerarPDF();