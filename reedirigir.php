<?php
include_once './Clases/Seguridad.php';
$seguridad = new Seguridad();
        if($seguridad->isLoggedIn()){
            
            //Comensal
            if($seguridad->CurrentUserPerfil()==3){
                header("Location: VentanaModalParaMenuBixa.php?idComanda=".$seguridad->CurrentUserID()."");
            }
            
            //Mesero
            if($seguridad->CurrentUserPerfil()==2){
                header("Location: F_M_ConsultarComandas.php");
            }
            
            //Admin
            if($seguridad->CurrentUserPerfil()==1){
                if($_SESSION['ScriptAdmin']=="F_A_LoginCocina.php"){
                    header("Location: F_A_MonitorCocina.php");
                }
                else if($_SESSION['ScriptAdmin']=="F_A_LoginBar.php"){
                    header("Location: F_A_MonitorBar.php");
                }
                else{
                    header("Location: F_A_PaginaPrincipal.php");
                }
            }
        }
        
        ?>