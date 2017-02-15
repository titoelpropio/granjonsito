$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#loading').css("display","none");
    }    
});

function editar_consumo(id) {//muestra en el modal la cantidad consumida del galpon seleccionado
$.get('consumo_edit/'+id,function(mensaje){
    $('#cantidad').val(mensaje.cantidad);
    $('#cantidad_aux').val(mensaje.cantidad);
    $('#id_consumo').val(mensaje.id);
    $('#id_silo').val(mensaje.id_silo);
    $('#loading').css("display","none");
});
}

function actualizar(){
    $('#loading').css("display","block");
    var id_consumo = $('#id_consumo').val();
    var id_silo = $('#id_silo').val();
    var token=$('#token').val();
    var cantidad=$('#cantidad').val();
       $.ajax({
        url: 'editar_consumo',
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data:{id_consumo:id_consumo,cantidad:cantidad,id_silo:id_silo},
        success:function(response){
            if (response.mensaje1!== undefined) {
                alertify.alert("ADVERTENCIA",response.mensaje1); 
                $('#loading').css("display","none");
            }
            else{
                alertify.success("GUARDADO CORECCTAMENTE");
                location.reload();
            }
        },error:function(){
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
        }
    });   
}