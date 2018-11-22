<?php

require_once '../Imprimir/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

require_once '../Clases/Ventas.php';
require_once '../Clases/DetalleVentas.php';
require_once '../Clases/Empresa.php';
require_once '../Clases/Comanda.php';

class N_ImprimirTicket {

    public function ImprimirEpson() {
        $IdVenta = $_POST['VentaId'];
        $objVenta = new Ventas();
        $objVenta->ObtenerPorId($IdVenta);
        if ($objVenta->ID) {
            try {
                $objDetalleVentas = new DetalleVentas();
                $Detalles = $objDetalleVentas->ObtenerPorIdVenta($objVenta->ID);
                
                $objEmpresa = new Empresa();
                $objEmpresa->ObtenerPorID(1);
                
                $connector = new FilPrintConnector("TicketsEC");
//                smb://computer/printer
                //$connector = new WindowsPrintConnector("smb://ARMADA/HP LaserJet Professional P 1102w (Copiar 1)");
                $logo = EscposImage::load($objEmpresa->Logo, false);
                $printer = new Printer($connector);

                $printer->setJustification(Printer::JUSTIFY_CENTER);
                
                $printer->selectPrintMode(Printer::MODE_FONT_B | Printer::MODE_EMPHASIZED | Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT);
                $printer->text($objEmpresa->NombreComercial);
               
		$printer->feed(2);
                $printer->selectPrintMode(Printer::MODE_FONT_B);
                $printer->text("RFC: ". $objEmpresa->RFC);
                $printer->text("\n");
                $printer->text($objEmpresa->Calle . " " . $objEmpresa->NumeroExterior . " " . $objEmpresa->NumeroInterior . 
                        " ". $objEmpresa->Colonia. ", Irapuato, Gto. " . "C.P. ". $objEmpresa->CodigoPostal);
		
                $objComanda = new Comanda();
                $comanda = $objComanda->Detalle_Uno($objVenta->IdComanda);
                $quitar= split("°", $comanda);
                
                $printer->feed(2);
                $printer->text("Comanda: ". $quitar[0]);
                $printer->text("\n");
                $printer->text(date("d/m/Y") ." ". date("H:i:s"));
				$printer->feed(1);
                $printer->text("==================================");
                

                

//                $printer->setTextSize(2, 2);
//                $printer->text("Prueba ");
                $printer->feed(2);

                //$printer->setFont(Printer::FONT_B);
                //$printer->selectPrintMode();
                $printer->setJustification();
                $printer->setTextSize(2, 2);
                //$printer->selectPrintMode();
                $formato = sprintf('%-5.11s %-7.12s %-10.20s %-5.10s', "Cant", "Descripción", " ", "Total");
                $printer->text($formato);
                $printer->text("\n");
				$suma_subtotal = 0.00;
                    $suma_Iva = 0.00;
                    $suma_total = 0.00;
                    $bandera_iva_16 = false;
                $printer->setTextSize(2, 2);
				$Descripcion = "";
                foreach ($Detalles as $detalle) {
                    $detalle->Descripcion = str_pad($detalle->Descripcion, 15, " ", STR_PAD_RIGHT); 
                    $formato = sprintf('%-5.11s %-10.15s %-8.5s %-8.2f', $detalle->Cantidad, $detalle->Descripcion, "  ", $detalle->SubTotal);
                    $printer->text($formato);
                    $printer->text("\n");
                    $suma_subtotal += $detalle->SubTotal;
                    $suma_Iva += $detalle->IVA;
                    $suma_total += $detalle->Total;
                    if ($detalle->IVA == 16) {
                        $bandera_iva_16 = true;
                    }
                }
                $suma_total = $suma_total - $objVenta->Descuento;

				
                
                if ($bandera_iva_16 == TRUE) {
                    $suma_subtotal = $suma_total / (1 + (16 / 100));
                    $suma_Iva = $suma_subtotal * (16 / 100);
                } else {
                    $suma_subtotal = $suma_total;
                    $suma_Iva = 0;
                }
				$suma_total = $objVenta->Propina + $suma_total;
				$printer->setJustification(Printer::JUSTIFY_RIGHT);
				$suma_subtotal = str_pad($suma_subtotal, 8, " ", STR_PAD_LEFT);
				$formato = sprintf('%-5.11s %-10.15s %-12.8s %-8.2f', "", "", "SubTotal", $suma_subtotal );
                $printer->text($formato);
                $printer->text("\n");
                
                $formato = sprintf('%-5.11s %-10.15s %-12.5s %-8.2f', "", "", "IVA",str_pad($suma_Iva, 8, " ", STR_PAD_LEFT) );
                $printer->text($formato);
                $printer->text("\n");
				
				$formato = sprintf('%-5.11s %-10.15s %-12.7s %-8.2f', "", "", "Propina", str_pad($objVenta->Propina, 8, " ", STR_PAD_LEFT));
                $printer->text($formato);
                $printer->text("\n");

                $formato = sprintf('%-5.11s %-10.15s %-12.5s %-8.2f', "", "", "Total", str_pad($suma_total, 8, " ", STR_PAD_LEFT));
                $printer->text($formato);
                $printer->text("\n");

                
                $printer->feed();
                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->text("Gracias por su visita. Vuelva pronto.");
                $printer->feed(2);
                $printer->text("***********SoftAppetit***********");
                $printer->feed(2);
                 
                
                $printer->cut();
                $printer->close();
            } catch (Exception $e) {
                //setFailureMessage("Error al imprimir");
                header("Location F_A_Comanda_A_Detalle.php?IdComanda$objVenta->IdComanda");
            }
        }
    }

