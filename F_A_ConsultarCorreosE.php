<?php 
include_once 'Header.php';
include_once './Clases/ContactoClientes.php';
$objContactoClientes = new ContactoClientes();
$contactos = $objContactoClientes->ConsultarTodo();
?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de correos enviados</label></center></h4></div>
            </td>
        </table>
    
    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
        <tr>
                                <th><div class="centrar"><label>Asunto</label></div></th>
                                <th><div class="centrar"><label>Cuerpo del correo</label></div></th>
                                <th><div class="centrar"><label>Clientes</label></div></th>
                                <th><div class="centrar"><label>Fecha</label></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($contactos as $c){
            echo "<tr>";
            echo "<td>$c->Asunto</td>";
            echo "<td>$c->Cuerpo</td>";
            echo "<td>$c->Clientes</td>";
            echo "<td>$c->Fecha</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    </table>