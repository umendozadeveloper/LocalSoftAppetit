<?php

include_once  'SQL_DML.php';
include_once 'KardexTipoMovimiento.php';
include_once 'EntradaCompras.php';


class Kardex {
    
    public $ID;
    public $IdEntradaDetalle;
    public $IdSalidaDetalle;
    public $IdAlmacen;
    public $IdInsumo;
    public $Cantidad;
    public $Precio;
    public $FechaDocumento;
    public $FechaSistema;
    public $Existencia;
    public $IdTipoMovimiento;
    public $Referencia;
    public $IdUsuario;
    public $IdOrigenProducto;
    
    public $CostoPromedio;
    public $CostoTotal;


    public $ArrayKardex = array();
    


    public function Kardex(){
            
    }
    
    public function InsertarKardexPEPS($id_entradaDetalle, $id_salidaDetalle, $id_almacen, $id_insumo, $cantidad,
            $precio, $fecha_documento,$id_tipoMovimiento, $referencia, $id_usuario, $id_origenProducto,$origen_entrada_salida){
        
        $UltimaExistencia=0.0;
        $NuevaExistencia = 0.0;
       
        
        $this->IdEntradaDetalle = $id_entradaDetalle;
        $this->IdSalidaDetalle = $id_salidaDetalle;
        $this->IdAlmacen = $id_almacen;
        $this->IdInsumo = $id_insumo;
        $this->Cantidad = $cantidad;
        $this->Precio = $precio;
        $this->FechaDocumento = $fecha_documento;
        $this->IdTipoMovimiento = $id_tipoMovimiento;
        $this->Referencia = $referencia;
        $this->IdUsuario = $id_usuario;
        $this->IdOrigenProducto = $id_origenProducto;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Kardex");
        $this->ID = $resultado;
        
        
        #Busca si hay insumos registrados en el kardex
        $con = Conexion();
        if($origen_entrada_salida==1)
        {
//            $query = "select k.ID, k.Existencia From Kardex as k  Where k.IdInsumo=$this->IdInsumo and k.IdAlmacen =$this->IdAlmacen and k.ID = (select max(k1.ID) from Kardex k1 Where k1.IdInsumo = k.IdInsumo and k1.IdAlmacen = k.IdAlmacen)";
             $query = "select k.ID, k.Existencia From Kardex as k  Where k.IdInsumo=$this->IdInsumo and k.ID = (select max(k1.ID) from Kardex k1 Where k1.IdInsumo = k.IdInsumo)";
        }
        else{
            $query = "select k.ID, k.Existencia From Kardex as k  Where k.IdInsumo=$this->IdInsumo and k.ID = (select max(k1.ID) from Kardex k1 Where k1.IdInsumo = k.IdInsumo)";
        }
        
        $existencia = array();
        $valor = sqlsrv_query($con,$query);
     
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $existencia[0] = utf8_encode($Datos['ID']);
            $existencia[1] = utf8_encode($Datos['Existencia']);
        }
          sqlsrv_close($con);
        
        $hay_elementos=  count($existencia);
        if($hay_elementos == 0)//No hay insumos registrados en el kardex
        {
            $this->Existencia = 0;
        }else{//Hay insumos en el kardex
            $this->Existencia = $existencia[1];
           
        }
       
        $UltimaExistencia = $this->Existencia;
        
       
        $objTipoMovimiento = new KardexTipoMovimiento();
        $objTipoMovimiento->ConsultarPorID($this->IdTipoMovimiento);
        
        #El tipoMovimiento es SALIDA Y es cancelación
        if($objTipoMovimiento->EntradaSalida == 'S' && $objTipoMovimiento->Cancelacion == true){
            $NuevaExistencia = $UltimaExistencia - $this->Cantidad;
        }
        #Es ENTRADA y es cancelación
        elseif($objTipoMovimiento->EntradaSalida == 'E' && $objTipoMovimiento->Cancelacion == true){
            $NuevaExistencia = $UltimaExistencia + $this->Cantidad;
        }
        #Es ENTRADA
        elseif($objTipoMovimiento->EntradaSalida == 'E')
        {
             $NuevaExistencia = $UltimaExistencia + $this->Cantidad;
        }
        else{ #Es SALIDA
            $NuevaExistencia = $UltimaExistencia - $this->Cantidad;
        }
        
        $this->Existencia = $NuevaExistencia;
         
