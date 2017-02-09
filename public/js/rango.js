$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#loading').css("display","none");
    }    
});

function crear_rango_edad() {
    $('#btnregistrar').hide();
    $('#loading').css("display","block"); 
    var edad_min = $("#edad_min").val();
    var edad_max = $("#edad_max").val();
    if (parseInt(edad_max)>parseInt(edad_min)) {
    var token = $('#token').val();
        $.ajax({
            url: "rango_edad",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'json',
            data: {edad_min: edad_min, edad_max: edad_max, estado: 1},
            success: function (mensaje) {
                if (mensaje.mensaje == undefined) {
                    alertify.success("GUARDADO CORECTAMENTE");
                    $("#edad_min").val("");
                    $("#edad_max").val("");
                    setTimeout("location.href='rango'",1000);
                } else {
                    alertify.alert("ERROR", mensaje.mensaje);
                    $('#btnregistrar').show();
                    setTimeout("location.href='rango'",2000);
                }    
                $('#loading').css("display","none"); 
            }, error: function () {
                $('#loading').css("display","none");            
                alertify.alert("ERROR", "NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE"); 
                setTimeout("location.href='rango'",2000);
            },
        });    
    }
    else{
        $('#btnregistrar').show();
        $('#loading').css("display","none"); 
        alertify.alert("ERROR", "LA EDAD MAXIMA TIENE QUE SER MAYOR A LA EDAD MINIMA");
    }   
}

function eliminar_rango_edad(id, edad_min, edad_max) {
    alertify.confirm("MENSAJE", " DESEA ELIMINAR ESTE RANGO DE EDADES  EDAD MINIMA  " + edad_min + " / " + " EDAD MAXIMA " + edad_max,
    function () {
        $('#loading').css("display","block");
        var route = "eliminar_edad/" + id;
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'json',
            success: function () {
                alertify.success("ELIMINADO CORECTAMENTE");
                setTimeout("location.href='rango'",1000);
            }, error: function () {
                $('#loading').css("display","none");  
                alertify.alert("ERROR", "NO SE PUDO ELIMINAR LOS DATOS INTENTE NUEVAMENTE"); 
                setTimeout("location.href='rango'",2000);                                         
            },
        });
    },
    function () {
        alertify.error("CANCELADO");
    });
}


function crear_rango_temperatura() {
    $('#btnregistrar').hide();
    $('#loading').css("display","block");    
    var temp_min = $("#temp_min").val();
    var temp_max = $("#temp_max").val();
    if (temp_max > temp_min) {
        var token = $('#token').val();
        $.ajax({
            url: "rango_temperatura",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'json',
            data: {temp_min: temp_min, temp_max: temp_max, estado: 1},
            success: function (mensaje) {
               if (mensaje.mensaje == undefined) {
                    alertify.success("GUARDADO CORECTAMENTE");
                    $("#temp_max").val("");
                    $("#temp_min").val("");
                    setTimeout("location.href='rango'",1000);
                } else {
                    $('#btnregistrar').show();
                    alertify.alert("ERROR", mensaje.mensaje);
                    setTimeout("location.href='rango'",2000);
                }
                $('#loading').css("display","none");
            }, error: function () {
                $('#loading').css("display","none");                
                alertify.alert("ERROR", "NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
                setTimeout("location.href='rango'",2000);  
            },
        });

    }
    else{
        $('#btnregistrar').show();
        $('#loading').css("display","none");        
        alertify.alert("ERROR", "LA TEMPERATURA MAXIMA TIENE QUE SE MAYOR A LA TEMPERATURA MINIMA");
    }
}

function eliminar_rango_temperatura(id, temp_min, temp_max) {
    alertify.confirm("MENSAJE", "DESEA ELIMINAR ESTE RANGO DE TEMPERATURA TEMPERATURA MINIMA " + temp_min + " / " + " TEMPERATURA MAXIMA " + temp_max,
            function () {
                $('#loading').css("display","block");
                var route = "eliminar_temperatura/" + id;
                var hoy = new Date();
                var dd = hoy.getDate();
                var mm = hoy.getMonth() + 1; //hoy es 0!
                var yyyy = hoy.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                hoy = yyyy + '-' + mm + '-' + dd;
                $.ajax({
                    url: route,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'GET',
                    dataType: 'json',
                    data: {deleted_at: hoy},
                    success: function () {
                        $('#loading').css("display","none");
                        alertify.success("ELIMINADO CORECTAMENTE");
                        setTimeout("location.href='rango'",1000);
                    }, error: function () {
                        alertify.alert("ERROR", "NO SE PUDO ELIMINAR LOS DATOS INTENTE NUEVAMENTE");
                        $('#loading').css("display","none");
                        setTimeout("location.href='rango'",2000);  
                    },
                });
            },
            function () {
                alertify.error("CANCELADO");
            });
}