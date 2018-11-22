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
require_once 'DetallePago.php';


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
    public $Descuento;
    
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
//    public $ClaveProdServ;//noIdentificacion
//    public $ClaveUnidad;
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
    #Está en versión= 3.2
    public function GenerarXml($idCliente, $array_id_ventas,$folio, $metodoPago, $formasPago, $cuentasPago,$tipoFactura){
        $this->Version='3.2';
        
        
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
        $decimales = $objMoneda->Decimales;
        $this->TipoDeComprobante = "ingreso";
        
        
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        
        $this->RfcEmisor = $objEmpresa->RFC;
        $this->NombreEmisor = $objEmpresa->NombreComercial;
        
        $objRegimen = new RegimenFiscal();
        $objRegimen->ConsultarPorId($objEmpresa->RegimenFiscal);
        
        $this->RegimenFiscal = $objRegimen->Nombre;
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
        
        $this->EstadoEmisor= "GUANAJUATO";
      
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
        
//        $this->Impuesto = "002";//IVA
//        $this->TipoFactor = "Tasa";
        $this->Impuesto="IVA";
        $this->TipoFactor = $objConfig->IVA;
        
        #Lee todas las ventas según la comanda
        $contador = 0;
        $array_ventas = array();
        $query = "Select V.ID as IDVenta, V.IdComanda, V.IdMetodoPago, D.ID as IDDetalle, 
                D.DescripcionProducto, D.Cantidad, D.PrecioCarta, D.PrecioSinIva, D.IVA, D.SubTotal, D.Total  
                from Ventas V join DetalleVenta D on V.ID = D.IdVenta";
        
        #forma el query para traer la información de todas las ventas
        $array_id_ventas = split(",", $array_id_ventas);
        for($contador =0; $contador < count($array_id_ventas); $contador++)
        {
            if($contador == 0)
            {
                $query.= " where IDVenta='$array_id_ventas[$contador]'";
            }
            else {
                $query.= " or IDVenta='$array_id_ventas[$contador]'";
            }    
        }
        #Trae los registros de las tablas DetalleVenta y Venta
        $con = Conexion();
        $valor = sqlsrv_query($con, $query);
        $contador=0;
        $array_ventas = array();
        while ($Datos = sqlsrv_fetch_array($valor)) {
           
           $array_ventas[$contador] = array($Datos['IDVenta'], $Datos['IdComanda'], $Datos['IdMetodoPago'], 
               $Datos['IDDetalle'], $Datos['DescripcionProducto'], $Datos['Cantidad'], $Datos['PrecioCarta'],
               $Datos['PrecioSinIva'], $Datos['IVA'], $Datos['SubTotal'], $Datos['Total']); 
            $contador++;
        }
        $query = "Select Descuento from Ventas";
        $array_descuentos = array();
        for($contador =0; $contador < count($array_id_ventas); $contador++)
        {
            if($contador == 0)
            {
                $query.= " where ID='$array_id_ventas[$contador]'";
            }
            else {
                $query.= " or ID='$array_id_ventas[$contador]'";
            }    
        }
        $valor = sqlsrv_query($con, $query);
        $contador =0;
        while ($Datos = sqlsrv_fetch_array($valor)) {
           
           $array_descuentos[$contador] = array($Datos['Descuento']); 
            $contador++;
        }
        
        sqlsrv_close($con);
        
        $objMetodoPago= new CatalogoMetodoPago();
        $objMetodoPago->ConsultarPorClave($metodoPago);
        $this->MetodoPago = $objMetodoPago->Nombre;
        
       
        $array_formas_pago = array();
        
        $suma_total=0.0;
        $suma_subtotal=0.00;
        $suma_iva=0.00;
        $suma_descuentos = 0.00;
        $array_cuentas = array ();
        $array_iva = array();
       
        ##IDVenta= [0]      ##IdComanda=[1]     ##IdMetodoPago=[2]      ##IDDetalle=[3]
        ##DescripcionProducto=[4]   ##Cantidad=[5]     PrecioCarta=[6]
        ##PrecioSinIva=[7]      IVA[8]      SubTotal[9]     Total=[10]
        
        
        #Factura detalle general (todo en un sólo concepto)
        $contador=0;
        for($contador = 0; $contador < count($array_ventas); $contador++)
        {
            $suma_subtotal += $array_ventas[$contador][9];//subtotal
            $suma_total += $array_ventas[$contador][10];//total
                      
            $array_iva[0][$contador] = $array_ventas[$contador][8]; //iva e importe
        }
        
        for($contador=0; $contador < count($array_descuentos);$contador++)
        {
            $suma_descuentos += $array_descuentos[$contador][0];
        }
        
        $porcentajeIva = $_POST['PorcentajeIva'];
        $this->Total = number_format($suma_total-$suma_descuentos,$objMoneda->Decimales, '.', '');
         $this->Descuento= number_format($suma_descuentos, $objMoneda->Decimales, '.','');
        if($porcentajeIva == 0)
        {
            $this->Subtotal = number_format($suma_subtotal,$objMoneda->Decimales,'.',''); 
            $TotalIva = number_format(($suma_total-$suma_subtotal),$decimales, '.', '');
            
        }else{
            $this->Subtotal = number_format($this->Total/(1+($porcentajeIva/100)),$objMoneda->Decimales,'.','');
            $TotalIva = $this->Subtotal * ($porcentajeIva/100);
        }
        
        

       
        
        
        
   

        $temporal_formas_pago = explode(",", $formasPago);
        $temporal="";

            for($contador=0; $contador < count($temporal_formas_pago); $contador++)
            {
                if($temporal_formas_pago[$contador] < 10)
                {
                    if($contador==0)
                    {
                        $temporal .= "0".$temporal_formas_pago[$contador];
                    }else{
                      $temporal .= ",0" . $temporal_formas_pago[$contador];
                    }
                }else{
                    if($contador==0)
                    {
                        $temporal .= $temporal_formas_pago[$contador];
                    }else{
                        $temporal .= "," . $temporal_formas_pago[$contador];
                    }
                }
                
            }
        
        $this->Folio = $folio;
        $this->FormaPago = $temporal;
        $this->NumCtaPago = $cuentasPago;
        $NumCuentaPago='';
//       
        
        if($this->NumCtaPago == "" || $this->NumCtaPago =="    ")
        {
            $NumCuentaPago = '';
        }else{
            $NumCuentaPago = 'NumCtaPago="'. $this->NumCtaPago . '"';
        }
        
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
                if(array_keys($iva_importe_distintos)[$contador] == $array_ventas[$contador_ventas][8])//ivaNorepetido == iva del elemento de ventas
                {
                    $suma += $array_ventas[$contador_ventas][10]-$array_ventas[$contador_ventas][9];//suma de precio sin iva con la misma tasa
                }
            }
            $array_sumaIva[0][$contador] = $suma;
            $suma=0;
        }
   
               
        
        
         $xml ='<?xml version="1.0" encoding="utf-8"?>
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" ';
	        
        $xml.= 'version="'.$this->Version.'" folio="'.$this->Folio.'" fecha="'. $this->Fecha .'" formaDePago="'. $this->MetodoPago.'" '
                . ' subTotal="' .$this->Subtotal. '" descuento="'.$this->Descuento.'" Moneda="'.$this->Moneda.'" '
                . 'total="'.$this->Total.'" tipoDeComprobante="'.$this->TipoDeComprobante.'" metodoDePago="'.$this->FormaPago.'" '
                . 'LugarExpedicion="'.utf8_decode($this->MunicipioEmisor). ", " . utf8_decode($this->EstadoEmisor) .'" '.$NumCuentaPago.' >
    <cfdi:Emisor rfc="'.$this->RfcEmisor.'" nombre="'.$this->NombreEmisor.'" >
        <cfdi:DomicilioFiscal calle="'.$this->CalleEmisor.'" '. $numeroInteriorEmisor . 'noExterior="'.$this->NoExteriorEmisor.'" '
                .'colonia="'.$this->ColoniaEmisor.'" municipio="'.$this->MunicipioEmisor.'" estado="'.$this->EstadoEmisor.'" '
                .'pais="'.$this->PaisEmisor.'" codigoPostal="'.$this->CodigoPostalEmisor.'" />
        <cfdi:RegimenFiscal Regimen="'.$this->RegimenFiscal.'" />
    </cfdi:Emisor>
    <cfdi:Receptor rfc="'.$this->RfcReceptor.'" nombre="'.$this->NombreReceptor.'" >
        <cfdi:Domicilio calle="'.$this->CalleReceptor.'" '.$numeroInteriorReceptor . 'noExterior="'.$this->NoExteriorReceptor .'" '
                .'colonia="'.$this->ColoniaReceptor.'" municipio="'.$this->MunicipioReceptor.'" estado="'.$this->EstadoReceptor.'" '
                .'pais="'.$this->PaisReceptor.'" codigoPostal="'.$this->CodigoPostalReceptor.'" />
    </cfdi:Receptor>
    <cfdi:Conceptos>';
        
        switch($tipoFactura)
        {
            case "1":#Factura general o por consumo
                $xml .= ' <cfdi:Concepto cantidad="1" '
                . 'unidad="'.$this->Unidad.'" descripcion="'.$this->Descripcion.'" valorUnitario="'.number_format($this->Subtotal,$decimales, '.', '').'" importe="'.number_format($this->Subtotal,$decimales, '.', '').'" />
                </cfdi:Conceptos>';
            break;
            case "2":#Factura Detallada
                for($contador=0; $contador < count($array_ventas); $contador++)
                {
                    $xml .= '<cfdi:Concepto cantidad="'.$array_ventas[$contador][5].'" '
                . 'unidad="'.$this->Unidad.'" descripcion="'.utf8_encode($array_ventas[$contador][4])
                            .'" valorUnitario="'.number_format($array_ventas[$contador][7],$decimales, '.', '')
                            .'" importe="'.number_format($array_ventas[$contador][9],$decimales, '.', '').'" />';
                }
                $xml .= '</cfdi:Conceptos>';
            break;
        }
        
       
    $xml.='<cfdi:Impuestos totalImpuestosTrasladados="'.number_format($TotalIva,$objMoneda->Decimales,'.','').'" >
        <cfdi:Traslados>
              ';
    if($porcentajeIva == 16){
        $xml.= '<cfdi:Traslado impuesto="'.$this->Impuesto.'" tasa="'.$porcentajeIva.'" importe="'.number_format($TotalIva,$objMoneda->Decimales,'.','').'" />';
    }else if($porcentajeIva == 0){
                 $xml.= '<cfdi:Traslado impuesto="'.$this->Impuesto.'" tasa="'.$porcentajeIva.'" importe="'.number_format(0,$objMoneda->Decimales,'.','').'" />';
    }   
    $xml.=' </cfdi:Traslados>
    </cfdi:Impuestos>
