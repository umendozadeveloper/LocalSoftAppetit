
        <?php
        require 'Header.php';
        ?>
        
        
        <title>Consultar Clientes</title>

        
        
        
            
        <form action="F_A_EditarClientes.php" method="GET">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de clientes</label></center></h4></div>
            </td>
        </table>
                    
                    
                <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%" style="text-align: center;">
                    <thead style="margin-bottom: 10px;">
			<tr>
                            
                                <th><div class="centrar"><label>Nombre</label></div></th>
                                <th><div class="centrar"><label>RFC</label></div></th>
                                <th><div class="centrar"><label>Municipio</label></div></th>
                                <th><div class="centrar"><label>Teléfono</label></div></th>
                                <!--<th><div class="centrar"><label>Correo</label></div></th>-->
                                <th><div class="centrar"><label>Estatus</label></div></th>
                                
                    <th><div class="centrar"><label>Opciones</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>          
    <?php
                require './Clases/ClientesFacturas.php';
                require_once './Clases/CatalogoMunicipio.php';
                $objClientes = new ClientesFacturas();
                $clientes = $objClientes->obtenerTodo();
                foreach ($clientes as $m)
                {
                    
                    echo "<tr>";
                    
                    echo "<td><button data-toggle='tooltip' data-placement='right' title='Editar datos' value='$m->ID' name='IdCliente' type='submit' class='noboton'>$m->NombreCliente</button></td>"; 
                    echo "<td>".$m->RFC."</td>";
                    
                    $objMunicipio = new CatalogoMunicipio();
                    $objMunicipio->ObtenerPorId($m->IdMunicipio);
                    
                    echo "<td>".$objMunicipio->DESCRIP."</td>"; 
                    echo "<td>".$m->Telefono."</td>"; 
//                    echo "<td>".$m->Correo."</td>"; 
                    if($m->Estatus = '0'){
                            $estatus="Inactivo";
                    }
                    else {
                        $estatus="Activo";
                    }
                    echo "<td>".$estatus."</td>";
                    //echo "<td>".$m->Correo."</td>";
                    
                    echo "<td>";
                    echo "<button class='btn btn-Bixa' value='$m->ID' name='IdCliente' data-toggle='tooltip' data-placement='left' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                    if($m->ID ==1 || $m->ID == 2 )
                    {
                        echo "<button disabled class='btn btn-Bixa' type='button' onclick='eliminarUbicacion($m->ID);'  value='$m->ID' name='btnEliminar' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                    
                    }else{
                       echo "<button class='btn btn-Bixa' type='button' onclick='eliminarUbicacion($m->ID);'  value='$m->ID' name='btnEliminar' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                     
                    }
                    echo "<a href='F_A_DetalleCliente.php?IdCliente=$m->ID' class='btn btn-Bixa'  data-toggle='tooltip' data-placement='left' title='Ver cliente a detalle'><span class='glyphicon glyphicon-search'></span></a>"
                            . "<a href='F_A_FacturasFiscales.php?IdCliente=$m->ID'  class='btn btn-Bixa'  data-toggle='tooltip' data-placement='left' title='Facturar cliente'><span class='glyphicon glyphicon-credit-card'></span></a>";
                            
                    echo "</td>";
                    echo "</tr>";

                }
    
        ?>
        
                
                </tbody>
                    </table>
                 
                <br>
                <br>
                <a class="btn btn-Bixa" style="float: right;"  href="F_A_RegistrarCliente.php">
                        Agregar otro cliente
                </a>
                
                <a class="btn btn-Regresar" href="F_A_PaginaPrincipal.php">
                        &larr; Menú Principal
                    </a>
                <br>
                <br>
           </div>
        </form>        
        <form id="Factura" name="Factura"  action="F_A_FacturasFiscales.php" method="GET">
            <input type="text" id="IdCliente" name="IdCliente" class="ocultar"/>
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
            $("#IDCatalogo").val("10");
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
<script>
    function Facturar(Cliente)
    {
        $("IdCliente").val(Cliente);
        $("#Factura").submit();
        
    }
    </script>
