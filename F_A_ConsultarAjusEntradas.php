<?php
    require 'Header.php';
    require_once './Clases/EntradaAjuste.php';
   
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
                     $objEntradasAjustes = new EntradaAjuste();
                     $entradasAjuste = $objEntradasAjustes->ConsultarEntradas_Ajuste_Proveedor();
                     
                    
                    foreach($entradasAjuste as $ajuste)
                    {
                        echo "<tr>";
                        echo "<td><center>".$ajuste['Fecha']."</center></td>";
                        echo "<td><center>".$ajuste['Proveedor']."</center></td>";
                        echo "<td><center>".$ajuste['Documento']."</center></td>";
                        echo "<td><center>".$ajuste['Observaciones']."</center></td>";
                        echo "<td><center>$".$ajuste['CostoTotal']."</center></td>";
                        echo "<td><center><a href='F_A_DetalleEAjuste.php?IdEntrada=".$ajuste['IdEntrada']."' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver entrada a detalle'><span class='glyphicon glyphicon-search'></span></a></center></td>";
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