</cfdi:Comprobante>';    
       
        $ruta = "../xml/ArchivosSellados/Factura$fecha_hora.xml";

        $archivo = fopen($ruta, 'w+');//lo crea en caso de que no exista, si no, escribe sobre él.
       

       fwrite($archivo, $xml);
       fclose($archivo); 
     
        
      

       return $fecha_hora;
    }

    public function GenerarXmlParaFacturaGlobal($idCliente, $sales, $folio){
        $this->Folio = $folio;
        
        
        $this->Version='3.2';
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
        $decimales = $objMoneda->Decimales;
        $this->TipoDeComprobante = "ingreso";
        
        
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        
        $this->RfcEmisor = $objEmpresa->RFC;
        $this->NombreEmisor = $objEmpresa->NombreComercial;
        
        $objRegimen = new RegimenFiscal();
        $objRegimen->ConsultarPorId($objEmpresa->RegimenFiscal);
        
        $this->RegimenFiscal = $objRegimen->Nombre;
        $this->CalleEmisor = $objEmpresa->Calle;
        $this->NoInteriorEmisor = $objEmpresa->NumeroInterior;
        $this->NoExteriorEmisor = $objEmpresa->NumeroExterior;
        $this->ColoniaEmisor = $objEmpresa->Colonia;
        $this->CodigoPostalEmisor = $objEmpresa->CodigoPostal;
        
        $objMunicipio = new CatalogoMunicipio(); 
        $this->MunicipioEmisor = "IRAPUATO";
        
         
        $objEstado = new CatalogoEstado();   
        
        $this->EstadoEmisor= "GUANAJUATO";
      
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
        
        $this->Impuesto="IVA";
        $this->TipoFactor = $objConfig->IVA;
        
        $porcentajeIva = $_POST['PorcentajeIva'];
        
        $objVentas = new Ventas();
        $array_id_ventas= array();
        $array_total_subtotal= array();
        $array_pagos = array();
        $temporal_ventas = explode(",", $sales);
        $array_porcentaje_iva = array();
        
//        #Se cargan los id de ventas y los descuentos dentro del rango señalado para la factura global
//        $array_id_ventas = $objVentas->ObtenerVentasParaFacturaGlobal($fechaInicio, $fechaFin);
        
    #Se cargan los descuentos y métodos de pago de acuerdo al id de venta
        $array_id_ventas = $objVentas->ObtenerDescuentosParaFacturaGlobal($temporal_ventas);
        
        #Se obtiene el subtotal e importe de cada venta
        $array_total_subtotal = $objVentas->ObtenerIvaSubtotalParaFacturaGlobal($array_id_ventas);
        #se obtienen las formas de pago y cuentas de todas las ventas en el rango para la factura global
        $objDetallePago = new DetallePago();
        $array_pagos =  $objDetallePago->ObtenerPagosParaFacturaGlobal($array_id_ventas);

        $suma_subtotal = 0.00;
        $suma_importeIva = 0.00;
        $suma_descuentos = 0.00;
        $array_iva_tasa= array();
        
        $query = "Select distinct IdVenta, IVA from DetalleVenta where ";
       foreach($array_id_ventas as $ventas)
       {
           if($ventas == end($array_id_ventas))
           {
               $query .= "IdVenta='$ventas->ID'";
           }else{
               $query .= "IdVenta='$ventas->ID' or ";
           }
       }
       $con = Conexion();
       $valor = sqlsrv_query($con, $query);
       $iva_importe = array();
       while ($Datos = sqlsrv_fetch_array($valor)) {
            $temporal_iva = array( "IVA" => $Datos['IVA']);
            array_push($array_iva_tasa, $temporal_iva);
        }
        sqlsrv_close($con);

        
        $suma_total= 0.0;
        $contador=0;
        $temporal_total=0;
        $temporal_subtotal=0;
        $temporal_importe_iva=0;
        $suma_subtotal =0.00;
        $suma_importeIva =0.00;
        $array_total_subtotal_iva = array();
        #Se suma el subtotal de cada venta, al igual que el importe de IVA
        foreach ($array_total_subtotal as $dato)
        {
            $temporal_subtotal=0;
            $temporal_total=0;
            $temporal_importe_iva=0;
            
            $temp=$array_id_ventas[$contador]->Descuento;
            if($array_id_ventas[$contador]->Descuento > 0)//hay descuento
            {
                $temp = $array_iva_tasa[$contador]['IVA'];
                switch($array_iva_tasa[$contador]['IVA']){
                    case 16:
                        
                        $temporal_total = $dato['total']-$array_id_ventas[$contador]->Descuento;
                        $temporal_subtotal = $temporal_total/(1+($array_iva_tasa[$contador]['IVA']/100));
                        $temporal_importe_iva = $temporal_subtotal * ($array_iva_tasa[$contador]['IVA']/100);
                        
                        $array_total_subtotal_iva[$contador] = array("total" => $temporal_total, "iva" => $temporal_importe_iva, 
                            'subtotal' => $temporal_subtotal);
                        $suma_total += $temporal_total;
                        $suma_subtotal += $temporal_subtotal;
                        $suma_importeIva += $temporal_importe_iva;
                        break;
                    default :
                        $temporal_total = $dato['total']-$array_id_ventas[$contador]->Descuento;;
                        $temporal_subtotal = $temporal_total;
                        $temporal_importe_iva = 0;
                        
                        $array_total_subtotal_iva[$contador] = array("total" => $temporal_total, "iva" => $temporal_importe_iva, 
                            'subtotal' => $temporal_subtotal);
                        
                        $suma_total += $temporal_total;
                        $suma_subtotal += $temporal_subtotal;
                        $suma_importeIva += $temporal_importe_iva;
                        break;
                }
            }else{//no hay descuento
                $temp = $array_iva_tasa[$contador]['IVA'];
                switch($array_iva_tasa[$contador]['IVA']){
                    case 16:
                        $temporal_total = $dato['total'];
                        $temporal_subtotal = $temporal_total/(1+($array_iva_tasa[$contador]['IVA']/100));
                        $temporal_importe_iva = $temporal_subtotal * ($array_iva_tasa[$contador]['IVA']/100);
                        
                        $array_total_subtotal_iva[$contador] = array("total" => $temporal_total, "iva" => $temporal_importe_iva, 
                            'subtotal' => $temporal_subtotal);
                        
                        $suma_total += $temporal_total;
                        $suma_subtotal += $temporal_subtotal;
                        $suma_importeIva += $temporal_importe_iva;
                        break;
                    default :
                        $temporal_total = $dato['total'];
                        $temporal_subtotal = $temporal_total;
                        $temporal_importe_iva = 0;
                        
                        $array_total_subtotal_iva[$contador] = array("total" => $temporal_total, "iva" => $temporal_importe_iva, 
                            'subtotal' => $temporal_subtotal);
                        
                        $suma_total += $temporal_total;
                        $suma_subtotal += $temporal_subtotal;
                        $suma_importeIva += $temporal_importe_iva;
                        break;
                }
                
            }       
             $contador++;       
        }
        $this->Subtotal = number_format($suma_subtotal,$decimales,'.','');
        $TotalIva = number_format($suma_importeIva,$decimales,'.','');
        $this->Total = number_format($suma_total,$decimales,'.','');
        
        #Se suma el descuento de cada venta
        foreach ($array_id_ventas as $descuento)
        {
            $suma_descuentos += $descuento->Descuento;
            $formaPago= $descuento->IdMetodoPago;
        }
        $this->Descuento = number_format($suma_descuentos,$decimales,'.','');
        
        $objMetodoPago = new CatalogoMetodoPago();
        $objMetodoPago->ConsultarPorClave($formaPago);
        $this->MetodoPago = $objMetodoPago->Nombre;
        
        $Cuenta="    ";
       #Concatena las formas de pago en un string poniendo comas (,) entre cada una.
        $forma_pago ="";
        $todas_cuentas_pago = "";
       foreach ($array_pagos as $pago)
       {
           if ($pago === end($array_pagos))
           {
                if($pago->IdFormaPago < 10){
                   $forma_pago.= "0" . $pago->IdFormaPago;
                }
                else {
                   $forma_pago.= $pago->IdFormaPago; 
                } 
           }else{
                if($pago->IdFormaPago < 10){
                   $forma_pago.= "0" . $pago->IdFormaPago . ",";
                }
                else {
                   $forma_pago.= $pago->IdFormaPago . ","; 
                } 
           }
           $cuenta = $pago->NumeroCuenta;
           
           if ( $pago->NumeroCuenta > 0) {
                if ($Cuenta == "    ") {
                     $Cuenta = $pago->NumeroCuenta;
                 } else {
                     $Cuenta = $Cuenta . "," . $pago->NumeroCuenta;
                 }
           }
           
           
       }
       $this->FormaPago = $forma_pago;
       $this->NumCtaPago = $Cuenta;
       
       if($this->NumCtaPago == "" || $this->NumCtaPago =="    ")
        {
            $NumCuentaPago = '';
        }else{
            $NumCuentaPago = 'NumCtaPago="'. $this->NumCtaPago . '"';
        }
       
       $bandera_tasa0 = false;
        foreach ($array_iva_tasa as $tasa)
        {
            if($tasa['IVA'] == 0)
            {
                $bandera_tasa0=true;
                break;
            }
        }
        
    
         $xml ='<?xml version="1.0" encoding="utf-8"?>
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" ';
	        
        $xml.= 'version="'.$this->Version.'" folio="'.$this->Folio.'" fecha="'. $this->Fecha .'" formaDePago="'. $this->MetodoPago.'" '
                . ' subTotal="' .$this->Subtotal. '" descuento="'.$this->Descuento.'" Moneda="'.$this->Moneda.'" '
                . 'total="'.$this->Total.'" tipoDeComprobante="'.$this->TipoDeComprobante.'" metodoDePago="'.$this->FormaPago.'" '
                . 'LugarExpedicion="'.utf8_decode($this->MunicipioEmisor). ", ". utf8_decode($this->EstadoEmisor) .'" '.$NumCuentaPago.' >
    <cfdi:Emisor rfc="'.$this->RfcEmisor.'" nombre="'.$this->NombreEmisor.'" >
        <cfdi:DomicilioFiscal calle="'.$this->CalleEmisor.'" '. $numeroInteriorEmisor . 'noExterior="'.$this->NoExteriorEmisor.'" '
                .'colonia="'.$this->ColoniaEmisor.'" municipio="'.$this->MunicipioEmisor.'" estado="'.$this->EstadoEmisor.'" '
                .'pais="'.$this->PaisEmisor.'" codigoPostal="'.$this->CodigoPostalEmisor.'" />
        <cfdi:RegimenFiscal Regimen="'.$this->RegimenFiscal.'" />
    </cfdi:Emisor>
    <cfdi:Receptor rfc="'.$this->RfcReceptor.'" nombre="'.$this->NombreReceptor.'" >
        <cfdi:Domicilio calle="'.$this->CalleReceptor.'" '.$numeroInteriorReceptor . 'noExterior="'.$this->NoExteriorReceptor .'" '
                .'colonia="'.$this->ColoniaReceptor.'" municipio="'.$this->MunicipioReceptor.'" estado="'.$this->EstadoReceptor.'" '
                .'pais="'.$this->PaisReceptor.'" codigoPostal="'.$this->CodigoPostalReceptor.'" />
    </cfdi:Receptor>
    <cfdi:Conceptos>';
     $contador=0;
    foreach($array_total_subtotal_iva as $valor)
    {
           
        $xml .= '<cfdi:Concepto cantidad="1" unidad="'.$this->Unidad.'" descripcion="Folio: ' .$array_id_ventas[$contador]->ID
            .'" valorUnitario="'.number_format($valor['subtotal'],$decimales, '.', '')
            .'" importe="'.number_format($valor['subtotal'],$decimales, '.', '').'" />';
        $contador++;
    }
    $xml .= '</cfdi:Conceptos>';
        
       
    $xml.='<cfdi:Impuestos totalImpuestosTrasladados="'.$TotalIva.'" >
        <cfdi:Traslados>';
    $xml .= '<cfdi:Traslado impuesto="'.$this->Impuesto.'" tasa="16" importe="'.number_format($suma_importeIva,$decimales,'.','').'" />';
        if($bandera_tasa0 == true)
        {
            $xml .= '<cfdi:Traslado impuesto="'.$this->Impuesto.'" tasa="0" importe="0" />';
        }
    $xml.=' </cfdi:Traslados>
    </cfdi:Impuestos>
</cfdi:Comprobante>';    
       
        $ruta = "../xml/ArchivosSellados/Factura$fecha_hora.xml";

        $archivo = fopen($ruta, 'w+');//lo crea en caso de que no exista, si no, escribe sobre él.
       

       fwrite($archivo, $xml);
       fclose($archivo); 
     
        
      

       return $fecha_hora;
    }
    
    
    public function GenerarPdf($nombre_xml, $tipoFactura){
        
        #Lee y abre el xml timbrado
        $xmlTimbrado = simplexml_load_file('../xml/FacturaTimbrada'. $nombre_xml . '.xml');
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        $namespaceXml = $xmlTimbrado->getNamespaces(true);
        $xmlTimbrado->registerXPathNamespace('c', $namespaceXml['cfdi']);
        $xmlTimbrado->registerXPathNamespace('t', $namespaceXml['tfd']);
        
        #Lee los datos del xml según su nodo/namespace
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante') as $cfdiComprobante){
            $this->Version = $cfdiComprobante['version'];
            $this->Folio = $cfdiComprobante['folio'];
            $this->Fecha = $cfdiComprobante['fecha'];
            $this->Sello = $cfdiComprobante['sello'];
            $this->FormaPago = $cfdiComprobante['formaDePago'];
            $this->NoCertificado = $cfdiComprobante['noCertificado'];
            $this->Certificado = $cfdiComprobante['certificado'];
            $this->Subtotal = $cfdiComprobante['subTotal'];
            $this->Descuento = $cfdiComprobante['descuento'];
            $this->Moneda = $cfdiComprobante['Moneda'];
            $this->Total = $cfdiComprobante['total'];
            $this->TipoDeComprobante = $cfdiComprobante['tipoDeComprobante'];
            $this->MetodoPago = $cfdiComprobante['metodoDePago'];
            $this->LugarExpedicion = $cfdiComprobante['LugarExpedicion']; 
            $this->NumCtaPago = $cfdiComprobante['NumCtaPago'];
        } 
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){
            $this->RfcEmisor = $Emisor['rfc'];
            $this->NombreEmisor = $Emisor['nombre'];
         } 
         foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Emisor//cfdi:DomicilioFiscal') as $DomicilioFiscal){
             $this->CalleEmisor = $DomicilioFiscal['calle'];
             $this->NoExteriorEmisor = $DomicilioFiscal['noExterior'];
             $this->NoInteriorEmisor = $DomicilioFiscal['noInterior'];
             $this->ColoniaEmisor = $DomicilioFiscal['colonia'];
             $this->MunicipioEmisor = $DomicilioFiscal['municipio'];
             $this->EstadoEmisor = $DomicilioFiscal['estado'];
             $this->PaisEmisor = $DomicilioFiscal['pais'];
             $this->CodigoPostalEmisor = $DomicilioFiscal['codigoPostal'];
         } 
         foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:RegimenFiscal') as $Regimen)
         {
             $this->RegimenFiscal= $Regimen['Regimen'];
         }
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){
            $this->RfcReceptor = $Receptor['rfc'];
            $this->NombreReceptor = $Receptor['nombre'];
        } 
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Receptor//cfdi:Domicilio') as $ReceptorDomicilio){
            $this->CalleReceptor = $ReceptorDomicilio['calle'];
            $this->NoExteriorReceptor = $ReceptorDomicilio['noExterior'];
            $this->NoInteriorReceptor = $ReceptorDomicilio['noInterior'];
            $this->ColoniaReceptor = $ReceptorDomicilio['colonia'];
            $this->MunicipioReceptor = $ReceptorDomicilio['municipio'];
            $this->EstadoReceptor = $ReceptorDomicilio['estado'];
            $this->PaisReceptor = $ReceptorDomicilio['pais'];
            $this->CodigoPostalReceptor = $ReceptorDomicilio['codigoPostal'];
        }
        
        $array_conceptos = array();
        $contador=0;
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto){
//            $this->Cantidad = $Concepto['cantidad'];
//            $this->Unidad = $Concepto['unidad'];
////            $this->ClaveProdServ = $Concepto['noIdentificacion'];
//            $this->Descripcion = $Concepto['descripcion'];
//            $this->ValorUnitario = $Concepto['valorUnitario'];
//            $this->ImporteConcepto = $Concepto['importe'];
            
            $array_conceptos[$contador] = array($Concepto['cantidad'], $Concepto['unidad'], 
                $Concepto['descripcion'], $Concepto['valorUnitario'],$Concepto['importe']);
            $contador++;
        } 
           
       
        
        $totalIva=0.0;
        foreach($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Impuestos') as $Impuestos)
        {
            $totalIva = $Impuestos['totalImpuestosTrasladados'];
        }
        $contador=0;
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Impuestos//cfdi:Traslados//cfdi:Traslado') as $Traslado){
            
            $this->array_impuestos_traslados[$contador]= array($Traslado['impuesto'], $Traslado['tasa'], $Traslado['importe']);
            $contador++;
        } 
       foreach ($xmlTimbrado->xpath('//t:TimbreFiscalDigital') as $Timbrado) {
           $this->UUID = $Timbrado['UUID'];
           $this->FechaTimbrado = $Timbrado['FechaTimbrado'];
           $this->NoCertificadoSAT = $Timbrado['noCertificadoSAT'];
           $this->SelloCFD = $Timbrado['selloCFD'];
           $this->SelloSAT = $Timbrado['selloSAT'];
         } 

         $numeroInteriorEmisor= "";
         $numeroInteriorReceptor="";
         if($this->NoInteriorEmisor!=null){
            $numeroInteriorEmisor = 'No. interior: '. $this->NoInteriorEmisor;
        }
        
        if($this->NoInteriorReceptor!=null){
            $numeroInteriorReceptor = 'No. interior: '. $this->NoInteriorReceptor; 
        }
        
        
        
        
        $CodigoHtml_pdf="";
        $CodigoHtml_pdf.= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                     <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
                    <title>Formato de factura</title>
                </head>
            <style>
                .div_principal{
                    width: 100%;
                    height: 1000px;
                    background-color:#fff;
                }
                .div_logo{
                        
                        height: 170px;
                        width: 150px;
                        position: absolute;
                        left: 8px;
                        top: 14px;
                        
                }
                .div_receptor, .div_datos_fiscales, .div_consumo, .div_pago_total, .div_timbrado{
                        width:100%;
                }
                .div_folio{
                    position:relatiVE;
                    float:right;
                    width:30%;
                    height:25px;
                    left:489px;

                }
                .div_emisor{
                        width:75%;
                        height:19%;
                        position: relative;
                        top:0px;
                        left:175px;
                        /*float:left;*/
                }
                .div_receptor{
                        position:relative;
                        float: left;
                        height:14%;
                        position:relative;
                        float:right;
                        top:-40px;
                }
                .div_datos_fiscales{

                        height:11%;
                        position:relative;
                        float:right;
                        top:-40px;
                        
                }
                .div_consumo{
                        height:18%;
                        position:relative;
                        float:right;
                       top:-40px;
                       height:auto;
                }

                .div_pago_total{
                        height:8.5%;
                        position:relative;
                        float:right;
                        height:auto;
                }
                .div_timbrado{

                        height:28.5%;
                        position:relative;
                        float:right;
                        height:auto;
                }
	
                #sello_digital_emisor, #sello_digital_sat, #cadena_original{
                        font-size:9px;
                }

                #tabla_emisor, #tabla_receptor{
                        /*border-radius: 15px;*/
                        padding: 3px;
                        margin: 3px;
                        border: 2px solid #000;
                        background-color:#fcfcfc;

                }

                #tabla_pago_total, #tabla_folio{
                        /*border-collapse: collapse;*/
                        /*border: 1px solid #000;*/
                        border-collapse:collapse;
                        border-left:1px solid #000;
                }
               .titulo_tabla{

                        text-align:center;
                        border-radius: 15px 15px 0px 0px;
                       /* -moz-border-radius: 15px 15px 0px 0px;
                        -webkit-border-radius: 15px 15px 0px 0px;*/
                        background-color:#cfcfcf;
                        border-bottom:1px solid #000;
                }

                .titulo_datos_fiscales{
                        border-bottom: 1px solid #000;
                        text-align:center;
                }

                .columnas_concepto{
                        border-bottom: 1px solid #000;
                        background-color: #cfcfcf;
                        border-top: 1px solid #000;
                        text-align:center;
                }

                .campos_destacados{
                       /* border-radius: 5px 0px 5px 0px;*/
                        background-color: #cfcfcf;
                        text-align:center;

                }

                #codigo_qr{
                        width:auto;
                        height:auto;
                }
                .campo_libre{
                    border: #ffffff 1px solid;
                }
                page {
                    margin-top: 0.3em;
                    margin-left: 0.6em;
                }
        </style>';
        
        
       //<IMG SRC="../img/LogoEmpresa.png" width="150px" height="150px" align="center"> 
        
        
       $CodigoHtml_pdf .= '<body>
           <script type="text/php">
            if ( isset($pdf) ) { 
              $font = Font_Metrics::get_font("helvetica", "normal");
              $size = 9;
              $y = $pdf->get_height()-10;
              $x = $pdf->get_width()-50 - Font_Metrics::get_text_width("1/1", $font, $size);
              $pdf->page_text($x, $y, "Hoja {PAGE_NUM} de {PAGE_COUNT}", $font, $size);
            } 
        </script>
          <div class="div_principal">
	  <div class="div_logo">
            
            <IMG SRC="'.$objEmpresa->Logo.'" width="150px" height="150px" align="center">
            
          </div>
         <div class="div_folio">
		<table width="100%" border="1" id="tabla_folio">
			<tr>
				<td width="30%" bgcolor="#cfcfcf" align="center"><strong>FOLIO</strong></td>
				<td width="70%" align="right"><strong>'.$this->Folio.'</strong></td>
			</tr>
		</table>
	  </div>
        <div class="div_emisor">
	    <table width="100%" border="0" id="tabla_emisor">
          <tr>
            <td class="titulo_tabla"><strong>EMISOR</strong></td>
          </tr>
          <tr>
            <td>'.utf8_decode($this->NombreEmisor).'</td>
          </tr>
          <tr>
            <td> RFC: '.$this->RfcEmisor.', R&eacute;gimen fiscal: ' .utf8_decode($this->RegimenFiscal). '</td>
          </tr>
          <tr>
            <td>Domicilio: '.utf8_decode($this->CalleEmisor).' '.$this->NoExteriorEmisor. ' '. $numeroInteriorEmisor. ' ' .utf8_decode($this->ColoniaEmisor).' </td>
          </tr>
          <tr>
            <td>C.P. '.$this->CodigoPostalEmisor.', tel. ' .$objEmpresa->Telefono. '</td>
          </tr>
          <tr><td>'.utf8_decode($this->MunicipioEmisor).', '.utf8_decode($this->EstadoEmisor).', '. utf8_decode($this->PaisEmisor). '</td></tr>
        </table>
    </div>
	  
	 ';
        $objCliente = new ClientesFacturas();
        $objCliente->obtenerPorRFC($this->RfcReceptor);
        
        
        $CodigoHtml_pdf.= '<div class="div_receptor">
            <table width="100%" border="0" id="tabla_receptor">
                <tr>
                  <td class="titulo_tabla"><strong>RECEPTOR</strong></td>
                </tr>
                <tr>
                  <td>RFC: '.$this->RfcReceptor .', '.utf8_decode($this->NombreReceptor).'</td>
                </tr>
                <tr>
                  <td>Domicilio: '.utf8_decode($this->CalleReceptor).' '.  $this->NoExteriorReceptor. ' '. $numeroInteriorReceptor. ' '.utf8_decode($this->ColoniaReceptor). '</td>
                </tr>
                <tr>
                  <td>C.P. '.$this->CodigoPostalReceptor.' tel. '.$objCliente->Telefono.'</td>
                </tr>
                <tr>
                  <td>'.utf8_decode($this->MunicipioReceptor). ', '.utf8_decode($this->EstadoReceptor).', '.utf8_decode($this->PaisReceptor).'</td>
                </tr>
            </table>
	</div>';
        
        $CodigoHtml_pdf.= '<div class="div_datos_fiscales">
         <table width="100%" border="0">
            <tr>
              <td width="58%" class="titulo_tabla">UUID </td>
              <td width="42%" class="titulo_tabla">FECHA Y HORA DE EXPEDICI&Oacute;N </td>
            </tr>
            <tr>
              <td align="center">'.$this->UUID.'</td>
              <td align="center">'.$this->Fecha.'</td>
            </tr>
            <tr>
              <td class="titulo_tabla">NO. DE CERTIFICADO DIGITAL</td>
              <td class="titulo_tabla">LUGAR DE EXPEDICI&Oacute;N </td>
            </tr>
            <tr>
              <td align="center">'.$this->NoCertificado.'</td>
              <td align="center">'.utf8_decode($this->MunicipioEmisor).', '.utf8_decode($this->EstadoEmisor). '</td>
            </tr>
          </table>
		</div>';
        $objMoneda = new Moneda();
        $objMoneda->ConsultarPorClave($this->Moneda);
       
        
        
        $CodigoHtml_pdf.= '<div class="div_consumo">
	<table width="100%" border="0">
            <tr>
              <td width="15%" class="columnas_concepto">CANTIDAD</td>
              <td width="20%" class="columnas_concepto">UNIDAD</td>
              <td width="28%" class="columnas_concepto">DESCRIPCI&Oacute;N</td>
              <td width="25%" class="columnas_concepto">PRECIO UNITARIO </td>
              <td width="12%" class="columnas_concepto">IMPORTE</td>
            </tr>';
        $contador=0;
        $bandera_numerica = -1;
        while($contador < count($array_conceptos)){
            
    //[0]=cantidad, [1]=unidad, [2]=descripcion, [3]= valorUnitario, [4]=importeConcepto
            
            $CodigoHtml_pdf .= '<tr>
              <td align="center">'.$array_conceptos[$contador][0].'</td>
              <td align="center">'.$array_conceptos[$contador][1].'</td>
              <td align="center">'.utf8_decode($array_conceptos[$contador][2]).'</td>
              <td align="center">'.$array_conceptos[$contador][3].'</td>
              <td align="center">'.$array_conceptos[$contador][4].'</td>
            </tr>';
            
            if($tipoFactura=="2")
            {
                if($contador > 14)
                {
                    $residuo= $contador % 15;
                    if($residuo==0)
                    {
                        $bandera_numerica = $bandera_numerica * -1;
                        if($bandera_numerica > 0 )#si el resultado es positivo(1) hay salto de página 
                        {
                            #baja la tabla un poco porque si no queda casi al inicio de la hoja
                            $CodigoHtml_pdf .= '</table><div style="page-break-after:always;"></div>
                            <table width="100%" border="0">
                            <tr>
                              <td width="15%">&nbsp;</td>
                              <td width="20%">&nbsp;</td>
                              <td width="28%">&nbsp;</td>
                              <td width="25%">&nbsp;</td>
                              <td width="12%">&nbsp;</td>
                            </tr>
                             <tr>
                              <td width="15%">&nbsp;</td>
                              <td width="20%">&nbsp;</td>
                              <td width="28%">&nbsp;</td>
                              <td width="25%">&nbsp;</td>
                              <td width="12%">&nbsp;</td>
                            </tr>
                             <tr>
                              <td width="15%">&nbsp;</td>
                              <td width="20%">&nbsp;</td>
                              <td width="28%">&nbsp;</td>
                              <td width="25%">&nbsp;</td>
                              <td width="12%">&nbsp;</td>
                            </tr>
                            <tr>
                               <td width="15%" class="columnas_concepto">CANTIDAD</td>
                               <td width="20%" class="columnas_concepto">UNIDAD</td>
                               <td width="28%" class="columnas_concepto">DESCRIPCI&Oacute;N</td>
                               <td width="25%" class="columnas_concepto">PRECIO UNITARIO </td>
                               <td width="12%" class="columnas_concepto">IMPORTE</td>
                            </tr>'; 
                        }
                            
                    }
                }
            }
            
            $contador++;
        }
         switch($tipoFactura)
            {
                case "1":#Factura por consumo o general
                    $CodigoHtml_pdf .= '<tr>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '</tr>'
                        .'<tr>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '</tr>'
                        .'<tr>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '<td align="center">&nbsp;</td>'
                        . '</tr>';
                    break;
                
            }
        $CodigoHtml_pdf .='</table></div>';
        
        //En la versión 3.2 los valores de metodoPago son forma de pago
        //y forma de pago es metodo de pago

        $descripcion_metodoPago= "";        
        $array_metodoPago = explode(",", $this->MetodoPago);
        $metodos_distintos = array_count_values($array_metodoPago);
        $query = "Select * from FormaPago";
        $FormaPago="";
        
        $contador = 0;
        while($contador < count($metodos_distintos)){
            if($contador==0)
                $query .= " where Id='".  array_keys($metodos_distintos)[$contador]."'";
            else
                $query .= " or Id='".  array_keys($metodos_distintos)[$contador]."'";
            $contador++;
        }
        $con = Conexion();
        $todosMetodosPago ="";
        $valor = sqlsrv_query($con, $query);
         while($Datos = sqlsrv_fetch_array($valor)){
             if ($FormaPago == "") {
                $FormaPago = $Datos['Nombre'];
            } else {
                $FormaPago = $FormaPago . ", " . $Datos['Nombre'];
            }
            
             
         }
        sqlsrv_close($con);
        

        
        $cuenta_titulo="";
        $cuenta_banco = "";
        $bandera_cuentaPago=false;
        foreach ($array_metodoPago as $mPago)
        {
            if($mPago=='02' || $mPago=='03' || $mPago=='04' || $mPago=='05' ||
                $mPago=='06' || $mPago=='28' || $mPago=='29'){
                $bandera_cuentaPago=TRUE;
                break;
            }
        }
        
        
        //Para que se puedan ver bien las cuentas de pago en el pdf y no ocupe demasiado espacio
        $temporal_cuentas_pago = explode(',', $this->NumCtaPago);
        $CtaPago="";
        for($contador=0; $contador < count($temporal_cuentas_pago); $contador++)
        {
            $CtaPago .= ", ". $temporal_cuentas_pago[$contador];
        }
        
        
