var total = 0;
var cont = 0;
var subtotalprecio = [];
var id_tipo_huevo= [];
var cantidad_maple= [];
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
      $('#loading').css("display","none");  
    }     
});



function agregar_maple() {

    cantidad_maple[cont] = $('#cantidad_maples').val();
    if ((cantidad_maple[cont] != "") && (cantidad_maple[cont] != "0")) {
    tipo = $('#id_tipo_huevo option:selected').text();
        if (tipo=="SELECCIONE UN TIPO DE MAPLE") {
            alertify.alert("MENSAJE","SELECCIONE UN TIPO DE MAPLE");
        }
        else{
            for (var i = 0; i <= cont; i++) {
               if ( $('#id_tipo_huevo').val()==id_tipo_huevo[i]) {
                  alertify.alert("MENSAJE","YA EXISTE ESE TIPO DE MAPLE EN LA LISTA");
                  id_tipo_huevo[cont]=0;
                  cantidad_maple[cont]=0; 
                  cantidad_huevo[cont]=0;
                  return;
               }
            }
            id_tipo_huevo[cont] = $('#id_tipo_huevo').val();
            var route_2 = "dato_huevo_acumulado/"+id_tipo_huevo[cont];
            $.get(route_2,function(res_2){
            if (res_2[0].cantidad_maple >= cantidad_maple[cont]) {
                    $('#cant_maple'+id_tipo_huevo[cont]).val(parseInt(res_2[0].cantidad_maple) - parseInt(cantidad_maple[cont]));
                    $('#cant_huevo_tipo'+id_tipo_huevo[cont]).val(parseInt($('#cant_maple'+id_tipo_huevo[cont]).val()) * parseInt($('#cant_huevo'+id_tipo_huevo[cont]).val()));
                    var fecha = $('#fecha').val();
                    var tipo = $('#id_tipo_huevo option:selected').text();
                    var  precio_aux = $('#precio'+id_tipo_huevo[cont]).val();
                    var cant_huevo_aux = $('#cant_huevo'+id_tipo_huevo[cont]).val();
                    var subtotal= parseFloat(precio_aux) * parseInt(parseInt(cantidad_maple[cont]) * parseInt(cant_huevo_aux));
                    var cantidad_huevo = parseInt(cantidad_maple[cont]) * parseInt(cant_huevo_aux);
                    subtotalprecio[cont] = subtotal;
                    total=total+subtotalprecio[cont];
                    var fila = '<tr class="selected" id="fila' + cont + '" align="center"><td><button type="button" class="btn btn-danger" onclick="eliminar(' + cont + ')"><i class="fa fa-trash-o" aria-hidden="true"></i> ELIMINAR</button></td>\n\
                    <td><label>' + tipo + '</label><input name=id_tipo_huevo[] type="hidden" value='+id_tipo_huevo[cont]+'> <input readonly="" style="width:100px;height:30px;font-size:20px;text-align:center" name="cantidad_huevo[]" type="hidden" value='+cantidad_huevo+'> </td>\n\
                    <td><input readonly="" style="width:100px;height:30px;font-size:20px;text-align:center" name="cantidad_maple[]" type="text" value='+cantidad_maple[cont]+'></td>\n\
                    <td><input readonly="" style="width:100px;height:30px;font-size:20px;text-align:center" name="subtotal_precio[]" type="text" value='+subtotalprecio[cont].toFixed(2)+'> Bs.</td></tr>';
                    cont++;
                    $("#total").text(total.toFixed(2));
                    $("#monto_total").val(total.toFixed(2));
                    $('#cantidad_maples').val("");           
                    evaluar();
                    $('#detalles').append(fila);
                } else {
                    alertify.alert("MENSAJE","NO EXISTE ESA CANTIDAS DE MAPLES EN EL DEPOSITO");
                    id_tipo_huevo[cont]=0;
                    cantidad_maple[cont]=0;                  
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
   id_tipo_huevo[index]=0;
   cantidad_maple[index]=0;  
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
  alertify.confirm("DESEA REALIZAR ESTA VENTA",
  function(){
   var token = $("#token").val();
    var fecha = $('#fecha').val();
    var precio = $('#monto_total').val();

    $.ajax({
        url: "ventahuevo",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {fecha:fecha, precio:precio, estado:1},
    });

    var route = "obtener_id_venta_huevo_ultimo";
    $.get(route,function(res){
         for (var i = 0; i < cont; i++) {
            if (id_tipo_huevo[i]!=0 || cantidad_maple[i]!=0) {
              var cantidad_huevo = parseInt(cantidad_maple[i]) * parseInt($('#cant_huevo'+id_tipo_huevo[i]).val());
                $.ajax({
                    url: "detalleventahuevo",
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'POST',
                    dataType: 'json',
                    data: {id_tipo_huevo:id_tipo_huevo[i], id_venta_huevo:res[0].id, cantidad_maple:cantidad_maple[i], cantidad_huevo:cantidad_huevo ,subtotal_precio:subtotalprecio[i]},
                });

                var maple=$('#cant_maple'+id_tipo_huevo[i]).val();
                var huevo=$('#cant_huevo_tipo'+id_tipo_huevo[i]).val();
                $.ajax({
                    url: "huevodeposito",
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'POST',
                    dataType: 'json',
                    data: {cantidad_maple:maple, cantidad_huevo:huevo, id_tipo_huevo:id_tipo_huevo[i]},
                });
            } 
          }
         alertify.success('GUARDADO CORRRECTAMENTE');
         $(location).attr('href', 'ventahuevo');
    });
  },
  function(){
    alertify.error('VENTA CANCELADA');
 }); 
}
*/

