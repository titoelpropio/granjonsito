$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
        Cargar();
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth() + 1; //hoy es 0!
        var yyyy = hoy.getFullYear();
        if (dd < 10) { dd = '0' + dd }
        if (mm < 10) { mm = '0' + mm }
        hoy = yyyy + '-' + mm + '-' + dd;

        $('#btnPDF').attr("disabled", true);
        cargarselect_galpon();
        cargarselect_galpon2();
        cargarselect_fase();

        $(function (){ $("#datetimepicker1").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
        $(function (){ $("#datetimepicker2").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
        $(function (){ $("#datetimepicker3").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
        $(function (){ $("#datetimepicker4").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });

        $('#loading').css("display","none");
    }
});

function cargarselect_galpon() {
    $("select[name=id_galpon]").empty();
    $("select[name=id_galpon]").addClass("form-control");
    $("select[name=id_galpon]").append("<option value='0'>VER TODOS</option>");
    $.get("lista_galpones_select", function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_galpon]").append("<option value='" + response[i].id_edad + "'>GALPON " + response[i].numero +"</option>");
        }
    }); 
}
function detalle_galpon(sw){
   var tabladatos=$("#datos_r");
   var id_edad = $('#id_galpon').val();
   var galpon = $('#id_galpon option:selected').text();
   var total_huevos = 0;
   var total_muertas = 0;
   if (id_edad==0) {
        $("#nombre").text("RENDIMIENTO DE TODOS LOS GALPONES");
   } else {
        $("#nombre").text("RENDIMIENTO DEL "+galpon);
   }
   
   if (sw==0) {
       var route = "detalle_galpones/"+id_edad+"/null/null/"+sw;
   }else{
        var fecha_inicio = $('#fecha_inicio').val();
        var fecha_fin = $('#fecha_fin').val();
        if (fecha_fin=="" || fecha_inicio=="") {
            alertify.alert("ADVERTENCIA","INTRODUSCA LAS FECHAS");
            return;
        }else{
            var primera = Date.parse(fecha_inicio); 
            var segunda = Date.parse(fecha_fin); 
            if (primera > segunda){
                toastr.options.timeOut = 9000;
                toastr.options.positionClass = "toast-top-right";
                toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!'); 
                return;
            }else{
                var route = "detalle_galpones/"+id_edad+"/"+fecha_inicio+"/"+fecha_fin+"/"+sw;
            }
        }
    }
    $("#datos_r").empty();
    $.get(route,function(res){
        $(res).each(function(key,value){
            total_muertas = parseInt(total_muertas) + parseInt(value.muertas);
            total_huevos = parseInt(total_huevos) + parseInt(value.cantidad_total); /*<td align=center>"+value.fecha_inicio+"</td>*/
            tabladatos.append("<tr><td align=center>"+value.fase+"</td><td align=center> GALPON "+value.nombre+"</td>\n\
                <td align=center>"+value.muertas+"</td><td align=center>"+value.cantidad_total+"</td><td align=center>"+value.postura_p+" %</td></tr>");
            $('#btnPDF').attr("disabled", false);
        });
       if (id_edad==0) {
             tabladatos.append("<tr style='background-color:#CEECF5; color:red; font-size:19px' ><td align=center>TOTAL</td><td align=center></td><td align=center>"+total_muertas+"</td><td align=center>"+total_huevos+"</td><td align=center></td></tr>");
       }     
    }); 
}


function cargarselect_galpon2() {
    $("select[name=id_galpon2]").empty();
    $("select[name=id_galpon2]").addClass("form-control");
    $("select[name=id_galpon2]").append("<option value='0'>VER TODOS</option>");
    $.get("lista_galpones_select", function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_galpon2]").append("<option value='" + response[i].id_edad + "'> GALPON " + response[i].numero +"</option>");
        }
    }); 
}
function detalle_galpon2(sw){
   var tabladatos=$("#datos_r2");
   var id_edad = $('#id_galpon2').val();
   var total_huevos = 0;
   var total_muertas = 0;   
   if (sw==0) {
       var route = "detalle_galpones/"+id_edad+"/null/null/"+sw;
   }else{
        var fecha_inicio = $('#fecha_inicio2').val();
        var fecha_fin = $('#fecha_fin2').val();
        if (fecha_fin=="" || fecha_inicio=="") {
            alertify.alert("ADVERTENCIA","INTRODUSCA LAS FECHAS");
            return;
        }else{
            var primera = Date.parse(fecha_inicio); 
            var segunda = Date.parse(fecha_fin); 
            if (primera > segunda){
                toastr.options.timeOut = 9000;
                toastr.options.positionClass = "toast-top-right";
                toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!'); 
                return;
            }else{
                var route = "detalle_galpones/"+id_edad+"/"+fecha_inicio+"/"+fecha_fin+"/"+sw;
            }
        }
    }
    $("#datos_r2").empty();
    $.get(route,function(res){
        $(res).each(function(key,value){
            total_muertas = parseInt(total_muertas) + parseInt(value.muertas);
            total_huevos = parseInt(total_huevos) + parseInt(value.cantidad_total);   /*<td align=center>"+value.fecha_inicio+"</td>*/
            tabladatos.append("<tr><td align=center>"+value.fase+"</td><td align=center> GALPON "+value.nombre+"</td><td align=center>"+value.muertas+"</td><td align=center>"+value.cantidad_total+"</td><td align=center>"+value.postura_p+" %</td></tr>");
            $('#btnPDF').attr("disabled", false);
        });
       if (id_edad==0) {
            tabladatos.append("<tr style='background-color:#CEECF5; color:red; font-size:19px' ><td align=center>TOTAL</td><td align=center></td><td align=center>"+total_muertas+"</td><td align=center>"+total_huevos+"</td><td align=center></td></tr>");             
       }                 
    }); 
}

