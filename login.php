<?php
    session_start();

    if(($_SESSION['usuario']) != 'usuario' || ($_SESSION['clave']) != 'clave'){
        header('Location: carrito.php');
    }

    if(isset($_REQUEST['login'])) {

        $usuario = $_REQUEST['usuario'];
        $clave = $_REQUEST['clave'];

        


        

        if($usuario == 'usuario' && $clave == 'clave') {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['login'] = true;

            header('Location: carrito.php');
        }else{
            echo "Usuario o contraseña no válido.";
        }
    }

?>