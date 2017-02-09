$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);
        $('#loading').css("display","none");
    }    
});

//CREAR TIPO HUEVO
function crear_tipo_huevo(){  
$('#btnregistrar').hide();  
$('#loading').css("display","block");
tipo=$("#tipo").val();
precio=$("#precio").val();
id_maple = $("#id_maple").val();
        $.ajax({
            url: "crear_tipo_huevo",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'json',
            data: {tipo: tipo,precio:precio,estado:1, id_maple:id_maple},
            success:function(){            
                $('#loading').css("display","none");
                alertify.success("GUARDADO CORRECTAMENTE");
                location.reload();
            },
            error:function(){
                $('#btnregistrar').show();
                $('#loading').css("display","none");
                alertify.alert("ERRROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            }
        });
}        

//CAMBIAR ESTADO DE TIPO HUEVO
function cambiar_estado_huevo(estado, id_tipo_huevo) {
    var token = $('#token').val();
    var id = $(id_tipo_huevo).val();
    var route = "dato_huevo_acumulado/"+id;
    $.get(route,function(res){      
    if (isNaN(res)) {
        if (res[0].cantidad_maple == 0) {        
        $.ajax({
            url: "tipohuevo_estado",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'JSON',
            data: {estado: estado, id: id},
            success: function () {
                if (estado==1) {
                $(id_tipo_huevo).attr('onclick', "cambiar_estado_huevo(0,this)");
                $(id_tipo_huevo).removeClass();
                $(id_tipo_huevo).addClass('btn btn-success');
                $(id_tipo_huevo).text("ACTIVO");
                }
                else{
                     $(id_tipo_huevo).attr('onclick', "cambiar_estado_huevo(1,this)");
                $(id_tipo_huevo).removeClass();
                $(id_tipo_huevo).addClass('btn btn-warning');
                $(id_tipo_huevo).text("INACTIVO");                
                }               
            }, error: function () {
                toastr.options.timeOut = 3000;
                toastr.options.positionClass = "toast-bottom-center";
                toastr.error('INTENTE NUEVAMENTE');
            }
        }); 
    } else {
        alertify.alert("ADVERTENCIA",'EXISTE MAPLES EN EL DEPOSITO NO PUEDE DESHABILITAR ESTE TIPO DE HUEVO');
    }        
    } else {
        $.ajax({
            url: "tipohuevo_estado",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'JSON',
            data: {estado: estado, id: id},
            success: function () {
                if (estado==1) {
                $(id_tipo_huevo).attr('onclick', "cambiar_estado_huevo(0,this)");
                $(id_tipo_huevo).removeClass();
                $(id_tipo_huevo).addClass('btn btn-success');
                $(id_tipo_huevo).text("ACTIVO");
                }
                else{
                     $(id_tipo_huevo).attr('onclick', "cambiar_estado_huevo(1,this)");
                $(id_tipo_huevo).removeClass();
                $(id_tipo_huevo).addClass('btn btn-warning');
                $(id_tipo_huevo).text("INACTIVO");                
                }               
            }, error: function () {
                toastr.options.timeOut = 3000;
                toastr.options.positionClass = "toast-bottom-center";
                toastr.error('INTENTE NUEVAMENTE');
            }
        }); 
    }      
   }); 
}