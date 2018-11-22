
<?php
require_once 'ConexionBD.php';

/**
 * Description of SQL_DML
 *
 * @author URIEL
 */
class SQL_DML {
    
    function Execute($query){
        $query = utf8_decode($query);
        $con= Conexion();
        $stmt = sqlsrv_query($con,$query);
        if($stmt){
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($con);        
            return true;
        }
        else
        {
            sqlsrv_close($con);        
            return FALSE;
        }

        
    }
    
    /**
     * Retorna el id para evitar crear un campo AI en la BD
     * @param string $id Recibe una consulta 
     * @example select MAX (ID) as ID from Meseros
     * @return int regresa un entero indicando el ID que con el que se ingresará el nuevo registro
     */
    function GetScalar($query){
        $con=  Conexion();
        $resultado = sqlsrv_query($con,$query);
        
        
        $row=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC);
            $resultado = $row['ID'];
        $resultado = $resultado+1;
            
        sqlsrv_close($con);        
        return $resultado;
    }
    
    
    function GetRowText($query){
        $con=  Conexion();
        $resultado = sqlsrv_query($con,$query);
        
        
        $row=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC);
            $resultado = $row['ID'];    
        sqlsrv_close($con);        
        return $resultado;
    }
    
    
    
    function CalcularFilasQuery($query){
        $con=  Conexion();
        $datos = sqlsrv_query($con,$query);
        $filas = sqlsrv_fetch_array($datos);
        return (int)$filas;
    }
            
    
    function ConsultaLogin($usuario,$contrasena,$tabla){
        $con=  Conexion();
        $query = "select Usuario, Nombre from $tabla where Usuario = '$usuario' and Contrasena = '$contrasena'";
        $datos = sqlsrv_query($con,$query);
        $columnas = sqlsrv_num_fields($datos);
        $objSQL_DML = new SQL_DML();
        $tamano = $objSQL_DML->CalcularFilasQuery($query);
        
        $resultados = "";
        if($datos){
            if($tamano>0)
            {
                while($filas = sqlsrv_fetch_array($datos)){
                    $tabla = $filas;
                        for($ContColumnas = 0; $ContColumnas<$columnas; $ContColumnas++){
                            $resultados .= $tabla[$ContColumnas]."|";
                        }
                }
                
            }
            else {
                return FALSE;
             }
            sqlsrv_free_stmt($datos);
            sqlsrv_close($con);        
            return true;
        }
        else
            return FALSE;
    }
    
    /**
     * 
     * @param String $query -Una consulta SQL para obtener datos
     * @return string - Regresa el resultado de una consulta separando filas por ° y columnas por |
     */
    function ConsultarTabla($query){
        $con = Conexion();
        $datos = sqlsrv_query($con,$query);
        $tabla = array();
        $resultados="";
        $objSQL = new SQL_DML();
        $objSQL->CalcularFilasQuery($query);
        $columnas = sqlsrv_num_fields($datos);
        
        while($filas = sqlsrv_fetch_array($datos)){
            $tabla = $filas;
            
            for($ContColumnas = 0; $ContColumnas<$columnas; $ContColumnas++){

                if($ContColumnas == $columnas-1){
                        $resultados .= $tabla[$ContColumnas] . "°";
                    }
                    
                    else  {
                        $resultados .= $tabla[$ContColumnas] . "|";
                    }
                }
            }
                return ($resultados);
    }
}
