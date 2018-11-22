        <?php
        require 'Header.php';
        ?>
        
        
<title >Consultar bebidas</title>

            <script>
                
                /*Script para pasar datos a ventana Modal*/
                /*
                $(document).on("click", ".open-Modal", function () {
                var myDNI = $(this).data('id');
                $(".modal-body #DNI").val( myDNI );
                });*/
            </script>
        <?php
        include_once  './Clases/Vino.php';
        include_once  './Clases/SubMenu.php';
        include_once  './Clases/Maridaje.php';
        
        ?>
        
        
        
            
            <form action="F_A_EditarVino.php" method="GET">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de bebidas</label></center></h4></div>
            </td>
        </table>
        
            
            
            
                    <table   class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
		
            <tr>
                <th style="width: 20%;"><div class="centrar"><label>Nombre de vino</label></div></th>
                    <th><div class="centrar"><label>Foto</label></div></th>
                                <th><div class="centrar"><label>Ícono</label></div></th>
                                <th class="ocultar"></th>
                                <th class="ocultar"></th>
                                <th><div class="centrar"><label>Visible</label></div></th>
                                <th><div class="centrar"><label>Maridaje</label></div></th>
                                <th><div class="centrar"><label>Menús</label></div></th>
                                <th><div class="centrar"><label>Opciones</label></div></th>
        </tr>
    </thead>
    <tbody>
        

        
        <?php
                include_once './Clases/Vino.php';
                $objVino = new Vino();
                $objMaridaje = new Maridaje();
                $objSubMenu = new SubMenu();
                $vinos = $objVino->ConsultarTodos();
                $color = "white";
                
                foreach ($vinos as $v){
                    $smVino = $objMaridaje->ConsultarPorIdVino($v->ID);
                $subMenu_P = $objSubMenu->ConsultarPorIDVino($v->ID);
                
                    echo "<tr>";
                     echo "<td>"
                       . "<button value='$v->ID'"
                       . " name='IdVino' type='submit' class='noboton editarPlatilloCuerpo' data-toggle='tooltip' title='Editar datos'>"
                       . " $v->Nombre</button>"
                       . "</td>";
                        echo "<td><div class='imagenesTabla'><img class='' src='$v->Foto'></div></td>";
                        echo "<td><div class='imagenesTabla'><img class='' src='$v->Icono'></div></td>";
                     
                     
                        echo "<td class='ocultar'>$v->DescripcionCorta</td>";
                        echo "<td class='ocultar'>$v->DescripcionLarga</td>";
                        
                        if($v->Visible==1)
                        {
                            echo "<td><center><input class='myCheck' id='check$v->ID' onchange='cambioVisible($v->ID);'  type='checkbox' name='myCheckName' value='$v->Visible'  checked></td>";
                        }
                        else{
                            echo "<td><center><input class='myCheck' id='check$v->ID' onchange='cambioVisible($v->ID);'  type='checkbox' name='myCheckName' value='$v->Visible'  ></td>";
                            //echo "<td><input class='myCheck  id='check$s->ID' onchange='cambioVisible($s->ID);'  type='checkbox' name='myCheckName' value='0'></td>";
                        }
                        
                     /*Imprimimos el listado de platillos pertenecientes a cada vino*/
                       echo "<td>";
                       foreach ($smVino as $sv){
                           echo "• $sv->NombrePlatillo<br>";
                       }
                       echo "</td>";
                       
                       /*Imprimimos el listado de menús en que se encuentra cada vino*/
                        echo "<td>";
                        foreach ($subMenu_P as $sub){
                            echo "• $sub->Clave<br>";
                        }
                        echo "</td>";
                        
                        echo "<td>";
                        echo "<button class='btn btn-Bixa' value='$v->ID' "
                       . " name='IdVino' data-toggle='tooltip' data-placement='left' title='Editar datos'><span class='glyphicon glyphicon-edit'></span>"
                       . "</button>";
                         echo "<button class='btn btn-Bixa' type='button' value='$v->ID' onclick='eliminarBebida($v->ID);' name='btnClasificador' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                        
                        echo "<a class='btn btn-Bixa' data-toggle='tooltip' data-placement='left' title='Ver a detalle' href='F_A_DetalleBebida.php?IdVino=$v->ID'><span class='glyphicon  glyphicon-search'></span></a>";
                        echo "</td>";
                        echo "</tr>";
                       
                       
                    
                }
                       /* $smVino = $objMaridaje->ConsultarPorIdVino($v->ID);
                        $subMenu_P = $objSubMenu->ConsultarPorIDVino($v->ID);
                        if(count($smVino)>  count($subMenu_P)){
                             $tamano = count($smVino);
                        }
                        else{
                            $tamano = count($subMenu_P);
                        }
               
               echo "<TR>";
               echo "<td class='editarPlatilloCuerpo '  style='background-color: white;' "
                       . " rowspan='".($tamano*2-1)."'>"
                       . "<button class='btn btn-Bixa' value='$v->ID' "
                       . " name='btnAceptar' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span>"
                       . "</button>"
                       . "<button value='$v->ID'"
                       . " name='btnAceptar' type='submit' class='noboton editarPlatilloCuerpo' data-toggle='tooltip' title='Editar datos'>"
                       . " $v->Nombre</button>"
                       . "</td>";
               
               if($tamano>0){
               for($k = 0; $k<$tamano;$k++)
               {
                   
                   echo  "<td class='editarPlatilloCuerpo' style='background-color: $color;'> ";
                            if($k<  count($smVino)){
                                //echo "<script>alert('".count($smVino)."')</script>";
                            echo  "<label>".$smVino[$k]->NombrePlatillo."</label>";
                            }else {echo  "<label></label>";}
                            echo  " </td>";
                            
                            
                            echo  "<td class='editarPlatilloCuerpo' style='background-color: $color;'> ";
                            if($k< count($subMenu_P)){
                            echo  "<label>".$subMenu_P[$k]->Clave."</label>";
                            }else {echo  "<label></label>";}
                            echo  " </td>";
                            
                            if($k<($tamano))
                            {
                                
                                echo  "<tr></tr>";
                            }
                            
                            if($k<(count($v))){
                            echo  "</TR>";
                            }
               }
               }
                    else{
                            echo  "<td>";
                            echo  "</td>";
                            echo  "<td>";
                            echo  "</td>";
                            echo  "</tr>";

                    }
                    
                echo "</TR>";
           }
                
                
                
                
                /*
                $consultaNombreVinos = $objVino->ConsultarNombre();
                
                $nombreT = explode("°",$consultaNombreVinos);
            
                for($i=0; $i<count($nombreT)-1;$i++){
                        $consultaSomelier = $objVino->ConsultarMaridaje($nombreT[$i]);
                        $somelier = explode("°",$consultaSomelier);
                        $consultaNombreSubMenus =  $objVino->ConsultarSubMenuPorNombrePlatillo($nombreT[$i]);
                        $nombreSubmenu = explode("°", $consultaNombreSubMenus);
                        $tamanoFilas = 0;        
                        if($i%2===0){
                        $color = "white";
                    }
                    else {
                        $color = "white";
                    }
                    
                    
                    if(count($nombreSubmenu)>  count($somelier)){
                        $tamanoFilas=count($nombreSubmenu);
                    
                    
                    }
                    else{
                        $tamanoFilas=count($somelier);
                    }
                    $tamanoFilasP = ($tamanoFilas-1)*2;
                    $tamanoFilasP = $tamanoFilasP-1;
                    echo "<TR>";
                    
                    echo "<td class='TablaPlatillosNombreP'  style='background-color: $color;'  rowspan='".($tamanoFilasP)."'><button class='noboton' value='$nombreT[$i]' name='btnAceptar'><img src='img/Edit.ico'></button><button value='$nombreT[$i]' name='btnAceptar' type='submit' class='noboton consultarPlatillosNombre'>$nombreT[$i]</button></td>";
                    //echo "<td class='TablaPlatillosNombreP'  style='background-color: $color;'  rowspan='".($tamanoFilas)."'><button name='btnAceptar' type='submit' class='noboton' data-toggle='modal' data-target='#IdMiVentanaModal'>$nombreT[$i]</button></td>";
                    //echo "<td class='TablaPlatillosNombreP'  style='background-color: $color;'  rowspan='".($tamanoFilas)."'><a data-toggle='modal' data-id='$nombreT[$i]'  class='open-Modal' href='#IdMiVentanaModal'>$nombreT[$i]</a></td>";
                    
                    
                    //echo "Filas para consulta del platillo: $nombreT[$i]: ".$tamanoFilas." --- Somelier = ".  count($somelier)."---SubMenus = ".  count($nombreSubmenu)."<br>";
                 
                    if($tamanoFilas>1){
                 
                        for($j = 0;$j<$tamanoFilas-1;$j++)
                        {

                            
                            echo "<td class='editarPlatilloCuerpo' style='background-color: $color;'> ";
                            if($j<  count($somelier)-1){
                            echo "<label>".$somelier[$j]."</label>";
                            }else {echo "";}
                            echo " </td>";
                            
                            
                            echo "<td class='editarPlatilloCuerpo' style='background-color: $color;'> ";
                            if($j<  count($nombreSubmenu)){
                            echo "<label>".$nombreSubmenu[$j]."</label>";
                            }else {echo "<label>s</label>";}
                            echo " </td>";
                            
                            if($j<($tamanoFilas-2))
                            {
                 
                                echo "<tr></tr>";
                            }
                                
                            
                        }
                        
                        if($i<(count($nombreT)-2)){
                            echo "</TR>";
                        }
                    }
                    else{
                            echo "<td>";
                            echo "</td>";
                            echo "<td>";
                            echo "</td>";
                            echo "<tr></tr>";
                    }
                }*/
        ?>
        
        
    </tbody>
        </table>
                                
                            <br>
                <br>
                <a class="btn btn-Bixa" style="float: right" href="F_A_RegistrarVino.php">
                        Registrar otra bebida
                    </a>
                
                <a class="btn btn-Regresar"  href="F_A_PaginaPrincipal.php">
                      &larr;  Menú Principal
                    </a>
                <br>
                <br>
           </div>
        </form>        
                
                
                
                <!-- VENTANA MODAL QUE USA EL SCRIPT DE ARRIBA PARA PASARLE VALORES 
        
        
        
        			<div class="modal fade" id="IdMiVentanaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal 
						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Datos del platillo</h4>
						</div>

                                                <div class="modal-body">
                                                <input type="text" name="DNI" id="DNI" />
                                                <?php 
                                                //$valor = $_POST['DNI'];
                                                //echo $valor;
                                                //echo $objVino->ConsultarSommelier("s");
                                                
                                                ?>
                                                </div>

						<div class="modal-footer">
							<button class="btn btn-Bixa" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
                        -->
    </body>
    
    <form method="POST" action="./Validaciones_Lado_Servidor/N_EliminarElementoCatalogo.php" id="formDelete" >
        <input type="text" id="txtID" name="txtID" class="ocultar">
        <input type="text" id="IDCatalogo" name="IDCatalogo" class="ocultar">
    </form>
    
    
    <script>
        function cambioVisible(ID){
        var idCheck ="#check"+ID;
        var Visible = $(idCheck).val();
        
        if(Visible == 1){
            $(idCheck).val(0);
        }else{
            $(idCheck).val(1);
        }
        Visible = $(idCheck).val();
        $.ajax({
           url: "Validaciones_Lado_Servidor/N_EditarVisibilidad.php",
           type: 'POST',
           data:{"ID":ID,"Visible":Visible,"Tipo":"Bebidas"},
           success: function (data) {
                        console.log(data);
           }
        });   
    }
        
        $(document).ready(function (){
            
        });
        
        $('.myCheck').each(function(){
            $('.myCheck').bootstrapSwitch();
        })
            
        
        function eliminarBebida(ID){
          
            $("#txtID").val(ID);
            $("#IDCatalogo").val("12");
            swal({  
                title: "¿Desea eliminar esta bebida?",
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
