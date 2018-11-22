<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include_once 'LlamadoLibrerias.php';
include_once './Clases/CocinaBar.php';
include_once './Clases/Comanda.php';
include_once './Clases/Mesero.php';
include_once './Clases/VistaComanda_Mesa_ComMesas.php';
//include_once './Clases/ComandaPlatillos.php';
//include_once './Clases/Platillo.php';
include_once './Clases/ComandaVinos.php';
include_once './Clases/Vino.php';
include_once './Clases/Tiempos.php';
include_once './Clases/Seguridad.php';
include_once './Clases/Empresa.php';
$objEmpresa = new Empresa();
$objEmpresa->ObtenerPorID(1);
$objCocinaBar = new CocinaBar();
$objComanda = new Comanda();
$objMesero = new Mesero();
//$objPlatillo = new Platillo();
$objVino = new Vino();
$objTiempo = new Tiempos();
$objVistaComandaMesas = new VistaComanda_Mesa_ComMesas();
//$objComandaPlatillos = new ComandaPlatillos();
$objComandaVinos = new ComandaVinos();
$cocina =  $objCocinaBar->ConsultarPorIdTipo(2);
$totalCocina = $objCocinaBar->ConsultarTodoIdTipo(2);
$ordenadas = 0;
$proceso = 0;
foreach ($totalCocina as $tCocina){
    if($tCocina->IdEstado==1){
        $ordenadas++;
    }
    if($tCocina->IdEstado == 2){
        $proceso++;
    }
}
/*$ordenadas = $objCocinaBar->ConsultarOrdenadas(1);
$proceso = $objCocinaBar->ConsultarProceso(1);*/