//        Estos necesitan cuenta de banco en la forma de pago(version=3.3) / metodo de pago(version= 3.2)
        if($bandera_cuentaPago == true)
        {
            $cuenta_titulo = " y cuenta";
            $cuenta_banco = $CtaPago;
        }
        
       $CodigoHtml_pdf.= '<div class="div_pago_total">
		  <table width="100%" border="1" id="tabla_pago_total">
            <tr>
              <td width="32%" bgcolor="#cfcfcf">M&eacute;todo de pago'.$cuenta_titulo.': </td>
              <td width="42%">'.$FormaPago.$cuenta_banco.' </td>
              <td width="13%" class="campos_destacados"><strong>SUBTOTAL</strong></td>
              <td width="13%" align="right">$'.$this->Subtotal.'</td>
            </tr>
            <tr>
              <td bgcolor="#cfcfcf">Forma de pago: </td>
              <td>'.utf8_decode($this->FormaPago).'</td>
              <td  class="campos_destacados"><strong>IVA</strong></td>
              <td align="right">$'.$totalIva.'</td>
            </tr>
            <tr>
              <td bgcolor="#cfcfcf">Fecha y hora de certificaci&oacute;n: </td>
              <td>'.$this->FechaTimbrado.'</td>
              <td class="campos_destacados"><strong>DESCUENTO</strong></td>
              <td align="right">$'.$this->Descuento .'</td>
            </tr>
            <tr>
              <td class="campo_libre"></td>
              <td class="campo_libre"></td>
              <td class="campos_destacados"><strong>TOTAL</strong></td>
              <td align="right"><strong>$'.$this->Total .'</strong></td>
            </tr>
          </table>
        </div><br><br>';
       
        $file = fopen('../xml/ArchivosSellados/CadenaOriginal'. $nombre_xml.'.txt', "r");
            while(!feof($file)) {
                $this->CadenaOriginal = fgets($file);
        }

        fclose($file);
       
       $CodigoHtml_pdf.= '<div class="div_timbrado">
		  <table width="100%" border="0">
              <tr>
                <td width="80%">ESTE DOCUMENTO ES UNA REPRESENTACI&Oacute;N IMPRESA DE UN CFDI </td>
                <td width="20%" rowspan="8">
					<div id="codigo_qr">
						<img src="../xml/ArchivosSellados/CodigoQr'.$nombre_xml.'.jpg" width="150px" 
                                                    height="150px" align="center">
					</div>
				</td>
              </tr>
              <tr>
                <td>No. de Serie del Certificado de Sello Digital del SAT </td>
              </tr>
              <tr>
                <td>
					<div id="certificado_sello_digital">'.$this->NoCertificadoSAT.'</div>
				</td>
              </tr>
              <tr>
                <td>Sello Digital del Emisor </td>
              </tr>
              <tr>
                <td>
					<div id="sello_digital_emisor">'. chunk_split($this->SelloCFD,32).'</div>
				</td>
              </tr>
              <tr>
                <td>Sello Digital del SAT </td>
              </tr>
              <tr>
                <td>
					<div id="sello_digital_sat">'. chunk_split($this->SelloSAT, 32).'</div>
				</td>
              </tr>
              <tr>
                <td>Cadena Original del complemento de certificaci&oacute;n digital del SAT </td>
              </tr>
              <tr>
                <td colspan="2">
					<div id="cadena_original">'. chunk_split($this->CadenaOriginal, 32).'</div>
				</td>
              </tr>
            </table>
		</div>';

        $CodigoHtml_pdf= utf8_encode($CodigoHtml_pdf);
