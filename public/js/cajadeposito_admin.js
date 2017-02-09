var cont = 0;
var cant_caja = [];
input =0;
var sw =0;
$(document).ready(function(){
  /*if ($('#token').val()=="") {
      location.reload();
  }else{*/
      var hoy = new Date();
      var dd = hoy.getDate();
      var mm = hoy.getMonth() + 1; //hoy es 0!
      var yyyy = hoy.getFullYear();
      if (dd < 10) {  dd = '0' + dd  }
      if (mm < 10) {  mm = '0' + mm  }
      hoy = yyyy + '-' + mm + '-' + dd;
      $('#fecha').val(hoy);

      var route_inicio="caja_deposito"
      $.get(route_inicio, function (rescaja) {
          $(rescaja).each(function (key, value) {

                if ( isNaN(parseInt($("#cantidad_caja_dia"+value.id).val())) ){
                    $('#caja_diario_aux'+value.id).val(0); 
               }
                else{  
                    $('#caja_diario'+value.id).val(parseInt($("#cantidad_caja_dia"+value.id).val()));
                    $('#caja_diario_aux'+value.id).val(parseInt($("#cantidad_caja_dia"+value.id).val()));                     
                }

                if ( isNaN(parseInt($("#cantidad_caja_acumulado"+value.id).val())) ){
                   $('#caja_acumulado_aux'+value.id).val(0);   
               }
                else{ 
                    $('#caja_acumulado'+value.id).val(parseInt($("#cantidad_caja_acumulado"+value.id).val()));
                    $('#caja_acumulado_aux'+value.id).val(parseInt($("#cantidad_caja_acumulado"+value.id).val()));            
                }
                if (!isNaN(parseInt($("#cantidad_huevo"+value.id).val()))) {
                    $("#maple_sobrante"+value.id).val($("#cantidad_caja"+value.id).val());
                    $("#huevo_sobrante"+value.id).val($("#cantidad_huevo"+value.id).val());
                }                 
          });
      });

      var route_inicio_huevo="huevo_deposito"
      $.get(route_inicio_huevo, function (reshuevo) {
          $(reshuevo).each(function (key, value) {

              if ( isNaN(parseInt($("#cantidad_huevo_aux"+value.id).val())) ){
                    $("#cantidad_tipo_huevo_aux"+value.id).val(0); 
               }
                else{ 
                    $('#cantidad_tipo_huevo_aux'+value.id).val(parseInt($("#cantidad_huevo_aux"+value.id).val()));
                    $('#cantidad_tipo_huevo'+value.id).val(parseInt($("#cantidad_huevo_aux"+value.id).val()));            
                }

               if ( isNaN(parseInt($("#cantidad_huevo_deposito_aux"+value.id).val())) ){
                    $("#cantidad_tipo_huevo_dep_aux"+value.id).val(0); 
               }
                else{ 
                    $('#cantidad_tipo_huevo_dep_aux'+value.id).val(parseInt($("#cantidad_huevo_deposito_aux"+value.id).val()));
                    $('#cantidad_tipo_huevo_dep'+value.id).val(parseInt($("#cantidad_huevo_deposito_aux"+value.id).val()));            
                }
          });
      });
      $('#loading').css("display","none");        
  //}
});

function extraer_id_tipo_caja(id_tipo_caja,x){
    id = id_tipo_caja;
    sw = x;
}
function extraer_id_sobrante(id_sobrante,x){
    id = id_sobrante;
    sw = x;
}
function extraer_id_tipo_huevo(id_tipo_huevo,x){
    id = id_tipo_huevo;
    sw = x;
}

function calcular(id){
    $("#huevo_sobrante"+id).val(parseInt($("#maple_sobrante"+id).val()) * parseInt($("#cant_huevo"+id).val()));
}

