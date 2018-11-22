<?php
//error_reporting(E_ALL ^ E_NOTICE);
include_once './Header.php';
include_once './Clases/ConfiguracionFacturas.php';
include_once './Clases/UnidadMedida.php';
include_once './Clases/Moneda.php';

$objConfiguracionFacturas = new ConfiguracionFacturas();
$objConfiguracionFacturas->ObtenerPorId(1);
?>

<title>Configuración de factura </title>



<?php
if (!empty($_SESSION['msjSelloDigital'])) {

    echo "<script>swal('" . $_SESSION['titulo'] . "','" . $_SESSION['msjSelloDigital'][0] . "','" . $_SESSION['tipo'] . "');</script>";

    /*     * ***Limpio variables de sesion*** */
    $_SESSION['msjSelloDigital'] = null;
    unset($_SESSION['msjSelloDigital']);
    $_SESSION['titulo'] = null;
    unset($_SESSION['titulo']);
    $_SESSION['tipo'] = null;
    unset($_SESSION['tipo']);
}
?>



<body>
    <form action="Validaciones_Lado_Servidor/N_ConfiguracionFacturas.php" method="POST" enctype="multipart/form-data" id='form' name="form">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
                <td class="tdEncabezadoTabla">
                    <div><h4><center><label class="textoEncabezadoTabla">Configuración de factura</label></center></h4></div>
                </td>
            </table>
        </div>   
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">
                <tr>
                    <!--<td><div class="etiquetas2">Serie de folios</div></td>

