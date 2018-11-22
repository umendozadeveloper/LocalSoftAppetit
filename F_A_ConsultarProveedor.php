        <?php
require 'Header.php';
require_once './Clases/Proveedor.php';
require_once './Clases/CatalogoMunicipio.php';


        ?>
<title>Consultar Proveedor</title>
    
        
        <form action="F_A_EditarProveedor.php" method="GET">
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de proveedores</label></center></h4></div>
            </td>
        </table>
                
                
                
                <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
			<tr>
                                <th><div class="centrar"><label>Nombre</label></div></th>
                                <th><div class="centrar"><label>RFC</label></div></th>
                                <th><div class="centrar"><label>Municipio</label></div></th>
                                <th><div class="centrar"><label>Teléfono</label></div></th>
                                <!--<th><div class="centrar"><label>Correo</label></div></th>-->
                                <th><div class="centrar"><label>Estatus</label></div></th>
                                <th width="15%"><div class="centrar"><label>Opciones</div></label></th>
            
                
			</tr>
		</thead>
                <tbody>          
                    <?php 
                    $objUnidad = new Proveedor();
                    $objMunicipio = new CatalogoMunicipio();
                    
                    $proveedores = $objUnidad->ConsultarTodo();
                    foreach ($proveedores as $p){
                    echo "<tr>";
                    echo "<td><center>".$p->Nombre."</center></td>";
                    echo "<td><center>".$p->RFC."</center></td>";
                    $objMunicipio->ObtenerPorId($p->IdMunicipio);
                    
                    echo "<td><center>".$objMunicipio->DESCRIP."</center></td>";
                    echo "<td><center>".$p->Telefono."</center></td>";
//                    echo "<td><center>".$p->Correo."</center></td>";
                    
                    if($p->Estatus ='0')
                    {
                        $estatus="Inactivo";
                    }
                    else{
                        $estatus="Activo";
                    }
                    echo "<td><center>".$estatus."</center></td>";
                    echo "<td>";
                    echo "<button class='btn btn-Bixa'  value='$p->ID' name='IdProveedor' data-placement='left' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                    echo "<button class='btn btn-Bixa' type='button' onclick='eliminarProveedor($p->ID);'  value='$p->ID' name='btnProveedor' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                    echo "<a href='F_A_DetalleProveedor.php?IdProveedor=$p->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver mesa a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                    ?>
                </tbody>
                    </table>
                <br><br>
                
                
                
                <a class="btn btn-Bixa" style="float: right;" href="F_A_RegistrarProveedor.php">
                        Agregar otro proveedor
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
        function eliminarProveedor(ID){
            $("#txtID").val(ID);
            $("#IDCatalogo").val("2");
            swal({  
                title: "¿Desea eliminar el proveedor?",
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
