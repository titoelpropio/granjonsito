input =0;
input_celda="";
id=0;
valor="0";
var intervalo=setInterval('obtener_temp()',3000000);

$(document).ready(function(){
    /*if ($('#token').val()=="") {
        setTimeout("location.href='galpon'",1000);
    }else{*/
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth() + 1; //hoy es 0!
        var yyyy = hoy.getFullYear();
        if (dd < 10) { dd = '0' + dd; }
        if (mm < 10) { mm = '0' + mm; }
        hoy = yyyy + '/' + mm + '/' + dd ;
        $("#fecha1").val(hoy);  
        $('#loading').css("display","none");
    //}
});

// Find Left Boundry of current Window ESTE ES LO Q ABRE EN OTRA VENTANA EL FORMULARIO DE LOS ALIMENTADO
/*function FindLeftWindowBoundry()
{
    // In Internet Explorer window.screenLeft is the window's left boundry
    if (window.screenLeft)
    {
        return window.screenLeft;
    }
    // In Firefox window.screenX is the window's left boundry
    if (window.screenX)
        return window.screenX;
    return 0;
}

window.leftWindowBoundry = FindLeftWindowBoundry;

// Find Left Boundry of the Screen/Monitor
function FindLeftScreenBoundry()
{
    // Check if the window is off the primary monitor in a positive axis
    // X,Y                  X,Y                    S = Screen, W = Window
    // 0,0  ----------   1280,0  ----------
    //     |          |         |  ---     |
    //     |          |         | | W |    |
    //     |        S |         |  ---   S |
    //      ----------           ----------
    if (window.leftWindowBoundry() > window.screen.width)
    {
        return window.leftWindowBoundry() - (window.leftWindowBoundry() - window.screen.width);
    }
    
    // Check if the window is off the primary monitor in a negative axis
    // X,Y                  X,Y                    S = Screen, W = Window
    // 0,0  ----------  -1280,0  ----------
    //     |          |         |  ---     |
    //     |          |         | | W |    |
    //     |        S |         |  ---   S |
    //      ----------           ----------
    // This only works in Firefox at the moment due to a bug in Internet Explorer opening new windows into a negative axis
    // However, you can move opened windows into a negative axis as a workaround
    if (window.leftWindowBoundry() < 0 && window.leftWindowBoundry() > (window.screen.width * -1))
    {
        return (window.screen.width * -1);
    }
    // If neither of the above, the monitor is on the primary monitor whose's screen X should be 0
    return 0;
}
window.leftScreenBoundry = FindLeftScreenBoundry;
miPopup = window.open('lista_alimento', 'windowName', 'resizable=1, scrollbars=1, fullscreen=1, height=1300, width=1000, screenX=' + window.leftScreenBoundry() + ' , left=' + window.leftScreenBoundry() + ', toolbar=0, menubar=0, status=1');
*/

function extraer_id(id_galpon,input){
    id = id_galpon;
    input_celda=input;
}

