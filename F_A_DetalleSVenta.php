
<?php
 

  include_once './Clases/Seguridad.php';
  include_once './Clases/Salida.php';
  include_once './Clases/SalidaVenta.php';
  include_once './Clases/EntradaCompras.php';
  include_once './Clases/ClientesFacturas.php';
  include_once './Clases/Usuario.php';
  include_once './Clases/DetalleSalida.php';
  
  if(isset($_GET['IdSalida'])){

                $ID= $_GET['IdSalida'];
               
                
            }
            else{
                header("Location: F_A_ConsultarSalidas.php");
            }
  require 'Header.php';
?> 
    <title>Detalle Salida Inventario</title>
    
            
<form action="" method="POST" enctype="multipart/form-data" id="form">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Detalle de consumo (Salida)</label></center></h4></div>
            </td>
        </table>
    </div>
            
    <?php
        $objSalidaVenta = new SalidaVenta();
        $salidasVentas =  $objSalidaVenta->ConsultarSalidas_SalidasVentas_Cliente_EncargadoPorID($ID);
    ?>
    
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <div  class="table-responsive Comandas" style="float: left">
            
           

           
            <table border='0'>
                 <tr>
                    <td>Fecha: </td>
                 </tr>
                 <tr>
                    <td><div align="left"><input class="form-control" type="text" name="txtFecha" id="txtFecha" style="width: 95%; text-align: center;" value="<?php echo $salidasVentas['Fecha']; ?>" readonly=""/></div></td>
                 </tr>
                 
                
               
            </table>

             <br>
            <table border='0'>
               <tr>
                    <td><strong style="text-align: center;">Cliente</strong></td>
                </tr>
                
                <tr>
                    <td><input type="text" name="txtCliente" id="txtCliente" style="width:95%;" class="form-control" readonly="" value="<?php echo $salidasVentas['NombreCliente']; ?>" /></td>
                    
                </tr>
            </table>
             <br>
            <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Encargado</strong></td>
                </tr>
                <tr>
                    
                    <td><input type="text" name="txtEncargado" id="txtEncargado" style="width:95%;" value="<?php echo $salidasVentas['Nombre'] . " ". $salidasVentas['Apellidos'];?>" class="form-control" readonly="" /></td>
                   
                </tr>
                    
            </table>
            
              
        </div>
        
        <br>
        
 
<div class="table-responsive">
    <table border='0' style="width:100%;"class='tableEncabezadoFijo' >
           
            <thead>
            <tr>
                <th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
                <th style="width:34%;" class='EncabezadoTablaPersonalizada'><center>Descripción</center></th>
                <th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
                <th style="width:12.5%;" class='EncabezadoTablaPersonalizada'><center>Cantidad</center></th>
                <th style="width:13%;"class='EncabezadoTablaPersonalizada'><center>Costo</center></th>
                <th style="width:1.5%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
                <th style="width:13%;" class='EncabezadoTablaPersonalizada'>Importe</th>
                <th style="width:20%;" class='EncabezadoTablaPersonalizada'>Almacén</th>