//REGISTRA LOS SOBRANTES DIARIOS
/*function registrar_sobrante(id){
    var token = $('#token').val();
    var id_tipo_caja=id;
    var cantidad_maple_sobrante = $("#maple_sobrante"+id).val();
    var cantidad_huevo_sobrante = $("#huevo_sobrante"+id).val();
    if (isNaN(parseInt($("#huevo_acumulado").val()))) {
      alertify.alert("MENSAJE",'NO HAY HUEVO EN EL DEPOSITO');
    } 
    else {
      if (isNaN(parseInt($("#huevo_sobrante"+id).val())) || isNaN(parseInt($("#maple_sobrante"+id).val())) ) {
          alertify.alert("MENSAJE",'NO INTRODUJO NINGUNA CANTIDAD');
      } else {
        if (parseInt($("#huevo_acumulado").val()) >= parseInt($("#huevo_sobrante"+id).val())) {
          $('#loading').css("display","block");
           $.ajax({
              url: 'sobrante',
              headers: {'X-CSRF-TOKEN': token},
              type: 'POST',
              dataType: 'json',
              data: {id_tipo_caja: id_tipo_caja, cantidad_maple:cantidad_maple_sobrante, cantidad_huevo:cantidad_huevo_sobrante},
              success:function(){
                $('#loading').css("display","none");
                alertify.success('GUARDADO CORRECTAMENTE'); 
              },
              error:function(){
                $('#loading').css("display","none");
                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");                
              }
          });
        } 
        else {
           alertify.alert("MENSAJE",'NO EXISTE ESA CANTIDAD DE HUEVO EN EL DEPOSITO');
        }
      }
    }
}*/

