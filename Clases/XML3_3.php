<?php

include_once 'SQL_DML.php';
require_once 'Empresa.php';
require_once 'ClientesFacturas.php';
require_once 'CatalogoEstado.php';
require_once 'CatalogoMunicipio.php';
require_once 'ConfiguracionFacturas.php';
require_once 'UnidadMedida.php';
require_once 'CatalogoMetodoPago.php';
require_once 'IntegracionTimbrado.php';
require_once 'RegimenFiscal.php';
require_once 'CatalogoFormaPago.php';
require_once("../dompdf/dompdf_config.inc.php");
require_once 'Moneda.php';


class Xml {
    #Sección Comprobante
    public $Version;
    public $Fecha;
    public $Sello;
    public $FormaPago;
    public $NoCertificado;
    public $Certificado;
    public $Subtotal;
    public $Moneda;
    public $Total;
    public $TipoDeComprobante;
    public $MetodoPago;
    public $NumCtaPago;
    public $Folio;
    
    #Sección Emisor
    public $RfcEmisor;
    public $NombreEmisor;
    public $RegimenFiscal;
    #Domicilio del emisor
    public $CalleEmisor;
    public $NoExteriorEmisor;
    public $NoInteriorEmisor;
    public $ColoniaEmisor;
    public $MunicipioEmisor;
    public $EstadoEmisor;
    public $PaisEmisor;
    public $CodigoPostalEmisor;//este va a ser igual que el LugarExpedición
    public $LugarExpedicion;
    
    #Sección Receptor
    public $RfcReceptor;
    public $NombreReceptor;
    public $UsoCFDIReceptor;
     #Domicilio del receptor
    public $CalleReceptor;
    public $NoExteriorReceptor;
    public $NoInteriorReceptor;
    public $ColoniaReceptor;
    public $MunicipioReceptor;
    public $EstadoReceptor;
    public $PaisReceptor;
    public $CodigoPostalReceptor;
    
    #Sección Conceptos
    public $ConceptosFactura;//es un arreglo ClaveProdServ, Cantidad, ClaveUnidad, Descripcion, ValorUnitario, Importe
    
    public $Cantidad;
    public $ClaveProdServ;//noIdentificacion
    public $ClaveUnidad;
    public $Unidad;
    public $Descripcion;
    public $ValorUnitario;
    public $ImporteConcepto;



    #Sección Impuestos/traslados
    public $Impuesto;
    public $Tasa;
    public $Importe;
    
    
    public $array_impuestos_traslados = array();  
//    public $TotalIva;
//    public $TipoFactor;

