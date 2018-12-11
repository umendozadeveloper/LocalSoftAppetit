<?php
include_once '../Clases/Seguridad.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/SubMenu.php';
$errores = array();




if ($_POST) {  
        $nombre = $_REQUEST['txtNombre'];
        $descripcion = $_REQUEST['txtDescripcion'];
        $foto = $_FILES['archivo']['name'];
        $tipo= $_REQUEST['cmbTipo'];
        $menu= $_REQUEST['cmbMenu'];
        if($menu==NULL){
            $menu="";
        }
        $destinoFoto ="../bd_Fotos/SubMenu/". rand(0, 9999999)."_".$foto;
        $rutaFoto = $_FILES['archivo']['tmp_name'];
        
        $objSubMenu = new SubMenu();
        $mensajes=array();
        
        
            if ($objSubMenu->InsertarSubMenu($nombre, $descripcion, $destinoFoto,$tipo,$menu))
            {
                
                
                if($foto!="")
                if(copy($rutaFoto, $destinoFoto))
                {
                    echo "";
                }
                
            $_SESSION['msjSubMenu']="Correcto";
            header("Location: ../F_A_ConsultarSubMenus.php?idSubMenu=$menu");
            
   
            }
            else
            {
                setFailureMessage("No se agregó el menú favor de verificar los datos ingresados");
                
                header("Location: ../F_A_ConsultarSubMenus.php?idSubMenu=$menu");
            }

        }
        
    
?>
    