$(document).keypress(function(e){
   if (e.which==13) {
    if (valor=="0") {
        if (id!=0) {
        valor="1";
        if (!isNaN(parseInt($("#id_fase_galpon"+id).val()))) {
            $('#loading').css("display","block"); 
            var token = $("#token").val(); 
            var id_fase_galpon = $("#id_fase_galpon"+id).val();
            if (isNaN(parseInt($("#mg"+id).val()))) {var gallina_muerta = 0} else{var gallina_muerta = $("#mg"+id).val()}
            if (isNaN(parseInt($("#gmd"+id).text()))) {var muerta_diaria = 0} else{var muerta_diaria = $("#gmd"+id).text()}           
            var gallinas_actual = parseInt($('#cant_actual'+id).text()) - parseInt(gallina_muerta);
            var  total_muerta= parseInt($('#muerta'+id).text()) + parseInt(gallina_muerta);    
            var gallina_muerta_diaria = parseInt(muerta_diaria) + parseInt(gallina_muerta);       
            if ($("#cantidad_g"+id).text()!="0" && $("#cantidad_g"+id).attr('data-status')!='0') {
            $("#cantidad_g"+id).text( (parseInt(gallinas_actual)  * parseFloat($("#c_granel_g"+id).text())).toFixed(1));
            }
           // $('#mg'+id).val("");         
            if (isNaN(parseInt($("#c1g"+id).val()))) {var celda1 = 0} else{var celda1 = $("#c1g"+id).val()}
            if (isNaN(parseInt($("#c2g"+id).val()))) {var celda2 = 0} else{var celda2 = $("#c2g"+id).val()}
            if (isNaN(parseInt($("#c3g"+id).val()))) {var celda3 = 0} else{var celda3 = $("#c3g"+id).val()}
            if (isNaN(parseInt($("#c4g"+id).val()))) {var celda4 = 0} else{var celda4 = $("#c4g"+id).val()}         
            var total_huevo = parseInt(celda1) + parseInt(celda2) + parseInt(celda3) + parseInt(celda4);
            var postura_huevo = parseInt((parseInt(total_huevo) * parseInt(100)) / parseInt(gallinas_actual));        
            //alert(celda1+'-'+celda2+'-'+celda3+'-'+celda4+'-'+id_fase_galpon+'-'+total_huevo+'-'+postura_huevo+'-'+gallina_muerta+'-'+gallinas_actual+'-'+total_muerta);

            $.ajax({
                url: "galponi",
                headers: {'X-CSRF-TOKEN': token},
                type: 'GET',
                dataType: 'json',
                data: {celda1: celda1, celda2: celda2, celda3: celda3, celda4: celda4, id_fases_galpon: id_fase_galpon, cantidad_total: total_huevo, postura_p: postura_huevo, cantidad_muertas:gallina_muerta_diaria},
                 success: function () {

                    if (!isNaN(parseInt($("#mg"+id).val()))) { //CUANDO INTRODUCE LAS MUERTAS ENTRA POR ACA
                        var route = "actualizar_fases/"+id_fase_galpon;
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'GET',
                            dataType: 'json',
                            data: {cantidad_actual: gallinas_actual, total_muerta: total_muerta},
                            success: function () {
                                $('#cant_actual'+id).text(gallinas_actual);
                                $('#muerta'+id).text(total_muerta);  
                                alertify.success("GUARDADO CORECCTAMENTE"); //DESDE ACA ES LO DE LAS POSTURA
                                $('#gmd'+id).text(gallina_muerta_diaria);
                                $("#total_galpones"+id).text(total_huevo); 
                                $("#ph"+id).text(postura_huevo+ " %");
                                $('#loading').css("display","none");
                                $('#mg'+id).val("");
                                valor="0";                 
                            },
                            error: function (msj) {
                                $('#loading').css("display","none");  
                                alertify.alert("EROR","NO SE PUDO GUARDAR LOS DATOS DEL GALPON "+id+" INTENTE NUEVAMENTE");
                                setTimeout("location.href='galpon'",2000);
                                valor="0"; 
                            }
                        });                                

                    }else{//CUANDO NO INTRODUCE LAS MUERTAS VA POS ACA
                        alertify.success("GUARDADO CORECCTAMENTE"); 
                        $('#gmd'+id).text(gallina_muerta_diaria);
                        $("#total_galpones"+id).text(total_huevo); 
                        $("#ph"+id).text(postura_huevo+ " %");
                        $('#loading').css("display","none");
                        valor="0";
                    }
                },
                error: function (msj) {
                    $('#loading').css("display","none");  
                    alertify.alert("EROR","NO SE PUDO GUARDAR LOS DATOS DEL GALPON "+id+" INTENTE NUEVAMENTE"); 
                    setTimeout("location.href='galpon'",2000);
                   valor="0";
                }
            });
        }
        else{
            alertify.alert('ERROR','GALPON VACIO');
            $("#c1g"+id).val(""); $("#c2g"+id).val(""); $("#c3g"+id).val(""); $("#c4g"+id).val("");  $('#mg'+id).val("");         
            id = 0;
            valor="0";
        }
        }
     }
   }
});

function obtener_temp(){
 var token = $("#token").val(); 
      $.ajax({
        url: "mostrar_tem",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if ($("#temperatura").text() != response[0].temperatura) {
                $("#temperatura").text(response[0].temperatura);  
                actualizar_control_alimento();
            }
        }
    });
}