        if($origen_entrada_salida==1)//Entrada
        {
           $query = "INSERT INTO Kardex ( ID, IdEntradaDetalle, IdSalidaDetalle, IdAlmacen, IdInsumo, Cantidad, Precio, 
            FechaDocumento, FechaSistema, Existencia, IdTipoMovimiento, Referencia , IdUsuario, IdOrigenProducto)   
            VALUES ( $this->ID,'$this->IdEntradaDetalle' ,NULL, '$this->IdAlmacen', '$this->IdInsumo','$this->Cantidad' ,"
                . " '$this->Precio','$this->FechaDocumento' , getdate(), '$this->Existencia',  '$this->IdTipoMovimiento',"
                . " '$this->Referencia','$this->IdUsuario','$this->IdOrigenProducto')"; 
        }
        else{//salida
            $query = "INSERT INTO Kardex ( ID, IdEntradaDetalle, IdSalidaDetalle, IdAlmacen, IdInsumo, Cantidad, Precio, 
            FechaDocumento, FechaSistema, Existencia, IdTipoMovimiento, Referencia , IdUsuario, IdOrigenProducto)   
            VALUES ( $this->ID,NULL,'$this->IdSalidaDetalle', '$this->IdAlmacen', '$this->IdInsumo','$this->Cantidad' ,"
                . " '$this->Precio','$this->FechaDocumento' , getdate(), '$this->Existencia',  '$this->IdTipoMovimiento',"
                . " '$this->Referencia','$this->IdUsuario','$this->IdOrigenProducto')"; 
        }
        
        
        if($objSQL->Execute($query))
        {
           
            return true;
        }
        else{
            return FALSE;
            
        }
      
    }

     
    public function ObtenerKardex($todos,$fecha_inicio, $fecha_fin, $idinsumo){
        
        $this->IdInsumo = $idinsumo;
        
        $tempo = split("/", $fecha_inicio);
        $rangoInicial = $tempo[2] . $tempo[1] . $tempo[0];
        
        $tempo = split("/", $fecha_fin);
        $rangoFinal = $tempo[2] . $tempo[1] . $tempo[0];
        
        $query = "Select 
                k.FechaDocumento,
                (Case when ktm.EntradaSalida = 'E' then k.Cantidad else null end) as EntradaCantidad,
                (Case when ktm.EntradaSalida = 'E' then k.Precio else null end) as EntradaPrecio,
                (Case when ktm.EntradaSalida = 'E' then (k.Cantidad * k.Precio) else null end) as EntradaImporte,
                (Case when ktm.EntradaSalida = 'S' then k.Cantidad else null end) as SalidaCantidad,
                (Case when ktm.EntradaSalida = 'S' then k.Precio else null end) as SalidaPrecio,
                (Case when ktm.EntradaSalida = 'S' then (k.Cantidad * k.Precio) else null end) as SalidaImporte,
                k.Existencia, 
                k.Precio as Costo, 
                (k.Existencia * k.Precio) as Importe,
                k.Referencia,
                u.Usuario as Usuario,
                k.FechaSistema,
                Cast($todos as bit) as Todos,
                Convert (DateTime,'$rangoInicial',112)  as Inicio,
                Convert (DateTime,'$rangoFinal',112)  as Fin   
                from Kardex k  join KardexTipoMovimiento ktm 
                on k.IdTipoMovimiento = ktm.ID  join Usuarios u 
                on k.IdUsuario = u.id  
                Where k.IdInsumo = $this->IdInsumo ";
         if($todos == 0)
         {
             $query .="And k.FechaDocumento between  Convert (DateTime,'$rangoInicial',112) And  Convert (DateTime,'$rangoFinal',112)";
         }
         $query.="order by k.Id";
        
        $con = Conexion();
        $valor = sqlsrv_query($con,$query);
     
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $datosKardex = array(
                "FechaDocumento" => $Datos['FechaDocumento'],
                "EntradaCantidad" => $Datos['EntradaCantidad'],
                "EntradaPrecio" => $Datos['EntradaPrecio'],
                "EntradaImporte" => $Datos['EntradaImporte'],
                "SalidaCantidad" => $Datos['SalidaCantidad'],
                "SalidaPrecio" => $Datos['SalidaPrecio'],
                "SalidaImporte" => $Datos['SalidaImporte'],
                "Existencia" => $Datos['Existencia'],
                "Costo" => $Datos['Costo'],
                "Importe" => $Datos['Importe'],
                "Referencia" => $Datos['Referencia'],
                "Usuario" => $Datos['Usuario'],
                "FechaSistema" => $Datos['FechaSistema'],
                "Todos" => $Datos['Todos'],
                "Inicio" => $Datos['Inicio'],
                "Fin" => $Datos['Fin'],
                );
            
            array_push($this->ArrayKardex, $datosKardex);
        }
          sqlsrv_close($con);
          return $this->ArrayKardex;
    }
    
    
    public function InsertarKardexPromedio($id_entradaDetalle, $id_salidaDetalle, $id_almacen, $id_insumo, $cantidad,
            $precio, $fecha_documento,$id_tipoMovimiento, $referencia, $id_usuario, $id_origenProducto,$origen_entrada_salida){
        
        $UltimaExistencia=0.0;
        $NuevaExistencia = 0.0;
         
        $UltimoCostoPromedio = 0.0;
        $NuevoCostoPromedio = 0.0;
        
        $UltimoCostoTotal=0.0;
        $NuevoCostoTotal=0.0;
      
        $this->IdEntradaDetalle = $id_entradaDetalle;
        $this->IdSalidaDetalle = $id_salidaDetalle;
        $this->IdAlmacen = $id_almacen;
        $this->IdInsumo = $id_insumo;
        $this->Cantidad = $cantidad;
        $this->Precio = $precio;
        $this->FechaDocumento = $fecha_documento;
        $this->IdTipoMovimiento = $id_tipoMovimiento;
        $this->Referencia = $referencia;
        $this->IdUsuario = $id_usuario;
        $this->IdOrigenProducto = $id_origenProducto;
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Kardex");
        $this->ID = $resultado;
        
        
        #Busca si hay insumos registrados en el kardex
        $con = Conexion();
        if($origen_entrada_salida==1)
        {
            $query = "select k.ID, k.Existencia, k.CostoTotal, k.CostoPromedio From Kardex as k  Where k.IdInsumo=$this->IdInsumo and k.IdAlmacen =$this->IdAlmacen and k.ID = (select max(k1.ID) from Kardex k1 Where k1.IdInsumo = k.IdInsumo and k1.IdAlmacen = k.IdAlmacen)";
        }
        else{
            $query = "select k.ID, k.Existencia, k.CostoTotal, k.CostoPromedio From Kardex as k  Where k.IdInsumo=$this->IdInsumo and k.ID = (select max(k1.ID) from Kardex k1 Where k1.IdInsumo = k.IdInsumo)";
        }
        
        $existencia = array();
        $valor = sqlsrv_query($con,$query);
     
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $existencia[0] = utf8_encode($Datos['ID']);
            $existencia[1] = utf8_encode($Datos['Existencia']);
            $existencia[2] = utf8_encode($Datos['CostoTotal']);
            $existencia[3] = utf8_encode($Datos['CostoPromedio']);
        }
          sqlsrv_close($con);
        
        $hay_elementos=  count($existencia);
        if($hay_elementos == 0)//No hay insumos registrados en el kardex
        {
            $this->Existencia = 0;
        }else{//Hay insumos en el kardex
            $this->Existencia = $existencia[1];
            $this->CostoPromedio = $existencia[2];
            $this->CostoTotal = $existencia[3];
        }
       
        $UltimaExistencia = $this->Existencia;
        $UltimoCostoPromedio = $this->CostoPromedio;
        $UltimoCostoTotal = $this->CostoTotal;
       
        $objTipoMovimiento = new KardexTipoMovimiento();
        $objTipoMovimiento->ConsultarPorID($this->IdTipoMovimiento);
        
        #El tipoMovimiento es SALIDA Y es cancelación
        if($objTipoMovimiento->EntradaSalida == 'S' && $objTipoMovimiento->Cancelacion == true){
            $NuevaExistencia = $UltimaExistencia - $this->Cantidad;
        }
        #Es ENTRADA y es cancelación
        elseif($objTipoMovimiento->EntradaSalida == 'E' && $objTipoMovimiento->Cancelacion == true){
            $NuevaExistencia = $UltimaExistencia + $this->Cantidad;
        }
        #Es ENTRADA
        elseif($objTipoMovimiento->EntradaSalida == 'E')
        {
             $NuevaExistencia = $UltimaExistencia + $this->Cantidad;
             
//             $NuevoCostoPromedio = /$UltimaExistencia;
        }
        else{ #Es SALIDA
            $NuevaExistencia = $UltimaExistencia - $this->Cantidad;
        }
        
        $this->Existencia = $NuevaExistencia;
         
        if($origen_entrada_salida==1)//Entrada
        {
           $query = "INSERT INTO Kardex ( ID, IdEntradaDetalle, IdSalidaDetalle, IdAlmacen, IdInsumo, Cantidad, Precio, 
            FechaDocumento, FechaSistema, Existencia, IdTipoMovimiento, Referencia , IdUsuario, IdOrigenProducto)   
            VALUES ( $this->ID,'$this->IdEntradaDetalle' ,NULL, '$this->IdAlmacen', '$this->IdInsumo','$this->Cantidad' ,"
                . " '$this->Precio','$this->FechaDocumento' , getdate(), '$this->Existencia',  '$this->IdTipoMovimiento',"
                . " '$this->Referencia','$this->IdUsuario','$this->IdOrigenProducto')"; 
        }
        else{//salida
            $query = "INSERT INTO Kardex ( ID, IdEntradaDetalle, IdSalidaDetalle, IdAlmacen, IdInsumo, Cantidad, Precio, 
            FechaDocumento, FechaSistema, Existencia, IdTipoMovimiento, Referencia , IdUsuario, IdOrigenProducto)   
            VALUES ( $this->ID,NULL,'$this->IdSalidaDetalle', '$this->IdAlmacen', '$this->IdInsumo','$this->Cantidad' ,"
                . " '$this->Precio','$this->FechaDocumento' , getdate(), '$this->Existencia',  '$this->IdTipoMovimiento',"
                . " '$this->Referencia','$this->IdUsuario','$this->IdOrigenProducto')"; 
        }
        
        
        if($objSQL->Execute($query))
        {
           
            return true;
        }
        else{
            return FALSE;
            
        }
      
    }
    
    
    public function ObtenerUltimoAlmacen($id_insumo)
    {
        $con = Conexion();
        $query = "select MAX(ID) as IdAlmacen from Kardex where IdAlmacen!=2 and IdInsumo=$id_insumo";
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $id_almacen = $Datos['IdAlmacen'];

        }
         
        sqlsrv_close($con);
        return $id_almacen;
    }
    
}



