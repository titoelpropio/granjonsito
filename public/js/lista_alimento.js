
var intervalo=setInterval('obtener_temp()',300000);

$(document).ready(function(){
    $('#loading').css("display","none");
});

function obtener_temp(){
 var token = $("#token").val(); 
      $.ajax({
        url: "mostrar_tem",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        success: function (response) {
           if ($("#temperatura").text() != (response[0].temperatura)) {
                $("#temperatura").text(response[0].temperatura);  
                actualizar_control_alimento();
                actualizar_control_alimento_cria();
            } 
        }
    });
}

function actualizar_control_alimento(){
 $('#loading').css("display","block");  
 var temperatura=parseInt($('#temperatura').text());
 var token = $("#token").val(); 
    $.ajax({
        url: "actualizar_control_alimento",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data:{temperatura:temperatura},
        success: function (response) {  
            for (var i = 0; i < response.length; i++) {
                if (response[i].length!=undefined) {
                    if ($('#id_alimento'+response[i][0].numero).attr('data-status')==1) {
                        y=parseFloat(parseFloat($('#cant_actual'+response[i][0].numero).text()));
                        $('#id_alimento'+response[i][0].numero).text(response[i][0].tipo);
                        var x = parseFloat(y) * parseFloat(response[i][0].cantidad);
                        $('#cantidad_g'+response[i][0].numero).text( x.toFixed(1) );
                    } 
                }
                else{
                    if ($('#id_alimento'+response[i]).attr('data-status')==1) {
                        $('#id_alimento'+response[i]).text("");
                        $('#cantidad_g'+response[i]).text("0");
                    }
                }
            }
            $('#loading').css("display","none");  
        }
    });
}

function actualizar_control_alimento_cria(){
 $('#loading').css("display","block");  
 var temperatura=parseInt($('#temperatura').text());
 var token = $("#token").val(); 
    $.ajax({
        url: "actualizar_control_alimento_cria",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data:{temperatura:temperatura},
        success: function (response) {
            for (var i = 0; i < response.length; i++) {
                if (response[i].length!=undefined) {
                    if ($('#id_alimento_c'+response[i][0].numero).attr('data-status')==1) {
                        y=parseFloat(parseFloat($('#cant_actual_c'+response[i][0].numero).text()));
                        $('#id_alimento_c'+response[i][0].numero).text(response[i][0].tipo);
                        var x = parseFloat(y) * parseFloat(response[i][0].cantidad);
                        $('#cantidad_g_c'+response[i][0].numero).text( x.toFixed(1) );
                    }
                }
                else{
                    if ($('#id_alimento_c'+response[i][0].numero).attr('data-status')==1) {
                        $('#id_alimento_c'+response[i]).text("");
                        $('#cantidad_g_c'+response[i]).text("0");
                    }
                }
            }
            $('#loading').css("display","none");  
        }
    });
}
