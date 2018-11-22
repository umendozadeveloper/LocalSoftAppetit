<?php
  require 'Header.php';
//  include_once './Clases/Platillo.php';
//  include_once './Clases/Vino.php';
//  include_once './Clases/TipoFactura.php';
  include_once './Clases/ClientesFacturas.php';
  include_once './Clases/Seguridad.php';
  include_once './Clases/Usuario.php';
  include_once './Clases/Insumo.php';
  include_once './Clases/Almacen.php';
  include_once './Clases/Proveedor.php';
  include_once './Clases/Concepto.php';
?> 
    <title>Registrar Ajuste de Entrada</title>
    
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">   

          
            
<form action="" method="POST" enctype="multipart/form-data" id="form">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Ajuste de Entrada</label></center></h4></div>
            </td>
        </table>
    </div>
            
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
            <table border="0" style="text-align: center;" >
                <tr>
                    <!--<td><button type="button" class="textoOpcionesMenuFacturacion"><span class="glyphicon" style="font-size:22px; color:#0000CD;"></span>Folio: 100</button></td>-->
                    <td>Fecha: </td>
                    <td></td>
                    <td><div align="left"><input class="form-control" type="text" readonly="" name="txtFecha" id="txtFecha" value="<?php echo date('d/m/Y'); ?>" style="width: 42%; text-align: center;"/></div></td>
               
                <td><a href="./F_A_Registrar_Insumo_Inventario.php" style="text-decoration:none; color: black;" class="nounderline"><span class="glyphicon glyphicon-plus-sign" style="font-size:22px; color:#419C67;"></span> Ir a registrar insumo</a></td>
                <!--<td><a href="./F_A_Consultar_Insumos.php" style="text-decoration:none; color: black;" class="nounderline"><span class="glyphicon glyphicon-search" style="font-size:22px; color:#FFA07A;"></span> Ir al listado insumos</a></td>-->
                <td><button type="button" name="btnAgregar" style="color:#0000CD;" id="btnAgregar" class="textoOpcionesMenuFacturacion" onclick=""><span class="glyphicon glyphicon-plus" style="font-size:22px; color:#0000CD;"></span> Agregar Entrada</button></td>
                <!--<td><a href="./F_A_Bitacora_Entradas_Inventario.php" style="text-decoration:none; color: black;" class="nounderline"><span class="glyphicon glyphicon-book" style="font-size:22px; color:#E69C41;"></span> Bitácora de E/S</a></td>-->
                <td><button type="button" name="btnGuardar" id="btnGuardar" class="textoOpcionesMenuFacturacion" onclick=""><span class="glyphicon glyphicon-floppy-disk" style="font-size:22px; color:#4B0082;"></span> Guardar</button></td>
                </tr>
            </table>
         
     </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <div  class="table-responsive Comandas" style="float: left">
            
            <br>

           
            <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Proveedor</strong></td>
                </tr>
                <tr>
                    <td><select id="cmbProveedor" name="cmbProveedor" class="form-control" style="width:95%;">
                      <?php
                        $objUnidad = new Proveedor();
                        $proveedores = $objUnidad->ConsultarTodo();
                        $opcionesProveedor="";
                        foreach ($proveedores as $provee)
                        {
                            $opcionesProveedor.= "<option value='$provee->ID'>$provee->Nombre</option>";
                        }
                        echo $opcionesProveedor;
                      ?>
                    </select></td>
                </tr>
                    
            </table>
             <br>
              <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Número de documento</strong></td>
                </tr>
                <tr>
                    <td><input type="text" name="txtNumDocto" id="txtNumDocto" style="width:95%;" class="form-control"/></td>
                </tr>
                    
            </table>
             <br>
            <table border='0' >
                <tr>
                    <td><div style=" background-color:#FEFCA7; text-align: center;border-top-left-radius: 2em 0.5em;border-top-right-radius: 1em 3em; width: 95%;">Observaciones</div></td>
                </tr>
                <tr>
                    <td><textarea id="txtNotas" name="txtNotas" class="form-control" type="text" style="resize: none; background-color:#FEFCA7; width: 95%;"></textarea></td> 
                </tr>
            </table>
            <br>
            
            <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Encargado</strong></td>
                </tr>
                <tr>
                    <?php 
                        $objSeguridad = new Seguridad();
                        $id_cuenta = $objSeguridad->CurrentUserID();
                        $objUsuario = new Usuario();
                        $objUsuario->ConsultarPorID($id_cuenta);
                    ?>
                    <td><input type="text" name="txtEncargado" id="txtEncargado" style="width:95%;" value="<?php echo $objUsuario->Nombre . " ". $objUsuario->Apellidos;?>" class="form-control" readonly="" /></td>
                     <td><input class="ocultar" type="text" name="txtIdEncargado" id="txtIdEncargado" value="<?php echo $id_cuenta; ?>" /></td>
                </tr>
                </tr>
                    
            </table>
            
            <table border='0'>
               
                <tr>
                    
                    <td><input type="text" class="ocultar" name="OpcionesAlmacen" id="OpcionesAlmacen" value="
                    <?php
                        $objAlmacen = new Almacen();
                        $almacenes = $objAlmacen->ConsultarTodo();
                        $opciones_almacen="<option value='0'>Seleccione...</option>";
                        foreach ($almacenes as $almacen)
                        {
                            if($almacen->ID !='2'){
                                $opciones_almacen.= "<option value='$almacen->ID'>$almacen->Descripcion</option>";
                            }
                        }
                        echo $opciones_almacen;
                        ?>" readonly="" /></td>
                </tr>
                <tr>
                    
                    <td><input type="text" class="ocultar" name="OpcionesConcepto" id="OpcionesConcepto" value="
                    <?php
                        $objConcepto = new Concepto();
                        $conceptos = $objConcepto->ConsultarEntradas();
                        $opciones_concepto="<option value='0'>Seleccione...</option>";
                        foreach ($conceptos as $concepto)
                        {
                            $opciones_concepto.= "<option value='$concepto->ID'>$concepto->Descripcion</option>";
                        }
                        echo $opciones_concepto;
                        ?>" readonly="" /></td>
                </tr>
            </table>
            
