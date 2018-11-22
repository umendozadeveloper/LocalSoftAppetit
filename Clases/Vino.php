<?php
include_once  'SQL_DML.php';


class Vino {
    
    public $ID;
    public $Nombre;
    public $DescripcionCorta;
    public $DescripcionLarga;
    public $PrecioBotella;
    public $PrecioCopa;
    public $Icono;
    public $Foto;
    public $ValorEstrellas;
    public $Visible;
    public $Prioridad;
    public $Iva;



    /**
     * Constructor Mesa
     * @param int $numero
     * @param int $cantidad
     * @param int $ubicacion
     */
    
    public function obtenerId(){
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Vinos");
        return $resultado;
    }
    
    
     public function EditarVisible($Id,$Visible){
        $objSQL = new SQL_DML();
        $this->ID = $Id;
        $this->Visible = $Visible;
        $query = "update Vinos set Visible = $this->Visible where ID = $this->ID";
        if($objSQL->Execute($query)){
            return true;
        }
        else{
            return false;
        }
    }




    public function Insertar($nombre,$descripcionCorta,$descripcionLarga,$precioCopa,$precioBotella,$icono,$foto,$iva){
        $this->Nombre = $nombre;
        $this->DescripcionCorta = $descripcionCorta;
        $this->DescripcionLarga = $descripcionLarga;
        $this->PrecioBotella = $precioBotella;
        $this->PrecioCopa = $precioCopa;
        $this->Icono = $icono;
        $this->Foto = $foto;
        $this->Visible = 1;
        $this->Iva = $iva;

        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Vinos");
        
        
        $query = "insert into Vinos ".

        "(ID,Nombre,DescripcionCorta,DescripcionLarga,PrecioCopa,PrecioBotella,Icono,Foto,Visible, Iva) ".
         "values (".$resultado.",'$this->Nombre','$this->DescripcionCorta','$this->DescripcionLarga',$this->PrecioCopa,$this->PrecioBotella,'$this->Icono','$this->Foto', $this->Visible, '$this->Iva')";

        
        if($objSQL->Execute($query))
        {
            $this->ID = $resultado;
            return true;
        }
        else
            return FALSE;
   
    }
        

