
<?php
require 'Header.php';
?>                
            
<title>Consultar Venta a Detalle</title>

<?php
require './Clases/Ventas.php';
require './Clases/DetalleVentas.php';
require_once './Clases/Empresa.php'; 
require_once './Clases/DetallePago.php';
require_once './Clases/CatalogoFormaPago.php';


        if( isset($_GET['IdVenta'])){
            $ID = $_GET['IdVenta'];
            $array_detalleVentas = array();
            
            $objVenta = new Ventas();
            $objVenta->ObtenerPorId($ID);
            
            $objDetalleVentas = new DetalleVentas();
            $array_detalleVentas = $objDetalleVentas->ObtenerPorIdVenta($ID);
            
            $objDetallePago = new DetallePago();
            $arrayPagos = array();
            $arrayPagos = $objDetallePago->ObtenerPorVenta($ID);
        }
        else {
            header("Location: F_A_ConsultarVentas.php");
        }
             

    ?>
        
            <!--action="Validaciones_Lado_Servidor/Validar_EditarMesero.php"-->
        <form  method="POST" enctype="multipart/form-data">
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">
                <table class="encabezadoTabla">
                    <td class="tdEncabezadoTabla">
                        <div><h4><center><label class="textoEncabezadoTabla">Venta detallada: <?php echo " ". $ID;?> </label></center></h4></div>
                    </td>
                </table>
            </div>
                            
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-5">
            <table border="0">
                <tr>
                    <td><div class="etiquetas2">Fecha</div></td>
                    <td><div class="campos"><input type="text"  readonly="readonly" name="txtFecha" class="form-control" value="<?php echo date_format($objVenta->Fecha, 'Y-m-d H:i:s');?>" > </div></td>
                </tr>
                <tr>
                    <td><div class="etiquetas2">Folio de comanda</div></td>
                    <?php 
                        require_once './Clases/Comanda.php';
                        $objComanda = new Comanda();


                    ?>
                    <td><div class="campos"><input type="text" readonly="readonly" name="txtComanda" class="form-control" value="<?php $folio =explode("°", $objComanda->Detalle_Uno($objVenta->IdComanda));  echo $folio[0];?>" > </div></td>
                </tr>
                <tr>
                           <td><div class="etiquetas2">Método de pago</div></td>
                           <?php 
                                $formasPago ="";
                                $cuentasPago ="";
                                $contador=0;
                                foreach ($arrayPagos as $pagos)
                                {
                                    $objFormaPago = new CatalogoFormaPago();
                                    $objFormaPago->ConsultarPorId($pagos->IdFormaPago);
                                    if($contador==0)
                                    {
                                        $formasPago .=$objFormaPago->Nombre;
                                        if($pagos->IdFormaPago!='1' && $pagos->IdFormaPago!='8')
                                        {
                                            $cuentasPago .= $pagos->NumeroCuenta;
                                        }
                                    }else{
                                        $formasPago .= "," . $objFormaPago->Nombre;
                                        if($pagos->IdFormaPago!='1' && $pagos->IdFormaPago!='8')
                                        {
                                            $cuentasPago .= "," . $pagos->NumeroCuenta;
                                        }
                                    }
                                    
                                   
                                    $contador++;
                                }
                           ?>
                            <td><div class="campos"><input type="text" readonly="readonly" name="txtFormaPago" class="form-control" value="<?php echo $formasPago; ?>" > </div></td>
                        </tr>
                        <tr>
                           <td><div class="etiquetas2">Forma de pago</div></td>
                           <?php 
                                require './Clases/CatalogoMetodoPago.php';
                                $objMetodoPago = new CatalogoMetodoPago();
                                $objMetodoPago->ConsultarPorClave($objVenta->IdMetodoPago);
                           ?>
                            <td><div class="campos"><input type="text"  readonly="readonly" name="txtMetodoPago" class="form-control" value="<?php echo $objMetodoPago->Nombre;  ?>" > </div></td>
                        </tr>
                        <tr>
                            <td><div class="etiquetas2">Cuenta de pago</div></td>
                            <td colspan="4"><div class="campos"><input type="text"  name="txtCuentaPago" readonly="readonly" class="form-control" value="<?php echo $cuentasPago;?>"></div></td>
                        </tr> 
                    </table>
                </div>
                    
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-5">
            <table class="table-hover">    

                                       

               <tr>
                   <td><div class="etiquetas2">Administrador</div></td>
                   <?php 
                        require_once './Clases/Usuario.php';
                        $objUsuario = new Usuario();
                        $objUsuario->ConsultarPorID($objVenta->IdUsuario);
                   ?>
                   <td colspan="4"><div class="campos"><input type="text"  name="txtCliente" readonly="readonly" class="form-control" value="<?php echo $objUsuario->Nombre . ' '. $objUsuario->Apellidos; ?>"></div></td>
                </tr>
                <tr>
                           <td><div class="etiquetas2">Mesero</div></td>
                           <?php 
                                require './Clases/Mesero.php';
                                $objComanda->ConsultarPorID($objVenta->IdComanda);
                                $objMesero = new Mesero();
                                $objMesero->ConsultarPorID($objComanda->IdMesero);
                           ?>
                            <td><div class="campos"><input type="text"  readonly="readonly" name="txtMetodoPago" class="form-control" value="<?php echo $objMesero->Nombre . " ". $objMesero->Apellidos;  ?>" > </div></td>
                        </tr>

                 <tr>
                    <td><div class="etiquetas2">Facturada</div></td>
                    <td colspan="4"><div class="campos"><input type="text" name="txtFacturada" readonly="readonly" class="form-control" value="<?php if($objVenta->Facturada==1) {echo "Sí";}else{echo "No";}?>"></div></td>

                </tr>                        
                 <tr>
                    <td><div class="etiquetas2">Estatus</div></td>
                    <td colspan="4"><div class="campos"><input type="text" name="txtStatus" readonly="readonly" class="form-control" value="<?php echo $objVenta->Status; ?>"></div></td>

                </tr>

            </table>
           </div>
             <?php 
                $objEmpresa = new Empresa();
                $objEmpresa->ObtenerPorID(1);
                
                require_once './Clases/ConfiguracionFacturas.php';
                $objConfiguracion = new ConfiguracionFacturas();
                $objConfiguracion->ObtenerPorId(1);

                $IdMoneda = $objConfiguracion->IdMoneda;
                
                require_once './Clases/Moneda.php';
                $objMoneda = new Moneda();
                $objMoneda->ConsultarPorId($IdMoneda);
                
            ?>      
            <div id="tabla_detalle_venta" class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10 table-responsive mostrar">
                <table class="table table-bordered">
                <tr><td colspan='6' style='background-color:<?php echo $objEmpresa->ColorFondoBarra; ?>; color: white; text-align:center;'>PRODUCTOS CONSUMIDOS</td></tr>
                <tr>
                    <td>Cantidad</td>
                    <td>Descripción</td>
                    <td>Precio en la carta</td>
                    <td>Precio unitario</td><!--
                    <td>Importe de Iva</td>-->
                    <td>Importe</td>
                    <td>Total</td>
                </tr>
                <?php
                    $suma_subtotal=0.00;
                    $suma_Iva=0.00;
                    $suma_total=0.00;
                    $bandera_iva_16=false;
                    foreach ($array_detalleVentas as $ventas)
                    {
                        echo "<tr>";
                        echo "<td style='font-weight:normal;'>".$ventas->Cantidad."</td>";
                        echo "<td style='font-weight:normal;'>".$ventas->Descripcion."</td>";
                        echo "<td style='font-weight:normal;'>$".number_format($ventas->PrecioCarta, $objMoneda->Decimales, '.','')."</td>";
                        echo "<td style='font-weight:normal;'>$".number_format($ventas->PrecioSinIva,$objMoneda->Decimales, '.','')."</td>";
//                        echo "<td style='font-weight:normal;'>$".number_format(($ventas->Total-$ventas->SubTotal),$objMoneda->Decimales, '.','')."</td>";
                        echo "<td style='font-weight:normal;'>$".number_format($ventas->SubTotal,$objMoneda->Decimales, '.','')."</td>";
                        echo "<td style='font-weight:normal;'>$".number_format($ventas->Total,$objMoneda->Decimales, '.','')."</td>";
                        echo "</tr>";
                        $suma_subtotal += $ventas->SubTotal;
                        $suma_Iva += $ventas->IVA;
                        $suma_total += $ventas->Total;
                        if($ventas->IVA == 16)
                        {
                            $bandera_iva_16 = true;
                        }
                    }
                    $suma_total = $suma_total - $objVenta->Descuento;
                    

                    if($bandera_iva_16 == TRUE){
                     $suma_subtotal = $suma_total/(1+(16/100));
                     $suma_Iva = $suma_subtotal * (16/100);
                    }
                    else{
                        $suma_subtotal = $suma_total;
                        $suma_Iva = 0;
                    }
                   
                ?>  
                <tr>
                    <td colspan="4" style="border-bottom:hidden; border-left:hidden; "></td>
                    <td style="background-color:#EEEEEE;">SUBTOTAL</td>
                    <td style="background-color:#EEEEEE;">$<?php echo number_format($suma_subtotal, $objMoneda->Decimales, '.',''); ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="border-bottom:hidden; border-left:hidden;"></td>
                    <td style="background-color:#EEEEEE;">IVA</td>
                    <td style="background-color:#EEEEEE;">$<?php echo number_format(($suma_total-$suma_subtotal), $objMoneda->Decimales, '.',''); ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="border-bottom:hidden; border-left:hidden;"></td>
                    <td style="background-color:#EEEEEE;">DESCUENTO</td>
                    <td style="background-color:#EEEEEE;">$<?php echo number_format(($objVenta->Descuento), $objMoneda->Decimales, '.',''); ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="border-bottom:hidden; border-left:hidden;"></td>
                    <td style="background-color:#EEEEEE;">PROPINA</td>
                    <td style="background-color:#EEEEEE;">$<?php echo number_format(($objVenta->Propina), $objMoneda->Decimales, '.',''); ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="border-bottom:hidden; border-left:hidden;"></td>
                    <td style="background-color:#EEEEEE;">TOTAL</td>
                    <td style="background-color:#EEEEEE;">$<?php $temp= number_format(($suma_total + $objVenta->Propina),
                            $objMoneda->Decimales, '.','');echo $temp;  ?></td>
                </tr>
            </table>
           </div>
            
       
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10">    
        
            <a class="btn btn-Regresar"  href="F_A_ConsultarVentas.php">
               &larr; Listado de ventas
            </a> 
            <br>
            <br>
        </div>
            
                       
            
    </form>            

    </body>
    
</html>
