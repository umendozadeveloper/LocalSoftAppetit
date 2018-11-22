
        <?php
        
        require 'Header.php';
        require_once './Clases/ZonaUbicacion.php';
        ?>
        
        
        <title>Consultar Comandas</title>
        
    
        
        
        
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        
                        <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Listado de comandas del día y activas</label></center></h4></div>
                            </td>
                        </table>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <form action="F_M_Comanda_A_Detalle.php" method="GET">
                    <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
        <tr>
            <th><div class="centrar"><label>Folio</label></div></th>
                    <th><div class="centrar"><label>Fecha</label></div></th>
            <th><div class="centrar"><label>No. de mesa</label></div></th>
            <th><div class="centrar"><label>Ubicación</label></div></th>
            <th><div class="centrar"><label>Importe</label></div></th>
            <th><div class="centrar"><label>Estado</label></div></th>
                    <th><div class="centrar"><label>Mensaje<br>pendiente</label></div></th>
    <th><div class="centrar"><label>Conversación</label></div></th>
    <th><div class="centrar"><label>Agregar productos</label></div></th>
        </tr>
    </thead>
    <tbody>
        

        
        <?php
        include_once './Clases/Comanda.php';
        include_once './Clases/VistaComanda_Mesa_ComMesas.php';
        include_once './Clases/ComandaMensajes.php';
        $objVista = new VistaComanda_Mesa_ComMesas();
        $comandasDia = $objVista->ConsultarComandasDelDia($seguridad->CurrentUserID());
        $objComanda = new Comanda();
        $objComandaMensajes = new ComandaMensajes();
        $arregloComandas = array();
        foreach($comandasDia as $c){
            echo "<tr>";
            echo "<td width='15%'><button class='noboton' value='$c->IdComanda' name='idComanda'><img src='img/Detalle.ico'></button><button value='$c->IdComanda' name='idComanda' type='submit' class='noboton'>$c->Folio</button></td>";
            echo "<td>$c->Fecha</td>";
            echo "<td>$c->NumeroMesa</td>";
            
            $objZonaUbicacion = new ZonaUbicacion();
            $objZonaUbicacion->ConsultarPorID($c->Ubicacion);
            
            echo "<td>$objZonaUbicacion->Descripcion</td>";
            echo "<td>$".$objComanda->ConsultarImporteComanda($c->IdComanda)."</td>";
            echo "<td>$c->ClaveEstadoComanda</td>";
            array_push($arregloComandas, $c->IdComanda);
            //$comMensaje = $objComandaMensajes->ConsultarPorID($c->IdComanda);
            
            echo "<td><a href='F_Chat.php?idComanda=$c->IdComanda'><div class='ocultar' id='co$c->IdComanda' ><img src='img/advice.png'></div></a></td>";
            echo "<td><a href='F_Chat.php?idComanda=$c->IdComanda'><div id='co$c->IdComanda' ><img src='img/Chat.png'></div></a></td>";
            echo "<td width='7%' align='center'><a href='VentanaModalParaMenuBixa.php?idComanda=$c->IdComanda' class='btn btn-Bixa'><span class='glyphicon glyphicon-plus-sign'></span></td>";
			
			
			/*if($objComanda->Clave=="Abierta"){
        
            
            <form action="VentanaModalParaMenuBixa.php" method="GET">
				<input type='text'  name='txtNUMCOMANDA' class='ocultar'>
				
				if($seguridad->CurrentUserPerfil()!=1){ 
					<button  class="btn btn-default btn-ms btn-Bixa"  style="float: right" name="idComanda" value="<?php echo $idComanda;?>" role="button" >
						Agregar más productos
					</button>
				}
            
            }*/
            
            
         /*   if($seguridad->CurrentUserPerfil()!=1){ 
				<a class="btn btn-Regresar" href="F_M_ConsultarComandas.php">
                        Consultar comandas
                </a>
            } else{
				<a class="btn btn-Regresar" href="F_A_ConsultarComandas.php">
                        Consultar comandas
                </a>
            } */
			
           
            echo "</tr>";
        }
        ?>
        
    
    </tbody>
        </table>
            

                <br>
                <br>
                <br>
                </form>        
            <a class="btn btn-Bixa" href="F_M_RegistrarComanda.php">Agregar</a>
</div>
        
        
        
        
    </body>
    
    <script>
        $(document).ready(function (){
            
            cargarMensajes();
                        
                        setInterval("cargarMensajes()",1000);
                        
                 
           
           
        });
        
               var cargarMensajes= function (){            
                var arregloComandas = [<?php for($i=0; $i<count($arregloComandas);$i++){
                echo "'".$arregloComandas[$i]."'";
                if($i<  count($arregloComandas))
                    echo ",";
            }?>];
                        
                        
                        $.ajax({
                                    type:"POST",
                                    url: "Validaciones_Lado_Servidor/Comandas_Mensajes.php",
                                    data:{"arregloC":arregloComandas}
                                    }).done(function (info){
                                        var comandas = info;
                                    var a = comandas.split(",");
                                    for(i=1; i<a.length;i++){
                                       var  nombre = "#co"+a[i];
                                       $(nombre).removeClass("ocultar");
                                       $(nombre).addClass("mostrar");    
                                    }
                                    for(i=0;i<arregloComandas.length;i++){
                                        
                                        /*if(arregloComandas[i]!=a[i+1])
                                        {
                                            nombre = "#co"+arregloComandas[i];
                                            $(nombre).removeClass("mostrar");
                                            $(nombre).addClass("ocultar");    
                                            
                                        }*/
                                    }
                                    
                                });
                                
                            }
           
    </script>
</html>