    #Sección timbrada
    public $UUID;
    public $FechaTimbrado;
    public $NoCertificadoSAT;
    public $SelloCFD;
    public $SelloSAT;
    public $CadenaOriginal;


#Método para generar la estructura correcta del xml que se enviará para timbrado por el PAC
    #Está en versión= 3.3
    public function GenerarXml($idCliente, $array_folio_comandas,$folio){
        $this->Version='3.3';
        
        
        $hora = date("H:i:s");
        $tiempo = date("H-i-s");
        $fecha = date("Y-m-d");
        $fecha_hora = $fecha . "T" . $tiempo;
        $fecha.= 'T'. $hora;
        
        
        $this->Fecha=$fecha;
        
        
        $objConfig = new ConfiguracionFacturas();
        $objConfig->ObtenerPorId(1);
        
        $objMoneda = new Moneda();
        $objMoneda->ConsultarPorId($objConfig->IdMoneda);
        $this->Moneda = $objMoneda->Clave;
        $this->TipoDeComprobante = "I";
        
        
        $this->ClaveProdServ = "90101501";//clave de producto para restaurantes 
        
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        
        
        $this->RfcEmisor = $objEmpresa->RFC;
        $this->NombreEmisor = $objEmpresa->NombreComercial;
        $this->RegimenFiscal = $objEmpresa->RegimenFiscal;
        $this->CalleEmisor = $objEmpresa->Calle;
        $this->NoInteriorEmisor = $objEmpresa->NumeroInterior;
        $this->NoExteriorEmisor = $objEmpresa->NumeroExterior;
        $this->ColoniaEmisor = $objEmpresa->Colonia;
        $this->CodigoPostalEmisor = $objEmpresa->CodigoPostal;
        
        $objMunicipio = new CatalogoMunicipio(); 
//        $objMunicipio->ObtenerPorId($objEmpresa->IdMunicipio);#este es de la empresa, aún no hay campo municipio/estado
//        $this->MunicipioEmisor = $objMunicipio->DESCRIP;
        $this->MunicipioEmisor = "IRAPUATO";
        
         
        $objEstado = new CatalogoEstado();
//        $objEstado->ObtenerPorId($objEmpresa->IdEstado);
//        $this->EstadoEmisor = $objEstado->DESCRIP;    
        
        $this->EstadoEmisor= "GUANAUATO";
      
        $objReceptor = new ClientesFacturas();
        $objReceptor->obtenerPorID($idCliente);
        
        $this->RfcReceptor = $objReceptor->RFC;
        $this->NombreReceptor = $objReceptor->NombreCliente;
        $this->CalleReceptor = $objReceptor->Calle;
        $this->NoInteriorReceptor = $objReceptor->NumeroInterior;
        $this->NoExteriorReceptor = $objReceptor->NumeroExterior;
        $this->ColoniaReceptor = $objReceptor->Colonia;
        $this->CodigoPostalReceptor = $objReceptor->CodigoPostal;
        
        
        $objMunicipio->ObtenerPorId($objReceptor->IdMunicipio);
        $this->MunicipioReceptor = $objMunicipio->DESCRIP;
        
       
        $objEstado->ObtenerPorId($objReceptor->IdEstado);
        $this->EstadoReceptor = $objEstado->DESCRIP;
        
        $numeroInteriorEmisor= "";
//        $objEstado->ObtenerPorId($objReceptor->IdEstado);
        $numeroInteriorReceptor="";
        
        if($this->NoInteriorEmisor!=null){
            $numeroInteriorEmisor = 'noInterior="'. $this->NoInteriorEmisor .'" ';
        }
        
        if($this->NoInteriorReceptor!=null){
            $numeroInteriorReceptor = 'noInterior="'. $this->NoInteriorReceptor .'" '; 
        }
        $this->PaisEmisor = "MEX";
        $this->PaisReceptor = "MEX";
        
        $objConfiguracion = new ConfiguracionFacturas();
        $objConfiguracion->ObtenerPorId(1);
        $this->Descripcion = $objConfiguracion->ConceptoDescripcion;
       
        $objUnidad = new UnidadMedida();
        $objUnidad->ConsultarPorId($objConfiguracion->IdUnidad);
        $this->ClaveUnidad = $objUnidad->Clave;
        $this->Unidad = $objUnidad->Descripcion;
        
        $this->Impuesto = "002";//IVA
        $this->TipoFactor = "Tasa";
        
        
        #Lee todas las ventas según la comanda
        $contador = 0;
        $array_ventas = array();
        $query = "Select V.ID as IDVenta, V.IdComanda, V.IdFormaPago, V.IdMetodoPago, V.NumeroCuenta, D.ID as IDDetalle, 
                D.DescripcionProducto, D.Cantidad, D.PrecioCarta, D.PrecioSinIva, D.IVA, D.SubTotal, D.Total 
                from Ventas V join DetalleVenta D on V.ID = D.IdVenta";
        
        #forma el query para traer la información de todas las ventas según el IdComanda
        for($contador =0; $contador < count($array_folio_comandas); $contador++)
        {
            if($contador == 0)
            {
                $query.= " where IdComanda='$array_folio_comandas[$contador]'";
            }
            else {
                $query.= " or IdComanda='$array_folio_comandas[$contador]'";
            }    
        }
        #Trae los registros de las tablas DetalleVenta y Venta
        $con = Conexion();
        $valor = sqlsrv_query($con, $query);
        $contador=0;
        while ($Datos = sqlsrv_fetch_array($valor)) {
           $array_ventas[$contador] = array($Datos['IDVenta'], $Datos['IdComanda'], $Datos['IdFormaPago'], $Datos['IdMetodoPago'], 
               $Datos['NumeroCuenta'], $Datos['IDDetalle'], $Datos['DescripcionProducto'], $Datos['Cantidad'], $Datos['PrecioCarta'],
               $Datos['PrecioSinIva'], $Datos['IVA'], $Datos['SubTotal'], $Datos['Total']); 
            $contador++;
        }
        sqlsrv_close($con);
        
        $metodoPago = $array_ventas[0][3];
        $objMetodoPago = new CatalogoMetodoPago();
        $objMetodoPago->ConsultarPorId($metodoPago);
        $this->MetodoPago = $objMetodoPago->Clave;
        
       
        $array_formas_pago = array();
        
        $suma_total=0;
        $suma_subtotal=0;
        $suma_iva=0;
        $array_cuentas = array ();
        $array_iva = array();
       
        #Factura detalle general (todo en un sólo concepto)
        for($contador = 0; $contador < count($array_ventas); $contador++)
        {
            $suma_subtotal += $array_ventas[$contador][11];
            $suma_iva += $array_ventas[$contador][9];
            $suma_total += $array_ventas[$contador][12];
            if(!empty($array_ventas[$contador][4]))
            {
                 $array_cuentas[0][$contador] = $array_ventas[$contador][4];//numeroCuenta
            }
            
            if($array_ventas[$contador][2] < 10){
               $array_formas_pago[0][$contador] ="0" . $array_ventas[$contador][2]; //formas de pago 
            }
            else{
                $array_formas_pago[0][$contador] = $array_ventas[$contador][2]; //formas de pago
            }
            
            $array_iva[0][$contador] = $array_ventas[$contador][10]; //iva e importe
            
        }
        $this->Subtotal = round($suma_subtotal,2);
        $this->Total = round($suma_total,2);
        $TotalIva = round($suma_iva,2);
        
        $formasPago_repetidos = array();
        $formasPago_repetidos = array_count_values($array_formas_pago[0]);//cuantas veces se repite y cuál es el valor
        $temporal="";
        for($contador=0; $contador < count($formasPago_repetidos); $contador++)
        {
            if($contador==0){//trae los datos sin el cero y es necesario para el xml
                $temporal .= array_keys($formasPago_repetidos)[$contador] ;
            }
            else {
                $temporal .= ','. array_keys($formasPago_repetidos)[$contador] ;
            }
        }
        $this->FormaPago = $temporal;
        
        $this->NumCtaPago="";
        
        #Realiza un distinct para que no se repitan las cuentas
        $cuentas_repetidas= array();
        $temporal="";
        if(count($array_cuentas) > 0)
        {
            $cuentas_repetidas = array_count_values($array_cuentas[0]);
            if(count($cuentas_repetidas) != 0)
        {
           #cuantas veces se repite y cuál es el valor
            $temporal="";
            
            for($contador=0; $contador < count($cuentas_repetidas); $contador++)
            {
                $elemento = array_keys($cuentas_repetidas)[$contador];
                if($contador==0){
                    
                    if(!empty($elemento))
                    {
                        $temporal .= array_keys($cuentas_repetidas)[$contador] ;
                    }
                    
                    
                    
                }
                else {
                    if(!empty($elemento))
                    {
                        if($temporal=="")
                            $temporal .= array_keys($cuentas_repetidas)[$contador] ;
                        else
                             $temporal .= "," . array_keys($cuentas_repetidas)[$contador] ;
                    }
                }
            }
             
        }
        }
        
        if($temporal == NULL || $temporal == " " || $temporal== "")
        {
            $this->NumCtaPago = "";
        }
        else{
            $this->NumCtaPago= 'NumCtaPago="'. $temporal .'"';
        }
//        
        
        #Determina el importe de cada una de las tasas de iva, para luego hacer un ciclo al construir el xml
        
        $iva_importe_distintos= array();
        $array_sumaIva= array();
        $iva_importe_distintos = array_count_values($array_iva[0]);
        $suma=0;
        #cuantas veces se repite y cuál es el valor
        $temporal="";
        for($contador=0; $contador < count($iva_importe_distintos); $contador++)//valor de cada iva
        {
            for($contador_ventas=0; $contador_ventas < count($array_ventas); $contador_ventas++)//si hay en venta
            {
                if(array_keys($iva_importe_distintos)[$contador] == $array_ventas[$contador_ventas][10])//ivaNorepetido == iva del elemento de ventas
                {
                    $suma += $array_ventas[$contador_ventas][9];//suma de precio sin iva con la misma tasa
                }
            }
            $array_sumaIva[0][$contador] = $suma;
            $suma=0;
        }
             
               
        
        
         $xml ='<?xml version="1.0" encoding="utf-8"?>
<cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd "'
    .'CondicionesDePago="" Descuento="" Fecha="" Folio="" FormaPago=""'
    .' LugarExpedicion="" MetodoPago="" Moneda="" SubTotal="" TipoCambio="1" '
    .' TipoDeComprobante="I" Total="" Version="" xmlns:cfdi="http://www.sat.gob.mx/cfd/3">
  <cfdi:Emisor Nombre="" RegimenFiscal="" Rfc="" />
  <cfdi:Receptor Nombre="" Rfc="" UsoCFDI="G01" />
  <cfdi:Conceptos>
    <cfdi:Concepto Cantidad="" ClaveProdServ="" ClaveUnidad="" Descripcion="" Descuento="" Importe="" Unidad="" ValorUnitario="">
      <cfdi:Impuestos>
        <cfdi:Traslados>
          <cfdi:Traslado Base="" Importe="" Impuesto="" TasaOCuota="" TipoFactor="" />
        </cfdi:Traslados>
      </cfdi:Impuestos>
    </cfdi:Concepto>
  </cfdi:Conceptos>
  <cfdi:Impuestos TotalImpuestosTrasladados="">
    <cfdi:Traslados>
      <cfdi:Traslado Importe="" Impuesto="" TasaOCuota="" TipoFactor="" />
    </cfdi:Traslados>
  </cfdi:Impuestos>
</cfdi:Comprobante>';
                 
       
        
       
        
        

      $ruta = "C:\\xampp\htdocs\Sistema_BIXA\xml\ArchivosSellados\Factura$fecha_hora.xml";
//        $ruta = "C:\\xampp\htdocs\Sistema_BIXA\xml\Archivo.xml";
        $archivo = fopen($ruta, 'w+');//lo crea en caso de que no exista, si no, escribe sobre él.
       

       fwrite($archivo, $xml);
       fclose($archivo); 
     
        
      

       return $fecha_hora;
    }


}