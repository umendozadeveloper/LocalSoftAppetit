<?php
include_once 'Header.php';
include_once './Clases/Cliente.php';
include_once './Clases/EstadoClientes.php';
$objCliente = new Cliente();
$clientes = $objCliente->ConsultarTodos();
$objEstadoClientes = new EstadoClientes();
?>

<title>Listado de clientes</title>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div id="pintarTabla">
        <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de clientes</label></center></h4></div>
            </td>
        </table>
    
    <table id="tablaClientes"  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th><div class="centrar"><label>Nombre</label></div></th>
                <th><div class="centrar"><label>Apellidos</label></div></th>
                <th><div class="centrar"><label>Teléfono</label></div></th>
                <th><div class="centrar"><label>E-mail</label></div></th>
                <th><div class="centrar"><label>Folio registro</label></div></th>
                <th><div class="centrar"><label>Status</label></div></th>
                <th><div class="centrar"><label>Interés por vinos</label></div></th>
                <th><div class="centrar"><label>Interés por alimentos</label></div></th>   
                <th><div class="centrar"><label>Interés por eventos</label></div></th>
                <th><div class="centrar "><label>Interés por cursos</label></div></th>   
                <th><div class="centrar "><label>Opciones</label></div></th>   
            </tr>
        </thead>
        
        <tbody>
            <?php 
            foreach($clientes as $c){
                $objEstadoClientes->ConsultarPorID($c->Status);
                echo "<tr>";
                echo "<td>$c->Nombre</td>";
                echo "<td>$c->Apellidos</td>";
                echo "<td>$c->Telefono</td>";
                echo "<td>$c->Correo</td>";
                echo "<td>$c->FolioRegistro</td>";
                echo "<td>";
                if($c->Status == 3 || $c->Status==2)
                {
                    if($c->Status == 2){
                        echo "<center><span style='color:green;' data-toggle='tooltip' data-placement='left' title='Usuario activo' class='glyphicon glyphicon-ok'></span><span data-toggle='tooltip' data-placement='left' title='Usuario activo' class='glyphicon glyphicon-user'></span></center>";
                    }
                    else{
                        echo "<center><span style='color:red;' data-toggle='tooltip' data-placement='left' title='Usuario inactivo' class='glyphicon glyphicon-remove'></span><span data-toggle='tooltip' data-placement='left' title='Usuario inactivo' class='glyphicon glyphicon-user'></span></center>";
                    }
                }
                else{
                    echo $objEstadoClientes->Estado;
                }
                echo "</td>";
                
                echo "<td>";
                if($c->PVino){
                    echo "<center><span class='glyphicon glyphicon-ok'></span></center>";
                }
                echo "</td>";
                
                echo "<td>";
                if($c->PAlimentos)
                {
                    echo "<center><span class='glyphicon glyphicon-ok'></span></center>";
                }
                echo "</td>";
                echo "<td>";
                if($c->PEventos){
                    echo "<center><span class='glyphicon glyphicon-ok'></span></center>";
                }
                echo "</td>";
                echo "<td>";
                if($c->PCursos)
                {
                    echo "<center><span class='glyphicon glyphicon-ok'></span></center>";
                }
                echo "</td>";
                
                echo "<td><center>";
                
                
                
                switch ($c->Status){
                    
                    case 0:
                        echo "<button class='btn btn-Bixa' onclick='ActualizarRegistro($c->ID,1);' name='btnRechazar'><span class='glyphicon glyphicon-message'></span> Enviar Correo</button>";
                        break;
                    
                    case 1:
                    case 2:
                    case 3:
                    if($c->Status == 2)
                    {
                        echo "<button class='btn btn-Bixa' disabled onclick='ActualizarRegistro($c->ID,2);'><span class='glyphicon glyphicon-ok'></span></button>";
                        echo "<button class='btn btn-Bixa' onclick='ActualizarRegistro($c->ID,3);' name='btnRechazar'><span class='glyphicon glyphicon-remove'></span></button>";
                    }
                    else if($c->Status==3){
                        echo "<button class='btn btn-Bixa' onclick='ActualizarRegistro($c->ID,2);'><span class='glyphicon glyphicon-ok'></span></button>";
                        echo "<button class='btn btn-Bixa' disabled onclick='ActualizarRegistro($c->ID,3);' name='btnRechazar'><span class='glyphicon glyphicon-remove'></span></button>";
                    }
                    else{
                        echo "<button class='btn btn-Bixa' title='Activar cliente VIP' onclick='ActualizarRegistro($c->ID,2);'><span class='glyphicon glyphicon-ok'></span></button>";
                        echo "<button class='btn btn-Bixa' title='Desactivar cliente VIP' onclick='ActualizarRegistro($c->ID,3);' name='btnRechazar'><span class='glyphicon glyphicon-remove'></span></button>";
                    }
                    
                    break;
                    
                }
                
                /*
                if($c->Status == 2 || $c->Status == 3){
                    echo "<button onclick='ActualizarRegistro($c->ID,2);'><span class='glyphicon glyphicon-ok'></span></button>";
                    echo "<button onclick='ActualizarRegistro($c->ID,3);' name='btnRechazar'><span class='glyphicon glyphicon-remove'></span></button>";
                }*/
                
                echo "</center></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        
    </table>    
        </div>
</div>

<script>
    function ActualizarRegistro(ID,Proceso){
        if(Proceso==1){
            
            
            swal({   
                title: "", 
                text: "¿Desea envíar el correo de bienvenida al cliente? Cuando se realizó el registro no se envío porque falló la conexión a internet", 
                type: "info",  
                showCancelButton: true,
                closeOnConfirm: false, 
                showLoaderOnConfirm: true,
            },
            function(){   
                
            $.ajax({
              url: "Validaciones_Lado_Servidor/N_OpcionesCliente.php",
              type: 'POST',
              data: {"ID":ID,"Proceso":Proceso},
              success: function (data) {
                  var resultado = data.split("|*");
                  var tabla = resultado[1];
                  $("#pintarTabla").html(tabla);
                  
                  if(resultado[0]==1){
                      
                        swal('Correcto','Se ha reenviado el correo','success');  
                    }
                    else{
                        swal('Error','No se reenvió el correo, verifique la conexión a internet','error');  
                    }
              }
                });
               /* setTimeout(function()
                {   
                    swal("Ajax request finished!");  
                }, 2000);*/
            });
            /*swal({  title: "¿Desea continuar con la acción?",   
                    text: "Se reenviará un correo al usuario con el folio del sistema",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonText: "Si",   
                    showLoaderOnConfirm:true,
                    cancelButtonText: "No",   
                    closeOnConfirm: true}, 
                    function(){   
            $.ajax({
              url: "Validaciones_Lado_Servidor/N_OpcionesCliente.php",
              type: 'POST',
              data: {"ID":ID,"Proceso":Proceso},
              success: function (data) {
                  $("#pintarTabla").html(data);
              }
                });
                            });*/
        }
        else{
            $.ajax({
                  url: "Validaciones_Lado_Servidor/N_OpcionesCliente.php",
                  type: 'POST',
                  data: {"ID":ID,"Proceso":Proceso},
                  success: function (data) {
                      $("#pintarTabla").html(data);
                  }
                });
        }
    }
</script>