function cargarselect_fase() {
    $("select[name=id_fase]").empty();
    $("select[name=id_fase]").addClass("form-control");
    $("select[name=id_fase]").append("<option value='0'>VER TODOS</option>");
    $.get("lista_fases_select", function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_fase]").append("<option value='" + response[i].id_edad + "'>"+response[i].nombre+"</option>");
        }
    }); 
}

function detalle_fase(){
   var tabladatos=$("#datos_r");
   var id_edad = $('#id_fase').val();
   var fase = $('#id_fase option:selected').text();
   var total_muertas = 0;
   if (id_edad==0) {
        $("#nombre").text("RENDIMIENTO DE TODAS LAS FASES");
   } else {
        $("#nombre").text("RENDIMIENTO DE LA "+fase);
   }
   var route = "detalle_fases/"+id_edad;
   $("#datos_r").empty();
    $.get(route,function(res){
        $(res).each(function(key,value){
            total_muertas = parseInt(total_muertas) + parseInt(value.total_muerta);        /*<td align=center>"+value.fecha_inicio+"</td>*/    
            tabladatos.append("<tr><td align=center>"+value.nombre+"</td><td align=center> GALPON "+value.numero+"</td><td align=center>"+value.total_muerta+"</td></tr>");
            $('#btnPDF').attr("disabled", false);
        });
        if (id_edad==0) {
            tabladatos.append("<tr align=center style='background-color:#CEECF5; font-size:19px; color:red' ><td align=center>TOTAL</td><td align=center></td><td align=center>"+total_muertas+"</td></tr>");
        }
    }); 
}

function Cargar(){
var tabladatos=$("#datos");
var route = "listagalpon";
$("#datos").empty();
    $.get(route,function(res){
       $(res).each(function(key,value){
            tabladatos.append("<tr><td align=center> GALPON "+value.numero+"</td><td align=center>"+value.capacidad_total+"</td><td align=center> <button value="+value.id+" onclick='Mostrar(this);' class='btn btn-primary' data-toggle='modal' data-target='#myModal2'>ACTUALIZAR</button></tr>");
        });
        $('#loading').css("display","none");
    });                                                                                                                                               
}

function crear_galpon(){
$('#btnregistrar').hide(); 
$('#loading').css("display","block");    
var numero=$("#numero").val();
var token = $("#token").val();
if (numero >= 17) {
    alertify.alert("ERROR","CAPACIDAD MAXIMA DE GALPONES");
    $('#loading').css("display","none");  
    $('#btnregistrar').show(); 
} else { 
capacidad_total=$("#capacidad_total").val();
tipo_galpon=$("#tipo_galpon").val();
        $.ajax({
            url: "galpon",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {numero: numero,capacidad_total:capacidad_total},
        success: function(){
            $('#btnregistrar').show(); 
            $('#loading').css("display","none");
            toastr.options.timeOut = 3000;
            toastr.options.positionClass = "toast-bottom-center";
            toastr.success('GUARDADO CON EXITO');
            $("#capacidad_total").val("");
            $("#numero").val("");
            //Cargar();
            $('.modal.in').modal('hide');
            $(location).attr('href', 'vistagalpon');  
        }, error: function (msj) {
            $('#btnregistrar').show();
            $('#loading').css("display","none");
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
            if (msj.responseJSON.capacidad_total !== undefined) {                
                toastr.error(msj.responseJSON.capacidad_total);
            }
            if (msj.responseJSON.numero !== undefined) {
                toastr.error(msj.responseJSON.numero);
            }            
        }
        });
}
}

