<?php

include_once  'SQL_DML.php';
include_once 'Almacen.php';
include_once 'DetalleEntrada.php';

class Insumo {
    
    public $ID;  
    public $Descripcion;
    public $Presentacion;
    public $IdUnidadMedida;
    public $IdClasificador;
    public $StockMinimo;
    public $StockMaximo;
    public $IdUbicacion;
    public $Status;
    public $Contenido;
    public $IdUMContent;
    public $Observaciones;
    
    public function Insumo(){
            
    }

        public function ConsultarActivos(){
        $con = Conexion();
        $query = "select * from Insumos where Status='1'";
        $insumos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objInsumo = new Insumo();
            $objInsumo->ID = utf8_encode($Datos['Id']);
            $objInsumo->Descripcion = utf8_encode($Datos['Descripcion']);
            $objInsumo->Presentacion = utf8_encode($Datos['Presentacion']);
            $objInsumo->IdUnidadMedida = utf8_encode($Datos['IdUnidadMedida']);
            $objInsumo->IdClasificador = utf8_encode($Datos['IdClasificador']);
            $objInsumo->StockMinimo = $Datos['StockMinimo'];
            $objInsumo->StockMaximo = $Datos['StockMaximo'];
            $objInsumo->IdUbicacion= utf8_encode($Datos['IdUbicacion']);
            $objInsumo->Status = $Datos['Status'];
            $objInsumo->Contenido = $Datos['Contenido'];
            $objInsumo->IdUMContent = $Datos['IdUMContent'];
            $objInsumo->Observaciones = utf8_encode($Datos['Observaciones']);
            array_push($insumos, $objInsumo);
            }
            return $insumos;
        }
        
        public function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from Insumos";
        $insumos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objInsumo = new Insumo();
            $objInsumo->ID = utf8_encode($Datos['Id']);
            $objInsumo->Descripcion = utf8_encode($Datos['Descripcion']);
            $objInsumo->Presentacion = utf8_encode($Datos['Presentacion']);
            $objInsumo->IdUnidadMedida = utf8_encode($Datos['IdUnidadMedida']);
            $objInsumo->IdClasificador = utf8_encode($Datos['IdClasificador']);
            $objInsumo->StockMinimo = $Datos['StockMinimo'];
            $objInsumo->StockMaximo = $Datos['StockMaximo'];
            $objInsumo->IdUbicacion= utf8_encode($Datos['IdUbicacion']);
            $objInsumo->Status = $Datos['Status'];
            $objInsumo->Contenido = $Datos['Contenido'];
            $objInsumo->IdUMContent = $Datos['IdUMContent'];
            $objInsumo->Observaciones = utf8_encode($Datos['Observaciones']);
            array_push($insumos, $objInsumo);
            }
            return $insumos;
        }
        

        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from Insumos where ID = $ID";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['Id']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->Presentacion = utf8_encode($Datos['Presentacion']);
            $this->IdUnidadMedida = utf8_encode($Datos['IdUnidadMedida']);
            $this->IdClasificador = utf8_encode($Datos['IdClasificador']);
            $this->StockMinimo = $Datos['StockMinimo'];
            $this->StockMaximo = $Datos['StockMaximo'];
            $this->IdUbicacion= utf8_encode($Datos['IdUbicacion']);
            $this->Status = $Datos['Status'];
            $this->Contenido = $Datos['Contenido'];
            $this->IdUMContent = $Datos['IdUMContent'];
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $res = true;
            }
            return $res;
        }
        
       
       public function ConsultarPorClasificador($Clasificador){
        $con = Conexion();
        $query =  "Select * from Insumos where IdClasificador='$Clasificador'";
        $insumos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objInsumo = new Insumo();
            $objInsumo->ID = utf8_encode($Datos['Id']);
            $objInsumo->Descripcion = utf8_encode($Datos['Descripcion']);
            $objInsumo->Presentacion = utf8_encode($Datos['Presentacion']);
            $objInsumo->IdUnidadMedida = utf8_encode($Datos['IdUnidadMedida']);
            $objInsumo->IdClasificador = utf8_encode($Datos['IdClasificador']);
            $objInsumo->StockMinimo = $Datos['StockMinimo'];
            $objInsumo->StockMaximo = $Datos['StockMaximo'];
            $objInsumo->IdUbicacion= utf8_encode($Datos['IdUbicacion']);
            $objInsumo->Status = $Datos['Status'];
            $objInsumo->Contenido = $Datos['Contenido'];
            $objInsumo->IdUMContent = $Datos['IdUMContent'];
            $objInsumo->Observaciones = utf8_encode($Datos['Observaciones']);
            array_push($insumos, $objInsumo);
            }
            return $insumos;
        }
        
        public function Insertar($descripcion, $presentacion, $IdUnidadMedida, $Contenido, $IdUMcontenido, $Idclasificador,
            $stock_minimo, $stock_maximo, $Idubicacion, $status,$observaciones){
            
            $this->Descripcion = $descripcion;
            $this->Presentacion = $presentacion;
            $this->IdUnidadMedida = $IdUnidadMedida;
            $this->Contenido = $Contenido;
            $this->IdUMContent = $IdUMcontenido;
            $this->IdClasificador = $Idclasificador;
            $this->StockMinimo = $stock_minimo;
            $this->StockMaximo = $stock_maximo;
            $this->IdUbicacion = $Idubicacion;
            $this->Observaciones = $observaciones;
            $this->Status = $status;
            
            $objSQL = new SQL_DML();
            $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Insumos");

            $query = "INSERT INTO Insumos(Id,Descripcion,Presentacion,IdUnidadMedida,IdClasificador,"
                    . "StockMinimo,StockMaximo,IdUbicacion,Status,Contenido,IdUMContent,Observaciones)".
             "values ('".$resultado."','".$this->Descripcion."','".$this->Presentacion."','".$this->IdUnidadMedida.
                    "','".$this->IdClasificador."','".$this->StockMinimo."','".$this->StockMaximo."'"
                    . ",'".$this->IdUbicacion."','".$this->Status."','".$this->Contenido."','".$this->IdUMContent."','".$this->Observaciones."')";

            if($objSQL->Execute($query))
            {
                $this->ID = $resultado;
                return true;
            }
            else{
                return FALSE;

            }
   
        }
        
        
        public function ModificarPorID($ID,$descripcion, $presentacion, $IdUnidadMedida, $Contenido, $IdUMcontenido, $Idclasificador,
            $stock_minimo, $stock_maximo, $Idubicacion, $status,$observaciones) {
//            $res = FALSE;
            
            $this->ID = $ID;
            $this->Descripcion = $descripcion;
            $this->Presentacion = $presentacion;
            $this->IdUnidadMedida = $IdUnidadMedida;
            $this->Contenido = $Contenido;
            $this->IdUMContent = $IdUMcontenido;
            $this->IdClasificador = $Idclasificador;
            $this->StockMinimo = $stock_minimo;
            $this->StockMaximo = $stock_maximo;
            $this->IdUbicacion = $Idubicacion;
            $this->Status = $status;
            $this->Observaciones = $observaciones;
                    
            
                
                $query = "Update Insumos set Descripcion='".$this->Descripcion."',Presentacion='".$this->Presentacion.
                        "',IdUnidadMedida='".$this->IdUnidadMedida."',Contenido='".$this->Contenido.
                        "',IdUMContent='".$this->IdUMContent."',IdClasificador='".$this->IdClasificador.
                        "',StockMinimo='".$this->StockMinimo."',StockMaximo='".$this->StockMaximo.
                        "',IdUbicacion='".$this->IdUbicacion."',Status='".$this->Status.
                         "',Observaciones='".$this->Observaciones."'  where ID='".$this->ID."'";
                $objSQL = new SQL_DML();
                if($objSQL->Execute($query))
                    return true;
                else
                    return false;
            
            }
            
            
        public function Consultar_Almacen_EntradaDetalle_Insumo(){
            $con = Conexion();
            $query = "Select Distinct ED.IdInsumo, Ins.Descripcion, Alm.ID as IdAlmacen, Alm.Descripcion as AlmacenDescripcion, Ins.Presentacion 
                from Almacenes as Alm,EntradasDetalle as ED, Insumos as Ins 
                where Alm.ID = ED.IdAlmacen and ED.IdInsumo = Ins.Id";
            $insumos = array();
            $tempo_insumos= array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $tempo_insumos = array(
                  "IdInsumo" => utf8_encode($Datos['IdInsumo']),
                  "Descripcion" => utf8_encode($Datos['Descripcion']),
                  "IdAlmacen" => utf8_encode($Datos['IdAlmacen']),
                  "AlmacenDescripcion" => utf8_encode($Datos['AlmacenDescripcion']),
                  "Presentacion" => utf8_encode($Datos['Presentacion']),
                );

                array_push($insumos, $tempo_insumos);
                }
                sqlsrv_close($con);
                return $insumos;
        }
       
        public function ConsultarFitro($almacen, $clasificador, $descripcion)
        {
            $con = Conexion();
            $insumos = array();
            $tempo_insumos= array();
            
            if($almacen=='-1'){#búsqueda sin almacén
                $query= "Select Id as IdInsumo, Descripcion, Presentacion, IdUnidadMedida, Contenido, IdUMContent, IdClasificador from Insumos";
                if($clasificador=='-1' && $descripcion!='-1'){#búsqueda sólo por descripción
                    $query.=" where Descripcion like '%$descripcion%'";
                }
                elseif($clasificador!='-1' && $descripcion=='-1'){#búsqueda por clasificador
                    $query.=" where IdClasificador='$clasificador'";
                }
                elseif($clasificador!='-1' && $descripcion!='-1'){
                    $query.=" where Descripcion like '%$descripcion%' and IdClasificador='$clasificador'";#búsqueda por descripción y clasificador
                }
                
                $valor = sqlsrv_query($con,$query);
                while($Datos = sqlsrv_fetch_array($valor)){
                $tempo_insumos = array(
                  "IdInsumo" => utf8_encode($Datos['IdInsumo']),
                  "Descripcion" => utf8_encode($Datos['Descripcion']),
                  "Presentacion" => utf8_encode($Datos['Presentacion']),
                  "IdUnidadMedida" => utf8_encode($Datos['IdUnidadMedida']),
                  "Contenido" => utf8_encode($Datos['Contenido']),
                  "IdUMContent" => utf8_encode($Datos['IdUMContent']),
                  "IdClasificador" => utf8_encode($Datos['IdClasificador']),
                );
                array_push($insumos, $tempo_insumos);
                }
            }
            else{
                $query="select Distinct ED.IdInsumo, Ins.Descripcion, Ins.Presentacion, Ins.IdUnidadMedida, Ins.Contenido, Ins.IdUMContent, 
                Ins.IdClasificador,Alm.Descripcion as Almacen
                from Insumos Ins join EntradasDetalle ED on Ins.Id = ED.IdInsumo 
                join Almacenes Alm on ED.IdAlmacen = Alm.ID";
                
                if($clasificador=='-1' && $descripcion=='-1'){#búsqueda por almacén
                     $query.=" where Alm.ID='$almacen'";
                 }
                elseif($clasificador=='-1' && $descripcion!='-1'){#búsqueda por almacén y descripción
                    $query.=" where Alm.ID='$almacen' and Descripcion like '%$descripcion%'";
                }
                elseif($clasificador!='-1' && $descripcion=='-1'){#búsqueda por almacén y clasificador
                    $query.="  where Alm.ID='$almacen' and IdClasificador='$clasificador'";
                }
                elseif($clasificador!='-1' && $descripcion!='-1'){
                    $query.="  where Alm.ID='$almacen'and Ins.Descripcion like '%$descripcion%' and IdClasificador='$clasificador'";#búsqueda por almacén, descripción y clasificador
                }
                
                $valor = sqlsrv_query($con,$query);
                while($Datos = sqlsrv_fetch_array($valor)){
                $tempo_insumos = array(
                  "IdInsumo" => utf8_encode($Datos['IdInsumo']),
                  "Descripcion" => utf8_encode($Datos['Descripcion']),
                  "Presentacion" => utf8_encode($Datos['Presentacion']),
                  "IdUnidadMedida" => utf8_encode($Datos['IdUnidadMedida']),
                  "Contenido" => utf8_encode($Datos['Contenido']),
                  "IdUMContent" => utf8_encode($Datos['IdUMContent']),
                  "IdClasificador" => utf8_encode($Datos['IdClasificador']),
                  "Almacen" => utf8_encode($Datos['Almacen']),
                );
                array_push($insumos, $tempo_insumos);
                }
            }
            
                sqlsrv_close($con);
                return $insumos;
        }
        
        
        public function TraerInsumosPorInventarioUM($id_inventario){
            $con = Conexion();
            $query="Select IC.IdInsumo, I.Descripcion, I.Presentacion, UM.Clave as UM
            from InventariosConteo IC join Insumos I on IC.IdInsumo=I.Id
            join UnidadMedidaInsumos UM on I.IdUnidadMedida=UM.ID
            where IC.IdInventario = '$id_inventario'";
            
            $tempo_array = array();
            $array_insumos = array();
            
            
             $valor = sqlsrv_query($con,$query);
                while($Datos = sqlsrv_fetch_array($valor)){
                $tempo_array = array(
                  "IdInsumo" => utf8_encode($Datos['IdInsumo']),
                  "Descripcion" => utf8_encode($Datos['Descripcion']),
                  "Presentacion" => utf8_encode($Datos['Presentacion']),
                  "IdUnidadMedida" => utf8_encode($Datos['UM']),                 
                );
                array_push($array_insumos, $tempo_array);
                }
            
            
            sqlsrv_close($con);
            return $array_insumos;
        }
        
        public function Eliminar($id)
        {
            $this->Id = $id;
            
            $objSQL = new SQL_DML();
        
            $query = "delete Insumos where Id ='".$this->Id."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }
}


