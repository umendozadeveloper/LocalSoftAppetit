<?php
include_once  'SQL_DML.php';
class VistaMPV {
    public $ID;
    public $Clave;
    public $Ruta;
    public $Descripcion;
    public $Foto;
    public $Tipo;
    public $IdTipo;


    public function VistaMPV(){
        
    }

        public function ConsultarSinPadre(){
        $con = Conexion();
        $query = "Select 'SubMenu' as Tipo,dbo.GetRutaSubMenu(ID,1) as Ruta, sm.ID,sm.Foto,sm.Clave,sm.Descripcion ".
                  " from Submenus sm".
                  " Where sm.IdSubMenuPadre is Null";
        $vistas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objVistas = new VistaMPV();
            $objVistas->ID = utf8_encode($Datos['ID']);
            $objVistas->Clave = utf8_encode($Datos['Clave']);
            $objVistas->Descripcion = utf8_encode($Datos['Descripcion']);
            $objVistas->Foto=utf8_encode(substr($Datos['Foto'],3));
            $objVistas->Tipo = utf8_encode($Datos['Tipo']);
            $objVistas->Ruta = utf8_encode($Datos['Ruta']);
            array_push($vistas, $objVistas);
            
            }
            return $vistas;
        }
        
        
        public function ConsultarPVSPorBusqueda($Busqueda){
            $con = Conexion();
        $query =" Declare @IdSubMEnu varchar(255);
                  set @IdSubMEnu = '$Busqueda'
                  Select 'SubMenu' as Tipo, sm.IdTipo ,sm.Prioridad,sm.Visible, sm.ID,sm.Foto,sm.Clave,sm.Descripcion 
                  from Submenus sm
                  Where sm.Clave like '%'+@IdSubMEnu+'%' and sm.Visible = 1
                  Union all
                  Select 'Platillos' as Tipo,'1' as IdTipo,p.Prioridad, p.Visible, p.ID, p.Icono, p.Nombre, p.DescripcionCorta
                  From Platillos p
                  Where p.Nombre like '%'+@IdSubMEnu+'%' and p.Visible = 1 
                  Union all
                  Select 'Vinos' as Tipo,'1' as IdTipo,v.Prioridad,v.Visible, v.ID, v.Icono, v.Nombre, v.DescripcionCorta
                  From Vinos v 
                  Where v.Nombre like '%'+@IdSubMEnu+'%' and v.Visible = 1 
                  order by Prioridad";
                $vistas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objVistas = new VistaMPV();
            $objVistas->ID = utf8_encode($Datos['ID']);
            $objVistas->Clave = utf8_encode($Datos['Clave']);
            $objVistas->Descripcion = utf8_encode($Datos['Descripcion']);
            $objVistas->Foto=utf8_encode(substr($Datos['Foto'],3));
            $objVistas->Tipo = utf8_encode($Datos['Tipo']);
            $objVistas->IdTipo = utf8_encode($Datos['IdTipo']);
            array_push($vistas, $objVistas);
            
            }
            
            return $vistas;
        }


        public function ConsultarPVS($ID){
            $con = Conexion();
        $query =" Declare @IdSubMEnu int;
                  set @IdSubMEnu = $ID
                  Select 'SubMenu' as Tipo, sm.IdTipo ,dbo.GetRutaSubMenu(ID,1) as Ruta,sm.Prioridad,sm.Visible, sm.ID,sm.Foto,sm.Clave,sm.Descripcion 
                  from Submenus sm
                  Where sm.IdSubMenuPadre = @IdSubMEnu and sm.Visible = 1
                  Union all
                  Select 'Platillos' as Tipo,'1' as IdTipo,dbo.GetRutaSubMenu(Submenus.ID,1) as Ruta,p.Prioridad, p.Visible, p.ID, p.Icono, p.Nombre, p.DescripcionCorta
                  From Platillos p
                  join PlatillosSubMenus psm on psm.IdPlatillo = p.ID
                  join Submenus on Submenus.ID = psm.IdSubMenu
                  Where psm.IdSubMenu = @IdSubMEnu and p.Visible = 1 
                  Union all
                  Select 'Vinos' as Tipo,'1' as IdTipo,dbo.GetRutaSubMenu(Submenus.ID,1) as Ruta,v.Prioridad,v.Visible, v.ID, v.Icono, v.Nombre, v.DescripcionCorta
                  From Vinos v 
                  join VinosSubMenu vsm on vsm.IdVino = v.ID
                  join Submenus on Submenus.ID = vsm.IdSubMenu
                  Where vsm.IdSubMenu = @IdSubMEnu and v.Visible = 1 
                  order by Prioridad";
        $vistas = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objVistas = new VistaMPV();
            $objVistas->ID = utf8_encode($Datos['ID']);
            $objVistas->Clave = utf8_encode($Datos['Clave']);
            $objVistas->Descripcion = utf8_encode($Datos['Descripcion']);
            $objVistas->Foto=utf8_encode(substr($Datos['Foto'],3));
            $objVistas->Tipo = utf8_encode($Datos['Tipo']);
            $objVistas->Ruta = utf8_encode($Datos['Ruta']);
            $objVistas->IdTipo = utf8_encode($Datos['IdTipo']);
            array_push($vistas, $objVistas);
            
            }
            
            return $vistas;
        }
        
        public function ConsultarRuta($ID){
        $con = Conexion();    
            if($ID=="_"){
                return "Raíz";
            }
            else
            {
                $query = "Select dbo.GetRutaSubMenu(ID,1) as Ruta from SubMenus where ID = $ID";
                $vistas = array();
                $valor = sqlsrv_query($con,$query);
                while($Datos = sqlsrv_fetch_array($valor)){
                    $objVistas = new VistaMPV();
                    $objVistas->Ruta = utf8_encode($Datos['Ruta']);
                    array_push($vistas, $objVistas);
                    }
                    return $vistas;    
            }
        }
    
}

?>