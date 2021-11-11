$(document).ready(function(){


   
    $('.eliminarProducto').click(function(evento){
     $.post("carrito.php", { id : this.dataset.id, borrar : true})
     location.reload();
    })

    $('.eliminarTodo').click(function(evento){
        $.post("carrito.php", { borrarTodo : true})
        location.reload();
    })    

   

     
     

})







