<?php
include_once './Clases/Vino.php';
include_once './Clases/Maridaje.php';
include_once './Clases/Platillo.php';
include_once './Clases/Seguridad.php';

//---------------------------------------------
/*include_once './Clases/SR_Productos.php';
include_once './Clases/SR_Modificadores.php';
include_once './Clases/SR_GruuposModificadores.php';
include_once './Clases/SR_GruposModificadoresProductos.php';
include_once './Clases/SR_EnlaceSoftR.php';*/
//---------------------------------------------
$seguridad = new Seguridad();
$idVino= $_POST['idVino'];
$idMenu = $_POST['idMenu']; 
$objVino = new Vino();
$objPlatillo = new Platillo();
$objMaridaje = new Maridaje();
$objVino->ConsultarPorID($idVino);

//---------------------------------------------
//$objEnlace = new EnlaceSoftR();
//$enlacesSoft = $objEnlace->ConsultarPorID_SA($idVino, 2);

//---------------------------------------------
?>

<div class="modal-header">
    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="editarPlatilloTitulo"><?php echo $objVino->Nombre; ?></h4>
</div>



<form action="Validaciones_Lado_Servidor/N_AgregarComandaVino.php" method="POST" id="formComandaVino">
<div class="panel-body no-padding-top no-padding-bottom">
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-8 col-sm-8 col-md-8 col-lg-8">
                <img src="<?php echo $objVino->Foto;?>">
                
                <hr>
                <label class="editarPlatilloCuerpo"><?php echo $objVino->DescripcionLarga;?></label>
                
                <?php
                            
  /*              $objSR_Productos = new SR_Productos();
                $arregloGrupos = array();
                //$objSR_Productos->ConsultarPorID($objEnlace->SR_IdProducto);
                $objSR_Modificadores = new SR_Modificadores();
                $objSR_GrupoModificadores = new SR_GruuposModificadores();
                $objSR_GruposModificadoresProductos = new SR_GruposModificadoresProductos();
                
                
        $posicion = 0;        
        $banderaParaOcultar = 0;
        echo "<input id='txtIdTipoProducto' type='text' value='".$enlacesSoft[0]->IdTipoProducto."'>";
        $arrayLabels = array();
                foreach($enlacesSoft as $enS){
                
                    
                $modificadores = $objSR_Modificadores->ConsultarPorIdProducto($enS->SR_IdProducto);    
                    if(count($modificadores)>0){
        
        $objSR_GruposModificadoresProductos->ConsultarPorIdProducto_IdGrupo($enS->SR_IdProducto, $modificadores[0]->idgruposmodificadores);
        echo "<br>";echo "<br>";echo "<br>";
        
            if($banderaParaOcultar==1){
                echo "<div class='cl$enS->IdTipoProducto ocultar'>";
            }
            else{
                echo "<div class='cl$enS->IdTipoProducto'>";
            }
        
        $banderaParaOcultar ++;
        
        echo "<input type='text' name='txtidgruposmodificadores".$modificadores[0]->idgruposmodificadores.$enS->IdTipoProducto."' id='txtidgruposmodificadores".$modificadores[0]->idgruposmodificadores.$enS->IdTipoProducto."'>";
        echo "Productos incluidos en el precio: ".intval($objSR_GruposModificadoresProductos->incluidos);
        
            echo "<table  class='table table-bordered '>"
        . "<thead>"
        . "<tr>"
                //. "<th>Grupo</th>"
                //. "<th>Id Modificador</th>"
                //. "<th>Descripcion</th>"
                            
                . "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $bandera = false;
        foreach ($modificadores as $m){
            $objSR_GrupoModificadores->ConsultarPorId($m->idgruposmodificadores);
            $objSR_Productos->ConsultarPorID($m->idmodificador);
            $objSR_GruposModificadoresProductos->ConsultarPorIdProducto_IdGrupo($enS->SR_IdProducto, $m->idgruposmodificadores);
            if($bandera){
                if(!in_array($m->idgruposmodificadores."-".$enS->IdTipoProducto, $arregloGrupos)){
                    echo "</tbody>";
                    echo "</table>";
                    echo "<br>";
                    echo "<br>";
                    echo "<input type='text' name='txtidgruposmodificadores".$m->idgruposmodificadores.$enS->IdTipoProducto."' id='txtidgruposmodificadores".$m->idgruposmodificadores.$enS->IdTipoProducto."'>";
                    echo "Incluidos en el precio: ".intval($objSR_GruposModificadoresProductos->incluidos);
                    echo "<table  class='table table-bordered '>"
        . "<thead>"
        . "<tr>"
        //        . "<th>Grupo</th>"
          //      . "<th>Id Modificador</th>"
                //. "<th>Descripcion</th>"
                            //."<th></th>"
                . "</tr>";
        echo "</thead>";
        echo "<tbody>";
                    $posicion++;
                    //echo "<input type='text' id='txtID$objSR_GrupoModificadores->idgruposmodificadores' value='".$m->idgruposmodificadores."'>";
                    array_push($arregloGrupos,$m->idgruposmodificadores."-".$enS->IdTipoProducto);
                    array_push($arrayLabels, $posicion."-".$enS->IdTipoProducto);
                }
                
            }
            else{
                array_push($arrayLabels, $posicion."-".$enS->IdTipoProducto);
                array_push($arregloGrupos,$m->idgruposmodificadores."-".$enS->IdTipoProducto);
            }
            
            $bandera = true;
            echo "<tr>";
            
            
//            echo "<td>$objSR_GrupoModificadores->descripcion</td>";
  //          echo "<td>$objSR_Productos->idproducto</td>";
            echo "<td><button type='button' class='btnModificadoresModal' value='$objSR_Productos->idproducto' "
                
                    //Num Arreglo, Id Producto, Descripcion
            . "onclick=\"anadirValue('".$posicion."','$objSR_Productos->idproducto','$objSR_Productos->descripcion','".intval($objSR_GruposModificadoresProductos->incluidos)."','$objSR_GruposModificadoresProductos->maximomodificadores','$objSR_GrupoModificadores->idgruposmodificadores','$enS->IdTipoProducto');\">"
            . " $objSR_Productos->descripcion </button></td>";
            echo "</tr>";

        }
        $posicion++;
        echo "</tbody>";
        echo "</table>";
        
    }
    
                    
    echo "</div>";
                }
                
                echo "<input class='' type='text'  id='numArreglos' value='".count($arregloGrupos)."'>";
                
                echo "<br>";
                foreach ($arregloGrupos as $arr){
                    echo $arr."<br>";
                }
    
    */
                ?>
            </div>
            
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-4 col-sm-4 col-md-4 col-lg-4">
                <center>
                    
                    
                
                    
                    
                    
                
                
                  <!--
                    <select class="form-control" id="cmbTipoProducto" name="cmbTipoProducto">
                        <option value="1">Botella</option>
                        <option value="2">Copa</option>
                    </select>    
                  -->
                    
                    Precio por copa:<div class="editarPlatilloPrecio">
                        <label class="editarPlatilloPrecio"><?php  echo "$".$objVino->PrecioCopa;?></label></div>
                        <?php if($seguridad->CurrentUserPerfil()!=1 && $seguridad->CurrentPermisoComandear()){?>
                    
                    <input type="text" value='<?php echo $idVino;?>' name='txtVino' class="ocultar">
                    <input type="text" value='<?php echo $objVino->PrecioCopa;?>' name='txtPrecioCopa' class="ocultar">
                    <input type="text" value='<?php echo $objVino->PrecioBotella;?>' name='txtPrecioBotella' class="ocultar">
                    <input type="text" value='<?php echo $idVino;?>' name='txtVino' class="ocultar">
                    <input type="text" value='<?php echo $_POST['idMenu']; ?>' name="txtMenu" class="ocultar">
                    
                    
                    <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMenosC' value=''>
                        <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    <input type='tel' name='txtCantidadCopas' readonly="" id='txtCantidadCopas' class='editarComandaP_and_V' value='0'>
                        <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMasC' value=''>
                        <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    <br>
                    <br>
                    <br>
                    
                    
                    <?php } ?>
                    
                Precio por botella:<div class="editarPlatilloPrecio"><label class="editarPlatilloPrecio"><?php  echo "$".$objVino->PrecioBotella;?></label></div>
                
                <?php 
                
                
    
                
                if($seguridad->CurrentUserPerfil()!=1 && $seguridad->CurrentPermisoComandear()){?>
                  <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMenosB' value=''>
                      <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    <input type='tel' name='txtCantidadBotellas' readonly="" id='txtCantidadBotellas' class='editarComandaP_and_V' value='0'>
                    <button type='button' class='btnComandaDetalle btn-Bixa'  name='btnMasB' value=''>
                      <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    <br>
                    <br>
                    
                    ¿Agregar comentarios a la orden?
                    <select class="form-control" id="cmbComentarios">
                    <option>No</option>
                    <option>Si</option>
                    </select>
                    
                    <div id="divComentarios" class="ocultar">
                        <textarea class="claseTextArea" rows="5" placeholder="Comentarios"  name="txtComentarios"></textarea>
                    </div>
                    
                    <button type="button" class="btn btn-Bixa btn-lg" value="" name='btnAgregar' role="button">
                    Ordenar
                    </button>    
                    <?php }
                    
                    
 
 echo "<br>";
 ////////SOFT R
 /*$banderaParaOcultar = array();
 
 foreach ($arrayLabels as $as){
     $grupo_clase = explode("-", $as);
     echo "<label class='cl$grupo_clase[1]' id='gp$grupo_clase[0]'></label>";
     echo "<br>";
 }*/
 
                    ?>
                    
                    
                    </center>
                           
                        
                
                
                </div>
    </div>

