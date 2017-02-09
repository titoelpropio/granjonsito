$(document).ready(function () {
    if ($('#token').val()=="") {
        location.reload();
    }else{
        $('#oculta').hide(5000);    
        for (var i = 1; i <= 11; i++) {
            variacion(i);
        }
        $(function (){ $("#datetimepicker1").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
        $(function (){ $("#datetimepicker2").datetimepicker({ viewMode: 'days',  format: 'YYYY-MM-DD' }); });
        $('#btnPDF2').attr("disabled", true);
        $('#loading').css("display","none");
    }    
});

function obtener_id_silo(id_silo) {
$('#btncomprar'+id_silo).hide(); 
var cantidad = $("#cantidad"+id_silo).text();
var capacidad = $("#capacidad"+id_silo).text();
var id_sil = id_silo;
var nombre = $("#nombre"+id_silo).text();
var cantidad_total = $("#cantidad_total"+id_silo).val();
var precio_compra = $("#precio_compra"+id_silo).val();
 if (cantidad_total=="" || precio_compra=="") {
    alertify.alert('ERROR','INTRODUSCA LOS DATOS REQUERIDOS');
    $('#btncomprar'+id_silo).show();
 } else {
    var token = $("#token").val();
    var x=parseFloat(cantidad)+parseFloat(cantidad_total);
    if (x<=capacidad) {
      alertify.confirm("MENSAJE","DESEA REALIZAR ESTA COMPRA EN EL "+nombre,
      function(){
            $('#loading').css("display","block");            
            $.ajax({
                url: "compra",
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data: {precio_compra: precio_compra, cantidad_total: cantidad_total, id_silo: id_sil},
                success:function(){
                    $('#loading').css("display","none"); 
                    setTimeout("location.href='compra'",1000);   
                    alertify.success('COMPRA GUARDADO CORRECTAMENTE EN EL '+nombre);
                },
                error:function(){
                    $('#loading').css("display","none"); 
                    alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
                    setTimeout("location.href='compra'",3000);            
                }
            });
      },
      function(){        
        alertify.error('COMPRA CANCELADA');
        $("#cantidad_total"+id_silo).val("");
        $("#precio_compra"+id_silo).val("");
        $('#btncomprar'+id_silo).show();
     }); 
    }
    else{
        alertify.alert("MENSAJE","LA CANTIDAD ES MAYOR A LA CAPACIDAD!!!!");
        $("#cantidad_total"+id_silo).val("");
        $("#precio_compra"+id_silo).val("");
        $('#btncomprar'+id_silo).show(); 
    }
  }    
}

function llenar_silo(id_silo) {
var nombre = $("#nombre"+id_silo).text();    
  alertify.confirm("MENSAJE","DESEA LLENAR EL "+nombre,
  function(){       
    var cantidad = $("#cantidad"+id_silo).text();
    var capacidad = $("#capacidad"+id_silo).text();
    var x=capacidad-cantidad;
    $("#llenar"+id_silo).text(x.toFixed(1));
    $("#cantidad_total"+id_silo).val(x.toFixed(1));
  },
  function(){});     
}

function variacion(id_silo) {
    var cantidad = $("#cantidad"+id_silo).text();
    var capacidad = $("#capacidad"+id_silo).text();
    var x=capacidad-cantidad;
    if (x==0){
        $("#btnllenar"+id_silo).attr("disabled", true);
        $("#btncomprar"+id_silo).attr("disabled", true);
        $("#cantidad_total"+id_silo).attr("disabled", true);
        $("#precio_compra"+id_silo).attr("disabled", true);                
        $("#llenar"+id_silo).text(x.toFixed(1));
    } 
    else {
        $("#btnllenar"+id_silo).attr("disabled", false);
        $("#btncomprar"+id_silo).attr("disabled", false);
        $("#cantidad_total"+id_silo).attr("disabled", false);
        $("#precio_compra"+id_silo).attr("disabled", false);
        $("#llenar"+id_silo).text(x.toFixed(1));                
    }
}


//REPORTE DADA DOS FECHAS TOTAL
function Cargar_reporte_compra(){
var fecha_inicio = $('#fecha_inicio').val();
var fecha_fin = $('#fecha_fin').val();
    if (fecha_inicio == "" || fecha_fin == "") {
            alertify.alert("MENSAJE",'INTRODUSCA LAS FECHAS');
    } else {
        var tabladatos=$("#datos_rct");
        var route = "lista_reporte_compra/"+fecha_inicio+"/"+fecha_fin;
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
                $('#fecha').text(fecha_inicio+' / '+fecha_fin);
                if (value.detalle != 'saldo') {
                    tabladatos.append("<tr align=center><td>"+value.detalle+"</td><td>"+value.total+" Bs.</td></tr>");
                } else {
                    tabladatos.append("<tr style='background-color: #A9F5F2' align=center><td><font size=4 color=red>TOTAL</font></td><td><font size=4 color=red>"+value.total+" Bs.</font></td></tr>");
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
    window.open('Reporte_Compra_Alimento/'+fecha_inicio+'/'+fecha_fin);                                                    
}
