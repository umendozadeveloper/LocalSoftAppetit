        <nav class="navbar navbar-inverse" role="navigation" style="margin-top: -9px;">
			<div class="container-fluit">
				
				<div class="navbar-header">
                                    
                                    
					<button class="navbar-toggle" data-toggle="collapse" data-target="#MenuAColapsar">
						<span class="sr-only">Toggle Navigation</span>
                                                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                                                <div id='navMesero' style="display: none">
                                                <a class="ocultar" style="position: relative;" id="msgPendiente"><img src="img/Chat.png"></a>
                                                
                                                
                                                </div>
                                                
					</button>
                                    
                                    
				</div>
                            

				<div class="collapse navbar-collapse" id="MenuAColapsar">
					<ul class="nav navbar-nav">

                                                <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comandas <span class="caret"></span></a>
							<ul class="dropdown-menu">
                                                            
                                                                <li><a href="F_M_ConsultarComandas.php">Consultar</a></li>
                                                                <li><a href="F_M_RegistrarComanda.php">Agregar</a></li>   
                                                                
							</ul>            
						</li>
                                                
                                                
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><label id="lbPresencia">Solicitan presencia<span class="caret"></label></span></a>
                                                        <ul class="dropdown-menu" id="divPresencia">                                                                
							</ul>            
						</li>
                                                
                                                
                                                <li class="dropdown" >
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><label id="lbCuenta">Solicitan cuenta<span class="caret"></label></span></a>
                                                        <ul class="dropdown-menu" id="divCuenta">                                                                
							</ul>            
						</li>
                                                
                                                
                                    
                                                <li><a href="cerrarSesionMesero.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                                                
                                                
                                    

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




<?php
$nombreScript = basename($_SERVER['PHP_SELF']);

if(isset($_SESSION['valPresencia']) && !empty($_SESSION['valPresencia'])){
    $_SESSION['valPresencia']=null;
}

?>


<!-- Se utiliza para saber que script invocó al archivo así se sabe en que script retorna la app-->
<input type="text" id="txtScript" class="ocultar" value="<?php echo $nombreScript;?>">
<script>
    
        $(document).ready(function (){
       
       
            
        consultaCuentaJs();
        ConsultaPresencia();
        NumeroNotificaciones();
        setInterval("NumeroNotificaciones()",2000);
        setInterval("consultaCuentaJs()",3000);
        setInterval("ConsultaPresencia()",3000);
       
        });
        
        
    var consultaCuentaJs = function (){
        
        
            $.ajax({
                                    url: "Validaciones_Lado_Servidor/N_MostrarCuenta.php"
                                    }).done(function (info){
                                        var resultadoCuenta = info.split("||");
                                        var cantidadCuenta = resultadoCuenta[1];
                                        if(cantidadCuenta>0)
                                        {
                                            $("#lbCuenta").removeClass("ocultar");
                                            $("#lbCuenta").addClass("mostrar");
                                            $("#divCuenta").html(resultadoCuenta[0]);
                                        }
                                        else{
                                            $("#lbCuenta").removeClass("mostrar");
                                            $("#lbCuenta").addClass("ocultar");
                                            
                                            
                                        }
                                        
                                        
            });
    }
    
    
    var ConsultaPresencia= function (){
        
        var NombreScript = $("#txtScript").val();
        $.ajax({
                                    
                                    url: "Validaciones_Lado_Servidor/N_SolicitarPresencia.php",
                                    type:"POST",
                                    data: {"txtScript":NombreScript}
                                    }).done(function (info){
                                        
                                        var resultadoPresencia = info.split("||");
                                        var pintarPresencia = resultadoPresencia[0];
                                        var CantidadPresencia = resultadoPresencia[1];
                                        if(CantidadPresencia>0){
                                            $("#lbPresencia").removeClass("ocultar");
                                            $("#lbPresencia").addClass("mostrar");
                                            $("#divPresencia").html(pintarPresencia);
                                        }
                                        else{
                                            $("#lbPresencia").removeClass("mosstrar");
                                            $("#lbPresencia").addClass("ocultar");
                                        }
                                    });
    }
    
    var NumeroNotificaciones = function (){
        
            $.ajax({
                                    url: "Validaciones_Lado_Servidor/N_CantidadNotificaciones.php"
                                    }).done(function (info){
                                        
                                        var cantidad = info.split("|");
                                        var uno = cantidad[0];
                                        $("#navMesero").html("<span class='icon-bar' style='background-color: transparent;'></span>\n\
                                        <span class='icon-bar' style='background-color: transparent;'><label  style='font-size:20px; position:relative; top:-10px; color:white;'>"+uno+"</label>\n\
                                        </span><span class='icon-bar' style='background-color: transparent;'>\n\
                                        </span><span class='icon-bar' style='background-color: transparent;'></span>");
                                    
                                    var mensaje = cantidad[1];
                                    if(mensaje==="1"){
                                        /*Aqui pondré el logo del mensaje
                                         * 
                                         * 
                                         */
                                         $("#msgPendiente").removeClass("ocultar");
                                         $("#msgPendiente").addClass("mostrar");
                                         
                                                                
                                    }
                                    else{
                                         $("#msgPendiente").removeClass("mostrar");
                                         $("#msgPendiente").addClass("ocultar");
                                    }
                                    });
           }

    
</script>