      <?php
          include_once './Clases/Inventario.php';
          include_once './Clases/InventarioConteo.php';
          include_once './Clases/InventarioEstados.php';
          include_once './Clases/Seguridad.php';
          include_once './Clases/Usuario.php';
            if(isset($_GET['IdInventario'])){

                $ID= $_GET['IdInventario'];
               
                
            }
            else{
                header("Location: F_A_MostrarInventarios.php");
            }
          require 'Header.php';
          
          
?>               
            <title>Finalizar proceso de inventario</title>
            
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">       
            

        <form action="Validaciones_Lado_Servidor/Validar_FinalizarInventario.php" method="POST" name="form" id="form">
            
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Finalizar proceso de inventario</label></center></h4></div>
            </td>
        </table>
        </div>
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
            <table border="0" style="text-align: center;" >
                <tr>
<!--                    <td style="width:100px;"></td>-->
                   <td style="width:90px;">Fecha: </td>
                    <td></td>
                    <td><div align="left"><input class="form-control" type="text" name="txtFecha" id="txtFecha" readonly="" value="<?php echo date('d/m/Y'); ?>" style="width:122px; text-align: center;"/></div></td>
                    <td><div style="background-color:#D0D0D0; width:120px; "><input type="checkbox" name="chckConFaltante" id="chckConFaltante" onchange="Cargar();" style="-ms-transform: scale(1.3);-moz-transform: scale(1.3); -webkit-transform: scale(1.3);-o-transform: scale(1.3); "> Con faltante</div></td>
                    <td><div style="background-color:#FFF; width:120px; "><input type="checkbox" name="chckSinDiferencia" id="chckSinDiferencia" onchange="Cargar();" style="-ms-transform: scale(1.3);-moz-transform: scale(1.3); -webkit-transform: scale(1.3);-o-transform: scale(1.3); "> Sin diferencia</div></td>
                    <td><div style="background-color:#B7FFFC; width:130px; "><input type="checkbox" name="chckConExcedente" id="chckConExcedente" onchange="Cargar();" style="-ms-transform: scale(1.3);-moz-transform: scale(1.3); -webkit-transform: scale(1.3);-o-transform: scale(1.3); "> Con excedente</div></td>
                    <?php 
                        $objInventario = new Inventario();
                        $objInventario->ConsultarPorID($ID);
                        if($objInventario->IdEstado =='3' || $objInventario->IdEstado =='4' ||$objInventario->IdEstado =='1'){
                           echo '<td align="right"><button type="button" name="btnGuardar" id="btnGuardar" class="textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-check" style="font-size:22px; color:#4B0082;"></span> Finalizar inventario</button></td>';
                        }
                        else{
                            echo '<td align="right"><button type="submit" name="btnGuardar" id="btnGuardar" class="textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-check" style="font-size:22px; color:#4B0082;"></span> Finalizar inventario</button></td>';
                        }
                    ?>
                    
                    <td style="width:100px;"></td>
                </tr>
            </table>
           
     </div>    
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
        <div  class="table-responsive Comandas" style="float: left">
            
            <br>
             <?php 
                
                
                $objEstadoInven = new InventarioEstados();
                $objEstadoInven->ConsultarPorID($objInventario->IdEstado);
                
             ?>
            <table border='0' >
                <tr>
                    <td><div style=" background-color:#FEFCA7; text-align: center;border-top-left-radius: 2em 0.5em;border-top-right-radius: 1em 3em; width: 95%;">Observaciones</div></td>
                </tr>
                <tr>
                    <td><textarea id="txtNotas" name="txtNotas" readonly="readonly" class="form-control" type="text" style="resize: none; background-color:#FEFCA7; width: 95%;"><?php echo $objInventario->Observaciones; ?></textarea></td> 
                </tr>
            </table>
            <br>
            
            <table border='0'>
                <tr>
                    <td><strong style="text-align: center;">Estado</strong></td>
                </tr>
                <tr>
                    
                    <td><input type="text" name="txtEstado" id="txtEstado" style="width:95%; text-align: center;" value="<?php echo $objEstadoInven->Clave;  ?>" class="form-control" readonly="" /></td>
                    <td><input class="ocultar" type="text" name="txtId" id="txtId" value="<?php echo $ID; ?>" /></td>
                </tr>
                    
            </table>

             <table border='0'>
