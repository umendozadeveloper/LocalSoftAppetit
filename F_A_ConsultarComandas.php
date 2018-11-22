
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
        //require './ComprobarSesion.php';
        require 'Header.php';
        ?>
        
        
        <title>Consultar Comandas</title>
        
        <script src="js/fijo.js"></script>
    </head>
    <body style="background-color: #fff">
        
        
        
        <?php
//require './PartesHTML/LogoBIXA_Barra.php';
        ?>
        
        
        
        <form action="F_A_Comanda_A_Detalle.php" method="GET">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10"><!--class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">-->
                        <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Listado de comandas del día: activas y pagadas</label></center></h4></div>
                            </td>
                        </table>
                    </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                        
                    <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
        <tr>
            <th><div class="centrar"><label>Folio</label></div></th>
            <th><div class="centrar"><label>Mesero</label></div></th>
            <th><div class="centrar"><label>Fecha</label></div></th>
            <th><div class="centrar"><label>No. de mesa</label></div></th>
            <th><div class="centrar"><label>Ubicación</label></div></th>
            <th><div class="centrar"><label>Importe</label></div></th>
            <th><div class="centrar"><label>Estado</label></div></th>
    
        </tr>
    </thead>
    <tbody>
        

        
        <?php
        include_once './Clases/Comanda.php';
        include_once './Clases/VistaComanda_Mesa_ComMesas.php';
        include_once './Clases/ComandaMensajes.php';
        $objVista = new VistaComanda_Mesa_ComMesas();
        $comandasDia = $objVista->ConsultarComandasDelDiaAdmin();
        $objComanda = new Comanda();
        $objComandaMensajes = new ComandaMensajes();
        $arregloComandas = array();
        foreach($comandasDia as $c){
            echo "<tr>";
            echo "<td><button class='noboton' value='$c->IdComanda' name='idComanda'><img src='img/Detalle.ico'></button><button value='$c->IdComanda' name='idComanda' type='submit' class='noboton'>$c->Folio</button></td>";
            echo "<td>$c->NombreMesero</td>";
            echo "<td>$c->Fecha</td>";
            echo "<td>$c->NumeroMesa</td>";
            echo "<td>$c->Ubicacion</td>";
            echo "<td>$".$objComanda->ConsultarImporteComanda($c->IdComanda)."</td>";
            echo "<td>$c->ClaveEstadoComanda</td>";
            array_push($arregloComandas, $c->IdComanda);
            //$comMensaje = $objComandaMensajes->ConsultarPorID($c->IdComanda);
            
                
            
            
            echo "</tr>";
        }
        ?>
        
    
    </tbody>
        </table>
            </div>
            
                <br>
                <br>
                
                <br>
                <br>
                <br>

        </form>        
    </body>
    
    <script>
        $(document).ready(function (){
            
            
                        
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
