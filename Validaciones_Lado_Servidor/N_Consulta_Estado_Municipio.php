<?php

$Id_Estado = $_POST['estado'];
require '../Clases/CatalogoMunicipio.php';
$objCatMunicipio = new CatalogoMunicipio();
$municipios = $objCatMunicipio->ConsultarPorIdEstado($Id_Estado);


    


?>
<select id="cmbMunicipio"  class="form-control" name="cmbMunicipio">
<?php
foreach ($municipios as $m) {
    if (isset($_SESSION['valId_Municipio']) && !empty($_SESSION['valId_Municipio'])) {
        $dato = $_SESSION['valId_Municipio'];
        if ($m->Id_Municipio == $dato) {
            echo "<option  value ='" . $m->Id_Municipio . "' selected>" . $m->DESCRIP . "</option>";
        } else {
            echo "<option  value ='" . $m->Id_Municipio . "'>" . $m->DESCRIP . "</option>";
        }
    } else {
        if ($m->Id_Municipio == $dato) {
            echo "<option  value ='" . $m->Id_Municipio . "' selected>" . $m->DESCRIP . "</option>";
        } else {
            echo "<option  value ='" . $m->Id_Municipio . "'>" . $m->DESCRIP . "</option>";
        }
    }
}
$_SESSION['valId_Municipio'] = null;
?>
</select>