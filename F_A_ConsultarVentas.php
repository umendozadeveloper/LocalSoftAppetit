<?php
    require 'Header.php';
    include_once  './Clases/Ventas.php';
    require_once './Clases/ConexionBD.php';
    include_once './Clases/ClientesFacturas.php';
    include_once './Clases/Usuario.php';

?>
<title>Consultar Ventas</title>

<form>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
    <table class="encabezadoTabla">
        <tr><td class="tdEncabezadoTabla">
            <div><h4><center><label class="textoEncabezadoTabla">Listado de ventas</label></center></h4></div>
        </td></tr>
    </table>
                
                
                
    <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
        <thead style="margin-bottom: 10px;">
            <tr>
                <th><div class="centrar"><label>Fecha</label></div></th>
                <th><div class="centrar"><label>Comanda</div></label></th>
                <th><div class="centrar"><label>Total</div></label></th>
                <th><div class="centrar"><label>Administrador</div></label></th>
                <th><div class="centrar"><label>Mesero</div></label></th>
                <th><div class="centrar"><label>Estatus</div></label></th>
                <th><div class="centrar"><label>Facturado</div></label></th>
                <th width="12%"><div class="centrar"><label>Opciones</div></label></th>


            </tr>
        </thead>
        <tbody>          
        <?php 
            $con = Conexion();
            $query = "Select V.ID as IDVenta, V.Fecha, C.Folio, M.Nombre, M.Apellidos, V.Status, V.Facturada, 
                    V.IdUsuario , V.Descuento, V.Propina
                    from Ventas V join Comanda C on V.IdComanda = C.Id
                    join Meseros M on C.IdMesero = M.ID";
            $ventas = array();
            $totalVentas = array();
            $objVentas = new Ventas();
            $totalVentas = $objVentas->ObtenerTotalPorCadaVenta();
            $valor = sqlsrv_query($con, $query);
            $contador = 0;
//            $objCliente = new ClientesFacturas();
            $objUsuario = new Usuario();

            while($Datos = sqlsrv_fetch_array($valor)){
                echo "<tr>";
                echo "<td>".  date_format($Datos['Fecha'],'d-m-Y')."</td>";
                echo "<td>".$Datos['Folio']."</td>";
                echo "<td>$".number_format(($totalVentas[$contador]-$Datos['Descuento']+$Datos['Propina']),2,'.','')."</td>";
//                echo "<td></td>";
                $objUsuario->ConsultarPorID($Datos['IdUsuario']);
                echo "<td>".  $objUsuario->Nombre . ' '. $objUsuario->Apellidos."</td>";
                echo "<td>".  utf8_encode($Datos['Nombre'])." ". utf8_encode($Datos['Apellidos']). "</td>";
               
                
                echo "<td>".$Datos['Status']."</td>";
                $facturada="No";
                if($Datos['Facturada']==1)
                    $facturada = "Sí";
                echo "<td>".$facturada."</td>";
                echo "<td>";
                echo "<button class='btn btn-Bixa' type='button' onclick='cancelarVenta($Datos[IDVenta]);'  value='$Datos[IDVenta]' name='btnVenta' data-placement='left' data-toggle='tooltip' title='Cancelar venta'><span class='glyphicon glyphicon-remove'></span></button>";
                echo "<a href='F_A_DetalleVenta.php?IdVenta=$Datos[IDVenta]' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver venta a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                echo "</td></tr>";
                $contador++;
            }
            sqlsrv_close($con);            
        
        ?>
        </tbody>
    </table>
    <br>
                
                
                
    <a class="btn btn-Regresar" href="F_A_PaginaPrincipal.php">
          &larr; Menú Principal
    </a>
    <br>
    <br>
    <br>
    </div>
          
</form>
<form method="POST" action="./Validaciones_Lado_Servidor/N_VentaCancelada.php" id="formDelete" >
    <input type="text" id="txtID" name="txtID" class="ocultar">
</form>
    </body>
    
    <script>
        function cancelarVenta(ID){
            $("#txtID").val(ID);
            swal({  
                title: "¿Desea cancelar la venta?",
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
                    window.location('F_A_ConsultarVentas.php');
                }
            });
        }
        
        
    </script>
</html>
