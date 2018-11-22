<?php 
include_once 'LlamadoLibrerias.php';
include_once 'Clases/Empresa.php';
include_once 'Clases/Seguridad.php';
$empresa = new Empresa();
$empresa->ObtenerPorID(1);
$seguridad = new Seguridad();

?>
<style>
.intro-header {
    background: url('<?php echo substr($empresa->FondoComensal,3);?>') no-repeat center center;
    background-size: cover;
}
</style>


<div class="intro-header">
<div class="col-lg-12">
    <!--<div style="display: block;"><center><img class="img img-responsive" src="img/PORTADAS JPG/BIXA_portada ALIMENTOS.jpg"></center></div>-->
    <div class="LogoBIXAMenu">
        <!--<img src="img/PORTADAS JPG/BIXA_portada ALIMENTOS.jpg">-->
            </div>
    <div style="width: 100%; height: 30px;"> 
        <div class="" style="background-color: white; opacity: .7; font-size: 20px;">
            <div style="opacity: 1; color: black;">
        <?php echo $empresa->TextoBienvenidaChef;?>
        </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p class="text-center"><a class="btn btn-default btn-lg" style=" background-color: white;" href="VentanaModalParaMenuBixa.php?idComanda=<?php echo $seguridad->CurrentUserID();?>">Iniciar</a></p>
    </div>
    <br>
</div>
</div>
        
    
    
    
    
    
</div>

<!--
<div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        
                        <div style="display: block;"><center><img class="img img-responsive" src="img/PORTADAS JPG/BIXA_portada ALIMENTOS.jpg"></center></div>
                        <hr class="intro-divider">
                        
                        <div style="background-color: transparent; opacity: .7; font-size: 30px;">
                            <textarea class="claseTextArea" rows="10">
                                Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de
                                 texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias 
                                desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la
                                 imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
                            </textarea></div>
                        
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <p class="text-center"><a class="btn btn-default btn-lg" href="VentanaModalParaMenuBixa.php?idComanda=<?php echo $seguridad->CurrentUserID();?>">Iniciar</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

-->