//SW = 1 REGISTRA CAJA------SW = 2 REGISTRA SOBRANTE-------SW = 3 REGISTRA LOS HUEVOS
$(document).keypress(function(e){
 if (e.which==13) {
  if (sw == 1) {
 if (isNaN(parseInt($("#caja_acumulado_aux"+id).val())) || isNaN(parseInt($("#caja_diario_aux"+id).val()))) {
  alertify.alert("MENSAJE","NO SE GUARDARON LOS DATOS ACTUALIZE DE NUEVO EL FORMULARIO");
  } else {
  var token = $("#token").val();  
  var nombre_caja = $("#tipo_caja"+id).text();
  var route_huevo = 'obtener_huevo_acumulado';
  $.get(route_huevo,function(res_h){
  if ($("#caja_diario"+id).val() == "") {
        alertify.alert("MENSAJE",'INTRODUSCA LA CANTIDAD DE CAJAS EN '+nombre_caja);
  } 
  else {
    if ($("#caja_diario_aux"+id).val() != $("#caja_diario"+id).val()) {
          if (res_h[0].cantidad == 0 && $("#caja_diario_aux"+id).val() == 0){
              alertify.alert("MENSAJE",'NO EXISTE ESA CANTIDAD DE HUEVO');
          }
          else {    
            var huevo =  parseInt(parseInt($("#caja_diario"+id).val()) * parseInt($("#cant_maple"+id).val())) * parseInt($("#cant_huevo"+id).val());
            var huevo_aux =  parseInt(parseInt($("#caja_diario_aux"+id).val()) * parseInt($("#cant_maple"+id).val())) * parseInt($("#cant_huevo"+id).val());
            var suma_huevo_acumulado = parseInt(res_h[0].cantidad) + parseInt(huevo_aux);
            if (suma_huevo_acumulado >= huevo) {
              $('#loading').css("display","block");
              if ($("#caja_diario_aux"+id).val() >= $("#caja_diario"+id).val()) {
                var ca_acu = parseInt($("#caja_diario_aux"+id).val()) - parseInt($("#caja_diario"+id).val());
                var caja_acumulado = parseInt($("#caja_acumulado_aux"+id).val()) - parseInt(ca_acu);
                var total_caja = $("#total_caja").text();
                var total_caja_dia = $("#total_caja_dia").text();
                var total_caja_aux = parseInt(total_caja) - parseInt(ca_acu);
                var total_caja_dia_aux = parseInt(total_caja_dia) - parseInt(ca_acu);
              } else {
                var ca_acu = parseInt($("#caja_diario"+id).val()) - parseInt($("#caja_diario_aux"+id).val());
                var caja_acumulado = parseInt($("#caja_acumulado_aux"+id).val()) + parseInt(ca_acu);
                var total_caja = $("#total_caja").text();
                var total_caja_dia = $("#total_caja_dia").text();
                var total_caja_aux = parseInt(total_caja) + parseInt(ca_acu);
                var total_caja_dia_aux = parseInt(total_caja_dia) + parseInt(ca_acu);
              }
              var caja_diario = $("#caja_diario"+id).val();
              var cantidad_maple = parseInt(caja_diario) * parseInt($("#cant_maple"+id).val());
              $.ajax({
                  url: 'caja',
                  headers: {'X-CSRF-TOKEN': token},
                  type: 'POST',
                  dataType: 'json',
                  data: {id_tipo_caja: id, cantidad_caja:caja_diario, cantidad_maple:cantidad_maple, cantidad_huevo:huevo},                 
                  success:function(){
                      alertify.success('CAJAS'+ nombre_caja +'REGISTRADOS');
                      $("#caja_acumulado"+id).val(caja_acumulado);
                      $("#caja_acumulado_aux"+id).val(caja_acumulado);
                      $("#caja_diario_aux"+id).val($("#caja_diario"+id).val()); 
                      $("#total_caja").text(total_caja_aux);//DE CAJA DEPOSITO
                      $("#total_caja_dia").text(total_caja_dia_aux);
                      $("#huevo_acumulado").val(parseInt(suma_huevo_acumulado)-parseInt(huevo));
                      $('#loading').css("display","none");                 
                  },
                  error:function(){
                    $('#loading').css("display","none");
                    alertify.alert("MENSAJE","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");  //DE LOS HUEVOS ACUMULADOS
                    $('#caja_diario'+id).val(parseInt($('#caja_diario_aux'+id).val()));
                    setTimeout("location.reload()",2000);
                  },
              });
            } 
            else {
              alertify.alert("MENSAJE",'NO EXISTE SUFICIENTES HUEVOS PARA ARAMAR ESAS CANTIDADES DE CAJA');
              $("#caja_diario"+id).val($("#caja_diario_aux"+id).val()); 
            }                      
           } 
          } 
    }
  });
  }
  } 

if (sw == 2) {
    var token = $('#token').val();
    var id_tipo_caja=id;
    var cantidad_maple_sobrante = $("#maple_sobrante"+id).val();
    var cantidad_huevo_sobrante = $("#huevo_sobrante"+id).val();
    if (isNaN(parseInt($("#huevo_acumulado").val()))) {
      alertify.alert("MENSAJE",'NO HAY HUEVO EN EL DEPOSITO');
    } 
    else {
      if (isNaN(parseInt($("#huevo_sobrante"+id).val())) || isNaN(parseInt($("#maple_sobrante"+id).val())) ) {
          alertify.alert("MENSAJE",'NO INTRODUJO NINGUNA CANTIDAD');
      } else {
        if ($('#maple_sobrante'+id).val() != $('#cantidad_caja'+id).val() && $('#huevo_sobrante'+id).val() != $('#cantidad_huevo'+id).val()) {
          if (parseInt($("#huevo_acumulado").val()) >= parseInt($("#huevo_sobrante"+id).val())) {
            $('#loading').css("display","block");
             $.ajax({
                url: 'sobrante',
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data: {id_tipo_caja: id_tipo_caja, cantidad_maple:cantidad_maple_sobrante, cantidad_huevo:cantidad_huevo_sobrante},
                success:function(){
                  $('#loading').css("display","none");
                  $('#cantidad_huevo'+id).val(parseInt($('#huevo_sobrante'+id).val()));
                  $('#cantidad_caja'+id).val(parseInt($('#maple_sobrante'+id).val() ))
                  alertify.success('GUARDADO CORRECTAMENTE'); 
                },
                error:function(){
                  $('#loading').css("display","none");
                  alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");   
                  setTimeout("location.reload()",2000);            
                }
            });
          } 
          else {
             alertify.alert("MENSAJE",'NO EXISTE ESA CANTIDAD DE HUEVO EN EL DEPOSITO');
          }
        }

      }
    }
} 

if (sw == 3) {
if (isNaN(parseInt($("#cantidad_tipo_huevo_dep_aux"+id).val())) || isNaN(parseInt($("#cantidad_tipo_huevo_aux"+id).val()))) {
  alertify.alert("MENSAJE","NO SE GUARDARON LOS DATOS ACTUALIZE DE NUEVO EL FORMULARIO");
} else {
  var nombre = $("#tipo_huevo"+id).text();  
  if (isNaN(parseInt($('#cantidad_tipo_huevo'+id).val()))) {
        alertify.alert("MENSAJE",'INTRODUSCA UNA CANTIDAD EN '+nombre);
  } else {  
  if (parseInt($('#cantidad_tipo_huevo'+id).val()) != parseInt($('#cantidad_tipo_huevo_aux'+id).val()) ) {
    var route_huevo = 'obtener_huevo_acumulado';
    $.get(route_huevo,function(res_h){
    var suma = parseInt(parseInt($('#cant_tipo_huevo'+id).val()) * parseInt($('#cantidad_tipo_huevo_aux'+id).val())) + parseInt(res_h[0].cantidad);
    var x = parseInt($('#cantidad_tipo_huevo'+id).val()) * parseInt(($('#cant_tipo_huevo'+id).val()));
      if ( suma >= x) {
        $('#loading').css("display","block");
        var num = parseInt($('#cantidad_tipo_huevo'+id).val()) - parseInt($('#cantidad_tipo_huevo_aux'+id).val());
        if (parseInt($('#cantidad_tipo_huevo'+id).val()) >= parseInt($('#cantidad_tipo_huevo_aux'+id).val()) )   {
          var cantidad_huevo_acumulado=parseInt(res_h[0].cantidad) - parseInt(parseInt(num) * parseInt($('#cant_tipo_huevo'+id).val()));
          var total_actual = parseInt($("#total2").text()) + parseInt(num);
          var total_maple_dia = parseInt($("#total_maple_dia").text()) + parseInt(num);
        } else {
          var cantidad_huevo_acumulado=parseInt(res_h[0].cantidad) + parseInt(parseInt(num) * parseInt($('#cant_tipo_huevo'+id).val()) * parseInt(-1));
          var total_actual = parseInt($("#total2").text()) - parseInt(parseInt(num) * parseInt(-1));
          var total_maple_dia = parseInt($("#total_maple_dia").text()) - parseInt(parseInt(num) * parseInt(-1));
        }   
          var id_tipo_huevo=id;
          var token = $('#token').val();
          var cantidad_maple_dep = parseInt(parseInt($('#cantidad_tipo_huevo_dep_aux'+id).val()) + parseInt($("#cantidad_tipo_huevo"+id).val())) - parseInt($("#cantidad_tipo_huevo_aux"+id).val());
          var cantidad_huevo_dep = parseInt($("#cant_tipo_huevo"+id).val()) * parseInt(cantidad_maple_dep);

             var cantidad_maple2=$("#cantidad_tipo_huevo"+id).val();
             var cantidad_huevo = parseInt(cantidad_maple2) * parseInt($("#cant_tipo_huevo"+id).val());
            $.ajax({
                url: 'huevo',
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data: {id_tipo_huevo: id_tipo_huevo, cantidad_maple:cantidad_maple2, cantidad_huevo:cantidad_huevo},
                success:function(){
                  alertify.success('MAPLE '+nombre+' GUARDADO CORRECTAMENTE');
                  $("#cantidad_tipo_huevo_aux"+id).val(cantidad_maple2);
                  $("#cantidad_tipo_huevo_dep"+id).val(cantidad_maple_dep);  //ESTO ES DE HUEVOS DEPOSITO                        
                  $("#cantidad_tipo_huevo_dep_aux"+id).val(cantidad_maple_dep); //ESTO ES DE HUEVOS DEPOSITO                        
                  $('#huevo_acumulado').val(cantidad_huevo_acumulado);// ESTO ES DE HUEVOS ACUMULADOS
                  $("#total2").text(total_actual);   //TOTAL MAPLE ACUULADAS  
                  $("#total_maple_dia").text(total_maple_dia); // TOTAL MAPLE POR DIA 
                  $('#loading').css("display","none");      
                },
                error:function(){
                  $('#loading').css("display","none");
                  alertify.alert("ERROR","ACTUALIZE EL FORMULARIO PARA VERIFICAR SI SE GUARDARON LOS DATOS CORRECTAENTE"); 
                  $('#cantidad_tipo_huevo'+id).val(parseInt($('#cantidad_tipo_huevo_aux'+id).val()));
                  setTimeout("location.reload()",2000);
                },                           
            });
      } 
      else {
            alertify.alert("MENSAJE",'NO EXISTE SUFICIENTES HUEVOS PARA ARAMAR ESAS CANTIDADES DE MAPLES');
            $("#cantidad_tipo_huevo"+id).val($("#cantidad_tipo_huevo_aux"+id).val()); 
      }
    });
    }
  }
 }
  } 

}
}); 




