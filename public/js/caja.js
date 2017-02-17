$(document).ready(function(){
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if (dd < 10) { dd = '0' + dd }

    if (mm < 10) { mm = '0' + mm  }
    hoy = yyyy + '-' + mm + '-' + dd;

    $('#fecha_inicio').val(hoy);
    $('#fecha_inicio2').val(hoy);
    $('#fecha_fin').val(hoy);
    $('#fecha_fin2').val(hoy);

    $(function (){ $("#datetimepicker1").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
    $(function (){ $("#datetimepicker2").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
    $(function (){ $("#datetimepicker3").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
    $(function (){ $("#datetimepicker4").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });

    $('#btnPDF1').attr("disabled", true);
    $('#btnPDF2').attr("disabled", true);
});

//LISTA CAJA DADA DOS FECHAS 
function cargar_lista_caja(){
var cont = 0;   
var total = 0; 
var x = 0;
var fecha_inicio = $('#fecha_inicio').val();
var fecha_fin = $('#fecha_fin').val();
    if (fecha_inicio == "" || fecha_fin == "") {
            alertify.alert("MENSAJE",'INTRODUSCA LAS FECHAS');
    } else {
        var tabladatos=$("#datos_c1");
        var route = "lista_reporte_caja/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_c1").empty();
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
           toastr.options.timeOut = 9000;
                    toastr.options.positionClass = "toast-top-right";
                    toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        } else{
            $.get(route,function(res){
                $("#datos_c1").empty();

                for (var i = 0; i < res.length; i++) {
                    if (cont == 0) {
                        for (var j = 0; j < res[i].length; j++) {
                            total = parseInt(total) + parseInt(res[i][j].cantidad_caja);
                          if (x==0) {
                            tabladatos.append("<tr align=center style=background-color:#f4f4f4 onmouseover='this.style.backgroundColor=\"white\"' onmouseout='this.style.backgroundColor=\"#f2f2f2\"'><td>"+res[i][j].tipo+"</td><td>"+res[i][j].cantidad_caja+"</td><td rowspan="+res[i].length+" style='font-size:20px'>"+res[i][j].fecha+"</td></tr>"); 
                            x=1;
                          } else {
                            tabladatos.append("<tr align=center style=background-color:#f4f4f4 onmouseover='this.style.backgroundColor=\"white\"' onmouseout='this.style.backgroundColor=\"#f2f2f2\"'><td>"+res[i][j].tipo+"</td><td>"+res[i][j].cantidad_caja+"</td></tr>");  
                          }
                        }
                        x=0;
                        cont = 1;
                    } else {
                        for (var j = 0; j < res[i].length; j++) {
                            total = parseInt(total) + parseInt(res[i][j].cantidad_caja);
                          if (x==0) {
                            tabladatos.append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#f2f2f2\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+res[i][j].tipo+"</td><td>"+res[i][j].cantidad_caja+"</td><td rowspan="+res[i].length+" style='font-size:20px'>"+res[i][j].fecha+"</td></tr>");                            
                            x=1;
                          } else {
                            tabladatos.append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#f2f2f2\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+res[i][j].tipo+"</td><td>"+res[i][j].cantidad_caja+"</td></tr>");                            
                          }
                        }
                        x=0;
                        cont = 0;
                    }     
                    tabladatos.append("<tr align=center style=background-color:#CEF6F5><td style='color:red; font-size:17px'>TOTAL</td><td style='color:red; font-size:17px'>"+total+"</td><td></td></tr>");                                                               
                    total=0;
                }
            }); 
        }                                                                                                                                            
    }
}

//LISTA CAJA DADA DOS FECHAS  2
function cargar_lista_caja_2(){
var fecha_inicio = $('#fecha_inicio2').val();
var total = 0;
var fecha_fin = $('#fecha_fin2').val();
    if (fecha_inicio == "" || fecha_fin == "") {
            alertify.alert("MENSAJE",'INTRODUSCA LAS FECHAS');
    } else {
        var tabladatos=$("#datos_c2");
        var route = "lista_reporte_caja_total/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_c2").empty();
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
           toastr.options.timeOut = 9000;
                    toastr.options.positionClass = "toast-top-right";
                    toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        } else{
            $.get(route,function(res){
                $("#datos_c2").empty();
                $(res).each(function(key,value){
                    $('#fecha').text("DEL "+fecha_inicio+' / '+fecha_fin); 
                    total = parseInt(total) + parseInt(value.cantidad_caja);
                    tabladatos.append("<tr align=center><td>"+value.tipo+"</td><td>"+value.cantidad_caja+"</td></tr>");
                });
                tabladatos.append("<tr align=center style='background-color:#f1948a;font-size:18px'><td>TOTAL CAJAS</td><td>"+total+"</td></tr>");
            }); 
        }                                                                                                                                            
    }
}

//LISTA CAJA DADA DOS FECHAS  1
function cargar_lista_caja_1(){
var fecha_inicio = $('#fecha_inicio').val();
var fecha_fin = $('#fecha_fin').val();
var total = 0;
    if (fecha_inicio == "" || fecha_fin == "") {
            alertify.alert("MENSAJE",'INTRODUSCA LAS FECHAS');
    } else {
        var tabladatos=$("#datos_c1");
        var route = "lista_reporte_caja_total/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_c1").empty();
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
           toastr.options.timeOut = 9000;
                    toastr.options.positionClass = "toast-top-right";
                    toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        } else{
            $.get(route,function(res){
                $("#datos_c1").empty();
                $(res).each(function(key,value){
                    $('#fecha').text("DEL "+fecha_inicio+' / '+fecha_fin);
                    total = parseInt(total) + parseInt(value.cantidad_caja);
                    tabladatos.append("<tr align=center><td>"+value.tipo+"</td><td>"+value.cantidad_caja+"</td></tr>");
                });
                tabladatos.append("<tr align=center style='background-color:#f1948a;font-size:18px'><td>TOTAL CAJAS</td><td>"+total+"</td></tr>");
            }); 
        }                                                                                                                                            
    }
}



