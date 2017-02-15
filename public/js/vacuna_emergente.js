$(document).ready(function(){
    $('#oculta').hide(5000);
    $('#loading').css("display","none");
    cargar_select();
});


function cambiarestado(estado, idvacuna) {
    $('#loading').css("display","block");
    var token = $('#token').val();
    var id = $(idvacuna).val();
    $.ajax({
        url: "vacunae_emergente_estado",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'JSON',
        data: {estado: estado, id: id},
        success: function () {
            if (estado==1) {
                 $(idvacuna).attr('onclick', "cambiarestado(0,this)");
                $(idvacuna).removeClass();
                $(idvacuna).addClass('btn btn-success');
                $(idvacuna).text("ACTIVO");
                $('#loading').css("display","none");
            }
            else{
                 $(idvacuna).attr('onclick', "cambiarestado(1,this)");
                $(idvacuna).removeClass();
                $(idvacuna).addClass('btn btn-warning');
                $(idvacuna).text("INACTIVO");
                $('#loading').css("display","none");            
            }           
        }, error: function () {
            toastr.options.timeOut = 3000;
            toastr.options.positionClass = "toast-bottom-center";
            toastr.error('INTENTE NUEVAMENTE');
            $('#loading').css("display","none");
        }
    });    
}


function crear_vacuna() {
    $('#btnregistrar').hide();
    $('#loading').css("display","block");
    var nombre=$("#nombre").val();
    var detalle=$("#detalle").val();
    var token= $('#token').val();
    $.ajax({
        url: "vacuna_emergente",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'JSON',
        data: {estado: 1, nombre:nombre, detalle:detalle},
        success:function(){
            $('#loading').css("display","none");
            alertify.success("GUARDADO CORECTAMENTE");
            location.reload();
        },
        error:function(){
            $('#loading').css("display","none");
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            setTimeout("location.reload()",2000);
        },
    });   
}

function cargar_select() {
    $("select[name=id_galponcv]").empty();
    $("select[name=id_galponcv]").addClass("form-control");   
    $("select[name=id_galponcv]").append("<option value='0'>SELECCIONE</option>");
    $.get("select_control_vacuna_fase", function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_galponcv]").append("<option value='" + response[i].id_edad + "'>" + response[i].nombre + "</option>");
        }
        $.get("select_control_vacuna_ponedora", function (response) {
            for (var i = 0; i < response.length; i++) {
                $("select[name=id_galponcv]").append("<option value='" + response[i].id_edad + "'> GALPON " + response[i].numero + "</option>");
            }
        });  
    }); 
}