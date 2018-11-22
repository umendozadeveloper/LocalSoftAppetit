          <?php
          include_once './Clases/Insumo.php';
          include_once './Clases/Clasificador.php';
          include_once './Clases/UnidadMedidaInsumos.php';
          include_once './Clases/UMContent.php';
          require_once './Clases/Ubicacion.php';
            if(isset($_GET['IdInsumo'])){
            
//                if(isset($_POST['btnMesa'])&& $_POST['btnMesa'])    
//                {
//                    $ID= $_REQUEST['btnMesa'];
//                }
//                else
//                {
//                    
//                    if(!empty($_SESSION['msjEditarMesas'])){
//                        
//                        echo "<script>swal('".$_SESSION['msjEditarMesas'][0]."');</script>";
//                        $_SESSION['msjEditarMesas']="";
//                            }
                    
                    $ID= $_GET['IdInsumo'];
//                }
                $objInsumo = new Insumo();
                $objInsumo->ConsultarPorID($ID); 
                
                
            }
            else{
                header("Location: F_A_Consultar_Insumos.php");
            }
          require 'Header.php';
          
          
          ?>                
        <script src="js/fijo.js"></script>        
        <title>Editar insumo</title>

        <form action="Validaciones_Lado_Servidor/Validar_EditarInsumo.php" method="POST" enctype="multipart/form-data">
                
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar insumo</label></center></h4></div>
            </td>
        </table>
        </div>
                        
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
    <table border='0'>
      <tr>
        <td> <input type="text" style="color: black;" class="ocultar" name="txtID" value="<?php echo $objInsumo->ID;?>"></td>
    </tr>
    <tr>
        <td colspan="1"><div class="etiquetas2">Descripción</div></td>
       <?php
            if(!isset($_SESSION['valDescripcion']) && (empty($_SESSION['valDescripcion'])))
            {
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='1' id='txtDescripcion' name='txtDescripcion'>$objInsumo->Descripcion</textarea></div></td>";
            }
            else{
                $valor = $_SESSION['valDescripcion'];
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='1' id='txtDescripcion' name='txtDescripcion'>$value</textarea></div></td>";
                $_SESSION['valDescripcion']=null;
            }
            ?> 
    </tr>   
    <tr>
        <td width="20%"><div class="etiquetas2">Presentación</div></td>
        <?php
        if(!isset($_SESSION['valPresentacion']) && (empty($_SESSION['valPresentacion'])))
        {
            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtPresentacion'  name='txtPresentacion' value='$objInsumo->Presentacion'   class='form-control' value=''></div></td>";
        }
        else{
            $valor = $_SESSION['valPresentacion'];
            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtPresentacion'  name='txtPresentacion'    class='form-control' value='$valor'></div></td>";
            $_SESSION['valPresentacion']=null;
        }
        ?>   
    </tr> 
    
    <tr>
      <td width="20%"><div class="etiquetas2">Unidad de medida</div></td>
      <td><div class='campos'><select id="cmbUnidadMedida" class="form-control" name="cmbUnidadMedida">
            <?php
                $objUnidad = new UnidadMedidaInsumo();
                $unidades = $objUnidad->ConsultarTodo();
                foreach ($unidades as $u) {
                    if (isset($_SESSION['valId_Unidad']) && !empty($_SESSION['valId_Unidad'])) {
                        $dato = $_SESSION['valId_Unidad'];
                        if ($u->ID == $dato) {
                            echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                        } else {
                            echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                        }
                    } else {
                        if($u->ID == $objInsumo->IdUnidadMedida)
                        {
                             echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                        }
                        else{
                            echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                        }
                       

                    }
                }
            $_SESSION['valId_Unidad'] = null;
            ?>
              </select>
          </div>
    </tr>
    <tr><td><div class="etiquetas2">Contenido</div></td><td><div class="etiquetas2">Unidad</div></td></tr>
   <tr>        
            <?php
        if(!isset($_SESSION['valContenido']) && (empty($_SESSION['valContenido'])))
        {
            echo "<td style='width:40%;'><input type='text' id='txtContenido'  name='txtContenido'  class='form-control' value='$objInsumo->Contenido'></td>";
        }
        else{
            $valor = $_SESSION['valContenido'];
            echo "<td style='width:40%;'><input type='text' id='txtContenido'  name='txtContenido'    class='form-control' value='$valor'></td>";
            $_SESSION['valContenido']=null;
        }
        ?>   
        <td style="width:60%;"><select class='form-control' name="cmbUMContenido" id="cmbUMContenido">
            <?php
                $objUMC = new UMContent();
                $UMC = $objUMC->ConsultarTodo();
                foreach ($UMC as $u) {
                    if (isset($_SESSION['valUMContent']) && !empty($_SESSION['valUMContent'])) {
                        $dato = $_SESSION['valUMContent'];
                        if ($u->ID == $dato) {
                            echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                        } else {
                            echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                        }
                    } else {
                        if($objInsumo->IdUMContent == $u->ID){
                            echo "<option value ='" . $u->ID . "' selected>" . $u->Descripcion . "</option>";
                        }else{
                            echo "<option value ='" . $u->ID . "'>" . $u->Descripcion . "</option>";
                        }
                        
                        
                    }
                }
                $_SESSION['valUMContent'] = null;
            ?>
                    </select></td>
    </tr>
     <tr>
        <td ><div class="etiquetas2">Clasificador</div></td>
        <td><div class='campos'><select id="cmbClasificacion" class="form-control" name="cmbClasificacion">
                    
        <?php
            $objClasificador = new Clasificador();
            $clasificadores = $objClasificador->ConsultarTodo();
            foreach ($clasificadores as $clasif) {
                if (isset($_SESSION['valId_Clasif']) && !empty($_SESSION['valId_Clasif'])) {
                    $dato = $_SESSION['valId_Clasif'];
                    if ($clasif->ID == $dato) {
                        echo "<option value ='" . $clasif->ID . "' selected>" . $clasif->Descripcion . "</option>";
                    } else {
                        echo "<option value ='" . $clasif->ID . "'>" . $clasif->Descripcion . "</option>";
                    }
                } else {
                    if($objInsumo->IdClasificador == $clasif->ID)
                    {
                        echo "<option value ='" . $clasif->ID . "' selected>" . $clasif->Descripcion . "</option>";
                    }
                    else{
                        echo "<option value ='" . $clasif->ID . "'>" . $clasif->Descripcion . "</option>";
                    }
                }
            }
            $_SESSION['valId_Clasif'] = null;
        ?>     
    </tr>        
    </table>


