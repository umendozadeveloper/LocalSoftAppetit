<?php

include_once  'SQL_DML.php';


class Proveedor{
    
    public $ID;
    public $Nombre;
    public $RFC;
    public $Calle;
    public $Colonia;
    public $NumeroInterior;
    public $NumeroExterior;
    public $CodigoPostal;
    public $Correo;
    public $Telefono;
    public $Pais;
    public $IdEstado;
    public $IdMunicipio;
    public $DatosContacto;
    public $Observaciones;
    public $Estatus;
   
    
    
    public function Proveedor(){
            
    }

    public function Insertar($id,$nombre,$telefono, $correo, $rfc, $calle, $colonia, $numeroInterior, $numeroExterior, 
            $codigoPostal, $pais, $idEstado, $idMunicipio, $datosContacto, $observaciones, $estatus){
        $this->Nombre = $nombre;
        $this->Telefono = $telefono;
        $this->Correo = $correo;
        $this->RFC = $rfc;
        $this->Calle = $calle;
        $this->Colonia = $colonia;
        $this->NumeroExterior = $numeroExterior;
        $this->NumeroInterior = $numeroInterior;
        $this->CodigoPostal = $codigoPostal;
        $this->Pais = $pais;
        $this->IdEstado = $idEstado;
        $this->IdMunicipio = $idMunicipio;
        $this->DatosContacto = $datosContacto;
        $this->Observaciones = $observaciones;
        $this->ID = $id;
        $this->Estatus = $estatus;
        
        $objSQL = new SQL_DML();
//        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Proveedores");

        $query = "insert into Proveedores ".
        "(ID,Nombre,Telefono,Correo,RFC,Calle, Colonia, NumeroInterior,NumeroExterior,CodigoPostal, Pais, IdEstado,"
                . "IdMunicipio,DatosContacto,Observaciones,Status) ".
         "values ('".$this->ID."','".$this->Nombre."','".$this->Telefono."','".$this->Correo."','".$this->RFC."',"
                . "'$this->Calle','$this->Colonia','$this->NumeroInterior','$this->NumeroExterior',"
                . "'$this->CodigoPostal','$this->Pais','$this->IdEstado','$this->IdMunicipio','$this->DatosContacto',"
                . "'$this->Observaciones','$this->Estatus')";
        
        if($objSQL->Execute($query))
        {
           
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
        

        
        public function ConsultarTodo(){
        $con = Conexion();
        $query = "select * from Proveedores";
        $proveedores = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objProveedor = new Proveedor();
            $objProveedor->ID = utf8_encode($Datos['ID']);
            $objProveedor->Nombre = utf8_encode($Datos['Nombre']);
            $objProveedor->Telefono= utf8_encode($Datos['Telefono']);
            $objProveedor->Correo = utf8_encode($Datos['Correo']);
            $objProveedor->RFC = utf8_decode($Datos['RFC']);
            $objProveedor->Calle = utf8_encode($Datos['Calle']);
            $objProveedor->Colonia = utf8_encode($Datos['Colonia']);
            $objProveedor->NumeroExterior = utf8_encode($Datos['NumeroExterior']);
            $objProveedor->NumeroInterior = utf8_encode($Datos['NumeroInterior']);
            $objProveedor->CodigoPostal = utf8_encode($Datos['CodigoPostal']);
            $objProveedor->Pais = utf8_encode($Datos['Pais']);
            $objProveedor->IdEstado = $Datos['IdEstado'];
            $objProveedor->IdMunicipio = $Datos['IdMunicipio'];
            $objProveedor->Observaciones = utf8_encode($Datos['Observaciones']);
            $objProveedor->DatosContacto = utf8_decode($Datos['DatosContacto']);
            $objProveedor->Estatus= utf8_encode($Datos['Status']);
           
            array_push($proveedores, $objProveedor);
            }
            return $proveedores;
        }





        public function ConsultarPorID($ID){
         
        $con = Conexion();
        $query = "select * from Proveedores where ID =$ID";
//        $clasificadores = array();
        $valor = sqlsrv_query($con,$query);
        $res = false;
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->Nombre = utf8_encode($Datos['Nombre']);
            $this->Telefono = utf8_encode($Datos['Telefono']);
            $this->Correo = utf8_encode($Datos['Correo']);
            $this->RFC = utf8_encode($Datos['RFC']);
            $this->Calle = utf8_encode($Datos['Calle']);
            $this->Colonia = utf8_encode($Datos['Colonia']);
            $this->NumeroExterior = utf8_encode($Datos['NumeroExterior']);
            $this->NumeroInterior = utf8_encode($Datos['NumeroInterior']);
            $this->CodigoPostal = utf8_encode($Datos['CodigoPostal']);
            $this->Pais = utf8_encode($Datos['Pais']);
            $this->IdEstado = $Datos['IdEstado'];
            $this->IdMunicipio = $Datos['IdMunicipio'];
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->DatosContacto = utf8_decode($Datos['DatosContacto']);
            $this->Estatus = utf8_encode($Datos['Status']);
            $res = true;
            }
            return $res;
        }
        
        
        public function ModificarPorID($ID,$nombre,$rfc,$telefono, $correo,$calle,$colonia,$numeroExterior,$numeroInterior,
                $codigoPostal, $pais,$idEstado, $idMunicipio, $observaciones, $datosContacto, $estatus) {
            $res = FALSE;
            if ($this->ConsultarSiHayRFC($ID, $rfc)){
                return FALSE;
            }else{
                $this->ID = $ID;
                $this->Nombre = $nombre;
                $this->RFC = $rfc;
                $this->Telefono = $telefono;
                $this->Correo = $correo;
                $this->Calle = $calle;
                $this->Colonia = $colonia;
                $this->NumeroExterior = $numeroExterior;
                $this->NumeroInterior = $numeroInterior;
                $this->CodigoPostal = $codigoPostal;
                $this->Pais = $pais;
                $this->IdEstado = $idEstado;
                $this->IdMunicipio = $idMunicipio;
                $this->Observaciones = $observaciones;
                $this->DatosContacto = $datosContacto;
                $this->Estatus = $estatus;
                
                $query = "UPDATE [dbo].[Proveedores]
                   SET$query 
                       [Nombre] = '$this->Nombre'
                      ,[Telefono] = '$this->Telefono'
                      ,[Correo] = '$this->Correo'
                      ,[RFC] = '$this->RFC'
                      ,[Calle] = '$this->Calle'
                      ,[Colonia] = '$this->Colonia'
                      ,[NumeroInterior] = '$this->NumeroInterior'
                      ,[NumeroExterior] = '$this->NumeroExterior'
                      ,[CodigoPostal] = '$this->CodigoPostal'
                      ,[Pais] = '$this->Pais'
                      ,[IdEstado] = '$this->IdEstado'
                      ,[IdMunicipio] = '$this->IdMunicipio'
                      ,[Observaciones] = '$this->Observaciones'
                      ,[DatosContacto] = '$this->DatosContacto'
                      ,[Status] = '$this->Estatus'
                 WHERE ID=$this->ID";
                
                $objSQL = new SQL_DML();
                if($objSQL->Execute($query))
                    return true;
                else
                    return false;
            
            }
        }
        
