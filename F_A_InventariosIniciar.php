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
  include_once './Clases/Clasificador.php';
  
?> 
    <title>Iniciar proceso inventario</title>
    
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">   

          
            
<form action="Validaciones_Lado_Servidor/Validar_Agregar_Inicio_Inventario.php" method="POST" enctype="multipart/form-data" id="form">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Iniciar proceso de inventario</label></center></h4></div>
            </td>
        </table>
    </div>
            
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
            <table border="0" style="text-align: center;" >
                <tr>
                    <!--<td><button type="button" class="textoOpcionesMenuFacturacion"><span class="glyphicon" style="font-size:22px; color:#0000CD;"></span>Folio: 100</button></td>-->
                    <td>Fecha: </td>
                    <td></td>
                    <td><div align="left"><input class="form-control" type="text" name="txtFecha" id="txtFecha" readonly="" value="<?php echo date('d/m/Y'); ?>" style="width:117px; text-align: center;"/></div></td>
               
                
                <td><button type="button" name="btnTodos"  id="btnTodos" class="textoOpcionesMenuFacturacion" onclick=""><span class="glyphicon glyphicon-search" style="font-size:22px; color:#FAB821;"></span> Todos</button></td>
                <td><button type="button" name="btnMostrarModalFiltro" id="btnMostrarModalFiltro" class="textoOpcionesMenuFacturacion" onclick=""  data-toggle="modal" data-target="#ModalFiltros"><span class="glyphicon glyphicon-filter" style="font-size:22px; color:#1E90FF;"></span> Filtrar</button></td>
                 <td><button type="button" name="btnConExistencia" id="btnConExistencia" class="textoOpcionesMenuFacturacion" onclick=""><span class="glyphicon glyphicon-search" style="font-size:22px; color:#008080;"></span> Activos</button></td>
                <td><button type="submit" name="btnGuardar" id="btnGuardar" class="textoOpcionesMenuFacturacion" onclick=""><span class="glyphicon glyphicon-floppy-disk" style="font-size:22px; color:#4B0082;"></span> Guardar</button></td>
                </tr>
            </table>
         
     </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <div  class="table-responsive Comandas" style="float: left">
            
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
                    
            </table>
            <table border='0'>
                
                    
                    <td><input class="ocultar" type="text" name="txtIdsCargados" id="txtIdsCargados" value="-99999" /></td>
                </tr>
                    
            </table>
        </div>
        
        <br>
        
        <div class="table-responsive">
            <table border='0' style="width:100%;"class='tableEncabezadoFijo' >

                    <thead>
        <!--                <tr><th colspan="4"class='EncabezadoTablaPersonalizada'><center>INSUMOS</center></th></tr>-->
                    <tr>
                        <th style="width:2%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>
                        <th style="width:16%;" class='EncabezadoTablaPersonalizada'><center>Descripción</center></th>
                        <th style="width:16%;" class='EncabezadoTablaPersonalizada'><center>Presentación</center></th>
                        <th style="width:16%;" class='EncabezadoTablaPersonalizada'><center>Unidad M</center></th>
                        <th style="width:16%;" class='EncabezadoTablaPersonalizada'><center>Contenido</center></th>
                        <th style="width:16%;" class='EncabezadoTablaPersonalizada'><center>Clasificador</center></th>
<!--                        <th style="width:16%;" class='EncabezadoTablaPersonalizada'><center>Almacén</center></th>-->
                        <th style="width:2%;" class='EncabezadoTablaPersonalizada '>&nbsp;</th>

                    </tr>
            </thead>
            </table>

<!--	</thead>-->

            <div style="overflow-y: scroll; height:auto; max-height:176px;">
                <table border='0' style="width:100%;" id='tabla_insumos_inicio' name='tabla_insumos_inicio' class="tableEncabezadoFijo" >

                    </table>

            </div>
        </div>
 
        <!--*****************************************ventana modal-->
       <div id="ModalFiltros" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <h4 class="modal-title">Filtro de insumos</h4>
                        </div>
                        <div class="modal-body">
                            <div id="" class="table-responsive">

                                <table class='table'>
                                    <tr>
                                        <td style='width:40%;'>Almacén</td>
                                        <td style='width:60%;'><select class='form-control' id='cmbAlmacen' name='cmbAlmacen'>
                                            <?php
                                                $objAlmacen = new Almacen();
                                                $todos_almacenes = $objAlmacen->ConsultarTodo();
                                                echo "<option value='-1'>Seleccionar...</option>";
                                                foreach($todos_almacenes as $almacen)
                                                {
                                                    echo "<option value='".$almacen->ID."'>".$almacen->Descripcion."</option>";
                                                }
                                            ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Clasificador</td>
                                        <td><select class='form-control' name='cmbClasificador' id='cmbClasificador'>
                                            <?php
                                                $objClasificador = new Clasificador();
                                                $todos_clasificadores = $objClasificador->ConsultarTodo();
                                                echo "<option value='-1'>Seleccionar...</option>";
                                                foreach($todos_clasificadores as $clasif)
                                                {
                                                    echo "<option value='".$clasif->ID."'>".$clasif->Descripcion."</option>";
                                                }
                                            ?>
                                            </select></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Descripción</td>
                                        <td><input class='form-control' name='txtDescripcion' id='txtDescripcion'></td>
                                    </tr>
