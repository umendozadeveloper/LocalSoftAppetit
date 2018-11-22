<?php

include_once  'SQL_DML.php';
include_once 'Entrada.php';
include_once 'Kardex.php';
include_once 'DetalleEntrada.php';

class DetalleSalida {
    
    public $ID;
    public $IdSalida;
    public $IdInsumo;
    public $PEPS;
    public $DisponiblePEPS;
    public $Detalle_Salida = array();
    public $IdConcepto;
    


    public function RegistrarDetalleSalida($id_salida, $todas_salidas, $fechaDocto, $referencia, $id_usuario, $interfaz_proveniente)
    {
        $this->IdSalida = $id_salida;       
        $ArraySalida = array();
        $ArraySalida = split("├", $todas_salidas);
        
        $array_ids_detalle= array();
        
        $array_auxiliar = array();
        $array_total_aux= array();
        $contador=0;
        foreach($ArraySalida as $salida)
        {
            $objSQL = new SQL_DML();
            $idDetalleSalida = $objSQL->GetScalar("select MAX (ID) as ID from SalidasDetalle");
            
            if($contador!=0)
            {
                $ventas_salidas = array();
                $ventas_salidas = split("─", $salida);
                /*--------------------------------------------------------------
                     * [0] = id_insumo
                     *[1] = cantidad
                     * [2] = costo
                     * [3] = importe
                     * [4] = id_almacen
                 * 
                 * * [5] = id_concepto (sólo funciona cuando vienen los datos de ajusteEntrada)
                --------------------------------------------------------------*/
                $objEntrada = new Entrada();
                $PEPS = $objEntrada->ObtenerPEPS($ventas_salidas[0]);
                $boolDetalleCompleto = false;
                
                foreach ($PEPS as $peps)
                {
                    
                    
                    if(!$boolDetalleCompleto)
                    {
                        if($peps['Disponible'] > $ventas_salidas[1])
                        {
                            $array_auxiliar = array(
                              "ID" => $idDetalleSalida,
                              "IDEntradaDetalle" => $peps['IdEntradaDetalle'],
                              "IdProducto" => $ventas_salidas[0],
                              "Cantidad" => $ventas_salidas[1],
                              "Precio" => $peps['Precio'],
                              "DisponiblePEPS" => $peps['Disponible'] - $ventas_salidas[1],
                            );
                            
                            $boolDetalleCompleto = TRUE;
                        }
                        else{
                            $array_auxiliar = array(
                              "ID" => $idDetalleSalida,
                              "IDEntradaDetalle" => $peps['IdEntradaDetalle'],
                              "IdProducto" => $ventas_salidas[0],
                              "Cantidad" => $peps['Disponible'],
                              "Precio" => $peps['Precio'],
                              "DisponiblePEPS" => 0,
                            );
                            #Cantidad = Cantidad - Disponible
                            $ventas_salidas[1] = $ventas_salidas[1] - $peps['Disponible'];
                        }
                        
                         array_push($array_total_aux, $array_auxiliar);
                    }
                }
                
                # $interfaz_proveniente{
                #   1: entrada
                #   2: salida
                #   3: ajusteEntrada
                #   4: ajusteSalida
                # }

                if($interfaz_proveniente==2){#Salida
                    $this->IdConcepto = 2;
                }else{#Ajuste de salida
                    $this->IdConcepto = $ventas_salidas[5];
                }
                 
                 $query = "Insert into SalidasDetalle (ID, IdSalida, IdInsumo, IdAlmacen,Cantidad, Costo, IdConcepto) Values (".$idDetalleSalida.",".$this->IdSalida
                        .", ".$ventas_salidas[0].", ".$ventas_salidas[4].", ".$ventas_salidas[1].", ".$ventas_salidas[2].",'$this->IdConcepto')";

                $objSQL = new SQL_DML();
                $objSQL->Execute($query);
                
                
                
            }//if del diferente != 0
           
           
            
            $contador++;
        }
        
        
        foreach ($array_total_aux as $aux_kardex)
        {
            $objKardex = new Kardex();
            $objKardex->InsertarKardexPEPS(null,$aux_kardex['ID'], $ventas_salidas[4], $aux_kardex['IdProducto'], $aux_kardex['Cantidad'], $aux_kardex['Precio'],
                $fechaDocto, 3, $referencia,$id_usuario, $aux_kardex['IDEntradaDetalle'],0);

           $objDetalleEntrada = new DetalleEntrada();
           $objDetalleEntrada->ActualizaPEPS($aux_kardex['IDEntradaDetalle'], $aux_kardex['DisponiblePEPS']);

        }
        
    }//metodo

    
    public function ObtenerTotalSalida($id_salida)
    {
        $con = Conexion();
        $query = "  SELECT SUM(Cantidad*Costo) as Total FROM SalidasDetalle WHERE IdSalida=$id_salida";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $total = 0;
        while($Datos = sqlsrv_fetch_array($valor)){
           $total = number_format($Datos['Total'],2,'.',''); 
            
        }
        return $total;
    }
    
    public function ConsultarSDParaInterfaz($id){
        $con = Conexion();
        $query = "Select SD.ID as IdDetalle, I.Descripcion as Insumo, I.Presentacion, SD.Cantidad, SD.Costo, (SD.Cantidad*SD.Costo) as Importe, A.Descripcion as Almacen
		from Salidas S join SalidasDetalle SD on S.ID= SD.IdSalida
		join Insumos I on SD.IdInsumo= I.Id 
		join Almacenes A on A.ID=SD.IdAlmacen where S.ID=$id";

        $temporal_salidas= array();
        $salidasDetalle = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $temporal_salidas = array(
                "IdDetalle" => $Datos['IdDetalle'],
                "Insumo" => utf8_encode($Datos['Insumo']),
                "Presentacion" => utf8_encode($Datos['Presentacion']),
                "Cantidad" => number_format($Datos['Cantidad'],2,'.',''),
                "Costo" => number_format($Datos['Costo'],2,'.',''),
                "Importe" => number_format($Datos['Importe'],2,'.',''),
                "Almacen" => utf8_encode($Datos['Almacen']),
            );

            array_push($salidasDetalle, $temporal_salidas);
            }
        sqlsrv_close($con);
        return $salidasDetalle;
    }
    
}//clase
