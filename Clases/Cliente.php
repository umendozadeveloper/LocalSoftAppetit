<?php
include_once  'SQL_DML.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente
 *
 * @author URIEL
 */
class Cliente {
    public $ID;
    public $Nombre;
    public $Telefono;
    public $Apellidos;
    public $Correo;
    public $Status;
    public $FolioRegistro;
    public $PVino;
    public $PAlimentos;
    public $PEventos;
    public $PCursos;


    public function __construct() {
        
    }
    
    public function Insertar($Nombre,$Apellidos,$Telefono,$Correo,$PVino=0,$PAlimentos=0,$PEventos=0,$PCursos=0,$Status = 0){
        $objSQL = new SQL_DML();
        $this->Nombre = $Nombre;
        $this->Apellidos = $Apellidos;
        $this->Telefono = $Telefono;
        $this->Correo = $Correo;
        $this->Status = $Status;
        $this->PAlimentos = $PAlimentos;
        $this->PVino = $PVino;
        $this->PCursos = $PCursos;
        $this->PEventos = $PEventos;
        $this->ID= $objSQL->GetScalar("select MAX (ID) as ID from Cliente");
        $SubCorreo = substr($this->Correo,0,2);
        $SubCorreo = strtoupper($SubCorreo);
        $this->FolioRegistro = $this->ID.  $SubCorreo.  rand(0, 9);
        $query = "INSERT INTO [Cliente]
           ([ID]
           ,[Nombre]
           ,[Apellidos]
           ,[Telefono]
           ,[Correo]
           ,[FolioRegistro]
           ,[PAlimentos]
           ,[PVino]
           ,[PCursos]
           ,[PEventos]
           ,[Status])
     VALUES
           ('$this->ID'
           ,'$this->Nombre'
           ,'$this->Apellidos'
           ,'$this->Telefono'
           ,'$this->Correo'
           ,'$this->FolioRegistro'
           ,'$this->PAlimentos'
           ,'$this->PVino'
           ,'$this->PCursos'
           ,'$this->PEventos'
           ,'$this->Status')";
        //echo $query;
        return $objSQL->Execute($query);
    }
    
    public function MarcarCorreoEnviado($ID){
        $this->ID = $ID;
        $query = "update Cliente set Status = 1 where ID = '$this->ID'";
        $objSQL = new SQL_DML();
        return $objSQL->Execute($query);    
    }
    
    
    public function ActualizarStatus($ID,$Status){
        $this->ID = $ID;
        $this->Status = $Status;
        $query = "update Cliente set Status = '$this->Status' where ID = '$this->ID'";
        $objSQL = new SQL_DML();
        return $objSQL->Execute($query);    
    }
    
    public function ConsultarPorCorreo($Correo){
        $con = Conexion();
        $this->Correo = $Correo;
        $query = "select * from Cliente where Correo = '$this->Correo'";
        $res = false;
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->Apellidos = utf8_encode($Datos ['Apellidos']);
            $this->Correo = utf8_encode($Datos ['Correo']);
            $this->FolioRegistro = utf8_encode($Datos ['FolioRegistro']);
            $this->ID = utf8_encode($Datos ['ID']);
            $this->Nombre = utf8_encode($Datos ['Nombre']);
            $this->PAlimentos = utf8_encode($Datos ['PAlimentos']);
            $this->PCursos = utf8_encode($Datos ['PCursos']);
            $this->PEventos = utf8_encode($Datos ['PEventos']);
            $this->PVino = utf8_encode($Datos ['PVino']);
            $this->Status = utf8_encode($Datos ['Status']);
            $this->Telefono = utf8_encode($Datos ['Telefono']);
            
            $res = true;
        }
            return $res;
    }
    
    
    public function ConsultarPorID($ID){
        $con = Conexion();
        $this->ID = $ID;
        $query = "select * from Cliente where ID = '$this->ID'";
        $res = false;
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->Apellidos = utf8_encode($Datos ['Apellidos']);
            $this->Correo = utf8_encode($Datos ['Correo']);
            $this->FolioRegistro = utf8_encode($Datos ['FolioRegistro']);
            $this->ID = utf8_encode($Datos ['ID']);
            $this->Nombre = utf8_encode($Datos ['Nombre']);
            $this->PAlimentos = utf8_encode($Datos ['PAlimentos']);
            $this->PCursos = utf8_encode($Datos ['PCursos']);
            $this->PEventos = utf8_encode($Datos ['PEventos']);
            $this->PVino = utf8_encode($Datos ['PVino']);
            $this->Status = utf8_encode($Datos ['Status']);
            $this->Telefono = utf8_encode($Datos ['Telefono']);
            $res = true;
        }
            return $res;
    }
    
    public function ConsultarTodos(){
        $con = Conexion();
        
        $query = "select * from Cliente";
        $clientes = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objCliente = new Cliente();
            $objCliente->Apellidos = utf8_encode($Datos ['Apellidos']);
            $objCliente->Correo = utf8_encode($Datos ['Correo']);
            $objCliente->FolioRegistro = utf8_encode($Datos ['FolioRegistro']);
            $objCliente->ID = utf8_encode($Datos ['ID']);
            $objCliente->Nombre = utf8_encode($Datos ['Nombre']);
            $objCliente->PAlimentos = utf8_encode($Datos ['PAlimentos']);
            $objCliente->PCursos = utf8_encode($Datos ['PCursos']);
            $objCliente->PEventos = utf8_encode($Datos ['PEventos']);
            $objCliente->PVino = utf8_encode($Datos ['PVino']);
            $objCliente->Status = utf8_encode($Datos ['Status']);
            $objCliente->Telefono = utf8_encode($Datos ['Telefono']);
            array_push($clientes, $objCliente);
        }
            return $clientes;
    }
    
    public function ConsultarPorPrefencia($Preferencia){
        $con = Conexion();
        $query ="";
        if($Preferencia == "Todos"){
            $query = "select * from Cliente";
        }
        else{
            $query = "select * from Cliente where $Preferencia = 1";
        }
        $clientes = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objCliente = new Cliente();
            $objCliente->Apellidos = utf8_encode($Datos ['Apellidos']);
            $objCliente->Correo = utf8_encode($Datos ['Correo']);
            $objCliente->FolioRegistro = utf8_encode($Datos ['FolioRegistro']);
            $objCliente->ID = utf8_encode($Datos ['ID']);
            $objCliente->Nombre = utf8_encode($Datos ['Nombre']);
            $objCliente->PAlimentos = utf8_encode($Datos ['PAlimentos']);
            $objCliente->PCursos = utf8_encode($Datos ['PCursos']);
            $objCliente->PEventos = utf8_encode($Datos ['PEventos']);
            $objCliente->PVino = utf8_encode($Datos ['PVino']);
            $objCliente->Status = utf8_encode($Datos ['Status']);
            $objCliente->Telefono = utf8_encode($Datos ['Telefono']);
            array_push($clientes, $objCliente);
        }
        return $clientes;
    }
    
    
    
    
    
}
