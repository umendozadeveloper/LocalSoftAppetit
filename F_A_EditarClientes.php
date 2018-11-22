
<?php
require 'Header.php';
require_once './Clases/CatalogoEstado.php';
require_once './Clases/CatalogoMunicipio.php';
?>               


<title>Editar Clientes</title>

<?php
require './Clases/ClientesFacturas.php';

if (isset($_GET['IdCliente'])) {

    if (!empty($_SESSION['msjEditarMesero'])) {
        echo "<script>swal('" . $_SESSION['msjEditarMesero'][0] . "');</script>";
        $_SESSION['msjEditarMesero'] = "";
    }
    $ID = $_GET['IdCliente'];

    $objCliente = new ClientesFacturas();
    $objCliente->obtenerPorID($ID);
} else {
    header("Location: F_A_ConsultarClientes.php");
}
?>
<body>
    <form action="Validaciones_Lado_Servidor/N_EditarCliente.php" method="POST" enctype="multipart/form-data" id="form">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar datos del cliente</label></center></h4></div>
            </td>
        </table>        
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table class="table-hover">
                <tr>
                    <td><div class="etiquetas2">Nombre Fiscal</div></td>
                    <?php 
                        if($ID==1 || $ID==2)
                        {
                             echo "<td colspan='4'><div class='campos'><input readonly='' type='text' id='NombreCliente'  name='NombreCliente' title='Ingresar Datos' class='form-control' value='$objCliente->NombreCliente'></div></td>";
               
                        }
                        else{
                           
                           echo "<td colspan='4'><div class='campos'><input type='text' id='NombreCliente'  name='NombreCliente' title='Ingresar Datos' class='form-control' value='$objCliente->NombreCliente'></div></td>";
               
                        }
                    ?>
                     </tr>                        


                <tr>
                    <td><div class="etiquetas2">RFC</div></td>
                    <?php 
                        if($ID==1 || $ID==2)//público en general y restaurante
                        {
                            echo "<td colspan='4'><div class='campos'><input readonly='' id='RFC' type='text' name='RFC' title='Ingresar Datos' class='form-control' value='$objCliente->RFC'></div></td>";
                    
                        }
                        else{
                           
                           echo "<td colspan='4'><div class='campos'><input type='text' id='RFC'  name='RFC' title='Ingresar Datos' class='form-control' value='$objCliente->RFC'></div></td>";
                    
                        }
                    ?>
                    
                </tr>                        

                <tr>
                    <td><div class="etiquetas2">Calle</div></td>
                    <td colspan='4'><div class='campos'><input type='text' id="Calle"  name='Calle' title='Ingresar Datos' class='form-control' value="<?php echo $objCliente->Calle; ?>"></div></td>
                    
                </tr> 
                <tr>
                    <td><div class="etiquetas2">Número exterior</div></td>
                    <td colspan='4'><div class='campos'><input type='text' id="NumeroExterior"  name='NumeroExterior' title='Ingresar Datos' class='form-control' value="<?php echo $objCliente->NumeroExterior; ?>"></div></td>
                    
                </tr>  

                <tr>
                    <td><div class="etiquetas2">Número interior</div></td>
                    <td colspan='4'><div class='campos'><input type='text' id="NumeroInterior"  name='NumeroInterior' title='Ingresar Datos' class='form-control' value="<?php echo $objCliente->NumeroInterior; ?>"></div></td>
                    
                </tr>  
                <tr>
                    <td><div class="etiquetas2">Colonia</div></td>
                    <td colspan='4'><div class='campos'><input type='text' id="Colonia"  name='Colonia' title='Ingresar Datos' class='form-control' value="<?php echo $objCliente->Colonia; ?>"></div></td>
                    
                </tr>

                 <tr>
                    <td><div class="etiquetas2">Estado</div></td>
                    <td colspan="4">
                        <div class='campos'>
                            <select id="cmbEstado" name='cmbEstado'  class="form-control" name="cmbEstado">
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
                            if ($e->Id_Estado == $objCliente->IdEstado) {
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
                            <select  id="cmbMunicipio" name="cmbMunicipio" class="form-control" name="cmbMunicipio">
                                <?php
                                $objMunicipios = new CatalogoMunicipio();
                                $MPO = 0;

                                $objMunicipios = $objMunicipios->ObtenerDisponibles();
                                foreach ($objMunicipios as $Municipios) {
                                    if ($objCliente->IdMunicipio == $Municipios->Id_Municipio) {
                                        //echo "<input type='text' id='Direccion' name='Direccion' value='$ObjUsuario->Direccion'  class='ocultar' >";
                                        $MPO = $Municipios->MPO;
                                        echo "<option value ='" . $Municipios->Id_Municipio . "' selected>$Municipios->DESCRIP</option>";
                                    } else {
                                        echo "<option value ='" . $Municipios->Id_Municipio . "'>$Municipios->DESCRIP</option>";
                                    }
                                }
                                echo "<input type='text' id='Municipio' name='Municipio' value='$MPO'  class='ocultar' >";
                                ?>
                            </select>
                        </div>
                    </td>
                </tr> 
                
                

            </table>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover" width="84.5%">


                <tr>
                    <td><div class="etiquetas2">Código postal</div></td>
                    <td colspan='4'><div class='campos'><input type='text'id="CodigoPostal"  name='CodigoPostal' title='Ingresar Datos' class='form-control' value="<?php echo $objCliente->CodigoPostal; ?>"></div></td>
                    
                </tr> 
                 <tr>
                    <td><div class="etiquetas2">País</div></td>
                    <td colspan='4'><div class='campos'><input  type='text' id="Pais"  name='Pais' title='Ingresar Datos' class='form-control' value="<?php echo $objCliente->Pais; ?>"></div></td>
                    
                    
                </tr>
                <tr>
                    <td><div class="etiquetas2">Correo electrónico</div></td>
                    <td colspan='4'><div class='campos'><input type='text' id="Correo"  name='Correo' title='Ingresar Datos' class='form-control' value="<?php echo $objCliente->Correo; ?>"></div></td>
                    
                    
                </tr>
    
                <tr>
                    <td><div class="etiquetas2">Teléfono</div></td>
                    <td colspan='4'><div class='campos'><input type='text' id='Telefono'  name='Telefono' title='Ingresar Datos' class='form-control' value="<?php echo $objCliente->Telefono; ?>"></div></td>
                    
                    
                </tr>
                
                <tr>
                            <td ><div class="etiquetas2">Datos de contacto</div></td>
                        <?php
                            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='3' id='txtContacto' name='txtContacto'>$objCliente->DatosContacto</textarea></div></td>";
                                
                            ?>
                        </tr>
                    
                 <tr>
                            <td ><div class="etiquetas2">Observaciones</div></td>
                        <?php
                           echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='4' id='txtObservaciones' name='txtObservaciones'>$objCliente->Observaciones</textarea></div></td>";
                               
                            ?>
                        </tr>
                
                <tr>
        <td><div class="etiquetas2">Estatus</div></td>
        <td><div class='campos'><select id="cmbEstatus" class="form-control" name="cmbEstatus">
            <?php
            if (isset($_SESSION['valStatus']) && !empty($_SESSION['valStatus'])) {
                if ($_SESSION['valStatus']=='0')
                {
                    echo "<option value='1'>Activo</option>
                          <option value='0' selected>Inactivo</option>";
                }else{
                    echo "<option value='1' selected>Activo</option>
                          <option value='0'>Inactivo</option>";
                }
            }
            else{
                if($objCliente->Estatus =='0')
                {
                    echo "<option value='1'>Activo</option>
                          <option value='0' selected>Inactivo</option>";
                }
                else{
                     echo "<option value='1' selected>Activo</option>
                          <option value='0'>Inactivo</option>";
                }
                
                 $_SESSION['valStatus']=null;
            }
        ?>
                   
                    
        </select>
        </div></td>
        
    </tr> 
               

                

<tr>
                <td> <input type="text" style="color: black;" class="ocultar" name="ID" value="<?php echo $objCliente->ID; ?>"></td>
            </tr>
            </table>
        </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <br>
            <br>

            <button type="submit" id="btnAceptar" name="btnModificar" style="float: right" class="btn btn-Bixa btn-ms" >Guardar</button>
            <a class="btn btn-Regresar"  href="F_A_ConsultarClientes.php">
                &larr; Ver listado de clientes
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
                $("#cmbMunicipio").prop("selectedIndex", $("#Municipio").val() - 1);

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
                    required: true
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