//REGISTRAR HUEVO ACUMULADOS Y DIARIO
/*function registrar_huevo(id){
if (isNaN(parseInt($("#cantidad_tipo_huevo_dep_aux"+id).val())) || isNaN(parseInt($("#cantidad_tipo_huevo_aux"+id).val()))) {
  alertify.alert("MENSAJE","NO SE GUARDARON LOS DATOS ACTUALIZE DE NUEVO EL FORMULARIO");
} else {
  var nombre = $("#tipo_huevo"+id).text();  
  if (isNaN(parseInt($('#cantidad_tipo_huevo'+id).val()))) {
        alertify.alert("MENSAJE",'INTRODUSCA UNA CANTIDAD EN '+nombre);
  } else {  
  if (parseInt($('#cantidad_tipo_huevo'+id).val()) == parseInt($('#cantidad_tipo_huevo_aux'+id).val()) ) {
    alertify.success('MAPLE '+nombre+' GUARDADO CORRECTAMENTE');
  }else {
    var route_huevo = 'obtener_huevo_acumulado';
    $.get(route_huevo,function(res_h){
    var suma = parseInt(parseInt($('#cant_tipo_huevo'+id).val()) * parseInt($('#cantidad_tipo_huevo_aux'+id).val())) + parseInt(res_h[0].cantidad);
    var x = parseInt($('#cantidad_tipo_huevo'+id).val()) * parseInt(($('#cant_tipo_huevo'+id).val()));
      if ( suma >= x) {
        $('#loading').css("display","block");
        var num = parseInt($('#cantidad_tipo_huevo'+id).val()) - parseInt($('#cantidad_tipo_huevo_aux'+id).val());
        if (parseInt($('#cantidad_tipo_huevo'+id).val()) >= parseInt($('#cantidad_tipo_huevo_aux'+id).val()) )   {
          var cantidad_huevo_acumulado=parseInt(res_h[0].cantidad) - parseInt(parseInt(num) * parseInt($('#cant_tipo_huevo'+id).val()));
          var total_actual = parseInt($("#total2").text()) + parseInt(num);
          var total_maple_dia = parseInt($("#total_maple_dia").text()) + parseInt(num);
        } else {
          var cantidad_huevo_acumulado=parseInt(res_h[0].cantidad) + parseInt(parseInt(num) * parseInt($('#cant_tipo_huevo'+id).val()) * parseInt(-1));
          var total_actual = parseInt($("#total2").text()) - parseInt(parseInt(num) * parseInt(-1));
          var total_maple_dia = parseInt($("#total_maple_dia").text()) - parseInt(parseInt(num) * parseInt(-1));
        }   
          var id_tipo_huevo=id;
          var token = $('#token').val();
          var cantidad_maple_dep = parseInt(parseInt($('#cantidad_tipo_huevo_dep_aux'+id).val()) + parseInt($("#cantidad_tipo_huevo"+id).val())) - parseInt($("#cantidad_tipo_huevo_aux"+id).val());
          var cantidad_huevo_dep = parseInt($("#cant_tipo_huevo"+id).val()) * parseInt(cantidad_maple_dep);

             var cantidad_maple2=$("#cantidad_tipo_huevo"+id).val();
             var cantidad_huevo = parseInt(cantidad_maple2) * parseInt($("#cant_tipo_huevo"+id).val());
            $.ajax({
                url: 'huevo',
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data: {id_tipo_huevo: id_tipo_huevo, cantidad_maple:cantidad_maple2, cantidad_huevo:cantidad_huevo},
                success:function(){
                  alertify.success("GUARDADO CORRECTAMENTE");
                  $("#cantidad_tipo_huevo_aux"+id).val(cantidad_maple2);
                  $("#cantidad_tipo_huevo_dep"+id).val(cantidad_maple_dep);  //ESTO ES DE HUEVOS DEPOSITO                        
                  $("#cantidad_tipo_huevo_dep_aux"+id).val(cantidad_maple_dep); //ESTO ES DE HUEVOS DEPOSITO                        
                  $('#huevo_acumulado').val(cantidad_huevo_acumulado);// ESTO ES DE HUEVOS ACUMULADOS
                  $("#total2").text(total_actual);   //TOTAL MAPLE ACUULADAS  
                  $("#total_maple_dia").text(total_maple_dia); // TOTAL MAPLE POR DIA 
                  $('#loading').css("display","none");      
                },
                error:function(){
                  $('#loading').css("display","none");
                  alertify.alert("ERROR","ACTUALIZE EL FORMULARIO PARA VERIFICAR SI SE GUARDARON LOS DATOS CORRECTAENTE"); 
                },                           
            });
      } 
      else {
            alertify.alert("MENSAJE",'NO EXISTE SUFICIENTES HUEVOS PARA ARAMAR ESAS CANTIDADES DE MAPLES');
            $("#cantidad_tipo_huevo"+id).val($("#cantidad_tipo_huevo_aux"+id).val()); 
      }
    });
    }
  }
 }
} END DE LA FUNCION REGISTRAR HUEVOS*/


