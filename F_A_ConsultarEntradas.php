<?php
    require 'Header.php';
    require_once './Clases/EntradaCompras.php';
   
?>
        
        
        <title>Consultar entradas</title>

        <form action="F_A_EditarInsumo.php" method="GET">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Entradas</label></center></h4></div>
            </td>
        </table>
                    
                    
                    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
			<tr>
                            <th><div class="centrar"><label>Fecha</label></div></th>
                            <th><div class="centrar"><label>Proveedor</label></div></th>
                            <th><div class="centrar"><label>Núm. documento</label></div></th>
                            <th><div class="centrar"><label>Observaciones</label></div></th>
                            <th><div class="centrar"><label>Costo Total</label></div></th>
                            <th><div class="centrar"><label>Opciones</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>        
                    <?php 
                     $objEntradasCompras = new EntradaCompras();
                     $compras = $objEntradasCompras->ConsultarEntradas_Compras_Proveedor();
                     
                    
                    foreach($compras as $comp)
                    {
                        echo "<tr>";
                        echo "<td><center>".$comp['Fecha']."</center></td>";
                        echo "<td><center>".$comp['Proveedor']."</center></td>";
                        echo "<td><center>".$comp['Documento']."</center></td>";
                        echo "<td><center>".$comp['Observaciones']."</center></td>";
                        echo "<td><center>$".$comp['CostoTotal']."</center></td>";
                        echo "<td><center><a href='F_A_DetalleECompra.php?IdEntrada=".$comp['IdEntrada']."' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver compra a detalle'><span class='glyphicon glyphicon-search'></span></a></center></td>";
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
