


$(document).ready(function() {

    $('#rechazar').click(function(evento) { // Pasamos por parámetros el evento para prevenir que se recargue la página. 
        evento.preventDefault();
        $('.politica_rechazada').css("display", "initial");
        $('.politicaCookies').css("display", "none");

    })


    $('.volver').click(function(evento) {
        $('.politicaCookies').css("display", "initial");
        $('.politica_rechazada').css("display", "none");
    })

    $('#aceptar').click(function(evento) {
        evento.preventDefault();
        $.get('controlador.php').done(function(datos){
            $("main").append(datos);
            $('.politicaCookies').css("display", "none");
        })
    })


    $(".fa-heart").click(function(evento){
        evento.preventDefault();
        $(this).toggleClass("far fas");
        
    });

})