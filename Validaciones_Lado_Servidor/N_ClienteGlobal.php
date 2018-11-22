<?php


require '../Clases/ClientesFacturas.php';
require '../Clases/CatalogoEstado.php';
require '../Clases/CatalogoMunicipio.php';

$objCliente = new ClientesFacturas();
$objCliente->obtenerPorRFC("XAXX10101000");
$interior ="";
$exterior = "no. ext.";
$objEstado = new CatalogoEstado();
$objEstado->ObtenerPorId($objCliente->IdEstado);
$objMunicipio = new CatalogoMunicipio();
$objMunicipio->ObtenerPorId($objCliente->IdMunicipio);

if($objCliente->NumeroInterior != NULL){$interior = "no. int.";}
else{ $exterior="";}
/*$tabla = "<div id='DatosClientes' name='DatosClientes' class='table-responsive'>"
        . "<table class='table table-bordered'>"
        . "<tr><td colspan='2' class='BarraBixa' style='display:contents;'>Datos del cliente</td></tr>";
$tabla.= "<tr><td>".$objCliente->NombreCliente."</td><td>$objCliente->RFC</td></tr>"
        . "<tr><td colspan='2'>$objCliente->Calle $interior $objCliente->NumeroInterior $exterior $objCliente->NumeroExterior</td></tr>"
        ."<tr><td>Col. $objCliente->Colonia</td><td> C.P. $objCliente->CodigoPostal </td></tr>"
        ."<tr><td>$objMunicipio->DESCRIP, $objEstado->DESCRIP</td><td> $objCliente->Pais</td></tr>"
        . "<tr><td>$objCliente->Correo</td><td>Tel. $objCliente->Telefono</td></tr>"; 
       
$tabla.="</table></div>";*/


$tabla = " <input name='IdClienteI' id='IdClienteI' class='ocultar' value='$objCliente->ID'/>"
        . "<div id='DatosClientes' name='DatosClientes'>"
        . "<table class='table table-striped'>"
        . "<th colspan='4'><center>Datos del cliente</center></th>";
$tabla.= "<tr>
                    <td id='RFC' name='RFC' style='font-weight:normal; color:#AD1515;'><strong>RFC:</strong> $objCliente->RFC</td>
                    <td id='Nombre' name='Nombre' style='font-weight:normal; color:#180576;'><strong>Cliente:</strong>  $objCliente->NombreCliente</td>
                    <td id='Direccion' name='Direccion' style='font-weight:normal;'><strong>Ubicación:</strong> $objCliente->Calle  $objCliente->NumeroExterior  $objCliente->Colonia   $objCliente->Pais </td>
                    <td style='float: right;'><button type='button' name='btnClientes' id='btnClientes' class='btn btn-Bixa'data-toggle='modal' data-target='#CatalogoClientes'>Clientes...</button></td>
                    </tr>"; 
       
$tabla.="</table></div>";


if($objCliente->ID!=0)
{
    echo $tabla;
}
    
?>


    
                
            


