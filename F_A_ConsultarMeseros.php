
        <?php
        require 'Header.php';
        ?>
        
        
        <title>Consultar Meseros</title>

  
        <form action="F_A_EditarMeseros.php" method="GET">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de meseros</label></center></h4></div>
            </td>
        </table>
                    
                    
                    <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
			<tr>
                            
                                <th><div class="centrar"><label>Nombre de usuario</label></div></th>
                                <th><div class="centrar"><label>Foto</label></div></th>
                                <th><div class="centrar"><label>Nombre</label></div></th>
                                <th><div class="centrar"><label>Apellidos</label></div></th>
                                <th><div class="centrar"><label>Estatus</label></div></th>
                                <th><div class="centrar"><label>Opciones</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>          
    <?php
                require './Clases/Mesero.php';
                $objMesero = new Mesero();
                $meseros = $objMesero->ConsultarTodo();
                foreach ($meseros as $m)
                {
                    
                    echo "<tr>";
                    
                    echo "<td><center><button data-toggle='tooltip' title='Editar datos' value='$m->ID' name='IdMesero' type='submit' class='noboton'>$m->Usuario</button></center></td>"; 
                    echo "<td><center><div class='imagenesTabla'><img class='' src='$m->Foto'></div></center></td>";
                    echo "<td><center>".$m->Nombre."</center></td>";
                    echo "<td>".$m->Apellidos."</td>"; 
                   
                    if($m->Estatus == '0')
                        $estatus = "Inactivo";
                    else
                        $estatus = "Activo";
                    echo "<td><center>".$estatus."</center></td>"; 
                    echo "<td><center>";
                    if($m->IdAdmin=='-9999' || $m->IdAdmin==NULL){
                        echo "<button class='btn btn-Bixa' value='$m->ID' name='IdMesero' data-toggle='tooltip' data-placement='left' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                        echo "<button class='btn btn-Bixa' type='button' onclick='eliminarUbicacion($m->ID);'  value='$m->ID' name='btnEliminar' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                        echo "<a href='F_A_DetalleMesero.php?IdMesero=$m->ID' class='btn btn-Bixa'  data-toggle='tooltip' data-placement='left' title='Ver mesero a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    }else{
                        echo "<button disabled class='btn btn-Bixa' value='$m->ID' name='IdMesero' data-toggle='tooltip' data-placement='left' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                        echo "<button disabled class='btn btn-Bixa' type='button' onclick='eliminarUbicacion($m->ID);'  value='$m->ID' name='btnEliminar' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                        echo "<a href='F_A_DetalleMesero.php?IdMesero=$m->ID' class='btn btn-Bixa'  data-toggle='tooltip' data-placement='left' title='Ver mesero a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                      
                    }
                    echo "</center></td>";
                    echo "</tr>";

                }
    
        ?>
        
                
                </tbody>
                    </table>
                 
                <br>
                <br>
                <a class="btn btn-Bixa" style="float: right;"  href="F_A_RegistrarMesero.php">
                        Agregar otro mesero
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
            $("#IDCatalogo").val("8");
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
