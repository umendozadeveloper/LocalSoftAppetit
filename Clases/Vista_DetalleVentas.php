<?php
include_once  'SQL_DML.php';

class Vista_DetalleVentas {
    
    public $IdComanda;
    public $IdPlatillo;
    public $IdVino;
    public $Descripcion;
    public $Cantidad;
    public $PrecioCarta;
    public $PrecioSinIva;
    public $IVA;
    public $SubTotal;
    public $Total;
    private $Conexion;
    
    public function ObtenerDetallePlatillo($IdComanda)
    {
        $this->Conexion = Conexion();
        $this->IdComanda = $IdComanda;
        $query = "select ComandaPlatillos.IdPlatillo, Platillos.Nombre, "
                . " ComandaPlatillos.Cantidad," 
                . " Platillos.Precio, Platillos.Iva "
                . " from ComandaPlatillos  join Platillos "
                . " on ComandaPlatillos.IdPlatillo = Platillos.ID "
                . " where ComandaPlatillos.IdComanda = '$this->IdComanda'";
        $Platillos = array();
        echo $query;
        $valor = sqlsrv_query($this->Conexion, $query);
        
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $objPlatillos = new Vista_DetalleVentas();
            $objPlatillos->IdPlatillo = utf8_encode($Datos['IdPlatillo']);
            $objPlatillos->Descripcion = utf8_encode($Datos['Nombre']);
            $objPlatillos->Cantidad = utf8_encode($Datos['Cantidad']);
            $objPlatillos->PrecioCarta = utf8_encode($Datos['Precio']);
            $objPlatillos->IVA = utf8_encode($Datos['Iva']);
            array_push($Platillos, $objPlatillos);
        }
        return $Platillos;
    }
    
    public function ObtenerDetalleVino($IdComanda)
    {
        $this->Conexion = Conexion();
        $this->IdComanda = $IdComanda;
        $query = "select ComandaVinos.IdVino, Vinos.Nombre,
       ComandaVinos.CantidadBotellas,
                 Vinos.PrecioBotella, Vinos.Iva, ComandaVinos.CantidadCopas, Vinos.PrecioCopa, 
                 Vinos.PrecioCopa, ComandaVinos.CantidadCopas  
                 from ComandaVinos  join Vinos 
                 on ComandaVinos.IdVino = Vinos.ID 
                 where ComandaVinos.IdComanda='$this->IdComanda'";
        $Vinos = array();
        echo $query;
//        $Vinos ="";
        
        $valor = sqlsrv_query($this->Conexion, $query);
        
        while($Datos = sqlsrv_fetch_array($valor))
        {
            $objVinos = new Vista_DetalleVentas();
            $objVinos->IdVino = utf8_encode($Datos['IdVino']);
            $objVinos->Descripcion = utf8_encode($Datos['Nombre']);
           
 //♦♦♦♦♦♦♦♦♦♦♦
            #El consumo es en botellas
            if($Datos['CantidadCopas']=="0" && $Datos['CantidadBotellas']!="0"){
                $objVinos->Cantidad = utf8_encode($Datos['CantidadBotellas']);
                $objVinos->PrecioCarta = utf8_encode($Datos['PrecioBotella']);
            }
            #el consumo es en copas
            elseif ($Datos['CantidadCopas']!="0" && $Datos['CantidadBotellas']=="0") {
                $objVinos->Cantidad = utf8_encode($Datos['CantidadCopas']);
                $objVinos->PrecioCarta = utf8_encode($Datos['PrecioCopa']);
            }
            #el consumo es botellas y copas
            elseif ($Datos['CantidadCopas']!="0" && $Datos['CantidadBotellas']!="0"){
                $objVinos->Cantidad = "1";
                $objVinos->PrecioCarta = $Datos['CantidadCopas']*$Datos['PrecioCopa'] 
                        + $Datos['CantidadBotellas']*$Datos['PrecioBotella'];
            }
            
           
            
            $objVinos->IVA = utf8_encode($Datos['Iva']);
            array_push($Vinos, $objVinos);
        }
        return $Vinos;
    }
}