<!--                <th style="width:15%;"class='EncabezadoTablaPersonalizada'>Concepto</th>-->
		<th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
            </tr>
    </thead>
    </table>
	</thead>
    <div style="overflow-y: scroll; height: auto;max-height:176px;">
        <table border='0' style="width:100%;" id='tabla_editable' >
            <?php
                $detalleS = array();
                $objDetalleSalida = new DetalleSalida();
                $detalleS = $objDetalleSalida->ConsultarSDParaInterfaz($ID);
                $fila='';
                foreach ($detalleS as $salida)
                {
                     $fila='<tr>'.
                    '<td style="width:2%; font-size: 9px; text-align:center;"></td>'.
                    '<td style="width:34%;"><input value="'.$salida['Insumo'].': '.$salida['Presentacion'].'" type="text"  class="form-control" id="txtDescripcion'.$salida['IdDetalle'].'" name="txtDescripcion'.$salida['IdDetalle'].'" readonly="" /></td>'.
                    '<td style="width:12.5%;"><input value="'.$salida['Cantidad'].'" type="text" class="form-control" id="txtCantidad'.$salida['IdDetalle'].'" name="txtCantidad'.$salida['IdDetalle'].'" readonly=""/></td>'.
                    '<td style="width:13%;"><input value="'.$salida['Costo'].'" type="text" class="form-control" id="txtCosto'.$salida['IdDetalle'].'" name="txtCosto'.$salida['IdDetalle'].'" readonly=""/></td>'.
                    '<td style="width:13%;"><input value="'.$salida['Importe'].'" type="text" class="form-control" id="txtImporte'.$salida['IdDetalle'].'" name="txtImporte'.$salida['IdDetalle'].'" readonly="" /></td>'.
                    '<td style="width:20%;"><input value="'.$salida['Almacen'].'" type="text" class="form-control" id="txtAlmacen'.$salida['IdDetalle'].'" name="txtAlmacen'.$salida['IdDetalle'].'" readonly="" /></td></tr>';          
//
                    echo $fila;
                }
                
               
            ?>
        <tbody>
            <div >
        </table>
   
</div>
        <br>
   <div id="divTotal">
        <table border="0" id="TablaTotal">
            <tr>
                <td style='width:70%;'>&nbsp;</td><td style='width:15%'><center>COSTO TOTAL</center></td>
            <?php
                $costo_total = $objDetalleSalida->ObtenerTotalSalida($ID);
            ?>
                <td style='width:15%'><input id='txtCostoTotal' name='txtCostoTotal' class='form-control' readonly='' value="<?php echo $costo_total; ?>" /></td>
            </tr>
        
        </table>
    </div>     
        

    
    
    
   




