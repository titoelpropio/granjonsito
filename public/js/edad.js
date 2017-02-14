$(document).ready(function () {    
    if ($('#token').val()=="") {
        setInterval(location.reload(), 2000);
    }else{
        cargarselect();
        cargartabla();
        $(function (){ $('#datetimepicker10a').datetimepicker({ viewMode: 'days',  format: 'YYYY/MM/DD' }); });
        $(function (){ $('#datetimepicker10t').datetimepicker({ viewMode: 'days',  format: 'YYYY/MM/DD' }); });
    }
});

function cargarselect() {
    $("select[name=id_galpon]").empty();
    $("select[name=id_galpon]").addClass("form-control");
    $("select[name=id_galpon]").append("<option value='0'>SELECIONE UN GALPON</option>");
    $.get("edadl", function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_galpon]").append("<option value='" + response[i].id + "'>" + response[i].numero + "</option>");
        }
    }); 
}

function cargarselect2(id) {   //ES EL SELECT DEL ACTUALIZAR
    $("select[name=id_galpons]").empty();
    $("select[name=id_galpons]").addClass("form-control");
    $.get("edadl2/"+id, function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_galpons]").append("<option value='" + response[i].id + "'>" + response[i].numero + "</option>");
        }
    }); 
}

function cargarselect_fases(id) {
    $("select[name=id_fasea]").empty();
    $("select[name=id_fasea]").addClass("form-control");
    $.get("obtener_fase/"+id, function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_fasea]").append("<option value='" + response[i].id + "'>" + response[i].nombre + "</option>");
        }  
    }); 
}

function cargarselect_traspaso(id_edad,numero) {
    $("select[name=id_faset]").empty();
    $("select[name=id_faset]").addClass("form-control");
    $.get("getgalpon_traspaso/"+id_edad+"/"+numero, function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_faset]").append("<option value='" + response[i].id + "'>" + response[i].nombre + "</option>");
        }  
    }); 
}

function cargartabla() {
    $('#datos').empty();
    var tabladatos = $('#datos');
    var route = "listaedad";
    var tabladatos = $('#datos');
    $.get(route, function (res) {
        $(res).each(function (key, value) {
            if(value.nombre == 'PONEDORA') {
                tabladatos.append("<tr align=center><td>GALPON " + value.numero_galpon + "</td><td>" + value.nombre + "</td><td>" + value.edad + "</td>\n\
                <td>" + value.fecha_inicio + "</td><td>" + value.cantidad_inicial + "</td><td>" + value.cantidad_actual + "</td><td>" + value.total_muerta + "</td>\n\
                <td>\n\
                <button value=" + value.id + " class='btn-sm btn-primary' data-toggle='modal' data-target='#myModaledit' onclick='Cargar(" + value.id_galpon + "," +value.id_edad+ "," +value.id_fase+ "," +value.id_fase_galpon+")' >ACTUALIZAR</button>\n\
                <button class='btn-sm btn-warning' data-toggle='modal' data-target='#myModalTraspaso' onclick='CargarTraspaso(" + value.id_galpon + "," +value.id_edad+ "," +value.id_fase+ "," +value.id_fase_galpon +"," +value.numero_fase +")' >TRASPASO</button>\n\
                <button class='btn-sm btn-info' data-toggle='modal' data-target='#myModal_aumento' onclick='extraer_id_aumento(" + value.id_galpon + "," + value.id_fase_galpon +"," +value.numero_galpon +"," +value.cantidad_actual +")'>AUMENTAR</button>\n\
                <button class='btn-sm btn-danger' data-toggle='modal' data-target='#myModal' onclick='extraer_id(" + value.id_galpon + "," + value.id_fase_galpon +"," +value.numero_galpon +"," +value.id_edad +")'>DAR BAJA</button></center>\n\
                <button class='btn-sm btn-success' data-toggle='modal' data-target='#myModal_Vacunas' onclick='control_de_vacuna("+value.id_edad +")'>CONTROL VACUNAS</button></td></tr>");
            }else {//control_vacuna
                tabladatos.append("<tr align=center style=background-color:#F6E3CE><td>GALPON " + value.numero_galpon + "</td><td>" + value.nombre + "</td><td>" + value.edad + "</td>\n\
                <td>" + value.fecha_inicio + "</td><td>" + value.cantidad_inicial + "</td><td>" + value.cantidad_actual + "</td><td>" + value.total_muerta + "</td>\n\
                <td>\n\
                <button value=" + value.id + " class='btn-sm btn-primary' data-toggle='modal' data-target='#myModaledit' onclick='Cargar(" + value.id_galpon + "," +value.id_edad+ "," +value.id_fase+ "," +value.id_fase_galpon+")' >ACTUALIZAR</button>\n\
                <button class='btn-sm btn-warning' data-toggle='modal' data-target='#myModalTraspaso' onclick='CargarTraspaso(" + value.id_galpon + "," +value.id_edad+ "," +value.id_fase+ "," +value.id_fase_galpon +"," +value.numero_fase +")' >TRASPASO</button>\n\
                <button class='btn-sm btn-info' data-toggle='modal' data-target='#myModal_aumento' onclick='extraer_id_aumento(" + value.id_galpon + "," + value.id_fase_galpon +"," +value.numero_galpon +"," +value.cantidad_actual +")'>AUMENTAR</button>\n\
    <button class='btn-sm btn-danger' data-toggle='modal' data-target='#myModal' onclick='extraer_id(" + value.id_galpon + "," + value.id_fase_galpon +"," +value.numero_galpon +"," +value.id_edad +")'>DAR BAJA</button></center>\n\
    <button class='btn-sm btn-success' data-toggle='modal' data-target='#myModal_Vacunas' onclick='control_de_vacuna("+value.id_edad +")'>CONTROL VACUNAS</button></td></tr>");
            }
        });
        $('#loading').css("display","none");
    });
}


