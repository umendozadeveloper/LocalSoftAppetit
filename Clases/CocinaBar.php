<?php
include_once  'SQL_DML.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cocina
 *
 * @author URIEL
 */
class CocinaBar {
    public $ID;
    public $IdComanda;
    public $Fecha;
    public $IdProductos;
    public $IdEstado;
    public $IdTipo;
    public $Prioridad;




    public function Insertar($IdComanda,$IdProductos,$IdTipo,$Prioridad=0,$IdEstado=1){
        
        $objSQL = new SQL_DML();
        $this->IdComanda = $IdComanda;
        $this->IdProductos = $IdProductos;
        $this->IdTipo = $IdTipo;
        $this->IdEstado = $IdEstado;
        $this->Prioridad = $Prioridad;
        if($this->Prioridad == 0){
            $this->Prioridad = $objSQL->GetScalar("Select MAX (Prioridad) as ID from CocinaBar where IdTipo = '$this->IdTipo'");
        }
        else  {
            $PrioridadTmp = $objSQL->GetScalar("Select MIN(Prioridad) as ID from CocinaBar where IdEstado= '1' and IdTipo = '$this->IdTipo'")-1;
            $this->reasignarPrioridad($PrioridadTmp);
            $this->Prioridad = $PrioridadTmp;
        }
        $this->ID = $objSQL->GetScalar("Select MAX (ID) as ID from CocinaBar");
        
        $query = "INSERT INTO [CocinaBar]
           ([ID]
           ,[IdComanda]
           ,[Fecha]
           ,[IdProductos]
           ,[IdEstado]
           ,[Prioridad]
           ,[IdTipo])
     VALUES
           ('$this->ID'
           ,'$this->IdComanda'
           ,GETDATE()
           ,'$this->IdProductos'
           ,'$this->IdEstado'
           ,'$this->Prioridad'
           ,'$this->IdTipo')";
        return $objSQL->Execute($query);
    }
    
    
    public function ConsultarPorIdTipo($IdTipo){
            $con = Conexion();
            $query = "select * from CocinaBar where IdTipo = '$IdTipo' and IdEstado !='3' order by Prioridad";
            $cocinaBar = array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $objCocina = new CocinaBar();
                $objCocina->ID  =utf8_encode($Datos ['ID']);
                $objCocina->IdComanda  =utf8_encode($Datos ['IdComanda']);
                $objCocina->IdEstado  =utf8_encode($Datos ['IdEstado']);
                $objCocina->IdProductos  =utf8_encode($Datos ['IdProductos']);
                $objCocina->IdTipo  =utf8_encode($Datos ['IdTipo']);
                $fecha = $Datos['Fecha'];
                $fecha = date_format($fecha, 'd/m/Y G:ia');
                $objCocina->Fecha = $fecha;
                $objCocina->Prioridad  =utf8_encode($Datos ['Prioridad']);
                array_push($cocinaBar, $objCocina);
            }
            sqlsrv_close($con);
            return $cocinaBar;
    }
    
    
    public function reasignarPrioridad($Prioridad){
        $objSQL = new SQL_DML();
        $query = "UPDATE CocinaBar set Prioridad = Prioridad +1 where Prioridad >= '$Prioridad'";
        $objSQL->Execute($query);
    }
    
    public function ConsultarPorIdComanda($IdComanda,$IdTipo){
            $con = Conexion();
            $query = "select * from CocinaBar where IdComanda = '$IdComanda' and IdEstado !='3' and IdTipo = '$IdTipo'";
            $res = false;
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $this->ID  =utf8_encode($Datos ['ID']);
                $this->IdComanda  =utf8_encode($Datos ['IdComanda']);
                $this->IdEstado  =utf8_encode($Datos ['IdEstado']);
                $this->IdProductos  =utf8_encode($Datos ['IdProductos']);
                $this->IdTipo  =utf8_encode($Datos ['IdTipo']);
                $fecha = $Datos['Fecha'];
                $fecha = date_format($fecha, 'd/m/Y G:ia');
                $this->Fecha = $fecha;
                $this->Prioridad  =utf8_encode($Datos ['Prioridad']);
                $res = true;
            }
            return $res;
    }
    
    public function ConsultarOrdenadas($IdTipo){
        $con = Conexion();
            $query = "select * from CocinaBar where IdTipo = '$IdTipo' and IdEstado ='1'";
            $cocinaBar = array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $objCocina = new CocinaBar();
                $objCocina->ID  =utf8_encode($Datos ['ID']);
                $objCocina->IdComanda  =utf8_encode($Datos ['IdComanda']);
                $objCocina->IdEstado  =utf8_encode($Datos ['IdEstado']);
                $objCocina->IdProductos  =utf8_encode($Datos ['IdProductos']);
                $objCocina->IdTipo  =utf8_encode($Datos ['IdTipo']);
                $fecha = $Datos['Fecha'];
                $fecha = date_format($fecha, 'd/m/Y G:ia');
                $objCocina->Fecha = $fecha;
                $objCocina->Prioridad  =utf8_encode($Datos ['Prioridad']);
                array_push($cocinaBar, $objCocina);
            }
            return $cocinaBar;
    }
    
    public function ConsultarProceso($IdTipo){
        $con = Conexion();
            $query = "select * from CocinaBar where IdTipo = '$IdTipo' and IdEstado ='2'";
            $cocinaBar = array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $objCocina = new CocinaBar();
                $objCocina->ID  =utf8_encode($Datos ['ID']);
                $objCocina->IdComanda  =utf8_encode($Datos ['IdComanda']);
                $objCocina->IdEstado  =utf8_encode($Datos ['IdEstado']);
                $objCocina->IdProductos  =utf8_encode($Datos ['IdProductos']);
                $objCocina->IdTipo  =utf8_encode($Datos ['IdTipo']);
                $fecha = $Datos['Fecha'];
                $fecha = date_format($fecha, 'd/m/Y G:ia');
                $objCocina->Fecha = $fecha;
                $objCocina->Prioridad  =utf8_encode($Datos ['Prioridad']);
                array_push($cocinaBar, $objCocina);
            }
            return $cocinaBar;
    }



    public function ConsultarTodoIdTipo($IdTipo){
            $con = Conexion();
            $query = "select * from CocinaBar where IdTipo = '$IdTipo'";
            $cocinaBar = array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $objCocina = new CocinaBar();
                $objCocina->ID  =utf8_encode($Datos ['ID']);
                $objCocina->IdComanda  =utf8_encode($Datos ['IdComanda']);
                $objCocina->IdEstado  =utf8_encode($Datos ['IdEstado']);
                $objCocina->IdProductos  =utf8_encode($Datos ['IdProductos']);
                $objCocina->IdTipo  =utf8_encode($Datos ['IdTipo']);
                $fecha = $Datos['Fecha'];
                $fecha = date_format($fecha, 'd/m/Y G:ia');
                $objCocina->Fecha = $fecha;
                $objCocina->Prioridad  =utf8_encode($Datos ['Prioridad']);
                array_push($cocinaBar, $objCocina);
            }
            return $cocinaBar;
    }
    
    public function Modificar($ID,$IdEstado){
        $objSQL = new SQL_DML();
        $this->IdEstado = $IdEstado;
        $this->ID = $ID;
        $query = "update CocinaBar set IdEstado = '$this->IdEstado' where ID = '$this->ID'";
        return $objSQL->Execute($query);
    }
    
}
