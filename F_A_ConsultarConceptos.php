        <?php
require 'Header.php';
require_once './Clases/Concepto.php';

        ?>
<title>Consultar concepto</title>
    
        
        <form action="F_A_EditarConcepto.php" method="GET">
        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Listado de conceptos</label></center></h4></div>
            </td>
        </table>
                
                
                
                <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
                    <thead style="margin-bottom: 10px;">
			<tr>
                                <th><div class="centrar"><label>Clave</label></div></th>
                                <th><div class="centrar"><label>Descripción</label></div></th>
                                <th><div class="centrar"><label>Tipo de concepto</label></div></th>
                                <th><div class="centrar"><label>Estatus</label></div></th>
                                <th width="25%"><div class="centrar"><label>Opciones</div></label></th>
            
                
			</tr>
		</thead>
                <tbody>          
                    <?php 
                    $objConcepto = new Concepto();
                    $conceptos = $objConcepto->ConsultarTodo();
                    foreach ($conceptos as $conce){
                    echo "<tr>";
                    
                    echo "<td><center>".$conce->Clave."</center<</td>";
                    echo "<td><center>".$conce->Descripcion."</center></td>";
                    $entrada_salida="";
                    if($conce->ES == '0')#Salida
                    {
                        $entrada_salida =  "Salida";
                    }else if($conce->ES == '1'){#Entrada
                        $entrada_salida = "Entrada";
                    }
                    echo "<td><center>".$entrada_salida."</center></td>";
                    
                    if($conce->Estatus=='0')
                    {
                        $estatus ='Inactivo';
                    }
                    else{
                        $estatus='Activo';
                    }
                     echo "<td><center>".$estatus."</center></td>";
                    echo "<td><center>";
                    if($conce->ID > 2){
                        echo "<button class='btn btn-Bixa'  value='$conce->ID' name='IdConcepto' data-placement='left' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                        echo "<button class='btn btn-Bixa' type='button' onclick='eliminarConcepto($conce->ID);'  value='$conce->ID' name='btnConcepto' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                        }
                    else{
                        echo "<button class='btn btn-Bixa' disabled  value='$conce->ID' name='IdConcepto' data-placement='left' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></button>";
                        echo "<button class='btn btn-Bixa' disabled type='button' onclick='eliminarConcepto($conce->ID);'  value='$conce->ID' name='btnConcepto' data-placement='left' data-toggle='tooltip' title='Eliminar'><span class='glyphicon glyphicon-trash'></span></button>";
                        
                    }
                    echo "<a href='F_A_DetalleConcepto.php?IdConcepto=$conce->ID' class='btn btn-Bixa' data-placement='left' data-toggle='tooltip' title='Ver concepto a detalle'><span class='glyphicon glyphicon-search'></span></a>";
                    
                    echo "</center></td>";
                    echo "</tr>";
                }
                    ?>
                </tbody>
                    </table>
                <br>
                
                
                <a class="btn btn-Bixa" style="float: right;" href="F_A_RegistrarConceptos.php">
                        Agregar otro concepto
                </a>
                <a class="btn btn-Regresar" href="F_A_PaginaPrincipal.php">
                      &larr; Menú Principal
                </a>
                <br>
                <br>
                <br>
           </div>
        </form>    

<form method="POST" action="./Validaciones_Lado_Servidor/N_EliminarElementoCatalogo.php" id="formDelete" >
    <input type="text" id="txtID" name="txtID" class="ocultar">
    <input type="text" id="IDCatalogo" name="IDCatalogo" class="ocultar">
</form>
    </body>
    
    <script>
        function eliminarConcepto(ID){
            $("#txtID").val(ID);
            $("#IDCatalogo").val("6");
            swal({  
                title: "¿Desea eliminar el concepto?",
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

