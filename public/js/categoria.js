$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);    
        $('#loading').css("display","none");
    }    
});
//CREAR CATEGORIA
function crear_categoria() {
    $("#btnregistrar").hide();
    $('#loading').css("display","block"); 
    var tipo = $("#tipo").val();
    var nombre = $("#nombre").val();
    var token = $("#token").val();
    $.ajax({
        url: 'categoria', 
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {nombre:nombre, tipo: tipo},
        success: function(){
            $('#loading').css("display","none"); 
            alertify.success("GUARDADO CORECTAMENTE");
            location.reload();
        },error: function(){
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            $('#loading').css("display","none"); 
            setTimeout("location.reload()",2000);
        }
    });
}

function EliminarGastos(id){
    $("#id_gasto").val(id);
}

