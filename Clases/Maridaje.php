<?php
include_once  'SQL_DML.php';
class Maridaje {
    public $IdVino;
    public $IdPlatillo;
    public $NombrePlatillo;
    public $NombreVino;
    
    
    public function ConsultarPorIdVino($ID){
        $con = Conexion();
     $query = "  select distinct Platillos.Nombre,Platillos.ID from Platillos join Maridaje "
             . " on Platillos.ID = Maridaje.IdPlatillo "
             . " join Vinos on Maridaje.IdVino = Vinos.ID where Vinos.ID = '$ID'";
     
        $sommelier_vinos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSommelier = new Maridaje();
            $objSommelier->NombrePlatillo = $Datos['Nombre'];
            $objSommelier->IdPlatillo = $Datos['ID'];
            array_push($sommelier_vinos, $objSommelier);
        }
        return $sommelier_vinos;
    }
    
    
    public function ConsultarPorIds($IdPlatillo,$idVino){
        $con = Conexion();
     $query = "select * from Maridaje where IdPlatillo = $IdPlatillo and IdVino = $idVino";
        $sommelier_vinos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSommelier = new Maridaje();
            $objSommelier->IdVino = $Datos['IdVino'];
            $objSommelier->IdPlatillo = $Datos['IdPlatillo'];
            array_push($sommelier_vinos, $objSommelier);
        }
        
        return $sommelier_vinos;
        
    }
    
    
    public function BorradoFisico($idVino){
        $objSQL = new SQL_DML();
        $this->IdVino = $idVino;
        $query = "delete Maridaje where IdVino = $this->IdVino";
        $objSQL->Execute($query);
        echo $query;

    }
    
    
    public function Insertar($idVino,$idPlatillo){
        $objSQL = new SQL_DML();
        $this->IdPlatillo = $idPlatillo;
        $this->IdVino = $idVino;
        $query = "insert into Maridaje ".        
         "values ($this->IdVino,$this->IdPlatillo)";
        if($objSQL->Execute($query))
        {
            echo $query;
            return true;
        }
        else
            return FALSE;
    }

}