//REGIISTRAR CAJAS
/*function registrar_caja(id){ 
  if (isNaN(parseInt($("#caja_acumulado_aux"+id).val())) || isNaN(parseInt($("#caja_diario_aux"+id).val()))) {
  alertify.alert("MENSAJE","NO SE GUARDARON LOS DATOS ACTUALIZE DE NUEVO EL FORMULARIO");
  } else {
  var token = $("#token").val();  
  var nombre_caja = $("#tipo_caja"+id).text();
  var route_huevo = 'obtener_huevo_acumulado';
  $.get(route_huevo,function(res_h){
  if ($("#caja_diario"+id).val() == "") {
        alertify.alert("MENSAJE",'INTRODUSCA LA CANTIDAD DE CAJAS EN '+nombre_caja);
  } 
  else {
    if ($("#caja_diario_aux"+id).val() != $("#caja_diario"+id).val()) {
          if (res_h[0].cantidad == 0 && $("#caja_diario_aux"+id).val() == 0){
              alertify.alert("MENSAJE",'NO EXISTE ESA CANTIDAD DE HUEVO');
          }
          else {    
            var huevo =  parseInt(parseInt($("#caja_diario"+id).val()) * parseInt($("#cant_maple"+id).val())) * parseInt($("#cant_huevo"+id).val());
            var huevo_aux =  parseInt(parseInt($("#caja_diario_aux"+id).val()) * parseInt($("#cant_maple"+id).val())) * parseInt($("#cant_huevo"+id).val());
            var suma_huevo_acumulado = parseInt(res_h[0].cantidad) + parseInt(huevo_aux);
            if (suma_huevo_acumulado >= huevo) {
              $('#loading').css("display","block");
              if ($("#caja_diario_aux"+id).val() >= $("#caja_diario"+id).val()) {
                var ca_acu = parseInt($("#caja_diario_aux"+id).val()) - parseInt($("#caja_diario"+id).val());
                var caja_acumulado = parseInt($("#caja_acumulado_aux"+id).val()) - parseInt(ca_acu);
                var total_caja = $("#total_caja").text();
                var total_caja_dia = $("#total_caja_dia").text();
                var total_caja_aux = parseInt(total_caja) - parseInt(ca_acu);
                var total_caja_dia_aux = parseInt(total_caja_dia) - parseInt(ca_acu);
              } else {
                var ca_acu = parseInt($("#caja_diario"+id).val()) - parseInt($("#caja_diario_aux"+id).val());
                var caja_acumulado = parseInt($("#caja_acumulado_aux"+id).val()) + parseInt(ca_acu);
                var total_caja = $("#total_caja").text();
                var total_caja_dia = $("#total_caja_dia").text();
                var total_caja_aux = parseInt(total_caja) + parseInt(ca_acu);
                var total_caja_dia_aux = parseInt(total_caja_dia) + parseInt(ca_acu);
              }
              var caja_diario = $("#caja_diario"+id).val();
              var cantidad_maple = parseInt(caja_diario) * parseInt($("#cant_maple"+id).val());
              $.ajax({
                  url: 'caja',
                  headers: {'X-CSRF-TOKEN': token},
                  type: 'POST',
                  dataType: 'json',
                  data: {id_tipo_caja: id, cantidad_caja:caja_diario, cantidad_maple:cantidad_maple, cantidad_huevo:huevo},                 
                  success:function(){
                    alertify.success("GUARDADO CORRECTAMENTE");
                      $("#caja_acumulado"+id).val(caja_acumulado);
                      $("#caja_acumulado_aux"+id).val(caja_acumulado);
                      $("#caja_diario_aux"+id).val($("#caja_diario"+id).val()); 
                      $("#total_caja").text(total_caja_aux);//DE CAJA DEPOSITO
                      $("#total_caja_dia").text(total_caja_dia_aux);
                      $("#huevo_acumulado").val(parseInt(suma_huevo_acumulado)-parseInt(huevo));
                      $('#loading').css("display","none");                 
                  },
                  error:function(){
                    $('#loading').css("display","none");
                    alertify.alert("ERROR","ACTUALIZE EL FORMULARIO PARA VERIFICAR SI SE GUARDARON LOS DATOS CORRECTAENTE");  //DE LOS HUEVOS ACUMULADOS
                  },
              });
            } 
            else {
              alertify.alert("MENSAJE",'NO EXISTE SUFICIENTES HUEVOS PARA ARAMAR ESAS CANTIDADES DE CAJA');
              $("#caja_diario"+id).val($("#caja_diario_aux"+id).val()); 
            }                      
           } 
          }
          else{
            alertify.success('HUEVOS'+ nombre_caja +'REGISTRADOS');
          }  
    }
  });
  }
} END DE LA FUNCION REGISTRAR CAJA*/

