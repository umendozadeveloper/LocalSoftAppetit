<?php
include_once  './Clases/SQL_DML.php';
include_once './Clases/SubMenu.php';

class Prioridad{
    public $ID_PADRE;
    public $Incremento;
    public $ArregloBase;
            
    
    function __construct() {
        $this->Incremento = 0;
        //$this->ID_PADRE = $_POST['txtPrioridad'];
        $this->ArregloBase = array();
    }
            
function ObtenerIncrementoPrioridad(){
$Prioridad = $_POST['txtPrioridad'];
$Prioridad = explode(".", $Prioridad);
$cantidad = "0";
if(count($Prioridad)==1){
    $cantidad = "1";
}
else{
   
    for($i = 0; $i<count($Prioridad)-1; $i++){
        if($i==  count($Prioridad)-2){
            $cantidad.=".1";
        }
        else{
            $cantidad.=".0";
        }
    }
}
    echo $cantidad;
}

public $i = 0;
function PintarMenuRecursivo($ID_PADRE,$Avanzar=false){
   
   $Arreglo = "4,7,9";
   $Arreglo = explode(",", $Arreglo);
   $objSubMenu = new SubMenu();
   $this->i++;
   if(in_array($ID_PADRE, $Arreglo)){
       
       $subMenus = $objSubMenu->ConsultarSubMenuPorIDPadre($ID_PADRE);
       foreach($subMenus as $s){
           //echo $s->ID;
              if(!in_array($s->ID,  $this->ArregloBase)){
                    echo $s->ID." ".$this->i."<br>";
                    //if(!in_array($this->ArregloBase, $s->IdSubMenuPadre))
                    if(!$Avanzar){
                        return $this->PintarMenuRecursivo($s->ID);
                    }
                    else{
                        $objSubMenu2 = new SubMenu();
                        $objSubMenu2->ConsultarSubMenuPorID($s->IdSubMenuPadre);
                        //echo "Sub".$objSubMenu->IdSubMenuPadre;
                        //$objS2 = new SubMenu();
                        /*$subMenus2 = $objS2->ConsultarSubMenuPorIDPadre($objSubMenu->IdSubMenuPadre);
                        foreach ($subMenus2 as $s2){
                            if($s2->ID){
                                
                            }
                        }*/
                        //if($this->i<5){
                            return $this->PintarMenuRecursivo($objSubMenu2->IdSubMenuPadre);
                        //}
                        
                    }
                        
                    
                }
                else{
                    
                    $objSubMenu->ConsultarSubMenuPorID($ID_PADRE);
                    /*echo "Padre:".$objSubMenu->ID."<br>";
                    echo "Aumento:".$this->i."<br>";*/
                    array_push($this->ArregloBase, $objSubMenu->ID);
                    //print_r($this->ArregloBase);
                    //echo "IdSubMenuPadre:".$objSubMenu->IdSubMenuPadre."<br>";
                    $Avanzar=true;
                    
                    //return $this->PintarMenuRecursivo($objSubMenu->IdSubMenuPadre);
                    
                    
                }
           }
   }
   else{
       $objSubMenu->ConsultarSubMenuPorID($ID_PADRE);
       array_push($this->ArregloBase,$objSubMenu->ID);
       return $this->PintarMenuRecursivo($objSubMenu->IdSubMenuPadre,true);
   }   
}


function obtnerEscalar(){
    $objSQL = new SQL_DML();
    $res = $objSQL->GetScalar("select ID as ID from Submenus where Prioridad < '5.3'  order by Prioridad desc")-1;
    return $res;
}

function go($ID_PADRE){
    
    
    $objSubMenu = new SubMenu();
    $subMenus = $objSubMenu->ConsultarSubMenuPorIDPadre($ID_PADRE);
    foreach($subMenus as $s){
        echo $s->ID;
        echo "<br>";
    }
}


public function Fibo($N){
    if($N==0 || $N==1 )
        return $N;
    else
        return Fibo($N-2)+Fibo($N-1);
}

}

$ObjPri = new Prioridad();
//$ObjPri->PintarMenuRecursivo($ObjPri->ID_PADRE);
//$ObjPri->ObtenerIncrementoPrioridad();
echo $ObjPri->obtnerEscalar();

?>
