<?php

require_once '../Clases/Clasificador.php';
include_once './Funciones/Mensajes_Bootstrap.php';
include_once './Funciones/P_SwalMensajes.php';
require_once '../Clases/Proveedor.php';
require_once '../Clases/UnidadMedidaInsumos.php';
require_once '../Clases/Almacen.php';
require_once '../Clases/Ubicacion.php';
require_once '../Clases/Concepto.php';
require_once '../Clases/Usuario.php';
require_once '../Clases/Mesero.php';
require_once '../Clases/Insumo.php';
require_once '../Clases/ClientesFacturas.php';
require_once '../Clases/Platillo.php';
require_once '../Clases/Vino.php';

class N_EliminarElementoCatalogo
{
    function main()
    {
        $IdCatalogo = $_POST['IDCatalogo'];
        $ID = $_POST['txtID'];
        switch($IdCatalogo)
        {
            case 1:#Catálogo de Clasificador

                $objClasificador = new Clasificador();
                if($objClasificador->Eliminar($ID)== true){
                    setSuccessMessage("El clasificador fue borrado exitosamente");
                }else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_ConsultarClasificador.php");
                break;
            case 2:#Catálogo de Proveedores
                $objProveedor = new Proveedor();
                if($objProveedor->Eliminar($ID) == true)
                {
                    setSuccessMessage("El proveedor fue borrado exitosamente");
                }else{
                   setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_ConsultarProveedor.php");
                break;
                
             case 3:#Catálogo de Unidades de medida de Insumos
                $objUnidadesMedida = new UnidadMedidaInsumo();
                if($objUnidadesMedida->Eliminar($ID) == true)
                {
                    setSuccessMessage("La unidad de medida fue borrada exitosamente");
                }else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_Consultar_UnidadMedida.php");
                break;
            case 4:#Catálogo de Almacenes
                $objAlmacen = new Almacen();
                if($objAlmacen->Eliminar($ID) == true)
                {
                    setSuccessMessage("El almacén fue borrado exitosamente");
                }else{
                   setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_ConsultarAlmacen.php");
                break;
            case 5:#Catálogo de Ubicación
                $objUbicacion = new Ubicacion();
                if($objUbicacion->Eliminar($ID) == true)
                {
                    setSuccessMessage("La ubicación fue borrada exitosamente");
                }else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_ConsultarUbicacion.php");
                break;
            case 6:#Catálogo de Conceptos
                $objConcepto = new Concepto();
                if($objConcepto->Eliminar($ID) == true)
                {
                    setSuccessMessage("El concepto fue borrado exitosamente");
                }else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_ConsultarConceptos.php");
                break;
            case 7:#Administradores /Usuarios
                $objUsuario = new Usuario();
                $objUsuario->ConsultarPorID($ID);
                if($objUsuario->PrivilegiosMesero == '1'){
                    $objMesero = new Mesero();
                    if($objMesero->ObtenePorIDAdmin($ID)){
                        $id_mesero  =$objMesero->ID;
                        if($objMesero->Eliminar($id_mesero) == true)
                        {
                            setSuccessMessage("Fue borrada la cuenta de mesero que el administrador tenía asignado");
                        }
                        else{
                            $objMesero->CambiarStatusMesero($id_mesero, 0);
                            setFailureMessage("La cuenta de mesero de este administrador no se eliminó. Es probable que sea un elemento en uso.");
                        }
                    }
                    
                    if($objUsuario->Eliminar($ID) == true)
                    {
                        setSuccessMessage("El administrador fue borrado exitosamente");
                    }else{
                        setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                    }
                    header("Location: ../F_A_ConsultarAdmin.php");
                }
                else{
                    
                    $objMesero = new Mesero();
                    if($objMesero->ObtenePorIDAdmin($ID)){
                        $id_mesero  =$objMesero->ID;
                        if($objMesero->Eliminar($id_mesero) == true)
                        {
                            setSuccessMessage("Fue borrada la cuenta de mesero que el administrador tenía asignado");
                        }else{
                            $objMesero->CambiarStatusMesero($id_mesero, 0);
                        }
                    }
                    
                    if($objUsuario->Eliminar($ID) == true)
                    {
                        setSuccessMessage("El administrador fue borrado exitosamente");
                    }else{
                        setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                    }
                    header("Location: ../F_A_ConsultarAdmin.php");
                }
                

                break;
             case 8:#Meseros
                $objMesero = new Mesero();
                if($objMesero->Eliminar($ID) == true)
                {
                    setSuccessMessage("El mesero fue borrado exitosamente");
                }else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_ConsultarMeseros.php");
                break;
             case 9:#Insumos
                $objInsumo = new Insumo();
                if($objInsumo->Eliminar($ID) == true)
                {
                    setSuccessMessage("El insumo fue borrado exitosamente");
                }else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_Consultar_Insumos.php");
                break;
             case 10:#ClientesFacturas
                $objCliente = new ClientesFacturas();
                if($objCliente->Eliminar($ID) == true)
                {
                    setSuccessMessage("El cliente fue borrado exitosamente");
                }else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_ConsultarClientes.php");
                break;
            case 11:#Platillos
                $objPlatillo = new Platillo();
                $objPlatillo->ConsultarPorID($ID);
                
                if((file_exists("../".$objPlatillo->Foto)) && (file_exists("../".$objPlatillo->Icono))){
                    unlink("../".$objPlatillo->Foto);
                    unlink("../".$objPlatillo->Icono);
                }
                
                if($objPlatillo->Eliminar($ID) == TRUE)
                {                                        
                    setSuccessMessage("El platillo fue borrado exitosamente");
                }
                else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                
                header("Location: ../F_A_ConsultarPlatillos.php");
                break;
            case 12:#Bebidas
                $objBebida = new Vino();
                $objBebida->ConsultarPorID($ID);
                if((file_exists("../".$objBebida->Foto)) && (file_exists("../".$objBebida->Icono))){
                    unlink("../".$objBebida->Foto);
                    unlink("../".$objBebida->Icono);
                }
                
                
                if($objBebida->Eliminar($ID) == true){
                    setSuccessMessage("La bebida fue borrada exitosamente");
                }
                else{
                    setFailureMessage("Error, no se ha podido borrar el elemento. Es probable que sea un elemento en uso. Intente más tarde");
                }
                header("Location: ../F_A_ConsultarVinos.php");
                break;
        }

    }
}

$objEliminar = new N_EliminarElementoCatalogo();
$objEliminar->main();
