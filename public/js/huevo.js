$(document).ready(function(){
    for (var i=1;i<15;i++){
    $('#cantidad_h'+i).val($('#cant_hu'+i).text());
    $('#cantidad_haux'+i).val($('#cant_hu'+i).text());
    }

    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    hoy = yyyy + '-' + mm + '-' + dd;
    $('#fecha_inicio').val(hoy);
    $('#fecha_fin').val(hoy);
    $(function (){ $("#datetimepicker1").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
    $(function (){ $("#datetimepicker2").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
    $('#btnPDF_1').attr("disabled", true);
    $('#btnPDF_2').attr("disabled", true);
    $('#loading').css("display","none");    
});

function extraer_id_tipo_huevo(id){
$("#id_tipo_h").val(id);
var cantidad= $("#cantidad_h"+id).val();
var cantidadaux= $("#cantidad_haux"+id).val();
    if (cantidad<cantidadaux) {
            var xx=cantidadaux-cantidad;
            var x = parseInt($("#postura").text())+xx;
            var sw = 1;
        } else {
            var xx=cantidad-cantidadaux;
            var x = parseInt($("#postura").text())-xx;
            var sw = 1;
        }
if (x>=0){
if (x==0){
$("#postura").text(x);
$("#cantidad_haux"+id).val($("#cantidad_h"+id).val());
var total=$("#precio_h"+id).text()*cantidad;
var id_tipo_huevo= id;

var aux =0;
for (var i = 0; i <= 15; i++) {
   if ( isNaN( parseInt($("#cantidad_h"+[i]).val())) ){}
   else{ aux=aux+parseInt($("#cantidad_h"+[i]).val()); }
    $("#total_h").text(aux);
}
        $.ajax({
            url: "huevo2",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'json',
            data: {cantidad: cantidad,id_tipo_huevo: id_tipo_huevo,total:total},
        });   
} 
else {

if (sw==1){

$("#postura").text(x);
$("#cantidad_haux"+id).val($("#cantidad_h"+id).val());

var total=$("#precio_h"+id).text()*cantidad;
var id_tipo_huevo= id;

var aux =0;
for (var i = 0; i <= 3; i++) {
   if ( isNaN( parseInt($("#cantidad_h"+[i]).val())) ){}
   else{ aux=aux+parseInt($("#cantidad_h"+[i]).val()); }
    $("#total_h").text(aux);
}
        $.ajax({
            url: "huevo2",
            headers: {'X-CSRF-TOKEN': token},
            type: 'GET',
            dataType: 'json',
            data: {cantidad: cantidad,id_tipo_huevo: id_tipo_huevo,total:total},
        });
 }   
 else{
    alert("ERROR","NO EXISTE ESA CANTIDAD DE HUEVO!!!!");
    $("#cantidad_h"+id).val(cantidadaux);
 }
}
}
else{
    alert("ERROR","NO EXISTE ESA CANTIDAD DE HUEVO!!!!");
    $("#cantidad_h"+id).val(cantidadaux);
}
} 



//REPORTE DADA UNA FECHA DIARIO
function Cargar_reporte_huevo_diario(){
var fecha_inicio = $('#fecha_inicio').val();
var cantidad_maple = 0;
if (fecha_inicio == "") {
    alertify.alert("ERROR","INTRODUSCA LA FECHA");
} else {
var tabladatos=$("#datos_rhd");
 var route = "listareportehuevodiario/"+fecha_inicio;
$("#datos_rhd").empty();

    $.get(route,function(res){
        $("#datos_rhd").empty();
       $(res).each(function(key,value){

        if (value.tipo != "total") {
            cantidad_maple = parseInt(cantidad_maple) + parseInt(value.cantidad);
            $("#fecha").text('DEL '+fecha_inicio);
            tabladatos.append("<tr align=center><td>"+value.tipo+"</td><td>"+value.cantidad+"</td><td>"+value.total+" Bs.</td></tr>");
        } else {
           tabladatos.append("<tr style='background-color: #A9F5F2' align=center><td><font size=4 color=red>TOTAL</font></td><td><font size=4 color=red>"+cantidad_maple+"</font></td><td><font size=4 color=red>"+value.total+" Bs.</font></td></tr>");
           $('#btnPDF_1').attr("disabled", false);
        }
    });
 });
 }                                                                                                                                            
}


//REPORTE DADA DOS FECHAS TOTAL
function Cargar_reporte_huevo_total(){
var cantidad_maple = 0;    
var fecha_inicio = $('#fecha_inicio').val();
var fecha_fin = $('#fecha_fin').val();
if (fecha_fin=="" || fecha_inicio=="") {
    alertify.alert("ERROR",'INTRODUSCA LAS FECHAS PORFAVOR');
} else {
var tabladatos=$("#datos_rht");
 var route = "listareportehuevototal/"+fecha_inicio+"/"+fecha_fin;
$("#datos_rht").empty();
var primera = Date.parse(fecha_inicio); 
var segunda = Date.parse(fecha_fin); 
 
if (primera > segunda) {
   toastr.options.timeOut = 9000;
            toastr.options.positionClass = "toast-top-right";
            toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
} else{
    $.get(route,function(res){
            $("#datos_rht").empty();
       $(res).each(function(key,value){ 
        if (value.tipo != "total") {
            cantidad_maple = parseInt(cantidad_maple) + parseInt(value.cantidad);
            $("#fecha").text(fecha_inicio+'  /  '+fecha_fin);
            tabladatos.append("<tr align=center><td>"+value.tipo+"</td><td>"+value.cantidad+"</td><td>"+value.total+" Bs.</td></tr>");
        } else {
           tabladatos.append("<tr style='background-color: #A9F5F2' align=center><td><font size=4 color=red>TOTAL</font></td><td><font size=4 color=red>"+cantidad_maple+"</font></td><td><font size=4 color=red>"+value.total+" Bs.</font></td></tr>");
           $('#btnPDF_2').attr("disabled", false);
        }
        });
    }); 
}                                                                                                                                           
}                                                                                                                                
}

function cargar_fechas(){
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val(); 
    window.open('Reporte_Venta_Huevo/'+fecha_inicio+'/'+fecha_fin);                                                    
}

function fecha_diario(){
    var fecha = $('#fecha_inicio').val();
    window.open('Reporte_Venta_Huevo_Diario/'+fecha);
}