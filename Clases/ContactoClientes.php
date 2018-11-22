<?php
include_once 'SQL_DML.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactoClientes
 *
 * @author URIEL
 */
class ContactoClientes {
    public $ID;
    public $Clientes;
    public $Asunto;
    public $Cuerpo;
    public $Fecha;


    public function Insertar($Clientes,$Asunto,$Cuerpo){
        $objSQL = new SQL_DML();
        $this->Clientes = $Clientes;
        $this->Asunto = $Asunto;
        $this->Cuerpo = $Cuerpo;
        $query = "INSERT INTO [ContactoClientes]
           ([ID]
           ,[Clientes]
           ,[Asunto]
           ,[Cuerpo]
           ,[Fecha])
     VALUES
           ('$this->ID'
           ,'$this->Clientes'
           ,'$this->Asunto'
           ,'$this->Cuerpo'
           , GETDATE())";
        return $objSQL->Execute($query);
        
    }
    
    public function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from ContactoClientes";
        $contactos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $objContactoCliente = new ContactoClientes();
            $objContactoCliente->Asunto = utf8_encode($Datos ['Asunto']);
            $objContactoCliente->Clientes = utf8_encode($Datos ['Clientes']);
            $objContactoCliente->Cuerpo = utf8_encode($Datos ['Cuerpo']);
            $objContactoCliente->ID = utf8_encode($Datos ['ID']);
            $fecha = $Datos['Fecha'];
            $fecha = date_format($fecha, 'd/m/Y G:ia');
            $objContactoCliente->Fecha = $fecha;
            array_push($contactos, $objContactoCliente);
        }
            return $contactos;
    }
    
    
    
}
