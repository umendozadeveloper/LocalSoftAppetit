<?php

include_once  'SQL_DML.php';
#Sirve para la tabla de elementos que se muestran en F_A_FacturasFiscales
class FacturaPlatillos {
    
    public $Nombre_platillo;
    public $Id_comandaPlatillo;
    public $Cantidad;
    public $Precio;
    public $Id_comanda;
    public $Folio;
   
    Public function TraerTodosPlatillosFactura(){
        
        $con = Conexion();
        $query = "Select T1.Nombre as Nombre_platillo, T2.ID as Id_comandaPlatillo, T2.Cantidad as Cantidad,
                    T2.Precio as Precio, T3.Id as Id_comanda, T3.Folio as Folio
                    From Platillos T1, ComandaPlatillos T2, Comanda T3
                    where T1.ID = T2.IdPlatillo and T2.IdComanda = T3.Id and T3.IdEstado = 1";
        $platillos_comanda = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
                $objTodosPlatillos = new FacturaPlatillos();
                $objTodosPlatillos->Nombre_platillo = utf8_encode($Datos['Nombre_platillo']);
                $objTodosPlatillos->Id_comandaPlatillo = utf8_encode($Datos['Id_comandaPlatillo']);
                $objTodosPlatillos->Cantidad = utf8_encode($Datos['Cantidad']);
                $objTodosPlatillos->Precio=utf8_encode($Datos['Precio']);
                $objTodosPlatillos->Id_comanda = utf8_encode($Datos['Id_comanda']);
                $objTodosPlatillos->Folio = utf8_encode($Datos['Folio']);
                
                array_push($platillos_comanda, $objTodosPlatillos);
            }
            return $platillos_comanda;
    }
    
 
                        
                    
    
}