?>
<input type="text" id="txtCocinaInicial" class="ocultar" value="<?php echo count($totalCocina);?>">
<div id="PintarCocina">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-12 ">
    
    <div class="panel">
        <div class="panel-body no-padding-top no-padding-bottom">
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-12'>
                <div  class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-12 col-sm-12 col-md-12 col-lg-12 encabezadoCocina' style=''>
                    <label>Ordenadas: <?php echo ($ordenadas);?></label>
                    <label style="padding-left: 100px;">En proceso: <?php echo ($proceso);?> </label>
                    
                    <?php if($_SESSION['ScriptAdmin']=="/Sistema_BIXA/F_A_LoginBar.php") {?>
                    <label style="float: right;"><a href="CerrarSesionBar.php" style="color: white;">SALIR</a></label>
                    <?php } else { ?>
                    <label style="float: right;"><a href="F_A_PaginaPrincipal.php" style="color: white;">Regresar</a></label>
                    <?php } ?>
                </div>
            </div>    
        </div>
    </div>
    
    <div class="panel" style="margin-top:  -70px;">
    <div class="panel-body  no-padding-bottom">
        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-12'>
            
            
            <?php 
            
            
            foreach ($cocina as $c){
                $objComanda->ConsultarPorID($c->IdComanda);
                $objMesero->ConsultarPorID($objComanda->IdMesero);
                $objVistaComandaMesas->ConsultarPorID($objComanda->Id);
                $Productos = explode(",",$c->IdProductos);
                echo "<div  class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-6 col-sm-6 col-md-6 col-lg-offset-0 col-lg-4 comandaMonitorCompleta' style=''>";
                echo "<div class='encabezadoMonitor' style=''>";
                echo "<div class='ComandaMonitor' style=''>Comanda: $objComanda->Folio</div>";
                echo "<div class='ComandaMesero' style=''> Mesero: $objMesero->Nombre $objMesero->Apellidos<br>Mesa: $objVistaComandaMesas->NumeroMesa<br>Hora: $c->Fecha</div>";
                echo "</div>";
                echo "<div class='CuerpoMonitor' style=''>";
                echo "<table class='table table-bordered tablaCocina table-responsive tablaPCocina'>";
                echo "<thead>";
                echo "<tr>
                    <th>Cantidad copas</th>
                    <th>Cantidad botellas</th>
                    <th>Producto</th>
                    <th></th>
                    </tr>";
                echo "</thead>";
                
                echo "<tbody>";
                //$tiempoBandera = array();
                 foreach ($Productos as $p){
                    $objComandaVinos->ConsultarPorID($p);
                    /*if(!in_array($objComandaPlatillos->IdTiempo, $tiempoBandera)){
                        array_push($tiempoBandera, $objComandaPlatillos->IdTiempo);
                    }*/
                    
                    //in_array($p, $tiempoBandera)
                    $objVino->ConsultarPorID($objComandaVinos->IdVino);
                    //$objTiempo->ConsultarPorID($objComandaVinos->IdTiempo);
                    
                   
                    
                    echo "<tr>";
                    //echo "<td rowspan='1' class='ocultar'>$objComandaPlatillos->IdTiempo</td>";
                    
                    if($objComandaVinos->IdEstado==3)
                    {
                        echo "<td>$objComandaVinos->CantidadCopas</td>";
                        echo "<td>$objComandaVinos->CantidadBotellas</td>";
                        echo "<td rowspan='1'>$objVino->Nombre <br>";
                        if($objComandaVinos->Comentarios!=""){
                            echo "<label style='color:red'>($objComandaVinos->Comentarios)<label>";   
                        }
                    echo "</td>";
                    //echo "<td>$objTiempo->Clave</td>";
                        if($c->IdEstado==2)
                        {
                            echo "<td><button onclick='cambiarEstadoProducto($objComandaVinos->ID,2);'><span class='glyphicon glyphicon-remove'></span></button></td>";
                        }
                        else{
                            echo "<td></td>";
                        }
                    }
                    else{
                        
                        echo "<td class='Preparado'>$objComandaVinos->CantidadCopas</td>";
                        echo "<td class='Preparado'>$objComandaVinos->CantidadBotellas</td>";
                        echo "<td class='Preparado'>$objVino->Nombre";
                        if($objComandaVinos->Comentarios!=""){
                            echo "<label style='color:red'>($objComandaVinos->Comentarios)<label>";   
                        }
                        echo "</td>";
                        //echo "<td class='Preparado'>$objTiempo->Clave</td>";
                        echo "<td class='Preparado'></td>";
                        
                    }
                    echo "</tr>";
                    
                }
                
                /*sort($tiempoBandera);
                    for($i = 0; $i<count($tiempoBandera)-1; $i++){    
                        //echo $tiempoBandera[$i]+0.1;
                        echo "<tr>";
                        echo "<td rowspan='1' class='ocultar'>".($tiempoBandera[$i]+0.1)."</td>";
                        echo "<td class='tiempoSeparador' colspan=''></td>";
                        echo "<td class='tiempoSeparador' colspan=''></td>";
                        echo "<td class='tiempoSeparador' colspan=''></td>";
                        echo "<td class='tiempoSeparador' colspan=''></td>";
                        echo "</tr>";
                    }*/
                echo "</tbody>
                            </table>
                        </div>
                    <div class='OpcionesMonitor' style=''>
                        <table class='table table-condensed' style='background-color: whitesmoke;'>
                            <thead>
                                <tr>";
                                    if($c->IdEstado==1){
                                        echo "<th><button  id='btnOrdenada$c->ID'  class='btn btnCocina EstadoDeComandaActivo' >Ordenada</button></th>";
                                        echo "<th><button id='btnProceso$c->ID' onclick='cambiarEstadoCocina($c->ID,2);' class='btn btnCocina'>Proceso</button></th>";
                                    }
                                    else{
                                        echo "<th><button disabled id='btnOrdenada$c->ID'  class='btn btnCocina ' >Ordenada</button></th>";
                                    }
                                    
                                    if($c->IdEstado == 2){
                                        echo "<th><button id='btnProceso$c->ID' onclick='cambiarEstadoCocina($c->ID,2);' class='btn btnCocina EstadoDeComandaActivo'>Proceso</button></th>";
                                    }
                                    
                                    echo "<th><button id='btnTerminada$c->ID' onclick='cambiarEstadoCocina($c->ID,3);' class='btn btnCocina'>Terminada</button></th>";
                                echo "</tr>
                            </thead>
                        </table>
                    </div>
                </div>";
            }
            ?>
        </div>
            </div>
    </div>
    </div>
</div>
<?php
    

?>
<audio class="my_audio ocultar" controls preload="none">
    <source src="<?php  echo substr($objEmpresa->TonoCocina,3);?>" type="audio/mpeg" >