<script>
    $(document).ready(function() {
        $('#TablaInsumos').DataTable();
        $('#TablaClientes').DataTable();
        
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
        cont++;
        
        var fila='<tr id="fila'+cont+'" >'+
                '<td style="width:2%; font-size: 9px; text-align:center;"></td>'+
                '<td style="width:0.1%; font-size: 9px; text-align:center;" class="ocultar">'+cont+'</td>'+    
                '<td style="width:34%;"><input type="text" class="form-control" id="txtDescripcion'+cont+'" name="txtDescripcion'+cont+'" readonly="" /></td>'+
                '<td style="width:0.1%;"><input type="text" class="ocultar" id="txtIdDescripcion'+cont+'" name="txtIdDescripcion'+cont+'" readonly="" /></td>'+
                '<td style="width:2%;"><button type="button" class="textoOpcionesMenuFacturacion" name="btnMas'+cont+'" id="btnMas'+cont+'" onclick="ColocarIdElegido(this.id);" data-toggle="modal" data-target="#CatalogoInsumos"><span class="glyphicon glyphicon-search"></span></button></td></td>'+
                '<td style="width:12.5%;"><input value="0.00" type="text" class="form-control" id="txtCantidad'+cont+'" name="txtCantidad'+cont+' " onkeyup="CalcularImporteCantidad(this.id);"/></td>'+
                '<td style="width:13%;"><input value="0.00" type="text" class="form-control" id="txtCosto'+cont+'" name="txtCosto'+cont+'" onkeyup="CalcularImporteCosto(this.id);"/></td>'+
                '<td style="width:13%;"><input value="0" type="text" class="form-control" id="txtImporte'+cont+'" name="txtImporte'+cont+'" readonly="" /></td>'+
                '<td style="width:0.1%;"><input value="2" type="text" class="ocultar" id="txtIDAlmacen'+cont+'" name="txtIDAlmacen'+cont+'" readonly="" /></td>'+ 
                '<td style="width:20%;"><input value="Consumo" type="text" class="form-control" id="txtAlmacen'+cont+'" name="txtAlmacen'+cont+'" readonly="" /></td>'+           
               
            '<td style="width:2%;"><button type="button" id="btn'+cont+'" class="textoOpcionesMenuFacturacion" onclick="eliminar(this.id)"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
            
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
</script>

<script>
    $("button[name='btnAgregarInsumo']").click(function() {
//         
           var id_insumo = $("input[name='Insumo']:checked").val();
           if(id_insumo === undefined){
               id_insumo = "0";
           }

        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Traer_Insumos_Precio.php",
            type: 'POST',
            data: {"id_insumo": id_insumo},
            success: function(data){
                var insumo = data;
                
                var tempo_insumo = insumo.split("├");
                
                var boton_elegido = document.getElementById("txtIdElegido").value;
                var arreglo_id_boton = boton_elegido.split("s");

                var id= "#txtDescripcion" + arreglo_id_boton[1];
                
                 $(id).val(tempo_insumo[0]);
                 $("#txtCosto"+arreglo_id_boton[1]).val(tempo_insumo[1]);
                 
                   //Coloca el id del insumo en la tabla
                var id_insumo = $("input[name='Insumo']:checked").val();
                $("#txtIdDescripcion"+ arreglo_id_boton[1]).val(id_insumo);
             
            }
        });
    });
        
        $("button[name='btnAgregarCliente']").click(function() {        
           var id_cliente = $("input[name='Cliente']:checked").val();
//           alert(id_cliente);
        

            $.ajax({
                url: "Validaciones_Lado_Servidor/N_CargarClienteSalida.php",
                type: 'POST',
                data: {"id_cliente": id_cliente},
                success: function(data) {
                   $("#txtCliente").val(data);
                   $("#txtIDCliente").val(id_cliente);
                    
//                    $("#DatosClientes").html(data);

                }
            });

        });
        
    $("button[name='btnGuardar']").click(function() {
        
       var ventas="";
       var fecha, cliente, encargado, costo_total;
       
       fecha = document.getElementById("txtFecha").value;
       cliente = document.getElementById("txtIDCliente").value;
       encargado = document.getElementById("txtIdEncargado").value;
       costo_total = document.getElementById("txtCostoTotal").value;
         
       $("#tabla_editable tbody tr").each(function(index){
          var fila, descripcion, cantidad, costo, importe, almacen;
          $(this).children("td").each(function (index2) 
          {
//                      alert("entra");
                switch (index2) 
                {
                    case 1: fila = $(this).text();
                        break;
                    case 3: descripcion = $('input:text[name=txtIdDescripcion'+fila+']').val();
                        break;
                    case 5: cantidad= $('input:text[id=txtCantidad'+fila+']').val();
                        break;
                    case 6: costo= $('input:text[name=txtCosto'+fila+']').val();
                        break;
                    case 7: importe= $('input:text[name=txtImporte'+fila+']').val();
                        break;
                    case 8: almacen= $('input:text[name=txtIDAlmacen'+fila+']').val();
                        break;
                }

         });
            ventas += "├" + descripcion + "─" + cantidad + "─" + costo + "─" + importe + "─" + almacen;
            
       });
               
       

//               alert(fecha + " "+ proveedor + " "+ numero_documento + " " + observaciones + " " + encargado + " " + costo_total);
      
       $.ajax({
            url: "Validaciones_Lado_Servidor/Validar_RegistrarSalida.php",

            type: 'POST',
            data: {"fecha": fecha,
                    "cliente":cliente,
                   
                    "encargado": encargado,
                    "costo_total": costo_total,
                    "ventas": ventas
                },
            success: function(data){
                
                
                if(data == 1)
                {

                    swal("¡Correcto!", "Se ha registrado la salida correctamente.", "success");

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
                    $("#txtCostoTotal").val("0.00");
//                            
//                            
                }
                else{
                    swal("¡Error!", "No se pudo registrar la salida. Intente más tarde.", "error");
                }
            }
        });


   });
    </script>
       
       
    </script>
   
    

                      
</form>        