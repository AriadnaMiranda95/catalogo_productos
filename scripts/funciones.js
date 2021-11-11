
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
            $(".productos").append(datos);
            $('.politicaCookies').css("display", "none");
            location.reload();
        })
    })

    $(".fa-heart").click(function(evento) {
        $(this).toggleClass("far fas");
        $.post("favoritos.php", {id : this.dataset.id});   
    })
    
    $(".fa-shopping-cart").click(function(evento){
        $.post("carrito.php", { id : this.dataset.id });
    })

})