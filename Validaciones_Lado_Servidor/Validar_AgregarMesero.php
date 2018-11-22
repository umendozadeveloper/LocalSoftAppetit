<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once '../Clases/Mesero.php';

$errores = array();
function Validar($usuario,$contrasena,$foto,$nombre,$apellidos,$direccion,$telefono,$correo){
        global $errores;
        if(is_null($usuario))
        {
            array_push($errores, "El nombre de usuario no puede quedar vacío");
        }
        if(is_null($contrasena))
        {
            array_push($errores, "La contraseña no puede estar vacío");
        }
        if(is_null($foto))
        {
            array_push($errores, "La contraseña no puede estar vacío");
        }
        if(is_null($nombre))
        {
            array_push($errores, "El nombre no puede quedar vacío");
        }
        if(is_null($apellidos))
        {
            array_push($errores, "Los apellido no pueden quedar en blanco");
        }
        if(is_null($direccion))
        {
            array_push($errores, "La dirección no puede quedar vacía");
        }
        if(is_null($telefono))
        {
//            array_push($errores, "El número de mesas no puede estar vacío");
        }
        if(is_null($correo))
        {
//            array_push($errores, "El número de mesas no puede estar vacío");
        }
        
        
        
        if($errores)
        {
            $_SESSION['tipo'] = "error";
            $_SESSION['titulo'] = "Error";
            return FALSE;
        }
        else
        {   
            return TRUE;
        }
    }



if($_POST){
        $objMesero = new Mesero();
        $usuario = $_POST['txtUsuario'];
        $contrasena = $_POST['txtContrasena'];
        $nombre = $_POST['txtNombre'];
        $apellidos = $_POST['txtApellidos'];
        $direccion = $_POST['txtDireccion'];
        $telefono= $_POST['txtTelefono'];
        $correo= $_POST['txtCorreo'];
        $observaciones = $_POST['txtObservaciones'];
        $estatus = $_POST['cmbEstatus'];
        
        $foto = $_FILES['archivo']['name'];
        $extensionFoto = explode(".", $foto);
        $destino ="../bd_Fotos/Meseros/".$objMesero->obtenerId()."Foto.".$extensionFoto[1]."";
        //$destino ="../bd_Fotos/Meseros/".$usuario.$foto;
        $ruta = $_FILES['archivo']['tmp_name'];

        $mensajes=array();
        
        if(Validar($usuario,$contrasena,$foto,$nombre,$apellidos,$direccion,$telefono,$correo)){
            $_SESSION['valUsuario'] = $usuario;
            $_SESSION['valContrasena'] = $contrasena;
            $_SESSION['valFoto'] = $foto;
            $_SESSION['valNombre'] = $nombre;
            $_SESSION['valApellidos'] = $apellidos;
            $_SESSION['valDireccion'] = $direccion;
            $_SESSION['valTelefono'] = $telefono;
            $_SESSION['valCorreo'] = $correo;
            $_SESSION['valObservac'] = $observaciones;
            $_SESSION['valEstatus'] = $estatus;
            
            if ($objMesero->InsertarMesero($usuario, $contrasena, $destino, $nombre, $apellidos, $direccion, $telefono, $correo, $observaciones, $estatus))
            {
                if($foto!="")
                if(copy($ruta, $destino))
                {
                    echo "";
                }
            
            $_SESSION['tipo'] = "success";
            $_SESSION['titulo'] = "Correcto";
            $_SESSION['valUsuario'] = NULL;
            $_SESSION['valContrasena'] = NULL;
            $_SESSION['valFoto'] = NULL;
            $_SESSION['valNombre'] = NULL;
            $_SESSION['valApellidos'] = NULL;
            $_SESSION['valDireccion'] = NULL;
            $_SESSION['valTelefono'] = NULL;
            $_SESSION['valCorreo'] = NULL;
            $_SESSION['valObservac'] = null;
            $_SESSION['valEstatus'] = null;
            setSuccessMessage("Mesero registrado correctamente");
            
            header("Location: ../F_A_DetalleMesero.php?IdMesero=$objMesero->ID");
                
                
         
            }
            else
            {
                $_SESSION['tipo'] = "error";
                $_SESSION['titulo'] = "Error";
                array_push($mensajes, "El nombre de usuario ya existe, favor de ingresar otro valor");
                header("Location: ../F_A_RegistrarMesero.php");
                
            }

        }
        else 
        {
                $mensajes=$errores;
                header("Location: ../F_A_RegistrarMesero.php");
        }
        
        $_SESSION['msjRegistrarMesero']= $mensajes;
    }
?>
    