//CARGAR TABLA PARA HACER LA DEVOLUCION DE LAS CAJAS
function cargartabla_c(id) {
    $('#btn_ajuste').show();
    $('#devolucion_aux').val("");
    $('#devolucion').val("");
    $("#id_caja").val(id);
    $('#datos').empty();
    var tabladatos = $('#datos');
    var route = "volver_cajas_detalle/"+id;
    var tabladatos = $('#datos');
    $.get(route, function (res) {
    $(res).each(function (key, value) {
          tabladatos.append('<tr align="center"><td><label id=nombre>' + value.tipo + '</label><input id="id_c'+ cont +'" type=hidden size=1 value='+value.id+'></td>\n\
            <td><input id="cant_caja'+ cont +'" readonly="" type="text" size="1" onkeypress="return bloqueo_de_punto(event)" style="text-align:center" maxlength="2" value='+value.cantidad_caja+'>\n\
            <input id="cant_caja_aux'+ cont +'" type="hidden" size="1" maxlength="2" value='+value.cantidad_caja+'></td>\n\
            <td><input id="fecha'+ cont +'" type="text" size="6" readonly value='+value.fecha+'></td></tr>');
            cont++;           
        });
    });
}

//AJUSTE DE LAS CAJAS QUE SE DEVOLVIERON
function ajuste_caja() {
if (isNaN(parseInt($('#devolucion_aux').val()))) {
    alertify.alert("MENSAJE",'NO INTRODUJO NINGUNA CANTIDAD');
} 
else { 
   var token = $("#token").val();
   var x = $("#id_caja").val();
  if (parseInt($("#caja_acumulado"+x).val()) >= parseInt($("#devolucion_aux").val())) {
     alertify.confirm("MENSAJE","DESEA MODIFICAR LAS CAJAS",
     function(){
      $('#btn_ajuste').hide();
      $('#loading').css("display","block");
      for (var i = 0; i <= 7 ; i++) {
        if ( $("#devolucion").val() == 0 ) {  //CUANDO YA ESTA CERO SE ACTUALIZA LA PAGINA
          $('#btn_ajuste').show();
            $('#loading').css("display","none");
           setTimeout("location.href='cajadeposito_admin'",3000);//$(location).attr('href', 'cajadeposito_admin');
        } else{
        if (!isNaN(parseInt($("#cant_caja"+i).val()))) {
          if ( $("#cant_caja"+i).val()!=0) {
              var cantidad_caja = $("#cant_caja"+i).val();
              var id_caja = $("#id_c"+i).val();
              var resta = $("#devolucion").val();
              if (resta!=0) {
                if (parseInt(resta) >= parseInt(cantidad_caja)) {
                    var id_tipo_caja = $("#id_caja").val();
                    var resta = parseInt($("#devolucion").val())-parseInt(cantidad_caja);
                    var fecha = $("#fecha"+i).val();
                    $("#cant_caja"+i).val(0);
                    $("#devolucion").val(resta);
                    var route_caja = "caja/"+id_caja;                
                    $.ajax({
                      url: route_caja,
                      headers: {'X-CSRF-TOKEN': token},
                      type: 'PUT',
                      dataType: 'json',
                      data: {id_tipo_caja: id_tipo_caja, cantidad_caja:0, cantidad_maple:0, cantidad_huevo:0, fecha:fecha},                      
                      success:function(){
                        alertify.success("GUARDADO CORRECTAMENTE");
                      },
                      error:function(){
                        $('#btn_ajuste').show();
                        $('#loading').css("display","none");
                        alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS ACTUALIZE LA PAGINA 1");
                      },
                    });
                    if (fecha == $("#fecha").val()) {
                        $("#caja_diario"+id_tipo_caja).val(0);
                        $("#caja_diario_aux"+id_tipo_caja).val(0);                      
                    }
                } else {
                    var id_tipo_caja = $("#id_caja").val();
                    var resta = parseInt(cantidad_caja)-parseInt($("#devolucion").val());
                    var cantidad_maple = parseInt(resta) * parseInt($("#cant_maple"+id_tipo_caja).val());          
                    var cantidad_huevo = parseInt(parseInt(resta) * parseInt($("#cant_maple"+id_tipo_caja).val())) * parseInt($("#cant_huevo"+id_tipo_caja).val()) ;
                    var fecha = $("#fecha"+i).val();
                    var route_caja = "caja/"+id_caja;
                    $.ajax({
                        url: route_caja,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'PUT',
                        dataType: 'json',
                        data: {id_tipo_caja: id_tipo_caja, cantidad_caja:resta, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo, fecha:fecha},
                        success:function(){
                          alertify.success("GUARDADO CORRECTAMENTE");   
                        },
                        error:function(){
                          $('#btn_ajuste').show();
                          $('#loading').css("display","none");
                          alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS ACTUALIZE LA PAGINA 2");
                        },                        
                    });
                    if (fecha == $("#fecha").val()) {
                        $("#caja_diario"+id_tipo_caja).val(resta);
                        $("#caja_diario_aux"+id_tipo_caja).val(resta);                      
                    }
                    $("#cant_caja"+i).val(resta); 
                    $("#devolucion").val(0);                
                }                
              } //CUANDO ES DISTINTO DE CERO   if (resta!=0) 
            }//CUANDO ES DISTINTO DE CERO   if ( $("#cant_caja"+i).val()!=0) 
        }// CUANDO ISNAN if (!isNaN(parseInt($("#cant_caja"+i).val())))
       }//ELSE DE if ( $("#devolucion").val() == 0 )
      }
    },
      function(){ alertify.error('CANCELADO'); }); 
    }
  else {
    var nombre = $("#nombre").text();
    alertify.alert("MENSAJE",'NO EXISTE ESA CANTIDAD DE CAJA '+ nombre + ' EN EL DEPOSITO ');
  }
 }   
}   
//LO USO PARA EL AJUSTE DE CAJA
function copiar(){
      $("#devolucion").val($("#devolucion_aux").val());
} 

//MODIFCAR LOS HUEVOS ACUMULADOS
function actualizar_huevo(){
  $('#loading').css("display","block");
  var huevo_acumulado = $("#huevo_acumulado").val();
  var token = $("#token").val();
  $.ajax({
    url: "huevoacumulado",
    headers: {'X-CSRF-TOKEN': token},
    type: 'POST',
    dataType: 'json',
    data: { cantidad:huevo_acumulado},
    success: function(){
      alertify.success("MODIFICADO CORRECTAMENTE");
      $('#loading').css("display","none");
    },
    error:function(){
      $('#loading').css("display","none");
      alertify.alert("ERROR","NO SE PUDO MODIFICAR LOS DATOS INTENTE NUEVAMENTE");
    },
  });
}
    
     
      