function actualizar_control_alimento(){
 $('#loading').css("display","block");  
 var temperatura=parseInt($('#temperatura').text());
 var token = $("#token").val(); 
    $.ajax({
        url: "actualizar_control_alimento",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data:{temperatura:temperatura},
        success: function (response) {
            for (var i = 0; i < response.length; i++) {
                if (response[i].length!=undefined) {
                    if ($('#id_alimento'+response[i][0].numero).attr('data-status')==1) {
                        y=parseFloat($('#cant_actual'+response[i][0].numero).text());
                        $('#id_alimento'+response[i][0].numero).text(response[i][0].tipo+":");
                        var x = parseFloat(y) * parseFloat(response[i][0].cantidad);
                        $('#cantidad_g'+response[i][0].numero).text( x.toFixed(2) );
                        $('#c_granel_g'+response[i][0].numero).text( parseFloat(response[i][0].cantidad).toFixed(3));
                        $('#id_control'+response[i][0].numero).text( response[i][0].id_control);
                    }
                }
                else{
                    if ($('#id_alimento'+response[i]).attr('data-status')==1) {                    
                        $('#id_alimento'+response[i]).text("");
                        $('#cantidad_g'+response[i]).text("0");                    
                        $('#c_granel_g'+response[i]).text("0");
                        $('#id_control'+response[i]).text("0");
                    }
                }
            }
            $('#loading').css("display","none");  
        }
    });
}

function mostrarceldas() {
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if (dd < 10) { dd = '0' + dd; }
    if (mm < 10) { mm = '0' + mm; }
    hoy = yyyy + '/' + mm + '/' + dd ;
    globalhoy = hoy;
    $('#loading').css("display","block");  
    fecha = $('#fecha1').val();
    if (fecha == globalhoy) {
        for (var j = 0; j <= 16; j++) {
        $('#c1g' + j).prop('disabled', false);
        $('#c2g' + j).prop('disabled', false);
        $('#c3g' + j).prop('disabled', false);
        $('#c4g' + j).prop('disabled', false);
        $('#mg' + j).prop('disabled', false);
        $('#c1g' + j).val("");
        $('#c2g' + j).val("");
        $('#c3g' + j).val("");
        $('#c4g' + j).val("");
        $('#ph' + j).text(0);
        $('#gmd' + j).text(0);            
        $('#total_galpones' + j).text(0);
        }
    } else
    {
        for (var j = 0; j <= 16; j++) {
            $('#c1g' + j).val("");
            $('#c2g' + j).val("");
            $('#c3g' + j).val("");
            $('#c4g' + j).val("");
            $('#ph' + j).text(0);
            $('#gmd' + j).text(0);            
            $('#total_galpones' + j).text(0);
            $('#mg' + j).prop('disabled', true);          
            $('#c1g' + j).prop('disabled', true);
            $('#c2g' + j).prop('disabled', true);
            $('#c3g' + j).prop('disabled', true);
            $('#c4g' + j).prop('disabled', true);
        }
    }
    var token = $("#token").val();
    $.ajax({
        url: "obtenerdadafecha",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {fecha: fecha},
        success: function (response) {
             $.each(response, function(key, value) {
               $('#ph' + value.numero).text(parseInt(value.postura_p) + '%');
                    $('#total_galpones' + value.numero).text(value.cantidad_total);
                    $('#gmd' + value.numero).text(value.cantidad_muertas);
                    $('#c1g'+value.numero).val(value.celda1);
                    $('#c2g'+value.numero).val(value.celda2);
                    $('#c3g'+value.numero).val(value.celda3);
                    $('#c4g'+value.numero).val(value.celda4);                                           
                });    
            $('#loading').css("display","none");     
        }
    });
}

