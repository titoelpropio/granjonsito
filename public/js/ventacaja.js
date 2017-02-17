$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);
        $('#loading').css("display","none");
    }     
});

function cargartabla(id) {  //CARGAR TABLA VENTA CAJA
    var total_caja=0;
    $("#id_venta").val(id);
    $('#datos').empty();
    var tabladatos = $('#datos');
    var route = "lista_detalle_venta/"+id;
    var tabladatos = $('#datos');
    var route_2="lista_venta/"+id;

    $.get(route_2, function (res) {
        $("#fecha").text("FECHA: "+res[0].fecha);
        $("#total").text(res[0].precio);         
    });

    $.get(route, function (res) {
    $(res).each(function (key, value) { 
            total_caja=parseInt(total_caja)+parseInt(value.cantidad_caja);
            tabladatos.append("<tr align=center><td>" + value.tipo + "</td><td>" + value.cantidad_caja + "</td><td>" + value.subtotal_precio + "</td></tr>");
        });
        $("#total_caja").text(total_caja);  
    });
}

function cargartabla_anular(id) {   //CARGAR TABLA PARA ANULAR VENTA CAJA
    $("#id_venta_a").val(id);
    $('#datos_a').empty();
    var tabladatos = $('#datos_a');
    var route = "lista_detalle_venta/"+id;
    var tabladatos = $('#datos_a');
    var route_2="lista_venta/"+id;

    $.get(route_2, function (res) {
        $("#fecha_aux").text("FECHA: "+res[0].fecha);
        $("#fecha_a").val(res[0].fecha);
        $("#total_a").text(res[0].precio);        
    });

    $.get(route, function (res) {
    $(res).each(function (key, value) {
            tabladatos.append("<tr align=center><td>" + value.tipo + "</td><td>" + value.cantidad_caja + "</td><td>" + value.subtotal_precio + "</td></tr>");
        });
    });
}

function anular_venta_caja(){   //ANULAR VENTA CAJAS
 alertify.confirm("MENSAJE","DESEA ELIMINAR ESTA VENTA",
  function(){
    $('#loading').css("display","block");
    var token = $("#token").val();
    var fecha = $("#fecha_a").val();
    var precio = $("#total_a").text();
    var id=$("#id_venta_a").val();
    var route = "ventacaja/"+id; 
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: { estado:0, fecha:fecha, precio:precio},
        success:function(){
            var route_2 = "lista_detalle_venta/"+id;   
            $.get(route_2, function (res) {
                $(res).each(function (key, value) {
                    //alert(value.id+'-'+value.id_tipo_caja+'-'+value.id_venta_caja+'-'+value.cantidad_caja+'-'+value.subtotal_precio+'-'+value.tipo);
                    var route_3="detalle_venta/"+value.id
                        $.ajax({
                            url: route_3,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'PUT',
                            dataType: 'json',
                            data: {id_tipo_caja:value.id_tipo_caja, id_venta_caja:value.id_venta_caja, cantidad_caja:value.cantidad_caja, subtotal_precio:value.subtotal_precio},
                            error:function(){
                                $('#loading').css("display","none");
                                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
                            },
                        });
                });
                alertify.success('VENTA ELIMINADA');
                setTimeout("location.href='ventacaja'",3000);//$(location).attr('href', 'ventacaja');  
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