</form>

<?php $platillosS = $objMaridaje->ConsultarPorIdVino($idVino);

    if(count($platillosS)>0){
?>

<div class="panel">
    
    <center><h1 class='editarPlatilloTitulo'>Maridaje</h1></center>
    
            
    <div class="thumbnail panel-body no-padding-top no-margin-bottom">
<div class="thumbnail  col-xs-12 col-ms-offset-2 col-ms-7 col-sm-offset-2 col-sm-7 col-md-offset-2 col-md-7 col-lg-offset-2 col-lg-7">
        <?php 
        
        
        echo "<div class='carousel slide' id='myCarouselV' data-ride='carousel'>";				
				echo "<ol class='carousel-indicators'>";
					echo "<li class='active' data-slide-to='0' data-target='#myCarouselV'></li>";
                                        
                                        
                                        $incremento = 0;
                                        
                                        foreach($platillosS as $pM){
                                            if($incremento>0)
                                            {
                                                echo "<li data-slide-to='$incremento' data-target='#myCarouselV'></li>";
                                            }
                                            $incremento++;
                                        }
                                        $incremento=0;
                                        
                                        
				echo "</ol>";
                                
				echo "<div class='carousel-inner' role='listbox'>";			
                                    foreach ($platillosS as $pM){   
                                        $objPlatillo->ConsultarPorID($pM->IdPlatillo);
                                        if($incremento>0){
                                    echo "<div class='item' id='slide"."$incremento"."'>";
                                        }
                                        else
                                        {
                                            echo "<div class='item active' id='slide0'>";
                                        }
                                        
                                    echo "<center><h4 class='editarPlatilloTitulo'>".$objPlatillo->Nombre."</h4></center>";
                                    echo "<a href='#' data-id='".$objPlatillo->ID."' class='open-ModalP noboton btn btn-default btn-xs' role='button' data-toggle='modal' data-target='#login-modalPlatillo'>";
                                    echo "<img src='".$objPlatillo->Foto."' class='img-responsive'>";
                                    echo "</a>";
                                    echo "</div>";
                                        $incremento++;
                                    }

				echo "</div>";				
			echo "</div>";

                        if($incremento>1){
?>
    
    
    
    
    <div class="thumbnail" style="position: relative; float: left;">
                <a href="#myCarouselV" data-slide="prev"  class="btn btn-Bixa">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>    
            </div>          		
    
	<div class="thumbnail" style="position: relative; float: right;">
                <a href="#myCarouselV" data-slide="next"  class="btn btn-Bixa">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>    
            </div>          		
    
                        <?php }
                        ?>
    </div>
        </div>
    
</div>


    <?php }
    ?>


        <div class="modal fade" id="login-modalPlatillo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->
						
                                                <div class="modal-body" id='bodyVinoP'>
                                                    <input class="ocultar" type="text" name="DNI" id="vinoP"/>
                                                <div id="vinoAConsultarP">
                                                        
                                                </div>
            <script>
                //var arregloModificadores = new Array();
                //var ArregloDeArreglos = new Array();
               // LlenarArreglos();
                function LlenarArreglos(){
                    var CantidadArreglos = $("#numArreglos").val();
                    /*alert(CantidadArreglos.toString());*/
                /*    var ArregloDeArreglos = new Array();*/
                    
                    for(var i = 0; i<CantidadArreglos;i++){
                        ArregloDeArreglos.push(new Array());
                        arregloModificadores.push(new Array());
                    }
                    
                 /*   alert(ArregloDeArreglos[0].length.toString());*/
                }
                
                
                /**Num arreglo, Id producto, Descripcion
                 * */
                function anadirValue(numArreglo,idproducto,descripcion,incluidos,maximo,idgrupoModificadores,idTipoProducto){
                    
                    var numGrupo = "#gp"+numArreglo;
                    /*alert(limite);*/
                    var idBtn="gp"+numArreglo;
                    
                    //alert($("#txtidgruposmodificadores"+idgrupoModificadores).val());
                    
                    if(ArregloDeArreglos[numArreglo].length<maximo){
                        ArregloDeArreglos[numArreglo].push(descripcion);
                        arregloModificadores[numArreglo].push(idproducto);
                        /*if($("#txtidgruposmodificadores"+idgrupoModificadores).val()!=""){
                            $("#txtidgruposmodificadores"+idgrupoModificadores).val($("#txtidgruposmodificadores"+idgrupoModificadores).val()+","+idproducto);
                        }
                        else{
                            $("#txtidgruposmodificadores"+idgrupoModificadores).val(idproducto);
                        }*/
                        
                    }
                    else{
                        swal('','Se ha alcanzado el máximo de modificadores permitidos,\n\
                            para capturar modificadores adicionales elimine previamente los\n\
                         modificadores capturados.','info');
                    }
                    
                    //for(var i = 0; i<ar)
                    console.log(" ");
                    console.log("---------------");
                    $(numGrupo).html("");
                    $(numGrupo).html("<table class='table table-bordered table-condensed'>");
                    $("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val("");
                    for(var i= 0; i<ArregloDeArreglos[numArreglo].length; i++){
                        //for(var j=0; j<)
                        
                        
                        if($("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val()!=""){
                            $("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val($("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val()+","+arregloModificadores[numArreglo][i]);
                        }
                        else{
                            $("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val(arregloModificadores[numArreglo][i]);
                        }
                        
                        $(numGrupo).html($(numGrupo).html()+"<tr><td><button class='btnModificadoresModal' value='1' id='"+idBtn+"_"+i+"' onclick='Metodo(\""+numGrupo+"_"+i+"\",\""+numArreglo+"\",\""+ArregloDeArreglos[numArreglo][i]+"\",\""+incluidos+"\",\""+arregloModificadores[numArreglo][i]+"\",\""+idgrupoModificadores+"\",\""+idTipoProducto+"\");'>"+ArregloDeArreglos[numArreglo][i]+" <span style='float:right; ' class='glyphicon glyphicon-remove'></span></button></td></tr>");
                        
                        //console.log(ArregloDeArreglos[numArreglo][i].toString());
                        console.log(numGrupo);
                    }
                    if(incluidos<ArregloDeArreglos[numArreglo].length){
                        var productosExtras = ArregloDeArreglos[numArreglo].length-incluidos;
                        $(numGrupo).html($(numGrupo).html()+"<tr><td><label id='lbl"+idBtn+"' class='alert-danger'>Ha seleccionado más productos ("+productosExtras+") que los que se incluyen en el precio<label></td></tr>");
                    }
                    $(numGrupo).html($(numGrupo).html()+"</table>");
                }
                
                function Metodo(descripcion,numArreglo,index,limite,descripcionProducto,idgrupoModificadores,idTipoProducto){
                
                        $(descripcion).addClass("ocultarBoton");
                        
                        var idBtn="gp"+numArreglo;
                        var lbl = "#lbl"+idBtn;
                        
                        var ind = ArregloDeArreglos[numArreglo].indexOf(index);
                        if(ind != -1){
                            ArregloDeArreglos[numArreglo].splice(ind,1);    
                        }
                        
                        var indDescripcion =arregloModificadores[numArreglo].indexOf(descripcionProducto);
                        if(indDescripcion != -1){
                            arregloModificadores[numArreglo].splice(indDescripcion,1);    
                        }
                        
                        $("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val("");
                        for(var i= 0; i<ArregloDeArreglos[numArreglo].length; i++){
                        if($("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val()!=""){
                            $("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val($("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val()+","+arregloModificadores[numArreglo][i]);
                        }
                        else{
                            $("#txtidgruposmodificadores"+idgrupoModificadores+idTipoProducto).val(arregloModificadores[numArreglo][i]);
                        }
                    }
                        
                        if(limite<ArregloDeArreglos[numArreglo].length){
                            $(lbl).removeClass("ocultar");
                            $(lbl).addClass("mostrar");
                            var productosExtras = ArregloDeArreglos[numArreglo].length-limite;
                            $(lbl).html("Ha seleccionado más productos ("+productosExtras+") que los que se incluyen en el precio");
                        }
                        else{
                            $(lbl).removeClass("mostrar");
                            $(lbl).addClass("ocultar");
                        }    
                }
                $("#cmbTipoProducto").change(function(){
                    
                    
                    //1 Botella, 2 Copa
                   if($(this).val()==2){
                       $(".cl1").removeClass("mostrar");
                       $(".cl1").addClass("ocultar");
                       $(".cl2").removeClass("ocultar");
                       $(".cl2").addClass("mostrar");
                       
                   }
                   else{
                       $(".cl1").removeClass("ocultar");
                       $(".cl1").addClass("mostrar");
                       $(".cl2").removeClass("mostrar");
                       $(".cl2").addClass("ocultar");
                       
                   }
                   $("#txtIdTipoProducto").val($(this).val());
                });
                
                
                /*Script para pasar datos a ventana Modal*/
                $(document).on("click", ".open-ModalP", function () {
                var vino = $(this).data('id');   
                var idPlatillo = <?php echo $idVino;?>;
                var idMenu = <?php echo $idMenu;?>; 
                $("#bodyVinoP #vinoP").val(vino);
                $.ajax({
              url: "platilloModal_II.php",
              type: 'POST',
              data: {"idPlatillo":vino,"idMenu":idMenu,"idVino":idPlatillo},
              success: function (data) {
                  $("#vinoAConsultarP").html(data);
                
                }
                });
                });
            </script>
            
                                                    
                                                    
                                                    
						<div class="modal-footer">
                                                    <button id='ventanaModalVino' class="btn btn-Regresar" >Cerrar</button>
						</div>
					</div>
				</div>
                                </div>
    </div>

<style>
    .ocultarBoton{
        display: none;
    }
    </style>


<script>
        $("button[name=btnMenosC]").click(function (){
        var nombretxt ="input[id=txtCantidadCopas]";
        var numPlatillos = $(nombretxt).val();
        if(numPlatillos>0)
           numPlatillos -=1;  
           $(nombretxt).val(numPlatillos);
        });
        
            $("button[name=btnMasC]").click(function (){
        var nombretxt ="input[id=txtCantidadCopas]";
        var numPlatillos = $(nombretxt).val();
        numPlatillos = parseInt(numPlatillos);
           numPlatillos +=1;  
           $(nombretxt).val(numPlatillos);
        });
        
        
        
        $("button[name=btnMenosB]").click(function (){
        var nombretxt ="input[id=txtCantidadBotellas]";
        var numPlatillos = $(nombretxt).val();
        if(numPlatillos>0)
           numPlatillos -=1;  
           $(nombretxt).val(numPlatillos);
        });
        
            $("button[name=btnMasB]").click(function (){
        var nombretxt ="input[id=txtCantidadBotellas]";
        var numPlatillos = $(nombretxt).val();
        numPlatillos = parseInt(numPlatillos);
           numPlatillos +=1;  
           $(nombretxt).val(numPlatillos);
        });
        
        
        $("#cmbComentarios").change(function (){
           var divComentarios = document.getElementById("divComentarios");
           if($(this).val()==="Si"){
               divComentarios.className = "mostrar";
           }
           else{
               divComentarios.className = "ocultar";
           }
           
        });
        
        $("button[name=btnAgregar]").click(function (){
            swal({   
		title: 'Corfirmar Orden',   
		text: '¿Desea ordenar el vino seleccionado?',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: '¡Claro!',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false }, 

		function(isConfirm){   
			if (isConfirm) {     
                            $("#formComandaVino").submit();
                            /*
				swal('¡Hecho!', 
					'Platillo Ordenado', 
					'success');   */
			} else {     
				swal('Cancelado', 
					'', 
				'error');   
			} 
		});
        });
        
        $("#ventanaModalVino").click(function (){
                   $('#login-modalPlatillo').modal('hide');
                   $('#login-modalPlatillo').data('modal', null);
                   
                });
    
        
        </script>