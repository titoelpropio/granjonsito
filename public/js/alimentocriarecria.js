$("#registrarcria").click(function () {

    if ($('#cantidad').text() == '0') {
        $('#mensaje').attr("hidden", false);
        $('#mensaje').empty();
        $("#mensaje").append('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        $("#mensaje").append('<h2>Alerta: No puede alimentar este galpon, no existen gallinas.</h2>');
    } else {
        var idgalpon = parseInt($('#idgalpon').val());
        var cantidad_total = $("#cantidad_total").val();
        var idsilo = $("#silo option:selected").val();
        var token = $("#token").val();
        $('#mensaje').empty();
        $('#mensaje').attr("hidden", true);
        $("#mensaje").append('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        $.ajax({
            url: "consumo",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {id_galpon: idgalpon, id_silo: idsilo, cantidad: cantidad_total},
            success: function (data) {
                var b = 0;

                var mensaje = data.length;

                for (i = 0; i < data.length; i++) {
                    $('#mensaje').attr("hidden", false);

                    var mensaje = data[i];
                    for (var b in mensaje) {
                        var x = mensaje[b];
                        $("#mensaje").append('<h2>Alerta: ' + x + '</h2>');
                    }
                }
            }
        });
        $('.modal.in').modal('hide');
         location.reload();
    }
});

$('#cantidad_granel').keypress(function (e) {
    if (e.which == 13) {
        var cantidadgranel = $('#cantidad_granel').val();
        var resultado = cantidadgranel * ($('#cantidad').text());
        var resultado = resultado.toFixed(2);
        $("#cantidad_total").val(resultado+" Kg.");
    }
});

function obtenerdatoscria(galpon){
    $('#cantidad_granel').val("");
    $("#cantidad_total").val("");
    var edad = 0;
    $("#idgalpon").val(galpon);
    $("#titulogalpon").text("Galpon "+galpon);
    $("#cantidad").text($("#cantidadg"+galpon).text());
    $("#edad").text($("#edadg"+galpon).text());
    edad = parseInt($("#edad").text());
}

$(document).ready(function () {                
   $("#silo").addClass("form-control");
    
    $.get("capturasilocria", function (response) {
        for (i = 0; i < response.length; i++) {
            $("#silo").append("<option value='" + response[i].id + "'>" + response[i].nombre + "  --->  " + response[i].tipo + "</option>");
        }
    });

    for(var i=17;i<=22;i++){
        if($("#cantidadg"+i).text()=='0')
        {   $('#galpon'+i).text("NO EXISTE");
            $('#btnalimentog'+i).attr("disabled",true);
            
        }
    }
})
