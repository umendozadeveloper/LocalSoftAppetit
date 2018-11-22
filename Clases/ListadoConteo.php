<?php

include_once  'SQL_DML.php';
include_once 'Empresa.php';
include_once 'Inventario.php';
include_once 'InventarioConteo.php';
require_once "../dompdf/dompdf_config.inc.php";

class ListadoConteo {
    
       
    public function ListadoConteo(){
            
    }

        public function GenerarListado($id_inventario, $incluir_existencias){
        chmod("../xml/",777);
          $objEmpresa = new Empresa();
          $objEmpresa->ObtenerPorID(1);
          
          $objInventario = new Inventario();
          $lista = $objInventario->ObtenerListadoConteo($id_inventario, $incluir_existencias);
          $CodigoHTML ="";

            $contador=0;
            $CodigoHTML .= '<!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
       <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
        <title>Listado para el conteo de insumos</title>
        </head>
        <style>
                *{
                        font-family:Arial, Helvetica, sans-serif;
                }
                #tabla_datos{
                         padding: 3px;
                                margin: 3px;
                                border: 2px solid #000;
                                background-color:#fcfcfc;
                }
                .campos_destacados{
                               /* border-radius: 5px 0px 5px 0px;*/
                                background-color: #cfcfcf;
                                text-align:center;

                        }
                                        .columnas_concepto{
                                border-bottom: 1px solid #000;
                                background-color: #cfcfcf;
                                border-top: 1px solid #000;
                                text-align:center;
                        }
        </style>

        <body>
        <script type="text/php">
            if ( isset($pdf) ) { 
              $font = Font_Metrics::get_font("helvetica", "normal");
              $size = 9;
              $y = $pdf->get_height()-10;
              $x = $pdf->get_width()-65 - Font_Metrics::get_text_width("1/1", $font, $size);
              $pdf->page_text($x, $y, "Hoja {PAGE_NUM} de {PAGE_COUNT}", $font, $size);
            } 
        </script>';
        $CodigoHTML.='<table width="100%" border="0">
          <tr>
            <td width="34%">'. utf8_decode($objEmpresa->NombreComercial).'</td>
            <td colspan="2"><div align="center"></div></td>

            <td width="24%"><div align="right">'. date('d/m/Y') .'</div></td>
          </tr>
          <tr> <td colspan="4">&nbsp;</td></tr>
          <tr>
         
            <td colspan="4"><div align="center"><strong style="font-size:18px;">Listado para el Conteo de Insumos </strong></div></td>

          
          </tr>
        </table>
                <br /><br />
        <table width="100%" border="0" id="tabla_datos">
          <tr>
            <td width="10%" class="campos_destacados"><div align="center">Folio</div></td>
            <td width="15%" class="campos_destacados"><div align="center">Fecha</div></td>
            <td width="75%" class="campos_destacados"><div align="center">Comentarios</div></td>
          </tr>
          <tr>
            <td><div align="center">'.$lista[0]['IDInventario'].'</div></td>
            <td><div align="center">'.date_format($lista[0]['Fecha'], 'd/m/Y').'</div></td>
            <td>'.$lista[0]['Observaciones'].'</td>
          </tr>
        </table>
        <br /><br/>
        <table width="100%" border="0">
          <tr>
            <td class="columnas_concepto">Descripci&oacute;n</td>
            <td class="columnas_concepto">Presentaci&oacute;n</td>
            <td class="columnas_concepto">UM</td>
            <td class="columnas_concepto">Contenido</td>
            <td class="columnas_concepto">Existencia</td>
            <td class="columnas_concepto">Conteo</td>
          </tr>
          <tbody>';
            
          foreach ($lista as $elemento)
          {
                 $CodigoHTML.= '<tr>
                        <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.  utf8_decode($elemento['Descripcion']).'</td>
                        <td align="center" style="border-bottom: 1px solid #cfcfcf;">'. utf8_decode($elemento['Presentacion']).'</td>
                        <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.$elemento['UM'].'</td>
                        <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.$elemento['Contenido'].' '.$elemento['UMC'].'</td>
                        <td align="center" style="border-bottom: 1px solid #cfcfcf;">'.number_format($elemento['Existencia'],2,'.','').'</td>
                        <td align="center" style="border-bottom: 1px solid #cfcfcf;"></td>
                </tr>';
              if($contador>24)
              {
              
                  $residuo = $contador % 25;
                  if($residuo == 0)
                  {
                      $CodigoHTML .= '</tbody></table><div style="page-break-after:always;"></div>
                        <table width="100%" border="0">
                        <tr>
                            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                       <tr>
                        <td class="columnas_concepto">Descripci&oacute;n</td>
                        <td class="columnas_concepto">Presentaci&oacute;n</td>
                        <td class="columnas_concepto">UM</td>
                        <td class="columnas_concepto">Contenido</td>
                        <td class="columnas_concepto">Existencia</td>
                        <td class="columnas_concepto">Conteo</td>
                        </tr>'; 
                  }
                  
              }
              $contador++;
          } 

          $CodigoHTML.='</tbody>
            </table>

           ';
          
          
         
        $CodigoHTML= utf8_encode($CodigoHTML);
//        echo $CodigoHtml_pdf;
//       
      $dompdf = new DOMPDF();
       $dompdf->set_paper("A4","portrait");
       $dompdf->load_html($CodigoHTML);
       ini_set("memory_limit","128M");
       $dompdf->render();
       $pdf = $dompdf->output();
       
       if($incluir_existencias == '0')
       {
           file_put_contents('../pdf_reportes/ListaParaConteoSin'.$id_inventario . '.pdf', $pdf);
           
       }
       else{
           file_put_contents('../pdf_reportes/ListaParaConteoCon'.$id_inventario.'.pdf', $pdf);
           
       }
       
//       $file_to_save = ‘facturas/mi_factura.pdf’;
//file_put_contents($file_to_save, $mipdf->output()); 
////       
//       $bandera = false;
//       if(file_put_contents('../xml/ListaParaConteo.pdf', $pdf) != false)
//       {
//           $bandera = true;
//       }
//       
//       return $bandera;
         
//        return $CodigoHTML;


    }

          
          
          


  
    
        
        
}


