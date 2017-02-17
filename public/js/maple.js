$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);
        $('#loading').css("display","none");
    }    
});

//CREAR MAPLE
function crearmaple1(){
    $('#btnregistrar').hide();
    $('#loading').css("display","block");
    var tamano = $("#tamano").val();
    var cantidad = $("#cantidad").val();
    var token = $("#token").val();
    $.ajax({
        url: "maple",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {tamano:tamano, cantidad: cantidad},
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

//ELIMINAR MAPLE
function eliminar_maple(id){
 alertify.confirm("MENSAJE","DESEA ELIMINAR ESTE TIPO DE MAPLE",
  function(){
    $('#loading').css("display","block");
    var token = $("#token").val();
    var route = "maple/"+id; 
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE', 
        dataType: 'json',     
        success:function(resultado){
          if (resultado.mensaje==undefined){
            $('#loading').css("display","none");
            alertify.success('MAPLE ELIMINADO');
            location.reload();
           }
           else{
             alertify.alert("MENSAJE",resultado.mensaje); 
              $('#loading').css("display","none");
           }
        },
        error:function(){
            $('#loading').css("display","none");
            alertify.alert("ERROR","NO SE PUDO ELIMINAR LOS DATOS INTENTE NUEVAMENTE");
            setTimeout("location.href='maple'",2000);
        },
    });
  },
  function(){   }); 
}
