<?php
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Entrada.php';
include_once '../Clases/Kardex.php';
include_once '../Clases/DetalleEntrada.php';
include_once  '../Clases/SQL_DML.php';
include_once '../Clases/EntradaCompras.php';
include_once '../Clases/EntradaAjuste.php';
include_once '../Clases/Kardex.php';

class RegistrarAjusteEntrada {

    public $errores;
    public $objEntrada;
    public $Fecha;
    public $IdProveedor;
    public $NumDocumento;
    public $Observaciones;
    public $IdEncargado;
    public $CostoTotal;
    public $Compras;
    public $ArrayCompras = array();
    public $IdAlmacen;
    
    
    function __construct() {
        $this->errores = array();
//        $this->objEntrada = new Entrada();
//        $this->objSeguridad = new Seguridad();
    }

    function main() {

        if (isset($_POST['fecha'])) {
            $Fecha = $_POST['fecha'];
        }
        if (isset($_POST['proveedor'])) {
            $IdProveedor = $_POST['proveedor'];
        }
        if (isset($_POST['numero_documento'])) {
            $NumDocumento = $_POST['numero_documento'];
        }
        if (isset($_POST['observaciones'])) {
            $Observaciones = $_POST['observaciones'];

        }
        if (isset($_POST['encargado'])) {
            $IdEncargado = $_POST['encargado'];

        }
        if (isset($_POST['costo_total'])) {
            $CostoTotal = $_POST['costo_total'];
        }
        if (isset($_POST['compras'])) {
            #Compras trae los datos de la tabla en una cadena
            $Compras = $_POST['compras'];
        }
        
        
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarAjuste_Entrada.php");
        }
        else{
            
            $objSQL = new SQL_DML();
            $id_Entrada = $objSQL->GetScalar("select MAX (ID) as ID from Entradas");
            $detalles_entrada= array();
            
            $id_EntradaAjuste = $objSQL->GetScalar("select MAX (ID) as ID from EntradasAjustes");
           
            
            
            $referencia = "Ent. Ajuste-" . $id_EntradaAjuste;
            $tipo_movimiento = 5; //Entrada por ajuste
            $entrada_estatus = 1; //es el registro Entrada Activa
            
            
            
            $objEntrada = new Entrada();
            if($objEntrada->InsertarEntrada($id_Entrada, $Fecha, $referencia, $tipo_movimiento, $entrada_estatus)){
                $objDetalleEntrada = new DetalleEntrada();
                $detalles_entrada =  $objDetalleEntrada->RegistrarDetalleEntrada($id_Entrada, $Compras,3);
                if(count($detalles_entrada)>0)
                {
                    $objKardex = new Kardex();

                    foreach ($detalles_entrada as $detalleE){
                         $objKardex->InsertarKardexPEPS($detalleE['IdDetalle'], null, $detalleE['IdAlmacen'], $detalleE['IdInsumo'], $detalleE['Cantidad'],
                                 $detalleE['Precio'], $Fecha, $tipo_movimiento, $referencia, $IdEncargado, null,1);
                    }

                   $objEntradaAjuste = new EntradaAjuste();
                   $objEntradaAjuste->Insertar($id_EntradaAjuste, $id_Entrada, $NumDocumento, $Observaciones, $CostoTotal, $IdEncargado, $IdProveedor);
                    
//                    setSuccessMessage("Compra registrada correctamente");
//                    header("Location: ../F_A_Registrar_Entrada_Inventario.php");
                    echo "1";
                }             
                 
            }
            else{
                echo "0";
            }
            
//
//            $objEntrada = new Entrada();
//            $objEntrada->ObtenerPEPS(1);
        
       } 
    }

}

$objRegistrarCompra = new RegistrarAjusteEntrada();
$objRegistrarCompra->main();