<!--            <input type="text" name="InsumosAgregados" id='InsumosAgregados' class="ocultar" />
            <input type="text" name="ContClicks" id='ContClicks' class="mostrar" />-->
        </div>
        
        <br>
        
 
<div class="table-responsive">
    <table border='0' style="width:100%;"class='tableEncabezadoFijo' >
           
            <thead>
            <tr>
                <th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
                <th style="width:28%;" class='EncabezadoTablaPersonalizada'><center>Descripción</center></th>
                <th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
                <th style="width:10%;" class='EncabezadoTablaPersonalizada'><center>Cantidad</center></th>
                <th style="width:11.5%;"class='EncabezadoTablaPersonalizada'><center>Costo</center></th>
                <th style="width:1.5%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
                <th style="width:11.5%;" class='EncabezadoTablaPersonalizada'>Importe</th>
                <th style="width:15%;" class='EncabezadoTablaPersonalizada'>Almacén</th>
                
                <th style="width:15%;"class='EncabezadoTablaPersonalizada'>Concepto</th>
		<th style="width:1%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
            </tr>
    </thead>
    </table>

<!--	</thead>-->

<div style="overflow-y: scroll; height:auto; max-height:176px;">
        <table border='0' style="width:100%;" id='tabla_editable' >

        </table>
   
</div></div>

        <br>
        <div id="divTotal" class="table-responsive">
        <table border="0" id="TablaTotal">
            
        </table>
    </div>     
        
<!--*****************************************ventana modal-->
       <div id="CatalogoClientes" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <h4 class="modal-title">Catálogo de insumos</h4>
                        </div>
                        <div class="modal-body">
                            <div id="" class="table-responsive">
                                <table name='TablaInsumos' id="TablaInsumos" class="tablesorter table-bordered" cellspacing="0" style="">
                                
                                    <thead style="margin-bottom: 10px; overflow-x: scroll;" >
                                    <tr>
                                        <th style="padding-right: 89.5px;">Descripción</th>
                                        
                                        <th style="padding-right: 89.5px;">Presentación</th>
                                        
                                        <th style="padding-right: 20px;">Selección</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
    $objInsumos = new Insumo();
    $todos_insumos = $objInsumos->ConsultarTodo();
    foreach ($todos_insumos as $ins){
        echo "<tr>"
        . "<td>$ins->Descripcion</td>"
        . "<td>$ins->Presentacion</td>"
        . "<td><center><input type='radio' name='Insumo' id='Insumo' value='$ins->ID'/></center></td></tr>";
    }
    echo "</table>";
?>
                                </tbody>
                                
                            </table>
                                
                                

                            </div>
                          
                            <input type="text" id="txtIdElegido" name="txtIdElegido" class="ocultar" >
                                 
                           
                            
                                
                           
                            
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-Bixa" data-dismiss="modal" name="btnAgregarInsumo" id="btnAgregarInsumo">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        
<!--    </div>-->
    
    
    
    
   <script type="text/javascript">

    //Carga el calendario
    $(function(){
        $("#txtFecha").datepicker({
            changeMonth:true,
            changeYear:true,
            showButtonPanel:true,
            maxDate: '+0d',
        });
    })

     $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
     };
     $.datepicker.setDefaults($.datepicker.regional['es']);
     
     $(function () {
     $("#txtFecha").datepicker();
    });
</script>
    




