
<?php
include_once '../Clases/Usuario.php';
include_once '../Clases/Seguridad.php';
$errores = array();


function Valida_Login($usuario,$contrasena){
        global $errores;
        if(is_null($usuario))
        {
            array_push($errores, "El nombre de usuario no puede estar vacio");
        }
        if(is_null($contrasena))
        {
            array_push($errores, "La contraseña no puede estar vacia");
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
    if($_POST)
    {
        $usuario = $_POST['txtUsuario'];
        $contrasena = $_POST['txtContrasena'];
        $mensajes=array();
        $objMesero = new Usuario();
        $mesero = $objMesero->Login($usuario, $contrasena);
        if(count($objMesero)>0)
        {
        if(Valida_Login($usuario,$contrasena)){
            if ($objMesero->Login($usuario, $contrasena))
            {
                array_push($mensajes, "");
                $_SESSION['msjLoginAd']=null;
                $objSeguridad = new Seguridad();
                $objSeguridad->asigna($mesero[0]->Id, 1, $mesero[0]->Usuario);
                header("Location: ../F_A_PaginaPrincipal.php");
   
            }
            else
            {
                array_push($mensajes,"Usuario o contraseña incorrectos");
                header("Location: ../F_A_Login.php");
            }

        }
        else 
        {
                $mensajes=$errores;
             //   header("Location: Login.php");
        }
        }
        else
            array_push ($mensajes, "Usuario o contraseña incorrectos");
        $_SESSION['msjLoginAd']=$mensajes;
    }
?>
        </body>
</html>