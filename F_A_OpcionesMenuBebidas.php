<?php
include_once 'Header.php';
include_once './Clases/SubMenu.php';
$objSubMenu = new SubMenu();
$arreglo = null;
$Tipo = 2;
if(isset($_GET['MenuP'])){
    $Tipo = $_GET['MenuP'];
}
$subMenus = $objSubMenu->ConsultarSubMenuPorIDPadreArreglo($Tipo,$arreglo);

?>
<title>Opciones submenús-bebidas</title>
<input type="text" id="MenuP" value="<?php echo $Tipo;?>" style="visibility:hidden">
<div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
    <div id="tablaOrdenar">
<table class="table table-condensed table-bordered tablaPaginadoPrioridad">
    <thead>
        
        <tr>
            <th colspan="3"><center>Ordenar menús de bebidas</center>
                <a class="btn icon-btn btn-default" style="float: right;" href="#" role="button" data-toggle="modal" data-target="#ModalOrdenar">
                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-info">        
                    </span>
                    Ubicar
                </a>
            </th>
        </tr>
        <tr>
            
            <th>Nombre del menú</th>
            <th width='10%'><center>Visible</center></th>
            <th width='10%'><center>Prioridad</center> </th>
        </tr>
        
    </thead>
    <tbody>
    
        <?php 
        $i = 0;
        
        foreach ($subMenus as $s){
            
                echo "<tr>";
                echo "<td>";
                if(count($objSubMenu->ConsultarSubMenuPorIDPadreTodo($s->ID))>0){
                    echo "<a class='btn btn-xs btn-Bixa botonDesplegar' href='F_A_OpcionesMenuBebidas.php?MenuP=$s->ID'><span class='glyphicon glyphicon-plus'></span></a>   ";
                }
                echo "  $s->Clave";
                echo "</td>";
                
                if($s->Visible==1)
                {
                    echo "<td><center><input class='myCheck' id='check$s->ID' onchange='cambioVisible($s->ID);'  type='checkbox' name='myCheckName' value='$s->Visible'  checked></td>";
                }
                else{
                    echo "<td><center><input class='myCheck' id='check$s->ID' onchange='cambioVisible($s->ID);'  type='checkbox' name='myCheckName' value='$s->Visible'  ></td>";
                    //echo "<td><input class='myCheck  id='check$s->ID' onchange='cambioVisible($s->ID);'  type='checkbox' name='myCheckName' value='0'></td>";
                }
                $s->Prioridad;
//                echo "<td>$s->Prioridad<center>";
                echo "<td><center>";
                if($i!=  count($subMenus)-1)
                echo "<button onclick='cambiarPrioridad(1,$s->ID);' class='btn btn-default btn-xs'><span style='color:red;' class='glyphicon glyphicon-arrow-down'></span></button>";
                if($i!=0)
                echo "<button onclick='cambiarPrioridad(0,$s->ID);' class='btn btn-default btn-xs'><span style='color:green;' class='glyphicon glyphicon-arrow-up'></span></button>";
                echo  "</center></td>";
                echo "</tr>";
                $i++;
            
            
        }
        ?>
    </tbody>
</table>
    </div>
    </div>


<div class="modal fade"   id="ModalOrdenar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- 3 divs básicos  para cada ventana modal -->

						<div class="modal-header">
							<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4>Asignar nueva prioridad</h4>
						</div>
                                            
                                                
                                                <form action="Validaciones_Lado_Servidor/N_CambiarPrioridadMenuPlatillos.php" method="POST">
						<div class="modal-body">
                                                    
                                                    <table class="table table-condensed table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th width="30%">Seleccionar menú a modificar</th>
                                                                <th width="30%">Seleccionar menú destino</th>
                                                                <th width="40%">Ubicar menú:</th>
                                                            </tr>
                                                        </thead>
                                                        
                                                        <tr>
                                                            <td><select class="form-control" id="cmbPrioridad">
                                                        <?php 
                                                        
                                                        foreach ($subMenus as $s){
                                                            
                                                            echo "<option value='$s->ID'>$s->Clave</option>";
                                                        }
                                                        ?>
                                                    </select></td> 
                                                    <td>
                                                        <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-Gris">
                                                                <span class="glyphicon glyphicon-arrow-right"></span>
                                                                </button>
                                                            </span>
                                                            
                                                            <select name="txtID_Destino" class="form-control" id="txtID_Destino">
                                                                <?php 
                                                                foreach ($subMenus as $s){
                                                                    echo "<option value='$s->ID'>$s->Clave</option>";
                                                                }
                                                                
                                                                ?>
                                                            </select>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <select name="txtUbicacion" class="form-control">
                                                                <option value="1">Intercambiar posiciones</option>
                                                                <option value="2">Ubicar antes de destino</option>
                                                                <option value="3">Ubicar después de destino</option>
                                                            </select>
                                                        </td>
                                                    
                                                        
                                                        </tr>    
                                                    <input name="txtID" id="txtID" class="ocultar">
                                                    
                                                    </table>
                                                        
                                                        
                                                        
                                                </div>

						<div class="modal-footer">
                                                    <button style="float: right;" class="btn btn-Bixa">Guardar</button> 
                                                    <button style="float: left;" class="btn btn-Regresar" data-dismiss="modal">Cerrar</button>
						</div>
                                                
                                                </form>
                                                

					</div>
				</div>
			</div>

