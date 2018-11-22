<?php
include_once '../Clases/SubMenu.php';

class CambiarPrioridad{
    
    
    
    function main(){
        $ID = $_POST['ID'];
        
        $objSubmenu = new SubMenu();
        if(isset($_POST['Accion'])){
            $Accion = $_POST['Accion'];
            $objSubmenu->EditarPrioridadPorID($ID, $Accion);
        }
    }
    
    function imprimirTabla(){
        $objSubMenu = new SubMenu();
        $arreglo = null;
        $IdMenuP = 1;
        if(isset($_POST['IdMenuP'])){
            $IdMenuP = $_POST['IdMenuP'];
        }
        if(isset($_POST['Arreglo'])){
            $arreglo = $_POST['Arreglo'];
        }
        $ID = $_POST['ID'];
        $objSubMenu->ConsultarSubMenuPorID($IdMenuP);
        $subMenus = $objSubMenu->ConsultarSubMenuPorIDPadreArreglo($IdMenuP);
        
        ?>
<table class="table table-condensed table-bordered tablaPaginadoPrioridad">
    <thead>
        
        <tr>
            <th colspan="4"><center>Ordenar menús: <?php echo $objSubMenu->Ruta; ?></center>
                <a class="btn icon-btn btn-default" style="float: right;" href="#" role="button" data-toggle="modal" data-target="#ModalOrdenar">
                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-info">        
                    </span>
                    Ubicar
                </a>
            </th>
        </tr>
        <tr>
            
            <th>Nombre del menú</th>
            <th width='10%'><center>Visible</center></th>
            <th width='10%'><center>Prioridad</center> </th>
        </tr>
        
    </thead>
    <tbody>
    
        <?php 
        $i = 0;
        
        foreach ($subMenus as $s){    
                echo "<tr>";
                //echo "<td>";
                
                //echo "</td>";
                echo "<td>";
                if(count($objSubMenu->ConsultarSubMenuPorIDPadreTodo($s->ID))>0){
                    echo "<a class='btn btn-xs btn-Bixa botonDesplegar' href='F_A_OpcionesMenuPlatillos.php?MenuP=$s->ID'><span class='glyphicon glyphicon-plus'></span></a>   ";
                }
                echo "$s->Clave";
                echo "</td>";
                
                
                
                if($s->Visible==1)
                {
                    echo "<td><center><input class='myCheck' id='check$s->ID' onchange='cambioVisible($s->ID);'  type='checkbox' name='myCheckName' value='$s->Visible'  checked></td>";
                }
                else{
                    echo "<td><center><input class='myCheck' id='check$s->ID' onchange='cambioVisible($s->ID);'  type='checkbox' name='myCheckName' value='$s->Visible'  ></td>";
                    //echo "<td><input class='myCheck  id='check$s->ID' onchange='cambioVisible($s->ID);'  type='checkbox' name='myCheckName' value='0'></td>";
                }
                
                echo "<td><center>";
                if($i!=  count($subMenus)-1)
                echo "<button onclick='cambiarPrioridad(1,$s->ID);' class='btn btn-default btn-xs'><span style='color:red;' class='glyphicon glyphicon-arrow-down'></span></button>";
                if($i!=0)
                echo "<button onclick='cambiarPrioridad(0,$s->ID);' class='btn btn-default btn-xs'><span style='color:green;' class='glyphicon glyphicon-arrow-up'></span></button>";
                
                echo  "</center></td>";
                echo "</tr>";
                
                
                $i++;
            
            
        }
       ?>
    </tbody>
</table>
        

<script>
        $('.tablaPaginadoPrioridad').DataTable( {
        "sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
        "order":[[2,"asc"]]
    });
    
            $(".myCheck").bootstrapSwitch({     
        });

</script>
        <?php
    }
}

$objCambiarPrioridad = new CambiarPrioridad();
$objCambiarPrioridad->main();

$objCambiarPrioridad->imprimirTabla();
?>