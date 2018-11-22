<?php

include_once  'SQL_DML.php';
#Sirve para la tabla de elementos que se muestran en F_A_FacturasFiscales
class FacturaBebidas {
    
    public $Nombre_bebida;
    public $Id_comandaBebida;
    public $Cantidad_copas;
    public $Precio_copas;
    public $Cantidad_botellas;
    public $Precio_botellas;
    public $Id_comanda;
    public $Folio;
   
    Public function TraerTodasBebidasFactura(){
        
        $con = Conexion();
        $query = "Select T3.Id as Id_comanda, T3.Folio as Folio, T4.ID as Id_comandaBebida, T4.CantidadCopas as Cantidad_copas,
                T4.PrecioCopa as Precio_copas, T4.CantidadBotellas as Cantidad_botellas,
                T4.PrecioBotella as Precio_botellas, T5.Nombre as Nombre_bebida
                From Comanda T3, ComandaVinos T4, Vinos T5
                where T3.Id = T4.IdComanda and T4.IdVino = T5.ID and T3.IdEstado=1";
        $bebidas_comanda = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objTodosBebidas = new FacturaBebidas();
                $objTodosBebidas->Nombre_bebida = utf8_encode($Datos['Nombre_bebida']);
                $objTodosBebidas->Id_comandaBebida = utf8_encode($Datos['Id_comandaBebida']);
                $objTodosBebidas->Cantidad_botellas = utf8_encode($Datos['Cantidad_botellas']);
                $objTodosBebidas->Cantidad_copas = utf8_encode($Datos['Cantidad_copas']);
                $objTodosBebidas->Precio_copas=utf8_encode($Datos['Precio_copas']);
                $objTodosBebidas->Precio_botellas=utf8_encode($Datos['Precio_botellas']);
                $objTodosBebidas->Id_comanda = utf8_encode($Datos['Id_comanda']);
                $objTodosBebidas->Folio = utf8_encode($Datos['Folio']);
                
                array_push($bebidas_comanda, $objTodosBebidas);
            }
            return $bebidas_comanda;
    }
    
 
                        
                    
    
}