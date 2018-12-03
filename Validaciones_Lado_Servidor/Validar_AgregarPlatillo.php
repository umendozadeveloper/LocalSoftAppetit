<?php

include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
include_once '../Clases/Platillo.php';
include_once '../Clases/SubMenu.php';
include_once '../Clases/PlatillosSubMenu.php';
include_once '../Clases/Sommelier.php';
include_once '../Clases/Vino.php';
include_once '../Clases/ProductoCompuesto.php';

class AgregaPlatillo{
    public $errores;
    public $objPlatillo;
    public $objSubmenu;
    public $objPlatillosSubMenu;
    public $objVino;
    public $objSommelier;
    private $objProductoCompuesto;
            
            
    function __construct() {
        $this->errores = array();
        $this->objPlatillo = new Platillo();
    }
    
    function main(){
        $ruta = "";
        $rutaIco = "";
        $foto = "";
        $icono = "";
        
        if(isset($_POST['txtNombrePlatillo'])){
            $this->objPlatillo->Nombre = $_POST['txtNombrePlatillo'];
        }
        else{
            array_push($this->errores,"Ingresar nombre de platillo");
        }
        if(isset($_POST['txtTope'])){
            $this->objPlatillo->Tope = $_POST['txtTope'];
        }
        
        
        if(isset($_POST['txtDescripcionCorta'])){
            $this->objPlatillo->DescripcionCorta = $_POST['txtDescripcionCorta'];
        }
        else{
            array_push($this->errores,"Ingresar descripción corta");
        }
        
        if(isset($_POST['txtDescripcionLarga'])){
            $this->objPlatillo->DescripcionLarga = $_POST['txtDescripcionLarga'];
        }
        else{
            array_push($this->errores,"Ingresar descripción larga");
        }
        
        if(isset($_POST['txtPrecio'])){
            $this->objPlatillo->Precio = $_POST['txtPrecio'];
        }
        else{
            array_push($this->errores,"Ingresar precio");
        }
        
        if(isset($_POST['txtIVA']))
        {
            $this->objPlatillo->Iva = $_POST['txtIVA'];
        }
        else 
        {
            $this->objPlatillo->Iva= NULL;
        }
        
        if(isset($_FILES['archivoIco'])){
            $icono = $_FILES['archivoIco']['name'];
            $extensionIco = explode(".", $icono);
            $destinoIco ="../bd_Fotos/Platillos/".  $this->objPlatillo->obtenerId()."Ico.".$extensionIco[1]."";
            $rutaIco = $_FILES['archivoIco']['tmp_name'];
            $this->objPlatillo->Icono = $destinoIco;
        }
        else{
            array_push($this->errores,"Ingresar ícono");
        }
        
        if(isset($_FILES['archivo'])){
            $foto = $_FILES['archivo']['name'];
            $extensionFoto = explode(".", $foto);
            $destino ="../bd_Fotos/Platillos/".  $this->objPlatillo->obtenerId()."Foto.".$extensionFoto[1]."";
            $ruta = $_FILES['archivo']['tmp_name'];
            $this->objPlatillo->Foto = $destino;
        }
        else{
            array_push($this->errores,"Ingresar foto");
        }
        
        if(isset($_POST['cmbMenu'])){
            $banderaSubMenu = $_POST['cmbMenu'];
        }
        else{
            array_push($this->errores,"Es necesario seleccionar una opción en agregar a menú");
        }
        
        if(isset($_POST['cmbSommelier'])){
            $banderaSommelier = $_POST['cmbSommelier'];
        }
        else{
            array_push($this->errores,"Es necesario seleccionar una opción en agregar sommelier");
        }
        if(isset($_POST['cmbProductoCompuesto'])){
            $this->objPlatillo->Compuesto = $_POST['cmbProductoCompuesto'];
            $banderaCompuesto = $this->objPlatillo->Compuesto;
        }
        else{
            array_push($this->errores,"Es necesario seleccionar una opción en producto compuesto ");
        }
        if(isset($_POST['cmbTiempo'])){
            $this->objPlatillo->IdTiempo = $_POST['cmbTiempo'];
        }
        else{
            array_push($this->errores,"Es necesario asignar una opción de tiempo al platillo");
        }
        
        if($this->errores){
            foreach($this->errores as $e){
                setFailureMessage($e);
            }
            header("Location: ../F_A_RegistrarPlatillo.php");
        }
        else{ 
                $arregloProductos = json_decode($_POST['txtArrayProductos']);
                $_SESSION['valNombre'] = $this->objPlatillo->Nombre;
                $_SESSION['valDescripcionCorta'] = $this->objPlatillo->DescripcionCorta;
                $_SESSION['valDescripcionLarga'] = $this->objPlatillo->DescripcionLarga;
                $_SESSION['valPrecio'] = $this->objPlatillo->Precio;
                $_SESSION['valIcono'] = $rutaIco;
                $_SESSION['valFoto'] = $ruta;  
                $_SESSION['valIVA'] = $this->objPlatillo->Iva;
                $_SESSION['valTiempo'] = $this->objPlatillo->IdTiempo;
                $_SESSION['valArrayProductos' ] = $arregloProductos;
                $_SESSION['valTope' ] = $this->objPlatillo->Tope;
               
                if($this->objPlatillo->Insertar($this->objPlatillo->Nombre,
                        $this->objPlatillo->DescripcionCorta,
                        $this->objPlatillo->DescripcionLarga,
                        $this->objPlatillo->Precio, $this->objPlatillo->Icono,
                        $this->objPlatillo->Foto, $this->objPlatillo->Iva, 
                        $this->objPlatillo->IdTiempo, $this->objPlatillo->Compuesto, $this->objPlatillo->Tope)){
                        
                        if($foto!=""){
                            copy($ruta, $this->objPlatillo->Foto);
                        }
                        if($icono!=""){
                            copy($rutaIco, $this->objPlatillo->Icono);
                        }
                        
                        if($banderaSubMenu==1){
                            $this->objSubmenu = new SubMenu();
                            $submenus = $this->objSubmenu->ConsultarSubMenuPlatillosDisponibles();
                            $this->objPlatillosSubMenu = new PlatillosSubMenu();
                            
                            foreach($submenus as $s){//$nombrePOST es el temporal para hacer la comparacion lo que recibe 
                                                    //del post y si está en check entonces lo inserta
                                $nombrePOST = "subMenu".$s->ID;
                                if(isset($_POST[$nombrePOST]) && $_POST[$nombrePOST]!=NULL){
                                    $this->objPlatillosSubMenu->Insertar($this->objPlatillo->ID, $s->ID);
                                }
                            }
                        }
                
                
                        if($banderaSommelier==1){
                            $this->objVino = new Vino();
                            $vinos = $this->objVino->ConsultarTodos();
                            $this->objSommelier = new Sommelier();
                            foreach($vinos as $v){
                                $nombrePOST = "vino".$v->ID;
                                if(isset($_POST[$nombrePOST]) && $_POST[$nombrePOST]!=NULL){
                                    $this->objSommelier->Insertar($v->ID, $this->objPlatillo->ID);
                                }
                            }
                        }
                        if($banderaCompuesto==1){
                             $this->objProductoCompuesto = new ProductoCompuesto();
                            foreach($arregloProductos as $producto){
                                $this->objProductoCompuesto->Insertar($this->objPlatillo->ID, 0, $producto->IdSubProducto, $producto->IdTipoSubProducto, $producto->Cantidad);
                                
                            }
               
                        }
                        
                $_SESSION['valNombre'] = null;
                $_SESSION['valDescripcionCorta'] = null;
                $_SESSION['valDescripcionLarga'] = null;
                $_SESSION['valPrecio'] = null;
                $_SESSION['valIVA'] = null;
                $_SESSION['valIcono'] = null;
                $_SESSION['valFoto'] = null;
                $_SESSION['valTiempo'] = null;
                $_SESSION['valArrayProductos'] = null;
                $_SESSION['valTope'] = null;
                setSuccessMessage("Platillo registrado correctamente");
                header("Location: ../F_A_DetalleAlimento.php?IdPlatillo=".$this->objPlatillo->ID);
                
                }
                
            else
            {
                
                setFailureMessage("El nombre del platillo ya está registrado, favor de ingresar otro nombre");   
                header("Location: ../F_A_RegistrarPlatillo.php");
            }
        }
        
        
        
        
        
        
    }
}

$objAgregarPlatillo = new AgregaPlatillo();
$objAgregarPlatillo->main();

?>
    


