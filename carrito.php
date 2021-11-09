<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="scripts/funciones.js"></script>
    <title>Carrito de la compra</title>
</head>
<body>
<h1>MiShop</h1>
<?php
    session_start();
    include_once 'funciones.php';
    
   if(isset($_REQUEST['id'])) { // Comprobamos que el id exista // Comprobamos que nos pasan el id de un producto.
        $id = $_REQUEST['id']; // Introducimos dentro de la variable $id el id recogido de los productos.
        $_SESSION['carrito'][$id] = $id; // Añadimos la propiedad carrito al array de $_SESSION y le decimos que el valor de la primera posición es el id del producto y su valor es igual al id de los productos.
        
        

   }else{
        chequearLogin(); // En primer lugar pondremos la fucion de chequearLogin ya que la primera condición es que ya hayamos iniciado sesión.
        if(isset($_SESSION['login']) && $_SESSION['login'] === true){ // Comprobamos que exista el login y que sea verdadero.
           
            productosCarrito($productos);
            
        }else{
            //En caso de que no se cumpla la condición de que se haya iniciado sesión, entramos en éste else.
            mostrarLogin(); // Llamamos a la función mostrarLogin() que nos muestra el formulario de inicio de sesión. 

            var_dump($_REQUEST);
        }

   }


?>

</body>
</html>



