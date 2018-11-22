          <?php
          require 'Header.php';
          require_once './Clases/Insumo.php';
          ?>        
            <title></title>
            

            

            <form action="Validaciones_Lado_Servidor/Validar_ListaConteo.php" method="POST" name="form" id="form">
            
            
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
            <table class="encabezadoTabla">
            <td class="tdEncabezadoTabla">
                <div><h4><center><label class="textoEncabezadoTabla"></label></center></h4></div>
            </td>
        </table>
        </div>
        
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-offset-1 col-lg-10 table-responsive">
            <table border="0" style="text-align: center;" >
                <tr>
                   
                    <td><button type="button" name="btnGuardar" id="btnGuardar" class="textoOpcionesMenuFacturacion" onclick=""><span class="glyphicon glyphicon-ok" style="font-size:22px; color:#008080;"></span> Consultar</button></td>
                     <td style="width:100px;"></td>
                </tr>
            </table>
         
     </div>
            
            
            <br><br>
    
    
         
   
            
            
            
    
            </form>            
            
            <script>
            $("button[name='btnGuardar']").click(function() {
          
           
             var ids_seleccionados="├1";
             var incluir_existencias = false;
             
            if(ids_seleccionados=="")
            {
                swal("¡Atención!", "No ha seleccionado ningún elemento.");
            }else
            {
                $.ajax({
                    url: "Validaciones_Lado_Servidor/Validar_ListaConteo.php",
                    type: 'POST',
                    data: {"incluir_existencias": incluir_existencias,
                           "ids_seleccionados": ids_seleccionados},
                    success: function(data){
    //                  
                    }
                }); 
            }
//            
             
        });    
            </script>
    </body>
</html>
