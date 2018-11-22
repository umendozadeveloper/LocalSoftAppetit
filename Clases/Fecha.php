<?php
include_once 'SQL_DML.php';

class Fecha{
    public $Fecha;
    
    function ObtenerFecha(){
        $con=  Conexion();
        $resultado = sqlsrv_query($con,"SELECT CONVERT (date, SYSDATETIME()) as Fecha");
        $row=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC);
        $resultado = $row['Fecha'];
        $resultado = date_format($resultado, 'Y-m-d');
        return $resultado;
    }
    function ObtenerFechaYHora(){
        $con=  Conexion();
        $resultado = sqlsrv_query($con,"SELECT GETDATE() as Fecha");
        $row=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC);
        $resultado = $row['Fecha'];
        //$fecha = $Datos['Fecha'];
        $resultado = date_format($resultado, 'd/m/Y G:i:s');
        return $resultado;
    }
    
    function RedefinirFechaYHora($fecha){
        $cadena = "";
        $fechaTMP = explode("/", $fecha);
        foreach ($fechaTMP as $f)
        {
            $cadena.= $f;
        }
        $fechaTMP = explode(":", $cadena);
        $cadena = "";
        foreach ($fechaTMP as $f)
        {
        $cadena.= $f;
        }

        $fechaTMP = explode(" ", $cadena);
        $cadena = "";
        foreach ($fechaTMP as $f)
        {
        $cadena.= $f;
        }
        return $cadena;
    }
}
?>