</div>
                    
                    
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
    <table>
                           
                      

         <tr>
            <td ><div class="etiquetas2">Stock mínimo</div></td>
            <?php
                if(!isset($_SESSION['valMinimo']) && (empty($_SESSION['valMinimo'])))
                {
                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtMinimo'  name='txtMinimo'    class='form-control' value='$objInsumo->StockMinimo'></div></td>";
                }
                else{
                    $valor = $_SESSION['valMinimo'];
                    echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtMinimo'  name='txtMinimo'    class='form-control' value='$valor'></div></td>";
                    $_SESSION['valMinimo']=null;
                }
            ?>
        </tr>
       <tr>
        <td ><div class="etiquetas2">Stock máximo</div></td>
        <?php
            if(!isset($_SESSION['valMaximo']) && (empty($_SESSION['valMaximo'])))
            {
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtMaximo'  name='txtMaximo'    class='form-control' value='$objInsumo->StockMaximo'></div></td>";
            }
            else{
                $valor = $_SESSION['valMaximo'];
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><input type='text' id='txtMaximo'  name='txtMaximo'    class='form-control' value='$valor'></div></td>";
                $_SESSION['valMaximo']=null;
            }
        ?>
    </tr>              
            
        
    <tr>
        <td><div class="etiquetas2">Ubicación</div></td>
        <td><div class='campos'><select id="cmbUbicacion" class="form-control" name="cmbUbicacion">
         <?php
            $objUbicacion = new Ubicacion();
            $ubicaciones = $objUbicacion->ConsultarTodo();
            foreach ($ubicaciones as $e) {
                if (isset($_SESSION['valId_Ubicacion']) && !empty($_SESSION['valId_Ubicacion'])) {
                    $dato = $_SESSION['valId_Ubicacion'];
                    if ($e->ID == $dato) {
                        echo "<option value ='" . $e->ID . "' selected>" . $e->Descripcion . "</option>";
                    } else {
                        echo "<option value ='" . $e->ID . "'>" . $e->Descripcion . "</option>";
                    }
                } else {
                    if($objInsumo->IdUbicacion == $e->ID)
                    {
                        echo "<option value ='" . $e->ID . "' selected>" . $e->Descripcion . "</option>";
                    }else{
                        echo "<option value ='" . $e->ID . "'>" . $e->Descripcion . "</option>";
                    }   
                    
                }
            }
            $_SESSION['valId_Ubicacion'] = null;
        ?>     
    </tr> 
      <tr>
        <td ><div class="etiquetas2">Observaciones</div></td>
    <?php
        if(!isset($_SESSION['valObservac']) && (empty($_SESSION['valObservac'])))
            {

            echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='3' id='txtObservaciones' name='txtObservaciones'>$objInsumo->Observaciones</textarea></div></td>";
            }
            else{
                $valor = $_SESSION['valObservac'];
                echo "<td><div class='campos col-xs-12 col-sm-12 col-md-12 col-lg-12 input-group'><textarea class='claseTextArea' rows='3' id='txtObservaciones' name='txtObservaciones'>$valor</textarea></div></td>";
                $_SESSION['valObservac']=null;
            }
        ?>
    </tr>
    <tr>
        <td><div class="etiquetas2">Estatus</div></td>
        <td><div class='campos'><select id="cmbEstatus" class="form-control" name="cmbEstatus">
            <?php
            if (isset($_SESSION['valStatus']) && !empty($_SESSION['valStatus'])) {
                if ($_SESSION['valStatus']=='0')
                {
                    echo "<option value='1'>Activo</option>
                          <option value='0' selected>Inactivo</option>";
                }else{
                    echo "<option value='1' selected>Activo</option>
                          <option value='0'>Inactivo</option>";
                }
            }
            else{
                if($objInsumo->Status =='0')
                {
                    echo "<option value='1'>Activo</option>
                          <option value='0' selected>Inactivo</option>";
                }
                else{
                     echo "<option value='1' selected>Activo</option>
                          <option value='0'>Inactivo</option>";
                }
                
                 $_SESSION['valStatus']=null;
            }
        ?>
                   
                    
        </select>
        </div></td>
        
    </tr>                    
              

    </table>
</div>
         
      
                
                       
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <br><br>
                
            <button type="submit" id="btnAceptar" style="float: right" name="btnModificar" class="btn btn-Bixa btn-ms" >Guardar</button>
            <a class="btn btn-Regresar"  href="F_A_Consultar_Insumos.php">
                  &larr; Ver listado de insumos
                </a>
            <br>
            <br>
        </div>
                
        </div>
        
            </form>            
        
    </body>
</html>
