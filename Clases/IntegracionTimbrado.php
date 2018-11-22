<?php
include_once 'XML.php';
include_once '../Validaciones_Lado_Servidor/Funciones/P_SwalMensajes.php';
include_once 'Empresa.php';

class IntegracionTimbrado{
    public $RutaXml;
    public $RutaCodigoQr;
    public $RutaPdf;
    public $UUID;
    
    #El timbrado es de la versión 3.2 del CFDI
 
    public function Timbrar($fecha_archivo){
        /* Ruta del servicio de integracion*/
        
        $ws = "http://www.timbracfdipruebas.mx/ServicioIntegracionPruebas/Timbrado.asmx?wsdl";
        $response = '';
        /* Ruta del comprobante a timbrar*/
        //$rutaArchivo = 'C:\xampp\htdocs\Prueba\comprobanteSinTimbrar.xml';
        $rutaArchivo = '../xml/ArchivosSellados/Factura'. $fecha_archivo . '.xml';
        /* El servicio recibe el comprobante (xml) codificado en Base64, el rfc del emisor deberá ser 'AAA010101AAA' para efecto de pruebas*/ 
        $base64Comprobante = file_get_contents($rutaArchivo);
        $base64Comprobante = base64_encode($base64Comprobante);
        try
        {
        $params = array();
        /*Nombre del usuario integrador asignado, para efecto de pruebas utilizaremos 'mvpNUXmQfK8='*/
        $params['usuarioIntegrador'] = 'mvpNUXmQfK8=';
        /* Comprobante en base 64*/
        $params['xmlComprobanteBase64'] = $base64Comprobante;
        /*Id del comprobante, deberá ser un identificador único, para efecto del ejemplo se utilizará un numero aleatorio*/
        $params['idComprobante'] = rand(5, 999999);
        $client = new SoapClient($ws,$params);
        $response = $client->__soapCall('TimbraCFDI', array('parameters' => $params));
        }
        catch (SoapFault $fault)
        {
            setFailureMessage("No hay conexión a internet");
            header("Location: ../F_A_FacturasFiscales.php");
            echo "SOAPFault: ".$fault->faultcode."-".$fault->faultstring."\n";
        }
        /*Obtenemos resultado del response*/
        $tipoExcepcion = $response->TimbraCFDIResult->anyType[0];
        $numeroExcepcion = $response->TimbraCFDIResult->anyType[1];
        $descripcionResultado = $response->TimbraCFDIResult->anyType[2];
        $xmlTimbrado = $response->TimbraCFDIResult->anyType[3];
        $codigoQr = $response->TimbraCFDIResult->anyType[4];
        $cadenaOriginal = $response->TimbraCFDIResult->anyType[5];

        if($xmlTimbrado != '')
        {
            /*El comprobante fue timbrado correctamente*/

            /*Guardamos comprobante timbrado*/
            file_put_contents('../xml/FacturaTimbrada'. $fecha_archivo . '.xml', $xmlTimbrado);

            /*Guardamos codigo qr*/
            file_put_contents('../xml/ArchivosSellados/CodigoQr'. $fecha_archivo . '.jpg', $codigoQr);

            /*Guardamos cadena original del complemento de certificacion del SAT*/
            file_put_contents('../xml/ArchivosSellados/CadenaOriginal'. $fecha_archivo. '.txt', $cadenaOriginal);

            $this->RutaXml = './xml/FacturaTimbrada'. $fecha_archivo . '.xml';
            $this->RutaCodigoQr = './xml/ArchivosSellados/CodigoQr'. $fecha_archivo . '.jpg';
            $this->RutaPdf = './xml/FacturaTimbrada'. $fecha_archivo . '.pdf';
            
            
            #Busca en el archivo xml timbrado el UUID
            $xmlTimbrado = simplexml_load_file('../xml/FacturaTimbrada'. $fecha_archivo . '.xml');
            $namespaceXml = $xmlTimbrado->getNamespaces(true);
            $xmlTimbrado->registerXPathNamespace('t', $namespaceXml['tfd']);
            
            foreach ($xmlTimbrado->xpath('//t:TimbreFiscalDigital') as $Timbrado) {
                $this->UUID = $Timbrado['UUID'];
            } 
            return true;
        
        }
        else
        {
           
//        print_r($descripcionResultado);
            setFailureMessage("¡Ha ocurrido un error! ".$descripcionResultado);
            header("Location: ../F_A_FacturasFiscales.php");
            return false; 
        }
    }
    
    
    
}