<script>
    $(document).ready(function() {
        $('#TablaInsumos').DataTable();
        
        $('#btnAgregar').click(function(){
            AgregarFila();
            DibujarTotal();
        });
        AgregarFila();
        DibujarTotal();
       
    });
    
    var cont=0;
   
    function AgregarFila(){
        var OpcionesAlmacen = document.getElementById("OpcionesAlmacen").value;
        var OpcionesConcepto = document.getElementById("OpcionesConcepto").value;
                
        cont++;
        
        var fila='<tr id="fila'+cont+'" >'+
                '<td style="width:2%; font-size: 9px; text-align:center;"></td>'+
                 '<td style="width:0.1%; font-size: 9px; text-align:center;" class="ocultar">'+cont+'</td>'+    
                '<td style="width:28%;"><input type="text" class="form-control" id="txtDescripcion'+cont+'" name="txtDescripcion'+cont+'" readonly="" /></td>'+
                '<td style="width:0.1%;"><input type="text" class="ocultar" id="txtIdDescripcion'+cont+'" name="txtIdDescripcion'+cont+'" readonly="" /></td>'+
                '<td style="width:2%;"><button type="button" class="textoOpcionesMenuFacturacion" name="btnMas'+cont+'" id="btnMas'+cont+'" onclick="ColocarIdElegido(this.id);" data-toggle="modal" data-target="#CatalogoClientes"><span class="glyphicon glyphicon-search"></span></button></td></td>'+
//                alert("entra");
                '<td style="width:10%;"><input value="0.00" type="text" class="form-control"  id="txtCantidad'+cont+'" name="txtCantidad'+cont+'"  onkeyup="CalcularImporteCantidad(this.id);"  /></td>'+
                '<td style="width:11.5%;"><input value="0.00" type="text" class="form-control" id="txtCosto'+cont+'" name="txtCosto'+cont+'"  onkeyup="CalcularImporteCosto(this.id);" /></td>'+
                
    //                 
                '<td style="width:11.5%;"><input value="0" type="text" class="form-control" id="txtImporte'+cont+'" name="txtImporte'+cont+'" readonly="" /></td>'+
                '<td style="width:15%;"><select class="form-control" id="cmbAlmacen'+cont+'">'+OpcionesAlmacen+'</select></td>'+           
                '<td style="width:15%;"><select class="form-control" id="cmbConcepto'+cont+'" name="cmbConcepto'+cont+'">'+OpcionesConcepto+'</select></td>'+

            '<td style="width:1%;"><button type="button" id="btn'+cont+'" class="textoOpcionesMenuFacturacion" onclick="eliminar(this.id)"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
            
        $('#tabla_editable').append(fila);
        reordenar();
    }
    
    
    function eliminar(id_fila){

        var arreglo_nombre_boton = id_fila.split("n");
//        alert(arreglo_nombre_boton[1]);
        var id= arreglo_nombre_boton[1];
        $('#fila'+ id).remove();
        reordenar();
        CalcularCostoTotal();
    }

    function reordenar(){
        var num=1;
        $('#tabla_editable tbody tr').each(function(){
                $(this).find('td').eq(0).text(num);
                num++;
        });
    }
    function eliminarTodasFilas(){
        $('#tabla_editable tbody tr').each(function(){
            $(this).remove();
        });

    }
    
    function ColocarIdElegido(id_elegido){
       
         $("#txtIdElegido").val(id_elegido);
    }
    
    function DibujarTotal(){
        $('#TablaTotal tbody tr').each(function(){
            $(this).remove();
        });
        var fila = "<tr><td style='width:70%;'>&nbsp;</td><td style='width:15%'><center>COSTO TOTAL</center></td><td style='width:15%'><input id='txtCostoTotal' name='txtCostoTotal' class='form-control' readonly=''/></td></tr>";
        
        $('#TablaTotal').append(fila);
        
    }
    
    function CalcularImporteCosto(id){
       
//        alert(id);
        var arreglo_id_boton = id.split("o");
        var cantidad = document.getElementById("txtCantidad"+ arreglo_id_boton[2]).value;
        var costo = document.getElementById("txtCosto"+ arreglo_id_boton[2]).value;
//        alert(arreglo_id_boton[2]);
        var importe = cantidad * costo;
        
         $("#txtImporte" + arreglo_id_boton[2]).val(importe);
         CalcularCostoTotal();
    }
     function CalcularImporteCantidad(id){
       
//        alert(id);
        var arreglo_id_boton = id.split("d");
        var cantidad = document.getElementById("txtCantidad"+ arreglo_id_boton[2]).value;
        var costo = document.getElementById("txtCosto"+ arreglo_id_boton[2]).value;
        
        var importe = cantidad * costo;
        
         $("#txtImporte" + arreglo_id_boton[2]).val(importe);
         CalcularCostoTotal();
    }
    
