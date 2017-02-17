$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);    
        $('#loading').css("display","none");
    }    
});
//CREAR CATEGORIA
function crear_ingreso() {
    $("#btnregistrar").hide();
    $('#loading').css("display","block"); 
    var detalle = $("#detalle").val();
    var fecha = $("#fecha").val();
    var precio = $("#precio").val();
    var id_categoria = $("#id_categoria").val();
    var token = $("#token").val();
    $.ajax({
        url: "ingreso",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {detalle:detalle, fecha: fecha,precio:precio,id_categoria:id_categoria},
        success: function(){
            alertify.success("GUARDADO CORECTAMENTE");
            location.reload();
        },error: function(){
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            $("#btnregistrar").show();
            $('#loading').css("display","none"); 
            setTimeout("location.reload()",2000);
        },
    });
}

