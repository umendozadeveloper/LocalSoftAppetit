<?php
    require 'Header.php';
    require_once './Clases/UnidadMedidaInsumos.php';
    require_once './Clases/UMContent.php';
    require_once './Clases/InventarioEstados.php';
 require_once './Clases/Insumo.php';
          include_once './Clases/Inventario.php';
?>
        
        
        <title>Consultar inventarios</title>

        <form action="F_A_EditarInsumo.php" method="GET">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Inventarios </label></center></h4></div>
            </td>
        </table>
                    
                    
                    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
			<tr>
                            <th><div class="centrar"><label>Folio</label></div></th>
                            <th><div class="centrar"><label>Fecha de inicio</label></div></th>
                            <th><div class="centrar"><label>Estado</label></div></th>
                            <th><div class="centrar"><label>Observaciones</label></div></th>
                            <th><div class="centrar"><label>Opciones</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>        
                    <?php 
                     $objInventario= new Inventario();
                    $inventarios = $objInventario->ConsultarTodo();
                    $ids_inventarios= "";
                    
                    foreach($inventarios as $invent)
                    {
                        echo "<tr>";
                       
                        echo "<td style='width:18.3%;'><center>$invent->ID</center></td>";
                        echo "<td style='width:20.4%;'><center>".date_format($invent->Fecha,'d/m/Y')."</center></td>";
                        $objInvEstados = new InventarioEstados();
                        $objInvEstados->ConsultarPorID($invent->IdEstado);
                        echo "<td style='width:17.2%;'><center>$objInvEstados->Descripcion</center></td>";
                        echo "<td style='width:28%;'><center>$invent->Observaciones</center></td>";
                        echo "<td><center><a href='F_A_InventariosFinalizar.php?IdInventario=$invent->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver inventario a detalle'><span class='glyphicon glyphicon-search'></span></a></center></td>";
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
