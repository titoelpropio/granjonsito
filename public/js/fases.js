$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);
        $('#loading').css("display","none");
    }    
});

function crear_fase(){
    $('#btnregistrar').hide();
    $('#loading').css("display","block");
    var numero = $("#numero").val();
    var nombre = $("#nombre").val();
    var token = $("#token").val();
    $.ajax({
        url: "fases",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {numero:numero, nombre: nombre},
        success: function () {
            $('#loading').css("display","none");
            alertify.success("GUARDADO CORECTAMENTE");
            location.reload();
        },
        error: function () {
            $('#btnregistrar').show();
            $('#loading').css("display","none");
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE"); 
        },
    });
}

