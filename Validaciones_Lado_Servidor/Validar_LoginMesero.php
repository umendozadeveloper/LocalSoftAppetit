
<?php
include_once '../Clases/Mesero.php';
include_once '../Clases/Seguridad.php';
session_start();
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
        $objMesero = new Mesero();
        $mesero = $objMesero->Login($usuario, $contrasena);
        if(count($mesero)>0)
        {
        if(Valida_Login($usuario,$contrasena)){
            if ($objMesero->Login($usuario, $contrasena))
            {
                $objSeguridad = new Seguridad();
                $objSeguridad->asignaComandearMesero($mesero[0]->ID, 2, $mesero[0]->Usuario);
                array_push($mensajes, "Correcto");
                //$_SESSION['usuario'] = $mesero[0]->Usuario;
                //$_SESSION['msjLoginAd']=null;
                header("Location: ../F_M_ConsultarComandas.php");
   
            }
            else
            {
                array_push($mensajes,"Usuario o contraseña incorrectos");
                header("Location: ../F_M_LoginMesero.php");
            }
            
            
        }
        else 
        {
                $mensajes=$errores;
                header("Location: ../F_M_LoginMesero.php");
        }
        }
        else
        {
            array_push ($mensajes, "Usuario o contraseña incorrectos");
            header("Location: ../F_M_LoginMesero.php");
            $_SESSION['msjLoginAd']=$mensajes;
        }
        
    }
?>
        </body>
</html>