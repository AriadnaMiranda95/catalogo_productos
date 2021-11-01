<?php

    include_once "funciones.php";



    if(!isset($_COOKIE['politica'])){ // Si la  cookie politica no existe, te la crea. 
        setcookie("politica", "aceptada", time() + 3600); // El primer parámetro es el nombre de la cookie, el segundo es el valor, y el tercero el tiempo de vida.
    }
    mostrarDatos($productos);




?>