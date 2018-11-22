<?php

class IntegracionCancelaFactura{
    
    public function CancelarFactura($rfcEmisor, $folioUUID, $usuarioIntegrador){
    /* Ruta del servicio de integracion*/
        
        $ws = "http://www.timbracfdipruebas.mx/ServicioIntegracionPruebas/Timbrado.asmx?wsdl";
        $response = '';
        /* El servicio para cancelar un cfdi recibe 3 parámetros*/

        /*Usuario Integrador*/
        $usuarioIntegrador = 'mvpNUXmQfK8=';

        try
        {
        $params = array();
        /*Nombre del usuario integrador asignado, para efecto de pruebas utilizaremos 'mvpNUXmQfK8='*/
        $params['usuarioIntegrador'] = $usuarioIntegrador;
        /* Rfc emisor que emitió el comprobante*/
        $params['rfcEmisor'] = $rfcEmisor;
        /*Folio fiscal del comprobante a cancelar*/
        $params['folioUUID'] = $folioUUID;
        

        $client = new SoapClient($ws,$params);
        $response = $client->__soapCall('CancelaCFDI', array('parameters' => $params));
        }
        catch (SoapFault $fault)
        {
        echo "SOAPFault: ".$fault->faultcode."-".$fault->faultstring."\n";
        }
        /*Obtenemos resultado del response*/
        $tipoExcepcion = $response->CancelaCFDIResult->anyType[0];
        $numeroExcepcion = $response->CancelaCFDIResult->anyType[1];
        $descripcionResultado = $response->CancelaCFDIResult->anyType[2];
        $xmlTimbrado = $response->CancelaCFDIResult->anyType[3];
        $codigoQr = $response->CancelaCFDIResult->anyType[4];
        $cadenaOriginal = $response->CancelaCFDIResult->anyType[5];

        if($numeroExcepcion == "0")
        {
        /*El comprobante fue cancelado exitosamente*/
            return "0";
        }
        else
        {
            return $numeroExcepcion;
           
            
        }
    }
}
?>