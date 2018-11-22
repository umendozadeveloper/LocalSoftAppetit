<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION['usuario'])){
            echo "<script type='text/javascript'>"; 
            echo "window.location= 'LoginMesero.php '";
            echo "</script>";  
        }
        ?>
    </body>
</html>
