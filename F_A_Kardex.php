          <?php
          require 'Header.php';
          require_once './Clases/Insumo.php';
          ?>        
            <title>Kardex por insumo</title>
            
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">       
            

        <form action="" method="POST" name="form" id="form">
            
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Kardex</label></center></h4></div>
            </td>
        </table>
        </div>
        
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
            <table border="0" style="text-align: center;" >
                <tr>
                    <td style="width:100px;"></td>
                    <td><button type="button" name="btnAgregarInsumo" id="btnAgregarInsumo" class="textoOpcionesMenuFacturacion" onclick="" data-toggle="modal" data-target="#CatalogoInsumos"><span class="glyphicon glyphicon-search" style="font-size:22px; color:#0000CD;"></span> Insumo</button></td>
                    <td><div align="left"><input class="form-control" type="text" name="txtInsumo" id="txtInsumo" style="width:230px; text-align: center;" readonly=""/></div></td>
                    <td><div align="left"><input class="ocultar" type="text" name="txtIdInsumo" id="txtIdInsumo" style="text-align: center;" readonly=""/></div></td>
                    <td><input type="checkbox" name="chckPeriodo" id="chckPeriodo" style="-ms-transform: scale(1.3);-moz-transform: scale(1.3); -webkit-transform: scale(1.3);-o-transform: scale(1.3);">  Periodo de: </td>
                    <td><div align="left"><input class="form-control" type="text" name="txtFechaInicial" id="txtFechaInicial" readonly="" style="width:120px;" value="<?php echo date('d/m/Y'); ?>" style="width: 50%; text-align: center;"/></div></td>
                    <td> a: </td>
                    <td><div align="left"><input class="form-control" type="text" name="txtFechaFinal" id="txtFechaFinal" readonly="" style="width:120px;" value="<?php echo date('d/m/Y'); ?>" style= "text-align: center;"/></div></td>
                    <td><button type="button" name="btnGuardar" id="btnGuardar" class="textoOpcionesMenuFacturacion" onclick=""><span class="glyphicon glyphicon-ok" style="font-size:22px; color:#008080;"></span> Consultar</button></td>
                     <td style="width:100px;"></td>
                </tr>
            </table>
         
     </div>
            
            
            <br><br>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
        <br>
        <table border='1' >
            <thead>
            <tr>
                <th  class='EncabezadoTablaPersonalizada' style='height:40px; '>&nbsp;</th>
                <th  colspan="3" class='EncabezadoTablaPersonalizada'><center>Entradas</center></th>
                <th colspan="3" class='EncabezadoTablaPersonalizada'><center>Salidas</center></th>
                <th  colspan="3" class='EncabezadoTablaPersonalizada'><center>Existencia</center></th>
                <th colspan="3" class='EncabezadoTablaPersonalizada'><center>&nbsp;</center></th>
                
            </tr>
        </thead>
        <thead>
        <th  class='EncabezadoTablaPersonalizada' style='width:7%; height:40px;'><center>Fecha</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color:#ADD8E6; color:black; width:6%;"><center>Cantidad</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color:#ADD8E6; color:black; width:7%;"><center>P.U.</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color:#ADD8E6; color:black; width:7%;"><center>Importe</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color:#FFDAB9; color:black; width:6%; "><center>Cantidad</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color:#FFDAB9; color:black; width:7%;"><center>P.U.</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color:#FFDAB9; color:black; width:7%;"><center>Importe</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color: #C8A2C8; color:black; width:5.5%"><center>Cantidad</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color: #C8A2C8; color:black; width:6.5%"><center>P.U.</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="background-color: #C8A2C8; color:black; width:7%;"><center>Importe</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="width:8%;"><center>Referencia</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="width:8%;"><center>Usuario</center></th>
        <th  class='EncabezadoTablaPersonalizada' style='width:10%;'><center>Fecha Sistema</center></th>
        </thead>
        </table>
        <div name='div_kardex' id='div_kardex' style='overflow-y: scroll; height:auto; max-height:230px;'>
          <table border='0' style="width:100%;"class='tableEncabezadoFijo'  name='tabla_kardex' id='tabla_kardex'>
           
        
            </table>  
            <br><br>
        </div>
    
         
    </div>
            
            
            
        
     <div id="CatalogoInsumos" class="modal fade" role="dialog">
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
                                        <th style="padding-right: 89.5px;">Almacén</th>
                                        <th style="padding-right: 20px;">Selección</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php
               
               $objInsumos = new Insumo();
                $todos_insumos = $objInsumos->Consultar_Almacen_EntradaDetalle_Insumo();
                foreach ($todos_insumos as $ins){
//                    $objAlmacen->ConsultarPorID($ins->IdAl)
                    echo "<tr>"
                    . "<td>".$ins['Descripcion']."</td>"
                    . "<td>".$ins['Presentacion']."</td>"
                    . "<td>".$ins['AlmacenDescripcion']."</td>"
                    . "<td><center><input type='radio' name='Insumo' id='Insumo' value='".$ins['IdInsumo']."'/></center></td></tr>";
                }
                echo "</table>";
            ?>
                                </tbody>
                                
                            </table>
                                
                                

                            </div>
                          
                            <input type="text" id="txtIdElegido" name="txtIdElegido" class="ocultar">
                                 
                           
                            
                                
                           
                            
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-Bixa" data-dismiss="modal" name="btnAgregarInsumo" id="btnAgregarInsumo">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
    </div>   
           
    <script type="text/javascript">
        $(document).ready(function() {
            $('#TablaInsumos').DataTable();
        });

       //Carga el calendario
       $(function(){
           $("#txtFechaInicial").datepicker({
               changeMonth:true,
               changeYear:true,
               showButtonPanel:true,
               maxDate: '+0d',
           });
       })
        $(function(){
           $("#txtFechaFinal").datepicker({
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
        $("#txtFechaInicial").datepicker().hide();
        $("#txtFechaFinal").datepicker().hide();
       });
    
    
        $('#chckPeriodo').change(function() {

            if($(this).is(':checked')) {
        //        alert("checado");
                 $("#txtFechaInicial").datepicker().show();
                 $("#txtFechaFinal").datepicker().show();
            } else {
                $("#txtFechaInicial").datepicker().hide();
                $("#txtFechaFinal").datepicker().hide();

            }
        });
    </script>    
     
    <script>
         $("button[name='btnAgregarInsumo']").click(function() {
            
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
                    var id_insumo = $("input[name='Insumo']:checked").val();
                    $("#txtInsumo").val(insumo);
                    $("#txtIdInsumo").val(id_insumo);
                }
            });
        });
    </script>
          
    <script>
        $("button[name='btnGuardar']").click(function() {
            var IdInsumo = document.getElementById("txtIdInsumo").value;
            var FechaInicial = document.getElementById("txtFechaInicial").value;
            var FechaFinal = document.getElementById("txtFechaFinal").value;
            var todos=0;
            if( $('#chckPeriodo').prop('checked') ) {
                todos= 0;
            }else{
                todos=1;
            }
           
           
            $.ajax({
                url: "Validaciones_Lado_Servidor/N_DibujarTablaKardex.php",
                type: 'POST',
                data: {"IdInsumo": IdInsumo,
                        "FechaInicial": FechaInicial,
                        "FechaFinal": FechaFinal,
                        "todos": todos
                      },
                success: function(data){
                    $("#tabla_kardex").html(data);
                   
                }
            });
         });  
    </script>
            </form>            
            

    </body>
</html>
