<?php

require_once '../Clases/VentasFacturadas.php';
require_once '../Clases/PagosFacturas.php';
require_once '../Clases/Facturas.php';
require_once '../Clases/Ventas.php';
require_once '../Clases/Correo.php';
require_once '../Clases/ClientesFacturas.php';


class N_EnviarCFDIPorCorreo
{
    function main()
    {
        $IdFactura = $_POST['IdFactura'];

        $objFactura = new Facturas();
        $objFactura->ObtenerPorId($IdFactura);
        
        $objCliente = new ClientesFacturas();
        $objCliente->obtenerPorID($objFactura->IdCliente);
        
        $objCorreo = new Correo();
        $resultado_envio =0;
        $resultado_envio = $objCorreo->EnviarFactura($objCliente->Correo, $objFactura->RutaXML, $objFactura->RutaPDF, '¡Gracias por su visita! Vuelva pronto.');
        if($resultado_envio == 1)
        {
           
//             setSuccessMessage("El CFDI fue enviado por correo al cliente.");
            
//            swal("¡Correcto!", "El correo se ha enviado al cliente", "success");
            echo "1";
        }
        else{
//            swal("¡Error!", "No se pudo enviar el correo, intente nuevamente", "error");
//            setFailureMessage("no");
            echo "0";
        }
        

    }
}

$objEnviarCorreo = new N_EnviarCFDIPorCorreo();
$objEnviarCorreo->main();


