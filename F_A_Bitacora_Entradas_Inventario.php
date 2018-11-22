<?php
    require 'Header.php';
?>
        
        
        <title>Bitácora de entradas</title>

        <form action="" method="GET">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Bitácora de entradas</label></center></h4></div>
            </td>
        </table>
                    
                    
                    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
			<tr>
                                <th><div class="centrar"><label>Fecha</label></div></th>
                                <th><div class="centrar"><label>Descripción</label></div></th>
                                <th><div class="centrar"><label>Cantidad</label></div></th>
                                <th><div class="centrar"><label>Notas</label></div></th>
                                <th><div class="centrar"><label>Opciones</label></div></th>
                
			</tr>
		</thead>
                    
                <tbody>          
    <?php
//                require './Clases/Usuario.php';
//                $objUsuario = new Usuario();
//                $usuarios = $objUsuario->Consultar();
//                foreach ($usuarios as $u)
//                {
//                    
//                    echo "<tr>";
//                    echo "<td><button data-toggle='tooltip' data-placement='right' title='Editar datos' value='$u->Id' name='Id_Admin' type='submit' class='noboton'>$u->Usuario</button></td>"; 
//                    echo "<td>".$u->Nombre."</td>"; 
//                    echo "<td>".$u->Apellidos."</td>"; 
//                    echo "<td>";
//                    echo "<button class='btn btn-Bixa' data-placement='left' value='$u->Id' name='Id_Admin' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
//                    echo "<a href='F_A_DetalleAdmin.php?Id_Admin=$u->Id' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver admin a detalle'><span class='glyphicon glyphicon-search'></span></a>";
//                    echo "</td>";
//                    echo "</tr>";
//
//                }
    
        ?>
        
                
                </tbody>
                    </table>
                        
                <br>
                <br>
                
                
                <a class="btn btn-Regresar"  href="F_A_Registrar_Entrada_Inventario.php">
                       &larr; Inventario
                    </a>
                <br>
                <br>
           </div>
        </form>        
                
    </body>
</html>
