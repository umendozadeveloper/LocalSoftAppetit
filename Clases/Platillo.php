<?php
include_once  'SQL_DML.php';


class Platillo {
    
    public $ID;
    public $Nombre;
    public $DescripcionCorta;
    public $DescripcionLarga;
    public $Precio;
    public $Icono;
    public $Foto;
    public $ValorEstrellas;
    public $Visible;
    public $Prioridad;
    public $Iva;
    public $IdTiempo;
    public $Compuesto;
    public $Tope;




    public function obtenerId(){
        $objSQL = new SQL_DML();
        return $resultado = $objSQL->GetScalar("select MAX (ID) as ID from Platillos");
    }
    
    public function EditarVisible($Id,$Visible){
        $objSQL = new SQL_DML();
        $this->ID = $Id;
        $this->Visible = $Visible;
        $query = "update Platillos set Visible = $this->Visible where ID = $this->ID";
        if($objSQL->Execute($query)){
            return true;
        }
        else{
            return false;
        }
    }


    public function Insertar($nombre, $descripcionCorta, $descripcionLarga, $precio,
            $icono, $foto,$iva,$id_tiempo,$compuesto=false,$tope=null) 
    {
        $this->Nombre = $nombre;
        $this->DescripcionCorta = $descripcionCorta;
        $this->DescripcionLarga = $descripcionLarga;
        
        $this->Iva = $iva;
        $this->Icono = $icono;
        $this->Foto = $foto;
        $this->Precio = $precio;
        $this->Visible = 1;
        $this->IdTiempo = $id_tiempo;
        $this->Compuesto = $compuesto;
        $this->Tope = $tope;
        $objSQL = new SQL_DML();
        $resultado = $objSQL->GetScalar("select MAX (ID) as ID from Platillos");
        $query = "insert into Platillos " .

                "(ID,Nombre,DescripcionCorta,DescripcionLarga,Precio,Icono,Foto,Visible,Iva,IdTiempo,Compuesto,Tope) " .
                "values (" . $resultado . ",'$this->Nombre','$this->DescripcionCorta',"
                . "'$this->DescripcionLarga',$this->Precio,'$this->Icono','$this->Foto','$this->Visible'"
                . ", '$this->Iva', '$this->IdTiempo','$this->Compuesto','$this->Tope')";

        if ($objSQL->Execute($query)) {
            $this->ID = $resultado;
            return true;
        } else {
            return FALSE;
        }
    }

    public function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from Platillos";
        $platillos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objPlatillo = new Platillo();
            $objPlatillo->ID = utf8_encode($Datos['ID']);
            $objPlatillo->Nombre = utf8_encode($Datos ['Nombre']);
            $objPlatillo->DescripcionCorta = utf8_encode($Datos ['DescripcionCorta']);
            $objPlatillo->DescripcionLarga = utf8_encode($Datos ['DescripcionLarga']);
            $objPlatillo->Precio = utf8_encode($Datos ['Precio']);
            $objPlatillo->Iva = utf8_encode($Datos['Iva']);
            $objPlatillo->Icono = utf8_encode(substr($Datos ['Icono'],3));
            $objPlatillo->Foto = utf8_encode(substr($Datos ['Foto'],3));
            $objPlatillo->ValorEstrellas = utf8_encode($Datos ['ValorEstrellas']);
            $objPlatillo->Visible = utf8_encode($Datos ['Visible']);
            $objPlatillo->Prioridad = utf8_encode($Datos ['Prioridad']);
            $objPlatillo->IdTiempo = utf8_encode($Datos['IdTiempo']);
            $objPlatillo->Compuesto = utf8_encode($Datos['Compuesto']);
            array_push($platillos, $objPlatillo);
        }
        return $platillos;

    }
    
    
    public function ConsultarPorID($ID){
        $con = Conexion();
        $query = "select * from Platillos where ID = $ID";
        $res = false;
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->ID = utf8_encode($Datos['ID']);
            $this->Nombre = utf8_encode($Datos ['Nombre']);
            $this->DescripcionCorta = utf8_encode($Datos ['DescripcionCorta']);
            $this->DescripcionLarga = utf8_encode($Datos ['DescripcionLarga']);
            $this->Precio = utf8_encode(substr($Datos ['Precio'],0,-2));
            $this->Icono = utf8_encode(substr($Datos ['Icono'],3));
            $this->Iva = utf8_encode($Datos['Iva']);
            $this->Foto = utf8_encode(substr($Datos ['Foto'],3));
            $this->ValorEstrellas = utf8_encode($Datos ['ValorEstrellas']);
            $this->IdTiempo = utf8_encode($Datos['IdTiempo']);
            $this->Compuesto = utf8_encode($Datos['Compuesto']);
            $this->Tope = utf8_encode($Datos['Tope']);
            $res = true;
        }
        return $res;

    }

    public function ModificarPlatilloPorID($idPlatillo,$nombre,$descripcionCorta,$descripcionLarga,
            $precio,$banderaIcono, $banderaFoto,$icono,$foto, $iva,$id_tiempo, $tope, $compuesto) {

        $objSQL = new SQL_DML();
        $query = "update Platillos set Nombre = '$nombre', DescripcionCorta = '$descripcionCorta', DescripcionLarga = '$descripcionLarga',"
                . " Precio = '$precio', Iva = '$iva', IdTiempo='$id_tiempo', Tope =  '$tope', Compuesto = '$compuesto'";
        if($banderaFoto == "Si"){
            $query.=",Foto = '$foto' ";
        }
        if($banderaIcono == "Si"){
            $query.=",Icono = '$icono' ";
        }        
        $query.=" where ID = '$idPlatillo'";
        echo $query;
        if($objSQL->Execute($query)){
            return true;
        }
        else {
            return FALSE;
        }
    }
     
    public function Eliminar($id)
        {
            $this->ID = $id;
            
            $objSQL = new SQL_DML();
        
            $query = "delete from Platillos where ID ='".$this->ID."'";
            if($objSQL->Execute($query))
            {
                $objSQL->Execute("DELETE FROM ProductoCompuesto WHERE IdProducto = $id AND IdTipoProducto = 0");
                return true;
            }
            else{
                return FALSE;
            }
        }
        
}