<!--                <tr>
                    <td><strong style="text-align: center;">Encargado</strong></td>
                </tr>-->
                <tr>
                    <?php 
                        $objSeguridad = new Seguridad();
                        $id_cuenta = $objSeguridad->CurrentUserID();
                        $objUsuario = new Usuario();
                        $objUsuario->ConsultarPorID($id_cuenta);
                    ?>
                    <!--<td><input type="text" name="txtEncargado" id="txtEncargado" style="width:95%;" value="<?php echo $objUsuario->Nombre . " ". $objUsuario->Apellidos;?>" class="form-control" readonly="" /></td>-->
                    <td><input class="ocultar" type="text" name="txtIdEncargado" id="txtIdEncargado" value="<?php echo $id_cuenta; ?>" /></td>
                </tr>
                    
            </table>
        </div>       
     
        <br>
        
        <div class="table-responsive">
            <table border='0' style="width:100%;"class='tableEncabezadoFijo' >

                    <thead>
        <!--                <tr><th colspan="4"class='EncabezadoTablaPersonalizada'><center>INSUMOS</center></th></tr>-->
                    <tr>
<!--                        <th style="width:1%;" class='EncabezadoTablaPersonalizada'>&nbsp;</th>-->
                        <th style="width:20%;" class='EncabezadoTablaPersonalizada'><center>Descripción</center></th>
                        <th style="width:12%;" class='EncabezadoTablaPersonalizada'><center>Presentación</center></th>
                        <th style="width:7%;" class='EncabezadoTablaPersonalizada'><center>UM</center></th>
                  
                        <th style="width:12%;" class='EncabezadoTablaPersonalizada'><center>Sistema</center></th>
                        <th style="width:12%;" class='EncabezadoTablaPersonalizada'><center>Físico</center></th>
                        <th style="width:12%;" class='EncabezadoTablaPersonalizada'><center>Costo por unidad</center></th>
                        <th style="width:12%;" class='EncabezadoTablaPersonalizada'><center>Importe diferencia</center></th>
                        <th style="width:2%;" class='EncabezadoTablaPersonalizada '>&nbsp;</th>
                    </tr>
            </thead>
            </table>

            <div style="overflow-y: scroll; height:auto; max-height:176px;">
                <table border='0' style="width:100%;" id='tabla_insumos_inicio' name='tabla_insumos_inicio' class="tableEncabezadoFijo" >
                
                </table>

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
   
        
         $(document).ready(function() {
              document.getElementById("chckConFaltante").checked = true;
              document.getElementById("chckSinDiferencia").checked = true;
              document.getElementById("chckConExcedente").checked = true;
              Cargar();
        });
   
        function Cargar()
        {
            var con_faltante, sin_diferencia, con_excedente;
            var ID = document.getElementById("txtId").value;
            
            if( $('#chckConFaltante').prop('checked') )
                {con_faltante = 1; }
            else
                { con_faltante = 0;}
            
            
            if( $('#chckSinDiferencia').prop('checked') )
                {sin_diferencia = 1;}
            else
                {sin_diferencia = 0;}
            
            if( $('#chckConExcedente').prop('checked') )
                {con_excedente = 1;}
            else
                { con_excedente = 0;}
           
            
             $.ajax({
                url: "Validaciones_Lado_Servidor/N_Cargar_Final_Inventario.php",
                type: 'POST',
                data: {"con_faltante": con_faltante,
                        "sin_diferencia": sin_diferencia,
                        "con_excedente": con_excedente,
                        "ID": ID
                      },
                success: function(data){
                    $("#tabla_insumos_inicio").html(data);
                   
                }
            });
            
            
        }
   
   
    </script>       
    
            </form>            
            

    </body>
</html>
