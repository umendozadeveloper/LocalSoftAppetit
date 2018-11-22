<?php
include_once  'SQL_DML.php';
class Usuario {
    public $Id;
    public $Usuario;
    public $Contrasena;
    public $Nombre;
    public $Apellidos;
    public $Direccion;
    public $Telefono;
    public $Correo;
    public $Foto;
    public $Observaciones;
    public $Estatus;
    public $PrivilegiosMesero;
    
    function Login($usuario,$contrasena){
        $con = Conexion();
        $this->Usuario=$usuario;
        $this->Contrasena = $contrasena;
        $query = "select * from Usuarios where Usuario = '$this->Usuario' and Contrasena = '$contrasena' and Status='1'";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);

        while($Datos = sqlsrv_fetch_array($valor)){
                $obUsuario = new Usuario();
                $obUsuario->Id = utf8_encode($Datos['Id']);
                $obUsuario->Usuario = utf8_encode($Datos['Usuario']);
                $obUsuario->Contrasena = utf8_encode($Datos['Contrasena']);
                $obUsuario->Nombre = utf8_encode($Datos['Nombre']);
                $obUsuario->Apellidos = utf8_encode($Datos['Apellidos']);
                $obUsuario->Telefono = utf8_encode($Datos['Telefono']);
                $obUsuario->Direccion = utf8_encode($Datos['Direccion']);
                $obUsuario->Correo = utf8_encode($Datos['CorreoElectronico']);
                $obUsuario->Foto = utf8_encode($Datos['Foto']);
                $obUsuario->Observaciones = utf8_encode($Datos['Observaciones']);
                $obUsuario->Estatus = utf8_encode($Datos['Status']);
                $obUsuario->PrivilegiosMesero = $Datos['PrivilegiosMesero'];
                array_push($comandas, $obUsuario);
            }
            return $comandas;        
    }
    
    
        function Consultar(){
        $con = Conexion();
        $query = "select * from Usuarios";
        $comandas = array();
        $valor = sqlsrv_query($con,$query);

        while($Datos = sqlsrv_fetch_array($valor)){
                $obUsuario = new Usuario();
                $obUsuario->Id = utf8_encode($Datos['Id']);
                $obUsuario->Usuario = utf8_encode($Datos['Usuario']);
                $obUsuario->Contrasena = utf8_encode($Datos['Contrasena']);
                $obUsuario->Nombre = utf8_encode($Datos['Nombre']);
                $obUsuario->Apellidos = utf8_encode($Datos['Apellidos']);
                $obUsuario->Telefono = utf8_encode($Datos['Telefono']);
                $obUsuario->Direccion = utf8_encode($Datos['Direccion']);
                $obUsuario->Correo = utf8_encode($Datos['CorreoElectronico']);
                $obUsuario->Foto = utf8_encode($Datos['Foto']);
                $obUsuario->Observaciones = utf8_encode($Datos['Observaciones']);
                $obUsuario->Estatus = utf8_encode($Datos['Status']);
                $obUsuario->PrivilegiosMesero = $Datos['PrivilegiosMesero'];
                array_push($comandas, $obUsuario);
            }
            return $comandas;
    }
    
    
    function ConsultarPorID($ID){
        $con = Conexion();
        $this->Id = $ID;
        $query = "select * from Usuarios where Id = $this->Id";
        $res =false;
        $valor = sqlsrv_query($con,$query);

        while($Datos = sqlsrv_fetch_array($valor)){                
                $this->Id = utf8_encode($Datos['Id']);
                $this->Usuario = utf8_encode($Datos['Usuario']);
                $this->Contrasena = utf8_encode($Datos['Contrasena']);
                $this->Nombre = utf8_encode($Datos['Nombre']);
                $this->Apellidos = utf8_encode($Datos['Apellidos']);
                $this->Direccion = utf8_encode($Datos['Direccion']);
                $this->Telefono = utf8_encode($Datos['Telefono']);
                $this->Correo = utf8_encode($Datos['CorreoElectronico']);
                $this->Foto = utf8_encode($Datos['Foto']);
                $this->Observaciones = utf8_encode($Datos['Observaciones']);
                $this->Estatus = utf8_encode($Datos['Status']);
                $this->PrivilegiosMesero = $Datos['PrivilegiosMesero'];
                        $res =true;
            }
            return $res;
    }
    
    function ConsultarPorUsuario($Usuario){
        $con = Conexion();
        $this->Usuario = $Usuario;
        $res = FALSE;
        $query = "select * from Usuarios where Usuario = '$this->Usuario'";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $this->Id = utf8_encode($Datos['Id']);
                $this->Usuario = utf8_encode($Datos['Usuario']);
                $this->Contrasena = utf8_encode($Datos['Contrasena']);
                $this->Nombre = utf8_encode($Datos['Nombre']);
                $this->Apellidos = utf8_encode($Datos['Apellidos']);
                $this->Direccion = utf8_encode($Datos['Direccion']);
                $this->Telefono = utf8_encode($Datos['Telefono']);
                $this->Correo = utf8_encode($Datos['CorreoElectronico']);
                $this->Foto = utf8_encode($Datos['Foto']);
                $this->Observaciones = utf8_encode($Datos['Observaciones']);
                $this->Estatus = utf8_encode($Datos['Status']);
                $this->PrivilegiosMesero = $Datos['PrivilegiosMesero'];
                $res =true;
                
            }
            return $res;
    }
    public function obtenerId(){
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Usuarios");
        return $resultado;
    }
    
    function Insertar($id,$usuario,$contrasena,$nombre,$apellidos,$direccion,$telefono,$correo, $foto, $observaciones, $estatus,$privilegios){
        $this->Usuario = $usuario;
        $this->Contrasena=($contrasena);
        $this->Nombre = ($nombre);
        $this->Apellidos=  ($apellidos);
        $this->Direccion = $direccion;
        $this->Telefono = $telefono;
        $this->Correo = $correo;
        $this->Foto = $foto;
        $this->Observaciones = $observaciones;
        $this->Estatus = $estatus;
        $this->PrivilegiosMesero = $privilegios;
        $this->Id = $id;
        $objSQL = new SQL_DML();
//        $this->Id = $objSQL->GetScalar("select MAX (ID) as ID from Usuarios");
        
        $query = "insert into Usuarios values ($this->Id,'$this->Usuario','$this->Contrasena','$this->Nombre','$this->Apellidos',"
                . "'$this->Direccion','$this->Telefono','$this->Correo','$this->Foto','$this->Observaciones','$this->Estatus',"
                . "'$this->PrivilegiosMesero')";
        
        
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else
            return FALSE;
    }
    
    function Modificar($id,$usuario,$contrasena,$nombre,$apellidos, $direccion, $telefono, $correo, $foto, $obsevaciones, $status,$privilegios){
        $this->Usuario = $usuario;
        $this->Contrasena=($contrasena);
        $this->Nombre = ($nombre);
        $this->Apellidos=  ($apellidos);
        $this->Id = $id;
        $this->Direccion = $direccion;
        $this->Telefono = $telefono;
        $this->Correo = $correo;
        $this->Foto = $foto;
        $this->Observaciones = $obsevaciones;
        $this->Estatus = $status;
        $this->PrivilegiosMesero = $privilegios;
        $objSQL = new SQL_DML();
        $query = "update Usuarios set Usuario = '$this->Usuario', Contrasena = '$this->Contrasena' ,"
                . " Nombre = '$this->Nombre', Apellidos = '$this->Apellidos', Direccion='$this->Direccion', "
                . "Telefono='$this->Telefono', CorreoElectronico='$this->Correo', Foto='$this->Foto', "
                . "Observaciones='$this->Observaciones', Status='$this->Estatus', PrivilegiosMesero='$this->PrivilegiosMesero'"
                . " where Id = $this->Id";
        echo $query;
        if($objSQL->Execute($query))
        {
            return true;
        }
        else{
            return FALSE;
        }
    }
    
    public function Eliminar($id)
        {
            $this->Id = $id;
            
            $objSQL = new SQL_DML();
        
            $query = "delete Usuarios where Id ='".$this->Id."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }
}

