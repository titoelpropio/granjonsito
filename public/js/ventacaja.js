$(document).ready(function(){
   /* if ($('#token').val()=="") {
        location.reload();
    }else{*/
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
    cargar_lista_venta_caja();  
  //  }     
});

function cargar_lista_venta_caja(){
    var fecha_inicio=$('#fecha_inicio').val();
    var fecha_fin=$('#fecha_fin').val();
    var tabladatos=$("#datos_caja");

    var primera = Date.parse(fecha_inicio); 
    var segunda = Date.parse(fecha_fin); 
    if (primera > segunda) {                    
        alertify.alert("MENSAJE",'LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        $("#datos_caja").empty();
    } else{    
        var route = "venta_caja_lista/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_caja").empty();
        if ($('#datos_caja').attr('data-status')==1){
            $.get(route, function (res) {
            $("#datos_caja").empty();
                $(res).each(function (key, value) {
                    tabladatos.append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+value.fecha+"</td><td>"+value.precio+" Bs.</td><td>\n\
                    <button id='detalle"+value.id+"' class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='cargartabla("+value.id+")'><i class='fa fa-navicon' aria-hidden='true'></i> DETALLE</button> \n\
                    <button id='detalle"+value.id+"' class='btn btn-danger' data-toggle='modal' data-target='#myModal_anular' onclick='cargartabla_anular("+value.id+")'><i class='fa fa-remove' aria-hidden='true'></i> ANULAR VENTA</button></td></tr>");           
                });
            });  
        }   
        else{
            $.get(route, function (res) {
            $("#datos_caja").empty();
                $(res).each(function (key, value) {
                    tabladatos.append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+value.fecha+"</td><td></td>\n\
                        <td><button id='detalle"+value.id+"' class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='cargartabla("+value.id+")'><i class='fa fa-navicon' aria-hidden='true'></i> DETALLE</button></td></tr>");           
                });
            });  
        }
    } 
}

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
    
    if ($('#datos_caja').attr('data-status')==1){
        $.get(route, function (res) {
        $(res).each(function (key, value) { 
                total_caja=parseInt(total_caja)+parseInt(value.cantidad_caja);
                tabladatos.append("<tr align=center><td>" + value.tipo + "</td><td>" + value.cantidad_caja + "</td><td>" + value.subtotal_precio + " Bs.</td></tr>");
            });
            $("#total_caja").text(total_caja);  
        });
    }else{
        $.get(route, function (res) {
        $(res).each(function (key, value) { 
                total_caja=parseInt(total_caja)+parseInt(value.cantidad_caja);
                tabladatos.append("<tr align=center><td>" + value.tipo + "</td><td>" + value.cantidad_caja + "</td><td></td></tr>");
            });
            $("#total_caja").text(total_caja);  
        });
    }

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