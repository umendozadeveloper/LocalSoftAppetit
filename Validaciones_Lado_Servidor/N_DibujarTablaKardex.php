
<?php 

include_once '../Clases/Insumo.php';
include_once '../Clases/Kardex.php';

class N_DibujarTablaKardex
{
    public $Id_insumo;
    public $Rango_fecha_inicial;
    public $Rango_fecha_final;
    public $Todos;
    public $Kardex = array();



    public function __construct() {
        $this->main();
    }
    
    public function main() {
        $this->Id_insumo = $_POST['IdInsumo'];
        $this->Todos = $_POST['todos'];
        $this->Rango_fecha_inicio = $_POST['FechaInicial'];
        $this->Rango_fecha_final = $_POST['FechaFinal'];
        
        $tabla ="";
        
        $tabla = "
           <table border='0' class='tableEncabezadoFijo' name='tabla_kardex' id='tabla_kardex' style=' width:110%; padding: 200em;'>
        <tbody>";
        
        $objKardex = new Kardex();
        $this->Kardex= $objKardex->ObtenerKardex($this->Todos, $this->Rango_fecha_inicio, $this->Rango_fecha_final, $this->Id_insumo);
        
        foreach ($this->Kardex as $kard)
        {
            $tabla .= "<tr>
            <td style='font-size:12px; width:7%; height:40px;'><center>".date_format($kard['FechaDocumento'],'d/m/Y')."</center></td>
            <td style='font-size:12px; width:6%;'><center>".$kard['EntradaCantidad']."</center></td>
            <td style='font-size:12px; width:7%;'><center>".$kard['EntradaPrecio']."</center></td>
            <td style='font-size:12px; width:8%;'><center>".number_format($kard['EntradaImporte'],2,'.','')."</center></td>
            <td style='font-size:12px; width:6%;'><center>".$kard['SalidaCantidad']."</center></td>
            <td style='font-size:12px; width:7%;'><center>".$kard['SalidaPrecio']."</center></td>
            <td style='font-size:12px; width:8%;'><center>".number_format($kard['SalidaImporte'],2,'.','')."</center></td>
            <td style='font-size:12px; width:6%;'><center>".$kard['Existencia']."</center></td>
            <td style='font-size:12px; width:7%;'><center>".$kard['Costo']."</center></td>
            <td style='font-size:12px; width:8%;'><center>".number_format($kard['Importe'],2,'.','')."</center></td>
            <td style='font-size:12px; width:8%;'><center>".$kard['Referencia']."</center></td>
            <td style='font-size:12px; width:7%;'><center>".$kard['Usuario']."</center></td>
            <td style='font-size:12px;width:10%;'><center>".date_format($kard['FechaSistema'],'d/m/Y')."</center></td>
           
        </tr>";
        }
        
        
     $tabla.="</tbody></table>";
     echo $tabla;
    }
}

$objDibujar_kardex = new N_DibujarTablaKardex();

