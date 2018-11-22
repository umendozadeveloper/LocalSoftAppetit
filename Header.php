<?php 
include_once './Clases/Seguridad.php';
include_once './Clases/Empresa.php';
include_once './Validaciones_Lado_Servidor/Funciones/Mensajes_Bootstrap.php';
include_once './Validaciones_Lado_Servidor/Funciones/P_SwalMensajes.php';
$seguridad = new Seguridad();

?>
<!DOCTYPE html>
<html>
    <head>
<meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="img/logo.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="js/paginadoV2/datatables.min.css" rel="stylesheet">
        <link href="js/paginado/DataTableBootsTrap.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        
        
        
        
        <link rel="stylesheet" href="css/styles.css">
        <link href="js/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="css/sweetalert.css" rel="stylesheet">
        <link href="css/bootstrap_ms.css" rel="stylesheet">
        <link href="css/EstiloBIXA.css" rel="stylesheet">        
        <link href="css/landing-page.css" rel="stylesheet">
        
        <link href="css/bootstrap-switch.min.css" rel="stylesheet">
        <link href="css/dropdowns-enhancement.css" rel="stylesheet">
        <link href="css/Rating/star-rating.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script src="js/Alerta.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/sweetalert.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="js/tablaOrdenable/jquery.tablesorter.min.js"></script>
        <script type="text/javascript" src="js/tablaOrdenable/tableSorterPager.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/bootstrap-filestyle.js"></script>
        <script src="js/bootstrap-filestyle.min.js"></script>
        
        <script src="js/paginadoV2/datatables.min.js"></script>
        <script src="js/paginado/IniciarTable.js"></script>
        
        
        <script src="js/bootstrap-switch.js"></script>
        <script src="js/dropdowns-enhancement.min.js"></script>
        
        <script src="js/Rating/star-rating.min.js"></script>
        </head>
        <body>
        
        
            <?php
            
            $empresa = new Empresa();
            $empresa->ObtenerPorID(1);
            
            if ($seguridad->isLoggedIn())
                {
                    
            ?>        
            <div class="LogoBIXAMenu">
                <img src="<?php echo substr($empresa->Logo,3);?>">
            </div>

            <div class="BarraBixa" id="BarraBixa">
                <label><?php echo $empresa->NombreAplicacion;?></label>
            </div>
            
            <?php
            
            if($seguridad->CurrentUserPerfil()==1){
                require_once './opcionesAdmin.php';
            }
            if($seguridad->CurrentUserPerfil()==3){
                require_once './opcionesComensal.php';
            }
            
            if($seguridad->CurrentUserPerfil()==2){
                require_once './opcionesMesero.php';
            }
            
        }
        else{
//                    if(basename($_SERVER['PHP_SELF'])=="F_M_LoginMesero.php" || basename($_SERVER['PHP_SELF'])=="F_A_Login.php" || basename($_SERVER['PHP_SELF'])=="F_C_LoginComensal.php")
//                    {
//                        echo "";
//                    }
//                    else
//                    {
//                            header("Location: F_A_Login.php");
//                    }
            
            
            if(basename($_SERVER['PHP_SELF'])=="F_M_LoginMesero.php"   || 
                       basename($_SERVER['PHP_SELF'])=="F_A_Login.php"         ||
                       basename($_SERVER['PHP_SELF'])=="F_C_LoginComensal.php" ||
                       basename($_SERVER['PHP_SELF'])=="F_A_LoginCocina.php"   ||
                       basename($_SERVER['PHP_SELF'])=="F_A_LoginBar.php")
                    {
                        
                        if(basename($_SERVER['PHP_SELF'])=="F_A_Login.php" ||
                           basename($_SERVER['PHP_SELF'])=="F_A_LoginCocina.php" ||
                           basename($_SERVER['PHP_SELF'])=="F_A_LoginBar.php" ){
                            ?>
                            <style>
                            .intro-header {    
                            background: url('<?php echo substr($empresa->FondoAdministrador,3);?>') no-repeat center center;
                            background-size: cover;
                            }
                            </style> <?php
                        }
                        if(basename($_SERVER['PHP_SELF'])=="F_C_LoginComensal.php" ){
                            ?>
                            <style>
                            .intro-header {    
                            background: url('<?php echo substr($empresa->FondoComensal,3);?>') no-repeat center center;
                            background-size: cover;
                            }
                            </style> <?php
                        }
                        if(basename($_SERVER['PHP_SELF'])=="F_M_LoginMesero.php"){
                            ?>
                            <style>
                            .intro-header {    
                            background: url('<?php echo substr($empresa->FondoMesero,3);?>') no-repeat center center;
                            background-size: cover;
                            }
                            </style> <?php
                        }
                        echo "";
                    }
                    else
                    {
                            header("Location: F_A_Login.php");
                    }
        }
        ShowMessage();        
        ShowSwalMessage();
        include_once './Personalizacion.php';
        
            ?>
            <div style="height: 15px;width: 100%;">
                
            </div>
        <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>


