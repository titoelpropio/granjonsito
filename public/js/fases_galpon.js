function crear_fase(){
    var numero = $("#numero").val();
    var nombre = $("#nombre").val();
    var token = $("#token").val();
    $.ajax({
        url: "fases",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {numero:numero, nombre: nombre},
        success:function(){
            alertify.success("GUARDADO CORECTAMENTE");
            location.reload();   
        },
        error:function(){
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
        },
    });
}

