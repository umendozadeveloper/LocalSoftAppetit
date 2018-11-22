<?php

include_once  'SQL_DML.php';

class SubMenu {
    
    public $ID;
    public $Clave;
    public $Descripcion;
    public $Foto;
    public $IdTipo;
    public $IdSubMenuPadre;
    public $Ruta;
    public $Prioridad;
    public $Visible;
    
    public function AumentarPrioridad($Prioridad){
        $PrioridadTmp = explode(".", $Prioridad);
        $Prioridad = "";
        $PrioridadTmp[count($PrioridadTmp)-1] = $PrioridadTmp[count($PrioridadTmp)-1]+1;
        for($i = 0; $i<count($PrioridadTmp);$i++){
            $Prioridad .= $PrioridadTmp[$i];
            if($i!=  count($PrioridadTmp)-1){
               $Prioridad.= ".";
            }
        }
        return $Prioridad;
    }
    
    
    public function InsertarSubMenu($nombre, $descripcion, $destinoFoto,$tipoSubMenu,$menuPadre,$visible=1){
        
        $objSQL = new SQL_DML();
        $resultado= $objSQL->GetScalar("select MAX (ID) as ID from Submenus");
        $this->Clave = $nombre;
        $this->Descripcion = $descripcion;
        $this->Foto = $destinoFoto;
        $this->IdTipo = $tipoSubMenu;
        //$PrioridadTmp = "";
        $this->IdSubMenuPadre = $menuPadre;
        $this->Visible = $visible;
        //if($menuPadre==1 || $menuPadre==2){
            
            $this->Prioridad = $objSQL->GetScalar("Select MAX(Prioridad) as ID from Submenus where IdSubMenuPadre = '$this->IdSubMenuPadre' and IdTipo='$this->IdTipo'");
            $query = "insert into Submenus".
        "(ID, Clave,Descripcion,Foto,IdTipo,Prioridad,Visible,IdSubMenuPadre) ".
         "values (".$resultado.",'$this->Clave','$this->Descripcion','$this->Foto',$this->IdTipo,'$this->Prioridad','$this->Visible','$this->IdSubMenuPadre')";
        /*}
        else{
            
            $PrioridadTmp= $objSQL->GetRowText("Select MAX(Prioridad) as ID from Submenus where IdSubMenuPadre = '$this->IdSubMenuPadre' and IdTipo='$this->IdTipo'");
            
            if($PrioridadTmp==1){
                $this->Prioridad = ($objSQL->GetScalar("select Prioridad as ID from Submenus"
                . " where ID = '$this->IdSubMenuPadre'")-1);
                $this->Prioridad .= ".1";
                

            }
            else{
                
                $this->Prioridad = $this->AumentarPrioridad($PrioridadTmp);
                echo $this->Prioridad;
            }
            $query = "insert into Submenus".
        "(ID, Clave,Descripcion,Foto,IdTipo,IdSubMenuPadre,Prioridad,Visible) ".
         "values (".$resultado.",'$this->Clave','$this->Descripcion','$this->Foto','$this->IdTipo',"
                . "'$this->IdSubMenuPadre','$this->Prioridad','$this->Visible')";
            
        }*/
        
        
        if($objSQL->Execute($query))
        {
            
            return true;
        }
        else
            return FALSE;
    }
    
    public function Editar($Id,$nombre, $descripcion,$destinoFoto,$idSubMenuPadre,
        $Prioridad,$Visible=1){
        $objSQL = new SQL_DML();
        $this->Clave = $nombre;
        $this->Descripcion = $descripcion;
        $this->Foto = $destinoFoto;
        $this->IdSubMenuPadre = $idSubMenuPadre;
        $this->ID = $Id;
        $this->Prioridad = $Prioridad;
        $this->Visible = $Visible;
        
        if($this->IdSubMenuPadre!=""){
        $query = "update Submenus set Clave = '$this->Clave', Descripcion = '$this->Descripcion',"
                . " Foto = '$this->Foto',Prioridad = '$this->Prioridad', Visible = '$this->Visible', IdSubMenuPadre = '$this->IdSubMenuPadre' where ID = '$this->ID'";
        }
        else {
            $query = "update Submenus set Clave = '$this->Clave', Descripcion = '$this->Descripcion',"
                . " Foto = '$this->Foto', Prioridad = '$this->Prioridad', Visible = '$this->Visible' where ID = '$this->ID'";
        }
        if($objSQL->Execute($query))
        {
            return true;
        }
        else{
            return FALSE;
        }
    }
    
