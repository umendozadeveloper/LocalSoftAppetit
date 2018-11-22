<?php
include_once './Clases/Banner.php';
include_once './Clases/Publicidad.php';
$objPublicidad = new Publicidad();
$objBanner = new Banner();
$banner = $objBanner->Consultar();
$publicidadVisible = $objPublicidad->ConsultarVisibles();

if($banner[0]->Visible){
?>



<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <br><br><br><br>
    <br><br><br><br>
    
    
    <div class="navbar-fixed-bottom">
    <div class="carousel slide " id="myCarousel" style="padding-top: 50px;" data-ride="carousel" >
				
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
        
</div></div>

<?php 
}
?>