$(document).ready(function(){
  if ($('#token').val()=="") {
      location.reload();
  }else{
      if ( isNaN(parseInt($("#huevo_acumulado").val())) ){
          $('input').prop('disabled',true);
          $('button').prop('disabled',true);
         }
        else{ 
          $('input').prop('disabled',false);
          $('button').prop('disabled',false);

      var route_inicio="caja_deposito"
       $.get(route_inicio, function (rescaja) {
              $(rescaja).each(function (key, value) {
                 if ( isNaN(parseInt($("#cantidad_caja_diario"+value.id).val())) ){
                      $('#caja_diario'+value.id).val(0);
                 }else{ 
                      $('#caja_diario'+value.id).val(parseInt($("#cantidad_caja_diario"+value.id).val()));
                  }
                 if ( isNaN(parseInt($("#cantidad_caja_acumulado"+value.id).val())) ){
                      $('#caja_acumulado'+value.id).val(0);
                 }else{ 
                      $('#caja_acumulado'+value.id).val(parseInt($("#cantidad_caja_acumulado"+value.id).val()));
                  }     
                 if ( isNaN(parseInt($("#maple"+value.id).val())) ){
                      $('#cantidad_maple_aux'+value.id).val(0);
                 }else{ 
                      $('#cantidad_maple_aux'+value.id).val(parseInt($("#maple"+value.id).val()));
                  }
              });
          });    

      var route_inicio_huevo="huevo_deposito"
       $.get(route_inicio_huevo, function (reshuevo) {
              $(reshuevo).each(function (key, value) {
                if ( isNaN(parseInt($("#cantidad_huevo_diario"+value.id).val())) ){
                      $('#huevo_diario'+value.id).val(0);
                 }else{ 
                      $('#huevo_diario'+value.id).val(parseInt($("#cantidad_huevo_diario"+value.id).val()));
                }
                if ( isNaN(parseInt($("#cantidad_huevo_acumulado"+value.id).val())) ){
                      $('#huevo_acumulado'+value.id).val(0);
                 }else{ 
                      $('#huevo_acumulado'+value.id).val(parseInt($("#cantidad_huevo_acumulado"+value.id).val()));
                }  
              
              });
          });
          }  
      $('#loading').css("display","none");
  }  
});


