<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Entrada.php';
include_once '../Clases/Kardex.php';
include_once '../Clases/DetalleEntrada.php';
include_once  '../Clases/SQL_DML.php';
include_once '../Clases/EntradaCompras.php';
require_once "../dompdf/dompdf_config.inc.php";

include_once '../Clases/ListadoConteo.php';


class AgregarInicioInventario {

    public $errores;
    
    public $Fecha;
    public $Observaciones;
    public $IdsInsumos;
    
    
    function __construct() {
        $this->errores = array();
//        $this->objEntrada = new Entrada();
//        $this->objSeguridad = new Seguridad();
    }

    function main() {

        if (isset($_POST['txtFecha'])) {
            $this->Fecha = $_POST['txtFecha'];
        }
        else{
            array_push($this->errores, "No se ha seleccionado la fecha.");
        }
        if (isset($_POST['txtIdsCargados'])) {
            if($_POST['txtIdsCargados']=='-99999'){
                 array_push($this->errores, "No se ha seleccionado ningún filtro.");
            }
            else{
                $this->IdsInsumos =$_POST['txtIdsCargados'];
            }
            
        }else{
            array_push($this->errores, "No se ha seleccionado ningún filtro.");
        }
        if (isset($_POST['txtNotas'])) {
            $this->Observaciones = $_POST['txtNotas'];
        }
        
        
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_InventariosIniciar.php");
        }
        else{
            
            $objSQL = new SQL_DML();
            $IdInventario = $objSQL->GetScalar("select MAX (ID) as ID from Inventarios");
            
            $objInventario = new Inventario();    
            if($objInventario->Insertar($IdInventario, $this->Fecha, $this->Observaciones))
            {
                $todos_ids = split("─", $this->IdsInsumos);
                $contador=0;
                foreach($todos_ids as $insumo)
                {
                    if($contador!=0)
                    {
                       $objConteo = new InventarioConteo();
                       $objConteo->Insertar($IdInventario, $insumo);
                    }
                   $contador++; 
                }
                
                $objListadoConteo = new ListadoConteo();
                
                $objListadoConteo->GenerarListado($IdInventario, '0');
                 $objListadoConteo->GenerarListado($IdInventario, '1');
               
                
                setSuccessMessage("Se registraron los datos correctamente");
                header("Location: ../F_A_InventariosIniciar.php");
            }
            else{
                setSwalFailureMessage("Ocurrió un error, no se pudo registrar el inventario. Intente más tarde.");
                header("Location: ../F_A_InventariosIniciar.php");
            }
            
            
        
       } 
    }

}

$objAgregarInicio = new AgregarInicioInventario();
$objAgregarInicio->main();

