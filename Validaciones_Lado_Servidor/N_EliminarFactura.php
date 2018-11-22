<?php

require_once '../Clases/VentasFacturadas.php';
require_once '../Clases/PagosFacturas.php';
require_once '../Clases/Facturas.php';
require_once '../Clases/Ventas.php';

class N_EliminarFactura
{
    function main()
    {
    $IdFactura = $_POST['IdFactura'];

    $objPagosFacturas = new PagosFacturas();
    $objVentasFacturadas = new VentasFacturadas();
$objVentas = new Ventas();
$objFactura = new Facturas();

$Ventas = $objVentasFacturadas->ObtenerPorFactura($IdFactura);

foreach ($Ventas as $V)
{
    $objVentas->VentaNoFacturada($V->IdVenta);
}

$objPagosFacturas->Eliminar($IdFactura);
$objVentasFacturadas->Eliminar($IdFactura);
$objFactura->Eliminar($IdFactura);

    }
}

$objEliminar = new N_EliminarFactura();
$objEliminar->main();