<?php
if (!isset($_SESSION['valSerieFolio']) && (empty($_SESSION['valSerieFolio']))) {

    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtSerieFolio'  name='txtSerieFolio'    class='form-control' value='$objConfiguracionFacturas->SerieFolios'></div></td>";
} else {
    $valor = $_SESSION['valSerieFolio'];
    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtSerieFolio'  name='txtSerieFolio'    class='form-control' value='$valor'></div></td>";
    $_SESSION['valSerieFolio'] = null;
}
?>
                </tr> 

                <tr>
                    <td><div class="etiquetas2">Consecutivo inicio</div></td>

                    <?php
                    if (!isset($_SESSION['valRangoInicial']) && (empty($_SESSION['valRangoInicial']))) {

                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtConsecutivoInicio'  name='txtConsecutivoInicio'    class='form-control' value='$objConfiguracionFacturas->ConsecutivoInicio'></div></td>";
                    } else {
                        $valor = $_SESSION['valRangoInicial'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtConsecutivoInicio'  name='txtConsecutivoInicio'    class='form-control' value='$valor'></div></td>";
                        $_SESSION['valRangoInicial'] = null;
                    }
                    ?>
                </tr>
                <!--<tr>
                    <td><div class="etiquetas2">Consecutivo final</div></td>

                    <?php
                    if (!isset($_SESSION['valRangoFinal']) && (empty($_SESSION['valRangoFinal']))) {

                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtConsecutivoFinal'  name='txtConsecutivoFinal'    class='form-control' value='$objConfiguracionFacturas->ConsecutivoFinal'></div></td>";
                    } else {
                        $valor = $_SESSION['valRangoFinal'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtConsecutivoFinal'  name='txtConsecutivoFinal'    class='form-control' value='$valor'></div></td>";
                        $_SESSION['valRangoFinal'] = null;
                    }
                    ?>
                </tr>-->
                    <tr>
                    <td><div class="etiquetas2">Concepto descripción</div></td>

                    <?php
                    if (!isset($_SESSION['valConceptoDescrip']) && (empty($_SESSION['valConceptoDescrip']))) {

                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtConceptoDescripcion'  name='txtConceptoDescripcion'    class='form-control' value='$objConfiguracionFacturas->ConceptoDescripcion'></div></td>";
                    } else {
                        $valor = $_SESSION['valConceptoDescrip'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtConceptoDescripcion'  name='txtConceptoDescripcion'    class='form-control' value='$valor'></div></td>";
                        $_SESSION['valConceptoDescrip'] = null;
                    }
                    ?>
                </tr>
                <tr>
                    <td><div class="etiquetas2">IVA</div></td>
                    
                
                    <?php
                    if (!isset($_SESSION['valIVA']) && (empty($_SESSION['valIVA']))) {

                        echo "<td><select name='txtIVA' id='txtIVA' class='input-group form-control'>";
                        $TraeDatos = strlen($objConfiguracionFacturas->IVA);
                   
                    if($TraeDatos == 0  || $objConfiguracionFacturas->IVA==16)
                    {
                        echo "<option value='16' selected=''>
                        16%
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='16'>
                        16%
                    </option>";
                    }
                    
                    if($objConfiguracionFacturas->IVA==0 && $TraeDatos>0)
                    {
                        echo "<option value='0' selected=''>
                        Tasa 0
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='0'>
                        Tasa 0
                    </option>";
                    }
                    
                    
                    if($objConfiguracionFacturas->IVA==1)
                    {
                        echo "<option value='1' selected=''>
                        Exento
                    </option>";
                    }
                    else 
                    {
                    echo "<option value='1'>
                        Exento
                    </option>";
                    }
                    
                    
                    
                    
                    } /*else {
                        $valor = $_SESSION['valIVA'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtIVA'  name='txtIVA'    class='form-control' value='$valor'></div></td>";
                        $_SESSION['valIVA'] = null;
                    }*/
                    ?>
                    
                </tr>
                
                <tr>
                    <td><div class="etiquetas2">Vigente a partir de</div></td>

                    <?php
                    if (!isset($_SESSION['valVigenciaInicio']) && (empty($_SESSION['valVigenciaInicio']))) {
                        if($objConfiguracionFacturas->VigenciaInicio)
                        {
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly='' type='text' id='txtVigenciaInicio'  name='txtVigenciaInicio'    class='form-control' value='".$objConfiguracionFacturas->VigenciaInicio->format('d-m-Y H:i:s')."'></div></td>";
                        }
                        else
                        {
                            $objConfiguracionFacturas->VigenciaInicio = date("Y-m-d H:i:s");
                            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly='' type='text' id='txtVigenciaInicio'  name='txtVigenciaInicio'    class='form-control' value='".$objConfiguracionFacturas->VigenciaInicio."'></div></td>";
                        }
                    } else {
                        $valor = $_SESSION['valVigenciaInicio'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly='' type='text' id='txtVigenciaInicio'  name='txtVigenciaInicio'    class='form-control' value='echo $valor'></div></td>";
                        $_SESSION['valVigenciaInicio'] = null;
                    }
                    ?>
                </tr>
                
                
                
                <tr>
                    <td><div class="etiquetas2">Vigente hasta</div></td>

                    <?php
                    if (!isset($_SESSION['valVigenciaFin']) && (empty($_SESSION['valVigenciaFin']))) {
                        if($objConfiguracionFacturas->VigenciaFin)
                        {
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly='' type='text' id='txtVigenciaFin'  name='txtVigenciaFin'    class='form-control' value='".$objConfiguracionFacturas->VigenciaFin->format('d-m-Y H:i:s')."'></div></td>";
                        
                        }
                        else
                        {
                            $objConfiguracionFacturas->VigenciaFin = date("Y-m-d H:i:s");
                            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly='' type='text' id='txtVigenciaFin'  name='txtVigenciaFin'    class='form-control' value='".$objConfiguracionFacturas->VigenciaFin."'></div></td>";
                        }
                    } else {
                        $valor = $_SESSION['valVigenciaFin'];
                        echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input readonly='' type='text' id='txtVigenciaFin'  name='txtVigenciaFin'    class='form-control' value='$valor></div></td>";
                        $_SESSION['valVigenciaFin'] = null;
                    }
                    ?>
                </tr>
                
                <tr>
                    <td><div class="etiquetas2">Tipo de moneda</div></td>

                                <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><select name='cmbIdMoneda' id='cmbIdMoneda' class='form-control'>

                    <?php
                    $objMoneda = new Moneda();
                    $Monedas = $objMoneda->ConsultarTodo();
                    
                    foreach ($Monedas as $m) {
                        if (!isset($_SESSION['valIdMoneda']) && (empty($_SESSION['valIdMoneda']))) {
                            
                            if($objConfiguracionFacturas->IdMoneda == $m->Id)
                            {
                                
                            echo "<option value ='" . $m->Id . "' selected>" . $m->Descripcion . "</option>";
                            }
                            else
                            {
                                echo "<option value='$m->Id'>".$m->Descripcion."</option>";
                            }
                        } 
                        else {
                            $valor = $_SESSION['valIdMoneda'];
                            if ($valor = $m->Id) {
                                echo "<option value='$m->Id' selected>".$m->Descripcion."</option>";
                            }
                            else
                            {
                                echo "<option value='$m->Id'>".$m->Descripcion."</option>";
                            }
                        }
                        
                    }
                    $_SESSION['valMoneda'] = null;
                    ?>
                            </select></div></td>
                </tr>
                
                <tr>
                    <td><div class="etiquetas2 ocultar" id="DivPass" name="DivPass">Password</div></td>
                    <td><div class="campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group ocultar" name="txtP" id="txtP"><input type="password" id="txtPass"  name="txtPass"    class="form-control" ></div></td>
                </tr>

            </table>
        </div>
        <!--*******-->       
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover">

                <tr>
                                <td><div class="etiquetas2">¿Modificar Archivo CER?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirCER" name="cmbAnadirCER"  class="form-control" onchange="">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                         
                        <tr>
                       
                            <td><div class="etiquetas2 ocultar" id="TrTituloCER">Archivo (.CER)</div></td>
                    <?php
                    if (!isset($_SESSION['archivoCer']) && (empty($_SESSION['archivoCer']))) {

                        echo "<td><div class='ocultar campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group' id='TrArchivoCER'><input type='file' id='txtArchivoCER'  name='txtArchivoCER'   class='filestyle' accept='.cer' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value='$objConfiguracionFacturas->ArchivoCER'></div></td>";
                    } else {
                        $valor = $_SESSION['archivoCer'];
                        echo "<td><div class='ocultar campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group' id='TrArchivoCER'><input type='file' id='txtArchivoCER'  name='txtArchivoCER'    class='filestyle' accept='.cer' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value=' $valor'></div></td>";
                        $_SESSION['archivoCer'] = null;
                    }
                    ?>
                
                                        
                </div>
                <tr>
                                <td><div class="etiquetas2">¿Modificar Archivo KEY?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirKEY" name="cmbAnadirKEY"  class="form-control" onchange="">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                        <tr>
                            <td><div class="etiquetas2 ocultar" id="TrTituloKEY">Archivo (.KEY)</div></td>
                    <?php
                    if (!isset($_SESSION['archivoKey']) && (empty($_SESSION['archivoKey']))) {

                        echo "<td><div class='ocultar campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group' id='TrArchivoKEY'><input type='file' id='txtArchivoKEY'  name='txtArchivoKEY'   class='filestyle' accept='.key' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value='$objConfiguracionFacturas->ArchivoKEY'></div></td>";
                    } else {
                        $valor = $_SESSION['archivoKey'];
                        echo "<td><div class='ocultar campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group' id='TrArchivoKEY'><input type='file' id='txtArchivoKEY'  name='txtArchivoKEY'    class='filestyle' accept='.key' data-buttonBefore='true' data-buttonText='Seleccionar archivo' data-buttonName='btn-Bixa' value='$valor'></div></td>";
                        $_SESSION['archivoKey'] = null;
                    }
                    ?>
                </tr> 
                <tr>
                    <td><div class="etiquetas2">Unidad predeterminada</div></td>
                    <td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><select name='cmbIdUnidad' id='cmbIdUnidad' class='form-control'>

                    <?php
                    $objUnidad = new UnidadMedida();
                    $Unidades = $objUnidad->ConsultarTodo();
                    
                    foreach ($Unidades as $un) {
                        if (!isset($_SESSION['valIdUnidad']) && (empty($_SESSION['valIdUnidad']))) {
                            
                            if($objConfiguracionFacturas->IdUnidad == $un->Id)
                            {
                                
                            echo "<option value ='" . $un->Id . "' selected>" . $un->Descripcion . "</option>";
                            }
                            else
                            {
                                echo "<option value='$un->Id'>".$un->Descripcion."</option>";
                            }
                        } 
                        else {
                            $valor = $_SESSION['valIdUnidad'];
                            if ($valor = $un->Id) {
                                echo "<option value='$un->Id' selected>".$un->Descripcion."</option>";
                            }
                            else
                            {
                                echo "<option value='$u->Id'>".$u->Descripcion."</option>";
                            }
                        }
                        
                    }
                    $_SESSION['valUnidad'] = null;
                    ?>
                            </select></div></td>
                </tr> 
                
                
            </table>
            <div class="ocultar">
                <input type='text' id='txtCertificado'  name='txtCertificado'    value="<?phpecho $objConfiguracionFacturas->Certificado;?>">
                <input type='text' id='txtNumeroCertificado'  name='txtNumeroCertificado'    value="<?phpecho $objConfiguracionFacturas->NumeroCertificado;?>">
            </div>
        </div>        




        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <br>
            <br>

            <button type="submit" id="btnAceptar" name="btnModificar" style="float: right" class="btn btn-Bixa btn-ms" >Guardar</button>

            <br>

        </div>
    </form>                
</body>

<script>

/*$("#txtArchivoKEY").change(function () {
        var KEY = document.getElementById("txtArchivoKEY").files[0];
        var CER = document.getElementById("txtArchivoCER").files[0];
        var Pass = document.getElementById("txtPass").value();
        if(document.getElementById("txtArchivoKEY").value()!="" && document.getElementById("txtArchivoCER").value()!="")
        {
        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Consulta_ArchivosFacturas.php",
            type: 'POST',
            data: {"CER": CER, "KEY": KEY, "Pass": Pass},
            success: function (data) {
                $("#cmbMunicipio").html(data);

            }
        });
    }

    });
    
    
    $("#txtArchivoCER").change(function () {
        var KEY = document.getElementById("txtArchivoKEY").files[0];
        var CER = document.getElementById("txtArchivoCER").files[0];
        var Pass = document.getElementById("txtPass").value();
        if(document.getElementById("txtArchivoKEY").value()!="" && document.getElementById("txtArchivoCER").value()!="")
        {
        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Consulta_ArchivosFacturas.php",
            type: 'POST',
            data: {"CER": CER, "KEY": KEY, "Pass": Pass},
            success: function (data) {
                $("#cmbMunicipio").html(data);

            }
        });
    }

    });*/

</script>
<script>
    $(document).ready(function () {
        
        
        
        $("#cmbAnadirCER").change(function (){
//                alert($(this).val());
                var tablaFoto = document.getElementById("TrArchivoCER");
                var Titulo = document.getElementById("TrTituloCER");
                var Passw = document.getElementById("DivPass");
                var PassT = document.getElementById("txtP");
                switch($(this).val()){
                    
            case "Si":
                    tablaFoto.className = "mostrar campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group";
                    Titulo.className = "etiquetas2 mostrar";
                    Passw.className = "etiquetas2 mostrar";
                    PassT.className = "mostrar campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group";
                    break;
                case "No":
                    tablaFoto.className = "ocultar";
                    Titulo.className = "ocultar";
                    Passw.className = "ocultar";
                    PassT.className = "ocultar";
                    break;
                    
            default:break;
                    
                }
             });
             
             $("#cmbAnadirKEY").change(function (){
//                alert($(this).val());
                 var tablaFoto = document.getElementById("TrArchivoKEY");
                var Titulo = document.getElementById("TrTituloKEY");
                var Passw = document.getElementById("DivPass");
                var PassT = document.getElementById("txtP");
                switch($(this).val()){
                    
            case "Si":
                    tablaFoto.className = "mostrar campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group";
                    Titulo.className = "etiquetas2 mostrar";    
                    Passw.className = "etiquetas2 mostrar";
                    PassT.className = "mostrar campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group";
                    break;
                case "No":
                    tablaFoto.className = "ocultar";
                    Titulo.className = "ocultar";
                    Passw.className = "ocultar";
                    PassT.className = "ocultar";
                    break;
                    
            default:break;
                    
                }
             });





        

        $("#form").validate({
            rules: {
                txtSerieFolio: {
                    required: true
                },
                txtConsecutivoInicio: {
                    required: true
                },
                txtConsecutivoFinal: {
                    required: true
                },
                txtConceptoDescripcion: {
                    required: true
                },
                cmbIdUnidad: {
                    required: true
                },
                cmbIdMoneda: {
                    required: true
                },
                
                
                txtArchivoKEY:{
                    required:{
                        depends: function() {
                            return ($("#cmbAnadirKEY").val() == "Si");
                            }
               }
            },
            
            txtArchivoCER:{
                    required:{
                        depends: function() {
                            return ($("#cmbAnadirCER").val() == "Si");
                            }
               }
            }

            },
            messages: {
                txtSerieFolio: {
                    required: "Es necesario ingresar la serie del folio"
                },
                txtConsecutivoInicio: {
                    required: "Es necesario ingresar el rango inicial para el folio"
                },
                txtConsecutivoFinal: {
                    required: "Es necesario ingresar el rango final para el folio"
                },
                txtConceptoDescripcion: {
                    required: "Es necesario ingresar el concepto para la descripción"
                },
                cmbIdUnidad:{
                    required: "Se requiere seleccionar una clave de unidad"
                },
                cboxMoneda: {
                    required: "Se requiere seleccionar un tipo de moneda"

                },
                
                
                txtArchivoKEY: {
                    required: "Se requiere seleccionar un archivo KEY"
                },
                
                txtArchivoCER: {
                    required: "Se requiere seleccionar un archivo CER"
                }

            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents(".campos").addClass("has-feedback");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!element.next("span")[ 0 ]) {
                    $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                }
            },
            success: function (label, element) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!$(element).next("span")[ 0 ]) {
                    $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".campos").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".campos").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
            }
        });


    });
</script>
</html>