//REGISTRAR CAJA ACUMULADAS Y DIARIASS
function registrar_maple(id){
  $('#loading').css("display","block"); 
  var nombre = $("#nombre"+id).text();  
  if (isNaN(parseInt($('#cantidad_maple'+id).val()))) {
        alertify.alert("MENSAJE",'INTRODUSCA UNA CANTIDAD EN '+nombre);
  } 
  else {
  if (isNaN(parseInt($("#cantidad_maple_aux"+id).val()))) {
    alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS ACTUALIZE EL FORMULARIO");
  }else {
    var route_huevo = 'obtener_huevo_acumulado';
    $.get(route_huevo,function(res_h){
    var x = parseInt($('#cant_huevo'+id).val()) * parseInt($('#cantidad_maple'+id).val());

      if (res_h[0].cantidad >= x) {

        var cantidad_huevo_acumulado=parseInt(res_h[0].cantidad) - parseInt(x);
        var id_tipo_caja=id;
        var token = $('#token').val();
        var maple = parseInt($("#cantidad_maple_aux"+id).val()) + parseInt($("#cantidad_maple"+id).val());
        $("#cantidad_maple_aux"+id).val(maple);

          if ( parseInt($("#cantidad_maple_aux"+id).val()) >= parseInt($("#cant_maple"+id).val()) ){
             $("#cantidad_maple_aux"+id).val(parseInt(maple) - parseInt($("#cant_maple"+id).val()));
             var maple_aux = parseInt(maple) - parseInt($("#cant_maple"+id).val());
              $.ajax({
                  url: 'cantidadmaple',
                  headers: {'X-CSRF-TOKEN': token},
                  type: 'POST',
                  dataType: 'json',
                  data: {id_tipo_caja: id_tipo_caja, cantidad_maple:maple_aux},
                  success:function(){    
                      if ( parseInt($("#caja_diario"+id).val()) == 0) {
                          var cantidad_maple = $("#cant_maple"+id).val();
                          var cantidad_huevo = parseInt($("#cant_huevo"+id).val()) * parseInt(cantidad_maple);
                          $.ajax({
                              url: 'caja',
                              headers: {'X-CSRF-TOKEN': token},
                              type: 'POST',
                              dataType: 'json',
                              data: {id_tipo_caja: id_tipo_caja, cantidad_caja:1, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                              success:function(){
                                $('#loading').css("display","none"); 
                                alertify.success("GUARDADO CORRECTAMENTE");
                                parseInt($("#caja_diario"+id).val(1));
                                var maple_aux = $("#cantidad_maple_aux"+id).val(); 
                              },
                              error:function(){
                                $('#loading').css("display","none"); 
                                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 1");
                              },                                    
                          });
                      } 
                      else {
                        var route_2 = "dato_caja_diario/"+id;
                        $.get(route_2,function(res2){
                           var cantidad_caja=parseInt(res2[0].cantidad_caja) + parseInt(1);
                           var cantidad_maple = parseInt($("#cant_maple"+id).val()) * parseInt(cantidad_caja);
                           var cantidad_huevo = parseInt(cantidad_maple) * parseInt($("#cant_huevo"+id).val());
                          $('#loading').css("display","block"); 
                          $.ajax({
                              url: 'caja',
                              headers: {'X-CSRF-TOKEN': token},
                              type: 'POST',
                              dataType: 'json',
                              data: {id_tipo_caja: id_tipo_caja, cantidad_caja:cantidad_caja, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                              success:function(){
                                $('#loading').css("display","none");                                 
                                alertify.success("GUARDADO CORRECTAMENTE");
                                var maple_aux = $("#cantidad_maple_aux"+id).val();
                              },
                              error:function(){
                                $('#loading').css("display","none"); 
                                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 2");
                              },                                     
                          });
                        });
                      }
                      var hue_aux = parseInt($("#huevo_acumulado").val())-parseInt(parseInt($("#cant_huevo"+id).val())*parseInt($("#cant_maple"+id).val()));
                      $('#huevo_acumulado').val(hue_aux);
                      alertify.warning('SE ARMO UNA CAJA '+nombre);

                  },
                  error:function(){
                    $('#loading').css("display","none"); 
                    alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 3");
                    return;
                  },                          
              });  

          }
          else{
            var maple_aux = $("#cantidad_maple_aux"+id).val();
            $('#loading').css("display","block"); 
            $.ajax({
                url: 'cantidadmaple',
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data: {id_tipo_caja: id_tipo_caja, cantidad_maple:maple_aux},
                success:function(){
                  $('#loading').css("display","none"); 
                  alertify.success("GUARDADO CORRECTAMENTE");                
                },
                error:function(){
                  $('#loading').css("display","none"); 
                  alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 4");
                  return;
                },            
            });
            } 
        } 
      else {
          $('#loading').css("display","none"); 
          alertify.alert("MENSAJE",'CANTIDAD DE HUEVO NO DISPONIBLE');
      }
    });
    }
  }
}

//REGISTRAR HUEVO ACUMULADOS Y DIARIAS
function registrar_huevos(id){
$('#loading').css("display","block"); 
var nombre = $("#tipo_huevo"+id).text();  
if (isNaN(parseInt($('#cantidad_tipo_maple'+id).val()))) {
        alertify.alert("MENSAJE",'INTRODUSCA UNA CANTIDAD EN '+nombre);
} else {  
var route_huevo = 'obtener_huevo_acumulado';
$.get(route_huevo,function(res_h){
var x = parseInt($('#cant_tipo_huevo'+id).val()) * parseInt($('#cantidad_tipo_maple'+id).val());

  if (res_h[0].cantidad >= x) {
    var cantidad_huevo_acumulado=parseInt(res_h[0].cantidad) - parseInt(x);
    var id_tipo_huevo=id;
    var token = $('#token').val();

              //  HUEVO DIARIO
                  if ( parseInt($("#huevo_diario"+id).val()) == 0) {
                      var cantidad_maple = $("#cantidad_tipo_maple"+id).val();
                      var cantidad_huevo = parseInt(cantidad_maple) * parseInt($("#cant_tipo_huevo"+id).val());
                      var token = $('#token').val();                      
                      $.ajax({
                          url: 'huevo',
                          headers: {'X-CSRF-TOKEN': token},
                          type: 'POST',
                          dataType: 'json',
                          data: {id_tipo_huevo: id_tipo_huevo, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                          success:function(){
                            $('#loading').css("display","none"); 
                            alertify.success("GUARDADO CORRECTAMENTE");
                            $("#huevo_diario"+id).val(1);                                                            
                          },
                          error:function(){
                            $('#loading').css("display","none"); 
                            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 1");        
                          },                             
                      });
                  } 
                  else {
                    var route_2 = "dato_huevo_diario/"+id;
                    $.get(route_2,function(res2){
                       var cantidad_maple=parseInt(res2[0].cantidad_maple) + parseInt($("#cantidad_tipo_maple"+id).val());
                       var cantidad_huevo = parseInt(cantidad_maple) * parseInt($("#cant_tipo_huevo"+id).val());
                      var token = $('#token').val();                         
                      $.ajax({
                          url: 'huevo',
                          headers: {'X-CSRF-TOKEN': token},
                          type: 'POST',
                          dataType: 'json',
                          data: {id_tipo_huevo: id_tipo_huevo, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                          success:function(){
                            $('#loading').css("display","none");                 
                            alertify.success("GUARDADO CORRECTAMENTE");          
                          },
                          error:function(){
                            $('#loading').css("display","none");                                          
                            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 2");
                          },                             
                      });
                    });                                
                  }
  } 
  else {
        $('#loading').css("display","none"); 
        alertify.alert("MENSAJE",'CANTIDAD DE HUEVO NO DISPONIBLE');
  }
});
}
}


/*
//REGISTRAR HUEVO ACUMULADOS Y DIARIAS
function registrar_huevos(id){
var nombre = $("#tipo_huevo"+id).text();  
if (isNaN(parseInt($('#cantidad_tipo_maple'+id).val()))) {
        alertify.alert("MENSAJE",'INTRODUSCA UNA CANTIDAD EN '+nombre);
} else {  
var route_huevo = 'obtener_huevo_acumulado';
$.get(route_huevo,function(res_h){
var x = parseInt($('#cant_tipo_huevo'+id).val()) * parseInt($('#cantidad_tipo_maple'+id).val());

  if (res_h[0].cantidad >= x) {
    var cantidad_huevo_acumulado=parseInt(res_h[0].cantidad) - parseInt(x);
    var id_tipo_huevo=id;
    var token = $('#token').val();

                //HUEVO ADEPOSITO
                  if (parseInt($("#huevo_acumulado"+id).val()) == 0) {
                      var cantidad_maple = $("#cantidad_tipo_maple"+id).val();
                      var cantidad_huevo = parseInt(cantidad_maple) * parseInt($("#cant_tipo_huevo"+id).val());   
                      var token = $('#token').val();                   
                      $.ajax({
                          url: 'huevodeposito',
                          headers: {'X-CSRF-TOKEN': token},
                          type: 'POST',
                          dataType: 'json',
                          data: {id_tipo_huevo: id_tipo_huevo, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                          success:function(){
                            alertify.success("GUARDADO CORRECTAMENTE 1");
                            $("#huevo_acumulado"+id).val(1);                            
                          },
                          error:function(){
                            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 1");
                          },                            
                      }); 
                  } 
                  else {
                      var route = "dato_huevo_acumulado/"+id;
                      $.get(route,function(res){                              
                               var cantidad_maple = parseInt(res[0].cantidad_maple) + parseInt($("#cantidad_tipo_maple"+id).val());
                               var cantidad_huevo = parseInt($("#cant_tipo_huevo"+id).val()) * parseInt(cantidad_maple);
                               var token = $('#token').val();
                              $.ajax({
                                  url: 'huevodeposito',
                                  headers: {'X-CSRF-TOKEN': token},
                                  type: 'POST',
                                  dataType: 'json',
                                  data: {id_tipo_huevo: id_tipo_huevo, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                                  success:function(){
                                    alertify.success("GUARDADO CORRECTAMENTE 2");                        
                                  },
                                  error:function(){
                                    alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 2");
                                  },                                     
                              });
                         });                                   
                  }

              //  HUEVO DIARIO
                  if ( parseInt($("#huevo_diario"+id).val()) == 0) {
                      var cantidad_maple = $("#cantidad_tipo_maple"+id).val();
                      var cantidad_huevo = parseInt(cantidad_maple) * parseInt($("#cant_tipo_huevo"+id).val());
                      var token = $('#token').val();                      
                      $.ajax({
                          url: 'huevo',
                          headers: {'X-CSRF-TOKEN': token},
                          type: 'POST',
                          dataType: 'json',
                          data: {id_tipo_huevo: id_tipo_huevo, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                          success:function(){
                            alertify.success("GUARDADO CORRECTAMENTE 3");
                            $("#huevo_diario"+id).val(1);
                          },
                          error:function(){
                            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 3");
                          },                             
                      });

                  } 
                  else {
                    var route_2 = "dato_huevo_diario/"+id;
                    $.get(route_2,function(res2){
                       var cantidad_maple=parseInt(res2[0].cantidad_maple) + parseInt($("#cantidad_tipo_maple"+id).val());
                       var cantidad_huevo = parseInt(cantidad_maple) * parseInt($("#cant_tipo_huevo"+id).val());
                      var token = $('#token').val();                         
                      $.ajax({
                          url: 'huevo',
                          headers: {'X-CSRF-TOKEN': token},
                          type: 'POST',
                          dataType: 'json',
                          data: {id_tipo_huevo: id_tipo_huevo, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                          success:function(){
                            alertify.success("GUARDADO CORRECTAMENTE 4");                          
                          },
                          error:function(){
                            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 4");
                          },                             
                      });
                    });                                
                  }

                $('#huevo_acumulado').val(cantidad_huevo_acumulado);
                  $.ajax({
                      url: 'huevoacumulado',
                      headers: {'X-CSRF-TOKEN': token},
                      type: 'POST',
                      dataType: 'json',
                      data: { cantidad:cantidad_huevo_acumulado},
                      success:function(){
                     //   $(location).attr('href', 'cantidadmaple');
                        alertify.success('MAPLE '+nombre+' GUARDADO CORRECTAMENTE 5');                         
                      },
                      error:function(){
                        alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 5");
                      },                         
                  });

                  $('#btnregistrar_huevo'+id).show(1000);
                  $('#btnregistrar_huevo'+id).hide(1000);
                  $('#btnregistrar_huevo'+id).show(1000);
  } 
  else {
        alertify.alert("MENSAJE",'CANTIDAD DE HUEVO NO DISPONIBLE');
  }
});
}
}*/



/*


//REGISTRAR CAJA ACUMULADAS Y DIARIASS
function registrar_maple(id){
var nombre = $("#nombre"+id).text();  
if (isNaN(parseInt($('#cantidad_maple'+id).val()))) {
        alertify.alert("MENSAJE",'INTRODUSCA UNA CANTIDAD EN '+nombre);
} 
else {
var route_huevo = 'obtener_huevo_acumulado';
$.get(route_huevo,function(res_h){
var x = parseInt($('#cant_huevo'+id).val()) * parseInt($('#cantidad_maple'+id).val());

  if (res_h[0].cantidad >= x) {
    var cantidad_huevo_acumulado=parseInt(res_h[0].cantidad) - parseInt(x);
    var id_tipo_caja=id;
    var token = $('#token').val();
    var maple = parseInt($("#cantidad_maple_aux"+id).val()) + parseInt($("#cantidad_maple"+id).val());
    $("#cantidad_maple_aux"+id).val(maple);

      if ( parseInt($("#cantidad_maple_aux"+id).val()) >= parseInt($("#cant_maple"+id).val()) ){
         $("#cantidad_maple_aux"+id).val(parseInt(maple) - parseInt($("#cant_maple"+id).val()));
         var maple_aux = parseInt(maple) - parseInt($("#cant_maple"+id).val());

                      $.ajax({
                          url: 'cantidadmaple',
                          headers: {'X-CSRF-TOKEN': token},
                          type: 'POST',
                          dataType: 'json',
                          data: {id_tipo_caja: id_tipo_caja, cantidad_maple:maple_aux},
                          success:function(){
                            alertify.warning('SE ARMO UNA CAJA 5'+nombre);
                            $('#huevo_acumulado').val(cantidad_huevo_acumulado);
                          },
                          error:function(){
                            alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 5");
                            return;
                          },                          
                      }); 

                     //CAJA ACUMULADO
                           if (parseInt($("#caja_acumulado"+id).val()) == 0) {
                                var cantidad_maple = $("#cant_maple"+id).val();
                                $.ajax({
                                    url: 'cajadeposito',
                                    headers: {'X-CSRF-TOKEN': token},
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {id_tipo_caja: id_tipo_caja, cantidad_caja:1, cantidad_maple:cantidad_maple},
                                    success:function(){
                                      alertify.success("GUARDADO CORRECTAMENTE 1");
                                      parseInt($("#caja_acumulado"+id).val(1));                                       
                                    },
                                    error:function(){
                                      alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 1");
                                    },
                                });

                            } 
                            else {
                            var route = "dato_caja_acumulado/"+id;
                            $.get(route,function(res){                              
                                     var cantidad_caja=parseInt(res[0].cantidad_caja) + parseInt(1);
                                     var cantidad_maple = parseInt($("#cant_maple"+id).val()) * parseInt(cantidad_caja);
                                    $.ajax({
                                        url: 'cajadeposito',
                                        headers: {'X-CSRF-TOKEN': token},
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {id_tipo_caja: id_tipo_caja, cantidad_caja:cantidad_caja, cantidad_maple:cantidad_maple},
                                        success:function(){
                                          alertify.success("GUARDADO CORRECTAMENTE 2");                                     
                                        },
                                        error:function(){
                                          alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 2");
                                        },                                    
                                    });
                               });                                   
                            }
  
                        //  CAJA DIARIO
                      if ( parseInt($("#caja_diario"+id).val()) == 0) {
                          var cantidad_maple = $("#cant_maple"+id).val();
                          var cantidad_huevo = parseInt($("#cant_huevo"+id).val()) * parseInt(cantidad_maple);
                          $.ajax({
                              url: 'caja',
                              headers: {'X-CSRF-TOKEN': token},
                              type: 'POST',
                              dataType: 'json',
                              data: {id_tipo_caja: id_tipo_caja, cantidad_caja:1, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                              success:function(){
                                alertify.success("GUARDADO CORRECTAMENTE 3");
                                parseInt($("#caja_diario"+id).val(1));
                                var maple_aux = $("#cantidad_maple_aux"+id).val();
                              },
                              error:function(){
                                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 3");
                              },                                    
                          });
                      } 
                      else {
                        var route_2 = "dato_caja_diario/"+id;
                        $.get(route_2,function(res2){
                           var cantidad_caja=parseInt(res2[0].cantidad_caja) + parseInt(1);
                           var cantidad_maple = parseInt($("#cant_maple"+id).val()) * parseInt(cantidad_caja);
                           var cantidad_huevo = parseInt(cantidad_maple) * parseInt($("#cant_huevo"+id).val());
                          $.ajax({
                              url: 'caja',
                              headers: {'X-CSRF-TOKEN': token},
                              type: 'POST',
                              dataType: 'json',
                              data: {id_tipo_caja: id_tipo_caja, cantidad_caja:cantidad_caja, cantidad_maple:cantidad_maple, cantidad_huevo:cantidad_huevo},
                              success:function(){
                                alertify.success("GUARDADO CORRECTAMENTE 4");
                                var maple_aux = $("#cantidad_maple_aux"+id).val();

                              },
                              error:function(){
                                alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 4");
                              },                                     
                          });
                        });
                      }

        }
      else{
        var maple_aux = $("#cantidad_maple_aux"+id).val();
        //var cantidad_huevo = parseInt(maple_aux) * parseInt($("#cant_huevo"+id).val());
        $.ajax({
            url: 'cantidadmaple',
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {id_tipo_caja: id_tipo_caja, cantidad_maple:maple_aux},
            success:function(){
              alertify.success("GUARDADO CORRECTAMENTE 6");
              $('#huevo_acumulado').val(cantidad_huevo_acumulado);
            },
            error:function(){
              alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 6");
              return;
            },            
        });

        $.ajax({
            url: 'huevoacumulado',
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: { cantidad:cantidad_huevo_acumulado},
            success:function(){
           // $(location).attr('href', 'cantidadmaple');
              alertify.success("GUARDADO CORRECTAMENTE 7");

            },
            error:function(){
              alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE 7");
            },              
        });
      }
      //acumulado = $('#huevo_acumulado').val();
        $('#btnregistrar'+id).show(1000);
        $('#btnregistrar'+id).hide(1000);
        $('#btnregistrar'+id).show(1000);
        alertify.success('GUARDADO CORRECTAMENTE');
  } 
  else {
        alertify.alert("MENSAJE",'CANTIDAD DE HUEVO NO DISPONIBLE');
  }
});
}
}
*/







