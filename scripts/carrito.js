const cuenta = {
    subTotal : 0,
    gastosEnvio : 0,
    total : 0
}


$(document).ready(function(){


   
    $('.eliminarProducto').click(function(evento){
     $.post("carrito.php", { id : this.dataset.id, borrar : true})
     location.reload();
    })

    $('.eliminarTodo').click(function(evento){
        $.post("carrito.php", { borrarTodo : true})
        location.reload();
    })   
    
    calcularTotal();

})


function calcularTotal(){
  let productosCarrito = document.querySelectorAll('.productoCarrito');
  let precioInicio = 0;
  let subTotal = document.querySelector('.subtotal');
  let gastosEnvio = document.querySelector('.gastosEnvio');
  let total = document.querySelector('.total');
  productosCarrito.forEach( producto =>{
     let cantidad = parseInt((producto.querySelector('.cantidad')).value);
     let precio = parseInt((producto.querySelector('.precio')).dataset.precio);
     console.log(typeof cantidad);
     console.log(typeof precio);

    cuenta.subTotal += (cantidad*precio);
      
    
  })

        if(cuenta.gastosEnvio >= 500){
            cuenta.gastosEnvio = 0;
        }else{
            cuenta.gastosEnvio = (cuenta.subTotal*0.1);
        }
        cuenta.total = (cuenta.subTotal + cuenta.gastosEnvio);


        subTotal.innerHTML = cuenta.subTotal;
        gastosEnvio.innerHTML = cuenta.gastosEnvio;
        total.innerHTML = cuenta.total;
  
  
}










