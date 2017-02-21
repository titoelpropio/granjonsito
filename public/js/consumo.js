$(document).ready(function(){
    $(function (){ $("#datetimepicker1").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
    $(function (){ $("#datetimepicker2").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if (dd < 10) {  dd = '0' + dd }
    if (mm < 10) {  mm = '0' + mm  }
    hoy = yyyy + '-' + mm + '-' + dd;
    $('#fecha_inicio').val(hoy);
    $('#fecha_fin').val(hoy); 
    $('#loading').css("display","none");
    cargar_lista_consumo();
});

function cargar_lista_consumo(){
    var fecha_inicio=$('#fecha_inicio').val();
    var fecha_fin=$('#fecha_fin').val();
    var tabladatos=$("#datos_con");

    var primera = Date.parse(fecha_inicio); 
    var segunda = Date.parse(fecha_fin); 
    if (primera > segunda) {                    
        alertify.alert("MENSAJE",'LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        $("#datos_con").empty();
    } else{    
        var route = "lista_conusmo_alimento/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_con").empty();
        $.get(route, function (res) {
        $("#datos_con").empty();
            $(res).each(function (key, value) {
                tabladatos.append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+value.numero_galpon+"</td><td>"+value.nombre+"</td><td>"+value.tipo+"</td><td>"+value.cantidad+"</td><td>"+value.fecha+"</td><td><center> <button class='btn btn-primary' data-toggle='modal' data-target='#myModal'  onclick='editar_consumo("+value.id+")' >ACTUALIZAR</button>  <button class='btn btn-danger' data-toggle='modal' data-target='#myModalAnular' onclick='cargar_eliminar_consumo("+value.id+")' >ALIMINAR CONSUMO</button></center></td></tr>");           
            });
        });  
    } 
}

function cargar_eliminar_consumo(id_consumo){
    $("#id_con").val(id_consumo);
}

function eliminar_consumo(){
    var id_consumo = $("#id_con").val();
    $.get("eliminar_consumo/"+id_consumo, function(){})
}

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