          <?php
          require 'Header.php';
          require_once './Clases/Insumo.php';
          include_once './Clases/Inventario.php';
          ?>        
            <title>Impresión de listado</title>
            
<!--        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">       -->
            

        <form action="Validaciones_Lado_Servidor/Validar_ListaConteo.php" method="POST" name="form" id="form">
            
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Impresión de listado para conteo</label></center></h4></div>
            </td>
        </table>
        </div>
           
            
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
        <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
			<tr>
                            <th><div class="centrar"><label>Folio</label></div></th>
                            <th><div class="centrar"><label>Fecha de inicio</label></div></th>
                            <th><div class="centrar"><label>Estado</label></div></th>
                            <th><div class="centrar"><label>Observaciones</label></div></th>
                            <th><div class="centrar"><label>Sin existencias</label></div></th>
                            <th><div class="centrar"><label>Con existencias</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>        
                    <?php 
                     $objInventario= new Inventario();
                    $inventarios = $objInventario->ConsultarPorEstado(1);
                    $ids_inventarios= "";

                    foreach($inventarios as $invent)
                    {
                        echo "<tr>";
                       
                        echo "<td style='width:18.3%;'><center>$invent->ID</center></td>";
                        echo "<td style='width:20.4%;'><center>".date_format($invent->Fecha,'d/m/Y')."</center></td>";
                        echo "<td style='width:17.2%;'><center>Activo</center></td>";
                        echo "<td style='width:28%;'><center>$invent->Observaciones</center></td>";
                        echo "<td><center><a href='./pdf_reportes/ListaParaConteoSin$invent->ID.pdf' target='_blank' class='btn btn-Bixa' data-placement='left data-toggle='tooltip' title=''' data-original-title='imprimir listado sin existencias'><span class='glyphicon glyphicon-print'></span></a></center></td>";
                        echo "<td><center><a href='./pdf_reportes/ListaParaConteoCon$invent->ID.pdf' target='_blank' class='btn btn-Bixa' data-placement='left data-toggle='tooltip' title=''' data-original-title='imprimir listado con existencias'><span class='glyphicon glyphicon-print'></span></a></center></td>";
                        
                   
                        echo "</tr>";
//                        $ids_inventarios.=",".$invent->ID;
                    }
                
//                echo '<input class="mostrar" value="" name="txtValInvent" id=txtValInvent>';
                 ?>
        
                
                </tbody>
                    </table>
                        
                <br>
                <br>
    </div>
 
    
          
    <script>
        
        function ImprimirSinExistencias(ids_seleccionados){
            var incluir_existencias = false;
            $.ajax({
                    url: "Validaciones_Lado_Servidor/Validar_ListaConteo.php",
                    type: 'POST',
                    data: {"incluir_existencias": incluir_existencias,
                           "ids_seleccionados": ids_seleccionados},
                    success: function(){
    //                    
                           
                    }
                }); 
        }
        
           
    </script>
            </form>            
            

    </body>
</html>
