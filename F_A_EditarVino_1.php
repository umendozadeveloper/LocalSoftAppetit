          <?php
         
          require 'Header.php';
          
          
          ?>                
            <title>Editar Vino</title>
        <?php
          
        
        include_once  './Clases/Vino.php';
        include_once './Clases/Platillo.php';
        include_once './Clases/Maridaje.php';
        include_once './Clases/SubMenu.php';
        include_once './Clases/VinosSubMenu.php';
        ?>
        
        <script>
            $(document).ready(function (){
               
               $("#cmbAnadirFoto").change(function (){
                   
                   var tablaFoto = document.getElementById("tablaFoto");
                    switch($(this).val()){
                        case "Si":
                            tablaFoto.className="mostrar";
                            break;
                            
                        case "No":
                            tablaFoto.className="ocultar";
                            break;
                    }
               });
               
               
               $("#cmbAnadirIco").change(function (){
                   var tablaIco = document.getElementById("tablaIco");
                    switch($(this).val()){
                        case "Si":
                            tablaIco.className="mostrar";
                            break;
                            
                        case "No":
                            tablaIco.className="ocultar";
                            break;
                    }
               });
               
               $("#cmbAnadirSubMenu").change(function (){
                   var tablaSub = document.getElementById("tablaSubMenu");
                    switch($(this).val()){
                        case "Si":
                            tablaSub.className="mostrar";
                            break;
                            
                        case "No":
                            tablaSub.className="ocultar";
                            break;
                    }
               });
               
               $("#cmbAnadirSommelier").change(function (){
                   var tablaSub = document.getElementById("tablaSommelier");
                    switch($(this).val()){
                        case "Si":
                            tablaSub.className="mostrar";
                            break;
                            
                        case "No":
                            tablaSub.className="ocultar";
                            break;
                    }
               });
               
            });
            
            </script>
        
        
        <?php
        
            if(isset($_POST['btnAceptar']) || isset($_GET['IdVino'])){
                if(isset($_POST['btnAceptar'])&& $_POST['btnAceptar']){
                    $idPlatilloEd= $_REQUEST['btnAceptar'];
                }
                else{
                    $idPlatilloEd= $_GET['IdVino'];
                    if(!empty($_SESSION['msjEditarVino'])){       
                        echo "<script>swal('".$_SESSION['msjEditarVino'][0]."');</script>";
                        $_SESSION['msjEditarVino']="";
                            }
                        
                }
                $objPlatillo = new Vino();
                $vino = $objPlatillo->ConsultarPorID($idPlatilloEd);                
                
            }
            else
                header("Location: F_A_ConsultarVinos.php");
            

            ?>
        
        
        <div class="panel-body no-padding-top no-padding-bottom">
                
            <div class="thumbnail no-boxshadow no-margin-bottom col-xs-12 col-ms-12 col-sm-12 col-md-6 col-lg-6">
                <img src="<?php echo $vino[0]->Foto;?>" class="img-rounded img-responsive img-responsive-static">
            </div>
        
            
            <div class="thumbnail  no-margin-bottom col-xs-12 col-ms-12 col-sm-12 col-md-6 col-lg-6">
                <h1 class="editarPlatilloTitulo"><?php echo $vino[0]->Nombre;?></h1>
                <hr >
                <label class="editarPlatilloCuerpo"><?php echo $vino[0]->DescripcionLarga;?></label>
                <br>
                <br><br>
                
                <div class="editarPlatilloPrecio">Botella: <label class="editarPlatilloPrecio"><?php  echo "$".$vino[0]->PrecioBotella;?></label></div>
                <div class="editarPlatilloPrecio">Copa: <label class="editarPlatilloPrecio"><?php  echo "$".$vino[0]->PrecioCopa;?></label></div>
            </div>
        
        </div>
        
            
            
            

        <form action="Validaciones_Lado_Servidor/Validar_EditarVino.php" method="POST" enctype="multipart/form-data">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Editar datos del vino: <?php echo $vino[0]->Nombre?></label></center></h4></div>
            </td>
        </table>
        </div>    

                        
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    <table class="table-hover">
                
                        <tr>
                            <td><div class="etiquetas2">Nombre del vino</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtNombrePlatillo" required title="Ingresar Datos" class="form-control" value="<?php echo $vino[0]->Nombre;?>"></div></td>
                            
                        </tr>                        
                        
                        <tr>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosP" value="<?php echo $vino[0]->ID;?>"></td>
                            <td> <input type="text" style="color: black;" class="ocultar" name="respaldoDatosPNombre" value="<?php echo $vino[0]->Nombre?>"></td>
                        </tr>
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción corta</div></td>
                            <td colspan="4"><textarea class='claseTextArea' rows='3' name='txtDescripcionCorta'><?php echo $vino[0]->DescripcionCorta;?></textarea></td>
                            
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Descripción larga</div></td>
                            <td colspan="4"><textarea class='claseTextArea' rows='5' name='txtDescripcionLarga'><?php echo $vino[0]->DescripcionLarga;?></textarea></td>
                            
                        </tr>                        
                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Precio copa</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtPrecioCopa" required title="Ingresar Datos" class="form-control" value="<?php echo $vino[0]->PrecioCopa;?>"></div></td>
                            
                        </tr>                        
                        
                        
                        <tr>
                            <td><div class="etiquetas2">Precio botella</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtPrecioBotella" required title="Ingresar Datos" class="form-control" value="<?php echo $vino[0]->PrecioBotella;?>"></div></td>
                            
                        </tr>                        
                    </table>
                        </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
                    <table class="table-hover">
                        
                       <td><div class='imagenesTabla'><img class='' src='<?php echo $vino[0]->Icono;?>'></div></td>
                        
                        <tr>
                                <td><div class="etiquetas2">¿Modificar ícono?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirIco" name="cmbIcono"  class="form-control" onchange="mostrarFileIcono();">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                        
                        <tr>
                                <td><div id="tablaIco" class="ocultar"><input type='file' name="archivoIco"></div></td>
                            </tr>                
                        
                        
                        
                        <tr>
                                <td><div class="etiquetas2">¿Modificar foto?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirFoto" name="cmbFoto"  class="form-control" onchange="mostrarFileFoto();">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                        
                        <tr>
                                <td><div id="tablaFoto" class="ocultar"><input type='file' name="archivo"></div></td>
                        </tr>                
                        
                        
                        
                        
                        <tr>
                                <td><div class="etiquetas2">¿Visualizar maridaje?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirSommelier" name="cmbMaridaje"  class="form-control" onchange="mostrarListadoVinoSommelier();">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
                        
                        
                        
                        
                        
                        <tr>
                                <td><div class="etiquetas2">¿Visualizar menús?</div></td>
                                <td colspan="4"><div class="campos"><select id="cmbAnadirSubMenu" name="cmbSubMenus"  class="form-control" onchange="mostrarListadoSubMenu();">
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                        </div></td>
                        </tr>
            </table>
            </div>
                
            
                    
                            
                    
                    
                    <div id="tablaSommelier" class="ocultar">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">    
            <table  class="table table-bordered">
                <thead>
        <tr>
            <th colspan="3" style="text-align: center;background-color:rgb(170,25,39);color: white;">Agregar Maridaje</th>
        </tr>
        <tr>
            <th style="background-color: rgb(170,25,39);color: white;">Nombre del platillo</th>
            <th style="background-color: rgb(170,25,39);color: white; text-align: center;">Si</th>
            <th style="background-color: rgb(170,25,39);color: white; text-align: center;">No</th>
            
        </tr>
    </thead>
    <tbody>
        <?php

        $objPlatillo = new Platillo();
        $platillos = $objPlatillo->ConsultarTodo();
        $objMaridaje = new Maridaje();
        foreach($platillos as $p){
            $maridaje = $objMaridaje->ConsultarPorIds($p->ID,$idPlatilloEd);
            echo "<tr>";
            echo "<td>$p->Nombre</td>";
            if(count($maridaje)>0){
                 echo "<td><input type='radio' name='Platillo$p->ID' value='$p->ID' checked=''></td>";
                 echo "<td><input type='radio' name='Platillo$p->ID' value=''></td>";
            }
            else
            {
                echo "<td><input type='radio' name='Platillo$p->ID' value='$p->ID'></td>";
                echo "<td><input type='radio' name='Platillo$p->ID' value='' checked=''></td>";
            }            
            echo "</tr>";
        }
        
        ?>
    </tbody>
                                </table>
                        </div>
                    </div>
                    
                    <div id="tablaSubMenu" class="ocultar">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">    
            <table  class="table table-bordered">
                <thead>
        <tr>
            <th colspan="3" style="text-align: center;background-color:rgb(170,25,39);color: white;">Cargar a Menú</th>
        </tr>
        <tr>
            <th style="background-color: rgb(170,25,39);color: white;">Nombre del menú</th>
            <th style="background-color: rgb(170,25,39);color: white; text-align: center;">Si</th>
            <th style="background-color: rgb(170,25,39);color: white; text-align: center;">No</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $objSubMenu = new SubMenu();
        $submenus = $objSubMenu->ConsultarSubMenuBebidasDisponibles();
        $objVinosSubMenu = new VinosSubMenu();
        foreach($submenus as $s){
            $vinosSub = $objVinosSubMenu->ConsultarPorIdVino_IdSubMenu($idPlatilloEd, $s->ID);
            echo "<tr>";
            echo "<td>$s->Ruta</td>";
            if(count($vinosSub)>0){
                echo "<td><input type='radio' name='SubMenu$s->ID' value='$s->ID' checked=''></td>";
                echo "<td><input type='radio' name='SubMenu$s->ID' value=''></td>";  
            }
            else{
                echo "<td><input type='radio' name='SubMenu$s->ID' value='$s->ID'></td>";
                echo "<td><input type='radio' name='SubMenu$s->ID' value='' checked=''></td>";  
            }
            echo "</tr>";
        }
        ?>
    </tbody>
                                </table>
                        </div>
                    </div>
                
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <br>
                <br>
                    <input type="submit" value="Guardar Modificación" class="btn btn-primary" name="btnModificar" style="background-color: rgb(170,25,39); border-color: rgb(170,25,39);" >
                    <a class="btn btn-default" style="float: right" href="F_A_ConsultarVinos.php">
                        Ver listado de vinos
                    </a>
                    <br>
                    <br>
                </div>        
            </form>            
    </body>
</html>
