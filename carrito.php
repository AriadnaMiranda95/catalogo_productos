<?php
    session_start();
    include_once 'funciones.php';
    
   if(isset($_REQUEST['id'])) { // Comprobamos que el id exista
        $id = $_REQUEST['id']; // Introducimos dentro de la variable $id el id recogido de los productos.
        $_SESSION['carrito'][$id] = $id; // Añadimos la propiedad carrito al array de $_SESSION y le decimos que el valor de la primera posición es el id del producto y su valor es igual al id de los productos.
        
        

   }else{
    chequearLogin(); // En primer lugar pondremos la fucion de chequearLogin ya que la primera condición es que ya hayamos iniciado sesión.
    if(isset($_SESSION['login']) && $_SESSION['login'] === true){ // Comprobamos que exista el login y que sea verdadero.
        echo "Has iniciado sesión.";
    }else{
        //En caso de que no se cumpla la condición de que se haya iniciado sesión, entramos en éste else.
        mostrarLogin(); // Llamamos a la función mostrarLogin() que nos muestra el formulario de inicio de sesión. 
        //Aquí llamamos a la función de crear productos.
        var_dump($_REQUEST);
    }

   }


?>