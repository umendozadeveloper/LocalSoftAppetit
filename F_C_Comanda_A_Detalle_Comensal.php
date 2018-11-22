<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        
        require 'Header.php';
        include_once './Clases/Platillo.php';
        include_once './Clases/Vino.php';
        ?>
        
        <script src="js/comandaDinamica.js" type="text/javascript"></script>
        <title>Consultar comanda a detalle</title>
        
        
    </head>
    
    
    <body style="background-color: #fff">

        
        
        <?php
        
        if(!empty($_SESSION['alertaDetalle'])){
            echo "<script>swal('".$_SESSION['alertaDetalle'][0]."');</script>";
            $_SESSION['alertaDetalle']=null;
            
        }
        if(!empty($_SESSION['msjEstadoComanda'])){
            $mensajes = $_SESSION['msjEstadoComanda'];
            $imprimir = "<script>swal('Edición Correcta','";
            foreach ($mensajes as $m){
               $imprimir .=  "-$m\\n";
            }
            $imprimir.= "','success');</script>";
            echo $imprimir;
            $_SESSION['msjEstadoComanda']=null;
        }
        if(isset($_POST['btnComanda'])){
            $idComanda = $_POST['btnComanda'];
        }  else {
            $idComanda = $_GET['idComanda'];
        }     
       
        
        

include_once  './Clases/Comanda.php';
include_once  './Clases/Mesa.php';
include_once  './Clases/ComandaPlatillos.php';
include_once  './Clases/ComandaVinos.php';
include_once './Clases/ComandaEstados.php';


$_SESSION['idComanda']=$idComanda;