//        echo $CodigoHtml_pdf;
       
       $dompdf = new DOMPDF();
       
       $dompdf->set_paper("A4","portrait");
       $dompdf->load_html($CodigoHtml_pdf);
       ini_set("memory_limit","128M");
       $dompdf->render();
       $pdf = $dompdf->output();
//       file_put_contents('../xml/FacturaTimbrada'.$nombre_xml . '.pdf', $pdf);
       
       $bandera = false;
       if(file_put_contents('../xml/FacturaTimbrada'.$nombre_xml . '.pdf', $pdf) != false)
       {
           $bandera = true;
       }
//       
//       return $bandera;
       
    #muestra el pdf desde el navegador sin guardarlo aún
//    header('Content-type: application/pdf');
        
//       
//       
       
    
//    echo $pdf;  

        return $bandera;
   
    }
    
    public function GenerarPdfFacturaGlobal($nombre_xml){
        #Lee y abre el xml timbrado
        $xmlTimbrado = simplexml_load_file('../xml/FacturaTimbrada'. $nombre_xml . '.xml');
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        $namespaceXml = $xmlTimbrado->getNamespaces(true);
        $xmlTimbrado->registerXPathNamespace('c', $namespaceXml['cfdi']);
        $xmlTimbrado->registerXPathNamespace('t', $namespaceXml['tfd']);
        
        #Lee los datos del xml según su nodo/namespace
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante') as $cfdiComprobante){
            $this->Version = $cfdiComprobante['version'];
            $this->Folio = $cfdiComprobante['folio'];
            $this->Fecha = $cfdiComprobante['fecha'];
            $this->Sello = $cfdiComprobante['sello'];
            $this->FormaPago = $cfdiComprobante['formaDePago'];
            $this->NoCertificado = $cfdiComprobante['noCertificado'];
            $this->Certificado = $cfdiComprobante['certificado'];
            $this->Subtotal = $cfdiComprobante['subTotal'];
            $this->Descuento = $cfdiComprobante['descuento'];
            $this->Moneda = $cfdiComprobante['Moneda'];
            $this->Total = $cfdiComprobante['total'];
            $this->TipoDeComprobante = $cfdiComprobante['tipoDeComprobante'];
            $this->MetodoPago = $cfdiComprobante['metodoDePago'];
            $this->LugarExpedicion = $cfdiComprobante['LugarExpedicion']; 
            $this->NumCtaPago = $cfdiComprobante['NumCtaPago'];
        } 
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){
            $this->RfcEmisor = $Emisor['rfc'];
            $this->NombreEmisor = $Emisor['nombre'];
         } 
         foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Emisor//cfdi:DomicilioFiscal') as $DomicilioFiscal){
             $this->CalleEmisor = utf8_decode($DomicilioFiscal['calle']);
             $this->NoExteriorEmisor = $DomicilioFiscal['noExterior'];
             $this->NoInteriorEmisor = $DomicilioFiscal['noInterior'];
             $this->ColoniaEmisor = utf8_decode($DomicilioFiscal['colonia']);
             $this->MunicipioEmisor = utf8_decode($DomicilioFiscal['municipio']);
             $this->EstadoEmisor = utf8_decode($DomicilioFiscal['estado']);
             $this->PaisEmisor = utf8_decode($DomicilioFiscal['pais']);
             $this->CodigoPostalEmisor = $DomicilioFiscal['codigoPostal'];
         } 
         foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:RegimenFiscal') as $Regimen)
         {
             $this->RegimenFiscal= $Regimen['Regimen'];
         }
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){
            $this->RfcReceptor = $Receptor['rfc'];
            $this->NombreReceptor = utf8_decode($Receptor['nombre']);
        } 
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Receptor//cfdi:Domicilio') as $ReceptorDomicilio){
            $this->CalleReceptor = utf8_decode($ReceptorDomicilio['calle']);
            $this->NoExteriorReceptor = $ReceptorDomicilio['noExterior'];
            $this->NoInteriorReceptor = $ReceptorDomicilio['noInterior'];
            $this->ColoniaReceptor = utf8_decode($ReceptorDomicilio['colonia']);
            $this->MunicipioReceptor = utf8_decode($ReceptorDomicilio['municipio']);
            $this->EstadoReceptor = utf8_decode($ReceptorDomicilio['estado']);
            $this->PaisReceptor = utf8_decode($ReceptorDomicilio['pais']);
            $this->CodigoPostalReceptor = $ReceptorDomicilio['codigoPostal'];
        }
        
        $array_conceptos = array();
        $contador=0;
        $array_id_ventas = array();
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto){
            
            $array_conceptos[$contador] = array($Concepto['cantidad'], $Concepto['unidad'], 
                $Concepto['descripcion'], $Concepto['valorUnitario'],$Concepto['importe']);
            $contador++;
            $temporal = explode("Folio: ",$Concepto['descripcion']);
            array_push($array_id_ventas, $temporal[1]);
        } 
           
       
        
        $totalIva=0.0;
        foreach($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Impuestos') as $Impuestos)
        {
            $totalIva = $Impuestos['totalImpuestosTrasladados'];
        }
        $contador=0;
        foreach ($xmlTimbrado->xpath('//cfdi:Comprobante//cfdi:Impuestos//cfdi:Traslados//cfdi:Traslado') as $Traslado){
            
            $this->array_impuestos_traslados[$contador]= array($Traslado['impuesto'], $Traslado['tasa'], $Traslado['importe']);
            $contador++;
        } 
       foreach ($xmlTimbrado->xpath('//t:TimbreFiscalDigital') as $Timbrado) {
           $this->UUID = $Timbrado['UUID'];
           $this->FechaTimbrado = $Timbrado['FechaTimbrado'];
           $this->NoCertificadoSAT = $Timbrado['noCertificadoSAT'];
           $this->SelloCFD = $Timbrado['selloCFD'];
           $this->SelloSAT = $Timbrado['selloSAT'];
         } 

         $numeroInteriorEmisor= "";
         $numeroInteriorReceptor="";
         if($this->NoInteriorEmisor!=null){
            $numeroInteriorEmisor = 'No. interior: '. $this->NoInteriorEmisor;
        }
        
        if($this->NoInteriorReceptor!=null){
            $numeroInteriorReceptor = 'No. interior: '. $this->NoInteriorReceptor; 
        }
        
        $query = " Select Fecha from Ventas ";
        $contador=0;
        for($contador=0; $contador < count($array_id_ventas); $contador++)
        {
            if($contador==0)
            {
                $query .= "where ID='".$array_id_ventas[$contador]."' ";
            }else{
                $query .= "or ID='".$array_id_ventas[$contador]."' ";
            }
        }
        $query .= "order by Fecha asc";
        $con = Conexion();
        $fecha="";
        $array_fechas= array();
        $valor = sqlsrv_query($con, $query);
         while($Datos = sqlsrv_fetch_array($valor)){
             $fecha = $Datos['Fecha'];
             array_push($array_fechas, $fecha);
         }
         sqlsrv_close($con);
        
         $CodigoHtml_pdf="";
        $CodigoHtml_pdf.= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                     <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
                    <title>Formato de factura</title>
                </head>
            <style>
                .div_principal{
                    width: 100%;
                    height: 1000px;
                    background-color:#fff;
                }
                .div_logo{
                        
                        height: 170px;
                        width: 150px;
                        position: absolute;
                        left: 8px;
                        top: 14px;
                        
                }
                .div_receptor, .div_datos_fiscales, .div_consumo, .div_pago_total, .div_timbrado{
                        width:100%;
                }
                .div_folio{
                    position:relatiVE;
                    float:right;
                    width:30%;
                    height:25px;
                    left:489px;

                }
                .div_emisor{
                        width:75%;
                        height:19%;
                        position: relative;
                        top:0px;
                        left:175px;
                        /*float:left;*/
                }
                .div_receptor{
                        position:relative;
                        float: left;
                        height:14%;
                        position:relative;
                        float:right;
                        top:-40px;
                }
                .div_datos_fiscales{

                        height:11%;
                        position:relative;
                        float:right;
                        top:-40px;
                        
                }
                .div_consumo{
                        height:18%;
                        position:relative;
                        float:right;
                       top:-40px;
                       height:auto;
                }

                .div_pago_total{
                        height:8.5%;
                        position:relative;
                        float:right;
                        height:auto;
                }
                .div_timbrado{

                        height:28.5%;
                        position:relative;
                        float:right;
                        height:auto;
                }
	
                #sello_digital_emisor, #sello_digital_sat, #cadena_original{
                        font-size:9px;
                }

                #tabla_emisor, #tabla_receptor{
                        /*border-radius: 15px;*/
                        padding: 3px;
                        margin: 3px;
                        border: 2px solid #000;
                        background-color:#fcfcfc;

                }

                #tabla_pago_total, #tabla_folio{
                        /*border-collapse: collapse;*/
                        /*border: 1px solid #000;*/
                        border-collapse:collapse;
                        border-left:1px solid #000;
                }
               .titulo_tabla{

                        text-align:center;
                        border-radius: 15px 15px 0px 0px;
                       /* -moz-border-radius: 15px 15px 0px 0px;
                        -webkit-border-radius: 15px 15px 0px 0px;*/
                        background-color:#cfcfcf;
                        border-bottom:1px solid #000;
                }

                .titulo_datos_fiscales{
                        border-bottom: 1px solid #000;
                        text-align:center;
                }

                .columnas_concepto{
                        border-bottom: 1px solid #000;
                        background-color: #cfcfcf;
                        border-top: 1px solid #000;
                        text-align:center;
                }

                .campos_destacados{
                       /* border-radius: 5px 0px 5px 0px;*/
                        background-color: #cfcfcf;
                        text-align:center;

                }

                #codigo_qr{
                        width:auto;
                        height:auto;
                }
                .campo_libre{
                    border: #ffffff 1px solid;
                }
        </style>';
        
               
        $CodigoHtml_pdf.= '<body>
        <script type="text/php">
            if ( isset($pdf) ) { 
              $font = Font_Metrics::get_font("helvetica", "normal");
              $size = 9;
              $y = $pdf->get_height()-10;
              $x = $pdf->get_width()-65 - Font_Metrics::get_text_width("1/1", $font, $size);
              $pdf->page_text($x, $y, "Hoja {PAGE_NUM} de {PAGE_COUNT}", $font, $size);
            } 
        </script>
	<div class="div_principal">
	  <div class="div_logo">
            
            <IMG SRC="'.$objEmpresa->Logo.'" width="150px" height="150px" align="center">
            
          </div>
         <div class="div_folio">
		<table width="100%" border="1" id="tabla_folio">
			<tr>
				<td width="30%" bgcolor="#cfcfcf" align="center"><strong>FOLIO</strong></td>
				<td width="70%" align="right"><strong>'.$this->Folio.'</strong></td>
			</tr>
		</table>
	  </div>
        <div class="div_emisor">
	    <table width="100%" border="0" id="tabla_emisor">
          <tr>
            <td class="titulo_tabla"><strong>EMISOR</strong></td>
          </tr>
          <tr>
            <td>'.utf8_decode($this->NombreEmisor).'</td>
          </tr>
          <tr>
            <td> RFC: '.$this->RfcEmisor.', R&eacute;gimen fiscal: ' .utf8_decode($this->RegimenFiscal). '</td>
          </tr>
          <tr>
            <td>Domicilio: '.utf8_decode($this->CalleEmisor).' '.$this->NoExteriorEmisor. ' '. $numeroInteriorEmisor. ' ' .utf8_decode($this->ColoniaEmisor).' </td>
          </tr>
          <tr>
            <td>C.P. '.$this->CodigoPostalEmisor.', tel. ' .$objEmpresa->Telefono. '</td>
          </tr>
          <tr><td>'.utf8_decode($this->MunicipioEmisor).', '.utf8_decode($this->EstadoEmisor).', '. utf8_decode($this->PaisEmisor). '</td></tr>
        </table>
    </div>
	  
	 ';
        $objCliente = new ClientesFacturas();
        $objCliente->obtenerPorRFC($this->RfcReceptor);
        
        
        $CodigoHtml_pdf.= '<div class="div_receptor">
            <table width="100%" border="0" id="tabla_receptor">
                <tr>
                  <td class="titulo_tabla"><strong>RECEPTOR</strong></td>
                </tr>
                <tr>
                  <td>RFC: '.$this->RfcReceptor .', <strong>'.$this->NombreReceptor.'</strong></td>
                </tr>
                <tr>
                  <td>Domicilio: '.utf8_decode($this->CalleReceptor).' '.  $this->NoExteriorReceptor. ' '. $numeroInteriorReceptor. ' '.utf8_decode($this->ColoniaReceptor). '</td>
                </tr>
                <tr>
                  <td>C.P. '.$this->CodigoPostalReceptor.' tel. '.$objCliente->Telefono.'</td>
                </tr>
                <tr>
                  <td>'.utf8_decode($this->MunicipioReceptor). ', '.utf8_decode($this->EstadoReceptor).', '.utf8_decode($this->PaisReceptor).'</td>
                </tr>
            </table>
	</div>';
        
        $CodigoHtml_pdf.= '<div class="div_datos_fiscales">
         <table width="100%" border="0">
            <tr>
              <td width="58%" class="titulo_tabla">UUID </td>
              <td width="42%" class="titulo_tabla">FECHA Y HORA DE EXPEDICI&Oacute;N </td>
            </tr>
            <tr>
              <td align="center">'.$this->UUID.'</td>
              <td align="center">'.$this->Fecha.'</td>
            </tr>
            <tr>
              <td class="titulo_tabla">NO. DE CERTIFICADO DIGITAL</td>
              <td class="titulo_tabla">LUGAR DE EXPEDICI&Oacute;N </td>
            </tr>
            <tr>
              <td align="center">'.$this->NoCertificado.'</td>
              <td align="center">'.$this->MunicipioEmisor.', '.$this->EstadoEmisor. '</td>
            </tr>
          </table>
		</div>';
        $objMoneda = new Moneda();
        $objMoneda->ConsultarPorClave($this->Moneda);
       
        
        $contador_saltos=0;
        $CodigoHtml_pdf.= '<div class="div_consumo">
	<table width="100%" border="0">
            <tr>
              <td width="14%" class="columnas_concepto">CANTIDAD</td>
              <td width="16%" class="columnas_concepto">FECHA</td>
              <td width="16%" class="columnas_concepto">UNIDAD</td>
              <td width="23%" class="columnas_concepto">DESCRIPCI&Oacute;N</td>
              <td width="15%" class="columnas_concepto">PRECIO UNITARIO </td>
              <td width="15%" class="columnas_concepto">IMPORTE</td>
            </tr>';
        $contador=0;
        $bandera_numerica= -1;//determina si hay salto de página, 1=>hay salto, -1=>no hay salto
        while($contador < count($array_conceptos)){
            
    //[0]=cantidad, [1]=unidad, [2]=descripcion, [3]= valorUnitario, [4]=importeConcepto
            $CodigoHtml_pdf .= '<tr>
              <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.$array_conceptos[$contador][0].'</td>
              <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.date_format($array_fechas[$contador], 'd/m/y').'</td>
              <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.$array_conceptos[$contador][1].'</td>
              <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.utf8_decode($array_conceptos[$contador][2]).'</td>
              <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.$array_conceptos[$contador][3].'</td>
              <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.$array_conceptos[$contador][4].'</td>
            </tr>';
           
            
            if($contador > 17)
            {
                $residuo= $contador % 18;
                
                if($residuo==0)
                {
                    $bandera_numerica = $bandera_numerica * -1;
                    if($bandera_numerica > 0)#si el resultado es positivo(1) hay salto de página
                    {
                        $CodigoHtml_pdf .= '</table><div style="page-break-after:always;"></div>
                        <table width="100%" border="0">
                        <tr>
                          <td width="14%">&nbsp;</td>
                          <td width="16%">&nbsp;</td>
                          <td width="16%">&nbsp;</td>
                          <td width="23%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                        </tr>
                         <tr>
                          <td width="14%">&nbsp;</td>
                          <td width="16%">&nbsp;</td>
                          <td width="16%">&nbsp;</td>
                          <td width="23%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                        </tr>
                         <tr>
                          <td width="14%">&nbsp;</td>
                          <td width="16%">&nbsp;</td>
                          <td width="16%">&nbsp;</td>
                          <td width="23%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                          <td width="15%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="14%" class="columnas_concepto">CANTIDAD</td>
                          <td width="16%" class="columnas_concepto">FECHA</td>
                          <td width="16%" class="columnas_concepto">UNIDAD</td>
                          <td width="23%" class="columnas_concepto">DESCRIPCI&Oacute;N</td>
                          <td width="15%" class="columnas_concepto">PRECIO UNITARIO </td>
                          <td width="15%" class="columnas_concepto">IMPORTE</td>
                        </tr>'; 
                    }
                }                
            }
             $contador++;
        }
         
        $CodigoHtml_pdf .='</table></div>';
        
        //En la versión 3.2 los valores de metodoPago son forma de pago
        //y forma de pago es metodo de pago

        $array_metodoPago = explode(",", $this->MetodoPago);
        $metodos_distintos = array_count_values($array_metodoPago);
        
        $query = "Select * from FormaPago";
        $contador = 0;
        while($contador < count($metodos_distintos)){
            if($contador==0)
                $query .= " where Id='".  array_keys($metodos_distintos)[$contador]."'";
            else
                $query .= " or Id='".  array_keys($metodos_distintos)[$contador]."'";
            $contador++;
        }
        $con = Conexion();
        $todosMetodosPago ="";
        $valor = sqlsrv_query($con, $query);
         while($Datos = sqlsrv_fetch_array($valor)){
            
             if ($todosMetodosPago == "") {
                 if($Datos['Id'] < 10)
                {
                    $todosMetodosPago = "0" . $Datos['Id'] . " " . $Datos['Nombre'];
                }
                else{
                    $todosMetodosPago = $Datos['Id'] . " " . $Datos['Nombre'];
                
                }
               
            } else {
                if($Datos['Id'] < 10)
                {
                    $todosMetodosPago = $todosMetodosPago.", " . "0" . $Datos['Id'] . " " . $Datos['Nombre'];
                }
                else{
                    $todosMetodosPago = $todosMetodosPago. ", ". $Datos['Id'] . " " . $Datos['Nombre'];
                }
            }
             
             
         }
        sqlsrv_close($con);
        
        
        $descripcion_metodoPago= "";
        $objForma = new CatalogoFormaPago();
        
        $cuenta_titulo="";
        $cuenta_banco = "";
        
        $cuenta_titulo = " y cuenta";
        $cuentas_pago_resumidas = explode(",", $this->NumCtaPago);
        $total_cuentas = count($cuentas_pago_resumidas);
        if($total_cuentas < 4)
        {
            $cuentas_a_mostrar = $this->NumCtaPago;
        }else{
            $contador=0;
            $cuentas_a_mostrar="";
            while($contador < 4)
            {
                if($contador==3)
                    $cuentas_a_mostrar .= $cuentas_pago_resumidas[$contador];
                else
                    $cuentas_a_mostrar .= $cuentas_pago_resumidas[$contador]. ",";
                $contador++;
            }
        }
        
        $cuenta_banco = ", ". $cuentas_a_mostrar;
        
       $CodigoHtml_pdf.= '<div class="div_pago_total">
		  <table width="100%" border="1" id="tabla_pago_total">
            <tr>
              <td width="32%" bgcolor="#cfcfcf">M&eacute;todo de pago'.$cuenta_titulo.': </td>
              <td width="42%">'.$todosMetodosPago.$cuenta_banco.' </td>
              <td width="13%" class="campos_destacados"><strong>SUBTOTAL</strong></td>
              <td width="13%" align="right">$'.$this->Subtotal.'</td>
            </tr>
            <tr>
              <td bgcolor="#cfcfcf">Forma de pago: </td>
              <td>'.utf8_decode($this->FormaPago).'</td>
              <td  class="campos_destacados"><strong>IVA</strong></td>
              <td align="right">$'.$totalIva.'</td>
            </tr>
            <tr>
              <td bgcolor="#cfcfcf">Fecha y hora de certificaci&oacute;n: </td>
              <td>'.$this->FechaTimbrado.'</td>
              <td class="campos_destacados"><strong>DESCUENTO</strong></td>
              <td align="right">$'.$this->Descuento .'</td>
            </tr>
            <tr>
              <td class="campo_libre"></td>
              <td class="campo_libre"></td>
              <td class="campos_destacados"><strong>TOTAL</strong></td>
              <td align="right"><strong>$'.$this->Total .'</strong></td>
            </tr>
          </table>
        </div><br><br>';
       
        $file = fopen('../xml/ArchivosSellados/CadenaOriginal'. $nombre_xml.'.txt', "r");
            while(!feof($file)) {
                $this->CadenaOriginal = fgets($file);
        }

        fclose($file);
       
       $CodigoHtml_pdf.= '<div class="div_timbrado">
		  <table width="100%" border="0">
              <tr>
                <td width="80%">ESTE DOCUMENTO ES UNA REPRESENTACI&Oacute;N IMPRESA DE UN CFDI </td>
                <td width="20%" rowspan="8">
					<div id="codigo_qr">
						<img src="../xml/ArchivosSellados/CodigoQr'.$nombre_xml.'.jpg" width="150px" 
                                                    height="150px" align="center">
					</div>
				</td>
              </tr>
              <tr>
                <td>No. de Serie del Certificado de Sello Digital del SAT </td>
              </tr>
              <tr>
                <td>
					<div id="certificado_sello_digital">'.$this->NoCertificadoSAT.'</div>
				</td>
              </tr>
              <tr>
                <td>Sello Digital del Emisor </td>
              </tr>
              <tr>
                <td>
					<div id="sello_digital_emisor">'. chunk_split($this->SelloCFD,32).'</div>
				</td>
              </tr>
              <tr>
                <td>Sello Digital del SAT </td>
              </tr>
              <tr>
                <td>
					<div id="sello_digital_sat">'. chunk_split($this->SelloSAT, 32).'</div>
				</td>
              </tr>
              <tr>
                <td>Cadena Original del complemento de certificaci&oacute;n digital del SAT </td>
              </tr>
              <tr>
                <td colspan="2">
					<div id="cadena_original">'. chunk_split($this->CadenaOriginal, 32).'</div>
				</td>
              </tr>
            </table>
		</div>';

        $CodigoHtml_pdf= utf8_encode($CodigoHtml_pdf);
//        echo $CodigoHtml_pdf;
       
       $dompdf = new DOMPDF();
       $dompdf->set_paper("A4","portrait");
       $dompdf->load_html($CodigoHtml_pdf);
       ini_set("memory_limit","128M");
       $dompdf->render();
       $pdf = $dompdf->output();
       file_put_contents('../xml/FacturaTimbrada'.$nombre_xml . '.pdf', $pdf);
       
       $bandera = false;
       if(file_put_contents('../xml/FacturaTimbrada'.$nombre_xml . '.pdf', $pdf) != false)
       {
           $bandera = true;
       }
       
       return $bandera;
       
    #muestra el pdf desde el navegador sin guardarlo aún
//    header('Content-type: application/pdf');
//    echo $dompdf->output();   
//   
   
        
    }
    
    

    public function CargarPdf($rutaXml){
//        $mi_pdf = '../xml/FacturaTimbrada'.$nombre_xml .'.pdf';

        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="'.$rutaXml.'"');
        readfile($rutaXml);
    }
   
}
?>
    

