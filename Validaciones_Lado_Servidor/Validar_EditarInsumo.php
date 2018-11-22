<?php
include_once  '../Clases/Insumo.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';

class AgregarInsumo{
    public $errores;
    public $objInsumo;
    
    function __construct() {
        $this->errores = array();
        $this->objInsumo = new Insumo();
    }
   
    function main(){
         if(isset($_POST['txtDescripcion'])){
            $this->objInsumo->Descripcion = $_POST['txtDescripcion'];
        }
        else{
            array_push($this->errores, "La descripción no puede quedar vacía");
        }
        
        if(isset($_POST['txtPresentacion'])){
            $this->objInsumo->Presentacion = $_POST['txtPresentacion'];
        }
        else{
//            array_push($this->errores, "La descripción del almacén no puede quedar vacía");
            $this->objInsumo->Presentacion = null;
        }
        if(isset($_POST['cmbUnidadMedida'])){
            $this->objInsumo->IdUnidadMedida = $_POST['cmbUnidadMedida'];
        }
        else{
            array_push($this->errores, "La unidad de medida no puede quedar vacía");
            
        }
        if(isset($_POST['txtContenido'])){
            $this->objInsumo->Contenido = $_POST['txtContenido'];
        }
        else{
            array_push($this->errores, "El contenido no puede quedar vacío");
            
        }
        if(isset($_POST['cmbUMContenido'])){
            $this->objInsumo->IdUMContent = $_POST['cmbUMContenido'];
        }
        else{
            array_push($this->errores, "Se debe especificar la unidad del contenido");
            
        }
        if(isset($_POST['cmbClasificacion'])){
            $this->objInsumo->IdClasificador = $_POST['cmbClasificacion'];
        }
        else{
            array_push($this->errores, "Se debe especificar el clasificador al cual pertenece");
            
        }
        if(isset($_POST['txtMinimo'])){
            $this->objInsumo->StockMinimo = $_POST['txtMinimo'];
        }
        else{
            array_push($this->errores, "El stock mínimo no puede quedar vacío");
            
        }
        if(isset($_POST['txtMaximo'])){
            $this->objInsumo->StockMaximo = $_POST['txtMaximo'];
        }
        else{
            array_push($this->errores, "El stock máximo no puede quedar vacío");
            
        }
        if(isset($_POST['cmbUbicacion'])){
            $this->objInsumo->IdUbicacion = $_POST['cmbUbicacion'];
        }
        else{
//            array_push($this->errores, "El st");
            $this->objInsumo->IdUbicacion = NULL;
            
        }
        if(isset($_POST['cmbEstatus'])){
            $this->objInsumo->Status = $_POST['cmbEstatus'];
        }
        else{
            array_push($this->errores, "Se debe especificar el estatus del insumo");
            
        }
        
        if(isset($_POST['txtID'])){
            $this->objInsumo->ID = $_POST['txtID'];
        }
        else{
            array_push($this->errores, "Debe seleccionar un insumo a editar");
        }
        
        if(isset($_POST['txtObservaciones'])){
            $this->objInsumo->Observaciones = $_POST['txtObservaciones'];
        }
        else{
//            array_push($this->errores, "Debe seleccionar un insumo a editar");
        }
        
       
        if($this->errores){
            foreach ($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_Registrar_Insumo_Inventario.php");
        }
        else{
            $_SESSION['valDescripcion'] = $this->objInsumo->Descripcion;
            $_SESSION['valPresentacion'] = $this->objInsumo->Presentacion;
            $_SESSION['valId_Unidad'] = $this->objInsumo->IdUnidadMedida;
            $_SESSION['valContenido'] = $this->objInsumo->Contenido;
            $_SESSION['valUMContent'] = $this->objInsumo->IdUMContent;
            $_SESSION['valId_Clasif'] = $this->objInsumo->IdClasificador;
            $_SESSION['valMinimo'] = $this->objInsumo->StockMinimo;
            $_SESSION['valMaximo'] = $this->objInsumo->StockMaximo;
            $_SESSION['valId_Ubicacion'] = $this->objInsumo->IdUbicacion;
            $_SESSION['valStatus'] = $this->objInsumo->Status;
            $_SESSION['valObservac'] = $this->objInsumo->Observaciones;
           
            if($this->objInsumo->ModificarPorID($this->objInsumo->ID, $this->objInsumo->Descripcion,
            $this->objInsumo->Presentacion, $this->objInsumo->IdUnidadMedida, $this->objInsumo->Contenido,
            $this->objInsumo->IdUMContent, $this->objInsumo->IdClasificador, $this->objInsumo->StockMinimo, 
            $this->objInsumo->StockMaximo, $this->objInsumo->IdUbicacion, $this->objInsumo->Status, $this->objInsumo->Observaciones)){
                $_SESSION['valDescripcion'] = NULL;
                $_SESSION['valPresentacion'] = NULL;
                $_SESSION['valId_Unidad'] = Null;
                $_SESSION['valContenido'] = null;
                $_SESSION['valUMContent'] = NULL;
                $_SESSION['valId_Clasif'] = null;
                $_SESSION['valMinimo'] = NULL;
                $_SESSION['valMaximo'] = NULL;
                $_SESSION['valId_Ubicacion'] =NULL;
                $_SESSION['valStatus'] = NULL;
                $_SESSION['valObservac'] =null;
                    setSuccessMessage("Insumo editado correctamente");
                    header("Location: ../F_A_EditarInsumo.php?IdInsumo=".$this->objInsumo->ID);
                
            }
            
            else{
                setSwalFailureMessage("El insumo ya existe favor ingrese otro.");
                header("Location: ../F_A_EditarInsumo.php?IdInsumo=".$this->objInsumo->ID);
                
                
            }
        }
    }    
}

$objAgregarInsumo = new AgregarInsumo();
$objAgregarInsumo->main();