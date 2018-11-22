<?php
include_once  'SQL_DML.php';

class Publicidad{
    public $ID;
    public $Imagen;
    public $Visible;
    public $Nombre;


    public function Insertar($Imagen,$Nombre,$Visible = 1){
        $this->Imagen = $Imagen;
        $this->Visible = $Visible;
        $this->Nombre = $Nombre;
        $objSQL = new SQL_DML();
        $this->ID = $objSQL->GetScalar("select MAX(ID) as ID from Publicidad");
        $query = "insert into Publicidad values ($this->ID,'$this->Imagen','$this->Visible','$this->Nombre')";
        if($objSQL->Execute($query))
        {
            return TRUE;
        }
        else{
            return FALSE;   
        }
    }
    
    public function Consultar(){
        $con = Conexion();
        $query = "select * from Publicidad";
        $publicidad = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objPublicidad = new Publicidad();
            $objPublicidad->ID = utf8_encode($Datos['ID']);
            $objPublicidad->Imagen = substr( utf8_encode($Datos['Imagen']), 3);
            $objPublicidad->Visible =  utf8_encode($Datos['Visible']);
            $objPublicidad->Nombre = utf8_encode($Datos['Nombre']);
            
            array_push($publicidad, $objPublicidad);
        }
        return $publicidad;
    }
    
    public function ConsultarPorId($Id_Publicidad){
        $con = Conexion();
        $this->ID = $Id_Publicidad;
        $query = "select * from Publicidad where ID = $this->ID";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->ID = utf8_encode($Datos['ID']);
            $this->Imagen = substr( utf8_encode($Datos['Imagen']), 3);
            $this->Visible =  utf8_encode($Datos['Visible']);
            $this->Nombre = utf8_encode($Datos['Nombre']);
        }
        
    }
    
    public function Modificar($Id_Publicidad, $Nombre, $Imagen = ''){
        $this->Imagen = $Imagen;
        $this->Nombre = $Nombre;
        $this->ID = $Id_Publicidad;
        $objSQL = new SQL_DML();
        $query = "update Publicidad set Nombre = '$this->Nombre'";
        if($this->Imagen!=''){
            $query.= ",Imagen = '$this->Imagen'";
        }
        $query.= "where ID = $this->ID";
        if($objSQL->Execute($query))
        {
            return TRUE;
        }
        else{
            return FALSE;   
        }
    }

    

    public function ConsultarVisibles(){
        $con = Conexion();
        $query = "select * from Publicidad where Visible = 1 order by Nombre";
        $publicidad = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objPublicidad = new Publicidad();
            $objPublicidad->ID = utf8_encode($Datos['ID']);
            $objPublicidad->Imagen = substr( utf8_encode($Datos['Imagen']), 3);
            $objPublicidad->Visible =  utf8_encode($Datos['Visible']);
            $objPublicidad->Nombre = utf8_encode($Datos['Nombre']);
            
            array_push($publicidad, $objPublicidad);
        }
        return $publicidad;
    }
    


    public function obtenerID(){
        $objSQL = new SQL_DML();
        return $resultado = $objSQL->GetScalar("select MAX (ID) as ID from Publicidad");
    }

    

    /**
     * 
     * @param int $ID Id del registro de publicidad
     * @param int $Visible 1 - Muestra la imagen en el banner, 0 la oculta
     */
    public function Mostrar_OcultarPublicidad($ID, $Visible) {
        $this->ID= $ID;
        $this->Visible = $Visible;
        $objSQL = new SQL_DML();
        $query = "update Publicidad set Visible = $this->Visible where ID = $this->ID";
        $objSQL->Execute($query);
        
    }
    
    public function BorradoFisico($ID){
        $this->ID = $ID;
        $objSQL = new SQL_DML();
        $query = "delete From Publicidad where ID = $this->ID";
        $objSQL->Execute($query);
    }
    
    
}

?>