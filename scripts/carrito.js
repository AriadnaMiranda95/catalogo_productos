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
    
    $('.cantidad').change(function(evento){

        calcularTotal();

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
     
    precioInicio += (cantidad*precio);
      
    
  })

  cuenta.subTotal = precioInicio;

        if(cuenta.subTotal >= 500){
            cuenta.gastosEnvio = 0;
        }else{
            cuenta.gastosEnvio = (cuenta.subTotal*0.1);
        }
        cuenta.total = (cuenta.subTotal + cuenta.gastosEnvio);


        subTotal.innerHTML = cuenta.subTotal;
        gastosEnvio.innerHTML = (cuenta.gastosEnvio).toFixed(2);
        total.innerHTML = cuenta.total;
  
  
}










