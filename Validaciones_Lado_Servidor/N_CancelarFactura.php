<?php

require_once '../Clases/VentasFacturadas.php';
require_once '../Clases/PagosFacturas.php';
require_once '../Clases/Facturas.php';
require_once '../Clases/Ventas.php';
require_once '../Clases/ClientesFacturas.php';
require_once '../Clases/IntegracionCancelaFactura.php';
require_once '../Clases/Empresa.php';

class N_CancelarFactura
{
    function main()
    {
        $IdFactura = $_POST['IdFactura'];
        
        $objEmpresa = new Empresa();
        $objEmpresa->ObtenerPorID(1);
        
        $objFactura = new Facturas();
        $objFactura->ObtenerPorId($IdFactura);
        
        $usuarioIntegrador = 'mvpNUXmQfK8=';
      
        $operacion_realizada = "";
        
        $objCancelaFactura = new IntegracionCancelaFactura();
        $operacion_realizada = $objCancelaFactura->CancelarFactura($objEmpresa->RFC, $objFactura->UUID, $usuarioIntegrador);
        
        if($operacion_realizada == "0")
        {
            $objPagoFactura = new PagosFacturas();
            if($objPagoFactura->Eliminar($IdFactura)==true)
            {
               $objVentasFacturadas = new VentasFacturadas();
                $array_ventas_facturadas = array();
                $array_ventas_facturadas = $objVentasFacturadas->ObtenerPorFactura($IdFactura);
                if($objVentasFacturadas->Eliminar($IdFactura)==true)
                {
                    if($objFactura->CambiarStatusCancelada($IdFactura)==true)
                    {
                        $objVentas = new Ventas();
                        if($objVentas->CambiarStatusFacturadosCancelado($array_ventas_facturadas)==TRUE)
                        {
                            
//                            
                            echo $operacion_realizada;
                        }
                    }
                }
//                

                
            }
      
        }else{
            
            echo $operacion_realizada;
            
        }
        
        

    }
}

$objEliminar = new N_CancelarFactura();
$objEliminar->main();


