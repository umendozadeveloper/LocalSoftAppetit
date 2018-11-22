<?php

//include_once 'Validaciones_Lado_Servidor/Funciones/ConvertirFecha.php';
include_once 'SQL_DML.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Encuesta
 *
 * @author URIEL
 */
class Encuesta {
    //put your code here
    
    public $ID;
    public $ValoracionGeneral;
    public $Cocina;
    public $Servicio;
    public $Ambiente;
    public $Precio;
    public $Comentario;
    public $Fecha;




    public function ConsultarGeneral(){
        $con = Conexion();
        $query= "select AVG(Encuesta.Ambiente) as Ambiente,
                AVG(Encuesta.Cocina) as Cocina,
                AVG(Encuesta.Precio) as Precio,
                AVG(Encuesta.Servicio) as Servicio,
                AVG(Encuesta.ValoracionGeneral) as ValoracionGeneral
                from Encuesta";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){            
            $this->Ambiente= utf8_encode($Datos['Ambiente']);
            $this->Cocina= utf8_encode($Datos['Cocina']);
            $this->Precio= utf8_encode($Datos['Precio']);
            $this->Servicio= utf8_encode($Datos['Servicio']);
            $this->ValoracionGeneral= utf8_encode($Datos['ValoracionGeneral']);
        }
        sqlsrv_close($con);        
    }
    
    
    public function ConsultarTodo(){
        $con = Conexion();
        $query= "select * from Encuesta";
        $encuestas = array();
        
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){            
            $objEncuesta = new Encuesta();
            $objEncuesta->Ambiente= utf8_encode($Datos['Ambiente']);
            $objEncuesta->Cocina= utf8_encode($Datos['Cocina']);
            $objEncuesta->Precio= utf8_encode($Datos['Precio']);
            $objEncuesta->Servicio= utf8_encode($Datos['Servicio']);
            $objEncuesta->ValoracionGeneral= utf8_encode($Datos['ValoracionGeneral']);
            $objEncuesta->ID= utf8_encode($Datos['ID']);
            $objEncuesta->Comentario= utf8_encode($Datos['Comentario']);
            $objEncuesta->Fecha= date_format($Datos['Fecha'],'Y-m-d' );
//            $objEncuesta->Fecha = FormatoDeSQL_aESP($objEncuesta->Fecha);
            array_push($encuestas, $objEncuesta);
        }
        sqlsrv_close($con);        
        return $encuestas;
        
    }
    
    public function ConsultarPorID($ID){
        $con = Conexion();
        $query = "select * from Encuesta where ID = $ID";
        $res = false;
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->ValoracionGeneral = utf8_encode($Datos['ValoracionGeneral']);
            $this->Cocina = utf8_encode($Datos['Cocina']);
            $this->Servicio = utf8_encode($Datos['Servicio']);
            $this->Ambiente = utf8_encode($Datos['Ambiente']);
            $this->Precio = utf8_encode($Datos['Precio']);
            $this->Comentario = utf8_encode($Datos['Comentario']);
            $this->Fecha = date_format($Datos['Fecha'],'d/m/Y');    
//            if($this->Fecha!=NULL){
//                $this->Fecha= date_format($Datos['Fecha'],'Y-m-d' );
//                $this->Fecha = FormatoDeSQL_aESP($this->Fecha);
//            }
            $res = true;
        }
            return $res;
        
    }
    
    
    public function Insertar($ID,$Cocina,$Ambiente,$Precio,$Servicio,$ValoracionGeneral,$Comentario){
        $this->ID =$ID;
        $this->Cocina = $Cocina;
        $this->Ambiente = $Ambiente;
        $this->Precio = $Precio;
        $this->Servicio = $Servicio;
        $this->ValoracionGeneral = $ValoracionGeneral;
        $this->Comentario = $Comentario;
        
        $objSQL = new SQL_DML();
        $query = "INSERT INTO Encuesta ([ID],[ValoracionGeneral]"
                . ",[Cocina] ,[Servicio] ,[Ambiente] ,[Precio] ,[Comentario],[Fecha]) "
                . "VALUES ('$this->ID','$this->ValoracionGeneral', '$this->Cocina',"
                . "'$this->Servicio' ,'$this->Ambiente',"
                . "'$this->Precio' ,'$this->Comentario',GETDATE())";
                
        return $objSQL->Execute($query);
        
        
        
    }
    
    public function ModificarPorID($ID,$Cocina,$Ambiente,$Precio,$Servicio,$ValoracionGeneral,$Comentario) {
        $res = FALSE;

        $this->ID = $ID;
        $this->Cocina= $Cocina;
        $this->Ambiente = $Ambiente;
        $this->Precio = $Precio;
        $this->Servicio = $Servicio;
        $this->ValoracionGeneral = $ValoracionGeneral;
        $this->Comentario = $Comentario;

        $query = "Update Encuesta set Cocina='$this->Cocina', Ambiente='$this->Ambiente', Precio='$this->Precio', "
                . "Servicio='$this->Servicio', ValoracionGeneral='$this->ValoracionGeneral', Comentario='$this->Comentario' "
                . "where ID=$this->ID";
        $objSQL = new SQL_DML();
        if($objSQL->Execute($query))
            return true;
        else
            return false;
            
           
    }
    
}
