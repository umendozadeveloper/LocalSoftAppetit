<?php

include_once  'SQL_DML.php';

class LlenadoCombos {
    
//    public $query;
//    public $valor;
//    public $opcion;
    
    function LlenarCombos($query, $valor, $opcion){
        $lista= "";
        $query= utf8_decode($query);
        $con= Conexion();
        $stmt= sqlsrv_query($con,$query);


        if($stmt==TRUE){
            while( $row= sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            {
                
                    $lista .= "<option value=$row[$valor]>$row[$opcion]</option>";
            }   

        }
        sqlsrv_close($con);   
        return $lista;
    }
    
    function LlenarCombosElementoSeleccionado ($query, $valor, $opcion, $seleccionado){
        $lista= "";
        $query= utf8_decode($query);
        $con= Conexion();
        $stmt= sqlsrv_query($con,$query);
        if($stmt==TRUE){
            while( $row= sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            {
                if($row[$valor] != $seleccionado)
                {
                    $lista .= "<option value=$row[$valor]>$row[$opcion]</option>";
                }
                else 
                {
                    $lista .= "<option value=$row[$valor] selected>$row[$opcion]</option>";
                }
                    
            }   

        }
        sqlsrv_close($con);   
        return $lista;
    }
    
}