<!--                                    <tr>
                                        <td>Unidad de medida</td>
                                        <td><select class='form-control' name='cmbUnidadMedida' id='cmbUnidadMedida'>
                                            <?php
//                                                $objUM = new UnidadMedidaInsumo();
//                                                $todas_unidades = $objUM->ConsultarTodo();
//                                                echo "<option value='-1'>Seleccionar...</option>";
//                                                foreach($todas_unidades as $unidad)
//                                                {
//                                                    echo "<option value='".$unidad->ID."'>".$unidad->Descripcion."</option>";
//                                                }
                                            ?>
                                            </select></td>
                                    </tr>-->
                                </table>

                            </div>
                          
<!--                            <input type="text" id="txtIdElegido" name="txtIdElegido" class="ocultar" >-->

                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-Bixa" data-dismiss="modal" name="btnFiltrar" id="btnFiltrar"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                            
                        </div>
                    </div>
                </div>
            </div>

    
    
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
//        $('#TablaInsumos').DataTable();
//        
       
       
    });
    
    
   $("button[name='btnTodos']").click(function() {
       
       var id_boton = "btnTodos";
       
//         
//           var id_insumo = $("input[name='Insumo']:checked").val();
//           if(id_insumo === undefined){
//               id_insumo = "0";
//           }

        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Mostrar_Insumos_InvInicio.php",
            type: 'POST',
            data: {"id_boton": id_boton},
            success: function(data){
                if(data=='NO')
                {
                    swal("¡Lo sentimos!", "No se encontraron resultados");
                }else{
                    var separa_data= data.split("├");
//                        
                    $("#txtIdsCargados").val(separa_data[1]);  
                    $("#tabla_insumos_inicio").html(separa_data[0]);
                }
                
               
            }
        });

    }); 


     $("button[name='btnConExistencia']").click(function() {
       
       var id_boton = "btnConExistencia";
       
//         
//           var id_insumo = $("input[name='Insumo']:checked").val();
//           if(id_insumo === undefined){
//               id_insumo = "0";
//           }

        $.ajax({
            url: "Validaciones_Lado_Servidor/N_Mostrar_Insumos_InvInicio.php",
            type: 'POST',
            data: {"id_boton": id_boton},
            success: function(data){
               if(data=='NO')
                    {
                       swal("¡Lo sentimos!", "No se encontraron resultados");
                    }else{
                        var separa_data= data.split("├");
//                        
                        $("#txtIdsCargados").val(separa_data[1]);  
                        $("#tabla_insumos_inicio").html(separa_data[0]);
                    }
            }
        });

    }); 
    
    
    $("button[name='btnFiltrar']").click(function() {
       
       var id_boton = "btnFiltrar";
       var almacen = document.getElementById("cmbAlmacen").value;
       var clasificador = document.getElementById("cmbClasificador").value;
       var descripcion = document.getElementById("txtDescripcion").value;
        
       if(descripcion === ""){
               descripcion = "-1";
       }

        if(almacen==-1 && clasificador==-1 && descripcion==-1){
            swal("¡Atención!", "No ha seleccionado ningún filtro.");
        }else{
            
            $.ajax({
                url: "Validaciones_Lado_Servidor/N_Mostrar_Insumos_InvInicio.php",
                type: 'POST',
                data: {"id_boton": id_boton,
                       "almacen": almacen,
                       "clasificador": clasificador,
                       "descripcion": descripcion
                      },
                success: function(data){
                    
                    if(data==0)
                    {
                        swal("¡Lo sentimos!", "No se encontraron resultados");
                    }else{
                        
                            var separa_data= data.split("├");
//                        
                            $("#txtIdsCargados").val(separa_data[1]);  
                            $("#tabla_insumos_inicio").html(separa_data[0]);
                                                
                    }
                   
                    
                }
            });
    //

        }
    });
 
</script>

   
    

                      
</form>        
    
    </body>  
</html>