    public function EditarVisible($Id,$Visible){
        $objSQL = new SQL_DML();
        $this->ID = $Id;
        $this->Visible = $Visible;
        $query = "update Submenus set Visible = $this->Visible where ID = $this->ID";
        if($objSQL->Execute($query)){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    
    public function EditarPrioridadPorID($ID,$Accion){
        $objSQL = new SQL_DML();
        $this->ConsultarSubMenuPorID($ID);
        $Prioridad = "";
        $Cantidad = $this->ObtenerIncrementoPrioridad($this->Prioridad);
        $Sub_SubMenu = new SubMenu();
        
        $Idtmp = "";
        $MayorMenor = "";
        $Forma = "";
        //Accion = 1 cuando la prioridad del menú seleccionado aumentará ejemplo 4.1 a 4.2
        if($Accion==1)
        {
            
            //$this->Prioridad = $this->Prioridad+$Cantidad;
            //$Prioridad = $this->Prioridad-$Cantidad;
            $MayorMenor= ">";
            $Forma = "asc";
        }
        else{
            //$this->Prioridad = $this->Prioridad-$Cantidad;
            //$Prioridad = $this->Prioridad+$Cantidad;
            $MayorMenor= "<";
            $Forma = "desc";
        }
        
            
        
            
            
            $Idtmp = $objSQL->GetScalar("select ID as ID from Submenus where Prioridad $MayorMenor '$this->Prioridad' and IdSubMenuPadre = '$this->IdSubMenuPadre'  order by Prioridad $Forma")-1;
            $Sub_SubMenu->ConsultarSubMenuPorID($Idtmp);
            $query = "update Submenus set Prioridad = '$this->Prioridad' where ID = '$Sub_SubMenu->ID'";
            //echo $query;
            $objSQL->Execute($query);
            $query = "update Submenus set Prioridad = '$Sub_SubMenu->Prioridad' where ID = $this->ID";
            //echo "<br>";
            //echo $query;
            $objSQL->Execute($query);
            //echo "<br>";
            
    }
    
    public function ObtenerIncrementoPrioridad($Prioridad){
        $Prioridad = explode(".", $Prioridad);
        $cantidad = "0";
        if(count($Prioridad)==1){
            $cantidad = "1";
        }
        else{
            for($i = 0; $i<count($Prioridad)-1; $i++){
                if($i==  count($Prioridad)-2){
                    $cantidad.=".1";
                }
                else{
                    $cantidad.=".0";
                }
            }
            
            
        }
        
        
        
        return $cantidad;
    }

    public function Eliminar($Id){
        $objSQL = new SQL_DML();
        $this->ID = $Id;
        $query = "delete Submenus where ID = $Id";
        if($objSQL->Execute($query))
        {
            return true;
        }
        else{
            return FALSE;
        }
    }
    
    /**
     * 
     * @param type $ID_Origen
     * @param type $ID_Destino
     * @param type $Ubicacion---- 1-Intercambiar,2-Antes de, 3 -Despues de
     */
    public function IntercambiarPrioridad($ID_Origen,$ID_Destino,$Ubicacion){
        $this->ID = $ID_Origen;
        $objSubMenu = new SubMenu();
        $objSubMenu->ID = $ID_Destino;
        $this->ConsultarSubMenuPorID($this->ID);
        $objSubMenu->ConsultarSubMenuPorID($objSubMenu->ID);
        switch ($Ubicacion){
            case 1:
                if($this->EditarPrioridadId_Prioridad($this->ID, $objSubMenu->Prioridad) &&
                $objSubMenu->EditarPrioridadId_Prioridad($objSubMenu->ID, $this->Prioridad))
                return  true;
                break;
        }
    }
    
    public function EditarPrioridadId_Prioridad($ID,$Prioridad){
        $obJSubMenu = new SubMenu();
        
        $obJSubMenu->ID = $ID;
        $obJSubMenu->Prioridad = $Prioridad;
        $con = Conexion();
        $query = "update Submenus set Prioridad = '$obJSubMenu->Prioridad' where ID = '$obJSubMenu->ID'";
        echo $query;
        $objSQL = new SQL_DML();
        return $objSQL->Execute($query);
    }

    public function ConsultarTodo() {
        $con = Conexion();
        $query = "select * from SubMenus";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new SubMenu();
            $objSubMenu->ID = utf8_encode($Datos['ID']);
            $objSubMenu->Clave = utf8_encode($Datos['Clave']);
            $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
            $objSubMenu->Foto=utf8_encode($Datos['Foto']);
            $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
            $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
            $objSubMenu->Visible = utf8_encode($Datos['Visible']);
            $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
            array_push($submenus, $objSubMenu);
            
            }
            return $submenus;
    }
    
    public function ConsultarSubMenuPlatillosDisponibles(){
        $con = Conexion();
        $query = "Select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdTipo = 1 and Visible = 1 order by Prioridad";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objSubMenu = new SubMenu();
                $objSubMenu->ID = utf8_encode($Datos['ID']);
                $objSubMenu->Clave = utf8_encode($Datos['Clave']);
                $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
                $objSubMenu->Foto=utf8_encode($Datos['Foto']);
                $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
                $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
                $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
                $objSubMenu->Visible = utf8_encode($Datos['Visible']);
                $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
                array_push($submenus, $objSubMenu);
            }
            return $submenus;
    }
    
