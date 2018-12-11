<?php
include_once  'SQL_DML.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductoCompuesto
 *
 * @author umend
 */
class ProductoCompuesto {
    public $IDProductoCompuesto;    
    public $IdProducto;
    public $IdTipoProducto;
    public $IdSubProducto;
    public $IdTipoSubProducto;
    public $Cantidad;
    
    
   


    public function obtenerId(){
        $objSQL = new SQL_DML();
        return $resultado = $objSQL->GetScalar("select MAX (IDProductoCompuesto) as ID from ProductoCompuesto");
    }
    
    public function Insertar($IdProducto,$IdTipoProducto,$IdSubProducto, $IdTipoSubProducto, $Cantidad ) 
    {
        $this->IdProducto = $IdProducto;
        $this->IdTipoProducto = $IdTipoProducto;
        $this->IdSubProducto = $IdSubProducto;
        $this->IdTipoSubProducto = $IdTipoSubProducto;
        $this->Cantidad = $Cantidad;        
        $objSQL = new SQL_DML();
        
        $query = "INSERT INTO [ProductoCompuesto]
           ([IdProducto]
           ,[IdTipoProducto]
           ,[IdSubProducto]
           ,[IdTipoSubProducto]
           ,[Cantidad])
     VALUES
           ($this->IdProducto
           ,$this->IdTipoProducto
           ,$this->IdSubProducto
           ,$this->IdTipoSubProducto
           ,$this->Cantidad)";
       
                
        if ($objSQL->Execute($query)) {            
            return true;
        } else {
            return FALSE;
        }
    }
    
    public function ConsultarPorIDProducto_IDTipo($IdProducto, $IdTipo){
        $con = Conexion();
        $query = "SELECT CPP.IDProductoCompuesto, P.Nombre, CPP.Cantidad, 'Alimento' as Tipo, CPP.IdSubProducto, CPP.IdTipoSubProducto FROM Platillos P JOIN ProductoCompuesto CPP
                    ON P.ID = CPP.IdSubProducto
                    WHERE CPP.IdProducto = $IdProducto AND CPP.IdTipoProducto = $IdTipo AND CPP.IdTipoSubProducto = 0 
                    UNION 
                    SELECT CPV.IDProductoCompuesto, V.Nombre, CPV.Cantidad, 'Bebida' as Tipo,CPV.IdSubProducto, CPV.IdTipoSubProducto FROM Vinos V JOIN ProductoCompuesto CPV
                    ON V.ID = CPV.IdSubProducto
                    WHERE CPV.IdProducto = $IdProducto AND CPV.IdTipoProducto = $IdTipo AND CPV.IdTipoSubProducto = 1
                    ORDER BY TIPO";
        $productos = array();
        $valor = sqlsrv_query($con,$query);
        while($Datos = sqlsrv_fetch_array($valor)){
            $objCompuesto = new ConsultaProductoCompuesto();
            $objCompuesto->IDProductoCompuesto  = utf8_encode($Datos['IDProductoCompuesto']);
            $objCompuesto->Nombre = utf8_encode($Datos ['Nombre']);
            $objCompuesto->Cantidad = utf8_encode($Datos['Cantidad']);
            $objCompuesto->Tipo = utf8_encode($Datos['Tipo']);
            $objCompuesto->IdSubProducto = utf8_encode($Datos['IdSubProducto']);
            $objCompuesto->IdTipoSubProducto = utf8_encode($Datos['IdTipoSubProducto']);
            array_push($productos, $objCompuesto);
        }
        
        return $productos;
    }
    
    public function borradoFisicoPorIdProducto($IdProducto, $IdTipo){
            
            
            $objSQL = new SQL_DML();
        
            $query = "DELETE FROM [ProductoCompuesto]
                      WHERE IdProducto = $IdProducto AND IdTipoProducto = $IdTipo";
            if($objSQL->Execute($query))
            {
                return true;
            }
            else{
                return FALSE;
            }
    }




    //put your code here
}


class ConsultaProductoCompuesto{
    
    public $IDProductoCompuesto;   
    public $Cantidad;
    //Utilizadas para consultas cruzadas (No existen en la tabla)
    public $Nombre; 
    public $Tipo;  
    public $IdSubProducto;
    public $IdTipoSubProducto;
    //*******************************************//
}