    public function ConsultarTodos() {
            $con = Conexion();
            $query = "select * from Vinos";
            $vinos = array();
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $objVino = new Vino();
                $objVino->ID = utf8_encode($Datos['ID']);
                $objVino->Nombre = utf8_encode($Datos ['Nombre']);
                $objVino->DescripcionCorta = utf8_encode($Datos ['DescripcionCorta']);
                $objVino->DescripcionLarga = utf8_encode($Datos ['DescripcionLarga']);
                $objVino->PrecioBotella = utf8_encode(substr($Datos ['PrecioBotella'],0,-2));
                $objVino->PrecioCopa = utf8_encode(substr($Datos ['PrecioCopa'],0,-2));
                $objVino->Icono = utf8_encode(substr($Datos ['Icono'],3));
                $objVino->Foto = utf8_encode(substr($Datos ['Foto'],3));
                $objVino->ValorEstrellas = utf8_encode($Datos ['ValorEstrellas']);
                $objVino->Visible  =utf8_encode($Datos ['Visible']);
                $objVino->Prioridad  =utf8_encode($Datos ['Prioridad']);
                $objVino->Iva = utf8_encode($Datos['Iva']);

                
                array_push($vinos, $objVino);
            }
            return $vinos;
        }
        
        
            public function ConsultarPorID($ID) {
            $con = Conexion();
            $query = "select * from Vinos where ID = $ID";
            $res = false;
            $valor = sqlsrv_query($con,$query);
            while($Datos = sqlsrv_fetch_array($valor)){
                $this->ID = utf8_encode($Datos['ID']);
                $this->Nombre = utf8_encode($Datos ['Nombre']);
                $this->DescripcionCorta = utf8_encode($Datos ['DescripcionCorta']);
                $this->DescripcionLarga = utf8_encode($Datos ['DescripcionLarga']);
                $this->PrecioBotella = utf8_encode(substr($Datos ['PrecioBotella'],0,-2));
                $this->PrecioCopa = utf8_encode(substr($Datos ['PrecioCopa'],0,-2));
                $this->Icono = utf8_encode(substr($Datos ['Icono'],3));
                $this->Foto = utf8_encode(substr($Datos ['Foto'],3));
                $this->ValorEstrellas = utf8_encode($Datos ['ValorEstrellas']);
                $this->Visible  =utf8_encode($Datos ['Visible']);
                $this->Prioridad  =utf8_encode($Datos ['Prioridad']);
                $this->Iva = utf8_encode($Datos['Iva']);

                $res = true;
            }
            return $res;
        }
        
        
        public function ConsultarVinoPorNombre($nombre) {
        $objSQL = new SQL_DML();
        $query = "select ID,Nombre,DescripcionCorta,DescripcionLarga,CAST (PrecioCopa as decimal (6,2)) AS 'Precio Copa', CAST (PrecioBotella as decimal (6,2)) AS 'Precio Botella', Icono, Foto,ValorEstrellas from Vinos where Nombre = '$nombre'";
        $consulta = $objSQL->ConsultarTabla($query);
        return utf8_encode($consulta);
        }
        
        
        
        /*-------------------------------------------Tabla de Consulta de Platillos Sommelier*/
    public function ConsultarMaridaje($nombreVino){
        $objSQL = new SQL_DML();
        $query = "select distinct Platillos.Nombre from Platillos join Maridaje on Platillos.ID = Maridaje.IdPlatillo join Vinos on Maridaje.IdVino = Vinos.ID where Vinos.Nombre =  '$nombreVino'";
        return $objSQL->ConsultarTabla($query);
    }
    
    
    
    /*-------------------------------------------Tabla de Consulta de Platillos Nombre*/
    public function ConsultarNombre(){
        $objSQL = new SQL_DML();
        $query = "select Distinct Nombre from Vinos order By Nombre";
        return $objSQL->ConsultarTabla($query);
    }
    
    /*-------------------------------------------Tabla de Consulta de SubMenus por Platillo*/
    public function ConsultarSubMenuPorNombrePlatillo($nombrePlatillo){
        $objSQL = new SQL_DML();
        $query = "select Submenus.Clave from Submenus join VinosSubMenu".
                " on VinosSubMenu.IdSubMenu = Submenus.ID ".
                "join Vinos on VinosSubMenu.IdVino = Vinos.ID ".
                "where Vinos.Nombre = '$nombrePlatillo' and Submenus.IdTipo=2";
        
        $subMenus = explode("°", $objSQL->ConsultarTabla($query));
        $consultaRuta = "Select  dbo.GetRutaSubMenu(ID,1) as RutaClaves from Submenus"
                . " where Clave = '";
        
        
        for($i=0; $i<count($subMenus)-1;$i++){            
            
            if($i>0){
                $consultaRuta.=" or Clave = '";
            }
            $consultaRuta.= $subMenus[$i];
            $consultaRuta.="'";
        }
        
        
        if($objSQL->CalcularFilasQuery($query)<1){
            $consultaRuta.="'";
        }
        return $objSQL->ConsultarTabla($consultaRuta);
        //return $consultaRuta;
        
    }
    
    
    public function ConsultarListadoDePlatillosParaMaridaje(){
        $objSQL = new SQL_DML();
        $query = "select Nombre,Foto,ID from Platillos";
        $resultado = $objSQL->ConsultarTabla($query);
        return utf8_encode($resultado);
           
    }

    







    public function ModificarVinoPorID($id,$nombre,$descripcionCorta,$descripcionLarga,$precioCopa,$precioBotella,$banderaIcono, $banderaFoto,$icono,$foto, $IVA) {
        $objSQL = new SQL_DML();
        $query = "update Vinos set Nombre = '$nombre', DescripcionCorta = '$descripcionCorta', DescripcionLarga = '$descripcionLarga',"
                . " PrecioCopa = '$precioCopa', PrecioBotella = '$precioBotella', IVA = '$IVA'";
        if($banderaFoto == "Si"){
            $query.=",Foto = '$foto' ";
        }
        if($banderaIcono == "Si"){
            $query.=",Icono = '$icono' ";
        }        
        $query.=" where ID = '$id'";
        return $objSQL->Execute($query);
        }
        
        
        public function EditarMaridaje($nombrePlatillo,$arregloVinos){
            $objSQL = new SQL_DML();
            $query = "select ID from Vinos where Nombre = '$nombrePlatillo'";
            $idPlatillo = $objSQL->ConsultarTabla($query);
            $idPlatillo = str_replace("°", "", $idPlatillo);
            $query="delete Maridaje where IdVino = $idPlatillo";
            $objSQL->Execute($query);
            
            
            if($arregloVinos!=""){
            
                $query = "select Platillos.ID from Platillos where "; 
                for($i=0;$i<count($arregloVinos);$i++){
                    if($i>0){
                         $query .=" or ";
                    }
                    $query .= "Platillos.Nombre = '$arregloVinos[$i]'";
                }


                $idVinos = $objSQL->ConsultarTabla($query);
                $idVinos = explode("°", $idVinos);
                //echo count($idVinos);
                $query = "insert into Maridaje values ";
                for($i=0; $i<count($idVinos)-1;$i++){
                    if($i>0){
                        $query.=",";
                    }
                    $query.="($idPlatillo,$idVinos[$i])";
                }
                
                $objSQL->Execute($query);
            }
  
        }
        
        
        public function editarSubMenu($nombrePlatillo,$arregloVinos){
            
            $objSQL = new SQL_DML();
            $query = "select ID from Vinos where Nombre = '$nombrePlatillo'";
            $idPlatillo = $objSQL->ConsultarTabla($query);
            $idPlatillo = str_replace("°", "", $idPlatillo);
            $query="delete VinosSubMenu where IdVino = $idPlatillo";
            $objSQL->Execute($query);
            
            
            if($arregloVinos!=""){
            
                
                $query ="select ID from Submenus where ";
                //$query = "select Vinos.ID from Vinos where "; 
                for($i=0;$i<count($arregloVinos);$i++){
                    if($i>0){
                         $query .=" or ";
                    }
                    $query .= "dbo.GetRutaSubMenu(ID,1) = '$arregloVinos[$i]'";
                }


                $idVinos = $objSQL->ConsultarTabla($query);
                $idVinos = explode("°", $idVinos);
                //echo count($idVinos);
                $query = "insert into VinosSubMenu values ";
                for($i=0; $i<count($idVinos)-1;$i++){
                    if($i>0){
                        $query.=",";
                    }
                    $query.="($idPlatillo,$idVinos[$i])";
                }
                $objSQL->Execute($query);
            }
            
        }
        
        
        public function ConsultarListadoSubMenus(){
            $query = "Select dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdTipo = 2 order by Ruta";
            $objSQL = new SQL_DML();
            return $objSQL->ConsultarTabla($query);
        }
        
        
        public function Eliminar($ID){
            $this->ID = $ID;
            $objSQL = new SQL_DML();
            $query = "Delete from Vinos where ID='$this->ID'";
            
            if($objSQL->Execute($query))
            {
               return TRUE; 
            }
            else{
                return FALSE;
            }
                   
        }
        
        
}


