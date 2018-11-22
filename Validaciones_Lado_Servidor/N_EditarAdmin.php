<?php
session_start();
include_once '../Clases/Usuario.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once '../Clases/Seguridad.php';
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
        
//        if(is_null($direccion))
//        {
//            array_push($errores, "El campo ubicación no puede estar vacio");
//        }
//        if(is_null($telefono))
//        {
//            array_push($errores, "El campo ubicación no puede estar vacio");
//        }
//        if(is_null($correo))
//        {
//            array_push($errores, "El campo ubicación no puede estar vacio");
//        }
        
        
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
        $PrivilegiosMesero = $_REQUEST['cmbPrivilegiosM'];
        if($banderaFoto=="Si"){
            $foto = $_FILES['archivo']['name'];
            $extensionFoto = explode(".", $foto);
            //$destinoFoto ="../bd_Fotos/Meseros/".$idOriginal.$extensionFoto;
            $destinoFoto ="bd_Fotos/Usuarios/".$idOriginal."Foto.".$extensionFoto[1]."";
            $rutaFoto = $_FILES['archivo']['tmp_name'];
        }
        else{
//            $destinoFoto="";
//            $foto = "";
            $objAdmin = new Usuario();
            $objAdmin->ConsultarPorID($idOriginal);
            $destinoFoto= $objAdmin->Foto;
        }
        $objUsuario = new Usuario();
        $mensajes=array();
        
        
        
        
        if(Validar($nombreUsuario, $nombre,$apellidos,$direccion,$telefono,$correo)){
            
            if ($objUsuario->Modificar($idOriginal,$nombreUsuario,$contrasena,$nombre,$apellidos,$direccion,$telefono,
                    $correo,$destinoFoto,$observaciones,$estatus,$PrivilegiosMesero))
            {

                if($foto!=""){
                    if(copy($rutaFoto, ".".$destinoFoto))
                        echo "";
                }
                
                $objMesero = new Mesero();
                if($PrivilegiosMesero=='1')
                {
                    
                    #Hay un registro en meseros con el id del admin, se modifican los datos
                    if($objMesero->ObtenePorIDAdmin($idOriginal))
                    {
                        $objMesero->ModificarMeseroPorID($objMesero->ID, $nombreUsuario, $nombre, $apellidos, $direccion, 
                                $telefono, $correo, $banderaFoto, "../".$destinoFoto, $contrasena, $observaciones, $estatus, $idOriginal);
                    }
                    #No hay registro en meseros, se debe crear uno
                    else{
                        $objMesero->InsertarMeseroPorAdmin($nombreUsuario, $contrasena,"../". $destinoFoto, $nombre, $apellidos,
                                $direccion, $telefono, $correo, $observaciones, $estatus, $idOriginal);
                    }
  
                }
                else{
                    if($objMesero->ObtenePorIDAdmin($idOriginal)){#había registro, cambiar Status a false
                        $objMesero->ModificarMeseroPorID($objMesero->ID, $nombreUsuario, $nombre, $apellidos, $direccion, 
                                $telefono, $correo, $banderaFoto, "../".$destinoFoto, $contrasena, $observaciones, '0', $idOriginal);
                    }
                }
                
//                array_push($mensajes, "Administrador editado correctamente");
                setSuccessMessage("Administrador editado correctamente");
                header("Location: ../F_A_EditarAdmin.php?Id_Admin=$idOriginal");
                
                
                
   
            }
            else
            {
//                array_push($mensajes, "El nombre de usuario ya existe favor de introducir otro");
                setFailureMessage("El nombre de usuario ya existe favor de introducir otro");
                header("Location: ../F_A_EditarAdmin.php?Id_Admin=$idOriginal");
                
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
    


