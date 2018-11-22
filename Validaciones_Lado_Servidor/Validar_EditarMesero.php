<?php
session_start();
include_once '../Clases/Mesero.php';

$errores = array();

        
function Validar($nombreUsuario, $nombre,$apellidos,$direccion,$telefono,$correo){
        global $errores;
        if(is_null($nombreUsuario))
        {
            array_push($errores, "El número de mesas no puede estar vacío");
        }
        if(is_null($nombre))
        {
            array_push($errores, "La cantidad de personas por mesa no puede estar vacía");
        }
        
        if(is_null($apellidos))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        
        if(is_null($direccion))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        if(is_null($telefono))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        if(is_null($correo))
        {
            array_push($errores, "El campo ubicación no puede estar vacio");
        }
        
        
        if($errores)
        {
            return FALSE;
        }
        else
        {   
            return TRUE;
        }
    }



if($_POST){
    
        $idOriginal =   ($_REQUEST['respaldoDatosP']);
        $nombreUsuario =   ($_REQUEST['txtNombreUsuario']);
        $nombre =   ($_REQUEST['txtNombre']);
        $apellidos  =   ($_REQUEST['txtApellidos']);
        $direccion =   ($_REQUEST['txtDireccion']);
        $telefono =   ($_REQUEST['txtTelefono']);
        $correo =   ($_REQUEST['txtCorreo']);
        $contrasena =   ($_REQUEST['txtContrasena']);
        $banderaFoto = $_REQUEST['cmbFoto'];
        $observaciones = $_REQUEST['txtObservaciones'];
        $estatus = $_REQUEST['cmbEstatus'];
        if($banderaFoto=="Si"){
            $foto = $_FILES['archivo']['name'];
            $extensionFoto = explode(".", $foto);
            //$destinoFoto ="../bd_Fotos/Meseros/".$idOriginal.$extensionFoto;
            $destinoFoto ="../bd_Fotos/Meseros/".$idOriginal."Foto.".$extensionFoto[1]."";
            $rutaFoto = $_FILES['archivo']['tmp_name'];
        }
        else{
            $destinoFoto="";
            $foto = "";
        }
        $objPlatillo = new Mesero();
        $mensajes=array();
        
        
        
        
        if(Validar($nombreUsuario, $nombre,$apellidos,$direccion,$telefono,$correo)){
            
            if ($objPlatillo->ModificarMeseroPorID($idOriginal,$nombreUsuario, $nombre,$apellidos,$direccion,$telefono,$correo,
                    $banderaFoto,$destinoFoto,$contrasena,$observaciones,$estatus))
            {
                
                
                if($foto!=""){
                    if(copy($rutaFoto, $destinoFoto))
                        echo "";
                }
                array_push($mensajes, "Mesero editado correctamente");
                header("Location: ../F_A_EditarMeseros.php?IdMesero=$idOriginal");
                
                
                
   
            }
            else
            {
                array_push($mensajes, "El nombre de usuario ya existe favor de introducir otro");
                header("Location: ../F_A_EditarMeseros.php?IdMesero=$idOriginal");
                
            }

        }
        else 
        {
                $mensajes=$errores;
                //header("Location: Login.php");
        }
        $_SESSION['msjEditarMesero'] = $mensajes;
    }
?>
    


