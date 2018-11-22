<?php
include_once  'SQL_DML.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogo_SubMenuTipo
 *
 * @author URIEL
 */
class Catalogo_SubMenuTipo {
    
    public function Consultar() {
        
        $query = "Select Clave from SubMenuTipo";
        $objSQL = new SQL_DML();
        $consulta = $objSQL->ConsultarTabla($query);
        return $consulta;
    }
}
