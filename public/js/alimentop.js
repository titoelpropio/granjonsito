

function obtenerdatos(galpon){
   
  $('#cantidad_granel').val("");
   $("#cantidad_total").val("");
    var edad = 0;
    $("#id_galpon").val(galpon);
    $("#titulogalpon").text("Galpon "+galpon);
    $("#cantidad").text($("#cantidadg"+galpon).text());
    $("#edad").text($("#edadg"+galpon).text());
    edad = parseInt($("#edad").text());
    var tipe =galpon;
    $("#fecha_p").empty();
    $("#listapostura").empty();
    $.get("capturapostura/'" + tipe + "'", function (response2) {
        for (j = 0; j < response2.length; j++) {
            $("#fecha_p").append(
                    " <td> " + response2[j].fecha + "</td>"
                    );
            $("#listapostura").append(
                    " <td> " + response2[j].postura_p + "%</td>"
                    );
        }
    });
}



$('#cantidad_granel').keypress(function (e) {
    if (e.which == 13) {
        var cantidadgranel = $('#cantidad_granel').val();
        var resultado = cantidadgranel * ($('#cantidad').text());
        var resultado = resultado.toFixed(2);
        $("#cantidad_total").val(resultado + " Kg.");
    }
});




$(document).ready(function () {
   $("#silo").addClass("form-control");
    $("#silo").append("<option value='0'>Seleccione Un Silo</option>");
    $.get("/capturasilo", function (response) {
        for (i = 0; i < response.length; i++) {
            $("#silo").append("<option value='" + response[i].id + "'>" + response[i].nombre + "  --->  " + response[i].tipo + "</option>");
        }
    });
    
    for(var i=0;i<=16;i++){
        if($("#cantidadg"+i).text()=='0')
        {
            $('#btnalimentog'+i).attr("disabled",true);
        $('#galpon'+i).text("NO EXISTE");
        }
        
    }

    var cantidad = 0;
    if (cantidad >= 0) {
        $('#tablagalpon2').attr("hidden", false);
    }
})