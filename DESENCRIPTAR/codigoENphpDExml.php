<?php
	$xml ='<?xml version="1.0" encoding="utf-8"?>
	<cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" ';
	
        /*Agrega el formato adecuado de fecha y hora al xml*/
        $hora = date( "H:i:s");
        $fecha = date("Y-m-d");
        $fecha.= 'T'. $hora;
        $xml.='version="3.3" folio="" fecha="'. $fecha .'" sello=""';
//       $fecha= date("Y-m-d");
//       $hora = getdate();
//       $fecha.= '_'. $hor
//       a['hours']. '-' . $hora['minutes'] . '-' . $hora['seconds'];
       
        $texto_guardado="";
        $nombre = "C:\Users\TrabajoBere\Downloads\Cer_Sello\ArchivosRegistroEmisor\aaa010101aaa__csd_01.cer";
 //**************************************************************************************************       
//    $fp = fopen($nombre, "r");
//    $cert = fread($fp, 8192);
//    fclose($fp);
    
    $certificateCAcer = $nombre;
    $certificateCAcerContent = file_get_contents($certificateCAcer);
    /* Convert .cer to .pem, cURL uses .pem */
//    $certificateCApemContent =  '-----BEGIN CERTIFICATE-----'.PHP_EOL
//        .chunk_split(base64_encode($certificateCAcerContent), 64, PHP_EOL)
//        .'-----END CERTIFICATE-----'.PHP_EOL;
//    $certificateCApem = $certificateCAcer.'.pem';
    
    $certificateCApemContent =  PHP_EOL
        .chunk_split(base64_encode($certificateCAcerContent), 64, PHP_EOL)
        .PHP_EOL;
    
 
    
    $certificateCApem = $certificateCAcer.'.pem';
    
//    $key='aaa010101aaa_csd_01.key.pem';
//    exec("openssl dgst -sign $key md52.txt | openssl enc -base64 -A > sello.txt");
    
    shell_exec("openssl.exe x509 -inform DER -in 'aaa010101aaa_csd_01.cer' -noout -serial > 'C:\Users\TrabajoBere\Desktop\serial.txt'");
    
    
    file_put_contents($certificateCApem, $certificateCApemContent); 

    echo $certificateCApemContent;
    echo "<br><br>";
    
    
    
    
    

//    echo "Read<br>";
//    echo openssl_x509_read($cert);
//    echo "<br>";
//    echo "*********************";
//    echo "<br>";
//    echo "Parse<br>";
//    print_r(openssl_x509_parse($cert));
    /*
    // or
    print_r(openssl_x509_parse( openssl_x509_read($cert) ) );
    */ 
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
//		$archivo = fopen($nombre,'r');
//		while(!feof($archivo)) {
//
//                    $texto_guardado.= fgets($archivo);
//
//                }
//		fclose($archivo);
		
       

     /*  $nombre = "C:\\xampp\htdocs\Sistema_BIXA\xml\ARCHIVO.xml";
       $archivo = fopen($nombre, 'w+');//lo crea en caso de que no exista, si no, escribe sobre �l.
       

       fwrite($archivo, $xml);
       fclose($archivo);*/
?>