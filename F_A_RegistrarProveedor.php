<?php
include_once './Header.php';
require_once './Clases/CatalogoEstado.php';
?>    
<title>Agregar cliente</title>
<body>
    <form action="Validaciones_Lado_Servidor/Validar_AgregarProveedor.php" method="POST" enctype="multipart/form-data" id='form'>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
                <td class="tdEncabezadoTabla">
                    <div><h4><center><label class="textoEncabezadoTabla">Datos del proveedor</label></center></h4></div>
                </td>
            </table>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">
                <tr>
                    <td><div class="etiquetas2">Nombre</div></td>
                    <?php
                    if (isset($_SESSION['valNombreCliente']) && !empty($_SESSION['valNombreCliente'])) {
                        $NombreCliente = $_SESSION['valNombreCliente'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='NombreCliente' title='Ingresar Datos' class='form-control' value='$NombreCliente'></div></td>";
                        $_SESSION['valNombreCliente'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='NombreCliente' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>


                </tr>                        


                <tr>
                    <td><div class="etiquetas2">RFC</div></td>
                    <?php
                    if (isset($_SESSION['valRFC']) && !empty($_SESSION['valRFC'])) {
                        $RFC = $_SESSION['valRFC'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='RFC' title='Ingresar Datos' class='form-control' value='$RFC'></div></td>";
                        $_SESSION['valRFC'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='RFC' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr>                        

                <tr>
                    <td><div class="etiquetas2">Calle</div></td>
                    <?php
                    if (isset($_SESSION['valCalle']) && !empty($_SESSION['valCalle'])) {
                        $Calle = $_SESSION['valCalle'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Calle' title='Ingresar Datos' class='form-control' value='$Calle'></div></td>";
                        $_SESSION['valCalle'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Calle' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr> 
  <tr>
                    <td><div class="etiquetas2">Número exterior</div></td>
                    <?php
                    if (isset($_SESSION['valNumeroExterior']) && !empty($_SESSION['valNumeroExterior'])) {
                        $NumeroExterior = $_SESSION['valNumeroExterior'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='NumeroExterior' title='Ingresar Datos' class='form-control' value='$NumeroExterior'></div></td>";
                        $_SESSION['valNumeroExterior'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='NumeroExterior' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr>  

                <tr>
                    <td><div class="etiquetas2">Número interior</div></td>
                    <?php
                    if (isset($_SESSION['valNumeroInterior']) && !empty($_SESSION['valNumeroInterior'])) {
                        $NumeroInterior = $_SESSION['valNumeroInterior'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='NumeroInterior' title='Ingresar Datos' class='form-control' value='$NumeroInterior'></div></td>";
                        $_SESSION['valNumeroInterior'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='NumeroInterior' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr>
                <tr>
                    <td><div class="etiquetas2">Colonia</div></td>
                    <?php
                    if (isset($_SESSION['valColonia']) && !empty($_SESSION['valColonia'])) {
                        $Colonia = $_SESSION['valColonia'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Colonia' title='Ingresar Datos' class='form-control' value='$Colonia'></div></td>";
                        $_SESSION['valColonia'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Colonia' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr>

               
                <tr>
                    <td><div class="etiquetas2">Estado</div></td>
                    <td colspan="4">
                        <div class='campos'>
                            <select id="cmbEstado" class="form-control" name="cmbEstado">
                                <?php
                                $objEstado = new CatalogoEstado();
                                $estados = $objEstado->ObtenerDisponibles();
                                foreach ($estados as $e) {
                                    if (isset($_SESSION['valId_Estado']) && !empty($_SESSION['valId_Estado'])) {
                                        $dato = $_SESSION['valId_Estado'];
                                        if ($e->Id_Estado == $dato) {
                                            echo "<option value ='" . $e->Id_Estado . "' selected>" . $e->DESCRIP . "</option>";
                                        } else {
                                            echo "<option value ='" . $e->Id_Estado . "'>" . $e->DESCRIP . "</option>";
                                        }
                                    } else {
                                        if ($e->Id_Estado == 11) {
                                            echo "<option value ='" . $e->Id_Estado . "' selected>" . $e->DESCRIP . "</option>";
                                        } else {
                                            echo "<option value ='" . $e->Id_Estado . "'>" . $e->DESCRIP . "</option>";
                                        }
                                    }
                                }
                                $_SESSION['valId_Estado'] = null;
                                ?>              

                            </select>
                        </div>
                    </td>
                </tr>

              
                <tr>
                    <td><div class="etiquetas2">Municipio</div></td>
                    <td colspan="4" style="width: 60%">
                        <div class='campos'>
                            <select id="cmbMunicipio" class="form-control" name="cmbMunicipio">
                            </select>
                        </div>
                    </td>
                </tr>

               



            </table>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover">

                 <tr>
                    <td><div class="etiquetas2">Código postal</div></td>
                    <?php
                    if (isset($_SESSION['valCodigoPostal']) && !empty($_SESSION['valCodigoPostal'])) {
                        $CodigoPostal = $_SESSION['valCodigoPostal'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='CodigoPostal' title='Ingresar Datos' class='form-control' value='$CodigoPostal'></div></td>";
                        $_SESSION['valCodigoPostal'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='CodigoPostal' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr> 
                <tr>
                    <td><div class="etiquetas2">País</div></td>
                    <?php
                    if (isset($_SESSION['valPais']) && !empty($_SESSION['valPais'])) {
                        $Pais = $_SESSION['valPais'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Pais' title='Ingresar Datos' class='form-control' value='$Pais'></div></td>";
                        $_SESSION['valPais'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Pais' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr>
                 <tr>
                    <td><div class="etiquetas2">Correo electrónico</div></td>
                    <?php
                    if (isset($_SESSION['valCorreo']) && !empty($_SESSION['valCorreo'])) {
                        $Correo = $_SESSION['valCorreo'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Correo' title='Ingresar Datos' class='form-control' value='$Correo'></div></td>";
                        $_SESSION['valCorreo'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Correo' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr>

                <tr>
                    <td><div class="etiquetas2">Teléfono</div></td>
                    <?php
                    if (isset($_SESSION['valTelefono']) && !empty($_SESSION['valTelefono'])) {
                        $Telefono = $_SESSION['valTelefono'];
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Telefono' title='Ingresar Datos' class='form-control' value='$Telefono'></div></td>";
                        $_SESSION['valTelefono'] = null;
                    } else {
                        echo "<td colspan='4'><div class='campos'><input type='text'  name='Telefono' title='Ingresar Datos' class='form-control'></div></td>";
                    }
                    ?>
                </tr>

               

                 <tr>
                            <td ><div class="etiquetas2">Datos de contacto</div></td>
                        <?php
                            if(!isset($_SESSION['valContacto']) && (empty($_SESSION['valContacto'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='3' id='txtContacto' name='txtContacto'></textarea></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valContacto'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='3' id='txtContacto' name='txtContacto'>$valor</textarea></div></td>";
                                    $_SESSION['valContacto']=null;
                                }
                            ?>
                        </tr>
                    
                 <tr>
                            <td ><div class="etiquetas2">Observaciones</div></td>
                        <?php
                            if(!isset($_SESSION['valObservac']) && (empty($_SESSION['valObservac'])))
                                {
                                
                                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='4' id='txtObservaciones' name='txtObservaciones'></textarea></div></td>";
                                }
                                else{
                                    $valor = $_SESSION['valObservac'];
                                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='4' id='txtObservaciones' name='txtObservaciones'>$valor</textarea></div></td>";
                                    $_SESSION['valObservac']=null;
                                }
                            ?>
                        </tr>
                
               <tr>
                            <td width="20%"><div class="etiquetas2">Estatus</div></td>
                            <td><select name="cmbEstatus" id="cmbEstatus" class="input-group form-control">
                            <?php
                                if(!isset($_SESSION['valEstatus']) && (empty($_SESSION['valEstatus'])))
                                {
                                   
                                   echo '<option value="1">Activo</option>';
                                   echo '<option value="0">Inactivo</option>';
                                }
                                else{
                                   $valor = $_SESSION['valEstatus'];
                                   if($valor = '0')
                                   {
                                       echo '<option value="0" selected>Inactivo</option>';
                                       echo '<option value="1">Activo</option>';
                                   }
                                   else{
                                       echo '<option value="0">Inactivo</option>';
                                       echo '<option value="1" selected>Activo</option>';
                                   }
                                   $_SESSION['valEstatus'] = null;
                                }
                            ?>
                                
                           </select></td>
                        </tr>          

            </table>
        </div>





        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <br>
            <br>

            <button type="submit" id="btnAceptar" name="btnModificar" style="float: right" class="btn btn-Bixa btn-ms" >Guardar</button>
            <a class="btn btn-Regresar"  href="F_A_ConsultarProveedor.php">
                &larr; Ver listado de proveedores
            </a>
            <br>
            <br>
        </div>
    </form>                
</body>

<script>
    $("#cmbEstado").change(function () {
        var estado = document.getElementById("cmbEstado").value;
        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Consulta_Estado_Municipio.php",
            type: 'POST',
            data: {"estado": estado},
            success: function (data) {
                $("#cmbMunicipio").html(data);

            }
        });

    });

    $("#cmbEstado").ready(function () {
        var estado = document.getElementById("cmbEstado").value;
        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Consulta_Estado_Municipio.php",
            type: 'POST',
            data: {"estado": estado},
            success: function (data) {
                $("#cmbMunicipio").html(data);

            }
        });

    });


</script>


<script>
    $(document).ready(function () {

        $("#form").validate({
            rules: {
                CodigoPostal: {
                    required: true,
                    number: true,
                    minlength: 5,
                    maxlength: 5
                },
                Correo: {
                    email: true,
                    required: true
                },
                RFC: {
                    required: true,
                    maxlength: 13,
                    minlength:12
                },
                Calle: {
                    required: true
                },
                Colonia: {
                    required: true
                },
                NombreCliente: {
                    required: true
                },
                NumeroExterior: {
                    required: true
                }


            },
            messages: {
                CodigoPostal: {
                    required: "Ingresar el código postal",
                    number: "Ingresar sólo números",
                    minlength: "Solo 5 dígitos",
                    maxlength: "Solo 5 dígitos"
                },
                Correo: {
                    email: "Correo electrónico incorrecto",
                    required: "Ingresar correo electrónico"
                },
                
                RFC:{
                    required: "Ingresar RFC",
                    maxlength: "RFC incorrecto",
                    minlength: "RFC incorrecto"
                },


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

