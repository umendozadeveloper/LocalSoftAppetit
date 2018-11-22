<?php

include_once 'Header.php';
?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <form action="" method="POST" id="form">
    <table class="table-hover">
            <tr>                                             
                <td><div class="etiquetas2">Asunto</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtAsunto'  name='txtAsunto'  title='Ingresar Datos' class='form-control' value=''></div></td>            
            </tr>
            
            
            <tr>                                             
                <td><div class="etiquetas2">Cuerpo del correo</div></td>
                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'>
                        <textarea class="form-control claseTextArea" name="txtCuerpo" id="txtCuerpo" rows="12">
                        </textarea>
                        </div></td>            
            </tr>
            
            <tr>
                <td><div class="etiquetas2">Seleccionar clientes</div></td>
                        <td><div class="etiquetas2">
                                <select class="form-control" name="txtClientes" id="txtClientes">
                                    <option value="PVino">Con preferencia de vinos</option>
                                    <option value="PAlimentos">Con preferencia de alimentos</option>
                                    <option value="PCursos">Con preferencia de cursos</option>
                                    <option value="PEventos">Con preferencia de eventos</option>
                                    <option value="Todos">Todos</option>
                                </select>
                    </div></td>
            </tr>
    </table>
        </form>
        <br>
    <br>
    
    <button type="button" class="btn btn-Bixa" onclick="Enviar();" style="float: right;">Enviar</button>
        
    
    <br>
    <br>
</div>

<script>
    
    function Enviar(){
        
        swal({   
                title: "", 
                text: "¿Desea envíar el correo?", 
                type: "info",  
                showCancelButton: true,
                closeOnConfirm: false, 
                showLoaderOnConfirm: true,
            },
            function(isConfirm){ 
                if (isConfirm) {
//                    swal('Por favor espere, el envío de correos puede tardar varios segundos. El sistema le notificará cuando termine');
                    
                    var preferencia_tipo = document.getElementById("txtClientes").value;
                    var asunto = document.getElementById("txtAsunto").value;
                    var cuerpo_correo = document.getElementById("txtCuerpo").value;
                        $.ajax({
                           url: "Validaciones_Lado_Servidor/N_EnviarCorreos.php",
                           type: 'POST',
                           data:{
                                    "tipo":preferencia_tipo,
                                    "asunto":asunto,
                                    "cuerpo_correo": cuerpo_correo
                                },
                          success: function (data) {
                                     var exito = data.split("--||");
                           if(exito[1]==1){
                               swal('Correcto','Correo enviado correctamente','success');
                                document.getElementById("form").reset();
                           }
                           else{
                               swal('Error','No se envió el correo','error');
                           }
                                    console.log(data);
                       }
                        });   
                }
            });
//           
    }

    
    
    
</script>