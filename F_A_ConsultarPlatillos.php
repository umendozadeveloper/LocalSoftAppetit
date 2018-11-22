
        <?php
        require 'Header.php';
        ?>
        
        
        <title>Consultar alimentos</title>

        <?php
        include_once  './Clases/Platillo.php';
        include_once  './Clases/SubMenu.php';
        include_once  './Clases/Sommelier.php';
        
        ?>
            
            <form action="F_A_EditarPlatillo.php" method="GET">
                
                        <div class="Tabla col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de alimentos</label></center></h4></div>
            </td>
        </table>
        
                            
                    <table  class="tablesorter table-bordered table-responsive tablaPaginado tablaConsulta" cellspacing="0" width="100%" >
                    <thead style="margin-bottom: 10px;">
		
        <tr>
            <th style="width:20%;"><div class="centrar"><label>Nombre de platillo</label></div></th>
                                <th><div class="centrar"><label>Foto</label></div></th>
                                <th><div class="centrar"><label>Ícono</label></div></th>
                                
                                <th class="ocultar"></th>
                                <th class="ocultar"></th>
                                <th><div class="centrar"><label>Visible</label></div></th>
                                <th><div class="centrar"><label>Sommelier</label></div></th>
                                <th><div class="centrar"><label>Menús</label></div></th>
                                <th><div class="centrar"><label>Opciones</label></div></th>
                                
            
        </tr>
    </thead>
    <tbody>
        

        
        <?php
                
                $objPlatillo = new Platillo();
                $objSommelier = new Sommelier();
                $objSubMenu = new SubMenu();
                $platillos = $objPlatillo->ConsultarTodo();
                $color = "white";
                
                
                foreach ($platillos as $p){
                        $smVino = $objSommelier->ConsultarPorIdPlatillo($p->ID);
                        $subMenu_P = $objSubMenu->ConsultarPorIDPlatillo($p->ID);
                        echo "<tr>";
                        
                        echo "<td>"
                       . "<button value='$p->ID'"
                       . " name='IdPlatillo' type='submit' class='noboton editarPlatilloCuerpo' data-placement='right' data-toggle='tooltip' title='Editar datos'>"
                       . " $p->Nombre</button></td>";
                        echo "<td><div class='imagenesTabla'><img class='' src='$p->Foto'></div></td>";
                        echo "<td><div class='imagenesTabla'><img class='' src='$p->Icono'></div></td>";
                        
                        echo "<td class='ocultar'>$p->DescripcionCorta</td>";
                        echo "<td class='ocultar'>$p->DescripcionLarga</td>";
                        
                        if($p->Visible==1)
                        {
                            echo "<td><center><input class='myCheck' id='check$p->ID' onchange='cambioVisible($p->ID);'  type='checkbox' name='myCheckName' value='$p->Visible'  checked></td>";
                        }
                        else{
                            echo "<td><center><input class='myCheck' id='check$p->ID' onchange='cambioVisible($p->ID);'  type='checkbox' name='myCheckName' value='$p->Visible'  ></td>";
                            //echo "<td><input class='myCheck  id='check$s->ID' onchange='cambioVisible($s->ID);'  type='checkbox' name='myCheckName' value='0'></td>";
                        }
                        
                        
                        /*Imprimimos el listado de vinos pertenecientes a cada platillo*/
                        echo "<td>";
                        foreach ($smVino as $s){
                            echo "• $s->NombreVino<br>";
                        }
                        echo "</td>";
                        
                        /*Imprimimos el listado de menús en que se encuentra cada platillo*/
                        echo "<td>";
                        foreach ($subMenu_P as $sub){
                            echo "• $sub->Clave<br>";
                        }
                        echo "</td>";
                        
                        echo "<td>";
                        echo "<button class='btn btn-Bixa' value='$p->ID' "
                       . " name='IdPlatillo' data-toggle='tooltip' data-placement='left' title='Editar datos'><span class='glyphicon glyphicon-edit'></span>"
                       . "</button>";
                         echo "<button class='btn btn-Bixa' type='button' value='$p->ID' onclick='eliminarPlatillo($p->ID);' name='btnClasificador' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                        
                        echo "<a class='btn btn-Bixa' href='F_A_DetalleAlimento.php?IdPlatillo=$p->ID' "
                       . "  data-toggle='tooltip' data-placement='left' title='Editar datos'><span class='glyphicon glyphicon-search'></span></a>";
                        echo "</td>";
                        
                        echo "</tr>";
                }
                
?>
        
        
    </tbody>
        </table>
                            
                            <br>
                <br>
                <a class="btn btn-Bixa" style="float: right"  href="F_A_RegistrarPlatillo.php">
                        Agregar otro alimento
                </a>
                <a class="btn btn-Regresar"  href="F_A_PaginaPrincipal.php">
                      &larr;  Menú Principal
                </a>
                <br>
                <br>
           </div>
                
                
                
                
                
                
        </form>        
                
        
    </body>
    <form method="POST" action="./Validaciones_Lado_Servidor/N_EliminarElementoCatalogo.php" id="formDelete" >
            <input type="text" id="txtID" name="txtID" class="ocultar">
            <input type="text" id="IDCatalogo" name="IDCatalogo" class="ocultar">
        </form>  
    <script>
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
           data:{"ID":ID,"Visible":Visible,"Tipo":"Alimentos"},
           success: function (data) {
                        console.log(data);
           }
        });   
    }
        
        $(document).on("ready",function (){
            
        /*$(".myCheck").bootstrapSwitch({});
            var pruebaRadio = document.getElementById("pruebaRadio");
            pruebaRadio.bootstrapSwitch();*/
        });
        
        $('.myCheck').each(function(){
            $('.myCheck').bootstrapSwitch();
        })
        
                    
        
    </script>
    <script>
        function eliminarPlatillo(ID){
          
            $("#txtID").val(ID);
            $("#IDCatalogo").val("11");
            swal({  
                title: "¿Desea eliminar el platillo?",
                text: "", 
                type: "warning",  
                showCancelButton: true, 
                confirmButtonText: "Si",   
                cancelButtonText: "No", 
                closeOnConfirm: false, 
                closeOnCancel: true
            },
            function(isConfirm){ 
                if (isConfirm) {
                    $("#formDelete").submit();
                }
            });
        }
        </script>
</html>
