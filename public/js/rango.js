$(document).ready(function () {
    if ($('#token').val() == "") {
        setInterval(location.reload(), 2000);
    } else {
        $('#loading').css("display", "none");
        cargar_tabla_redad();
                cargar_tabla_rtemperatura();

    }
});

function crear_rango_edad() {
    $('#btnregistrar').hide();
    $('#loading').css("display", "block");
    var edad_min = $("#edad_min").val();
    var edad_max = $("#edad_max").val();
    if (parseInt(edad_max) > parseInt(edad_min)) {
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
                    $('#cuerpoEdad').empty();

                    $('#myModalRangoEdad').modal('hide');
                    $('#btnregistrar').show();
                    cargar_tabla_redad();
                } else {
                    alertify.alert("ERROR", mensaje.mensaje);
                    setTimeout("location.href='rango'", 2000);
                }
                $('#loading').css("display", "none");
            }, error: function () {
                $('#loading').css("display", "none");
                alertify.alert("ERROR", "NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
                setTimeout("location.href='rango'", 2000);
            },
        });
    } else {
        $('#btnregistrar').show();
        $('#loading').css("display", "none");
        alertify.alert("ERROR", "LA EDAD MAXIMA TIENE QUE SER MAYOR A LA EDAD MINIMA");
    }
}

function eliminar_rango_edad(id, edad_min, edad_max) {
    alertify.confirm("MENSAJE", " DESEA ELIMINAR ESTE RANGO DE EDADES  EDAD MINIMA  " + edad_min + " / " + " EDAD MAXIMA " + edad_max,
            function () {
                $('#loading').css("display", "block");
                var route = "eliminar_edad/" + id;
                $.ajax({
                    url: route,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'GET',
                    dataType: 'json',
                    success: function () {
                        alertify.success("ELIMINADO CORECTAMENTE");
                        $('#cuerpoEdad').empty();
                        $('#myModalRangoEdad').modal('hide');
                        cargar_tabla_redad();
                    }, error: function () {
                        $('#loading').css("display", "none");
                        $('#myModalRangoEdad').modal('hide');
                        alertify.alert("ERROR", "NO SE PUDO ELIMINAR LOS DATOS INTENTE NUEVAMENTE");
                        setTimeout("location.href='rango'", 2000);
                    },
                });
            },
            function () {
                alertify.error("CANCELADO");
            });
}
function cargar_tabla_redad() {
                            $('#loading').css("display", "block");

    $.get('cargar_tabla_redad', function (res) {

        for (var i = 0; i < res.length; i++) {
            $('#cuerpoEdad').append('<tr>\n\
<td><center>' + res[i].edad_min + '</center></td> \n\
<td><center>' + res[i].edad_max + '</center></td>\n\
<td><center><button class="btn btn-danger" onclick="eliminar_rango_edad(' + res[i].id + ',' + res[i].edad_min + ', ' + res[i].edad_max + ')">ELIMINAR</button>\n\
<button class="btn btn-primary" onclick="cargarDatosEdad(' + res[i].id + ')">ACTUALIZAR</button></center>\n\</td>\n\
</tr>');
        }
                                $('#loading').css("display", "none");

    });


}

function cargar_tabla_rtemperatura() {
                            $('#loading').css("display", "block");

    $.get('cargar_tabla_rtemperatura', function (res) {

        for (var i = 0; i < res.length; i++) {
            $('#cuerpoTemperatura').append('<tr>\n\
<td><center>' + res[i].temp_min + '</center></td> \n\
<td><center>' + res[i].temp_max + '</center></td>\n\
<td><center><button class="btn btn-danger" onclick="eliminar_rango_temperatura(' + res[i].id + ',' + res[i].temp_min + ', ' + res[i].temp_max + ')">ELIMINAR</button>\n\
<button class="btn btn-primary" onclick="cargarDatosTemp(' + res[i].id + ')">ACTUALIZAR</button></center>\n\</td>\n\
</tr>');
            
        }
                                $('#loading').css("display", "none");

    });

}

function crear_rango_temperatura() {
    $('#loading').css("dieliminar_rango_temperaturasplay", "block");
    var temp_min = $("#temp_min").val();
    var temp_max = $("#temp_max").val();
    if (parseInt(temp_max) > parseInt(temp_min)) {
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
                    $('#cuerpoTemperatura').empty();
                    $('#myModalRangoTemperatura').modal('hide');
                   cargar_tabla_rtemperatura() ;
                } else {
                    alertify.alert("ERROR", mensaje.mensaje);
                   
                }
                $('#loading').css("display", "none");
            }, error: function () {
                $('#loading').css("display", "none");
                alertify.alert("ERROR", "NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
             //   setTimeout("location.href='rango'", 2000);
            },
        });

    } else {
        $('#btnregistrar').show();
        $('#loading').css("display", "none");
        alertify.alert("ERROR", "LA TEMPERATURA MAXIMA TIENE QUE SE MAYOR A LA TEMPERATURA MINIMA");
    }
}

