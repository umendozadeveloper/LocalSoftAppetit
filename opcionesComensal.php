        <nav class="navbar navbar-inverse" role="navigation" style=" margin-top: -9px; margin-bottom: 5px;">
			<div class="container-fluit">
				
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target="#MenuAColapsar">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
                                    
                                    <a class="navbar-brand topnav"  style=""><?php if($seguridad->EsVIP()) echo "Cliente VIP";?></a>
				</div>

				<div class="collapse navbar-collapse" id="MenuAColapsar">
					<ul class="nav navbar-nav">
                                                
						<li><a href="<?php echo "VentanaModalParaMenuBixa.php?idComanda=".$seguridad->CurrentUserID();?>"><span class="glyphicon glyphicon-home"></span> Menú Bixa</a></li>
						<li><a href="<?php echo "F_C_Comanda_A_Detalle_Comensal.php?idComanda=".$seguridad->CurrentUserID();?>"><span class=""></span> Ver estado de comanda</a></li>
                                                
                                                <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Contactar al mesero <span class="caret"></span></a>
							<ul class="dropdown-menu">
                                                                <li><a id="solicitarCuenta" style="cursor: pointer;">Solicitar cuenta</a></li>
                                                                <li><a href="F_Chat.php">Enviar mensaje</a></li>
                                                                <li><a id="asolicitarPresencia" style="cursor: pointer;">Solicitar presencia del mesero</a></li>
                                                                <li><a href="F_C_ConsultaMesero.php">Datos del mesero</a></li>
							</ul>
						</li>
                                                
                                                
                                                <?php if(!$seguridad->EsVIP())
                                                    {
                                                        include_once 'Clases/Configuracion.php';
                                                        $objConfig = new Configuracion();
                                                        $objConfig->Consultar();
                                                        if($objConfig->ClientesVIP==1){
                                                            
                                                    ?>
                                                <li><a href="#" data-toggle='modal' data-target='#VMClienteVIP'><span class=""></span> Iniciar como cliente VIP</a></li>
                                                <?php } 
                                                    }?>
                                                <li><a href="F_C_Bienvenida.php"><span class=""></span> Ver página inicial</a></li>
                                                <li><a href="<?php echo "F_C_CerrarComanda.php";?>"<span class=""></span> Cerrar comanda</a></li>
					</ul>

					<div>
					<!--	
                                            <form action="./" class="navbar-form navbar-left">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Buscar">
								<button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
							</div>
						</form>
     -->
					</div>

				</div>

			</div>
		</nav>


<div class="modal fade"   id="VMClienteVIP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
				<div class="modal-dialog" >
                                    <div class="modal-content" >
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Ingresar como cliente VIP</h4>
						</div>

                                                <form method="POST" action="Validaciones_Lado_Servidor/N_LoginVIP.php">
						<div class="modal-body">
                                                    <div id="div-login-msg">
                                                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                                        <span id="text-login-msg">Ingresar cuenta de E-mail</span>
                                                    </div>
                                                    
                                                    <div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input id="txtCorreo" autocomplete="off" class="form-control" type="text" placeholder="Cuenta de E-mail" name="txtCorreo" ></div>
                                                </div>

						<div class="modal-footer">
							<button class="btn btn-Bixa" >Iniciar</button>
						</div>
                                                </form>
                                                

					</div>
				</div>
			</div>

<?php 
$script = basename($_SERVER['PHP_SELF']);
$nombreScript = basename($_SERVER['REQUEST_URI']);
$_SESSION['ScriptActual']=$nombreScript;
//echo $nombreScript;
//echo $script;
if(isset($_SESSION['comensalPresencia']) && !empty($_SESSION['comensalPresencia']))
{
    echo "<script>swal('En un momento el mesero llegará a atenderle');</script>";
    $_SESSION['comensalPresencia'] = NULL;
}
?>
<input type="txtNombreScript" class="ocultar" id='txtNombreScript' value="<?php echo $script;?>">

<script>
    $(document).ready(function (){
        
        var NombreScript = $("#txtNombreScript").val();
        
        /*setInterval("cargarMensajes()",1000);*/
        
        
       $("#solicitarCuenta").click(function(){
          swal({   
		title: '¿Seguro que desea solicitar la cuenta?',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonColor: '#AA1927',   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: true },
            

		function(isConfirm){   
			if (isConfirm) {
                    
                    window.location= 'Validaciones_Lado_Servidor/N_SolicitarCuenta.php';
                            
                                        
			}
		});
          
       });
       
       
              $("#asolicitarPresencia").click(function(){
                  
          swal({   
		title: '¿Seguro que desea solicitar la presencia del mesero?',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonColor: '#AA1927',   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: true },
            

		function(isConfirm){   
			if (isConfirm) {
                    
                    window.location= 'Validaciones_Lado_Servidor/N_InsertarSolicitarPresencia.php?txtScript='+NombreScript;
                            
                                        
			} 
		});
          
       });
       
    });
    
    
    
    </script>
    
    
    