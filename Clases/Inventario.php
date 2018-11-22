<?php

include_once  'SQL_DML.php';

class Inventario {
    
    public $ID;
    public $Fecha;
    public $Observaciones;
    public $IdEstado;
    public $IdEntrada;
    public $IdSalida;

   public function Inventario(){
            
    }

    public function Insertar($id,$fecha,$observaciones){
        $this->Fecha = $fecha;
        $this->Observaciones = $observaciones;
        $this->IdEstado = 1;
        $this->IdEntrada = NULL;
        $this->IdSalida = NULL;
        
//        $objSQL = new SQL_DML();
//        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Inventarios");
        $this->ID = $id;;

        $query = "insert into Inventarios ".
        "(ID,Fecha,Observaciones,IdEstado,IdEntrada,IdSalida) ".
         "values ('".$this->ID."','".$this->Fecha."','".$this->Observaciones."','".$this->IdEstado."',NULL,NULL)";
        
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else{
            return FALSE;
            
        }
   
    }
        
    
     public function ConsultarTodo()
     {
        $con = Conexion();
        $query = "select * from Inventarios order by Fecha desc";
        $inventarios = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objInventario = new Inventario();
            $objInventario->ID = utf8_encode($Datos['ID']);
            $objInventario->Fecha = $Datos['Fecha'];
            $objInventario->Observaciones = utf8_encode($Datos['Observaciones']);
            $objInventario->IdEstado = utf8_encode($Datos['IdEstado']);
            $objInventario->IdEntrada = utf8_encode($Datos['IdEntrada']);
            $objInventario->IdSalida = utf8_encode($Datos['IdSalida']);
           
            array_push($inventarios, $objInventario);
        }
        sqlsrv_close($con);
        return $inventarios;
     }   
   
  public function ConsultarPorEstado($estado)
     {
        $con = Conexion();
        $query = "select * from Inventarios where IdEstado='$estado'";
        $inventarios = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objInventario = new Inventario();
            $objInventario->ID = utf8_encode($Datos['ID']);
            $objInventario->Fecha = $Datos['Fecha'];
            $objInventario->Observaciones = utf8_encode($Datos['Observaciones']);
            $objInventario->IdEstado = utf8_encode($Datos['IdEstado']);
            $objInventario->IdEntrada = utf8_encode($Datos['IdEntrada']);
            $objInventario->IdSalida = utf8_encode($Datos['IdSalida']);
           
            array_push($inventarios, $objInventario);
        }
        sqlsrv_close($con);
        return $inventarios;
     }   
     
     
     public function ObtenerListadoConteo($idInventario, $ConExistencia)
     {
        $con = Conexion();
        
        if($ConExistencia === '0')
        {
            $query = "Select Inv.ID as IDInventario, Inv.Fecha, Inv.Observaciones, Ins.Descripcion, Ins.Presentacion, UM.Clave as UM, Ins.Contenido, 
            UMC.Descripcion as UMC, Cast(0 as Decimal(10,2)) as Existencia, CAST(0 as bit) as ImprimirExistencia, Ins.Id as IdInsumo
            from Inventarios Inv join InventariosConteo ic on Inv.ID = ic.IdInventario
            join Insumos Ins on Ins.Id= ic.IdInsumo
            join UnidadMedida UM on Ins.IdUnidadMedida= UM.Id
            join UMContent UMC on Ins.IdUMContent = UMC.ID
            where Inv.ID = $idInventario";
        }
        else{
            $query=" Select Inv.ID as IDInventario, Inv.Fecha, Inv.Observaciones, Ins.Descripcion, Ins.Presentacion, UM.Clave as UM, Ins.Contenido, 
            UMC.Descripcion as UMC,  IsNull(k.Existencia,0) as Existencia,   CAST(-1 as bit) as ImprimirExistencia, Ins.Id as IdInsumo
            from Inventarios Inv join InventariosConteo ic on Inv.ID = ic.IdInventario
            join Insumos Ins on Ins.Id= ic.IdInsumo
            join UnidadMedida UM on Ins.IdUnidadMedida= UM.Id
            join UMContent UMC on Ins.IdUMContent = UMC.ID
            Left join Kardex k on k.IdInsumo = Ins.Id and k.ID = (Select MAX(ID) from Kardex k1 where k1.IdInsumo =k.IdInsumo) 
            where Inv.ID = $idInventario";
        }

        $inventarios = array();
        $lista_conteo = array();
       
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
           $inventarios = array(
               "IDInventario" => utf8_encode($Datos['IDInventario']),
               "Fecha" => $Datos['Fecha'],
               "Observaciones" => utf8_encode($Datos['Observaciones']),
               "Descripcion" => utf8_encode($Datos['Descripcion']),
               "Presentacion" => utf8_encode($Datos['Presentacion']),
               "UM" => $Datos['UM'],
               "Contenido" => utf8_encode($Datos['Contenido']),
               "UMC" => $Datos['UMC'],
               "Existencia" =>$Datos['Existencia'],
               "ImprimirExistencia" =>$Datos['ImprimirExistencia'],
               "IdInsumo" =>$Datos['IdInsumo'],
           );
           
            array_push($lista_conteo, $inventarios);
        }
        sqlsrv_close($con);
        return $lista_conteo;
     }
    
     
     public function ActualizarEstado($nuevoEstado,$ID){
        
        $this->IdEstado = $nuevoEstado;
        $this->ID = $ID;
         
        $query = "Update Inventarios Set IdEstado = $this->IdEstado  Where ID = $this->ID";
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
            return true;
        else
            return false;
     }
     
     
     public function ObtenerProductosParaCierre($id_inventario, $con_excedente, $con_faltante, $sin_diferencia){
          $con = Conexion();
        
          $this->ID = $id_inventario;
        $query = "Select ic.Id, ic.IdInsumo,p.Descripcion, um.Descripcion as UM,  p.Presentacion, k.IdAlmacen,
        IsNull(k.Existencia,0) as Existencia,   IsNull(ic.Fisico,0.00) as Fisico,
         /*(IsNull(ic.Fisico,0) -     IsNull(k.Existencia,0.00) )as Diferencia,*/ 
        IsNull(k.Precio,0.0) as Costo,
        ABS(   IsNull(ic.Fisico,0)        - IsNull(k.Existencia,0.00)) as Diferencia,
        ((IsNull(ic.Fisico,0) -     IsNull(k.Existencia,0.00))* IsNull(k.Precio,0.0))as Importe,
        (case when IsNull(ic.Fisico,0) > IsNull(k.Existencia,0.00) then '+'       when IsNull(ic.Fisico,0) < IsNull(k.Existencia,0.00) then '-'       else '=' end) as MasMenos 
        from Inventarios i  join InventariosConteo ic on i.ID = ic.IdInventario  
        join Insumos p on p.Id = ic.IdInsumo 
        join UnidadMedidaInsumos um on p.IdUnidadMedida = um.ID  
        /*join Almacenes a on i.IdAlmacen =a.ID  */
        Left Join Kardex k on k.IdInsumo = p.Id                   
        /*And k.IdAlmacen = a.ID  */                   
        And k.ID = (Select MAX(ID) From Kardex k1 Where k1.IdInsumo = k.IdInsumo)
        Where i.Id = $this->ID 
        And (   (IsNull(ic.Fisico,0) > IsNull(k.Existencia,0.00) and 1=".$con_excedente.") or (IsNull(ic.Fisico,0) < IsNull(k.Existencia,0.00) and 1=".$con_faltante.")
                 or (IsNull(ic.Fisico,0) = IsNull(k.Existencia,0.00)) and 1=".$sin_diferencia." )
        ";

        $insumos = array();
        $inventario_insumos = array();
       
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
           $insumos = array(
               "IdInventarioConteo" => $Datos['Id'],
               "IdInsumo" => $Datos['IdInsumo'],
               "Descripcion" => utf8_encode($Datos['Descripcion']),
               "UM" => $Datos['UM'],
               "Sistema" => $Datos['Existencia'],
               "Fisico" => $Datos['Fisico'],
               "Costo" => $Datos['Costo'],
               "Diferencia" => $Datos['Diferencia'],
               "Importe" => $Datos['Importe'],
               "MasMenos" => $Datos['MasMenos'],
               "Presentacion" => utf8_encode($Datos['Presentacion']),
               "IdAlmacen" => $Datos['IdAlmacen'],
           );
           
            array_push($inventario_insumos, $insumos);
        }
        sqlsrv_close($con);
        return $inventario_insumos;
     }
     
     public function ConsultarPorID($id)
     {
        $con = Conexion();
        $this->ID = $id;
        $query = "select * from Inventarios where ID='$this->ID'";
        
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
//            $objInventario = new Inventario();
//            $this->ID = utf8_encode($Datos['ID']);
            $this->Fecha = $Datos['Fecha'];
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->IdEstado = utf8_encode($Datos['IdEstado']);
            $this->IdEntrada = utf8_encode($Datos['IdEntrada']);
            $this->IdSalida = utf8_encode($Datos['IdSalida']);
           
            
        }
        sqlsrv_close($con);
       
     } 
     
     public function ActualizarInventarioCierre($id_inventario, $id_estado, $id_entrada, $id_salida){
         
         $realizado = false;
         $query ="Update Inventarios Set  IdEstado = $id_estado,  IdEntrada = $id_entrada,  IdSalida = $id_salida  Where Id = $id_inventario";
         $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
            $realizado= true;
        else
            $realizado= false;
        
         return $realizado;
     }
     
}


