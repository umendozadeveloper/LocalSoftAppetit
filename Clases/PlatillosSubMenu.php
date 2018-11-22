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
class PlatillosSubMenu {
    public $IdPlatillo;
    public $IdSubMenu;
    
    function ConsultarPorIdPlatillo_IdSubMenu($IdPlatillo,$IdSubMenu){
        $con = Conexion();
        $this->IdPlatillo = $IdPlatillo;
        $this->IdSubMenu = $IdSubMenu;
        $query = "select * from PlatillosSubMenus where IdPlatillo = $IdPlatillo and IdSubMenu = $IdSubMenu";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new PlatillosSubMenu();
            $objSubMenu->IdPlatillo = utf8_encode($Datos['IdPlatillo']);
            $objSubMenu->IdSubMenu = utf8_encode($Datos['IdSubMenu']);
            array_push($submenus, $objSubMenu);
            }
            return $submenus;
    }
    
    
    function BorradoFisico($IdPlatillo){
        $this->IdPlatillo = $IdPlatillo;
        $objSQL = new SQL_DML();
        $this->IdPlatillo = $IdPlatillo;
        $query = "delete PlatillosSubMenus where IdPlatillo = $this->IdPlatillo";
        $objSQL->Execute($query);
        echo $query;
        
    }
    
    
    function Insertar($IdPlatillo, $IdSubMenu){
        $objSQL = new SQL_DML();
        $this->IdPlatillo = $IdPlatillo;
        $this->IdSubMenu = $IdSubMenu;
        $query = "insert into PlatillosSubMenus values ($this->IdPlatillo, $this->IdSubMenu)";
        $objSQL->Execute($query);
        echo "<br>".$query;
        
    }
}
