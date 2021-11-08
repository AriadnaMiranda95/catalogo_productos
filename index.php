<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="php, nyx"/>
    <meta name="author" content="Ariadna Miranda Santana" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="scripts/funciones.js"></script>
    
    <title>MiShop</title>
</head>
<body> 
     <nav>
          <h1>MiShop</h1>
          <a href="carrito.php"><i class="fas fa-shopping-cart"></i></a>
    </nav>
    

    <main>
        <article class="productos">
            <?php
                include_once 'funciones.php';
                session_start();

                var_dump($_SESSION);

                
                
                if(!isset($_COOKIE["politica"])) {
                    politicaCookies();
                }else{
                    mostrarDatos($productos);
                }


                
            ?>
        </article>
    



        <div class="politica_rechazada"> 
            <h1>Usted ha rechazado la política de cookies</h1>
            <p>Lo sentimos, usted ha rechazado las cookies, con los cual no podrá acceder al contenido de ésta página. En caso de querer visualizar la web, por favor acepte las cookies.</p>
            <input type="button" value="Volver atrás" class="volver">
        </div>
        
        <div class = "vistos">
            <?php
                mostrarVistos($productos);
            ?>
        </div>

        <div class = "favoritos">
            <?php
                mostrarFavoritos($productos)
            ?>
        </div>


        

    </main>

    
</body>
</html>