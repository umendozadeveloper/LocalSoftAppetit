


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php

?>

<html>
    <head>
        <meta charset="UTF-8">
          <?php
         
          require 'Header.php';
          
          
          ?>                
        <script src="js/fijo.js"></script>
        <script src="js/EventosDinamicosUMR.js"></script>
            <title>Editar Comanda</title>
    </head>
    <body style="background-color: white;">

        <?php
        require './PartesHTML/LogoBIXA_Barra.php';
        ?>
        
        
        <?php
        require './Clases/Mesa.php';
            if(isset($_POST['btnMesero'])){
                $idPlatilloEd= $_REQUEST['btnMesero'];
                
                $objPlatillo = new Mesa();
                $resultado = $objPlatillo->ConsultarMesaPorNumeroMesa($idPlatilloEd); 
                $datosP = explode("|", $resultado);
                
            }
            else if(isset ($_POST['btnModificar'])){
                
                require './Validaciones_Lado_Servidor/Validar_EditarMesa.php';
                $idPlatilloEd=$_REQUEST['respaldoDatosP'];
                $objPlatillo = new Mesa();
                $resultado = $objPlatillo->ConsultarMesaPorNumeroMesa($idPlatilloEd);                
                $datosP = explode("|", $resultado);
                
                
            }

            ?>
        
    
            
        
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="TablaDatosPer">
                        <tr>
                            <td colspan="6" scope="col"><h3 class="Subtitulos">EDITAR DATOS DE MESA</h3></td>    
                        </tr>                       
                        
                        
                        
                        
                        <tr>
                            <td> <label></label></td>
                        </tr>
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $datosP[1];?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td colspan="1"><div class="etiquetasDtsPer">Número de Mesa<label style="color: red"></label></div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNumeroMesa" required title="Ingresar Datos" class="form-control" value="<?php echo $datosP[1];?>"></div></td>
                            <td colspan="1"><label style="color: rgb(170,25,39);"WW>s</label></td>
                        </tr>                        
                        <tr>
                            <td> <label></label></td>
                        </tr>
                        
                        
                        <tr>
                            <td colspan="1"><div class="etiquetasDtsPer">Cantidad de Personas<label style="color: red"></label></div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtCantidadPersonas" required title="Ingresar Datos" class="form-control" value="<?php echo $datosP[2];?>"></div></td>
                            <td colspan="1"><label style="color: rgb(170,25,39);">s</label></td>
                        </tr>                        
                        <tr>
                            <td> <label></label></td>
                        </tr>
                        
                        
                        
                        <tr>
                            <td colspan="1"><div class="etiquetasDtsPer">Ubicación<label style="color: red"></label></div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtUbicacion" required title="Ingresar Datos" class="form-control" value="<?php echo $datosP[3];?>"></div></td>
                            <td colspan="1"><label style="color: rgb(170,25,39);">s</label></td>
                        </tr>                        
                        <tr>
                            <td> <label></label></td>
                        </tr>
                        
                        
                        
    
            </table>
            
                    
                    
                    
                        
                    
                    <br><br>
                    <input type="submit" value="Guardar Modificación" class="btn btn-primary" name="btnModificar" style="background-color: rgb(170,25,39); border-color: rgb(170,25,39);" >
                    <a href="ConsultarMesas.php" class="cerrarSesion" style="color: black;">Volver</a>
                    <br>
                    <br>
                </div>
            </form>            
        
    </body>
</html>
