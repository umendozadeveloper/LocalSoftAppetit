<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlatillosSubMenu
 *
 * @author URIEL
 */
class VinosSubMenu {
    public $IdVino;
    public $IdSubMenu;
    
    function ConsultarPorIdVino_IdSubMenu($IdVino,$IdSubMenu){
        $con = Conexion();
        $this->IdVino = $IdVino;
        $this->IdSubMenu = $IdSubMenu;
        $query = "select * from VinosSubMenu where IdVino = $IdVino and IdSubMenu = $IdSubMenu";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new VinosSubMenu();
            $objSubMenu->IdVino = utf8_encode($Datos['IdVino']);
            $objSubMenu->IdSubMenu = utf8_encode($Datos['IdSubMenu']);
            array_push($submenus, $objSubMenu);
            }
            return $submenus;
    }
    
    
    function BorradoFisico($IdVino){
        $this->IdVino = $IdVino;
        $objSQL = new SQL_DML();
        $this->IdVino = $IdVino;
        $query = "delete VinosSubMenu where IdVino = $this->IdVino";
        $objSQL->Execute($query);
        echo $query;
        
    }
    
    
    function Insertar($IdVino, $IdSubMenu){
        $objSQL = new SQL_DML();
        $this->IdVino = $IdVino;
        $this->IdSubMenu = $IdSubMenu;
        $query = "insert into VinosSubMenu values ($this->IdVino, $this->IdSubMenu)";
        $objSQL->Execute($query);
        echo "<br>".$query;
        
    }
}