//LISTA MAPLES DADA DOS FECHAS 
function cargar_lista_maple(){
var cont = 0;  
var x = 0; 
var total_maple = 0;
var total_huevo = 0; 
var fecha_inicio = $('#fecha_inicio').val();
var fecha_fin = $('#fecha_fin').val();
    if (fecha_inicio == "" || fecha_fin == "") {
            alertify.alert("MENSAJE",'INTRODUSCA LAS FECHAS');
    } else {
        var tabladatos=$("#datos_c1");
        var route = "lista_reporte_maple/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_c1").empty();
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
           toastr.options.timeOut = 9000;
            toastr.options.positionClass = "toast-top-right";
            toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        } else{
            $.get(route,function(res){
                $("#datos_c1").empty();

                for (var i = 0; i < res.length; i++) {
                    if (cont == 0) {
                        for (var j = 0; j < res[i].length; j++) {
                          total_maple = parseInt(total_maple) + parseInt(res[i][j].cantidad_maple);
                          total_huevo = parseInt(total_huevo) + parseInt(res[i][j].cantidad_huevo);  
                          if (x==0) { 
                            tabladatos.append("<tr align=center style=background-color:#f2f2f2 onmouseover='this.style.backgroundColor=\"white\"' onmouseout='this.style.backgroundColor=\"#f2f2f2\"'><td>"+res[i][j].tipo+"</td><td>"+res[i][j].cantidad_maple+"</td><td>"+res[i][j].cantidad_huevo+"</td><td rowspan="+res[i].length+" style='font-size:20px'>"+res[i][j].fecha+"</td></tr>");                            
                            x=1;
                          } else {
                            tabladatos.append("<tr align=center style=background-color:#f2f2f2 onmouseover='this.style.backgroundColor=\"white\"' onmouseout='this.style.backgroundColor=\"#f2f2f2\"'><td>"+res[i][j].tipo+"</td><td>"+res[i][j].cantidad_maple+"</td><td>"+res[i][j].cantidad_huevo+"</td></tr>");                                                        
                          }
                        }
                        x=0;
                        cont = 1;
                    } else {
                        for (var j = 0; j < res[i].length; j++) {
                            total_maple = parseInt(total_maple) + parseInt(res[i][j].cantidad_maple);
                            total_huevo = parseInt(total_huevo) + parseInt(res[i][j].cantidad_huevo);  
                            if (x==0) {
                                tabladatos.append("<tr align=center style=background-color:white onmouseover='this.style.backgroundColor=\"#f2f2f2\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+res[i][j].tipo+"</td><td>"+res[i][j].cantidad_maple+"</td><td>"+res[i][j].cantidad_huevo+"</td><td rowspan="+res[i].length+" style='font-size:20px'>"+res[i][j].fecha+"</td></tr>");                            
                                x=1;
                            } else {
                                tabladatos.append("<tr align=center style=background-color:white onmouseover='this.style.backgroundColor=\"#f2f2f2\"' onmouseout='this.style.backgroundColor=\"white\"'><td>"+res[i][j].tipo+"</td><td>"+res[i][j].cantidad_maple+"</td><td>"+res[i][j].cantidad_huevo+"</td></tr>");                            
                            }                             
                        }
                        x=0;
                        cont = 0;
                    }   
                    tabladatos.append("<tr align=center style=background-color:#CEF6F5><td style='color:red; font-size:17px'>TOTAL</td><td style='color:red; font-size:17px;'>"+total_maple+"</td><td style='color:red; font-size:17px'>"+total_huevo+"</td><td></td></tr>");                            
                    total_maple=0;
                    total_huevo=0;
                }
            }); 
        }                                                                                                                                            
    }
}

