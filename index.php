        <?php
        include_once './Clases/Seguridad.php';
        include_once './Validaciones_Lado_Servidor/Funciones/P_SwalMensajes.php';
        if(isset($_SESSION['error_Conexion']) && !empty( $_SESSION['error_Conexion'])){
            setSwalFailureMessage("No se puede conectar al servidor, por favor contacte al administrador");
            //header("Location: www.google.com");
            $_SESSION['error_Conexion']=null;   
        }
        header("Location: F_A_Login.php");
        ?>
