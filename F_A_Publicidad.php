<?php 
require_once 'Header.php';
include_once './Clases/Publicidad.php';
include_once './Clases/Banner.php';
$objPublicidad = new Publicidad();
$objBanner = new Banner();
$banner = $objBanner->Consultar();


$publicidad = $objPublicidad->Consultar();
$publicidadVisible = $objPublicidad->ConsultarVisibles();
ShowMessage();
?>

<title>Publicidad</title>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Publicidad</label></center></h4></div>
            </td>
        </table>
</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-2 col-lg-8">
    <form action="Validaciones_Lado_Servidor/N_EditarPublicidad.php" method="POST">
        <table  class="tablesorter table-hover table-bordered tablaConsulta table-responsive tablaPaginado" cellspacing="0" width="100%">
        <thead>
        <th colspan="5" style="width: 20%;"><div class="centrar"><label>IMAGENES PARA PUBLICIDAD</label></div></th>
                            
                            
                            
                            <tr>
                                <th style="width: 20%;"><div class="centrar"><label>Nombre</label></div></th>
                            <th style="width: 50%;"><div class="centrar"><label>Imagen</label></div></th>
                                <th style="width: 5%;"><div class="centrar"><label>Mostrar</label></div></th>
                            </tr>
                            </div>
        </thead>                        
                        <?php
                        foreach ($publicidad as $p){
                            echo "<tr>";
                            echo "<td><center>$p->Nombre"
                                    . "<button type='button' name='btnEliminar' class='btn btn-default' style='float:right;' data-toggle='tooltip' title='Eliminar' value='$p->ID'><span class='glyphicon glyphicon-trash'></span></button>"
                                    . "<a class='btn btn-default' style='float:right;' href='F_A_EditarPublicidad.php?Id_Publicidad=$p->ID' data-toggle='tooltip' title='Editar datos'><span class='glyphicon glyphicon-edit'></span></a></td>";
                            echo "<td><center><img src='$p->Imagen' style='width:75%; height:50px;' class=''></center></td>";
                            if($p->Visible == 1)
                            {
                                echo "<td><center><input class='myCheck' type='checkbox' name='check$p->ID' checked></center></td>";
                            }
                            else{
                                echo "<td><center><input class='myCheck' type='checkbox' name='check$p->ID'></center></td>";
                            }
                            echo "</tr>";
                        }

                            ?>
                        </table>
        
        
        

    
        <br>
        <br>
        <button class="btn btn-Bixa" style="float: left;">Guardar edición</button>
        <a href="F_A_AgregarPublicidad.php" class="btn btn-Bixa" style="float: right;">Agregar otra imagen</a>
        <br>
        <br>
        
        </form>            
</div>
    
    <form action="Validaciones_Lado_Servidor/N_EliminarPublicidad.php" method="POST" id="formPublicidad" >
        <input type="text" value="" id="txtId_Publcidad" name="txtId_Publcidad" class="ocultar">
    </form>


<script>
    $(document).ready(function (){
       
       $(".myCheck").bootstrapSwitch({
                
        });
       
       
      
        $("button[name=btnEliminar]").click(function (){
            
            var Id_Publicidad = $(this).val();
            $("#txtId_Publcidad").val(Id_Publicidad);
                   swal({   
		title: '¿Desea eliminar la imagen para publicidad?',   
		text: '',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            function(isConfirm){   
                    
			if (isConfirm) {   
                            
                                $("#formPublicidad").submit();

                                    }
                                    else{
                                        swal('Operación cancelada', 
					'', 
				'error');   
                                    }            
            });
       });
       
    });
</script>

 
</body>
</html>
