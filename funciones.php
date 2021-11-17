<?php
  
  //politicaCookies();

    function getDatos($fichero) {
        $datosJson = file_get_contents($fichero); // Convierte un fichero completo a una cadena de texto.
        $datosArray = json_decode($datosJson, true);// Decodifica un string de JSON. El true nos indica que será un array asociativo.
        return $datosArray;
    }
    
    $productos = getDatos("json/productos.json");  
    $paises =  getDatos("json/paises.json");
    $provincias = getDatos("json/provincias.json");
    $tiposVia = getDatos("json/vias.json");

    function mostrarDatos($productos) {
        
            foreach($productos as $producto){
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

// LOGIN DE LA PÁGINA

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
                echo "<p> Los datos introducidos son incorrectos </p>";
            }
        }
    }



// FUNCIONES CARRITO

    function mostrarProductosCarrito($productos) {
       if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
           
            foreach($_SESSION['carrito'] as $posicion => $productoCarrito) {
               
                echo "<div class='productoCarrito'>";
                echo "<img src='{$productos[$posicion]['imagen']}' id='{$productos[$posicion]['id']}'>";
                echo "<section class='info'>";
                echo "<p class='precio' data-precio={$productos[$posicion]['precio']}> {$productos[$posicion]['precio']} </p>";
                $claseCorazon = actualizarCorazon($productos[$posicion]['id']);            
                echo "<i class='fa-heart {$claseCorazon}' data-id='{$productos[$posicion]['id']}'></i>";
                echo "</section>";
                echo "<p class='nombre'>{$productos[$posicion]['nombre']}</p>";
                echo "<input type='number' class='cantidad' min='1' value='1'>";
                echo "<input type='button' value='Eliminar' class='eliminarProducto' data-id={$posicion}>";
                echo "</div>";
                

            }

            echo "<div class='precioTotal'>";
            echo "<p>Subtotal: <span class='subtotal'></span> </p>";
            echo "<p>Gastos de envío: <span class='gastosEnvio'></span> </p>";
            echo "<p>TOTAL: <span class='total'></span> </p>";
            echo "</div>";
            echo "<a href='tramitar.php'><input type='button' value='Tramitar compra' class='tramitarCompra'></a>";
            echo "<input type='button' value='Eliminar todo' class='eliminarTodo'>";

           
       }else{
           echo "<div class='sinProductos'>";
           echo "<p> Aún no has añadido ningún producto al carrito.</p>";
           echo "<a href='index.php' class='volver'><p> Seguir comprando. </p></a>";
           echo "</div>";
       }
    }

    // FUNCIONES TRAMITES

    $DATOS_OBLIGATORIOS = [
        "nombre" => "",
        "apellido1" => "",
        "apellido2" => "",
        "fijo" => "",
        "indicación" => "",
        "paises" => getDatos("./json/paises.json"),
        "provincias" => getDatos("./json/provincias.json"),
        "localidad" => "",
        "codigo_postal" => "",
        "via" => ["avenida","calle","carretera","otros"],
        "nombre_via" => ""
    ];


    function crearSelect($array,  $idOpcion,  $nombreOpcion, $nombreSelect, $label){
        echo "<section>";
        echo "<label for='{$nombreSelect}'>{$label}*</label>";
        echo "<select name='{$nombreSelect}' id='{$nombreSelect}'>";
        foreach($array as $dato) { 
            echo "<option value='{$dato[$idOpcion]}'> {$dato[$nombreOpcion]}</option>"; 
        }
        echo "</select>";
        echo "</section>";
    }

    function mostrarFormulario($paises, $provincias, $tiposVia){
        echo "<form action='{$_SERVER['PHP_SELF']}' method='POST'>";
        echo "<h1 class='enviarDomicilio'> ENVIAR A DOMICILIO </h1>";
        echo "<h2 class='personaContacto'> Persona de contacto </h2>";
        echo "<div class='datosContacto'>";
        echo "<p class='apartado'>Nombre (*)</p>";
        echo "<input type='text' name='nombre' id='nombre' value='".comprobarSiExiste('nombre') ."'required>";
        echo "<p class='apartado'>Primer apellido (*)</p>";
        echo "<input type='text' name='apellido1' id='apellido1' value='".comprobarSiExiste('apellido1') ."'required>";
        echo "<p class='apartado'>Segundo apellido (*)</p>";
        echo "<input type='text' name='apellido2' id='apellido2' value='".comprobarSiExiste('apellido2') ."'required>";
        echo "<p class='apartado'>Teléfono fijo (*) </p>";
        echo "<input type='text' name='fijo' id='fijo' value='".comprobarSiExiste('fijo') ."' required>";
        echo "<p class='apartado'>Indicaciones (*) </p>";
        echo "<input type='text' name ='indicacion' value='".comprobarSiExiste('indicacion') ."' required>";
        echo "</div>";
        echo "<h2 class='datosPersonales'> Datos personales </h2>";
        crearSelect ($paises,'paises', 'name_es', 'paises','País');
        crearSelect($provincias,'provincias', 'nm' , 'provincias' ,'Provincia');
        echo "<p class='apartado'>Localidad (*)</p>";
        echo "<input type='text' name='localidad' id='localidad' value='".comprobarSiExiste('localidad') ."'required>";
        echo "<p class='apartado'>Codigo postal (*)</p>";
        echo "<input type='text' name='codigo_postal' id='codigo_postal' value='".comprobarSiExiste('codigo_postal') ."' required>";
        crearSelect($tiposVia, 'vias', 'via', 'via', 'Tipo de vía');
        echo "<p class='apartado'>Nombre de vía (*) </p>";
        echo "<input type='text' name='nombre_via' id='nombre_via' value='".comprobarSiExiste('nombre_via') ."' required>";
        echo "<a href='carrito.php'><input type='button' value='Volver' class='volver' ></a>";
        echo "<input type='submit' value='Comprar' name='comprar' class='comprarProducto'>";
        echo "</fieldset></form>";
        
       

    }



    
    // VALIDAR FORMULARIO DE TRAMITES
    
    function comprobarCamposVacios($DATOS_OBLIGATORIOS) {
        $camposVacios = [];
        $datosFormulario = $_POST;

        foreach($DATOS_OBLIGATORIOS as $posicion => $dato) {
            if(!array_key_exists($posicion, $datosFormulario) || empty($datosFormulario[$posicion])) {
                array_push($camposVacios,"<p class='error'>El campo <span>{$posicion}</span> está vacío</p>");
            }
        }
        return $camposVacios;
    }


    function comprobarString($texto,$minLength,$maxLength) {

        if(strlen($texto) < $minLength || strlen($texto) > $maxLength) {
            return false;
        }
        for($i = 0 ; $i < strlen($texto); $i++) {
            if(ctype_digit($texto[$i])){
                return false;
            }
        }
        return true;
    }

    function comprobarSiExiste($nombre){
        $comprobado =  isset($_REQUEST[$nombre]) ? $_REQUEST[$nombre] : '';
        return $comprobado;
    }
    
    function comprobarSelect($nombre, $condicion, $valor, $valor2){
        $resultado =  isset($_REQUEST[$nombre]) && $_REQUEST[$nombre] == $condicion ? $valor : $valor2;
        return $resultado;
    }
    
    function comprobarDatosObligatorios($DATOS_OBLIGATORIOS) {
        $camposErroneos = [];
        foreach($_POST as $clave => $dato){
            $dato = htmlspecialchars(trim($dato));
            switch($clave){
                case "nombre":
                    comprobarString($dato,3,30) ? ' ' : array_push($camposErroneos,"<p class='error'>Introduce un <span>nombre</span> válido</p>");
                    break;
                case "apellido1":
                    comprobarString($dato,3,30) ? ' ' : array_push($camposErroneos,"<p class='error'>Introduce un <span>apellido</span> válido</p>");
                    break;
                case "apellido2":
                    comprobarString($dato,3,30) ? ' ' : array_push($camposErroneos,"<p class='error'>Introduce un <span>apellido</span> válido</p>");
                    break;
                case "fijo":
                    is_numeric($dato) && strlen($dato) >= 7 && strlen($dato) <= 15 ? '' :array_push($camposErroneos,"<p class='error'>Introduce un <span>número de teléfono</span> correcto</p>");
                    break;
                case "localidad":
                    comprobarString($dato,5,50) ? ' ' : array_push($camposErroneos,"<p class='error'>Introduce una <span>localidad</span> válida</p>");
                    break;
                case "codigo_postal" : 
                    is_numeric($dato) && ctype_digit($dato) && strlen($dato) === 5 ? ' ' : array_push($camposErroneos,"<p class='error'>Introduce un <span>código postal</span> válido</p>");
                    break;
                case "indicacion" : 
                    comprobarString($dato, 1, 20) ? '' : array_push($camposErroneos ,"<p class='error'>Introduce un <span>complemento</span> correcto</p>");
                    break;
            }
        }  
        return $camposErroneos; 
    }
    
    function mostrarCamposErroneos($array){
        echo "<div class='errores'>";
        foreach($array as $dato){
            echo $dato;
        }
        echo "</div>";
    }

    function crearSeccion($titulo,$contenidos){
        echo "<section>";
        echo "<h3>{$titulo}</h3>";
        foreach($contenidos as $contenido){
            echo $contenido;
        }
        echo "</section>";
    
    }

    function cestaResumen($productos){
        

    }

    function compraFinalizada(){
       echo "<div class='compraFinalizada'>";
       echo "<p> Su compra se ha realizado satisfactoriamente. </p>";
       echo "<a href='index.php' class='volver'><p> Seguir comprando. </p></a>";
       echo "</div>"; 

    }

                     

                    
  
?>