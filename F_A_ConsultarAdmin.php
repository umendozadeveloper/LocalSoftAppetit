<?php
    require 'Header.php';
?>
        
        
        <title>Consultar Administradores</title>

<form action="F_A_EditarAdmin.php" method="GET">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de administradores</label></center></h4></div>
            </td>
        </table>
                    
                    
                    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
			<tr>
                                <th><div class="centrar"><label>Nombre de usuario</label></div></th>
                                <th><div class="centrar"><label>Foto</label></div></th>
                                <th><div class="centrar"><label>Nombre</label></div></th>
                                <th><div class="centrar"><label>Apellido</label></div></th>
                                <th><div class="centrar"><label>Estatus</label></div></th>
                                <th><div class="centrar"><label>Opciones</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>          
    <?php
                require './Clases/Usuario.php';
                $objUsuario = new Usuario();
                $usuarios = $objUsuario->Consultar();
                foreach ($usuarios as $u)
                {
                    
                    echo "<tr>";
                    echo "<td><center><button data-toggle='tooltip' data-placement='right' title='Editar datos' value='$u->Id' name='Id_Admin' type='submit' class='noboton'>$u->Usuario</button></center></td>"; 
                    echo "<td><center><div class='imagenesTabla'><img class='' src='$u->Foto'></div></center></td>";
                    
                    echo "<td><center>".$u->Nombre."</center></td>"; 
                    echo "<td><center>".$u->Apellidos."</center></td>"; 
                    if($u->Estatus == 0)
                    {
                        $estatus = "Inactivo";
                    }else{
                        $estatus = "Activo";
                    }
                    echo "<td><center>".$estatus."</center></td>";
                    echo "<td><center>";
                    echo "<button class='btn btn-Bixa' data-placement='left' value='$u->Id' name='Id_Admin' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                    echo "<button class='btn btn-Bixa' type='button' onclick='eliminarUbicacion($u->Id);'  value='$u->Id' name='btnEliminar' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                    echo "<a href='F_A_DetalleAdmin.php?Id_Admin=$u->Id' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver admin a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    echo "</center></td>";
                    echo "</tr>";

                }
    
        ?>
        
                
                </tbody>
                    </table>
                        
                <br>
                <br>
                <a class="btn btn-Bixa" style="float: right" href="F_A_RegistrarAdministrador.php">
                        Agregar otro administrador
                </a>
                
                <a class="btn btn-Regresar"  href="F_A_PaginaPrincipal.php">
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
            $("#IDCatalogo").val("7");
            swal({  
                title: "¿Desea eliminar al administrador?",
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
