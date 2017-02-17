$(document).ready(function(){
    $('#oculta').hide(5000);
    $('#loading').css("display","none");
});


function cambiarestado(estado, idvacuna) {
    var token = $('#token').val();
    var id = $(idvacuna).val();
    $.ajax({
        url: "vacunaestado",
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
            }
            else{
                 $(idvacuna).attr('onclick', "cambiarestado(1,this)");
            $(idvacuna).removeClass();
            $(idvacuna).addClass('btn btn-warning');
            $(idvacuna).text("INACTIVO");
            
            }           
        }, error: function () {
            toastr.options.timeOut = 3000;
            toastr.options.positionClass = "toast-bottom-center";
            toastr.error('INTENTE NUEVAMENTE');
        }
    });    
}


function crear_vacuna() {
    $('#btnregistrar').hide();
    $('#loading').css("display","block");
    var nombre=$("#nombre").val();
    var edad=$("#edad").val();
    var detalle=$("#detalle").val();
    var token= $('#token').val();
    $.ajax({
        url: "vacuna",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'JSON',
        data: {estado: 1, edad: edad, nombre:nombre, detalle:detalle},
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