function crearedad() {    
$('#btnregistrar').hide();    
var token = $('#token').val();     
var id_fase = $("#id_fase").val();
var fecha_inicio = $("#fecha_inicio").val();
var id_galpon = $("#id_galpon").val();   
var estado = 1; 
var cantidad_inicial = $("#cantidad_inicial").val();
var cantidad_actual = $("#cantidad_actual").val();
var total_muerta = $("#total_muerta").val();
if (fecha_inicio=="" || cantidad_inicial=="" || cantidad_actual=="") {
    alertify.alert("ERROR","INTRODUSCA LOS DATOS REQUERIDOS");
    $('#btnregistrar').show(); 
} else {
    if (id_galpon == 0) { 
        alertify.error('SELECCIONE UN GALPON');
        $('#btnregistrar').show();
    } else {
        $('#loading').css("display","block"); 
        $.ajax({
            url: "edad",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {fecha_inicio: fecha_inicio, estado: estado, id_galpon: id_galpon,id_fase: id_fase, cantidad_inicial: cantidad_inicial, cantidad_actual:cantidad_actual, total_muerta:total_muerta},
            success:function(respuesta){
               if (respuesta.mensaje==undefined) {
                    cargartabla(); 
                    toastr.options.timeOut = 3000;
                    toastr.options.positionClass = "toast-bottom-center";
                    toastr.success('GUARDADO CON EXITO');
                    $("#fecha_inicio").val("");                
                    $("#cantidad_inicial").val("");
                    $("#cantidad_actual").val("");
                    $("#total_muerta").val("");
                    $('#myModalcreate').modal('hide');                           
                    $('#btnregistrar').show();   
                }
                else{
                    alertify.alert("MENSAJE",respuesta.mensaje); 
                    $("#btnregistrar").show();
                }     
                $('#loading').css("display","none"); 
            },
            error:function(){
                $('#loading').css("display","none"); 
                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
                setTimeout("location.href='edad'",2000);
            },
        });
    }
  }    
}
//CARGA MODAL DE ACTUALIZAR
function Cargar(id_galpon,id_edad,id_fase,id_fase_galpon) {
 $("#id_fase_galpon").val(id_fase_galpon);
 $("#id_fases").val(id_fase);  
  var route = "obtener_datos/"+id_edad;
   $.get(route, function (res) {
        $("#id_edad").val(res[0].id_edad);
        $("#fecha_inicios").val(res[0].fecha_inicio);   
        $("#cantidad_inicials").val(res[0].cantidad_inicial);
        $("#cantidad_actuals").val(res[0].cantidad_actual);       
        $("#total_muertas").val(res[0].total_muerta);        
    });
    cargarselect_fases(id_fase);
    cargarselect2(id_galpon);
}

