
<?php 

include_once '../Clases/InventarioEstados.php';
include_once '../Clases/Inventario.php';

class N_Cargar_Final_Inventario
{
    public $Id_inventario;
    public $ConFaltante;
    public $SinDiferencia;
    public $ConExcedente;
    



    public function __construct() {
        $this->main();
    }
    
    public function main() {
        $this->Id_inventario = $_POST['ID'];
        $this->ConFaltante = $_POST['con_faltante'];
        $this->SinDiferencia = $_POST['sin_diferencia'];
        $this->ConExcedente = $_POST['con_excedente'];
        
        $tabla ="";
        
        $tabla = "
          <table border='0' style='width:100%;' id='tabla_insumos_inicio' name='tabla_insumos_inicio' class='tableEncabezadoFijo' >
        <tbody>";
        
        $objInventario = new Inventario(); 
        $inventario_insumos = $objInventario->ObtenerProductosParaCierre($this->Id_inventario,$this->ConExcedente,  $this->ConFaltante,$this->SinDiferencia);
                   
        foreach($inventario_insumos as $ins)
       {
           if($ins['Importe']==0)
           {
               $color_fondo = "#FFF";
           }
           elseif($ins['Importe']>0)
           {
               $color_fondo = "#B7FFFC";
           }
           elseif($ins['Importe']<0)
           {
               $color_fondo = "#D0D0D0";
           }

           $tabla.= "<tr style=' background-color:$color_fondo;'>";

           $tabla.= "<td style='width:19.6%;'><center>".$ins['Descripcion']."</center></td>";
           $tabla.= "<td style='width:12%;'><center>".$ins['Presentacion']."</center></td>";
           $tabla.= "<td style='width:7%;'><center>".$ins['UM']."</center></td>";
           $tabla.= "<td style='width:12%;'><center>".number_format($ins['Sistema'],2,'.','')."</center></td>";
           $tabla.= "<td style='width:12%;'><center>".number_format($ins['Fisico'],2,'.','')."</center></td>";
           $tabla.= "<td style='width:11.6%;'><center>".number_format($ins['Costo'],2,'.','')."</center></td>";



           $tabla.= "<td style='width:10%;' ><center>".number_format($ins['Importe'],2,'.','')."</center></td>";
           $tabla.= "<td style='width:0.1%;'></td>";
           $tabla.= "</tr>";
       }
        
       $tabla.= "</tbody></table>";
     echo $tabla;
    }
}

$objCargarFinalInventario = new N_Cargar_Final_Inventario();



/*
 * <?php 
//                   
                   
                ?>
 */