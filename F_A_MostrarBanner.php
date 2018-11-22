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


<script>
    
    $(document).ready(function (){
    
    $("#btnPublicidad").click(function (){
       var Visible = $("#cmbMostrarPublicidad").val(); 
       $.ajax({
          url: "Validaciones_Lado_Servidor/N_ActivarPublicidad.php",
              type: 'POST',
              data: {"visible":Visible}, 
              success: function (data) {
                  swal('Correcto',data,'success');
                  if(Visible==1)
                  {
                    $("#lbPublicidad").html("Mostrar");
                  }
                  else{
                      $("#lbPublicidad").html("Ocultar");
                  }
                }
       });
    });
    
       $("#cmbMostrarPublicidad").change(function (){
           
       });
    
       
    });
</script>




<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-2 col-lg-8">
    
    <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Mostrar/Ocultar Publicidad</label></center></h4></div>
                            </td>
                        </table>
    
    
    <table class="table">
        <tr>
            <td><div class="etiquetas2">¿Mostrar publicidad en el sistema?</div></td>
            
            <td><select id="cmbMostrarPublicidad" class="form-control">
                    <?php 
                            if($banner[0]->Visible)
                            {
                                echo "<option value='1'>Si</option>";
                                echo "<option value='0'>No</option>";
                            }
                            else{
                                
                                echo "<option value='0'>No</option>";
                                echo "<option value='1'>Si</option>";
                            }
                            
                            ?>
                </select></td>
        </tr>
        <tr>
            <td><div class="etiquetas2">Estado actual de la publicidad:  <label id="lbPublicidad" style="color: red;"><?php
            if($banner[0]->Visible)
                echo "Mostrar";
            else{
                echo "Ocultar";
            }?></label></div></td>
            <td><button id="btnPublicidad" class="btn btn-Bixa" style="float: right;">Aceptar</button></td>
        </tr>
    </table>
</div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <br>
    <br>
    <br>
    <div class="carousel slide " id="myCarousel" style="" data-ride="carousel" >
				
				<!--	INDICATORS	-->
				<ol class="carousel-indicators">
                                    
                                        <?php 
                                        $contador = 0;
                                        foreach ($publicidadVisible as $p){
                                            if($contador==0){
                                                echo "<li class='active' data-slide-to='0' data-target='#myCarousel'></li>";
                                            }
                                            else{
                                                echo "<li data-slide-to='$contador' data-target='#myCarousel'></li>";
                                            }
                                            $contador++;
                                        }
                                        ?>
				</ol>

				<!--	SLIDES	-->
				<div class="carousel-inner" role="listbox">
						<?php 
                                                $contador = 0;
                                                foreach ($publicidadVisible as $p)
                                                {
                                                    if($contador == 0){
                                                        echo "<div class='item active' id='slide0' >";
                                                    }
                                                    else{
                                                        echo "<div class='item' id='slide$contador' >";
                                                    }
                                                    
                                                    echo "<img src='$p->Imagen' style='width: 100%; height:100px;' class='img-responsive'>";
                                                    echo "</div>";
                                                    $contador++;
                                                }
            
                                                ?>
				</div>
</div>
        
</div>