$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);
        $('#loading').css("display","none");
    } 
});

//CREAR SILO
function crear_silo(){
$("#btnregistrar").hide();
$('#loading').css("display","block"); 
var id_silo=$("#id_silo").val();
var nombre=$("#nombre").val();
var capacidad=$("#capacidad").val();
var cantidad=$("#cantidad").val();
var cantidad_minima=$("#cantidad_minima").val();
var id_alimento=$("#id_alimento").val();
 var token = $("#token").val();
        $.ajax({
            url: "silo",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {id: id_silo,nombre: nombre,cantidad:cantidad,capacidad:capacidad,cantidad_minima:cantidad_minima,id_alimento:id_alimento, estado:1},
            success: function(){
                alertify.success("GUARDADO CORECTAMENTE");
                location.reload();
            },error: function(){
                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
                $('#loading').css("display","none"); 
                $("#btnregistrar").show();
            },
        });
}

//ESTADO DEL SILO
function estado_silo(estado, id_silo) {
    var token = $('#token').val();
    var id = $(id_silo).val();
    $.ajax({
        url: "silo_estado",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'JSON',
        data: {estado: estado, id:id},
        success: function () {
            if (estado==1) {
                $(id_silo).attr('onclick', "estado_silo(0,this)");
                $(id_silo).removeClass();
                $(id_silo).addClass('btn btn-success');
                $(id_silo).text("ACTIVO");
            }
            else{
                $(id_silo).attr('onclick', "estado_silo(1,this)");
                $(id_silo).removeClass();
                $(id_silo).addClass('btn btn-warning');
                $(id_silo).text("INACTIVO");
            
            }
        }, error: function () {
            toastr.options.timeOut = 3000;
            toastr.options.positionClass = "toast-bottom-center";
            toastr.error('INTENTE NUEVAMENTE');
        }
    });         
}

function limpiar_text() {  
    $("#capacidad").val("");
    $("#cantidad").val("");    
    $("#cantidad_minima").val("");    
}