    public function ImprimirECLine(){
         $_SESSION['VentaId']= NULL;
        
        $IdVenta = $_POST['VentaId'];
        $objVenta = new Ventas();
        $objVenta->ObtenerPorId($IdVenta);
        if ($objVenta->ID) {
            try {
                
                $objDetalleVentas = new DetalleVentas();
                $Detalles = $objDetalleVentas->ObtenerPorIdVenta($objVenta->ID);
                
                $objEmpresa = new Empresa();
                $objEmpresa->ObtenerPorID(1);
                
                $printer = "TicketsEC";
                $ph = printer_open($printer);

                printer_start_doc($ph, 'Ticket');
                printer_start_page($ph);
                
//                $imageObject = imagecreatefromjpeg(".".$objEmpresa->Logo);
//                imagewbmp($imageObject,".".$objEmpresa->Logo );
                $ruta = ".".$objEmpresa->Logo;
//                $image = getimagesize($ruta);
//                jpeg2wbmp($ruta, "c:\\xampp\htdocs\logoticket.bmp",$image[1], $image[0], 5);
//                
                $fichero = $objEmpresa->Logo;
                $imagen = imagecreatefromjpeg($fichero);
                
                printer_draw_bmp($ph,$objEmpresa->Logo , 40, 1);
                
                //Cabecera del ticket
                $font = printer_create_font("Arial", 20, 13, PRINTER_FW_THIN, false, false, false, 0);
                printer_set_option($ph, PRINTER_SCALE, 75);
                printer_set_option($ph, PRINTER_TEXT_ALIGN, PRINTER_TA_CENTER);
                
                printer_select_font($ph, $font);
                printer_draw_text($ph, utf8_decode($objEmpresa->NombreComercial), 0, 310);
                printer_draw_text($ph, "RFC: $objEmpresa->RFC", 0, 330);
                printer_draw_text($ph, utf8_decode($objEmpresa->Calle). " ". $objEmpresa->NumeroExterior. " ". $objEmpresa->NumeroInterior,0,350);
                printer_draw_text($ph, utf8_decode($objEmpresa->Colonia). " Irapuato, Gto." , 0, 370);
                 printer_draw_text($ph, "C.P. ". $objEmpresa->CodigoPostal, 0, 390);
                $objComanda = new Comanda();
                $comanda = $objComanda->Detalle_Uno($objVenta->IdComanda);
                $quitar= split("°", $comanda);
                printer_delete_font($font);
                
                printer_draw_text($ph, "Comanda: ". $quitar[0], 0, 410);
                printer_draw_text($ph, date("d/m/Y H:m:s"), 0, 430);
                printer_draw_text($ph, "------------------------------------------------------------------", 0, 450);
                 $font2 = printer_create_font("Arial", 20, 10, PRINTER_FW_NORMAL, false, false, false, 0);
                printer_select_font($ph, $font2);
                
                printer_draw_text($ph, "Cant", 0, 470);
                printer_draw_text($ph, utf8_decode("Descripción"), 60, 470);
              //  printer_draw_text($ph, "Precio", 220, 110);
                printer_draw_text($ph, "Total", 270, 470);
              //  printer_draw_text($ph, "IVA", 370, 110);
                printer_delete_font($font2);
                $font = printer_create_font("Arial", 20, 15, PRINTER_FW_NORMAL, false, false, false, 0);
                printer_select_font($ph, $font);
                printer_draw_text($ph, "------------------------------------------------------------------", 0, 490);
                printer_delete_font($font);
                $cont = 490;
  
  		$suma_subtotal = 0.00;
                $suma_Iva = 0.00;
                $suma_total = 0.00;
                $bandera_iva_16 = false;
                
                $Descripcion = "";
                foreach ($Detalles as $detalle) {
                    $cont = $cont + 20;
                    $fontprd = printer_create_font("Arial", 25,10, PRINTER_FW_NORMAL, false, false, false, 0);
                    printer_select_font($ph, $fontprd);
                    //$detalle->Descripcion = str_pad($detalle->Descripcion, 15, " ", STR_PAD_RIGHT); 
                    $formato_descripcion = sprintf('%-5.14s', $detalle->Descripcion);
                    
                    printer_draw_text($ph, $detalle->Cantidad, 0, $cont);
                    printer_draw_text($ph, utf8_decode($formato_descripcion), 60, $cont);
                    printer_draw_text($ph, number_format($detalle->SubTotal,2,'.',''), 270, $cont);
//                    $formato = sprintf('%-5.11s %-10.15s %-8.5s %-8.2f', $detalle->Cantidad, $detalle->Descripcion, "  ", $detalle->SubTotal);
//                    $printer->text($formato);
//                    $printer->text("\n");
                    $suma_subtotal += $detalle->SubTotal;
                    $suma_Iva += $detalle->IVA;
                    $suma_total += $detalle->Total;
                    if ($detalle->IVA == 16) {
                        $bandera_iva_16 = true;
                    }
                }
                $suma_total = $suma_total - $objVenta->Descuento;

				
                
                if ($bandera_iva_16 == TRUE) {
                    $suma_subtotal = $suma_total / (1 + (16 / 100));
                    $suma_Iva = $suma_subtotal * (16 / 100);
                } else {
                    $suma_subtotal = $suma_total;
                    $suma_Iva = 0;
                }
                $suma_total = $objVenta->Propina + $suma_total;
                
                
                 printer_draw_text($ph, "SubTotal", 130, $cont+50);
                 printer_draw_text($ph, number_format($suma_subtotal,2,'.',''), 270, $cont+50);
                 
                 printer_draw_text($ph, "IVA", 130, $cont+70);
                 printer_draw_text($ph, number_format($suma_Iva,2,'.',''), 270, $cont+70);
                 
                 printer_draw_text($ph, "Descuento", 130, $cont+90);
                 printer_draw_text($ph, number_format($objVenta->Descuento,2,'.',''), 270, $cont+90);
                
                printer_draw_text($ph, "Propina", 130, $cont+110);
                printer_draw_text($ph, number_format($objVenta->Propina,2,'.',''), 270, $cont+110);
                
                printer_draw_text($ph, "Total", 130, $cont+130);
                printer_draw_text($ph, number_format($suma_total,2,'.',''), 270, $cont+130);
                
                printer_draw_text($ph, "Gracias por su visita. Vuelva pronto", 0, $cont+170);
                printer_draw_text($ph, "************SOFTAPPETIT***********", 0, $cont+210);
                
                
                printer_end_page($ph);
                printer_end_doc($ph);
                printer_close($ph);
               
                
        }
        catch(Exception $e){
            header("Location F_A_Comanda_A_Detalle.php?IdComanda$objVenta->IdComanda"); 
        }
         
        
        
        
        }
    
    }
    
}


$objImprimirTicket = new N_ImprimirTicket();
$objImprimirTicket->ImprimirECLine();

