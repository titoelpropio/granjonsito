$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);
        $('#loading').css("display","none");
    } 
});

/*function verificar_text(){
    if ($("#nombre").val()=="" || $("#tipo").val()=="") {
        alertify.alert("ERROR","INTRODUSCA LOS DATOS REQUERIDOS");
    } else {
       alertify.success("GUARDADO CORRECTAMENTE");
    }
}*/

function crearalimento(){
    $("#btnregistrar").hide();
    $('#loading').css("display","block");
    var nombre=$("#nombre").val();
    var tipo=$("#tipo").val();
    var token= $('#token').val();
    var tipo_gallina=$("#tipo_gallina").val();
    $.ajax({
        url: "alimento",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {nombre: nombre,tipo: tipo,tipo_gallina:tipo_gallina,estado:1},
        success: function(){
            $('#loading').css("display","none");
            alertify.success("GUARDADO CORECTAMENTE");
            location.reload();
        },error: function(){
            $('#loading').css("display","none");
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            $("#btnregistrar").show();
        }
    });
}

//ESTADO DEL ALIMENTO
function estado_alimento(estado, id_alimento) {
    var token = $('#token').val();
    var id = $(id_alimento).val();
    $.ajax({
        url: "alimento_estado",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'JSON',
        data: {estado: estado, id:id},
        success: function () {
            if (estado==1) {
                $(id_alimento).attr('onclick', "estado_alimento(0,this)");
                $(id_alimento).removeClass();
                $(id_alimento).addClass('btn btn-success');
                $(id_alimento).text("ACTIVO");
            }
            else{
                $(id_alimento).attr('onclick', "estado_alimento(1,this)");
                $(id_alimento).removeClass();
                $(id_alimento).addClass('btn btn-warning');
                $(id_alimento).text("INACTIVO");
            
            }
        }, error: function () {
            toastr.options.timeOut = 3000;
            toastr.options.positionClass = "toast-bottom-center";
            toastr.error('INTENTE NUEVAMENTE');
        }
    });         
}