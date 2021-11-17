<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilosTramitar.css">
    <script src="scripts/tramite.js"></script>
    <title>Document</title>
</head>
<body>
   
<?php

include_once 'funciones.php';



$DATOS_OBLIGATORIOS = [
    "nombre" => "",
    "apellido1" => "",
    "apellido2" => "",
    "fijo" => "",
    "indicacion" => "",
    "localidad" => "",
    "codigo_postal" => "",
    "nombre_via" => ""
];

if (isset($_POST)){
    if(count(comprobarCamposVacios($DATOS_OBLIGATORIOS)) > 0) { // contamos el número de campos vacios que contiene el array que devuelve la función.
        mostrarFormulario($paises, $provincias, $tiposVia); // si entra en esta condición, nos muestra el formulario otra vez para rellenarlos.
        $camposVacios = comprobarCamposVacios($DATOS_OBLIGATORIOS); // metemos dentro de una variable el array que devuelve la función.
        foreach($camposVacios as $campo){ // Recorremos el array que devuelve la función y comprobamos los campos.
            echo $campo;
        }

    }else{

        if(count(comprobarDatosObligatorios($DATOS_OBLIGATORIOS))> 0) {
            mostrarFormulario($paises, $provincias, $tiposVia);
            $datosObligatorios = comprobarDatosObligatorios($DATOS_OBLIGATORIOS);
            foreach($datosObligatorios as $dato){
                echo $dato;
            }
        }
        compraFinalizada();

    }

    
    

 }else{  
  //  if(isset($_REQUEST["comprar"])) crearSeccion("Datos Obligatorios incompletos",comprobarCamposVacios($DATOS_OBLIGATORIOS));
    mostrarFormulario($paises, $provincias, $tiposVia);
}
?>
    
</body>
</html>

