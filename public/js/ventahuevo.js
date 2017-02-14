$(document).ready(function(){
    $('#oculta').hide(5000);
    $('#loading').css("display","none");
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
    cargar_lista_venta_huevo(); 
});

function cargar_lista_venta_huevo(){
    var fecha_inicio=$('#fecha_inicio').val();
    var fecha_fin=$('#fecha_fin').val();
    var tabladatos=$("#datos_huevos");

    var primera = Date.parse(fecha_inicio); 
    var segunda = Date.parse(fecha_fin); 
    if (primera > segunda) {                    
        alertify.alert("MENSAJE",'LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        $("#datos_huevos").empty();
    } else{    
        var route = "venta_huevo_lista/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_huevos").empty();
        if ($('#datos_huevos').attr('data-status')==1){
            $.get(route, function (res) {
            $("#datos_huevos").empty();
                $(res).each(function (key, value) {
                    tabladatos.append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+value.fecha+"</td><td>"+value.precio+" Bs.</td><td>\n\
                    <button id='detalle"+value.id+"' class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='cargartabla_ventahuevo("+value.id+")'><i class='fa fa-navicon' aria-hidden='true'></i> DETALLE</button> \n\
                    <button id='detalle"+value.id+"' class='btn btn-danger' data-toggle='modal' data-target='#myModal_anular' onclick='cargartabla_anular_huevo("+value.id+")'><i class='fa fa-remove' aria-hidden='true'></i> ANULAR VENTA</button></td></tr>");           
                });
            });  
        }else{
            $.get(route, function (res) {
            $("#datos_huevos").empty();
                $(res).each(function (key, value) {
                    tabladatos.append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+value.fecha+"</td><td>"+value.precio+" Bs.</td><td>\n\
                    <button id='detalle"+value.id+"' class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='cargartabla_ventahuevo("+value.id+")'><i class='fa fa-navicon' aria-hidden='true'></i> DETALLE</button></td></tr>");           
                });
            });  
        }

    } 
}

//////////////VENTA DE HUEVOS///////////////
function cargartabla_ventahuevo(id) {   //CARGAR TABLA VENTA DE HUEVOS
    var total_huevo=0;
    var total_maple=0;
    $("#id_venta").val(id);
    $('#datos').empty();
    var tabladatos = $('#datos');
    var route = "lista_detalle_venta_huevo/"+id;
    var tabladatos = $('#datos');
    var route_2="lista_venta_huevo/"+id;

    $.get(route_2, function (res) {
        $("#fecha").text("FECHA: "+res[0].fecha);
        $("#total").text(res[0].precio);        
    });

    $.get(route, function (res) {
    $(res).each(function (key, value) {
            total_maple=parseInt(total_maple)+parseInt(value.cantidad_maple);
            total_huevo=parseInt(total_huevo)+parseInt(value.cantidad_huevo);
            tabladatos.append("<tr align=center><td>" + value.tipo + "</td><td>" + value.cantidad_maple + "</td><td>" + value.cantidad_huevo + "</td><td>" + value.subtotal_precio + "</td></tr>");
        });
        $("#total_huevo").text(total_huevo);
        $("#total_maple").text(total_maple);
    });
}

function cargartabla_anular_huevo(id) {   //CARGAR TABLA PARA ANULAR VENTA HUEVO
    $("#id_venta_a").val(id);
    $('#datos_a').empty();
    var tabladatos = $('#datos_a');
    var route = "lista_detalle_venta_huevo/"+id;
    var tabladatos = $('#datos_a');
    var route_2="lista_venta_huevo/"+id;

    $.get(route_2, function (res) {
        $("#fecha_aux").text("FECHA: "+res[0].fecha);
        $("#fecha_a").val(res[0].fecha);
        $("#total_a").text(res[0].precio);        
    });

    $.get(route, function (res) {
    $(res).each(function (key, value) {
             tabladatos.append("<tr align=center><td>" + value.tipo + "</td><td>" + value.cantidad_maple + "</td><td>" + value.cantidad_huevo + "</td><td>" + value.subtotal_precio + "</td></tr>");
        });
    });
}

function anular_venta_huevo(){   //ANULAR VENTA CAJAS
 alertify.confirm("MENSAJE","DESEA ELIMINAR ESTA VENTA",
  function(){
    $('#loading').css("display","block");
    var token = $("#token").val();
    var fecha = $("#fecha_a").val();
    var precio = $("#total_a").text();
    var id=$("#id_venta_a").val();
    var route = "ventahuevo/"+id; 
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: { estado:0, fecha:fecha, precio:precio},
        success:function(){
            var route_2 = "lista_detalle_venta_huevo/"+id;   
            $.get(route_2, function (res) {
                $(res).each(function (key, value) {
                    //alert(value.id+'-'+value.id_tipo_huevo+'-'+value.id_venta_huevo+'-'+value.cantidad_maple+'-'+value.cantidad_huevo+'-'+value.subtotal_precio+'-'+value.tipo);
                    var route_3="detalleventahuevo/"+value.id;
                        $.ajax({
                            url: route_3,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'PUT',
                            dataType: 'json',
                            data: {id_tipo_huevo:value.id_tipo_huevo, id_venta_huevo:value.id_venta_huevo, cantidad_maple:value.cantidad_maple, cantidad_huevo:value.cantidad_huevo, subtotal_precio:value.subtotal_precio},
                            error:function(){
                                $('#loading').css("display","none");
                                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
                            },
                        });
                });
                alertify.success('VENTA ELIMINADA');
                setTimeout("location.href='ventahuevo'",3000);//$(location).attr('href', 'ventahuevo');  
            });
        },
        error:function(){
            $('#loading').css("display","none");
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            setTimeout("location.reload()",2000);
        },
    });
  },
  function(){   }); 
}


