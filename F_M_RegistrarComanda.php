

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
          <?php
          //require './ComprobarSesion.php';
          require 'Header.php';
          //require_once './PartesHTML/LogoBIXA_Barra.php';
 require_once  './Clases/Comanda.php';
 include_once './Clases/Mesa.php';
 require_once './Clases/ZonaUbicacion.php';
            
            
          ?>
                    
            <title>Registrar Comanda</title>
    </head>
    <body style="background-color: white;">

        <?php
        
        $objComanda = new Comanda();
        $numeroComanda = $objComanda->NumeroComanda();
        $fechaLista = $objComanda->ConsultarFecha();
        $objMesa = new Mesa();
        $mesaslibres = $objMesa->ConsultarLibres();
        if(count($mesaslibres)<=0){
            echo "<script>swal('No hay mesas disponibles');</script>";
        }
        
          if(!empty($_SESSION['uri']) && !empty($_SESSION['mjsEstadoAgCo'])){
              $estado = $_SESSION['mjsEstadoAgCo'];
              if($estado=="success"){
                  $titulo = "Correcto";
              }
              else{
                  $titulo="Error";
              }
              
              $alerta = "<script>swal('$titulo','";
              foreach($_SESSION['uri'] as $mensaje){
                  $alerta.="$mensaje\\n";
              }
              $alerta.="','$estado');</script>";
              echo $alerta;
              $_SESSION['uri']=null;
              $_SESSION['mjsEstadoAgCo']=null;
              
          }
 
        
        
        ?>
        
        
        
        
            <form action="Validaciones_Lado_Servidor/Validar_AgregarComanda.php" method="POST" name="form" id="formulario">
                
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                        <table class="encabezadoTabla">
                            <td class="tdEncabezadoTabla">
                                <div><h4><center><label class="textoEncabezadoTabla">Registrar comanda</label></center></h4></div>
                            </td>
                        </table>
                    </div>
                
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
                    
                    <table>
                        <tr>
                            <td><div class="etiquetas2">Folio de la comanda</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly="" name="txtComanda" required title="Ingresar Datos" class="form-control" value="<?php echo $seguridad->CurrentUserName()[0].$seguridad->CurrentUserName()[1].$seguridad->CurrentUserID()."-$numeroComanda";?>"></div></td>
                        </tr>
                        <tr>
                            <td><div class="etiquetas2">Fecha</div></td>
                            <td colspan="4"><div class="campos"><input type="text" readonly="" name="txtFecha" required title="Ingresar Datos" class="form-control" value="<?php echo $fechaLista; ?>"></div></td>
                        </tr>                        
            </table>
                </div>
                    
                
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
                    
            <table  class="  table-hover table-bordered table-responsive  tablaPaginado" cellspacing="0" width="100%">
                <thead style="" class="EncabezadoTablaPersonalizada">
        <tr>
            <th class="" colspan="5" style="text-align: center; height: 40px">MESAS LIBRES</th>
        </tr>
        <tr>
            <th style="text-align: center;">Número de mesa</th>
            <th style="text-align: center;">Cantidad de Personas</th>
            <th style="text-align: center;">Ubicación</th>
            <th style="text-align: center;">Mesas a usar</th>
            <th style="text-align: center;">Mesa Principal</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach($mesaslibres as $m){
            echo "<tr>";
            echo "<td><center>$m->Numero</center></td>";
            echo "<td><center>$m->CantidadPersonas</center></td>";
            
            $objZonaUbicacion = new ZonaUbicacion();
            $objZonaUbicacion->ConsultarPorID($m->Ubicacion);
            
            echo "<td><center>$objZonaUbicacion->Descripcion</center></td>";
            echo "<td><center><input type='checkbox'  name='check".$m->ID."' value='$m->ID'></center></td>";
            echo "<td><center><input type='radio' id='radio".$m->ID."' name='radio' value='$m->ID' disabled ></center></td>";
            echo "</tr>";
        }

        ?> 
        </tbody>
                                </table>
                </div>
                
                
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                    
                    <?php if(count($mesaslibres)>0){ ?>
                    <input type="button" value="Registrar" name="btnAceptar" id="btnPrueba" class="btn btn-Bixa" style="" >
                    <?php } ?>
                    <a class="btn btn-default" style="float: right" href="F_M_ConsultarComandas.php">
                        Consultar comandas
                </a>
                    <br>
                    <br>
                    </div>
                </form>            
                        
 
    </body>
            <script>
            
$("input[type=checkbox]").click(function() {
    var valorCheck = "input[id=radio"+($(this).val())+"]";
    if( $(this).is(':checked')){
        $(valorCheck).attr('disabled', false);
    }
    else{
        
        $(valorCheck).attr('disabled', true);
        $(valorCheck).attr('checked',false);
        
    }	
});

$("#btnCheck").click(function (){
    
   if($("input[type=checkbox]").is(':checked')){
       alert('S');
   }
});


$("#btnPrueba").click(function (){
    /*$('#formulario').submit();*/
    if($("input[type=checkbox]").is(':checked')){
        
        if($("input[type=radio]").is(':checked')){
            
    swal({   
		title: '¿Seguro que desea dar de alta una nueva orden?',   
		text: 'No será posible cancelarla',   
		type: 'warning',   
		showCancelButton: true,   
		confirmButtonColor: '#AA1927',   
		confirmButtonText: 'Si',   
		cancelButtonText: 'No',   
		closeOnConfirm: false,   
		closeOnCancel: false },
            

		function(isConfirm){   
			if (isConfirm) {
                    $('#formulario').submit();
                                        
			} else {     
				swal('Orden cancelada', 
					'', 
				'error');   
			} 
		});
    }
    else{
        swal("Es necesario seleccionar la mesa principal");
    }
}
    else {
        swal("Es necesario seleccionar al menos una mesa");
     
    }
});

$("#formulario").submit(function (e) {
      });
        </script>
</html>
