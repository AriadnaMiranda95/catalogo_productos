$(document).ready(function() {
   
   
    $.getJSON("json/provincias.json", function (data) { 
        provincias = data;
    });


    $("#paises").change(function () {
        $('#provincias').empty();

        $.each(provincias, function(indice, dato) {
            if ($("#paises").val() == "ES") {
                $('#provincias').append($('<option></option>').attr('value', dato.id).text(dato.nm));
            }
        })
    })

    
})


