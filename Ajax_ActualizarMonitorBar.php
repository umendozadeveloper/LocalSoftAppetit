<?php
include_once 'LlamadoLibrerias.php';
include_once './Clases/ComandaPlatillos.php';
include_once './Clases/CocinaBar.php';
include_once './Clases/Comanda.php';
include_once './Clases/Mesero.php';
include_once './Clases/VistaComanda_Mesa_ComMesas.php';
//include_once './Clases/ComandaPlatillos.php';
//include_once './Clases/Platillo.php';
include_once './Clases/ComandaVinos.php';
include_once './Clases/Vino.php';
include_once './Clases/Tiempos.php';
class Ajax_ActualizarMonitor {
    
    
            
    function main(){
        
        if(isset($_POST['PorComanda'])){
            $this->CambiarPorIdComanda();
        }
        
        
        if(isset($_POST['PorCocina'])){
            $this->CambiarCocina();
        }
        else{
            
        }
        
        
        $this->PintarCocina();
        
    }
    
    function CambiarCocina(){
        $ID = $_POST['ID'];
        $IdEstado = $_POST['IdEstado'];        
        $objCocina = new CocinaBar();
        $objCocina->Modificar($ID,$IdEstado);
    }
    
    function CambiarPorIdComanda(){
        $IdComanda = $_POST['IdComanda'];
        $IdTipo = $_POST['IdTipo'];
        if($IdTipo==2){
            $objComandaVinos = new ComandaVinos();
            $objComandaVinos->EditarEstado($IdComanda, 2);
        }
        
    }
    
    
    function PintarCocina(){
        $objCocinaBar = new CocinaBar();
        $objComanda = new Comanda();
        $objMesero = new Mesero();
        //$objPlatillo = new Platillo();
        $objVino = new Vino();
        $objVistaComandaMesas = new VistaComanda_Mesa_ComMesas();
        //$objComandaPlatillos = new ComandaPlatillos();
        $objComandaVinos = new ComandaVinos();
        $cocina =  $objCocinaBar->ConsultarPorIdTipo(2);
        $totalCocina = $objCocinaBar->ConsultarTodoIdTipo(2);
        $objTiempo = new Tiempos();
 
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
        
        ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-12 ">
    
    <div class="panel">
        <div class="panel-body no-padding-top no-padding-bottom">
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-12'>
                <div  class='thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-12 col-sm-12 col-md-12 col-lg-12 encabezadoCocina' style=''>
                    <label>Ordenadas: <?php echo ($ordenadas);?></label>
                    <label style="padding-left: 100px;">En proceso: <?php echo ($proceso);?> </label>
                </div>
            </div>    
        </div>
    </div>
    
    <div class="panel" style="margin-top:  -70px;">
    <div class="panel-body  no-padding-bottom">
        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-12'>

    <?php         
            echo "<input type='text' class='ocultar' id='txtCocinaNuevo' value='".count($totalCocina)."'>";
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
                echo "<table class='table table-bordered tablaCocina tablaPCocina table-responsive'>";
                echo "<thead>";
                echo "<tr>
                    
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Tiempo</th>
                    <th></th>
                    </tr>";
                echo "</thead>";
                echo "<tbody>";
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
    }
            
            
}

$objActualizarMonitor = new Ajax_ActualizarMonitor();
$objActualizarMonitor->main();



?>
<script>
    $(document).ready(function (){
       $(".tablaPCocina").DataTable({
           searching: false,
           paging: false,
           info:false,
           "orderFixed": [ 0, 'asc' ]
           
       });
    });
</script>