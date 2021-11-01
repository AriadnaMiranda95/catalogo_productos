<?php

    $idProducto = $_REQUEST["id"];


    if(isset($_COOKIE["favoritos"]) && $_COOKIE["favoritos"] !== ""){
        $contenido = json_decode($_COOKIE["favoritos"],true) ;
        if(isset($contenido[$idProducto]) && !empty($contenido[$idProducto])){
            unset($contenido[$idProducto]);
        }else{
            $contenido[$idProducto] = "seleccionado";
        }
        $resultado = json_encode($contenido);
        setcookie("favoritos", $resultado, time() + 3600);
    }else{

        $contenido[$idProducto] = "seleccionado";
        $resultado = json_encode($contenido);
        setcookie("favoritos", $resultado, time() + 3600);

    }
?>