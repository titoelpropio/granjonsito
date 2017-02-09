$(document).ready(function(){
   for (var i=1;i<20;i++){
        $('#cantidad_caja_sobrante'+i).val($('#cant_caja_sobra'+i).text());
        $('#cant_caja_sobra_aux'+i).val($('#cant_caja_sobra'+i).text());
     
        $('#cantidad_huevo_sobrante'+i).val($('#cant_huevo_sobra'+i).text());
        $('#cant_huevo_sobra_aux'+i).val($('#cant_huevo_sobra'+i).text());
        //cargar(i);
    }
});


function extraer_id_tipo_caja(id){
    var id_tipo_caja=id;
    var cantidad_caja_sobrante = $("#cantidad_caja_sobrante"+id).val();
    var cantidad_huevo_sobrante = $("#cantidad_huevo_sobrante"+id).val();
    var estado = 1;
    $("#cantidad_caja_sobrante"+id).val(cantidad_caja_sobrante);
    $("#cantidad_huevo_sobrante"+id).val(cantidad_huevo_sobrante);
    $.ajax({
        url: "sobrante2",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {cantidad_caja: cantidad_caja_sobrante, cantidad_huevo:cantidad_huevo_sobrante, id_tipo_caja: id_tipo_caja, estado:estado},
    });
}

function cargar_sobrante(id){
    var id_tipo_caja=id;
    var cantidad_caja= $("#cantidad_caja"+id).val();
    var precio= $("#precio"+id).text();
    var cant_hue= $("#cant_hue"+id).text();
    var cant_map= $("#cant_map"+id).text();
    var cantidad_maple=cantidad_caja*cant_map;
    var cantidad_huevo=cantidad_maple*cant_hue;
    $("#cantidad_maple"+id).val(cantidad_maple);
    $("#cantidad_huevo"+id).val(cantidad_huevo);

    if ($("#cantidad_extra"+id).val()=="") {
        var maple_extra = 0;
        $("#cantidad_extra"+id).val(maple_extra);
    } else {
        var maple_extra= parseInt($("#cantidad_extra"+id).val());
        var x = maple_extra*cant_hue;
        cantidad_huevo=cantidad_huevo+x;
        $("#cantidad_huevo"+id).val(cantidad_huevo);
    }
}


//REPORTE DADA UNA FECHA DIARIO
function Cargar_reporte_caja_diario(){
var fecha_inicio = $('#fecha_inicio').val();
var tabladatos=$("#datos_rcd");
 var route = "/listareportecajadiario/"+fecha_inicio;
$("#datos_rcd").empty();

var total=0;

    $.get(route,function(res){
        $("#datos_rcd").empty();
       $(res).each(function(key,value){
    tabladatos.append("<tr><td align=center>"+value.fecha+"</td><td align=center>"+value.tipo+"</td><td align=center>"+value.cantidad+"</td><td align=center>"+value.total+" Bs.</td></tr>");
    total=total+parseFloat(value.total);
    });
    tabladatos.append("<tr><td align=center></td><td align=center></td><td align=center><font size=3 color=red>TOTAL</font></td><td align=center><font size=3 color=red>"+total+" Bs.</font></td></tr>");
    $('#btnPDF1').attr("disabled", false);
 });                                                                                                                                            
}


//REPORTE DADA DOS FECHAS
function Cargar_reporte_caja(){
var fecha_inicio = $('#fecha_inicio').val();
var fecha_fin = $('#fecha_fin').val();
var tabladatos=$("#datos_rc");
 var route = "/listareportecaja/"+fecha_inicio+"/"+fecha_fin;
$("#datos_rc").empty();

var total=0;

var primera = Date.parse(fecha_inicio); 
var segunda = Date.parse(fecha_fin); 
 
if (primera == segunda){
    $.get(route,function(res){
        $("#datos_rc").empty();
       $(res).each(function(key,value){
    tabladatos.append("<tr><td align=center>"+value.fecha+"</td><td align=center>"+value.tipo+"</td><td align=center>"+value.cantidad+"</td><td align=center>"+value.total+" Bs.</td></tr>");
    total=total+parseFloat(value.total);
    });
    tabladatos.append("<tr><td align=center></td><td align=center></td><td align=center><font size=3 color=red>TOTAL</font></td><td align=center><font size=3 color=red>"+total+" Bs.</font></td></tr>");
    $('#btnPDF2').attr("disabled", false);
 }); 
} else if (primera > segunda) {
   toastr.options.timeOut = 9000;
            toastr.options.positionClass = "toast-top-right";
            toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
} else{
        $.get(route,function(res){
            $("#datos_rc").empty();
       $(res).each(function(key,value){
    tabladatos.append("<tr><td align=center>"+value.fecha+"</td><td align=center>"+value.tipo+"</td><td align=center>"+value.cantidad+"</td><td align=center>"+value.total+" Bs.</td></tr>");
    total=total+parseFloat(value.total);
    });
    tabladatos.append("<tr><td align=center></td><td align=center></td><td align=center><font size=3 color=red>TOTAL</font></td><td align=center><font size=3 color=red>"+total+" Bs.</font></td></tr>");
    $('#btnPDF2').attr("disabled", false);
    }); 
}                                                                                                                                            
}


//REPORTE DADA DOS FECHAS TOTAL
function Cargar_reporte_caja_total(){
var fecha_inicio = $('#fecha_inicio').val();
var fecha_fin = $('#fecha_fin').val();
var tabladatos=$("#datos_rct");
 var route = "/listareportecajatotal/"+fecha_inicio+"/"+fecha_fin;
$("#datos_rct").empty();

var total=0;

var primera = Date.parse(fecha_inicio); 
var segunda = Date.parse(fecha_fin); 
 
if (primera == segunda){
    $.get(route,function(res){
        $("#datos_rct").empty();
       $(res).each(function(key,value){
    tabladatos.append("<tr><td align=center>"+value.tipo+"</td><td align=center>"+value.cantidad+"</td><td align=center>"+value.total+" Bs.</td></tr>");
    total=total+parseFloat(value.total);
    });
    tabladatos.append("<tr><td align=center></td><td align=center><font size=3 color=red>TOTAL</font></td><td align=center><font size=3 color=red>"+total+" Bs.</font></td></tr>");
    $('#btnPDF2').attr("disabled", false);
 }); 
} else if (primera > segunda) {
   toastr.options.timeOut = 9000;
            toastr.options.positionClass = "toast-top-right";
            toastr.success('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
} else{
        $.get(route,function(res){
            $("#datos_rct").empty();
       $(res).each(function(key,value){
    tabladatos.append("<tr><td align=center>"+value.tipo+"</td><td align=center>"+value.cantidad+"</td><td align=center>"+value.total+" Bs.</td></tr>");
    total=total+parseFloat(value.total);
    });
       tabladatos.append("<tr><td align=center></td><td align=center><font size=3 color=red>TOTAL</font></td><td align=center><font size=3 color=red>"+total+" Bs.</font></td></tr>");
       $('#btnPDF2').attr("disabled", false);
    }); 
}                                                                                                                                            
}


function cargar_fechas(){
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val(); 
    window.open('/Reporte_Venta_Caja/'+fecha_inicio+'/'+fecha_fin);                                                    
}

function cargar_diario(){
    var fecha = $('#fecha_inicio').val();
    window.open('/Reporte_Venta_Caja_Diario/'+fecha);
}
