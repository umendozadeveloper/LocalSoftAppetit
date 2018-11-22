
<nav class="navbar navbar-inverse" role="navigation" id="barraAdmin" style="margin-top: -9px; margin-bottom: 0px;">
    <div class="container-fluit">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#MenuAdmin">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>

        </div>



        <div class="collapse navbar-collapse" id="MenuAdmin">
            <ul class="nav navbar-nav">



                <li><a href="F_A_PaginaPrincipal.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
                
   <!--****************-->
                <li class="dropdown"> <a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Config<b class="caret"></b></a>
                   
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Empresa</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_Empresa.php" tabindex="-1"><span class="glyphicon glyphicon-briefcase"></span> Datos de empresa</a></li>
                                
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Usuarios</a>
                             <ul class="dropdown-menu">
				
                                <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Administradores</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="F_A_RegistrarAdministrador.php" tabindex="-1">Agregar</a></li>
                                        <li><a href="F_A_ConsultarAdmin.php" tabindex="-1">Consultar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Meseros</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="F_A_RegistrarMesero.php" tabindex="-1">Agregar</a></li>
                                        <li><a href="F_A_ConsultarMeseros.php" tabindex="-1">Consultar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>  
                            
<!--                        <li class=""><a href="F_A_PersonalizarApp.php" tabindex="-1"><span class="glyphicon glyphicon-edit"></span> Personalizar aplicación</a></li>-->
                        <li class=""><a href="F_A_ConfiguracionGeneral.php" tabindex="-1"><span class="glyphicon glyphicon-edit"></span> Personalizar aplicación</a></li>

                    </ul>
                </li>           
                
                
                
            <li class="dropdown"> <a href="#" data-toggle="dropdown">Catálogos<b class="caret"></b></a>
                   
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Insumos</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_Registrar_Insumo_Inventario.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_Consultar_Insumos.php" tabindex="-1">Consultar</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Clientes</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarCliente.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_ConsultarClientes.php" tabindex="-1">Consultar</a></li>
                            </ul>
                        </li>
                         <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Proveedores</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarProveedor.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_ConsultarProveedor.php" tabindex="-1">Consultar</a></li>
                            </ul>
                         </li>
                         <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Unidades de  Medida</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_Registrar_UnidadMedida.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_Consultar_UnidadMedida.php" tabindex="-1">Consultar</a></li>
                            </ul>
                         </li>
                         <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Clasificador</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarClasificador.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_ConsultarClasificador.php" tabindex="-1">Consultar</a></li>
                            </ul>
                         </li>
                         <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Almacenes</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarAlmacen.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_ConsultarAlmacen.php" tabindex="-1">Consultar</a></li>
                            </ul>
                         </li>
                         <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Ubicación</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarUbicacion.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_ConsultarUbicacion.php" tabindex="-1">Consultar</a></li>
                            </ul>
                         </li>
                         <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Conceptos de entrada y salida</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarConceptos.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_ConsultarConceptos.php" tabindex="-1">Consultar</a></li>
                            </ul>
                         </li>
                        
                         <!--<li class=""><a href="#" tabindex="-1" data-toggle="dropdown">Conceptos de Salida</a></li>-->
                    </ul>
            </li>
                        
                
            <li class="dropdown"> <a href="#" data-toggle="dropdown">Mi Restaurante<b class="caret"></b></a>
                   
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Alimentos</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarPlatillo.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_ConsultarPlatillos.php" tabindex="-1">Consultar</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown"><span class="glyphicon glyphicon-glass"></span>Bebidas</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarVino.php" tabindex="-1">Agregar</a></li>
                                <li><a href="F_A_ConsultarVinos.php" tabindex="-1">Consultar</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown"><span class="glyphicon glyphicon-cutlery"></span> Menús</a>
                            <ul class="dropdown-menu">
                                <?php if ($seguridad->CurrentUserPerfil() == 2 || $seguridad->CurrentUserPerfil() == 3)  ?>
                                <li><a href="<?php echo "VentanaModalParaMenuBixa.php?idComanda=-1"; ?>">Carta</a></li>
                                <?php if ($seguridad->CurrentUserPerfil() == 1) { ?>

                                <?php } ?>
                                <?php if ($seguridad->CurrentUserPerfil() == 2) { ?>
                                    <li><a href="<?php echo "F_M_Comanda_A_Detalle.php?idComanda=" . $seguridad->CurrentUserID(); ?>">Ver estado de comanda</a></li>
                                <?php } ?>
                                <li><a href="F_A_ConsultarSubMenus.php">Agregar/Consultar menús</a></li>
                                <li><a href="F_A_OpcionesMenuPlatillos.php?MenuP=1">Ordenar menús de platillos</a></li>
                                <li><a href="F_A_OpcionesMenuBebidas.php?MenuP=2">Ordenar menús de bebidas</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu"><a href="#" data-toggle="dropdown">Mesas</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarMesa.php">Agregar</a></li>
                                <li><a href="F_A_ConsultarMesas.php">Consultar</a></li>
                            </ul>
                        </li>
                        
                        
                         <li class="dropdown-submenu"><a href="#" data-toggle="dropdown">Encuestas</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_EncuestasM.php">Encuesta meseros</a></li>
                                <li><a href="F_A_Encuesta.php">Resultados</a></li>
                            </ul>
                        </li>
                         <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Publicidad</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_AgregarPublicidad.php">Agregar</a></li>
                                <li><a href="F_A_Publicidad.php">Consultar</a></li>
                                <!--<li><a href="F_A_MostrarBanner.php"><span class="glyphicon glyphicon-tasks"></span> Opciones</a></li>-->
                            </ul>
                        </li>
                         <li class="dropdown-submenu"><a href="#" data-toggle="dropdown">Marketing</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_ConsultarClientesVIP.php">Clientes VIP</a></li>
                                <li><a href="F_A_EnviarCorreos.php">Correo nuevo</a></li>
                                <li><a href="F_A_ConsultarCorreosE.php">Ver listado de correos envíados</a></li>
                            </ul>
                        </li>
                    </ul>
            </li>
               
                
                <li class="dropdown"> <a href="#" data-toggle="dropdown">Almacén<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Compras (Entradas)</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_Registrar_Entrada_Inventario.php">Agregar entradas</a></li>
                                <li><a href="F_A_ConsultarEntradas.php">Consultas</a></li>
                               
                            </ul>
                        </li>
                        <!--<li><a href="F_A_Registrar_Entrada_Inventario.php" tabindex="-1">Compras (Entradas)</a></li>-->
                                    
