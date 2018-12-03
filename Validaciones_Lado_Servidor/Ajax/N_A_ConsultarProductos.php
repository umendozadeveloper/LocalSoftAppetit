<?php  

include_once '../../Clases/Platillo.php';
include_once '../../Clases/Vino.php';

class MostrarPlatillo {

    public function __construct() {
        $this->main();
    }

    public function main() {
        
        $tipo = '';
        $titulo = '';
        if(isset($_POST['Tipo'])){
            $tipo = $_POST['Tipo'];
        }       
       
        $titulo = $tipo == 0?'platillo':'bebida';
        
        

        $response = '';
        $response .= "<table id='tableConsulta'  class='tablesorter table-bordered table-responsive tablaPaginado tablaConsulta' cellspacing='0' width='100%' >";
        $response .= "<thead style='margin-bottom: 10px;'>";
        $response .= "<tr>";
        $response .= "<th style='width:20%;'><div class='centrar'><label>Nombre de $titulo</label></div></th>";
        $response .= "            <th><div class='centrar'><label>Foto</label></div></th>";
        $response .= "            <th><div class='centrar'><label>Ícono</label></div></th>";
        $response.= "<th></th>";
        $response .= "</tr>";
        $response .= "</thead>";
        $response .= "<tbody id='tbodyConsultar'>";
        if($tipo == '0'){
            $objProducto = new Platillo();        
            $producto = $objProducto->ConsultarTodo();
        }
        else{
            $objProducto = new Vino();        
            $producto = $objProducto->ConsultarTodos();
        }
        
        foreach ($producto as $p) {
            $response .= "<tr>";
            $response .= "<td>$p->Nombre</td>";
            $response .= "<td><div class='imagenesTabla'><img class='' src='$p->Foto'></div></td>";
            $response .= "<td><div class='imagenesTabla'><img class='' src='$p->Icono'></div></td>";
            $response .= "<td class='centrar'><a onclick=\"AgregarProductoCompuesto($p->ID, $tipo, '$p->Nombre')\"><span class='glyphicon glyphicon-plus-sign' style='font-size:22px; color:#419C67; cursor:pointer'></span></a></td>";
            $response .= "</tr>";
        }

        $response .= "</tbody>";
        $response .= "</table>";
        echo $response;
    }

}

$objInsumos = new MostrarPlatillo();


