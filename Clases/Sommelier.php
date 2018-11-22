<?php
include_once  'SQL_DML.php';
class Sommelier {
    public $IdVino;
    public $IdPlatillo;
    public $NombrePlatillo;
    public $NombreVino;


    public function Sommelier(){
        
    }
    
    public function BorradoFisico($idPlatillo){
        $objSQL = new SQL_DML();
        $this->IdPlatillo = $idPlatillo;
        $query = "delete Sommelier where IdPlatillo = $idPlatillo";
        $objSQL->Execute($query);
        echo $query;

    }
        public function Insertar($idVino,$idPlatillo){
        $objSQL = new SQL_DML();
        $this->IdPlatillo = $idPlatillo;
        $this->IdVino = $idVino;
        $query = "insert into Sommelier ".        
         "values ($this->IdVino,$this->IdPlatillo)";
        if($objSQL->Execute($query))
        {
            echo $query;
            return true;
        }
        else
            return FALSE;
    }

        public function ConsultarPorIdPlatillo($ID){
        $con = Conexion();
        $query = "select distinct Vinos.Nombre,Vinos.ID from Vinos join Sommelier on Vinos.ID = Sommelier.IdVino join Platillos on Sommelier.IdPlatillo = Platillos.ID ".
        " where Platillos.ID = $ID";
        $sommelier_vinos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSommelier = new Sommelier();
            $objSommelier->NombreVino = $Datos['Nombre'];
            $objSommelier->IdVino = $Datos['ID'];
            array_push($sommelier_vinos, $objSommelier);
        }
        return $sommelier_vinos;
    }
    
    
    public function ConsultarPorIdVino($ID){
        
        $con = Conexion();
        $query = "select distinct Vinos.Nombre,Vinos.ID from Vinos join Sommelier on Vinos.ID = Sommelier.IdVino join Platillos on Sommelier.IdPlatillo = Platillos.ID ".
        " where Vinos.ID = $ID";
        $sommelier_vinos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSommelier = new Sommelier();
            $objSommelier->NombreVino = $Datos['Nombre'];
            $objSommelier->IdVino = $Datos['ID'];
            array_push($sommelier_vinos, $objSommelier);
        }
        return $sommelier_vinos;
        
    }    
    
    
    public function ConsultarPorIds($IdPlatillo,$idVino){
        $con = Conexion();
     $query = "select * from Sommelier where IdPlatillo = $IdPlatillo and IdVino = $idVino";
        $sommelier_vinos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSommelier = new Sommelier();
            $objSommelier->IdVino = $Datos['IdVino'];
            $objSommelier->IdPlatillo = $Datos['IdPlatillo'];
            array_push($sommelier_vinos, $objSommelier);
        }
        
        return $sommelier_vinos;
        
    }
    
}