</script>

<script>
        $("button[name='btnAgregarInsumo']").click(function() {
//         
           var id_insumo = $("input[name='Insumo']:checked").val();
           if(id_insumo === undefined){
               id_insumo = "0";
           }

        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Mostrar_Insumos.php",
            type: 'POST',
            data: {"id_insumo": id_insumo},
            success: function(data){
                var insumo = data;
                
                var boton_elegido = document.getElementById("txtIdElegido").value;
                var arreglo_id_boton = boton_elegido.split("s");

                var id= "#txtDescripcion" + arreglo_id_boton[1];
                
                 $(id).val(insumo);
                 
                  //Coloca el id del insumo en la tabla
                    var id_insumo = $("input[name='Insumo']:checked").val();
                    $("#txtIdDescripcion"+ arreglo_id_boton[1]).val(id_insumo);
            }
        });


            


        });
        
        function CalcularCostoTotal()
    {
         var costo_total = 0.00;
         $("#tabla_editable tbody tr").each(function(index){
              var importe,fila;
          
              $(this).children("td").each(function (index2) 
              {
    //                      alert("entra");
                    switch (index2) 
                    {
                        case 1: fila = $(this).text();//ID de la fila
                            break;

                        case 7: importe = parseFloat($('input:text[name=txtImporte'+fila+']').val());
                            costo_total = parseFloat(costo_total) + parseFloat(importe);

                            break;
                    }
                 
             });
            $("#txtCostoTotal").val(costo_total);  
         });
    }
     
     
     $("button[name='btnGuardar']").click(function() {
               
               
               var compras="";
               var fecha, proveedor, numero_documento, observaciones, encargado, costo_total;
               $("#tabla_editable tbody tr").each(function(index){
                  var fila, descripcion, cantidad, costo, importe, almacen,concepto;
                  $(this).children("td").each(function (index2) 
                  {
//                      alert("entra");
                        switch (index2) 
                        {
                            case 1: fila = $(this).text();
                                break;
                            case 3: descripcion = $('input:text[id=txtIdDescripcion'+fila+']').val();
                                break;
                            case 5: cantidad= $('input:text[name=txtCantidad'+fila+']').val();
                                break;
                            case 6: costo= $('input:text[name=txtCosto'+fila+']').val();
                                break;
                            case 7: importe= $('input:text[name=txtImporte'+fila+']').val();
                                break;
                            case 8: almacen= $('select[id=cmbAlmacen'+fila+']').val();
                                break;
                            case 9: concepto= $('select[id=cmbConcepto'+fila+']').val();
                                break;
                        }
                        
                 });
                    compras += "├" + descripcion + "─" + cantidad + "─" + costo + "─" + importe + "─" + almacen + "─" + concepto;
                   
               });
               
               fecha = document.getElementById("txtFecha").value;
               proveedor = document.getElementById("cmbProveedor").value;
               numero_documento = document.getElementById("txtNumDocto").value;
               observaciones = document.getElementById("txtNotas").value; 
               encargado = document.getElementById("txtIdEncargado").value;
               costo_total = document.getElementById("txtCostoTotal").value;
             
//               alert(fecha + " "+ proveedor + " "+ numero_documento + " " + observaciones + " " + encargado + " " + costo_total);
             
               
               $.ajax({
                    url: "Validaciones_Lado_Servidor/Validar_RegistrarAjusteEntrada.php",
                   
                    type: 'POST',
                    data: {"fecha": fecha,
                            "proveedor": proveedor,
                            "numero_documento": numero_documento,
                            "observaciones": observaciones,
                            "encargado": encargado,
                            "costo_total": costo_total,
                            "compras": compras
                        },
                    success: function(data){
                      
                        if(data == 1)
                        {
                           
                            swal("¡Correcto!", "Se ha registrado la entrada correctamente.", "success");
                            
                            eliminarTodasFilas();
                            AgregarFila();
                            DibujarTotalUno();
                            
                            var f = new Date(); 
                            var dia= f.getDate();
                            var aux_mes =  f.getMonth() +1;
                            if(aux_mes<10)
                            {
                                mes = "0" + aux_mes;
                            }else{
                                mes = aux_mes;
                            }
                            annio =  f.getFullYear();
              
//                            
                            $("#txtFecha").val(dia + "/"+mes+"/"+annio);
                            $("#txtNumDocto").val("");
                            $("#txtNotas").val("");
                            $("#txtCostoTotal").val("0.00"); 
//                            
                        }else{
                            swal("¡Error!", "No se pudo registrar la entrada. Intente más tarde.", "error");
                        }
                    }
                });
               
               
           });
     
     
    </script>
   
    

                      
</form>        
    
    </body>  
</html>
