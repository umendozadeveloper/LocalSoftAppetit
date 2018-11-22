<?php

include_once  'SQL_DML.php';
class DetalleEntrada {
    
    public $ID;
    public $IdEntrada;
    public $IdInsumo;
    public $Compras;
    public $DisponiblePEPS;
    public $Costo;
    public $Detalle_Entrada = array();
    public $IdConcepto;
    


    public function RegistrarDetalleEntrada($id_entrada, $todas_compras, $interfaz_proveniente) 
    {
       
        $this->IdEntrada = $id_entrada;       
        $ArrayCompras = array();
        $ArrayCompras = split("├", $todas_compras);
//        $this->Detalle_Entrada = array();
        
        $temporal_detalle = array();
        
        $contador =0;
       
        foreach ($ArrayCompras as $comp)
        {
            $compra_entrada = array();
            
            if($contador != 0)
            {
                $compra_entrada = split("─",$comp);
                /*
                 * $compra_entrada{
                     * [0] = id_insumo
                     * [1] = cantidad
                     * [2] = costo
                     * [3] = importe
                     * [4] = id_almacen
                 
                    * [5] = id_concepto (sólo funciona cuando vienen los datos de ajusteEntrada)
                 * }
                */
                
                $objSQL = new SQL_DML();
                $resultado= $objSQL->GetScalar("select MAX (ID) as ID from EntradasDetalle");
                
                # $interfaz_proveniente{
                #   1: entrada
                #   2: salida
                #   3: ajusteEntrada
                #   4: ajusteSalida
                # }
        
        
                if($interfaz_proveniente==1){
                    $this->IdConcepto = 1;
                }else{
                    $this->IdConcepto = $compra_entrada[5];
                }
                
                $query = "insert into EntradasDetalle ".
                "(ID,IdEntrada,IdInsumo,IdAlmacen,Cantidad,DisponiblePEPS,Costo,Importe,IdConcepto) ".
                 "values ('".$resultado."','".$this->IdEntrada."','".$compra_entrada[0]."','".$compra_entrada[4]."','".$compra_entrada[1].
                        "','".$compra_entrada[1]."', '".$compra_entrada[2]."', '".$compra_entrada[3]."','".$this->IdConcepto."')";

                $temporal_detalle = array(
                    "IdDetalle" => $resultado,
                    "IdAlmacen" => $compra_entrada[4],
                    "IdInsumo" => $compra_entrada[0],
                    "Cantidad" => $compra_entrada[1],
                    "Precio" => $compra_entrada[2],
                    "Importe" => $compra_entrada[3],
                );
                
                $objSQL = new SQL_DML();
                $objSQL->Execute($query);
                
                array_push($this->Detalle_Entrada, $temporal_detalle);
            }
            $contador++;
        }
        
        return $this->Detalle_Entrada;
        
    }

    public function ActualizaPEPS($id_entrada_detalle, $disponible_peps){
       
            $this->ID = $id_entrada_detalle;
            $this->DisponiblePEPS = $disponible_peps;
                    
            $query = "UPDATE EntradasDetalle SET DisponiblePEPS = '$this->DisponiblePEPS' Where ID = '$this->ID' ";
            $objSQL = new SQL_DML();
            
            if($objSQL->Execute($query))
                return true;
            else
                return false;

            
    }
    
    
    public function TraerUltimoPrecioPEPS($id_insumo)
    {
        $con = Conexion();
        $this->IdInsumo= $id_insumo;
        $query = "select top 1 Costo from EntradasDetalle where IdInsumo=$this->IdInsumo and DisponiblePEPS!= 0.00 order by ID asc";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->Costo = utf8_encode($Datos['Costo']);
           
            }
            return $this->Costo;
    }
    
    public function ConsultarEDParaInterfaz($id){
        $con = Conexion();
        $query = "Select ED.ID, I.Descripcion as Insumo,I.Presentacion, ED.Cantidad, ED.Costo, 
        ED.Importe, Al.Descripcion as Almacen
        from Almacenes Al join EntradasDetalle ED on Al.ID = ED.IdAlmacen
        join Insumos I on ED.IdInsumo = I.Id
        join Entradas E on E.ID= ED.IdEntrada
        where E.ID= $id";

        $temporal_entradas= array();
        $entradasDetalle = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $temporal_entradas = array(
                "IdDetalle" => $Datos['ID'],
                "Insumo" => utf8_encode($Datos['Insumo']),
                "Presentacion" => utf8_encode($Datos['Presentacion']),
                "Cantidad" => number_format($Datos['Cantidad'],2,'.',''),
                "Costo" => number_format($Datos['Costo'],2,'.',''),
                "Importe" => number_format($Datos['Importe'],2,'.',''),
                "Almacen" => utf8_encode($Datos['Almacen']),
                
            );

            array_push($entradasDetalle, $temporal_entradas);
            }
        sqlsrv_close($con);
        return $entradasDetalle;
    }
    
    public function ConsultarEDParaInterfazAjuste($id){
        $con = Conexion();
        $query = "Select ED.ID, I.Descripcion as Insumo,I.Presentacion, ED.Cantidad, ED.Costo, 
        ED.Importe, Al.Descripcion as Almacen, C.Descripcion as Concepto
        from Almacenes Al join EntradasDetalle ED on Al.ID = ED.IdAlmacen
        join Insumos I on ED.IdInsumo = I.Id
        join Entradas E on E.ID= ED.IdEntrada
        join Conceptos C on C.ID= ED.IdConcepto
        where E.ID=$id";

        $temporal_entradas= array();
        $entradasDetalle = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $temporal_entradas = array(
                "IdDetalle" => $Datos['ID'],
                "Insumo" => utf8_encode($Datos['Insumo']),
                "Presentacion" => utf8_encode($Datos['Presentacion']),
                "Cantidad" => number_format($Datos['Cantidad'],2,'.',''),
                "Costo" => number_format($Datos['Costo'],2,'.',''),
                "Importe" => number_format($Datos['Importe'],2,'.',''),
                "Almacen" => utf8_encode($Datos['Almacen']),
                "Concepto" => utf8_encode($Datos['Concepto']),
                
            );

            array_push($entradasDetalle, $temporal_entradas);
            }
        sqlsrv_close($con);
        return $entradasDetalle;
    }
    
}
