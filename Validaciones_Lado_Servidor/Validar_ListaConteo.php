<?php
//include_once './Funciones/Mensajes_Bootstrap.php';
//include_once './Funciones/P_SwalMensajes.php';
//include_once '../Clases/Entrada.php';
//include_once '../Clases/Kardex.php';
//include_once '../Clases/DetalleEntrada.php';
//include_once  '../Clases/SQL_DML.php';
//include_once '../Clases/EntradaCompras.php';
//require_once "../dompdf/dompdf_config.inc.php";
//
//include_once '../Clases/ListadoConteo.php';
//
//class Validar_ListaConteo {
//
//    public $errores;
//    public $ListaIds;
//    public $IdsSeleccionados;
//    public $ConExistencia;
//   
//    
//    function __construct() {
//        $this->errores = array();
//        
////        $this->objEntrada = new Entrada();
////        $this->objSeguridad = new Seguridad();
//    }
//
//    function main() {
//
////        if (isset($_POST['incluir_existencias'])) {
////            $IncluirExistencias = $_POST['incluir_existencias'];
////        }
//        if (isset($_POST['ids_seleccionados'])) {
//            $IdsSeleccionados = $_POST['ids_seleccionados'];
//        }
//        else{
//            array_push($this->errores, "No se ha seleccionado ningún filtro.");
//        }
//       
//         if (isset($_POST['con_existencia'])) {
//            $ConExistencia = $_POST['con_existencia'];
//        }
////        else{
////            array_push($this->errores, "No se ha seleccionado ningún filtro.");
////        }
//        if($this->errores){
//            foreach ($this->errores as $e){
//                setFailureMessage($e);
//            }
//            header("Location: ../F_A_InventariosIniciar.php");
//        }
//        else{
//            
////            $this->IdsSeleccionados= "├1";
////            $IncluirExistencias=false;
//          
//            
//                $objListadoConteo = new ListadoConteo();
////                For($contador=0; $contador<2; $contador++)
////                {
//                $objListadoConteo->GenerarListado($IdsSeleccionados, $ConExistencia);
////                }
//                   
//                
////            echo '<script>window.open("xml/ListaParaConteo.php);</script>';
////            header("Location: ../F_A_Impresion_Listado_Conteo.php");
//       } 
//    }
//
//}
//
//$objListaConteo = new Validar_ListaConteo();
//$objListaConteo->main();
