        <?php
require 'Header.php';
include_once  './Clases/Mesa.php';
include_once './Clases/ZonaUbicacion.php';

        ?>
<title>Consultar Mesas</title>
    
        
        <form action="F_A_EditarMesas.php" method="GET">
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de mesas</label></center></h4></div>
            </td>
        </table>
                
                
                
                <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
			<tr>
                            <th><div class="centrar"><label>No. Mesa</label></div></th>
                            <th><div class="centrar"><label>Cantidad de personas</div></label></th>
                            <th><div class="centrar"><label>Zona de ubicación</div></label></th>
                            <th><div class="centrar"><label>Estatus</div></label></th>
                            <th width="18%"><div class="centrar"><label>Opciones</div></label></th>
            
                
			</tr>
		</thead>
                <tbody>          
                    <?php 
                    $objMesa = new Mesa();
                    $objZonaUbicacion = new ZonaUbicacion();
                    $mesas = $objMesa->ConsultarDisponibles();
                    foreach ($mesas as $m){
                    echo "<tr>";
                    echo "<td><center><button value='$m->ID' name='IdMesa' type='submit' class='noboton' data-placement='right' data-toggle='tooltip' title='Editar datos'>$m->Numero</button></center></td>";
                    echo "<td><center>".$m->CantidadPersonas."</td>";
                    
                    $objZonaUbicacion->ConsultarPorID($m->Ubicacion);
                    
                    echo "<td><center>".$objZonaUbicacion->Descripcion."</td>";
                    
                    if($m->Activo == '0')
                    {
                        $estatus = "Inactivo";
                    }
                    else{
                        $estatus = "Activo";
                    }
                    
                    echo "<td><center>".$estatus."</td>";
                    echo "<td><center>";
                    echo "<button class='btn btn-Bixa'  value='$m->ID' name='IdMesa' data-placement='left' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                    echo "<button class='btn btn-Bixa' type='button' onclick='eliminarMesa($m->ID);'  value='$m->ID' name='btnMesa' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                    echo "<a href='F_A_DetalleMesa.php?IdMesa=$m->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver mesa a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    echo "</center></td>";
                    echo "</tr>";
                }
                    ?>
                </tbody>
                    </table>
                <br>
                
                
                <a class="btn btn-Bixa" style="float: right;" href="F_A_RegistrarMesa.php">
                        Agregar otra mesa
                </a>
                <a class="btn btn-Regresar" href="F_A_PaginaPrincipal.php">
                      &larr; Menú Principal
                </a>
                <br>
                <br>
                <br>
           </div>
        </form>    


        <form method="POST" action="./Validaciones_Lado_Servidor/N_BorradoLogico_Mesa.php" id="formDelete">

    <input type="text" id="txtID" name="txtID" class="ocultar">
</form>
    </body>
    
    <script>
        function eliminarMesa(ID){
            $("#txtID").val(ID);
            swal({  
                title: "¿Desea eliminar la mesa?",
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
                    $('#formDelete').submit();
                }
                
            
            });
            
        }
    </script>
</html>