function CargarTraspaso(id_galpon,id_edad,id_fase,id_fase_galpon,numero_fase) {
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if (dd < 10) { dd = '0' + dd }
    if (mm < 10) { mm = '0' + mm }
    hoy = yyyy + '-' + mm + '-' + dd;
    $('#id_galpont').val(id_galpon);
    $('#fecha_fint').val(hoy);    
    $("#id_fase_galpont").val(id_fase_galpon);
    $("#id_fasest").val(id_fase);  
    var route = "obtener_datos/"+id_edad;
    $.get(route, function (res) {
        $("#nombret").val(res[0].nombre);    
        $("#id_edadt").val(res[0].id_edad);  
        $("#cantidad_actualt").val(res[0].cantidad_actual); 
       if (res[0].nombre == "PONEDORA") {
         $("#btntraspaso").hide();
       } else {
         $("#btntraspaso").show();    
       }  
    });
    cargarselect_traspaso(id_edad,numero_fase);
    cargarselect2(id_galpon);
}

function CrearTraspaso() {
    $("#btntraspaso").hide();    
    var token = $("#token").val();
    var id_edad = $("#id_edadt").val();
    var fecha_inicio = $("#fecha_fint").val();
    var id_fase_galpon = $("#id_fase_galpont").val();
    var id_fase = $("#id_faset").val();
    var id_galpon = $("#id_galpont").val();

    var cantidad_actual = $("#cantidad_actualt").val();
if (cantidad_actual=="" || fecha_inicio=="") {
    alertify.alert("ERROR","INTRODUSCA LOS DATOS REQUERIDOS");
}
else{
 alertify.confirm("MENSAJE","DESEA REALIZAR EL TRASPASO",
  function(){    
    var route2 = "fases_galpon_update/"+id_fase_galpon;
    $.ajax({
        url: route2,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {id_galpon:id_galpon,id_fase:id_fase,fecha_fin:fecha_inicio,id_edad:id_edad, cantidad_inicial:cantidad_actual, cantidad_actual:cantidad_actual, total_muerta:0 ,fecha_inicio:fecha_inicio},
        success:function(respuesta){
         if (respuesta.mensaje==undefined) {
                toastr.options.timeOut = 3000;
                toastr.options.positionClass = "toast-bottom-center";
                toastr.success('TRASPASADO CORRECTAMENTE');
                $('#myModalTraspaso').modal('hide');
                cargartabla();
                $("#btntraspaso").show();
         }
         else{
            alertify.alert("MENSAJE",respuesta.mensaje); 
                $("#btntraspaso").show();
            }
        },
        error:function(){
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            setTimeout("location.href='edad'",2000);
        },
    }); 
 },
  function(){ 
    alertify.error("CANCELADO");  
    $("#btntraspaso").show();});
}
}

function actualizaredad() {
    $("#btnactualizar").hide();
    var token = $("#token").val();
    var id_edad = $("#id_edad").val();
    var fecha_inicio = $("#fecha_inicios").val();
    var estado = 1; 
    var id_galpon = $("#id_galpons").val();
    var id_fase_galpon = $("#id_fase_galpon").val();
    var id_fase = $("#id_fasea").val();
    var cantidad_actual = $("#cantidad_actuals").val();
    var cantidad_inicial = $("#cantidad_inicials").val();
    var total_muerta = $("#total_muertas").val();    
 alertify.confirm("MENSAJE","DESEA MODIFICAR LOS DATOS",
  function(){
    $('#loading').css("display","block"); 
    var route = "edad/"+id_edad; 
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: {fecha_inicio: fecha_inicio, estado: estado, id_galpon: id_galpon, id_fase:id_fase, id_edad:id_edad ,cantidad_inicial: cantidad_inicial, cantidad_actual: cantidad_actual, total_muerta:total_muerta,id_fase_galpon:id_fase_galpon},
        success:function(respuesta){
           if (respuesta.mensaje==undefined) {
                cargartabla();
                toastr.options.timeOut = 3000;
                toastr.options.positionClass = "toast-bottom-center";
                toastr.success('MODIFICADO CON EXITO');
                $('#myModaledit').modal('hide');
                $("#btnactualizar").show();                    
            }
            else{
                alertify.alert("MENSAJE",respuesta.mensaje);
                $("#btnactualizar").show();   
            }     
            $('#loading').css("display","none"); 
        },
        error: function (msj) {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "3000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            if (msj.responseJSON.fecha_inicio !== undefined) {
                toastr.error(msj.responseJSON.fecha_inicio);
            }
            if (msj.responseJSON.estado !== undefined) {
                toastr.error(msj.responseJSON.estado);
            }
            if (msj.responseJSON.id_galpon !== undefined) {
                toastr.error(msj.responseJSON.id_galpon);
            }
            $("#btnactualizar").show();
            $('#loading').css("display","none"); 
            setTimeout("location.href='edad'",2000);
        }
    });
 },
  function(){ 
    alertify.error("CANCELADO"); 
    $("#btnactualizar").show(); });        
}

