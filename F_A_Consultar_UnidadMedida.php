        <?php
require 'Header.php';
require_once './Clases/UnidadMedidaInsumos.php';


        ?>
<title>Consultar Unidades Medida</title>
    
        
<form action="F_A_Editar_UnidadMedida.php" method="GET">
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de unidades de medida</label></center></h4></div>
            </td>
        </table>
                
                
                
                <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
			<tr>
                                <th><div class="centrar"><label>Clave</label></div></th>
                                <th><div class="centrar"><label>Descripción</label></div></th>
                                <th><div class="centrar"><label>Estatus</label></div></th>
                                <th width="25%"><div class="centrar"><label>Opciones</div></label></th>
            
                
			</tr>
		</thead>
                <tbody>          
                    <?php 
                    $objUnidad = new UnidadMedidaInsumo();
                    $unidades = $objUnidad->ConsultarTodo();
                    foreach ($unidades as $uni){
                    echo "<tr>";
                    echo "<td><center>".$uni->Clave."</center></td>";
                    echo "<td><center>".$uni->Descripcion."</center></td>";
                    
                     if($uni->Estatus =='0')
                         $estatus= "Inactivo";
                     else
                         $estatus="Activo";
                     
                    echo "<td><center>".$estatus."</center></td>";
                    echo "<td><center>";
                    if($uni->ID >5)
                    {
                        echo "<button class='btn btn-Bixa'  value='$uni->ID' name='IdUnidad' data-placement='left' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                        echo "<button class='btn btn-Bixa' type='button' onclick='eliminarUnidadMedida($uni->ID);'  value='$uni->ID' name='btnUnidad' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                        echo "<a href='F_A_Detalle_UnidadMedida.php?IdUnidad=$uni->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver unidad a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    }
                    else{
                        echo "<button class='btn btn-Bixa' disabled  value='$uni->ID' name='IdUnidad' data-placement='left' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                        echo "<button class='btn btn-Bixa' disabled type='button' onclick='eliminarUnidadMedida($uni->ID);'  value='$uni->ID' name='btnUnidad' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                        echo "<a href='F_A_Detalle_UnidadMedida.php?IdUnidad=$uni->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver unidad a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                   
                    }
                    echo "</center></td>";
                    echo "</tr>";
                }
                    ?>
                </tbody>
                    </table>
                <br>
                
                
                <a class="btn btn-Bixa" style="float: right;" href="F_A_Registrar_UnidadMedida.php">
                        Agregar otra unidad de medida
                </a>
                <a class="btn btn-Regresar" href="F_A_PaginaPrincipal.php">
                      &larr; Menú Principal
                </a>
                <br>
                <br>
                <br>
           </div>
        </form>    
<form method="POST" action="./Validaciones_Lado_Servidor/N_EliminarElementoCatalogo.php" id="formDelete" >
    <input type="text" id="txtID" name="txtID" class="ocultar">
    <input type="text" id="IDCatalogo" name="IDCatalogo" class="ocultar">
</form>
    </body>
    
    <script>
        function eliminarUnidadMedida(ID){
            $("#txtID").val(ID);
            $("#IDCatalogo").val("3");
            swal({  
                title: "¿Desea eliminar la unidad de medida?",
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
