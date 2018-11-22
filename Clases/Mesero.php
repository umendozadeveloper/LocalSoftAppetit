<?php
include_once  'SQL_DML.php';


class Mesero {
    
    public $ID;
    public $Usuario;
    public $Contrasena;
    public $Foto;
    public $Nombre;
    public $Apellidos;
    public $Direccion;
    public $Telefono;
    public $CorreoElectronico;
    public $Observaciones;
    public $Estatus;
    public $IdAdmin;
    
    
    public function obtenerId(){
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Meseros");
        return $resultado;
    }




    public function InsertarMesero($usuario,$contrasena,$foto,$nombre,$apellidos,$direccion,$telefono,$correo,$obsevaciones,$estatus){
        
        $this->Usuario = $usuario;
        $this->Contrasena=($contrasena);
        $this->Foto=($foto);
        $this->Nombre = ($nombre);
        $this->Apellidos=  ($apellidos);
        $this->Direccion=($direccion);
        $this->Telefono=($telefono);
        $this->CorreoElectronico=($correo);
        $this->Observaciones = $obsevaciones;
        $this->Estatus = $estatus;
        $this->IdAdmin = -9999;
                
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Meseros");
        
        $query = "insert into Meseros ".
        "(ID, Usuario,Contrasena,Foto,Nombre,Apellidos,Direccion,Telefono,CorreoElectronico,Observaciones,Status,IdAdmin) ".
         "values (".$resultado.",'$this->Usuario','$this->Contrasena','$this->Foto','$this->Nombre',"
                . "'$this->Apellidos','$this->Direccion','$this->Telefono','$this->CorreoElectronico',"
                . "'$this->Observaciones','$this->Estatus','$this->IdAdmin' )";        
        if($objSQL->Execute($query))
        {
            $this->ID = $resultado;
            return true;
        }
        else
            return FALSE;
   
    }
    
    
    public function Login($usuario,$contrasena){
        $con = Conexion();
        $this->Usuario=$usuario;
        $this->Contrasena = $contrasena;
        $query = "select * from Meseros where Usuario = '$this->Usuario' and Contrasena = '$contrasena' and Status='1'";
        echo $query;
        $comandas = array();
        $valor = sqlsrv_query($con,$query);

        while($Datos = sqlsrv_fetch_array($valor)){
                $objComanda = new Mesero();
                $objComanda->ID = $Datos['ID'];
                $objComanda->Usuario = $Datos['Usuario'];
                $objComanda->Contrasena = $Datos['Contrasena'];
                $objComanda->Nombre = $Datos['Nombre'];
                $objComanda->Apellidos = $Datos['Apellidos'];
                $objComanda->Observaciones = $Datos['Observaciones'];
                $objComanda->Estatus = $Datos['Status'];
                $objComanda->IdAdmin = $Datos['IdAdmin'];
                array_push($comandas, $objComanda);
            }
            return $comandas;

    }
    
    
    public function LoginPorID($id,$contrasena){
        $con = Conexion();
        $this->ID = $id;
        $this->Contrasena = $contrasena;
        $query = "select * from Meseros where ID = '$this->ID' and Contrasena = '$contrasena'";
        echo $query;
        $comandas = array();
        $valor = sqlsrv_query($con,$query);

        while($Datos = sqlsrv_fetch_array($valor)){
                $objComanda = new Mesero();
                $objComanda->ID = $Datos['ID'];
                $objComanda->Usuario = $Datos['Usuario'];
                $objComanda->Contrasena = $Datos['Contrasena'];
                $objComanda->Nombre = $Datos['Nombre'];
                $objComanda->Apellidos = $Datos['Apellidos'];
                $objComanda->Observaciones = $Datos['Observaciones'];
                $objComanda->Estatus = $Datos['Status'];
                $objComanda->IdAdmin = $Datos['IdAdmin'];
                array_push($comandas, $objComanda);
            }
            sqlsrv_close($con);        
            return $comandas;

    }
    
    
    

    

