
//ELIMINAR CONTROL
function eliminar_usuario(id){
 alertify.confirm("MENSAJE","DESEA ELIMINAR ESTE USUARIO",
  function(){
    var token = $("#token").val();
    var route = "usuario/"+id; 
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE', 
        dataType: 'json',     
        success:function(){
            alertify.success('USUARIO ELIMINADO CORRECTAMENTE');
            location.reload();
        },
        error:function(){
            alertify.alert("ERROR","NO SE PUDO ELIMINAR LOS DATOS INTENTE NUEVAMENTE");
        }
    });
  },
  function(){   }); 
}
