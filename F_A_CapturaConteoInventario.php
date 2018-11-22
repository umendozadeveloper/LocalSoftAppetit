      <?php
          include_once './Clases/Inventario.php';
            if(isset($_GET['IdInventario'])){

                $ID= $_GET['IdInventario'];
               
                
            }
            else{
                header("Location: F_A_CapturarConteo.php");
            }
          require 'Header.php';
          
          
?>               
            <title>Impresión de listado</title>
            
<!--        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">       -->
            

        <form action="" method="POST" name="form" id="form">
            
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla">Captura de conteo: Folio <?php echo $ID; ?></label></center></h4></div>
            </td>
        </table>
        </div>
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
            <table border="0" style="text-align: center;" >
                <tr>
                    <td style="width:100px;"></td>
                    <td style="width: 300px;"> </td>
                    <td align="right"><button type="button" name="btnGuardar" id="btnGuardar" class="textoOpcionesMenuFacturacion"><span class="glyphicon glyphicon-floppy-disk" style="font-size:22px; color:#4B0082;"></span> Guardar</button></td>
                    <td style="width:100px;"></td>
                </tr>
            </table>
           
     </div>    
              
     
        <br><br>
            
            
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
        <br>
        <table border='0' class="tableEncabezadoFijo" name="tabla_inventario" id="tabla_inventario">
           
        <thead>
        <th  class='EncabezadoTablaPersonalizada ocultar' style="width:1%;" ><center>ID</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="width:26%;" ><center>Descripción</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="width:18%;"><center>Presentación</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="width:10%;"><center>UM</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="width:17%;"><center>Contenido</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="width:14%;"><center>Existencia</center></th>
        <th  class='EncabezadoTablaPersonalizada' style="width:14%;"><center>Conteo</center></th>
       </thead>
       <tbody>
           <?php
                $objInventario = new Inventario();
                $lista = $objInventario->ObtenerListadoConteo($ID, 1);
                
                foreach($lista as $invent)
                {
                    echo "<tr>";
                    echo "<td class='ocultar'>".$invent['IdInsumo']."</td>";
                    echo "<td><center>".$invent['Descripcion']."</center></td>";
                    echo "<td><center>".$invent['Presentacion']."</center></td>";
                    echo "<td><center>".$invent['UM']."</center></td>";
                    echo "<td><center>".$invent['Contenido']." ". $invent['UMC']."</center></td>";
                    echo "<td><center>".number_format($invent['Existencia'],2,'.','')."</center></td>";
                    echo "<td><input type='text' class='form-control' id='txtConteo".$invent['IdInsumo']."'  name='txtConteo".$invent['IdInsumo']."' /></td>";
                    echo "</tr>";
                 
                }
                echo "<input class='ocultar' name='txtID' id='txtID' value='$ID' >";
           ?>
       </tbody>
        </table>

    
         
    </div>
            
           
   
    
          
    <script>
        $("button[name='btnGuardar']").click(function() {
          
           var todos_capturados="";
           var ID = document.getElementById("txtID").value;
          
           $("#tabla_inventario tbody tr").each(function(index){
              var id,conteo,existencia;
              $(this).children("td").each(function (index2) 
              {
//                      alert("entra");
                    switch (index2) 
                    {
                        case 0: id = $(this).text();
                            break;
                        case 5:existencia = $(this).text();
                            break;
                        case 6: conteo= $('input:text[name=txtConteo'+id+']').val();
                            break;
                        
                    }

             });
                todos_capturados += "├" + id + ":"+existencia + ":" + conteo;
                
           });
           
           
           $.ajax({
                url: "Validaciones_Lado_Servidor/Validar_CapturaConteo.php",
                type: 'POST',
                data: {"todos_capturados": todos_capturados,
                       "ID": ID},
                success: function(data){
                   if(data=='false')
                   {
                       swal("Error", "Ha ocurrido un error. Intente más tarde", "error");
                   }
                   else{
                       swal("Correcto", "Se actualizaron los datos", "success");
                   }     
                }
            }); 
             
        });    
    </script>
            </form>            
            

    </body>
</html>