<!--                        <li><a href="F_A_Registrar_Salida_Inventario.php" tabindex="-1">Consumo (Salidas)</a>
                            
                        </li>-->
                        
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Consumo (Salidas)</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_Registrar_Salida_Inventario.php">Agregar salidas</a></li>
                                <li><a href="F_A_ConsultarSalidas.php">Consultas</a></li>
                               
                            </ul>
                        </li>
<!--                       <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Ajustes</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_RegistrarAjuste_Entrada.php">Entradas</a></li>
                                <li><a href="F_A_RegistrarAjuste_Salida.php">Salidas</a></li>
                               
                            </ul>
                        </li>-->
                        
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Ajustes</a>
                             <ul class="dropdown-menu">
				
                                <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Entradas</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="F_A_RegistrarAjuste_Entrada.php" tabindex="-1">Agregar entrada</a></li>
                                        <li><a href="F_A_ConsultarAjusEntradas.php" tabindex="-1">Consultar entradas</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Salidas</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="F_A_RegistrarAjuste_Salida.php" tabindex="-1">Agregar salida</a></li>
                                        <li><a href="F_A_ConsultarAjusSalida.php" tabindex="-1">Consultar salidas</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> 
                        
                        
                        
                        
                        
                        
                        <li><a href="F_A_Kardex.php" tabindex="-1">Kardex</a></li>
                        <li class="dropdown-submenu"><a href="#" tabindex="-1" data-toggle="dropdown">Proceso de inventario</a>
                            <ul class="dropdown-menu">
                                <li><a href="F_A_InventariosIniciar.php">Iniciar proceso</a></li>
                                <li><a href="F_A_Impresion_Listado_Conteo.php">Listas para conteo</a></li>
                                <li><a href="F_A_CapturaConteo.php">Captura de conteo</a></li>
                                <li><a href="F_A_MostrarInventarios.php">Finalizar proceso</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
           
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-credit-card"></span> Facturación<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        
                        <li><a href="F_A_FacturasFiscales.php">Facturar</a></li>
                        <li><a href="F_A_ConsultarFacturas.php">Consultar/Cancelar</a></li>
                        <li><a href="F_A_ConfigurarFactura.php">Config. de factura</a></li>
                    </ul>
                </li>

                <li><a href="F_A_ConsultarComandas.php"><span class="glyphicon glyphicon-stats"></span> Comandas</a></li>                                               
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Monitor<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        
                        <li><a href="F_A_MonitorCocina.php">Cocina</a></li>
                        <li><a href="F_A_MonitorBar.php">Bar</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="F_A_ConsultarVentas.php">Consultar/Cancelar</a></li>
                        
                    </ul>
                </li>
                
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Existencia</a></li>
                        <li><a href="#">Inventario físico</a></li>
                    </ul>
                </li>
                
                
                
                
                
                
                
                
               
                
                <li><a href="cerrarSesionAd.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>







            </ul>
        </div>

    </div>
</nav>
