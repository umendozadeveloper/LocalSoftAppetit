<?php
include_once '../Clases/SubMenu.php';
include_once '../Clases/Platillo.php';
include_once '../Clases/Vino.php';

class EditarVisibilidad{
   
    function main(){
       $ID = $_POST['ID'];
       $Tipo = $_POST['Tipo'];
       $Visible = $_POST['Visible'];
       
       switch ($Tipo){
           case "Submenu":
               $objSubmenu = new SubMenu();
               if($objSubmenu->EditarVisible($ID, $Visible))
                       echo "1";
               else{
                   echo "0";
               }
               break;
               
           case "Alimentos":
               $objAlimentos = new Platillo();
               if($objAlimentos->EditarVisible($ID, $Visible)){
                   echo "1";
               }
               else{
                   echo "0";
               }
               break;
               
            case "Bebidas":
               $objBebidas = new Vino();
               if($objBebidas->EditarVisible($ID, $Visible)){
                   echo "1";
               }
               else{
                   echo "0";
               }
               break;
               
           default:
               break;
       }
    }   
}

$objEditarVisible = new EditarVisibilidad();
$objEditarVisible->main();


?>