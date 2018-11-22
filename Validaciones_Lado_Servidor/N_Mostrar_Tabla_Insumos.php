<?php 

include_once '../Clases/Insumo.php';
include_once '../Clases/UMContent.php';
include_once '../Clases/Clasificador.php';

class N_Mostrar_Tabla_Insumos
{
    public $id_clasificador;

    
    public function __construct() {
        $this->main();
    }
    
    public function main() {
        $this->id_clasificador = $_POST['id_clasificador'];
        $objClasificador = new Clasificador();
        $objClasificador->ConsultarPorID($this->id_clasificador);
        $objInsumo = new Insumo();
        $insumos = $objInsumo->ConsultarPorClasificador($this->id_clasificador);
        
        if($objClasificador->EsBebida =='1')
        {
            $fila = "<div style='width: 100%; overflow-x: auto;'>".
                "<table class='' border='1' name='tablaInsumos' id='tablaInsumos'>".
                    "<thead class='EncabezadoTablaPersonalizada'>".
                        "<tr>".
                            "<th colspan='6' style='text-align: center;'>SELECCIONAR INSUMOS</th>".
                       "</tr>".
                        "<tr>".
                            "<th style=''><center>Nombre del insumo</center></th>"
                            . "<th style=''><center>Presentacion</center></th>".
                            "<th><center>Contenido</center></th>".
                            "<th style='width:10%;'><center>No.de Copas</center></th>".
                            "<th style='width:10%;'><center>Equivalente en ml</center></th>".
                            "<th style='width:5%;'><center>Seleccione</center></th>".
                        "</tr>".
                    "</thead>".
                    "<tbody>";
   
            foreach($insumos as $ins)
            {
                $objUMC = new UMContent();
                $objUMC->ConsultarPorID($ins->IdUMContent);
               $fila.= "<tr>"
                       . "<td><center>$ins->Descripcion</center></td>"
                       . "<td><center>$ins->Presentacion</center></td>"
                       . "<td><center>$ins->Contenido $objUMC->Descripcion</center></td>"
                       . "<td><input type='text' name='txtCopas$ins->ID' id='txtCopas$ins->ID' class='form-control' /></td>"
                       . "<td><input type='text' name='txtMl$ins->ID' id='txtMl$ins->ID' class='form-control'/></td>"
                       . "<td><input name='chckInsumo$ins->ID' id='chckInsumo' value='$ins->ID' type='checkbox' class='form-control'></td></tr>";


            } 
        }else{
            $fila = "<div style='width: 100%; overflow-x: auto;'>".
                "<table class='' border='1' name='tablaInsumos' id='tablaInsumos'>".
                    "<thead class='EncabezadoTablaPersonalizada'>".
                        "<tr>".
                            "<th colspan='4' style='text-align: center;'>SELECCIONAR INSUMOS</th>".
                       "</tr>".
                        "<tr>".
                            "<th style=''><center>Nombre del insumo</center></th>"
                            . "<th style=''><center>Presentacion</center></th>".
                            "<th><center>Contenido</center></th>".
                            
                            "<th style='width:5%;'><center>Seleccione</center></th>".
                        "</tr>".
                    "</thead>".
                    "<tbody>";
   
            foreach($insumos as $ins)
            {
               $objUMC = new UMContent();
               $objUMC->ConsultarPorID($ins->IdUMContent);
               $fila.= "<tr>"
                       . "<td><center>$ins->Descripcion</center></td>"
                       . "<td><center>$ins->Presentacion</center></td>"
                       . "<td><center>$ins->Contenido $objUMC->Descripcion</center></td>"
                      
                       . "<td><input name='chckInsumo$ins->ID' id='chckInsumo' value='$ins->ID' type='checkbox' class='form-control'></td></tr>";


            } 
        }
        
        
        $fila.= "</tbody>".
                "</table>".
                "</div>";
        echo $fila;
    }
}

$objInsumos = new N_Mostrar_Tabla_Insumos();