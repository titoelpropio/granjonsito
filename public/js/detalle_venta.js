var total = 0;
var cont = 0;
var subtotalprecio = [];
var id_tipo_caja= [];
var cantidad_caja= [];
$(document).ready(function () {
    if ($('#token').val()=="") {
        location.reload();
    }else{
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth() + 1; //hoy es 0!
        var yyyy = hoy.getFullYear();
        if (dd < 10) {  dd = '0' + dd  }
        if (mm < 10) {  mm = '0' + mm  }
        hoy = yyyy + '-' + mm + '-' + dd;
        var fecha = $('#fecha').val(hoy);

        $('#guardar').hide();
        $('#cancelar').hide();
        $('#nuevo').hide();
        $('#loading').css("display","none");    
    }     
});



function agregar() {
    cantidad_caja[cont] = $('#cantidad_cajas').val();
    if ((cantidad_caja[cont] != "") && (cantidad_caja[cont] != "0")) {
    tipo = $('#id_tipo_caja option:selected').text();
        if (tipo=="SELECCIONE UN TIPO DE CAJA") {
            alertify.alert("MENSAJE","SELECCIONE UN TIPO DE CAJA");
        }
        else{
            for (var i = 0; i <= cont; i++) {
               if ( $('#id_tipo_caja').val()==id_tipo_caja[i]) {
                  alertify.alert("MENSAJE","YA EXISTE ESE TIPO DE CAJA EN LA LISTA");
                  id_tipo_caja[cont]=0;
                  cantidad_caja[cont]=0; 
                  return;
               }
            }
            id_tipo_caja[cont] = $('#id_tipo_caja').val();
            var route_2 = "dato_caja_acumulado_venta/"+id_tipo_caja[cont];
            $.get(route_2,function(res_2){
            if (res_2[0].cantidad_caja >= cantidad_caja[cont]) {
                    $('#cant_caja'+id_tipo_caja[cont]).val(parseInt(res_2[0].cantidad_caja) - parseInt(cantidad_caja[cont]));
                    $('#cant_maple_dep'+id_tipo_caja[cont]).val(parseInt($('#cant_caja'+id_tipo_caja[cont]).val()) * parseInt($('#cant_maple_tipo'+id_tipo_caja[cont]).val()));
                    var fecha = $('#fecha').val();
                    var tipo = $('#id_tipo_caja option:selected').text();
                    var  precio_aux = $('#precio'+id_tipo_caja[cont]).val();
                    var cant_maple_aux = $('#cant_maple'+id_tipo_caja[cont]).val();
                    var cant_huevo_aux = $('#cant_huevo'+id_tipo_caja[cont]).val();
                    var subtotal= parseFloat(precio_aux) * parseInt(parseInt(parseInt(cantidad_caja[cont]) * parseInt(cant_maple_aux)) * parseInt(cant_huevo_aux));
                    subtotalprecio[cont] = subtotal;
                    total=total+subtotalprecio[cont];
                    var fila = '<tr class="selected" id="fila' + cont + '" align="center"><td><button type="button" class="btn btn-danger" onclick="eliminar(' + cont + ')"><i class="fa fa-trash-o" aria-hidden="true"></i> ELIMINAR</button></td>\n\
                    <td><label>' + tipo + '</label><input name="id_tipo_caja[]" type="hidden" value='+id_tipo_caja[cont]+'></td>\n\
                    <td><input readonly="" style="width:100px;height:30px;font-size:20px;text-align:center" name="cantidad_caja[]" type="text" value='+cantidad_caja[cont]+'></td>\n\
                    <td><input readonly="" style="width:100px;height:30px;font-size:20px;text-align:center" name="subtotal_precio[]" type="text" value='+subtotalprecio[cont].toFixed(2)+'> Bs.</td></tr>';                    
                    cont++;
                    $("#total").text(total.toFixed(2));
                    $("#monto_total").val(total.toFixed(2));
                    $('#cantidad_cajas').val("");           
                    evaluar();
                    $('#detalles').append(fila);
                } else {
                    alertify.alert("MENSAJE","NO EXISTE ESA CANTIDAS DE CAJAS EN EL DEPOSITO");
                    id_tipo_caja[cont]=0;
                    cantidad_caja[cont]=0; 
                    return;
                }
            });
        }
    }
    else {
         alertify.alert("MENSAJE","INTRODUSCA TODOS LOS DATOS REQUERIDOS");       
    }
}



