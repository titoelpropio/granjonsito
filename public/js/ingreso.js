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
    cargar_lista_ingreso(); 
});

function cargar_lista_ingreso(){
    var fecha_inicio=$('#fecha_inicio').val();
    var fecha_fin=$('#fecha_fin').val();
    var tabladatos=$("#datos");
    var primera = Date.parse(fecha_inicio); 
    var segunda = Date.parse(fecha_fin); 
    if (primera > segunda) {                    
        alertify.alert("MENSAJE",'LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        $("#datos").empty();
    } else{  
        var route = "ingreso_lista/"+fecha_inicio+"/"+fecha_fin;
        $("#datos").empty();
        $.get(route, function (res) {
        $("#datos").empty();
            $(res).each(function (key, value) {
                tabladatos.append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+value.detalle+"</td><td>"+value.precio+" Bs.</td><td>"+value.fecha+"</td><td><center><button class='btn btn-primary' data-toggle='modal' data-target='#myModalActualizar' onclick='cargar_ingreso("+value.id+","+value.id_categoria+")' >ACTUALIZAR</button>  <button value="+value.id_compra+" class='btn btn-danger' data-toggle='modal' data-target='#myModalAnular' onclick='anular_ingreso("+value.id+")' >ANULAR EGRESO</button><center></td></tr>");           
            });
        });  
    } 
}

function anular_ingreso(id){
    $("#id_ingreso").val(id);
}

function cargar_ingreso(id,id_categoria){
    $("#id_ingreso_ac").val(id);
    var route = "actualizar_ingreso/"+id;
   $.get(route, function (res) {
        $("#detalle_ac").val(res[0].detalle);
        $("#precio_ac").val(res[0].precio);   
        $("#fecha_ac").val(res[0].fecha);       
    });
   cargar_select(id_categoria);
}

function cargar_select(id) {   //ES EL SELECT DEL ACTUALIZAR
    $("select[name=id_categoria_ac]").empty();
    $("select[name=id_categoria_ac]").addClass("form-control");
    $.get("select_ingreso/"+id, function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_categoria_ac]").append("<option value='" + response[i].id + "'>" + response[i].nombre + "</option>");
        }
    }); 
}

function actualizar_ingreso(){
    var detalle = $("#detalle_ac").val();
    var precio = $("#precio_ac").val();   
    var fecha = $("#fecha_ac").val(); 
    var id_categoria = $("#id_categoria_ac").val();
    var token = $("#token").val();
    var id = $("#id_ingreso_ac").val()
    var route = "ingreso/"+id;
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: {detalle:detalle, fecha: fecha,precio:precio,id_categoria:id_categoria},
        success: function(){
            alertify.success("MODIFICADO CORECTAMENTE");
            location.reload();
        },error: function(){
            alertify.alert("ERROR","NO SE PUDO MODIFICAR LOS DATOS INTENTE NUEVAMENTE");
            $("#btn_actualizar").show();
            $('#loading').css("display","none"); 
            setTimeout("location.reload()",2000);
        },
    }); 
}

//CREAR CATEGORIA
function crear_ingreso() {
    $("#btnregistrar").hide();
    $('#loading').css("display","block"); 
    var detalle = $("#detalle").val();
    var fecha = $("#fecha").val();
    var precio = $("#precio").val();
    var id_categoria = $("#id_categoria").val();
    var token = $("#token").val();
    $.ajax({
        url: "ingreso",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {detalle:detalle, fecha: fecha,precio:precio,id_categoria:id_categoria},
        success: function(){
            alertify.success("GUARDADO CORECTAMENTE");
            location.reload();
        },error: function(){
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            $("#btnregistrar").show();
            $('#loading').css("display","none"); 
            setTimeout("location.reload()",2000);
        },
    });
}

