<?php
        session_start();

        unset($_SESSION['usuario']);
        unset($_SESSION['login']);

        header("Location: login.php");

?>