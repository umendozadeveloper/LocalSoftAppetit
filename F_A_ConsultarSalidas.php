<?php
    require 'Header.php';
    require_once './Clases/SalidaVenta.php';
    require_once './Clases/DetalleSalida.php';
   
?>
        
        
        <title>Consultar entradas</title>

        <form action="F_A_EditarInsumo.php" method="GET">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Consumo (Salidas)</label></center></h4></div>
            </td>
        </table>
                    
                    
                    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
			<tr>
                            <th><div class="centrar"><label>Fecha</label></div></th>
                            <th><div class="centrar"><label>Encargado</label></div></th>
                            <th><div class="centrar"><label>Costo Total</label></div></th>
                            <th><div class="centrar"><label>Cliente</label></div></th>
                            <th><div class="centrar"><label>Opciones</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>        
                    <?php 
                    $objSalidasVentas = new SalidaVenta();
                    $ventas = $objSalidasVentas->ConsultarSalidas_SalidasVentas_Cliente_Encargado();
                    $objDetalleSalida = new DetalleSalida();
                    
                    foreach($ventas as $vent)
                    {
                        echo "<tr>";
                        echo "<td><center>".$vent['Fecha']."</center></td>";
                        echo "<td><center>".$vent['Nombre']." ".$vent['Apellidos']."</center></td>";
                        $total = $objDetalleSalida->ObtenerTotalSalida($vent['IdSalida']);
                        echo "<td><center>$".$total."</center></td>";
                        echo "<td><center>".$vent['NombreCliente']."</center></td>";
                        
                        echo "<td><center><a href='F_A_DetalleSVenta.php?IdSalida=".$vent['IdSalida']."' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver salida a detalle'><span class='glyphicon glyphicon-search'></span></a></center></td>";
                        echo "</tr>";
//                        $ids_inventarios.=",".$invent->ID;
                    }
                
//                echo '<input class="mostrar" value="" name="txtValInvent" id=txtValInvent>';
                 ?>
        
                
                </tbody>
                    </table>
                        
                <br>
                <br>
                
               
                <br>
                <br>
           </div>
        </form>        
                
    </body>
</html>