function extraer_id(id_galpon,id_fase_galpon,numero_galpon,id_edad) {
    $("#idgalponb").val(id_galpon);
    $("#nombre_b").val(numero_galpon);    
    $("#id_edad_b").val(id_edad);   
    $("#id_fase_galponb").val(id_fase_galpon);
    $("#titulo").text("¿DESEA DAR DE BAJA EL GALPON " + numero_galpon +"?");
}

function dardebaja() {
    $('#baja').hide();
    $('#loading').css("display","block"); 
    var estado = 0;
    var numero_galpon=$("#nombre_b").val();      
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1;
    var yyyy = hoy.getFullYear();
    if (dd < 10) { dd = '0' + dd;  }
    if (mm < 10) { mm = '0' + mm;  }
    hoy = yyyy + '-' + mm + '-' + dd;
    var token = $("#token").val();
    var id_edad = parseInt($('#id_edad_b').val());
    var id_galpon = parseInt($('#idgalponb').val());
    $.ajax({
        url: "edad1a/"+id_edad,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {estado: estado, id_galpon: id_galpon, fecha_descarte: hoy},
        success:function(){
            var id_fase_galpon = $("#id_fase_galponb").val();
            var route2 = "dar_de_baja/"+id_fase_galpon;
            $.ajax({
                url: route2,
                headers: {'X-CSRF-TOKEN': token},
                type: 'GET',
                dataType: 'json',
                data: {fecha_fin:hoy},
                success:function(){
                    alertify.success("SE DIO DE BAJA EL GALPON "+numero_galpon);  
                    cargartabla();
                    $('#myModal').modal('hide');  
                    $('#baja').show();
                    $('#loading').css("display","none"); 
                },
                error:function(){
                    alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
                    $('#baja').show();
                    $('#loading').css("display","none"); 
                    return;
                },
            }); 
        },
        error:function(){
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            $('#loading').css("display","none"); 
            setTimeout("location.reload()",2000);
        },
    });
}

function extraer_id_aumento(id_galpon,id_fase_galpon,numero_galpon,cantidad_actual) {
    $("#titulo_a").text("AUMENTAR GALLINAS EN EL GALPON " + numero_galpon);
    $("#idgalpon_a").val(id_galpon);
    $("#nombre_a").val(numero_galpon);    
    $("#cantidad_actual_a").val(cantidad_actual);   
    $("#id_fase_galpon_a").val(id_fase_galpon);
}

function aumentar_gallinas() {
    $("#btnaumentar").hide();
    if (isNaN(parseInt($("#aumento_a").val()))) {
        alertify.alert("ERROR","INSERTE LOS DATOS CORRESPONDIENTE");
        $("#btnaumentar").show();
    } else {
    var token = $("#token").val();
    var numero_galpon=$("#nombre_a").val();      
    var id_fase_galpon = $("#id_fase_galpon_a").val();
    var cantidad_total = parseInt($('#cantidad_actual_a').val()) + parseInt($('#aumento_a').val());
    $.ajax({
        url: "aumento_gallina/"+id_fase_galpon,
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {cantidad_actual: cantidad_total},
        success:function(){
            alertify.success("GUARDADO CORRECTAMENTE");
            $("#aumento_a").val("");
            cargartabla();  
            $('#myModal_aumento').modal('hide');
            $("#btnaumentar").show();
        },
        error:function(){
            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            $("#btnaumentar").show();
            return;
        },
    }); 
  }
}