function eliminar(index) {
   id_tipo_caja[index]=0;
   cantidad_caja[index]=0;   
   total = total - subtotalprecio[index];
   $("#total").text(total.toFixed(2));
   $("#monto_total").val(total.toFixed(2));
   $('#fila' + index).remove();
   evaluar();
}

function evaluar() {
    if (total > 0) {
        $('#guardar').show();
        $('#cancelar').show();
    } else {
        $('#guardar').hide();
        $('#cancelar').hide();
    }
}

function ocultar(){
    $('#guardar').hide();
}
/*
function guardar(){
  alertify.confirm("MENSAJE","DESEA REALIZAR ESTA VENTA",
  function(){
    $('#guardar').hide();
    $('#cancelar').hide();    
    $('#nuevo').show();
   var token = $("#token").val();
    var fecha = $('#fecha').val();
    var precio = $('#monto_total').val();
    $.ajax({
        url: "ventacaja",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {fecha:fecha, precio:precio, estado:1},
        success:function(data){
            var id = data.id;
            for (var i = 0; i < cont; i++) {
            if (id_tipo_caja[i]!=0 || cantidad_caja[i]!=0) {
                $.ajax({
                    url: "detalleventa",
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'POST',
                    dataType: 'json',
                    data: {id_tipo_caja:id_tipo_caja[i], id_venta_caja:id, cantidad_caja:cantidad_caja[i], subtotal_precio:subtotalprecio[i]},
                    error:function(){
                        alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 1");
                    },                    
                });
                var caja=$('#cant_caja'+id_tipo_caja[i]).val();
                var maple=$('#cant_maple_dep'+id_tipo_caja[i]).val();
                $.ajax({
                    url: "cajadeposito",
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'POST',
                    dataType: 'json',
                    data: {cantidad_caja:caja, cantidad_maple:maple, id_tipo_caja:id_tipo_caja[i]},
                    error:function(){
                        alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 2");
                    },
                });
            } 
          }
         alertify.success('GUARDADO CORRRECTAMENTE');
       //  $(location).attr('href', 'ventacaja');
        }
    });
  },
  function(){
    alertify.error('VENTA CANCELADA');
 }); 
}
*/
/* ASI ESTABA ANTES EL GUARDAR VENTA
function guardar(){
  alertify.confirm("DESEA REALIZAR ESTA VENTA",
  function(){
   var token = $("#token").val();
    var fecha = $('#fecha').val();
    var precio = $('#monto_total').val();
    $.ajax({
        url: "ventacaja",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {fecha:fecha, precio:precio, estado:1},
    });
    var route = "obtener_id_venta_ultimo";
    $.get(route,function(res){
         for (var i = 0; i < cont; i++) {
            if (id_tipo_caja[i]!=0 || cantidad_caja[i]!=0) {
                $.ajax({
                    url: "detalleventa",
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'POST',
                    dataType: 'json',
                    data: {id_tipo_caja:id_tipo_caja[i], id_venta_caja:res[0].id, cantidad_caja:cantidad_caja[i], subtotal_precio:subtotalprecio[i]},
                });
                var caja=$('#cant_caja'+id_tipo_caja[i]).val();
                var maple=$('#cant_maple_dep'+id_tipo_caja[i]).val();
                $.ajax({
                    url: "cajadeposito",
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'POST',
                    dataType: 'json',
                    data: {cantidad_caja:caja, cantidad_maple:maple, id_tipo_caja:id_tipo_caja[i]},
                });
            } 
          }
         alertify.success('GUARDADO CORRRECTAMENTE');
         //$(location).attr('href', 'ventacaja');
    });
  },
  function(){
    alertify.error('VENTA CANCELADA');
 }); 
}*/