$objComanda = new Comanda();
$objComanda->ConsultarPorID($idComanda);
                                

        ?>
        

        
            <form action="Validaciones_Lado_Servidor/N_Detalle_Comanda.php" method="POST" id="form">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            

            
            <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Comanda a detalle</label></center></h4></div>
                            </td>
                        </table>
                    </div>
        
    
                
                <?php 
                $objComandaPlatillos = new ComandaPlatillos();
        $comandaPlatillos = $objComandaPlatillos->ConsultarPorIdComanda($idComanda);

        ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                        <br>
            
                    <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
		
        <tr>
                                <th><div class="centrar "><label>Nombre de platillo</label></div></th>
                                <th width="100px"><div class="centrar "><label>Imagen</label></div></th>
                                <th ><div class="centrar"><label>Cantidad</label></div></th>
                                <th><div class="centrar"><label>Precio</label></div></th>
                                <th><div class="centrar"><label>Calificar</label></div></th>
            
        </tr>
                                </thead>
        
            
    <tbody>
        <?php
        
        
        $objPlatillo = new Platillo();
        $ArregloTmpPlatillos = array();
        foreach ($comandaPlatillos as $cPlatillos){
            //if(!in_array($cPlatillos->NombrePlatillo, $ArregloTmpPlatillos)){
                
            //}
            echo "<tr>";
            echo "<td>";
            if($cPlatillos->EstadoPedidoDescripcion=="Producto pedido"){
                echo "<img src='img/Time.png'>";
            }
            if(strlen($cPlatillos->Comentarios)>0)
            {
                    echo "<button type='button' style='float:right;' data-id='".$cPlatillos->Comentarios."' class='botonComentarios btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalComentarios'><img src='img/info.png'></button>";
            }
                    
            echo "$cPlatillos->NombrePlatillo </td>";
            
            $objPlatillo->ConsultarPorID($cPlatillos->IdPlatillo);
            
            echo "<td><a href='#' data-id='".$cPlatillos->IdPlatillo."' class='detallePlatilloVM noboton btn btn-default ' role='button' data-toggle='modal' data-target='#modalPlatilloDetalle'><div class='imagenesTabla'><img class='' src='$objPlatillo->Foto'></div></a></td>";
            echo "<td ><center>$cPlatillos->Cantidad</center></td>";
            echo "<td><center>$cPlatillos->Precio</td>";
            if($cPlatillos->ValorEstrellas=="" && !in_array($cPlatillos->NombrePlatillo, $ArregloTmpPlatillos))
            {
                array_push($ArregloTmpPlatillos, $cPlatillos->NombrePlatillo);    
                echo "<td><center><button type='button'"
                . " onclick='calificarProducto($cPlatillos->ID,$cPlatillos->IdPlatillo,1);'"
                        . "class='botonComentarios btn btn-Bixa' role='button'xa>Calificar</button></td>";
                
            }else{
                echo "<td></td>";
            }
            echo "</tr>";
        }
        ?>
        
        
    </tbody>
            </table>
                    </div>
                
                <script>
                    function calificarProducto(ID,IdProducto,IdTipo){
                        $('#modalCalificar').modal({
                            show: 'true'
                        }); 
                        $.ajax({
                        url: "Ajax_Calificar.php",
                        type: 'POST',
                        data: {"ID":ID,"IdProducto":IdProducto,"IdTipo":IdTipo},
                        success: function (data) {
                            $("#bodyCalificar").html(data);
                
                            }
                        });
                        
                    }
                    
                </script>
            
            <!--Consulto detalle 5 (Vinos pedidos/servidos)-->
            
            <?php 
            $objComandaVinos = new ComandaVinos();
            $comandaVinos = $objComandaVinos->ConsultarPorIdComanda($idComanda);
            $obVino = new Vino();
        ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                        <br>
            
                    <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
		
        <tr>
                                <th><div class="centrar"><label>Nombre de vino</label></div></th>
                                <th width="100px"><div class="centrar "><label>Imagen</label></div></th>
                                <th><div class="centrar"><label>Cantidad botellas</div></label></th>
                                <th><div class="centrar"><label>Precio botella</div></label></th>
                                <th><div class="centrar"><label>Cantidad copas</div></label></th>
                                <th><div class="centrar"><label>Precio copa</div></label></th>
                                <th><div class="centrar"><label>Calificar</label></div></th>
        </tr>
                                </thead>
    <tbody>
        <?php
        
        
        foreach ($comandaVinos as $cVinos){
            echo "<tr>";
            echo "<td>";
            if($cVinos->EstadoPedidoDescripcion=="Producto pedido"){
             echo "<img src='img/Time.png'>";           
             
             
            if(strlen($cVinos->Comentarios)>0)
            {
                    echo "<button type='button' style='float:right;' data-id='".$cVinos->Comentarios."' class='botonComentarios btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalComentarios'><img src='img/info.png'></button>";
            }
                    echo " $cVinos->NombreVino</td>";
   
            }else{
                echo "<td><a href='#' data-id='".$cVinos->IdVino."' class='detalleVinoVM noboton btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalVinoDetalle'>$cVinos->NombreVino</a></td>";
            }
            
            $obVino->ConsultarPorID($cVinos->IdVino);
            echo "<td><a href='#' data-id='".$cVinos->IdVino."' class='detalleVinoVM noboton btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#modalVinoDetalle'><div class='imagenesTabla'><img class='' src='$obVino->Foto'></div></a></td>";
            
            echo "<td><center>$cVinos->CantidadBotellas</td>";
            echo "<td><center>$$cVinos->PrecioBotella</td>";
            echo "<td><center>$cVinos->CantidadCopas</td>";
            echo "<td><center>$$cVinos->PrecioCopa</td>";
            if($cVinos->ValorEstrellas=="" && !in_array($cVinos->NombreVino, $ArregloTmpPlatillos)){
                array_push($ArregloTmpPlatillos, $cVinos->NombreVino);
                
                echo "<td><center><button type='button'"
                . " onclick='calificarProducto($cVinos->ID,$cVinos->IdVino,2);'"
                        . "class='botonComentarios btn btn-Bixa' role='button'>Calificar</button></td>";
                
            }else{
                echo "<td></td>";
            }
            
            echo "</tr>";
        }
        
        ?>
    </tbody>
            </table>
            </div>
            
            
            <?php
            
        
        echo "<input type='text' id='txtIDCOMANDA' name='txtNUMCOMANDA' class='ocultar'>";
        ?>
            
                    </div>
        </form>        

        
        
        <div class="modal fade" id="login-modalVi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Comentarios</h4>
						</div>
                                                <div class="modal-body" id='bodyVinoV'>
                                                    <textarea name="DNI" id="vinoV" ></textarea>
                                                    <?php
                                                    
                                                    ?>
                                                <div id="vinoAConsultarV">
                                                        
                                                </div>
                                                    
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".open-ModalV", function () {
                var vino = $(this).data('id');               
                $("#bodyVinoV #vinoV").val(vino);

                
                });
            </script>
            
                                                    
                                                    
                                                    
						<div class="modal-footer">
                                                    <button id='platilloM_P' data-dismiss="modal" class="btn btn-Bixa">Cerrar</button>
						</div>
					</div>
				</div>
                                </div>
    </div>
        
            
            
        
        <!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="vmCambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    
    	<div class="modal-dialog">
			<div class="modal-content">
                            <div class="modal-header" align="center">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</div>
				

                
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                
                    <!-- Begin # Login Form -->
                    <form id="login-form" method="POST" action="Validaciones_Lado_Servidor/N_CambiarStatusComanda.php">
		                <div class="modal-body">
				    		<div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">
                                    Activa (Descripción):Los comensales se encuentran en la(s) mesa(s), con opción de realizar orden.
                                    <br>Funciones:
                                    <li>Editar la comanda (asignar estado como Activa, Pagada, Finalizada.
                                        <li>Agregar productos.
                                        <li>Modificar productos en espera (eliminación o marcar como entregado).
                                        <li>NOTA:Las mesas que usa la comanda están marcadas como ocupadas.
                                
                                <br>
                                <br>
                                    		
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                
                                
                                    Pagada(Descripción): Los comensales ya pagaron pero aún se encuentran ocupando las mesas por lo tanto las mesas permaneces como ocupadas.
                                    <br>Funciones:
                                    <li>Editar la comanda (asignar estado como Pagada o Finalizada.
                                    <li>NOTA:Las mesas que usa la comanda están marcadas como ocupadas.
                                        <br>
                                        <br>
                                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                
                                
                                    Finalizada(Descripción): Los comensales han pagado y se han retirado.
                                    <br>Funciones:
                                    <li>Editar la comanda (asignar estado como Finalizada).
                                    <li>NOTA:Las mesas que usa la comanda están marcadas como libres.
                                </span>
                                
                                
                                                </div><br><br>
                                    Seleccionar Opción
                                    <input type="text" class="ocultar" name="txtComandaVM" value='<?php echo $idComanda;?>'>
                                    <select class="form-control" name="cmbStatus">
                                    <?php $objComandaEstados = new ComandaEstados();
                                    $bandera = false;
                                    $cEstados = $objComandaEstados->ConsultarTodo();
                                    foreach ($cEstados as $cE){
                                        if($co->Clave == $cE->Clave)
                                        {
                                            $bandera=true;
                                        }
                                        if($bandera==true){
                                            echo "<option value='$cE->Id'>$cE->Clave</option>";
                                        }
                                        
                                    }
                                    ?>
                                    </select>
				    		
                            <div class="checkbox">
                                <label>
                                    
                                </label>
                            </div>
        		    	</div>
				        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="btnAceptar" style="background-color: rgb(172,31,45);">Cambiar Estado</button>
                            </div>
			
				        </div>
                    </form>
                </div>
            </div>                                        
        </div>
</div>
        
        
        <!--Ventana modal para consulta de platillos-->
        <div class="modal fade" id="modalPlatilloDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						
                                                <div class="modal-body" id='bodyPlatilloDetalle'>
                                                    <input class="ocultar" type="text" name="DNI" id="mostrarDatosPlatillo"/>
                                                <div id="platilloConsultaDetalle">
                                                        
                                                </div>
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".detallePlatilloVM", function () {
                var vino = $(this).data('id');   
                $("#bodyPlatilloDetalle #mostrarDatosPlatillo").val(vino);
                $.ajax({
              url: "F_C_consultaPlatilloComanda.php",
              type: 'POST',
              data: {"idPlatillo":vino},
              success: function (data) {
                  $("#platilloConsultaDetalle").html(data);
                
                }
                });
                });
            </script>       
						<div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-Bixa">Cerrar</button>
						</div>
					</div>
				</div>
                                </div>
    </div>
        
        <!--Ventana modal para consulta de vinos-->
        <div class="modal fade" id="modalVinoDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						
                                                <div class="modal-body" id='bodyVinoDetalle'>
                                                    <input class="ocultar" type="text" name="txtVinoDetalle" id="mostrarDatosVino"/>
                                                <div id="vinoConsultaDetalle">
                                                        
                                                </div>
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".detalleVinoVM", function () {
                var vino = $(this).data('id');   
                $("#bodyVinoDetalle #mostrarDatosVino").val(vino);
                $.ajax({
              url: "F_C_consultaVinoComanda.php",
              type: 'POST',
              data: {"idVino":vino},
              success: function (data) {
                  $("#vinoConsultaDetalle").html(data);
                
                }
                });
                });
            </script>       
						<div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-Bixa">Cerrar</button>
						</div>
					</div>
				</div>
                                </div>
    </div>
        
        
        <div class="modal fade" id="modalComentarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Comentarios</h4>
						</div>
                                                <div class="modal-body" id='bodyComentarios'>
                                                    <textarea class="claseTextArea" name="DNI" id="txtComentarios" ></textarea>
                                                    <?php
                                                    
                                                    ?>
                                                
                                                    
            <script>
                
                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".botonComentarios", function () {
                var vino = $(this).data('id');               
                $("#bodyComentarios #txtComentarios").val(vino);

                
                });
            </script>
            
                                                    
                                                    
                                                    
						<div class="modal-footer">
                                                    <button id='platilloM_P' data-dismiss="modal" class="btn btn-Bixa">Cerrar</button>
						</div>
					</div>
				</div>
                                </div>
    </div>
        
        
        
        
        <div class="modal fade" id="modalCalificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Calificar</h4>
						</div>
                                        <div class="modal-body" id='bodyCalificar'>
						
        
                                            
					</div>
				</div>
                                </div>
    </div>
        
                
        
        <?php
        require_once './_banner.php';
        ?>
    </body>
</html>
