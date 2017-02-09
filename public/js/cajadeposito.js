var cont = 0;
var cant_caja = [];
input =0;
var sw =0;

$(document).ready(function(){
  /*if ($('#token').val()=="") {
      location.reload();
  }else{*/
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

function extraer_id_sobrante(id_sobrante,x){
    id = id_sobrante;
    sw = x;
}
//CALCULA LOS HUEVO DE LOS SOBRANTES
function calcular(id){
 $("#huevo_sobrante"+id).val(parseInt($("#maple_sobrante"+id).val()) * parseInt($("#cant_huevo"+id).val()));
}

$(document).keypress(function(e){
if (e.which==13) {
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
          if ($('#maple_sobrante'+id).val() != $('#cantidad_caja'+id).val() || $('#huevo_sobrante'+id).val() != $('#cantidad_huevo'+id).val()) {
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
}
}); 

//CONTRASEÑA
function confirmar(){
  var route = "obtener_password";
  $.get(route,function(res){    
    if ($('#contra').val() == res[0].pass2) {
      $('button').css("display","block");
      $('#salir').css('display','block');
      $('#conectado').css('display','none');
      $("input").prop('readonly',false);  
      $('.modal').modal("hide");
      $(location).attr('href', 'cajadeposito_admin');   
    }                   
    else{
      alertify.alert("ERROR",'CONTRASEÑA INCORECTA');
    }           
  });   
}









      