        public function ConsultarSiHayRFC($id,$rfc)
        {
            $con = Conexion();
            $query = "select * from Proveedores where RFC ='$rfc' and ID!='$id'";
    //        $clasificadores = array();
            $valor = sqlsrv_query($con,$query);
            $res = false;
            while($Datos = sqlsrv_fetch_array($valor)){

                $this->ID = utf8_encode($Datos['ID']);
                $this->Nombre = utf8_encode($Datos['Nombre']);
                $this->Telefono = utf8_encode($Datos['Telefono']);
                $this->Correo = utf8_encode($Datos['Correo']);
                $this->RFC = utf8_encode($Datos['RFC']);
                $this->Calle = utf8_encode($Datos['Calle']);
                $this->Colonia = utf8_encode($Datos['Colonia']);
                $this->NumeroExterior = utf8_encode($Datos['NumeroExterior']);
                $this->NumeroInterior = utf8_encode($Datos['NumeroInterior']);
                $this->CodigoPostal = utf8_encode($Datos['CodigoPostal']);
                $this->Pais = utf8_encode($Datos['Pais']);
                $this->IdEstado = utf8_encode($Datos['IdEstado']);
                $this->IdMunicipio = utf8_encode($Datos['IdMunicipio']);
                $this->Observaciones = utf8_encode($Datos['Observaciones']);
                $this->DatosContacto = utf8_encode($Datos['DatosContacto']);
                $this->Estatus = utf8_encode($Datos['Status']);
                $res = true;
            }
            return $res;
        }
        
       public function Eliminar($id)
        {
            $this->ID = $id;
            
            $objSQL = new SQL_DML();
        
            $query = "delete Proveedores where ID ='".$this->ID."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }
}


