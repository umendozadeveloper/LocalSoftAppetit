<?php
include_once '../Clases/Configuracion.php';
include_once '../Clases/Banner.php';
class N_ConfigGeneral{
    public $objConfig;
    public $errores;
    public $campo;
    public $Visible;
    



    public function __construct() {
        $this->objConfig = new Configuracion();
        $this->errores = array();
        
    }
    
    public function main(){
        if(isset($_POST['Campo'])){
            $this->campo = $_POST['Campo'];
        }
        else{
            array_push($this->errores, "No se seleccionó campo");
        }
        if(isset($_POST['Visible'])){
            $this->Visible = $_POST['Visible'];
        }
        else{
            array_push($this->errores, "No se asignó valor");
        }        
        if($this->errores){
            foreach($this->errores as $e){
                echo $e;
            }
        }
        
        else{
            
            
            $this->objConfig->Consultar();
            
            /**
             * 1 Calif platillos
             * 2 Calif bebidas
             * 3 Clientes VIP
             * 4 Publicidad
             */
            switch ($this->campo){
                case 1:
                    $this->objConfig->CalificacionPlatillos = $this->Visible;
                    break;
                
                case 2:
                    $this->objConfig->CalificacionBebidas = $this->Visible;
                    break;
                
                case 3:
                    $this->objConfig->ClientesVIP = $this->Visible;
                    break;
                
                case 4:
                    $this->objConfig->Publicidad = $this->Visible;
                    $objBanner = new Banner();
                    $objBanner->Mostrar_OcultarPublicidad($this->Visible);
                    break;
                   
            }
            
            if($this->objConfig->Modificar($this->objConfig->Publicidad, 
                    $this->objConfig->CalificacionPlatillos, $this->objConfig->CalificacionBebidas, $this->objConfig->ClientesVIP)){
                echo "Correcto";
                
            }    
        }
        
    }
}

$objN_ConfigGeneral = new N_ConfigGeneral();
$objN_ConfigGeneral->main();

?>