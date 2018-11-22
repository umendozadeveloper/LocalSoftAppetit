<?php


function Conexion()
{

		$serverName = "LAPTOP-UMR\SQLEXPRESS";
        $conInfo = array("Database"=>"SoftAppetit","UID"=>"sa","PWD"=>"Interpc100");
		
		$con = sqlsrv_connect( $serverName, $conInfo);
        
        if( $con ) 
        {
            return $con;
        }
        else
        {
            
            $_SESSION['error_Conexion']=1;
            header("Location: Error_Servidor.php");
        
            
        }
        
}             
?>




