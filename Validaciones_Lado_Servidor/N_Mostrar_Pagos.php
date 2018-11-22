<?php

require_once '../Clases/CatalogoMetodoPago.php';
require_once '../Clases/CatalogoFormaPago.php';

if (isset($_POST['Seleccionados'])) {
    $Seleccion = $_POST['Seleccionados'];
} else {
    $Seleccion = "";
}

$objFormaPago = new CatalogoFormaPago();
$objMetodoPago = new CatalogoMetodoPago();

$Forma = false;

echo "<div class='modal-body'name='ModalBody' id='ModalBody'><table class='table'>
                            <thead>
                            <th>
                            </th>
                            <th>
                            </th>
                            </thead>
                            <tbody>";


echo "<tr><td>Método de Pago</td><td><select class='form-control' name='cmbMetodoPago' id='cmbMetodoPago' onChange=''>";


$cMetodos = $objMetodoPago->ConsultarTodo();
foreach ($cMetodos as $cE) {
    if(!$Forma)
    {
    echo "<option value='$cE->Id' selected>$cE->Nombre</option>";
    $Forma = true;
    }
}
echo "                                                </select></td></tr>";

echo "<tr><td>Forma de pago</td><td><select class='form-control' name='cmbFormaPago' id='cmbFormaPago' onChange='MostrartxtCuenta();'>";


$cPagos = $objFormaPago->ConsultarTodo();

foreach ($cPagos as $cP) {

    echo "<option value='$cP->Id'>$cP->Nombre</option>";
}
echo "                                                </select> </div>
                                    
                                    
                                </tr>
                                <tr>
                                    <td>Número de cuenta</td>
                                    <td>
                                        <input type='text' maxlength='4' class='ocultar form-control' type='text'id='txtCuenta' name='txtCuenta' maxlength='5'size='6'/>
                                        


                                    </td>
                                    

                                </tr>
                                <tr>
                                    <td><button type='button' class='btn btn-Bixa' id='Aplicar' name='Aplicar' onclick='AplicarEditarPago();'>Aplicar</button></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>";
