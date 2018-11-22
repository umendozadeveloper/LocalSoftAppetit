<?php
require_once '../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


	try
	{
		$connector = new WindowsPrintConnector("Tickets");
		$printer = new Printer($connector);
		 $Mensaje = "<table>
						<thead>
						<tr>
						<th>Producto</th>
						<th>Precio</th>
						</tr>
						<tbody>
						<tr>
						<td>Refresco</td>
						<td>10.00</td>
						</tr>
						</tbody>
						</thead>
						</table>";
		$printer->initialize();
		
		$printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		
		$printer->setTextSize(2,2);
		$printer->text("Prueba ");
		$printer->feed(2);
		$printer->selectPrintMode();
		$printer->setEmphasis(true);
		$printer->text("Producto \t  Precio \n");
		$printer->setEmphasis(false);
		
		$printer->text("Refresco \t  12 \n");
		$printer->text("Agua \t  8 \n");
		$printer->text("Sopa \t  35 \n");
		$printer->text("Pastel \t  25 \n");
		$printer->feed(2);
		
		
		$printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH );
		$printer->setEmphasis(true);
		$printer -> setTextSize(2,3);
		$printer->text("Prueba ");
		$printer->feed(2);
		$printer->selectPrintMode();
		//$printer->textRaw;
		$printer->feed(2);
		$printer->setEmphasis(false);
		
		echo "<script>window.Print();</script>";
		$printer->cut();
		$printer->close();
	}
	catch (Exception $e)
	{
		echo "error";
	}
