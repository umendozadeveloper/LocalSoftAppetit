        <?php
require 'Header.php';
require_once './Clases/Ubicacion.php';

        ?>
<title>Consultar Ubicación</title>
    
        
        <form action="F_A_EditarUbicacion.php" method="GET">
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de ubicación</label></center></h4></div>
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
                    $objUbicacion = new Ubicacion();
                    $ubicaciones = $objUbicacion->ConsultarTodo();
                    foreach ($ubicaciones as $ubi){
                    echo "<tr>";
                    
                    echo "<td><center>".$ubi->Clave."</center<</td>";
                    echo "<td><center>".$ubi->Descripcion."</center></td>";
                    
                    if($ubi->Estatus='0')
                    {
                        $estatus="Inactivo";
                    }
                    else{
                        $estatus = "Activo";
                    }
                    
                    echo "<td><center>".$estatus."</center></td>";
                    echo "<td><center>";
                    if($ubi->ID>0)
                    {
                        echo "<button class='btn btn-Bixa'  value='$ubi->ID' name='IdUbicacion' data-placement='left' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                        echo "<button class='btn btn-Bixa' type='button' onclick='eliminarUbicacion($ubi->ID);'  value='$ubi->ID' name='btnUbicacion' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                    
                    }
                    else{
                        echo "<button class='btn btn-Bixa' disabled onclick='return false' value='$ubi->ID' name='IdUbicacion' data-placement='left' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                        echo "<button class='btn btn-Bixa' onclick='return false' disabled type='button' onclick='eliminarUbicacion($ubi->ID);'  value='$ubi->ID' name='btnUbicacion' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                    
                    }
                   echo "<a href='F_A_DetalleUbicacion.php?IdUbicacion=$ubi->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver ubicación a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    echo "</center></td>";
                    echo "</tr>";
                }
                    ?>
                </tbody>
                    </table>
                <br>
                
                
                <a class="btn btn-Bixa" style="float: right;" href="F_A_RegistrarUbicacion.php">
                        Agregar otra ubicación
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
        function eliminarUbicacion(ID){
            $("#txtID").val(ID);
            $("#IDCatalogo").val("5");
            swal({  
                title: "¿Desea eliminar la ubicación?",
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

