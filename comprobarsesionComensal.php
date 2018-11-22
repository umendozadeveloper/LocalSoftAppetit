<?php

session_start();
        if (!isset($_SESSION['comensal'])){
            header("Location: LoginComensal.php");
        }
        ?>

