<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Entrada.php';
include_once '../Clases/Kardex.php';
include_once '../Clases/DetalleEntrada.php';
include_once  '../Clases/SQL_DML.php';
include_once '../Clases/Salida.php';
include_once '../Clases/EntradaCompras.php';
include_once '../Clases/DetalleSalida.php';
include_once '../Clases/SalidaVenta.php';
include_once '../Clases/Kardex.php';
include_once '../Clases/SalidaAjuste.php';

class RegistrarAjusteSalida {

    public $errores;
    public $objSalida;
    public $Fecha;
//    public $IdProveedor;
//    public $NumDocumento;
//    public $Observaciones;
    public $IdEncargado;
    public $CostoTotal;
    public $Ventas;
    public $ArrayVentas = array();
    public $IdAlmacen;
    public $IdCliente;
    public $Todo_PEPS;
    public $Observaciones;
    
    
    function __construct() {
        $this->errores = array();
        $this->objSalida = new Salida();
//        $this->objEntrada = new Entrada();
//        $this->objSeguridad = new Seguridad();
    }

    function main() {

        if (isset($_POST['fecha'])) {
            $Fecha = $_POST['fecha'];
        }
        
        
        if (isset($_POST['encargado'])) {
            $IdEncargado = $_POST['encargado'];

        }
        if (isset($_POST['cliente'])) {
            $IdCliente = $_POST['cliente'];

        }
        if (isset($_POST['costo_total'])) {
            $CostoTotal = $_POST['costo_total'];
        }
        if (isset($_POST['ventas'])) {
            #Compras trae los datos de la tabla en una cadena
            $Ventas = $_POST['ventas'];
        }
         if (isset($_POST['observaciones'])) {
            #Compras trae los datos de la tabla en una cadena
            $Observaciones = $_POST['observaciones'];
        }
        
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarAjuste_Salida.php");
        }
        else{
            
            $objSQL = new SQL_DML();
            $id_Salida = $objSQL->GetScalar("select MAX (ID) as ID from Salidas");
            $detalles_salida= array();
           
            $id_SalidaAjuste = $objSQL->GetScalar("select MAX (ID) as ID from SalidasAjustes");
            
            $referencia = "Sal.Ajuste-" . $id_SalidaAjuste;
            $tipo_movimiento = 7; //salida por ajuste
            $salida_estatus = 2; //es el registro Salida Activa
            
            
            
            $objSalida = new Salida();
           
            if($objSalida->InsertarSalida($id_Salida, $Fecha, $referencia, $tipo_movimiento, $salida_estatus))
            {
                $objSalidaAjuste = new SalidaAjuste();
                if($objSalidaAjuste->Insertar($id_SalidaAjuste, $id_Salida, $Observaciones, $IdEncargado, $CostoTotal)){
                    $objDetalleSalida = new DetalleSalida();
                    $objDetalleSalida->RegistrarDetalleSalida($id_Salida, $Ventas, $Fecha, $referencia, $IdEncargado,4);
                    echo "1";
                    
                }
                else{
//                    $objSalida->Eliminar($id_Salida);
//                    echo '0';
                }
            }
            else{
                echo "0";
            }
        
       } 
    }

}

$objRegistrarSalida = new RegistrarAjusteSalida();
$objRegistrarSalida->main();