</audio>
<script>
    setInterval("SoloActualizar()",30000);    
    
    
    function cambiarEstadoCocina(ID,IdEstado){
        
        if(IdEstado!=3){
            $.ajax({
                type:"POST",
                url: "Ajax_ActualizarMonitorBar.php",
                data:{"ID":ID,"IdEstado":IdEstado,"PorCocina":1},
                success: function (data) {
                    $("#PintarCocina").html(data);
                       var Actual = $("#txtCocinaInicial").val();
                            var Nuevo = $("#txtCocinaNuevo").val();

                            if(Nuevo>Actual){
                                $(".my_audio").trigger('load');
                                $(".my_audio").trigger('play');
                                $("#txtCocinaInicial").val(Nuevo);
                            }
                    }
                });
        }
        else{
                       swal({   
		title: '',   
		text: '¿Desea dar por terminada la comanda en bar?',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: 'Si', 
                confirmButtonColor: "#00467D",
		cancelButtonText: 'No',   
		closeOnConfirm: true,   
		closeOnCancel: true },
            function(isConfirm){   
                    
                if (isConfirm) {   
                                      $.ajax({
                type:"POST",
                url: "Ajax_ActualizarMonitorBar.php",
                data:{"ID":ID,"IdEstado":IdEstado,"PorCocina":1},
                success: function (data) {
                    $("#PintarCocina").html(data);
                       var Actual = $("#txtCocinaInicial").val();
                            var Nuevo = $("#txtCocinaNuevo").val();

                            if(Nuevo>Actual){
                                $(".my_audio").trigger('load');
                                $(".my_audio").trigger('play');
                                $("#txtCocinaInicial").val(Nuevo);
                            }
                    }
                });  
                    }                              
            });
            
        }
    }
    
    function SoloActualizar(){
            
            $.ajax({
            type:"POST",
            url: "Ajax_ActualizarMonitorBar.php",
            success: function (data) {
                $("#PintarCocina").html(data);
                   var Actual = $("#txtCocinaInicial").val();
                        var Nuevo = $("#txtCocinaNuevo").val();
                        
                        if(Nuevo>Actual){
                            $(".my_audio").trigger('load');
                            $(".my_audio").trigger('play');
                            $("#txtCocinaInicial").val(Nuevo);
                        }
                }
        });
    }
    
    function cambiarEstadoProducto(IdComanda,IdTipo){
        
        
        $.ajax({
            type:"POST",
            url: "Ajax_ActualizarMonitorBar.php",
            data:{"IdComanda":IdComanda,"IdTipo":IdTipo,"PorComanda":1},
            success: function (data) {
                        $("#PintarCocina").html(data);
                        var Actual = $("#txtCocinaInicial").val();
                        var Nuevo = $("#txtCocinaNuevo").val();
                        
                        if(Nuevo>Actual){
                            $(".my_audio").trigger('load');
                            $(".my_audio").trigger('play');
                            $("#txtCocinaInicial").val(Nuevo);
                        }
                    }
        });
    }
    
    $(document).ready(function (){
       $(".tablaPCocina").DataTable({
           searching: false,
           paging: false,
           info:false,
           "orderFixed": [ 0, 'asc' ]
           
       });
    });
</script>

<style>
  ::-webkit-scrollbar{
  width: 10px;
  background: transparent;
}
::-webkit-scrollbar-button{
  width:2px;
  height: 5px;
}
::-webkit-scrollbar-track{
  background:white;
  border:thin solid black;
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  -webkit-border-radius: 10px;
  border-radius: 10px;
}
::-webkit-scrollbar-thumb{
  background: -webkit-linear-gradient(top,rgba(255,255,255,.3) ,rgba(0,67,103,.8));
  -webkit-box-shadow:   inset 0 1px 0 rgba(0,67,103,.5),
                inset 1px 0 0 rgba(0,67,103,.4),
                inset 0 1px 2px rgba(0,67,103,.3);
 
  border:thin solid #232c34;
  border-radius: 10px;
  -webkit-border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover{
    background: -webkit-linear-gradient(top, rgba(0,67,150,1) ,rgba(0,60,103,1));
}
/* Pseudo-clase */
::-webkit-scrollbar-thumb:window-inactive {
  background: rgba(155,155,155,.6);
}
</style>