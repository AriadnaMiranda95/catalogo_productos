<?php
  
  //politicaCookies();

    function getDatos($fichero) {
        $datosJson = file_get_contents($fichero); // Convierte un fichero completo a una cadena de texto.
        $datosArray = json_decode($datosJson, true);// Decodifica un string de JSON. El true nos indica que será un array asociativo.
        return $datosArray;
    }
    
    
   $productos = getDatos("json/productos.json");  

    function mostrarDatos($productos) {
        
            foreach($productos as $producto) {
                echo "<div class='producto'>";
                echo "<a href='{$producto['ruta']}?id={$producto['id']}'> <img src='{$producto['imagen']}' alt='{$producto['nombre']}'></a> "; // Le estamos añadiendo al enlace tanto la ruta del producto, como el id que tiene cada producto
                echo "<section class='info'>";
                echo "<p class='precio'>{$producto['precio']}</p>";
                $claseCorazon = actualizarCorazon($producto['id']);
                echo "<i class='fa-heart {$claseCorazon}' data-id='{$producto['id']}'></i>";
                echo "</section>";
                echo "<a href='{$producto['ruta']}?id={$producto['id']}' >{$producto['nombre']} </a>" ;
                echo "<p class='descripcion'>{$producto['descripcion']}</p>";
                echo " <section>";
                echo "<a href='#'><i class='fas fa-shopping-cart' data-id='{$producto['id']}'></i></a>";   
                echo " </section>";
                echo "</div>";
            }
        
    }
    

   

    function politicaCookies() {
        echo "<div class='politicaCookies'>";
            echo "<h1> Uso de cookies</h1>";
            echo "<p> Utilizamos cookies propias y de terceros para mejorar nuestros servicios y mostrarle publicidad relacionada con sus preferencas mediante el análisis de sus hábitos de navegación. Si continúa navegando, consideraremos que acepta su uso.</p>";
            echo "<section class='botones'>";
            echo "<a href='index.php?politica=aceptada' id='aceptar'>Aceptar</a>";
            echo "<a href='#' id='rechazar'> Rechazar </a>";
            echo "</section>";
        echo "</div>";
    }



    function mostrarProducto($productos, $producto_id) {
        $producto = $productos[$producto_id];
       
        echo "<a href='index.php'><i class='fas fa-chevron-circle-left'></i></a>";
        echo "<div class = 'producto'>";
            echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}'> ";
            echo "<section class='info'>";
            echo "<p class='precio'>{$producto['precio']}</p>";
            $claseCorazon = actualizarCorazon($producto['id']);
            echo "<i class='fa-heart {$claseCorazon}' data-id='{$producto['id']}'></i>";
            echo "</section>";
            echo "<p class='nombre'>{$producto['nombre']}</p>";
            echo  "<p class='descripcion'>{$producto['descripcion']}</p>";
        echo "</div>";

    }


    function contadorVisitas($idProducto) {
     
        if(isset($_COOKIE['visitas'])) {
            $vistos = json_decode($_COOKIE['visitas'], true) ; // Convertimos el valor de la cookie visitas a array asociativo. El valor true indica si queremos que el array resultante sea asociativo.
            
            if(isset($vistos[$idProducto])) {
                $vistos[$idProducto]++;
            }else{
                $vistos[$idProducto] = 1;
            }

            $conversionString = json_encode($vistos);
            setcookie("visitas", $conversionString, time() + 3600); 

        }else{
            $vistos[$idProducto] = 1; // El primer valor del array será el primer producto que meta en la posición idProducto
            $conversionString = json_encode($vistos); // Pasa el array asociativo a string json.
            setcookie("visitas", $conversionString, time() + 3600); // Aqui creamos la cookie le pasamos el nombre, el valor y el tiempo de vida.
        }
        
    }

    function mostrarVistos($productos) {

        if(isset($_COOKIE['visitas']) && !empty($_COOKIE['visitas'])) {
            $visitados = json_decode($_COOKIE["visitas"],true);
            echo "<h2>Vistos</h2>";
            foreach($visitados as $posicion => $visitado) {
                    $producto = $productos[$posicion];
                    echo "<div class='productoVisto'>";
                    echo "<a href='{$producto['ruta']}?id={$producto['id']}' ><img src='{$producto['imagen']}' alt='{$producto['nombre']}'></a>";
                    echo "<p class='precio'>{$producto['precio']}</p>";
                    echo "<a href='{$producto['ruta']}?id={$producto['id']}' class='nombre'>{$producto['nombre']}</a>";
                    echo "<p> Veces visitado:{$visitado}</p>";
                    echo "</div>";
            }
        }
    }

    function mostrarFavoritos($productos) {
        if(isset($_COOKIE["favoritos"])) {
            $favoritos = json_decode($_COOKIE["favoritos"],true);
            echo "<h2>Productos favoritos</h2>";
            foreach($favoritos as $clave => $favorito) {
                echo "<article class='favoritos'>";
                $producto = $productos[$clave];
                echo "<a href='{$producto['ruta']}?id={$producto['id']}'><img src='{$producto['imagen']}'></a>";
                echo "<a href='{$producto['ruta']}?id={$producto['id']}'>{$producto['nombre']}</a>";
                echo "<span>{$producto['precio']} </span>";
                echo "</article>";
            }

        }
     }


     function actualizarCorazon($idProducto) {
        $resultado = 'far';
        if(isset($_COOKIE["favoritos"])){
            $favoritos = json_decode($_COOKIE["favoritos"],true);
            $resultado = array_key_exists($idProducto,$favoritos) ? "fas" : "far";
        }
        return $resultado;
    }


    function mostrarLogin() {
        echo "<div class='login'>";
        echo "<p>LOGIN</p>";
        echo "<form action='{$_SERVER['PHP_SELF']}' method='post'>";
        echo "<p>CORREO ELECTRÓNICO *</p>";
        echo "<input type='text' name='usuario' placeholder='Direccion de email'>";
        echo "<p>CONTRASEÑA *</p>";
        echo "<input type='password' name='clave' placeholder='Minimo 6 caracteres'>";
        echo "<input type='submit' value='ACCEDER' class='acceder'>";
        echo "</form>";
        echo "</div>";
    }

    function chequearLogin() {
        if(isset($_REQUEST) && !empty($_REQUEST)){
            if($_REQUEST['usuario'] == 'usuario' && $_REQUEST['clave'] == 'clave') {
                $_SESSION['usuario'] = $_REQUEST['usuario'];
                $_SESSION['login'] = true;

            }else{
                echo "Los datos introducidos son incorrectos";
            }
        }
    }

    function mostrarProductosCarrito($productos) {
       if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
           
            foreach($_SESSION['carrito'] as $posicion => $productoCarrito) {
               
                echo "<div class='productoCarrito'>";
                echo "<img src='{$productos[$posicion]['imagen']}' id='{$productos[$posicion]['id']}'>";
                echo "<section class='info'>";
                echo "<p class='precio'> {$productos[$posicion]['precio']} </p>";
                $claseCorazon = actualizarCorazon($productos[$posicion]['id']);            
                echo "<i class='fa-heart {$claseCorazon}' data-id='{$productos[$posicion]['id']}'></i>";
                echo "</section>";
                echo "<p class='nombre'>{$productos[$posicion]['nombre']}</p>";
                echo "<input type='number' name='cantidad' class='cantidad' min='1'>";
                echo "<input type='button' value='Eliminar' class='eliminarProducto' data-id={$posicion}>";
                echo "</div>";
                

            }

            echo "<div class='precioTotal'>";
            echo "<p>Subtotal: </p>";
            echo "<p>Gastos de envío: </p>";
            echo "<p>TOTAL: </p>";
            echo "</div>";
            echo "<input type='button' value='Tramitar compra' class='tramitarCompra'>";
            echo "<input type='button' value='Eliminar todo' class='eliminarTodo'>";

           
       }else{
           echo "<div class='sinProductos'>";
           echo "<p> Aún no has añadido ningún producto al carrito </p>";
           echo "</div>";
       }
    }



  
    
    
    
    
  
?>