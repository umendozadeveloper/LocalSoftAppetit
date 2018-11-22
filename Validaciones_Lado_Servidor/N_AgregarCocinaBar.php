<?php
include_once '../Clases/ComandaPlatillos.php';
include_once '../Clases/ComandaVinos.php';
include_once '../Clases/CocinaBar.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
class N_AgregarCocinaBar {
    public $objCocina;
    public $errores;
    public $objComandaVinos;
    public $objComandaPlatillos;
            
    function __construct() {
        $this->objCocina = new CocinaBar();
        $this->errores = array();
        $this->objComandaPlatillos = new ComandaPlatillos();
        $this->objComandaVinos = new ComandaVinos();
    }
    
    function main(){
        if(isset($_POST['IdComanda'])){
            $this->objCocina->IdComanda = $_POST['IdComanda'];
        }
        else {
            array_push($this->errores,"No se seleccionó comanda");
        }
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
                header("Location: ../F_M_ConsultarComandas.php");
            }
        }
        else{
            
            ///Se llena el insert para la cocina
           $platillosPedidos = $this->objComandaPlatillos->ConsultarPorIdComandaPedido($this->objCocina->IdComanda);
           $this->objCocina->IdProductos = "";
           $this->objCocina->IdTipo = 1;
           $i=0;
           foreach ($platillosPedidos as $pP){
               $this->objCocina->IdProductos .= $pP->ID;
               if($i<count($platillosPedidos)-1){
                   $this->objCocina->IdProductos.=",";
               }
               $i++;
               $this->objComandaPlatillos->EditarEstado($pP->ID, 3);
           }
           if(count($platillosPedidos)>0){
               
               
                $objCocinaTmp = new CocinaBar();
                if(!$objCocinaTmp->ConsultarPorIdComanda($this->objCocina->IdComanda,1))
                {
                    $this->objCocina->Insertar($this->objCocina->IdComanda, $this->objCocina->IdProductos, $this->objCocina->IdTipo);
                }
                else{
                    $this->objCocina->Insertar($this->objCocina->IdComanda, $this->objCocina->IdProductos, $this->objCocina->IdTipo,1);
                }
                
           }
           /*echo "<br>IdTipo: ".$this->objCocina->IdTipo;
           echo "<br>IdProductos: ".$this->objCocina->IdProductos; 
            */
            
            
          
            
           //Se llena el insert para el bar
           $vinosPedidos = $this->objComandaVinos->ConsultarPorIdComandaPedido($this->objCocina->IdComanda);
           $this->objCocina->IdProductos = "";
           $this->objCocina->IdTipo = 2;
           $i=0;
           foreach ($vinosPedidos as $vP){
               $this->objCocina->IdProductos .= $vP->ID;
               if($i<count($vinosPedidos)-1){
                   $this->objCocina->IdProductos.=",";
               }
               $i++;
               $this->objComandaVinos->EditarEstado($vP->ID, 3);
           }
           if(count($vinosPedidos)>0){
                $objCocinaTmp = new CocinaBar();
                if(!$objCocinaTmp->ConsultarPorIdComanda($this->objCocina->IdComanda,2))
                {
                    $this->objCocina->Insertar($this->objCocina->IdComanda, $this->objCocina->IdProductos, $this->objCocina->IdTipo);
                }
                else{
                    $this->objCocina->Insertar($this->objCocina->IdComanda, $this->objCocina->IdProductos, $this->objCocina->IdTipo,1);
                }
           }
           /*echo "<br>IdTipo: ".$this->objCocina->IdTipo;
           echo "<br>IdProductos: ".$this->objCocina->IdProductos;
           */
           
//          setSuccessMessage("Producto(s) enviados correctamente");
//           header("Location: ../F_M_Comanda_A_Detalle.php?idComanda=".$this->objCocina->IdComanda);
           echo 1;
        }
        
    }
}


$objN_AgregarCocinaBar = new N_AgregarCocinaBar();
$objN_AgregarCocinaBar->main();




