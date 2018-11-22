<?php 
require 'Header.php';
?>

<div class="col-lg-offset-1 col-lg-10">
					<form id="formChat" role="form">
						
                                            <div class="form-group">
							
                                                <?php if(isset($_GET['idComanda'])) {
                                                    //$visto = true; $comanda =$_GET['idComanda'];?>
                                                <input type="text" class="form-control ocultar" id="txtComanda" name="txtComanda" placeholder="Enter User" value="<?php echo $_GET['idComanda']?>">
                                                <input type="text" class="form-control ocultar" id="txtVisto" name="txtVisto" placeholder="Enter User" value="1">
                                                <?php } else {
                                                    
                                                    ?>
                                                <input type="text" class="form-control ocultar" id="txtComanda" name="txtComanda" placeholder="Enter User" value="<?php echo $seguridad->CurrentUserID();?>">
                                                <input type="text" class="form-control ocultar" id="txtVisto" name="txtVisto" placeholder="Enter User" value="0">
                                                <?php 
                                                } ?>
                                                        <input type="text" class="form-control ocultar" id="user" name="user" placeholder="Enter User" value="<?php 
                                                        if($seguridad->CurrentUserPerfil()==3)
                                                        echo "Cliente";
                                                        else
                                                            echo "Mesero";?>">
						</div>
                                            
						<div class="form-group">							
							<div class="row">
								<div class="col-md-12" >
									<div id="conversation" style="height:200px; border: 1px solid #CCCCCC; padding: 12px;  border-radius: 5px; overflow-x: hidden;">
										
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">				
							<label for="message">Mensaje</label>
							<textarea id="message" name="message" placeholder="Ingresar mensaje"  class="form-control" rows="3"></textarea>
						</div>
						<button id="send" class="btn btn-Bixa" >Enviar</button>						
                                                <?php if(isset($_GET['idComanda'])) {
                                                echo "<button id='btnVisto' type='button' class='btn btn-default' style='float:right;'>Marcar mensajes como vistos</button>";
    }?>
					</form>
    
    
		</div>

<script>
		
			$(document).on("ready", function(){	
                            
                            $("#btnVisto").click(function (){
                               marcarVisto(); 
                                swal({
                            title: "",
                            text: "Mensajes marcados como vistos",
                            imageUrl: 'img/visto.png'
                            });
                            });
                            var visto = $("#txtVisto").val();
                            
                            
                            if(visto==1)
                            {
                                marcarVisto();
                                
                            }
				registerMessages();
                                loadOldMessages();
                                setInterval("comprobarNuevoMensaje()",500);    
			});
                        
                        var comanda = $("#txtComanda").val();
                        var marcarVisto = function (){
                            $.ajax({
                                    type:"POST",
                                    url: "Validaciones_Lado_Servidor/Chat_visto.php",
                                    data:{"comandaV":comanda}
                                });
                            
                        }
                        
                        var bandera = false;
                        var id;
                        var otraB=true;
                        /*var idMensaje = id;*/
                        var registerMessages = function(){
                            $("#send").on("click",function(e){
                                e.preventDefault();
                                var frm = $("#formChat").serialize();
                                $.ajax({
                                    type:"POST",
                                    url: "Validaciones_Lado_Servidor/Chat_register.php",
                                    data:frm
                                }).done(function(info){
                                    $("#message").val("");
                                    console.log(info);
                           
                                   idMensaje++;
                                   /*alert("Id de la consulta: "+((parseInt(id)+1)));
                                   alert("Id de la página ?: "+idMensaje); */
                                   
                             comprobarNuevoMensaje();
                                    idMensaje--;
                                });
                                });
                        }
                        
                        var comprobarNuevoMensaje = function (){
                            $.ajax({
                               type:"POST",
                               url:"Validaciones_Lado_Servidor/Chat_mensajeNuevo.php",
                               data:{"Id_Comanda":comanda}
                            }).done(function (info){
                                   id = info;
                                   if(bandera===false)
                                   {
                                       idMensaje = id;
                                       loadOldMessages();
                                   }
                                   
                                   bandera=true;
                                   
                                   if(idMensaje<id){
                                   /*alert("Id de la consulta: "+id);
                                   alert("Id de la página: "+idMensaje); */
                                        
                                       loadOldMessages();
                                       idMensaje = id;
                                   }
                               
                               
                                   
                               });
                           }
                
            
                           
                           
                           
                        
                        
                        
                        var loadOldMessages = function (){
                        
                        var idComanda = $("#txtComanda").val();
                            $.ajax({
                               type:"POST",
                               data: {"idComanda":idComanda},
                               url:"Validaciones_Lado_Servidor/Chat_conversation.php"
                            }).done(function (info){
                           $("#conversation").html(info);
                           $("#conversation p:last-child").css({"background-color": "#EEEEEE"});
                           var altura = $("#conversation").prop("scrollHeight");
                           $("#conversation").scrollTop(altura);
                        });
                        }
			
		</script>
                
                <style>
                    .hola{
                        background-color: #EEEEEE;
                    }
                </style>
</body>
</html>