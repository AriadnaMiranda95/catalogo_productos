<?php
  
  //politicaCookies();

    function getDatos($fichero) {
        $datosJson = file_get_contents($fichero); // Convierte un fichero completo a una cadena de texto.
        $datosArray = json_decode($datosJson, true);// Decodifica un string de JSON. El true nos indica que será un array asociativo.
        return $datosArray;
    }
    
    
   $productos = getDatos("json/productos.json");  

    function mostrarDatos($productos) {
        echo "<div id='wrapper'>";
            foreach($productos as $producto) {
                echo "<div class='producto'>";
                    echo "<a href='{$producto['ruta']}?id={$producto['id']}'> <img src='{$producto['imagen']}' alt='{$producto['nombre']}'></a> "; // Le estamos añadiendo al enlace tanto la ruta del producto, como el id que tiene cada producto
                    echo "<section class='info'>";
                        echo "<p class='precio'>{$producto['precio']}</p>";
                        echo "<i class='far fa-heart'></i>";
                    echo "</section>";
                    echo "<a href='{$producto['ruta']}?id={$producto['id']}' ><p class='nombre'>{$producto['nombre']}</p> </a>" ;
                    echo "<p class='descripcion'>{$producto['descripcion']}</p>";
                   
                echo "</div>";
            }
        echo "</div>";
    }
    
    //mostrarDatos($productos);

   

    function politicaCookies() {
        echo "<div class='politicaCookies'>";
            echo "<h1> Uso de cookies</h1>";
            echo "<p> Utilizamos cookies propias y de terceros para mejorar nuestros servicios y mostrarle publicidad relacionada con sus preferencas mediante el análisis de sus hábitos de navegación. Si continúa navegando, consideraremos que acepta su uso.</p>";
            echo "<a href='index.php?politica=aceptada' id='aceptar'>Aceptar</a>";
            echo "<a href='#' id='rechazar'> Rechazar </a>";
        echo "</div>";
    }



    function mostrarProducto($productos, $producto_id) {
        $producto = $productos[$producto_id];
       
        echo "<a href='index.php'><i class='fas fa-chevron-circle-left'></i></a>";
        echo "<div class = 'producto'>";
            echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}'> ";
            echo "<section class='info'>";
                echo "<p class='precio'>{$producto['precio']}</p>";
                echo "<i class='far fa-heart'></i>";
            echo "</section>";
            echo "<p class='nombre'>{$producto['nombre']}</p>";
            echo  "<p class='descripcion'>{$producto['descripcion']}</p>";
        echo "</div>";

    }


    function contadorVisitas() {


        if(!isset($_COOKIE['visitas'])){
            setcookie("id", "visitas", time() + 3600);
        }else{

        }
    }
    
 
  
?>