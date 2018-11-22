<?php
  include_once './Clases/ClientesFacturas.php';
  include_once './Clases/Seguridad.php';
  include_once './Clases/Usuario.php';
  include_once './Clases/Insumo.php';
  include_once './Clases/Almacen.php';
  include_once './Clases/Proveedor.php';
  include_once './Clases/Concepto.php';
  
  include_once './Clases/EntradaAjuste.php';
  include_once './Clases/Entrada.php';
  
  if(isset($_GET['IdEntrada'])){

                $ID= $_GET['IdEntrada'];
               
                
            }
            else{
                header("Location: F_A_ConsultarAjusEntradas.php");
            }
  require 'Header.php';
?> 
    <title>Registrar Ajuste de Entrada</title>
    
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">   -->

          
            
<form action="" method="POST" enctype="multipart/form-data" id="form">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Detalle de ajuste de entrada</label></center></h4></div>
            </td>
        </table>
    </div>

    <?php
        $objEntradasAjustes = new EntradaAjuste();
        $entrada_ajuste = $objEntradasAjustes->ConsultarEntradas_Ajuste_ProveedorPorID($ID);
    ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <div  class="table-responsive Comandas" style="float: left">
            
            <br>

             <table border='0'>
                 <tr>
                     <td>Fecha </td>
                 </tr>
                 <tr>
                    <td><div align="left"><input class="form-control" type="text" readonly="" name="txtFecha" id="txtFecha" value="<?php echo $entrada_ajuste['Fecha'];  ?>" style="width: 95%; text-align: center;"/></div></td>
               
                 </tr>
            </table>
            <br>
            <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Proveedor</strong></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" readonly="" id="txtProveedor" name="txtProveedor" style="width: 95%;" value="<?php echo $entrada_ajuste['Proveedor'] ?>"  /></td>
                </tr>
                    
            </table>
             <br>
              <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Número de documento</strong></td>
                </tr>
                <tr>
                    <td><input type="text" name="txtNumDocto" id="txtNumDocto" style="width:95%;" class="form-control" readonly="" value="<?php echo $entrada_ajuste['Documento']; ?>"/></td>
                </tr>
                    
            </table>
             <br>
            <table border='0' >
                <tr>
                    <td><div style=" background-color:#FEFCA7; text-align: center;border-top-left-radius: 2em 0.5em;border-top-right-radius: 1em 3em; width: 95%;">Observaciones</div></td>
                </tr>
                <tr>
                    <td><textarea id="txtNotas" name="txtNotas" class="form-control" type="text" style="resize: none; background-color:#FEFCA7; width: 95%;"><?php echo $entrada_ajuste['Observaciones']; ?></textarea></td> 
                </tr>
            </table>
            <br>
            
            <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Encargado</strong></td>
                </tr>
                <tr>
                    <td><input type="text" name="txtEncargado" id="txtEncargado" style="width:95%;" value="<?php echo $entrada_ajuste['Usuario']." ". $entrada_ajuste['Apellidos']; ?>" class="form-control" readonly="" /></td>
                    
               
                </tr>
                    
            </table>
            
            
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
            <?php
                $detalleE = array();
                $objDetalleEntrada = new DetalleEntrada();
                $detalleE = $objDetalleEntrada->ConsultarEDParaInterfazAjuste($ID);
                
                foreach($detalleE as $entrada)
                {
                    
                    $fila='<tr>'.
                    '<td style="width:2%; font-size: 9px; text-align:center;"></td>'.
                    '<td style="width:28%;"><input value="'.$entrada['Insumo'].': '.$entrada['Presentacion'].'" type="text" class="form-control" id="txtDescripcion'.$entrada['IdDetalle'].'" name="txtDescripcion'.$entrada['IdDetalle'].'" readonly="" /></td>'.
                    '<td style="width:10%;"><input value="'.$entrada['Cantidad'].'" type="text" readonly="" class="form-control"  id="txtCantidad'.$entrada['IdDetalle'].'" name="txtCantidad'.$entrada['IdDetalle'].'"    /></td>'.
                    '<td style="width:11.5%;"><input value="'.$entrada['Costo'].'" type="text" readonly="" class="form-control" id="txtCosto'.$entrada['IdDetalle'].'" name="txtCosto'.$entrada['IdDetalle'].'"   /></td>'.
                     
                            
                    '<td style="width:11.5%;"><input value="'.$entrada['Importe'].'" type="text" class="form-control" id="txtImporte'.$entrada['IdDetalle'].'" name="txtImporte'.$entrada['IdDetalle'].'" readonly="" /></td>'.
                    '<td style="width:15%;"><input value="'.$entrada['Almacen'].'" class="form-control" readonly="" name="txtAlmacen" id="txtAlmacen'.$entrada['IdDetalle'].'"></td>'.         
                    '<td style="width:15%;"><input value="'.$entrada['Concepto'].'" class="form-control" readonly="" id="txtConcepto'.$entrada['IdDetalle'].'" name="txtConcepto'.$entrada['IdDetalle'].'"></td>';
                    echo $fila;
                }
                
                
            ?>
        </table>
   
</div></div>

        <br>
        <div id="divTotal" class="table-responsive">
        <table border="0" id="TablaTotal">
            <tr>
                <td style='width:70%;'>&nbsp;</td>
                <td style='width:15%'><center>COSTO TOTAL</center></td>
                <?php
                    $objEntradasAjustes->ConsultarPorIdEntrada($ID);
                ?>
                <td style='width:15%'><input id='txtCostoTotal' name='txtCostoTotal' class='form-control' readonly='' value="<?php $objEntradasAjustes->CostoTotal; ?>"/></td>
            </tr>

        </table>
    </div>     
        
    
  

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