<input type="text" id='Arreglo' class="ocultar">
<script>
    var Arreglo = new Array();
    var incremento = 0;
    var IdMenuP = $("#MenuP").val();
    
    
    
    function desplegar(ID){
        var Id = ID.toString();
        $.ajax({
           url: "Validaciones_Lado_Servidor/N_TablaPrioridadSubPlatillos.php",
           type: 'POST',
           data:{"ID":ID},
           success: function (data) {
                        
                        $("#tablaOrdenar").html(data);
           }
        });  
        
    }
    
    function desplegarConArreglo(ID){
        var id = ID.toString();
        var bandera= false;
        console.log("Id a introducir/sacar: "+id);    
        if(incremento===0){
         
            //console.log("if");
            Arreglo.push(id);
        }
        else{
            for(var i = 0; i<Arreglo.length; i++){
                if(id==Arreglo[i])
                {
                   bandera=true;
                   Arreglo.splice(i,1);
                   break;
                }
            }
            //console.log("else");
        }
        
        if(!bandera){
            if(incremento!==0)
            {
                Arreglo.push(id);    
            }
        }
        incremento++;
        
        console.log("Elementos en el arreglo");
        for(var i = 0; i<Arreglo.length; i++){
                console.log(Arreglo[i]);    
        }
        
        
        $.ajax({
           url: "Validaciones_Lado_Servidor/N_TablaPrioridadSubPlatillos.php",
           type: 'POST',
           data:{"ID":ID,"Arreglo":Arreglo},
           success: function (data) {
                        console.log(data);
                        $("#tablaOrdenar").html(data);
           }
        });   
    }           

    
    
    /**
     * 
     * @param {int} Accion: Indica si sube o baja la prioridad: 1 - Sube, 0 - Baja
     * @returns {undefined}
     */
    function cambiarPrioridad(Accion,ID){
        
        $.ajax({
           url: "Validaciones_Lado_Servidor/N_TablaPrioridadSubPlatillos.php",
           type: 'POST',
           data:{"ID":ID,"Accion":Accion,"IdMenuP":IdMenuP},
           success: function (data) {
                        console.log(data);
                        $("#tablaOrdenar").html(data);
           }
        });   
    }
    
    function cambioVisible(ID){
        var idCheck ="#check"+ID;
        var Visible = $(idCheck).val();
        
        if(Visible == 1){
            $(idCheck).val(0);
        }else{
            $(idCheck).val(1);
        }
        Visible = $(idCheck).val();
        $.ajax({
           url: "Validaciones_Lado_Servidor/N_EditarVisibilidad.php",
           type: 'POST',
           data:{"ID":ID,"Visible":Visible,"Tipo":"Submenu"},
           success: function (data) {
                        console.log(data);
           }
        });   
    }
    
    $(document).ready(function (){
        
        /*$("[name='my-checkbox']").bootstrapSwitch({
                "size": 'small'
                
        });*/
    
        $(".myCheck").bootstrapSwitch({
                
        });
   
        $('.tablaPaginadoPrioridad').DataTable( {
        "sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
        "order":[[2,"asc"]]
    });
        
        var prioridadPrincipal = $("#cmbPrioridad").val();
            prioridadPrincipal = prioridadPrincipal.split(",");
            var IdP = prioridadPrincipal[0];
            $("#txtPrioridadSeleccionado").val(prioridadPrincipal[1]);
            $("#txtID").val(IdP);
        
       $("#cmbPrioridad").change(function(){
            var prioridad = $(this).val();
            prioridad = prioridad.split(",");
            var id = prioridad[0];
           $("#txtPrioridadSeleccionado").val(prioridad[1]);
           $("#txtID").val(id);
       });
    });
    </script>