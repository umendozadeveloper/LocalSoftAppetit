<?php

include_once '../Clases/Seguridad.php';
include_once '../Clases/ConfiguracionFacturas.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once '../Clases/ArchivosFacturas.php';

class N_ConfiguracionFacturas {

    public $errores;
    public $objConf;

    function __construct() {
        $this->errores = array();
        $this->objConf = new ConfiguracionFacturas();
    }

    function main() {
        $resultado = $this->objConf->ObtenerPorId(1);

        //isset($_POST['txtSerieFolio']) ? $this->objConf->SerieFolios = $_POST['txtSerieFolio'] : array_push($this->errores, "Ingresar nombre Serie de folios");

        //isset($_POST['txtConsecutivoInicio']) ? $this->objConf->ConsecutivoInicio = $_POST['txtConsecutivoInicio'] : array_push($this->errores, "Ingresar consecutivo inicio");

        //isset($_POST['txtConsecutivoFinal']) ? $this->objConf->ConsecutivoFinal = $_POST['txtConsecutivoFinal'] : array_push($this->errores, "Ingresar consecutivo final");

        isset($_POST['txtConceptoDescripcion']) ? $this->objConf->ConceptoDescripcion = $_POST['txtConceptoDescripcion'] : array_push($this->errores, "Ingresar Concepto Descripcion ");

        isset($_POST['cmbIdUnidad']) ? $this->objConf->IdUnidad = $_POST['cmbIdUnidad'] : array_push($this->errores, "Ingresar Unidad");

        isset($_POST['cmbIdMoneda']) ? $this->objConf->IdMoneda = $_POST['cmbIdMoneda'] : array_push($this->errores, "Ingresar Moneda");
        
        isset($_POST['txtPass']) ? $this->objConf->Pass = $_POST['txtPass'] : array_push($this->errores, "Ingresar Password");
        
        isset($_POST['txtIVA']) ? $this->objConf->IVA = $_POST['txtIVA'] : array_push($this->errores, "Ingresar IVA");
        
        

        /*if ($_POST['cmbAnadirKEY'] == 'Si' && $_FILES['txtArchivoKEY']['type'] != 'application/octet-stream') {
            array_push($this->errores, "Por favor seleccione un archivo en formato KEY.");
        }*/
        
        if(($_POST['cmbAnadirCER']=='No' && $_POST['cmbAnadirKEY']=='Si') || ($_POST['cmbAnadirCER']=='Si' && $_POST['cmbAnadirKEY']=='No')){
            setFailureMessage("Se debe cargar tanto el archivo .CER como el .KEY");
            header("Location: ../F_A_ConfigurarFactura.php");
        }
        
        $Variable =$_FILES['txtArchivoKEY']['name'] ;
        echo "<script>alert('$Variable');</script>";
        if(isset($_FILES['txtArchivoKEY']['name']))
        {
            
            $this->objConf->ArchivoKEY = $_FILES['txtArchivoKEY']['name'];
        }
        
        
        if(isset($_FILES['txtArchivoCER']['name']))
        {
            $this->objConf->ArchivoCER = $_FILES['txtArchivoCER']['name'];
        }

        /*if ($_POST['cmbAnadirCER'] == 'Si' && $_FILES['txtArchivoCER']['type'] != 'application/x-x509-ca-cert') {
            array_push($this->errores, "Por favor seleccione un archivo en formato CER.");
        }*/
        
     
        
        $bandera_copia_key=false;
        $bandera_copia_cer=false;

        $extensionCER = explode(".", $this->objConf->ArchivoCER);
        $destinoCER = "../ConfigFacturas/Archivos/".$this->objConf->ArchivoCER;
        //$destino ="../bd_Fotos/Meseros/".$usuario.$foto;
        $rutaCER = $_FILES['txtArchivoCER']['tmp_name'];
        

        $extensionKEY = explode(".", $this->objConf->ArchivoKEY);
        $destinoKEY = "../ConfigFacturas/Archivos/".$this->objConf->ArchivoKEY ;
        //$destino ="../bd_Fotos/Meseros/".$usuario.$foto;
        $rutaKEY = $_FILES['txtArchivoKEY']['tmp_name'];
        
        
         if ($_FILES['txtArchivoCER']['name'] != "") {
            if (copy($rutaCER, $destinoCER)) {
               $bandera_copia_cer =TRUE;
            }
         }
         if ($_FILES['txtArchivoKEY']['name'] != "") {
            if (copy($rutaKEY, $destinoKEY)) {
               $bandera_copia_key =TRUE;
            }
         }
        

        if($_POST['cmbAnadirCER'] == 'Si' && $_POST['cmbAnadirKEY']== 'Si')
        {
            $objArchivoFacturas = new ArchivosFacturas();
            $objArchivoFacturas->ObtenerDatos($destinoKEY, $destinoCER, $this->objConf->Pass);
            $this->objConf->NumeroCertificado = $objArchivoFacturas->NumeroCertificado;
            $this->objConf->Certificado = $objArchivoFacturas->Certificado;
            $this->objConf->VigenciaInicio = $objArchivoFacturas->FechaInicio;
            $this->objConf->VigenciaFin = $objArchivoFacturas->FechaFin;
            
        }
        
            
        if ($this->errores) {
            foreach ($this->errores as $e) {
                setFailureMessage($e);
                header("Location: ../F_A_ConfigurarFactura.php");
            }
        } else {
            if ($resultado) {
                if($_POST['cmbAnadirCER']=='No' && $_POST['cmbAnadirKEY']=='No'){
                    if($this->objConf->EditarSinArchivos($this->objConf->SerieFolios, $this->objConf->ConsecutivoInicio, 
                            $this->objConf->ConsecutivoFinal, $this->objConf->ConceptoDescripcion,
                             $this->objConf->IdUnidad, $this->objConf->IdMoneda, $this->objConf->IVA))
                    {
                         setSuccessMessage("Datos editados correctamente");
                    }else{
                        setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
                    }
                } 
                
                #Cuando los archivos cer y key se van a guardar en la BD
                if($_POST['cmbAnadirCER']=='Si' && $_POST['cmbAnadirKEY']=='Si'){
                     if ($this->objConf->Editar($this->objConf->SerieFolios, $this->objConf->ConsecutivoInicio, 
                        $this->objConf->ConsecutivoFinal, $this->objConf->ConceptoDescripcion,
                        $this->objConf->IdUnidad, $this->objConf->IdMoneda, $destinoCER, $destinoKEY, 
                        $this->objConf->Pass, $this->objConf->NumeroCertificado,
                        $this->objConf->Certificado, $this->objConf->VigenciaInicio, 
                        $this->objConf->VigenciaFin,  $this->objConf->IVA)) {
                            
                            header("Location: ../F_A_ConfigurarFactura.php");
                            if($bandera_copia_cer ===true && $bandera_copia_key===true)
                            {
                                setSuccessMessage("Datos editados correctamente");
                            }
                            else{
                               setFailureMessage("Ha ocurrido un error, por favor intente nuevamente"); 
                            }
                        }
                }
                header("Location: ../F_A_ConfigurarFactura.php");
/*◘◘◘◘◘◘◘◘◘◘*/
//                if ($this->objConf->Editar($this->objConf->SerieFolios, $this->objConf->ConsecutivoInicio, 
//                        $this->objConf->ConsecutivoFinal, $this->objConf->ConceptoDescripcion,
//                        $this->objConf->IdUnidad, $this->objConf->IdMoneda, $destinoCER, $destinoKEY, 
//                        $this->objConf->Pass, $this->objConf->NumeroCertificado,
//                        $this->objConf->Certificado, $this->objConf->VigenciaInicio, 
//                        $this->objConf->VigenciaFin,  $this->objConf->IVA)) {
//                    setSuccessMessage("Datos editados correctamente");
//
//                    header("Location: ../F_A_ConfigurarFactura.php");
//                    if ($_FILES['txtArchivoCER']['name'] != "") {
//                        if (copy($rutaCER, $destinoCER)) {
//                            echo "";
//                        } else {
//                            setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
//                            header("Location: ../F_A_ConfigurarFactura.php");
//                        }
//                    }
//                    if ($_FILES['txtArchivoKEY']['name'] != "") {
//
//                        if (copy($rutaKEY, $destinoKEY)) {
//                            echo "";
//                        } else {
//                            setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
//                            header("Location: ../F_A_ConfigurarFactura.php");
//                        }
//                    }
//                } else {
//                    setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
//                    //header("Location: ../F_A_ConfigurarFactura.php");
//                }
            } else {
                if($this->objConf->VigenciaFin == null)
                {
                    $this->objConf->VigenciaFin = date("Y-m-d H:s:i");
                }
                if($this->objConf->VigenciaInicio == null)
                {
                    $this->objConf->VigenciaInicio = date("Y-m-d H:s:i");
                }
                if ($this->objConf->Agregar(1, 1, 
                        1, $this->objConf->ConceptoDescripcion,
                        $this->objConf->IdUnidad, $this->objConf->IdMoneda, $destinoCER, $destinoKEY, 
                        $this->objConf->Pass, $this->objConf->NumeroCertificado,
                        $this->objConf->Certificado, $this->objConf->VigenciaInicio, 
                        $this->objConf->VigenciaFin,  $this->objConf->IVA)) {
                    setSuccessMessage("Datos Guardados correctamente");

                    header("Location: ../F_A_ConfigurarFactura.php");
                } else {
                    setFailureMessage("Ha ocurrido un error, por favor intente nuevamente");
                    header("Location: ../F_A_ConfigurarFactura.php");
                }
            }
        }
    }

}

$objNConf = new N_ConfiguracionFacturas();
$objNConf->main();