//LISTA MAPLE DADA DOS FECHAS  2
function cargar_lista_maple_2(){
var fecha_inicio = $('#fecha_inicio2').val();
var total_maple = 0;
var total_huevo = 0;
var fecha_fin = $('#fecha_fin2').val();
    if (fecha_inicio == "" || fecha_fin == "") {
            alertify.alert("MENSAJE",'INTRODUSCA LAS FECHAS');
    } else {
        var tabladatos=$("#datos_c2");
        var route = "lista_reporte_maple_total/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_c2").empty();
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
           toastr.options.timeOut = 9000;
                    toastr.options.positionClass = "toast-top-right";
                    toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        } else{
            $.get(route,function(res){
                $("#datos_c2").empty();
                $(res).each(function(key,value){
                    $('#fecha').text("DEL "+fecha_inicio+' / '+fecha_fin); 
                    total_maple = parseInt(total_maple) + parseInt(value.cantidad_maple);
                    total_huevo = parseInt(total_huevo) + parseInt(value.cantidad_huevo);
                    tabladatos.append("<tr align=center><td>"+value.tipo+"</td><td>"+value.cantidad_maple+"</td><td>"+value.cantidad_huevo+"</td></tr>");                            
                });
                tabladatos.append("<tr align=center style='background-color:#f1948a; font-size:18px' ><td>TOTAL</td><td>"+total_maple+"</td><td>"+total_huevo+"</td></tr>");
            }); 
        }                                                                                                                                            
    }
}

//LISTA MAPLE DADA DOS FECHAS  1
function cargar_lista_maple_1(){
var fecha_inicio = $('#fecha_inicio').val();
var fecha_fin = $('#fecha_fin').val();
var total_maple = 0;
var total_huevo = 0;
    if (fecha_inicio == "" || fecha_fin == "") {
            alertify.alert("MENSAJE",'INTRODUSCA LAS FECHAS');
    } else {
        var tabladatos=$("#datos_c1");
        var route = "lista_reporte_maple_total/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_c1").empty();
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
           toastr.options.timeOut = 9000;
                    toastr.options.positionClass = "toast-top-right";
                    toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        } else{
            $.get(route,function(res){
                $("#datos_c1").empty();
                $(res).each(function(key,value){
                    $('#fecha').text("DEL "+fecha_inicio+' / '+fecha_fin);
                    total_maple = parseInt(total_maple) + parseInt(value.cantidad_maple);
                    total_huevo = parseInt(total_huevo) + parseInt(value.cantidad_huevo);
                    tabladatos.append("<tr align=center><td>"+value.tipo+"</td><td>"+value.cantidad_maple+"</td><td>"+value.cantidad_huevo+"</td></tr>");                            
                });
                tabladatos.append("<tr align=center style='background-color:#f1948a; font-size:18px'><td>TOTAL</td><td>"+total_maple+"</td><td>"+total_huevo+"</td></tr>");
            }); 
        }                                                                                                                                            
    }
}
