function Mostrar(btn){
     $("#titulogalpon").text("DESEA ACTUALIZAR EL GALPON "+btn.value);
     var route = "galpon/"+btn.value+"/edit";
    $.get(route, function(res){
        $("#id_galpon_a").val(res.id);        
        $("#numero_a").val(res.numero);
        $("#capacidad_total_a").val(res.capacidad_total);
    });
}


function actualizar_galpon(){
 id=$("#id_galpon_a").val();
 numero=$("#numero_a").val();  
 capacidad_total=$("#capacidad_total_a").val();  
     route = "galpon/"+id;
     token = $("#token").val();     
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: {numero:numero,capacidad_total:capacidad_total},
        success: function () {
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-bottom-center";
            toastr.success('MODIFICADO CON EXITO');
            $('#myModaledit').modal('hide');
            Cargar();
            $('.modal.in').modal('hide');
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
            if (msj.responseJSON.capacidad_total !== undefined) {
                toastr.error(msj.responseJSON.capacidad_total);
            }
            if (msj.responseJSON.numero !== undefined) {
                toastr.error(msj.responseJSON.numero);
            }            
        }
    });
}

//REPORTE DADA DOS FECHAS
function Cargar_reporte(){
var cont=0;  
var x=0;     
var tabladatos=$("#datos_r");
var route = "listareporte/"+fecha_inicio+"/"+fecha_fin;
$("#datos_r").empty();
$.get(route,function(res){
    $("#datos_r").empty();
        $(res).each(function(key,value){
            var route_2 = "listareporte_aux/"+fecha_inicio+"/"+fecha_fin+"/"+value.id;
            $.get(route_2,function(res2){

            tabladatos.append("<tr style=background-color:white><td align=center>RENDIMIENTO DEL GALPON "+value.nombre+"</td></tr>"); 

                $(res2).each(function(key,value2){
                    if (cont==0) {
                        tabladatos.append("<tr style=background-color:#cef6f5><td align=center>"+value2.fase+"</td><td align=center> GALPON "+value2.nombre+"</td><td align=center>"+value2.muertas+"</td><td align=center>"+value2.cantidad_total+"</td><td align=center>"+value2.postura_p+" %</td></tr>");
                        $('#btnPDF').attr("disabled", false);  
                         x=0;                      
                    }else{
                        tabladatos.append("<tr style=background-color:#f5f6ce><td align=center>"+value2.fase+"</td><td align=center> GALPON "+value2.nombre+"</td><td align=center>"+value2.muertas+"</td><td align=center>"+value2.cantidad_total+"</td><td align=center>"+value2.postura_p+" %</td></tr>");
                        $('#btnPDF').attr("disabled", false);
                         x=1; 
                    }
                });        
                if (x==0) {
                    cont=1;
                }else{
                   cont=0; 
                }  
                             
            });
        });
    }); 
}

function limpiar_text() {  
    $("#capacidad_total").val("");
}

$("#tipo_galpon").change(function(event){
    var tipo_galpon = $("#tipo_galpon option:selected").val();
    $.get("tipogalpon/" + event.target.value, function (response) {   
     $("#id_galpon").val( response);
        $("#nombre").val("Galpon "+ response);
        $('input[name=id]').val(response);       
    }); 
});


//pdf
function cargar_fechas(){
var fechainicio = $('#fecha_inicio').val();
var fechafin = $('#fecha_fin').val();
 window.open('GerenerarReporte/'+fechainicio+'/'+fechafin);                                                    
}

//pdf de galpones ponedoras
function detalle_galpon_pdf(sw){
   var id_edad = $('#id_galpon').val();
   var galpon = $('#id_galpon option:selected').text();
   if (sw==0) {
        window.open("GerenerarReporte/"+id_edad+"/null/null/"+sw);
   }else{
        var fecha_inicio = $('#fecha_inicio').val();
        var fecha_fin = $('#fecha_fin').val();
        if (fecha_fin=="" || fecha_inicio=="") {
            alertify.alert("ADVERTENCIA","INTRODUSCA LAS FECHAS");
            return;
        }else{
            var primera = Date.parse(fecha_inicio); 
            var segunda = Date.parse(fecha_fin); 
            if (primera > segunda){
                toastr.options.timeOut = 9000;
                toastr.options.positionClass = "toast-top-right";
                toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!'); 
                return;
            }else{
                    window.open("GerenerarReporte/"+id_edad+"/"+fecha_inicio+"/"+fecha_fin+"/"+sw);
            }
        }
    }
}

//pdf de fases
function detalle_fases_pdf(){
    var id_edad = $('#id_fase').val();
    window.open("GerenerarReporteFase/"+id_edad);
}