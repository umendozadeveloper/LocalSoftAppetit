<?php
    require 'Header.php';
    require_once './Clases/UnidadMedidaInsumos.php';
    require_once './Clases/UMContent.php';
    require_once './Clases/Insumo.php';
?>
        
        
        <title>Consultar insumos</title>

        <form action="F_A_EditarInsumo.php" method="GET">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de insumos</label></center></h4></div>
            </td>
        </table>
                    
                    
                    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
			<tr>
                            <th><div class="centrar"><label>Insumo</label></div></th>
                            <th><div class="centrar"><label>Presentación</label></div></th>
                            <th><div class="centrar"><label>Unidad de medida</label></div></th>
                            <th><div class="centrar"><label>Contenido</label></div></th>
                            <th><div class="centrar"><label>Estatus</label></div></th>
                            <th><div class="centrar"><label>Opciones</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>          
    <?php
                
                $objInsumo = new Insumo();
                $insumos = $objInsumo->ConsultarTodo();
                foreach ($insumos as $insumo)
                {
                    
                    echo "<tr>";
                   
                    echo "<td><center>".$insumo->Descripcion."</center></td>"; 
                    echo "<td><center>".$insumo->Presentacion."</center></td>"; 
                    $objUnidad = new UnidadMedidaInsumo();
                    $objUnidad->ConsultarPorID($insumo->IdUnidadMedida);
                    
                    echo "<td><center>".$objUnidad->Descripcion."</center></td>"; 
                    
                    $objUM = new UMContent();
                    $objUM->ConsultarPorID($insumo->IdUMContent);
                    
                    echo "<td><center>".$insumo->Contenido." ".$objUM->Descripcion."</center></td>"; 
                    if($insumo->Status=='0')
                    {
                        $estatus = "Inactivo";
                    }
                    else{
                        $estatus = "Activo";
                    }
                     echo "<td><center>".$estatus."</center></td>"; 
                    echo "<td><center>";
                    echo "<button class='btn btn-Bixa' data-placement='left' value='$insumo->ID' name='IdInsumo' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                     echo "<button class='btn btn-Bixa' type='button' onclick='eliminarUbicacion($insumo->ID);'  value='$insumo->ID' name='btnEliminar' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                    echo "<a href='F_A_DetalleInsumo.php?IdInsumo=$insumo->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver insumo a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    echo "</center></td>";
                    echo "</tr>";

                }
    
    
    
        ?>
        
                
                </tbody>
                    </table>
                        
                <br>
                <br>
                
                
                <a class="btn btn-Bixa" style="float: right;"  href="F_A_Registrar_Insumo_Inventario.php">
                        Agregar otro insumo
                </a>
                
                <a class="btn btn-Regresar" href="F_A_PaginaPrincipal.php">
                        &larr; Menú Principal
                    </a>
                <br>
                <br>
           </div>
        </form>        
                
    </body>
      <form method="POST" action="./Validaciones_Lado_Servidor/N_EliminarElementoCatalogo.php" id="formDelete" >
    <input type="text" id="txtID" name="txtID" class="ocultar">
    <input type="text" id="IDCatalogo" name="IDCatalogo" class="ocultar">
</form>
    </body>
    
    <script>
        function eliminarUbicacion(ID){
            $("#txtID").val(ID);
            $("#IDCatalogo").val("9");
            swal({  
                title: "¿Desea eliminar al mesero?",
                text: "", 
                type: "warning",  
                showCancelButton: true, 
                confirmButtonText: "Si",   
                cancelButtonText: "No", 
                closeOnConfirm: false, 
                closeOnCancel: true
            },
            function(isConfirm){ 
                if (isConfirm) {
                    $("#formDelete").submit();
                }
            });
        }
        
        
    </script>
</html>