//REPORTE DADA UNA FECHA DIARIO
function Cargar_reporte_caja_diario(){
var fecha_inicio = $('#fecha_inicio').val();
var cantidad_caja = 0;
if (fecha_inicio == "") {
    alertify.alert("ADVERTENCIA","INTRODUSCA LA FECHA");
} else {
    var tabladatos=$("#datos_rcd");
    var route = "listareportecajadiario/"+fecha_inicio;
    $("#datos_rcd").empty();
        $.get(route,function(res){
            $("#datos_rcd").empty();
            $(res).each(function(key,value){
            $('#fecha').text(' DEL '+fecha_inicio);
            if (value.tipo != 'total') {
                cantidad_caja=parseInt(cantidad_caja)+parseInt(value.cantidad);
                tabladatos.append("<tr align=center><td>"+value.tipo+"</td><td>"+value.cantidad+"</td><td>"+value.total+" Bs.</td></tr>");
            } else {
                tabladatos.append("<tr style='background-color: #A9F5F2' align=center><td><font size=4 color=red>TOTAL</font></td><td><font size=4 color=red>"+cantidad_caja+"</font></td><td><font size=4 color=red>"+value.total+" Bs.</font></td></tr>");
                $('#btnPDF1').attr("disabled", false);
            }
        });
     });  
 }                                                                                                                                          
}

//REPORTE DADA DOS FECHAS TOTAL
function Cargar_reporte_caja_total(){
var fecha_inicio = $('#fecha_inicio').val();
var cantidad_caja = 0;
var fecha_fin = $('#fecha_fin').val();
    if (fecha_inicio == "" || fecha_fin == "") {
            alertify.alert("ADVERTENCIA",'INTRODUSCA LAS FECHAS');
    } else {
        var tabladatos=$("#datos_rct");
        var route = "listareportecajatotal/"+fecha_inicio+"/"+fecha_fin;
        $("#datos_rct").empty();

        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
         
        if (primera > segunda) {
           toastr.options.timeOut = 9000;
                    toastr.options.positionClass = "toast-top-right";
                    toastr.error('LA FECHA HASTA TIENE QUE SER MAYOR A LA FECHA DESDE!!!');
        } else{
            $.get(route,function(res){
                    $("#datos_rct").empty();
               $(res).each(function(key,value){
                $('#fecha').text('DEL '+ fecha_inicio+' / '+fecha_fin);
                if (value.tipo != 'total') {
                    cantidad_caja=parseInt(cantidad_caja)+parseInt(value.cantidad);
                    tabladatos.append("<tr align=center><td>"+value.tipo+"</td><td>"+value.cantidad+"</td><td>"+value.total+" Bs.</td></tr>");
                } else {
                    tabladatos.append("<tr style='background-color: #A9F5F2' align=center><td><font size=4 color=red>TOTAL</font></td><td><font size=4 color=red>"+cantidad_caja+"</font></td><td><font size=4 color=red>"+value.total+" Bs.</font></td></tr>");
                    $('#btnPDF2').attr("disabled", false);
                }
                });
            }); 
        }                                                                                                                                            
    }
}




function cargar_fechas(){
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val(); 
    window.open('Reporte_Venta_Caja/'+fecha_inicio+'/'+fecha_fin);                                                    
}

function cargar_diario(){
    var fecha = $('#fecha_inicio').val();
    window.open('Reporte_Venta_Caja_Diario/'+fecha);
}
