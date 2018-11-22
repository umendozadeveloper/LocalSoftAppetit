<?php
    require 'Header.php';
    include_once  './Clases/Facturas.php';
    require_once './Clases/ConexionBD.php';
    include_once './Clases/ClientesFacturas.php';
    include_once './Clases/Usuario.php';
    include_once './Clases/StatusFacturas.php';
    include_once './Clases/TipoFactura.php';

?>
<title>Consultar Facturas</title>

<form>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
    <table class="encabezadoTabla">
        <tr><td class="tdEncabezadoTabla">
            <div><h4><center><label class="textoEncabezadoTabla">Listado de facturas</label></center></h4></div>
        </td></tr>
        
    </table>
    <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%" style="text-align: center;">
        <thead style="margin-bottom: 10px;">
            <tr>
                <th><div class="centrar"><label>Folio</label></div></th>
                <th><div class="centrar"><label>Fecha</div></label></th>
                <th><div class="centrar"><label>Realizó</div></label></th>
                <th><div class="centrar"><label>Cliente</div></label></th>
                <th><div class="centrar"><label>Estatus</div></label></th>
                <th><div class="centrar"><label>Tipo de factura</label></div></th>
                <th style="width: 12%"><div class="centrar"><label>Archivos</label></div></th>
                <th><div class="centrar"><label>Opciones</div></label></th>
    


            </tr>
        </thead>
        <tbody style="text-align: center">          
        <?php 
            $objFacturas = new Facturas();
            $objTipoFactura = new TipoFactura();
            $objUsuario = new Usuario();
            $objCliente =  new ClientesFacturas();
            $objStatus = new StatusFacturas();
            $Facturas = array();
            $Facturas = $objFacturas->ObtenerTodas();
            foreach ($Facturas as $f)
            {
                $objTipoFactura->ObtenerPorId($f->IdTipoFactura);
                $f->Fecha = $f->Fecha->format('Y-m-d');
                $objCliente->obtenerPorID($f->IdCliente);
                $objUsuario->ConsultarPorID($f->IdUsuario);
                $objStatus->ObtenerPorId($f->IdStatus);
                echo "<tr>";
                echo "<td>$f->Folio</td>";
                echo "<td>$f->Fecha</td>";
                echo "<td>$objUsuario->Nombre $objUsuario->Apellidos</td>";
                echo "<td>$objCliente->NombreCliente</td>";
                $color= "";
                switch ($objStatus->Nombre){
                    case 'Guardada':
                        $color= '#FCFF2E';
                        break;
                    case 'Facturada':
                        $color='#00FF00';
                        break;
                    case 'Cancelada':
                        $color='#FF0000';
                        break;
                }
                echo "<td><span class='glyphicon glyphicon-stop' style='color:$color;'></span>$objStatus->Nombre</td>";
                echo "<td>$objTipoFactura->Nombre</td><td>";
                if($f->IdStatus == 2)
                {   
                    echo "<a target='_blank' href='$f->RutaPDF'><img src='Iconos/pdf.png' width='30%' /></a>";
                    echo "<a target='_blank' href='$f->RutaXML'><img src='Iconos/xml.png' width='30%'/></a></td>";
                    echo "<td>"
                    . "<a href='F_A_DetalleFactura.php?IdFactura=$f->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver factura a detalle'><span class='glyphicon glyphicon-search'></span></a>"
                            . "<button class='btn btn-Bixa' type='button' onclick='CancelarFactura($f->ID);'  value='$f->ID' name='btnFactura' data-placement='left' data-toggle='tooltip' title='Cancelar factura'><span class='glyphicon glyphicon-remove'></span></button>";
                        
                }
                if($f->IdStatus == 1)
                {
                   echo "</td><td>"
                    . "<a href='F_A_DetalleFactura.php?IdFactura=$f->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver factura a detalle'><span class='glyphicon glyphicon-search'></span></a>"
                           
                           . "<a href='F_A_EditarFacturas.php?IdFactura=$f->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Editar factura'><span class='glyphicon glyphicon-edit'></span></a>"
                           . "<button type='button' onClick='Eliminar($f->ID);' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Eliminar factura'><span class='glyphicon glyphicon-trash'></span></button>";
                }
                if($f->IdStatus == 3)
                {
//                    echo "</td><td><a href='F_A_DetalleFactura.php?IdFactura=$f->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver factura a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    echo "<a target='_blank' href='$f->RutaPDF'><img src='Iconos/pdf.png' width='30%' /></a>";    
                    echo "</td><td>";
                    
                }
                echo "</td></tr>";
            }
        
        ?>
        </tbody>
    </table>
    <br>
                
    <script>
    
        
function Eliminar(ID)
{
    var IdFactura = ID;
    swal({
  title: "¿Desea eliminar la factura?",
  text: "Los tickets de la factura estarán disponibles para facturar",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
},
function(){
    swal({
  title: "Espere",
  text: "Eliminando factura...",
  showConfirmButton: false
});
  setTimeout(function(){
    $.ajax({
            url: "./Validaciones_Lado_Servidor/N_EliminarFactura.php",
            type: "POST",
            data: {"IdFactura": IdFactura},
            success: function () {
                swal("Correcto!", "La factura fue eliminada!", "success");
                swal({
  title: "Correcto!",
  text: "La factura fue eliminada!",
  type: "success",
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Ok"
},
function(){
  location.reload();
});
                
            }
        });
  }, 2000);
  
});

}


 function CancelarFactura(ID){
       
       var IdFactura = ID;
        swal({  
            title: "¿Desea cancelar la factura?",
            text: "La información será enviada al SAT.", 
            type: "warning",  
            showCancelButton: true, 
            confirmButtonText: "Sí",   
            cancelButtonText: "No", 
            closeOnConfirm: false, 
            closeOnCancel: true
        },
        function(isConfirm){ 
            if (isConfirm) {
                swal({
                    title: "Espere",
                    text: "La factura se está cancelando...",
                    showConfirmButton: false
                  });
                $.ajax({
                    url: "./Validaciones_Lado_Servidor/N_CancelarFactura.php",
                    type: "POST",
                    data: {"IdFactura": IdFactura},
                   success: function (data) {
                        
                       if(data == 204)
                       {
                           swal("¡Error!","UUID No aplicable para cancelación (Comprobante sin acuse)","error");
                       }else if(data == 202){
                           swal("¡Error!","UUID Previamente cancelado","error");
                       }else if(data == 203){
                           swal("¡Error!", "UUID No corresponde al emisor", "error");
                       }else if(data == 205)
                       {
                           swal("¡Error!", "UUID No existe", "error");
                       }else if(data == 0)
                       {
                           swal("¡Correcto!", "La factura ha sido cancelada", "success");
                       }
                    

                        
                                             
                    }
                });
            }
        });
        
    }

    
    </script>            
                
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
                }
            });
        }
        
        
    </script>
</html>


