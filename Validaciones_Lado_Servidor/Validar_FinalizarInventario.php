<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once  '../Clases/SQL_DML.php';

include_once '../Clases/Entrada.php';
include_once '../Clases/DetalleEntrada.php';
include_once '../Clases/EntradaCompras.php';
include_once '../Clases/EntradaAjuste.php';
include_once '../Clases/DetalleSalida.php';
include_once '../Clases/Salida.php';
include_once '../Clases/SalidaVenta.php';
include_once '../Clases/DetalleSalida.php';
include_once '../Clases/Insumo.php';
include_once '../Clases/Inventario.php';
include_once '../Clases/Kardex.php';
include_once '../Clases/InventarioConteo.php';


class Validar_FinalizarInventario {

    public $errores;
    
    public $IdInventario;
    public $Fecha;
    public $Observaciones;
    public $IdEncargado;
            
    function __construct() {
        $this->errores = array();
//        $this->objEntrada = new Entrada();
//        $this->objSeguridad = new Seguridad();
    }

    function main() {

        if (isset($_POST['txtId'])) {
            $IdInventario = $_POST['txtId'];
        }
        else{
            array_push($this->errores, "No se ha seleccionado inventario.");
        }
        if (isset($_POST['txtFecha'])) {
            $Fecha = $_POST['txtFecha'];
        }
        else{
            array_push($this->errores, "No se ha seleccionado la fecha.");
        }
        if (isset($_POST['txtNotas'])) {
            $Observaciones = $_POST['txtNotas'];
        }
        if (isset($_POST['txtIdEncargado'])) {
            $IdEncargado = $_POST['txtIdEncargado'];
        }
        
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_MostrarInventarios.php");
        }
        else{
           
            $insumos_para_cierre = array();
            
            #Obtiene todos los insumos que se encuentran en el inventario para cierre
            $objInventario = new Inventario();
            $insumos_para_cierre = $objInventario->ObtenerProductosParaCierre($IdInventario, 1, 1, 1);
            
            
            $objInventario->ConsultarPorID( $IdInventario);
            
            $objInsumos = new Insumo();
            $InsumosInventarioUM = array();
            $InsumosInventarioUM = $objInsumos->TraerInsumosPorInventarioUM($IdInventario);
            
            
            $detalles_entrada_nuevos="";
            $detalles_salida_nuevos ="";
            
             $objKardex = new Kardex();
            
            $objInvConteo =  new InventarioConteo();
            foreach($insumos_para_cierre as $ins)
            {
               switch($ins['MasMenos']){
                   case "+":#Es Entrada si el físico es mayor, ingresa la diferencia
                      
                       $id_almacen = $objKardex->ObtenerUltimoAlmacen($ins['IdInsumo']);
                       $objInsumos->ConsultarPorID($ins['IdInsumo']);
                       $importe = $ins['Diferencia'] * $ins['Costo'];
                       $detalles_entrada_nuevos .= "├" . $ins['IdInsumo']."─".$ins['Diferencia']."─".$ins['Costo']."─".$importe."─".$id_almacen;
                       break;
                   case "-";#Es salida si el físico es menor, quita aquellos que sobran
                       $objInsumos->ConsultarPorID($ins['IdInsumo']);
                       $importe = $ins['Diferencia'] * $ins['Costo'];
                       $detalles_salida_nuevos.= "├" . $ins['IdInsumo']."─".$ins['Diferencia']."─".$ins['Costo']."─".$importe."─"."2";
                       break;
                }
               #Actualiza el conteo del inventario
               $objInvConteo->ActualizarInventario($ins['IdInventarioConteo'], $ins['Sistema'], $ins['Fisico']);
            }
            
            $IdEntrada="NULL";
            $IdSalida = "NULL";
            
            #Guarda las salidas cuando el físico es menor que lo que se tenía guardado en el sistema.
            if($detalles_salida_nuevos !="")
            {
                $objSQL = new SQL_DML();
                $IdSalida = $objSQL->GetScalar("select MAX (ID) as ID from Salidas");
                $ReferenciaSalida = "Sal. Cierre Inv. " . $IdSalida;
                $IdTipoMovSalida = 9;#Salida cierre inventario
                $IdESEstatusSalida = 3; #salida activa
                
                $objSalida = new Salida();
           
                if($objSalida->InsertarSalida($IdSalida, $Fecha, $ReferenciaSalida, $IdTipoMovSalida, $IdESEstatusSalida, 2))
                {
                    $objSalidaVenta = new SalidaVenta();
//                    if($objSalidaVenta->Insertar($id_Salida, $IdCliente, $IdEncargado)){
                        $objDetalleSalida = new DetalleSalida();
                        $objDetalleSalida->RegistrarDetalleSalida($IdSalida, $detalles_salida_nuevos, $Fecha, $ReferenciaSalida, $IdEncargado,2);
                       

//                    }
                   
                }
                
            }
            
          
            
            #Guarda la entrada si el físico es mayor que lo que se tenía en el sistema
            if($detalles_entrada_nuevos != "")
            {
                $objSQL = new SQL_DML();
                $IdEntrada = $objSQL->GetScalar("select MAX (ID) as ID from Entradas");
                $ReferenciaEntrada = "Ent. Cierre Inv. " . $IdEntrada;
                $IdTipoMovEntrada = 10;#entrada cierre inventario
                $IdESEstatusEntrada = 1; #entrada activa 
                
                $objEntrada = new Entrada();
                if($objEntrada->InsertarEntrada($IdEntrada, $Fecha, $ReferenciaEntrada, $IdTipoMovEntrada, $IdESEstatusEntrada)){
                    $objDetalleEntrada = new DetalleEntrada();
                    $detalles_entrada =  $objDetalleEntrada->RegistrarDetalleEntrada($IdEntrada, $detalles_entrada_nuevos, 1);
                    if(count($detalles_entrada)>0)
                    {
//                        $objKardex = new Kardex();

                        foreach ($detalles_entrada as $detalleE){
                             $objKardex->InsertarKardexPEPS($detalleE['IdDetalle'], null, $detalleE['IdAlmacen'], $detalleE['IdInsumo'], $detalleE['Cantidad'],
                                     $detalleE['Precio'], $Fecha, $IdTipoMovEntrada, $ReferenciaEntrada, $IdEncargado, null,1);
                        }

                    }             
                 
                }
            }
            
            if($objInventario->ActualizarInventarioCierre($IdInventario, 3/*es finalizado*/, $IdEntrada, $IdSalida))
            {
                $dirCon='../pdf_reportes/ListaParaConteoSin'.$IdInventario . '.pdf'; 
                if(file_exists($dirCon))
                {
                    unlink($dirCon);
                       
                
                } 
                $dirCon='../pdf_reportes/ListaParaConteoCon'.$IdInventario . '.pdf'; 
                if(file_exists($dirCon))
                {
                    unlink($dirCon);
                
                } 
                setSuccessMessage("El inventario finalizó correctamente");
                header("Location: ../F_A_InventariosFinalizar.php?IdInventario=$IdInventario");
            }
                    
            else{
                setSwalFailureMessage("Ocurrió un error, no se pudo registrar el inventario. Intente más tarde.");
                header("Location: ../F_A_InventariosFinalizar.php?IdInventario=$IdInventario");
            }
            
            
        
       } 
    }

}

$objFinalizarInvenario = new Validar_FinalizarInventario();
$objFinalizarInvenario->main();