function eliminar_rango_temperatura(id, temp_min, temp_max) {
    alertify.confirm("MENSAJE", "DESEA ELIMINAR ESTE RANGO DE TEMPERATURA TEMPERATURA MINIMA " + temp_min + " / " + " TEMPERATURA MAXIMA " + temp_max,
            function () {
                $('#loading').css("display", "block");
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
                        $('#loading').css("display", "none");
                        $('#cuerpoTemperatura').empty();
                        alertify.success("ELIMINADO CORECTAMENTE");
                        cargar_tabla_rtemperatura();
                    }, error: function () {
                        alertify.alert("ERROR", "NO SE PUDO ELIMINAR LOS DATOS INTENTE NUEVAMENTE");
                        $('#loading').css("display", "none");
                        setTimeout("location.href='rango'", 2000);
                    },
                });
            },
            function () {
                alertify.error("CANCELADO");
            });
}


function cargarDatosEdad(id){
                            $('#loading').css("display", "block");

         $.get('cargarDatosEdad/'+id, function (res) {
           $('#myModalActualizarRangoEdad').modal('show');
           
           $('#edad_min_a').val(res[0].edad_min);
           $('#edad_max_a').val(res[0].edad_max);
             $('#id_edad').val(res[0].id);
                                     $('#loading').css("display", "none");

        }); 
}
function cargarDatosTemp(id){
                            $('#loading').css("display", "block");

         $.get('cargarDatosTemp/'+id, function (res) {
           $('#myModalActualizarRangoTemperatura').modal('show');
           
           $('#temp_min_a').val(res[0].temp_min);
           $('#temp_max_a').val(res[0].temp_max);
             $('#id_temp').val(res[0].id);
                                     $('#loading').css("display", "none");

        }); 
}


function actualizarEdad(id){
   // $('#btnActualizar').hide();
    $('#loading').css("display", "block");
    var id = $('#id_edad').val();
    var edad_min = $("#edad_min_a").val();
    var edad_max = $("#edad_max_a").val();
    if (parseInt(edad_max) > parseInt(edad_min)) {
        var token = $('#token').val();
        $.ajax({
            url: "actualizarEdad",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'json',
            data: {edad_min: edad_min, edad_max: edad_max, estado: 1,id:id},
            success: function (mensaje) {
                if (mensaje.mensaje == undefined) {
                    alertify.success("MODIFICADO CORECTAMENTE");
                    $("#edad_min_a").val("");
                    $("#edad_max_a").val("");
                    $('#cuerpoEdad').empty();

                    $('#myModalActualizarRangoEdad').modal('hide');
                    $('#btnActualizar').show();
                    cargar_tabla_redad();
                } else {
                    alertify.alert("ERROR", mensaje.mensaje);
                   // setTimeout("location.href='rango'", 2000);
                }
                $('#loading').css("display", "none");
            }, error: function () {
                $('#loading').css("display", "none");
                alertify.alert("ERROR", "NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
             //   setTimeout("location.href='rango'", 2000);
            },
        });
    } else {
        $('#btnrActualizar').show();
        $('#loading').css("display", "none");
        alertify.alert("ERROR", "LA EDAD MAXIMA TIENE QUE SER MAYOR A LA EDAD MINIMA");
    }
}
function actualizarTemperatura(id){
   // $('#btnActualizar').hide();
    $('#loading').css("display", "block");
    var id = $('#id_temp').val();
    var temp_min = $("#temp_min_a").val();
    var temp_max = $("#temp_max_a").val();
    if (parseInt(temp_max) > parseInt(temp_min)) {
        var token = $('#token').val();
        $.ajax({
            url: "actualizarTemperatura",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'json',
            data: {temp_min: temp_min, temp_max: temp_max, estado: 1,id:id},
            success: function (mensaje) {
                if (mensaje.mensaje == undefined) {
                    alertify.success("MODIFICADO CORECTAMENTE");
                    $("#temp_min_a").val("");
                    $("#temp_max_a").val("");
                    $('#cuerpoTemperatura').empty();
 

                    $('#myModalActualizarRangoTemperatura').modal('hide');
                    $('#btnActualizar_temp').show();
                    cargar_tabla_rtemperatura();
                } else {
                    alertify.alert("ERROR", mensaje.mensaje);

                   // setTimeout("location.href='rango'", 2000);
                }
                $('#loading').css("display", "none");
            }, error: function () {
                $('#loading').css("display", "none");
                alertify.alert("ERROR", "NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
             //   setTimeout("location.href='rango'", 2000);
            },
        });
    } else {
        $('#btnrActualizar').show();
        $('#loading').css("display", "none");
        alertify.alert("ERROR", "LA TEMPERATURA MAXIMA TIENE QUE SER MAYOR A LA TEMPERATURA MINIMA");
    }
}