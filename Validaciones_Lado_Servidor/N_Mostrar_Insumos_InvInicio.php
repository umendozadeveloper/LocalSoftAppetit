<?php 

include_once '../Clases/Insumo.php';
include_once '../Clases/Almacen.php';
include_once '../Clases/UMContent.php';
include_once '../Clases/UnidadMedidaInsumos.php';
include_once '../Clases/Clasificador.php';


class N_Mostrar_Insumos_InvInicio
{
    public $Id_boton;
    public $Insumos = array();
    public $ids_insumos;

    
    public function __construct() {
        $this->main();
    }
    
    public function main() {
        $this->Id_boton = $_POST['id_boton'];
        
        switch($this->Id_boton)
        {
            case "btnTodos":
                $this->ids_insumos="";
                $tabla = "<table border='0' style='width:100%;' id='tabla_insumos_inicio' name='tabla_insumos_inicio' class='tableEncabezadoFijo'>";
                $objInsumo = new Insumo();
                $this->Insumos = $objInsumo->ConsultarTodo();
                
                if(count($this->Insumos)==0)
                {
                    $tabla="0";
                    echo $tabla;
                }
                else{
                
                    foreach($this->Insumos as $insumo)
                    {
                        $objUnidadMedida = new UnidadMedidaInsumo;
                        $objUnidadMedida->ConsultarPorID($insumo->IdUnidadMedida);

                        $objUMContent = new UMContent();
                        $objUMContent->ConsultarPorID($insumo->IdUMContent);

                        $objClasificador = new Clasificador();
                        $objClasificador->ConsultarPorID($insumo->IdClasificador);

                        $tabla.= "<tr>"
                                . "<td style='width:2%;' class='ocultar'><center>".$insumo->ID."</center></td>"
                                . "<td style='width:16%;'><center>".$insumo->Descripcion."</center></td>"
                                . "<td style='width:16%;'><center>".$insumo->Presentacion."</center></td>"
                                . "<td style='width:16%;'><center>".$objUnidadMedida->Descripcion."</center></td>"
                                . "<td style='width:16%;'><center>".$insumo->Contenido." ".$objUMContent->Descripcion."</center></td>"
                                . "<td style='width:16%;'><center>".$objClasificador->Descripcion."</center></td>"
                                ."</tr>";
                        $this->ids_insumos.="─".$insumo->ID;
                    }


                    $tabla.="</table>";
                    echo $tabla. "├".$this->ids_insumos;
                
                }
                break;
            case "btnFiltrar":
                $almacen = $_POST['almacen'];
                $clasificador = $_POST['clasificador'];
                $descripcion = $_POST['descripcion'];
                $objInsumo = new Insumo();
                $this->Insumos = $objInsumo->ConsultarFitro($almacen, $clasificador, $descripcion);
                if(count($this->Insumos)==0)
                {
                    $tabla="0";
                    echo $tabla;
                }
                else{
                    if($almacen=='-1')#la búsqueda no incluye almacén
                    {
                        $tabla = "<table border='0' style='width:100%;' id='tabla_insumos_inicio' name='tabla_insumos_inicio' class='tableEncabezadoFijo'>";
                         foreach($this->Insumos as $insumo)
                        {
                            $objUnidadMedida = new UnidadMedidaInsumo;
                            $objUnidadMedida->ConsultarPorID($insumo['IdUnidadMedida']);

                            $objUMContent = new UMContent();
                            $objUMContent->ConsultarPorID($insumo['IdUMContent']);

                            $objClasificador = new Clasificador();
                            $objClasificador->ConsultarPorID($insumo['IdClasificador']);

                            $tabla.= "<tr>"
                                    . "<td style='width:2%;' class='ocultar'><center>".$insumo['IdInsumo']."</center></td>"
                                    . "<td style='width:16%;'><center>".$insumo['Descripcion']."</center></td>"
                                    . "<td style='width:16%;'><center>".$insumo['Presentacion']."</center></td>"
                                    . "<td style='width:16%;'><center>".$objUnidadMedida->Descripcion."</center></td>"
                                    . "<td style='width:16%;'><center>".$insumo['Contenido']." ".$objUMContent->Descripcion."</center></td>"
                                    . "<td style='width:16%;'><center>".$objClasificador->Descripcion."</center></td>"
                                    ."</tr>";
                            $this->ids_insumos.="─".$insumo['IdInsumo'];
                        }

                        $tabla.="</table>";
                        echo $tabla. "├".$this->ids_insumos;
                    }
                    else{#la búsqueda tiene almacén
                        $tabla = "<table border='0' style='width:100%;' id='tabla_insumos_inicio' name='tabla_insumos_inicio' class='tableEncabezadoFijo'>";
                         foreach($this->Insumos as $insumo)
                        {
                            $objUnidadMedida = new UnidadMedidaInsumo;
                            $objUnidadMedida->ConsultarPorID($insumo['IdUnidadMedida']);

                            $objUMContent = new UMContent();
                            $objUMContent->ConsultarPorID($insumo['IdUMContent']);

                            $objClasificador = new Clasificador();
                            $objClasificador->ConsultarPorID($insumo['IdClasificador']);

                            $tabla.= "<tr>"
                                    . "<td style='width:2%;' class='ocultar'><center>".$insumo['IdInsumo']."</center></td>"
                                    . "<td style='width:16%;'><center>".$insumo['Descripcion']."</center></td>"
                                    . "<td style='width:16%;'><center>".$insumo['Presentacion']."</center></td>"
                                    . "<td style='width:16%;'><center>".$objUnidadMedida->Descripcion."</center></td>"
                                    . "<td style='width:16%;'><center>".$insumo['Contenido']." ".$objUMContent->Descripcion."</center></td>"
                                    . "<td style='width:16%;'><center>".$objClasificador->Descripcion."</center></td>"
                                   /* . "<td style='width:16%;'><center>".$insumo['Almacen']."</center></td>"*/
                                    ."</tr>";
                            $this->ids_insumos.="─".$insumo['IdInsumo'];
                        }

                        $tabla.="</table>";
                        echo $tabla. "├".$this->ids_insumos;
                    }
                }
                break;
            case "btnConExistencia":
                $tabla = "<table border='0' style='width:100%;' id='tabla_insumos_inicio' name='tabla_insumos_inicio' class='tableEncabezadoFijo'>";
                $objInsumo = new Insumo();
                $this->Insumos = $objInsumo->ConsultarActivos();
                if(count($this->Insumos)==0)
                {
                    $tabla="0";
                    echo $tabla;
                }
                else{
                    foreach ($this->Insumos as $insumo)
                    {
                        $objUnidadMedida = new UnidadMedidaInsumo;
                        $objUnidadMedida->ConsultarPorID($insumo->IdUnidadMedida);

                        $objUMContent = new UMContent();
                        $objUMContent->ConsultarPorID($insumo->IdUMContent);

                        $objClasificador = new Clasificador();
                        $objClasificador->ConsultarPorID($insumo->IdClasificador);

                        $tabla.= "<tr>"
                                . "<td style='width:2%;' class='ocultar'><center>".$insumo->ID."</center></td>"
                                . "<td style='width:16%;'><center>".$insumo->Descripcion."</center></td>"
                                . "<td style='width:16%;'><center>".$insumo->Presentacion."</center></td>"
                                . "<td style='width:16%;'><center>".$objUnidadMedida->Descripcion."</center></td>"
                                . "<td style='width:16%;'><center>".$insumo->Contenido." ".$objUMContent->Descripcion."</center></td>"
                                . "<td style='width:16%;'><center>".$objClasificador->Descripcion."</center></td>"
                                ."</tr>";
                        $this->ids_insumos.="─".$insumo->ID;
                    }
                    $tabla.="</table>";
                    echo $tabla. "├".$this->ids_insumos;
                }
                break;
        }
    }
}

$objInsumos = new N_Mostrar_Insumos_InvInicio();