function cargar_modal(id_control,galpon,id_fase_galpon,cantidad,cantidad_granel){
    var control = id_control;  
    if (control==0) {
        $("select[name=id_silo]").empty();
        $("select[name=id_silo]").addClass("form-control"); 
        $("select[name=id_silo]").append("<option value='0'></option>"); 
        $("#btn_aceptar").hide();
    }
    else {
    $("select[name=id_silo]").empty();
    $("select[name=id_silo]").addClass("form-control");   
    $.get("lista_de_silos/"+control, function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_silo]").append("<option value='" + response[i].id_silo + "'>" + response[i].nombre + " → " + response[i].tipo +"</option>");
            $("#tipo").val(response[i].tipo);
            xxx = response[i].id_silo;
        }
       /* $.get("lista_de_silos_aux/"+xxx, function (response) {
            for (var i = 0; i < response.length; i++) {
                $("select[name=id_silo]").append("<option value='" + response[i].id_silo + "'>" + response[i].nombre + " → " + response[i].tipo +"</option>");
            }
        });  */
    }); 

        $("#titulo").text("ALIMENTAR GALPON "+galpon);
        $("#id_galpon").val(galpon);
        $("#cantidad_actual_g").val($("#cant_actual"+galpon).text());     
        $("#cantidad").val(cantidad);
        $("#id_fase_galpon").val(id_fase_galpon);
        id=0;
        $("#id_control").val($('#id_control'+galpon).text());
        $("#cantidad_granel").val($('#c_granel_g'+galpon).text());
        $("#cantidad").val($('#cantidad_g'+galpon).text());
        $("#btn_aceptar").show();
    }
}

function calcular_alimento(){
    if ($("#cantidad_granel").val()=="") {
        $("#cantidad").val("");
        $("#btn_aceptar").hide();
    } else {
        var dato = (parseFloat($("#cantidad_granel").val()) * parseFloat($("#cantidad_actual_g").val())).toFixed(0);
        $("#cantidad").val(dato);
        $("#btn_aceptar").show();
    }
}

function alimentar(){
    $('#btn_aceptar').hide();
    $('#loading').css("display","block");
    var id_control_alimento = $("#id_control").val();
    var id_fase_galpon = $("#id_fase_galpon").val();
    var cantidad = $("#cantidad").val();
    var id_silo = $("#id_silo").val();
    var token = $("#token").val(); 
    $.ajax({
        url: "consumo",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {cantidad: cantidad, id_silo: id_silo, id_fase_galpon:id_fase_galpon, id_control_alimento:id_control_alimento},
         success: function (response) {
            if (response.mensaje!== undefined) {
                $('#mensaje').modal('show'); 
                $('#titulo_mensaje').text(response.mensaje); 
            }else{
                if (response.mensaje1!== undefined) {
                 alertify.alert("ADVERTENCIA",response.mensaje1); 
                }
                else{
                    alertify.success("GUARDADO CORECCTAMENTE");
                   //miPopup.document.location.reload();
                    location.reload(); 
                }
            }
            $('#myModal').modal('hide');
            $('#loading').css("display","none");
            $('#btn_aceptar').show();     
        },
        error: function () {
            $('#loading').css("display","none");
            alertify.alert("EROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE"); 
            $('#btn_aceptar').show(); 
        },
    });    
}

function actualizar(){
    location.reload();
}

function vacunas(){
    $.get("lista_id_edad", function (response) {
        for (var i = 0; i < response.length; i++) {  
            if (response[i].length != 0) {
               $("#vacuna"+response[i][0].galpon).text(response[i][0].nombre);
               if (response[i][0].dias == 0) {
                    $("#dias"+response[i][0].galpon).text('HOY'); 
               }else{
                    $("#dias"+response[i][0].galpon).text(response[i][0].dias);                
               }
            }
              $('#loading').css("display","none"); 
        } 
    }); 
}

function cargar_id_control_vacuna(id_control,precio){
    $("#cantidad_vac").val(1);
      $('#loading').css("display","block"); 
    $("#precio").val(precio);
    $("#precio_aux").val(precio);
    $("#id_control_vacuna").val(id_control);
    $.get("verificar_consumo_vacuna/"+id_control,function(res){
        $("#mensaje_vacuna").text(res.mensaje);
        
        if (res.mensaje=="¿DESEA CONSUMIR ESTA VACUNA?") {

            $("#espacio").css({'background':'#A9F5F2'});
        }
        else{
            $("#espacio").css({'background':'#F5A9A9'});
        }

          $('#loading').css("display","none"); 
        
    });
  
}

function calcular(){
    if ($("#cantidad_vac").val()=="") {
        $("#precio").val("");        
        $("#btn_consumir").hide();
    } else {
        var dato = (parseFloat($("#cantidad_vac").val()) * parseFloat($("#precio_aux").val())).toFixed(2);
        $("#precio").val(dato);
        $("#btn_consumir").show();
    }
}