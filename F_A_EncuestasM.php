        <?php
        error_reporting(E_ERROR);
require 'Header.php';
include_once  './Clases/Encuesta.php';
include_once './Clases/Comanda.php';
include_once './Clases/Mesero.php';
        ?>
<title>Consultar encuestas</title>
    
        
        <form action="F_A_EditarMesas.php" method="GET">
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de encuestas</label></center></h4></div>
            </td>
        </table>
                
                
                
                <table  id="tablaFecha" class="tablesorter table-hover table-bordered table-responsive tablaConsulta  " cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
			<tr>
                                <th><div class="centrar"><label>Fecha</label></div></th>
                                <th><div class="centrar"><label>Mesero que atendió comanda</label></div></th>
                                <th width="170px"><div class="centrar"><label>Cocina</label></div></th>
                                <th width='170px'><div class="centrar"><label>Servicio</label></div></th>
                                <th width='170px'><div class="centrar"><label>Ambiente</label></div></th> 
                                <th width='170px'><div class="centrar"><label>Precio</label></div></th>
                                <th width='170px'><div class="centrar"><label>Valoración general</label></div></th>
                                <th ><div class="centrar"><label>Comentarios</label></div></th>
			</tr>
		</thead>
                <tbody>          
                    <?php 
                    $objEncuesta = new Encuesta();
                    $encuestas = $objEncuesta->ConsultarTodo();
                    $objComanda = new Comanda();
                    $objMesero = new Mesero();
                    foreach ($encuestas as $e){
                        
                    $objComanda->ConsultarPorID($e->ID);
                    $objMesero->ConsultarPorID($objComanda->IdMesero);
                    
                    echo "<tr>";
                    echo "<td >$e->Fecha</td>";
                    echo "<td>$objMesero->Nombre $objMesero->Apellidos</td>";
                    echo "<td width='170px'><label class='ocultar'>$e->Cocina</label><input class='rating rating-loading' value='$e->Cocina' dir='ltr' data-size='xs' readonly=''></td>";
                    echo "<td width='170px'><label class='ocultar'>$e->Servicio</label><input class='rating rating-loading' value='$e->Servicio' dir='ltr' data-size='xs' readonly=''></td>";
                    echo "<td width='170px'><label class='ocultar'>$e->Ambiente</label><input class='rating rating-loading' value='$e->Ambiente' dir='ltr' data-size='xs' readonly=''></td>";
                    echo "<td width='170px'><label class='ocultar'>$e->Precio</label><input class='rating rating-loading' value='$e->Precio' dir='ltr' data-size='xs' readonly=''></td>";
                    echo "<td width='170px'><label class='ocultar'>$e->ValoracionGeneral</label><input class='rating rating-loading' value='$e->ValoracionGeneral' dir='ltr' data-size='xs' readonly=''></td>";
                    echo "<td width=''>$e->Comentario</td>";
                    echo "</tr>";
                }
                    ?>
                </tbody>
                    </table>
                <br>
                
                
                <a class="btn btn-Bixa" style="float: right;" href="F_A_RegistrarMesa.php">
                        Agregar otra mesa
                </a>
                <a class="btn btn-Regresar" href="F_A_PaginaPrincipal.php">
                      &larr; Menú Principal
                </a>
                <br>
                <br>
                <br>
           </div>
        </form>    


    </body>
    
    <script>
        
        
/*
 * Adds a new sorting option to dataTables called `date-dd-mmm-yyyy`. Also
 * includes a type detection plug-in. Matches and sorts date strings in
 * the format: `dd/mmm/yyyy`. For example:
 * 
 * * 02-FEB-1978
 * * 17-MAY-2013
 * * 31-JAN-2014
 *
 * Please note that this plug-in is **deprecated*. The
 * [datetime](//datatables.net/blog/2014-12-18) plug-in provides enhanced
 * functionality and flexibility.
 *
 *  @name Date (dd-mmm-yyyy)
 *  @summary Sort dates in the format `dd-mmm-yyyy`
 *  @author [Jeromy French](http://www.appliedinter.net/jeromy_works/)
 *  @deprecated
 *
 *  @example
 *    $('#example').dataTable( {
 *       columnDefs: [
 *         { type: 'date-dd-mmm-yyyy', targets: 0 }
 *       ]
 *    } );
 */

(function () {

var customDateDDMMMYYYYToOrd = function (date) {
	"use strict"; //let's avoid tom-foolery in this function
	// Convert to a number YYYYMMDD which we can use to order
	var dateParts = date.split(/-/);
	//return (dateParts[2] * 10000) + ($.inArray(dateParts[1].toUpperCase(), ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"]) * 100) + (dateParts[0]*1);
};

// This will help DataTables magic detect the "dd-MMM-yyyy" format; Unshift
// so that it's the first data type (so it takes priority over existing)
jQuery.fn.dataTableExt.aTypes.unshift(
	function (sData) {
		"use strict"; //let's avoid tom-foolery in this function
		if (/^([0-2]?\d|3[0-1])-(jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)-\d{4}/i.test(sData)) {
			return 'date-dd-mmm-yyyy';
		}
		return null;
	}
);

// define the sorts
jQuery.fn.dataTableExt.oSort['date-dd-mmm-yyyy-asc'] = function (a, b) {
	"use strict"; //let's avoid tom-foolery in this function
	var ordA = customDateDDMMMYYYYToOrd(a),
		ordB = customDateDDMMMYYYYToOrd(b);
	return (ordA < ordB) ? -1 : ((ordA > ordB) ? 1 : 0);
};

jQuery.fn.dataTableExt.oSort['date-dd-mmm-yyyy-desc'] = function (a, b) {
	"use strict"; //let's avoid tom-foolery in this function
	var ordA = customDateDDMMMYYYYToOrd(a),
		ordB = customDateDDMMMYYYYToOrd(b);
	return (ordA < ordB) ? 1 : ((ordA > ordB) ? -1 : 0);
};

})();
        
        
        
$(document).on('ready', function(){
    $(".rating").ready(function (){
       $(".rating").rating("refresh", {disabled:true, showClear:false,showCaption:false});
    });
    
    
    $('#tablaFecha').dataTable( {
     columnDefs: [
       { type: 'date-dd-mmm-yyyy', targets: 0 }
     ],
     "sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true
  });

});











</script>
</html>