    public function ConsultarSubMenuPlatillosTodo(){
        $con = Conexion();
        $query = "Select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdTipo = 1  order by Prioridad";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objSubMenu = new SubMenu();
                $objSubMenu->ID = utf8_encode($Datos['ID']);
                $objSubMenu->Clave = utf8_encode($Datos['Clave']);
                $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
                $objSubMenu->Foto=utf8_encode($Datos['Foto']);
                $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
                $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
                $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
                $objSubMenu->Visible = utf8_encode($Datos['Visible']);
                $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
                array_push($submenus, $objSubMenu);
            }
            return $submenus;
    }
    
    
     public function ConsultarRutaPlatillos_Vinos($IdTipo){
        $con = Conexion();
        $query = "Select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdTipo = $IdTipo order by Ruta";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objSubMenu = new SubMenu();
                $objSubMenu->ID = utf8_encode($Datos['ID']);
                $objSubMenu->Clave = utf8_encode($Datos['Clave']);
                $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
                $objSubMenu->Foto=utf8_encode($Datos['Foto']);
                $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
                $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
                $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
                $objSubMenu->Visible = utf8_encode($Datos['Visible']);
                $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
                array_push($submenus, $objSubMenu);
            }
            return $submenus;
    }
    
    
    public function ConsultarSubMenuBebidasDisponibles(){
        $con = Conexion();
        $query = "Select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdTipo = 2 and Visible = 1 order by Ruta";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objSubMenu = new SubMenu();
                $objSubMenu->ID = utf8_encode($Datos['ID']);
                $objSubMenu->Clave = utf8_encode($Datos['Clave']);
                $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
                $objSubMenu->Foto=utf8_encode($Datos['Foto']);
                $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
                $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
                $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
                $objSubMenu->Visible = utf8_encode($Datos['Visible']);
                $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
                array_push($submenus, $objSubMenu);
            }
            return $submenus;
    }
    
    public function ConsultarSubMenuBebidasTodo(){
        $con = Conexion();
        $query = "Select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdTipo = 2  order by Ruta";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objSubMenu = new SubMenu();
                $objSubMenu->ID = utf8_encode($Datos['ID']);
                $objSubMenu->Clave = utf8_encode($Datos['Clave']);
                $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
                $objSubMenu->Foto=utf8_encode($Datos['Foto']);
                $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
                $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
                $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
                $objSubMenu->Visible = utf8_encode($Datos['Visible']);
                $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
                array_push($submenus, $objSubMenu);
            }
            return $submenus;
    }
    
    


    public function ConsultarPorIDPlatillo($ID) {
        $con = Conexion();
         $query = "select dbo.GetRutaSubMenu(Submenus.ID,1) from Submenus join PlatillosSubMenus 
                    on PlatillosSubMenus.IdSubMenu = Submenus.ID
                    join Platillos on PlatillosSubMenus.IdPlatillo = Platillos.ID
                    where Platillos.ID = $ID and Submenus.IdTipo = 1";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new SubMenu();
            $objSubMenu->Clave = utf8_encode($Datos[0]);
            array_push($submenus, $objSubMenu);
            
            }
            return $submenus;
    }
    
    
    
    
    
    public function ConsultarPorIDVino($ID) {
        $con = Conexion();
         $query = "select dbo.GetRutaSubMenu(Submenus.ID,1) from Submenus join VinosSubMenu
        on VinosSubMenu.IdSubMenu = Submenus.ID
        join Vinos on VinosSubMenu.IdVino = Vinos.ID
        where Vinos.ID = $ID and Submenus.IdTipo = 2";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new SubMenu();
            $objSubMenu->Clave = utf8_encode($Datos[0]);
            array_push($submenus, $objSubMenu);
            
            }
            return $submenus;
    }
    
    
    public function ConsultarSubMenusSinPadre(){
        
        $con = Conexion();
        $query = "select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdSubMenuPadre is Null";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new SubMenu();
            $objSubMenu->ID = utf8_encode($Datos['ID']);
            $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
            $objSubMenu->Clave = utf8_encode($Datos['Clave']);
            $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
            $objSubMenu->Foto=(substr($Datos['Foto'],3));
            $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
            $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
            $objSubMenu->Visible = utf8_encode($Datos['Visible']);
            $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
            array_push($submenus, $objSubMenu);
            
            }
            return $submenus;
    }
    
    public function ConsultarSubMenuPorIDPadre($ID){
        $con = Conexion();
       
        $query = "select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdSubMenuPadre = $ID and Visible = 1 order by Prioridad";
        
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new SubMenu();
            $objSubMenu->ID = utf8_encode($Datos['ID']);
            $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
            $objSubMenu->Clave = utf8_encode($Datos['Clave']);
            $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
            $objSubMenu->Foto=(substr($Datos['Foto'],3));
            $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
            $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
            $objSubMenu->Visible = utf8_encode($Datos['Visible']);
            $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
            array_push($submenus, $objSubMenu);
            
            }
            return $submenus;
    }
    
    public function ConsultarSubMenuPorIDPadreTodo($ID){
        $con = Conexion();
       
        $query = "select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdSubMenuPadre = $ID  order by Prioridad";
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new SubMenu();
            $objSubMenu->ID = utf8_encode($Datos['ID']);
            $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
            $objSubMenu->Clave = utf8_encode($Datos['Clave']);
            $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
            $objSubMenu->Foto=(substr($Datos['Foto'],3));
            $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
            $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
            $objSubMenu->Visible = utf8_encode($Datos['Visible']);
            $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
            array_push($submenus, $objSubMenu);
            
            }
            
            return $submenus;
    }
    
    
    public function ConsultarSubMenuPorIDPadreArreglo($IdTipo,$ID=null){
        $con = Conexion();
        
        $query = "select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where IdSubMenuPadre = $IdTipo"; 
        /*if(count($ID)>0){
            foreach ($ID as $d){
                $query.= " or IdSubMenuPadre = $d";
            }
        }*/
        
        $query.= " order by Prioridad";
        
        $submenus = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objSubMenu = new SubMenu();
            $objSubMenu->ID = utf8_encode($Datos['ID']);
            $objSubMenu->Descripcion = utf8_encode($Datos['Descripcion']);
            $objSubMenu->Clave = utf8_encode($Datos['Clave']);
            $objSubMenu->Ruta = utf8_encode($Datos['Ruta']);
            $objSubMenu->Foto=(substr($Datos['Foto'],3));
            $objSubMenu->IdTipo = utf8_encode($Datos['IdTipo']);
            $objSubMenu->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
            $objSubMenu->Visible = utf8_encode($Datos['Visible']);
            $objSubMenu->Prioridad = utf8_encode($Datos['Prioridad']);
            array_push($submenus, $objSubMenu);
            
            }
            return $submenus;
    }
    
    
    public function ConsultarSubMenuPorID($ID){
        $con = Conexion();
        $query = "select *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where ID = $ID order by Ruta";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->ID = utf8_encode($Datos['ID']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Ruta = utf8_encode($Datos['Ruta']);
            $this->Foto=(substr($Datos['Foto'],3));
            $this->IdTipo = utf8_encode($Datos['IdTipo']);
            $this->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
            $this->Visible = utf8_encode($Datos['Visible']);
            $this->Prioridad = utf8_encode($Datos['Prioridad']);
            }

    }
    
    
    public function ConsultarSubMenuPorClave($Clave){
        $con = Conexion();
        $query = "select top 1 *, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where Clave = '$Clave'";
        $res = false;
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->ID = utf8_encode($Datos['ID']);
            $this->Descripcion = utf8_encode($Datos['Descripcion']);
            $this->Clave = utf8_encode($Datos['Clave']);
            $this->Ruta = utf8_encode($Datos['Ruta']);
            $this->Foto=(substr($Datos['Foto'],3));
            $this->IdTipo = utf8_encode($Datos['IdTipo']);
            $this->IdSubMenuPadre = utf8_encode($Datos['IdSubMenuPadre']);
            $this->Visible = utf8_encode($Datos['Visible']);
            $this->Prioridad = utf8_encode($Datos['Prioridad']);
            $res = true;
            }
            return $res;

    }
    
    
    public function ConsultarRutaActual($idSubMenu){
        
        $con = Conexion();
        $query = "Select IdTipo, dbo.GetRutaSubMenu(ID,1) as Ruta from Submenus where Submenus.ID = $idSubMenu";
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $this->Ruta = utf8_encode($Datos['Ruta']);
            $this->IdTipo = utf8_encode($Datos['IdTipo']);
            }
            
    }
        
    }
    
    
    
    
        
            
    