    public function ConsultarTodo() {
        $con = Conexion();
        $query = "select * from Meseros";
        $meseros = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objMesero = new Mesero();
            $objMesero->ID = utf8_encode($Datos['ID']);
            $objMesero->Apellidos = utf8_encode($Datos['Apellidos']);
            $objMesero->Contrasena = utf8_encode($Datos['Contrasena']);
            $objMesero->CorreoElectronico=utf8_encode( $Datos['CorreoElectronico']);
            $objMesero->Direccion = utf8_encode($Datos['Direccion']);
            $objMesero->Foto = utf8_encode(substr($Datos['Foto'], 3));
            $objMesero->Nombre = utf8_encode($Datos['Nombre']);
            $objMesero->Telefono = utf8_encode($Datos['Telefono']);
            $objMesero->Usuario = utf8_encode($Datos['Usuario']); 
            $objMesero->Observaciones = utf8_encode($Datos['Observaciones']);
            $objMesero->Estatus = utf8_encode($Datos['Status']);
            $objMesero->IdAdmin = $Datos['IdAdmin'];
            array_push($meseros, $objMesero);
            
            }
           sqlsrv_close($con);        
            return $meseros;
            
        }
        
        public function ConsultarPorNombre($nombre){
            $con=  Conexion();
        $resultado = sqlsrv_query($con,"SELECT ID from Meseros where Usuario ='$nombre'");
        $row=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC);
        $resultado = $row['ID'];
        return $resultado;
            
        }

        



        public function ConsultarPorID($ID) {
        $con = Conexion();
        $query = "select * from Meseros where ID = $ID";
        $res = false;
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->Apellidos = utf8_encode($Datos['Apellidos']);
            $this->Contrasena = utf8_encode($Datos['Contrasena']);
            $this->CorreoElectronico=utf8_encode( $Datos['CorreoElectronico']);
            $this->Direccion = utf8_encode($Datos['Direccion']);
            $this->Foto = utf8_encode(substr($Datos['Foto'], 3));
            $this->Nombre = utf8_encode($Datos['Nombre']);
            $this->Telefono = utf8_encode($Datos['Telefono']);
            $this->Usuario = utf8_encode($Datos['Usuario']); 
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Estatus = utf8_encode($Datos['Status']);
            $this->IdAdmin = $Datos['IdAdmin'];
            $res = true;
            }
            return $res;
        }
        
        
        public function ConsultarPorIDComanda($ID) {
        $con = Conexion();
        $query = "select * from Meseros join Comanda on "
                . " Comanda.IdMesero = Meseros.ID where Comanda.Id = $ID";
        
        $meseros = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objMesero = new Mesero();
            $objMesero->ID = utf8_encode($Datos['ID']);
            $objMesero->Apellidos = utf8_encode($Datos['Apellidos']);
            $objMesero->Contrasena = utf8_encode($Datos['Contrasena']);
            $objMesero->CorreoElectronico=utf8_encode( $Datos['CorreoElectronico']);
            $objMesero->Direccion = utf8_encode($Datos['Direccion']);
            $objMesero->Foto = utf8_encode(substr($Datos['Foto'], 3));
            $objMesero->Nombre = utf8_encode($Datos['Nombre']);
            $objMesero->Telefono = utf8_encode($Datos['Telefono']);
            $objMesero->Usuario = utf8_encode($Datos['Usuario']); 
            $objMesero->Observaciones = utf8_encode($Datos['Observaciones']);
            $objMesero->Estatus = utf8_encode($Datos['Status']);
            $objMesero->IdAdmin = $Datos['IdAdmin'];
            array_push($meseros, $objMesero);
            }
            sqlsrv_close($con);        
            return $meseros;
        }
        
        
        
        
        
        
        public function ModificarMeseroPorID($idMesero,$usuario, $nombre,$apellidos,$direccion,$telefono,
                $correo,$banderaFoto,$destinoFoto,$contrasena,$obsevaciones, $estatus,$idAdmin) {
        
        $this->ID =  ($idMesero);
        $this->Usuario =  ($usuario);
        $this->Contrasena= ($contrasena);
        $this->Foto= ($destinoFoto);
        $this->Nombre =  ($nombre);
        $this->Apellidos=   ($apellidos);
        $this->Direccion= ($direccion);
        $this->Telefono= ($telefono);
        $this->CorreoElectronico= ($correo);
        $this->Observaciones = $obsevaciones;
        $this->Estatus = $estatus;
        $this->IdAdmin = $idAdmin;
            $query = "update Meseros set Usuario = '$this->Usuario', Nombre = '$this->Nombre', Apellidos = '$this->Apellidos',".
                        " Contrasena = '$this->Contrasena', CorreoElectronico = '$this->CorreoElectronico', Direccion = '$this->Direccion', "
                    . "Telefono= '$telefono', Observaciones='$this->Observaciones', Status='$this->Estatus', IdAdmin='$this->IdAdmin'";
            if($banderaFoto=="Si"){
                $query.=", Foto = '$destinoFoto'";
            }
                        $query.=" where Meseros.ID = '$this->ID'";
            $objSQL = new SQL_DML();
            if($objSQL->Execute($query))
                return true;
            else
                return false;
        }
        
        public function Eliminar($id)
        {
            $this->Id = $id;
            
            $objSQL = new SQL_DML();
        
            $query = "delete Meseros where Id ='".$this->Id."'";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
        }
        
        public function InsertarMeseroPorAdmin($usuario,$contrasena,$foto,$nombre,$apellidos,$direccion,$telefono,
                $correo,$obsevaciones,$estatus,$idAdmin){
        
        $this->Usuario = $usuario;
        $this->Contrasena=($contrasena);
        $this->Foto=($foto);
        $this->Nombre = ($nombre);
        $this->Apellidos=  ($apellidos);
        $this->Direccion=($direccion);
        $this->Telefono=($telefono);
        $this->CorreoElectronico=($correo);
        $this->Observaciones = $obsevaciones;
        $this->Estatus = $estatus;
        $this->IdAdmin = $idAdmin;
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Meseros");
        
        $query = "insert into Meseros ".
        "(ID, Usuario,Contrasena,Foto,Nombre,Apellidos,Direccion,Telefono,CorreoElectronico,Observaciones,Status,IdAdmin) ".
         "values (".$resultado.",'$this->Usuario','$this->Contrasena','$this->Foto','$this->Nombre',"
                . "'$this->Apellidos','$this->Direccion','$this->Telefono','$this->CorreoElectronico',"
                . "'$this->Observaciones','$this->Estatus','$this->IdAdmin' )";        
        if($objSQL->Execute($query))
        {
            $this->ID = $resultado;
            return true;
        }
        else
            return FALSE;
   
    }
    
    public function ObtenePorIDAdmin($id_admin)
    {
        $con = Conexion();
        $query = "select * from Meseros where IdAdmin = $id_admin";
        $res = false;
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            
            $this->ID = utf8_encode($Datos['ID']);
            $this->Apellidos = utf8_encode($Datos['Apellidos']);
            $this->Contrasena = utf8_encode($Datos['Contrasena']);
            $this->CorreoElectronico=utf8_encode( $Datos['CorreoElectronico']);
            $this->Direccion = utf8_encode($Datos['Direccion']);
            $this->Foto = utf8_encode(substr($Datos['Foto'], 3));
            $this->Nombre = utf8_encode($Datos['Nombre']);
            $this->Telefono = utf8_encode($Datos['Telefono']);
            $this->Usuario = utf8_encode($Datos['Usuario']); 
            $this->Observaciones = utf8_encode($Datos['Observaciones']);
            $this->Estatus = utf8_encode($Datos['Status']);
            $this->IdAdmin = $Datos['IdAdmin'];
            $res = true;
            }
            return $res;
    }
    
    public function CambiarStatusMesero($ID,$estatus){
        $query = "Update Meseros set Status='$estatus' where ID='$ID'";
            $objSQL = new SQL_DML();
            if($objSQL->Execute($query))
                return true;
            else
                return false;
    }
}


