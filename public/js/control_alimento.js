$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#loading').css("display","none");
    } 
});

function crear_control(){
    $('#btnregistrar').hide();
    $('#loading').css("display","block");
    var token = $("#token").val();    
    var id_edad=$("#id_edad").val();  
    var id_temperatura=$("#id_temperatura").val();  
    var cantidad=$("#cantidad").val(); 
    var id_alimento=$("#id_alimento").val();
    $.ajax({
        url: "controlalimento",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {id_temperatura:id_temperatura, id_edad:id_edad, cantidad: cantidad, id_alimento:id_alimento},
        success: function (mensaje) {
            if (mensaje.mensaje==undefined) {
                alertify.success("GUARDADO CORRECTAMENTE");    
                setTimeout("location.href='controlalimento'",1000);     
            } else {
                $('#btnregistrar').show();
                alertify.alert("ERROR",mensaje.mensaje);  
                setTimeout("location.href='controlalimento'",2000);
            }
                $('#loading').css("display","none");
        },
        error: function (msj) {
            $('#btnregistrar').show();
            $('#loading').css("display","none");            
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE"); 
            setTimeout("location.href='controlalimento'",2000);
        },
    });
}

//ELIMINAR CONTROL
function eliminar_control(id){
 alertify.confirm("MENSAJE","DESEA ELIMINAR ESTE CONTROL ALIMENTO",
  function(){
    $('#loading').css("display","block");
    var token = $("#token").val();
    var route = "controlalimento/"+id; 
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE', 
        dataType: 'json',     
        success:function(){
            $('#loading').css("display","none");
            alertify.success('CONTROL ALIMENTO ELIMINADO');
            location.reload();
        },
        error:function(){                
            $('#loading').css("display","none");
            alertify.alert("ERROR","NO SE PUDO ELIMINAR LOS DATOS INTENTE NUEVAMENTE");
            setTimeout("location.href='controlalimento'",2000);
        }
    });
  },
  function(){   }); 
}
