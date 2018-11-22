<?php

require_once '../Clases/Ventas.php';
require_once '../Clases/Comanda.php';

class N_Mostrar_Tickets
{
    public $Filtro;
    
    public function __construct() {
        $this->main();
    }
    
    public function main()
    {
        $this->Filtro = $_POST['Filtro'];
        $objVentas = new Ventas();
        $objComanda = new Comanda();
        switch($this->Filtro)
        {
            case 2:
                $filtro = "DATEPART(week, GETDATE()) = DATEPART(week, Fecha)";
                $Ventas = $objVentas->ObtenerNoFacturados($filtro);
                //$objComanda->ConsultarPorID($objVentas->IdComanda);
                break;
            case 3:
                $filtro = "DATEPART(Month, GETDATE()) = DATEPART(Month, Fecha)";
                $Ventas = $objVentas->ObtenerNoFacturados($filtro);
                //$objComanda->ConsultarPorID($objVentas->IdComanda);
                break;
            case 4:
                $filtro = "DATEPART(DAY, GETDATE()) = DATEPART(DAY, Fecha)";
                $Ventas = $objVentas->ObtenerNoFacturados($filtro);
                break;
            default :
                $Ventas = $objVentas->ObtenerTodosNoFacturados();
                break;
        }
        
        echo "<div id='ComandasDiv' name='ComandasDiv'>
                
                
                
                
                <table class='table table-bordered'>
                    <thead>
                     
                    
                    </th>
                    
                        <tr>
                            <th>Fecha</th>
                            <th>Comanda</th>
                            <th>Agregar</th>
                        </tr>
                    </thead>";

                    
                
        
        foreach ($Ventas as $Venta)
        {
            $objComanda->ConsultarPorID($Venta->IdComanda);
            $Venta->Fecha = $Venta->Fecha->format('Y-m-d');
            
            echo "<tr class=''><td>$Venta->Fecha</td><td>$objComanda->Folio</td><td><center><input onclick='MostrarConsumo();'class='active' name='chkComanda$Venta->ID' type='checkbox' value='$Venta->ID' /></center></td></tr>";
            
        }
        echo "</table>
                
            </div>";
    }
}
$objTickets = new N_Mostrar_Tickets();

