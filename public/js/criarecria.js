input =0;
valor="0";
var intervalo=setInterval('obtener_temp()',3000000);
//var intervalo=setInterval('actualizar_control_alimento_cria()',18000000);

$(document).ready(function(){
   /* if ($('#token').val()=="") {
        setTimeout("location.href='criarecria'",1000);
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

// Find Left Boundry of current Window
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
function extraer_id(id_fase){
    id = id_fase;
}

$(document).keypress(function(e){
  if (e.which==13) {
    if (valor=="0") {
        if (id != 0) {
            valor="1";
            if (!isNaN(parseInt($("#id_fase_galpon"+id).val()))) {
                if (!isNaN(parseInt($("#gm"+id).val()))) {
                    $('#loading').css("display","block");
                    var token = $("#token").val(); 
                    var id_fase_galpon = $("#id_fase_galpon"+id).val();
                    if (isNaN(parseInt($("#gm"+id).val()))) {var gallina_muerta = 0} else{var gallina_muerta = $("#gm"+id).val()}
                    if (isNaN(parseInt($("#gmdc"+id).val()))) {var muerta_diaria = 0} else{var muerta_diaria = $("#gmdc"+id).val()}            
                    var gallinas_actual = parseInt($('#cant_actual'+id).text()) - parseInt(gallina_muerta);
                    var total_muerta = parseInt($('#muerta'+id).text()) + parseInt(gallina_muerta);    
                    var gallina_muerta_diaria = parseInt($('#gmdc'+id).text()) + parseInt(gallina_muerta);
                    if ($("#cantidad_g"+id).text()!="0" && $("#id_alimento"+id).attr('data-status')!='0') {
                        $("#cantidad_g"+id).text( (parseInt(gallinas_actual)  * parseFloat($("#c_granel_g"+id).text())).toFixed(1));
                    }
                    $.ajax({
                        url: "galponi",
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'GET',
                        dataType: 'json',
                        data: {celda1: 0, celda2: 0, celda3: 0, celda4: 0, id_fases_galpon: id_fase_galpon, cantidad_total: 0, postura_p: 0, cantidad_muertas:gallina_muerta_diaria},
                         success: function () {
                            $('#gmdc'+id).text(parseInt(gallina_muerta_diaria));  
                            var route = "actualizar_fases/"+id_fase_galpon;
                            $.ajax({
                                url: route,
                                headers: {'X-CSRF-TOKEN': token},
                                type: 'GET',
                                dataType: 'json',
                                data: {cantidad_actual: gallinas_actual, total_muerta: total_muerta},
                                success: function () {
                                   alertify.success("GUARDADO CORECCTAMENTE");                 
                                    $('#cant_actual'+id).text(gallinas_actual);
                                    $('#muerta'+id).text(total_muerta);
                                    $('#gm'+id).val(""); 
                                    $('#loading').css("display","none");
                                    valor="0";
                                },
                                error: function (msj) {
                                    $('#loading').css("display","none");
                                    alertify.alert("EROR","NO SE PUDO GUARDAR LOS DATOS DE LA FASE "+id+" INTENTE NUEVAMENTE"); 
                                    setTimeout("location.href='criarecria'",2000);
                                    valor="0";
                                }
                            }); 
                        },
                        error: function (msj) {
                            $('#loading').css("display","none");
                            alertify.alert("EROR","NO SE PUDO GUARDAR LOS DATOS DE LA FASE "+id+" INTENTE NUEVAMENTE"); 
                            setTimeout("location.href='criarecria'",2000);
                            valor="0";
                        }
                    });       
                }else{
                    alertify.alert("ERROR","INTRODUSCA LOS DATOS CORRESPONDIENTE");
                    valor="0";
                }
            }
            else{
                alertify.alert('ERROR','FASE VACIA');
                $('#gm'+id).val("");
                valor="0";
            }
        }
    } 
  }
});

function mostrarcriamuertas() {
    $('#loading').css("display","block");
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();
    if (dd < 10) { dd = '0' + dd; }
    if (mm < 10) { mm = '0' + mm; }
    hoy = yyyy + '/' + mm + '/' + dd ;
    globalhoy = hoy;    
    fecha = $('#fecha1').val()
    if (fecha == globalhoy) {
        for (var j = 1; j <= 3; j++) {
            $('#gmdc' + j).text(0);               
            $('#gm' + j).prop('disabled', false);
        }
    } else
    {
        for (var j = 1; j <= 3; j++) {
            $('#gmdc' + j).text(0);            
            $('#gm' + j).prop('disabled', true);
        }
    }
    var token = $("#token").val();
    $.ajax({
        url: "obtenerdadafecha_cria",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {fecha: fecha},
        success: function (response) {
            $.each(response, function(key, value) {
                $('#gmdc'+value.numero).text(value.cantidad_muertas);
            });  
            $('#loading').css("display","none");
        },
    });
}

function cargar_modal(id_control,galpon,id_fase_galpon,cantidad,cantidad_granel){
    if (control==0) {
        $("select[name=id_silo]").empty();
        $("select[name=id_silo]").addClass("form-control"); 
        $("select[name=id_silo]").append("<option value='0'></option>");
        $("#btn_aceptar").hide();
    } 
    else {
        $("select[name=id_silo]").empty();
        $("select[name=id_silo]").addClass("form-control");   
        var control = $('#id_control'+galpon).text(); 
        $.get("lista_de_silos/"+control, function (response) {
            for (var i = 0; i < response.length; i++) {
                $("select[name=id_silo]").append("<option value='" + response[i].id_silo + "'>" + response[i].nombre + " → " + response[i].tipo +"</option>");
                $("#tipo").val(response[i].tipo);
            }
        }); 
        $("#titulo").text("ALIMENTAR FASE "+galpon);
        $("#id_galpon").val(galpon);
        $("#id_fase_galpon").val(id_fase_galpon);
        $("#cantidad_actual_g").val($("#cant_actual"+galpon).text());  
        id=0;
        $("#btn_aceptar").show();
        $("#id_control").val($('#id_control'+galpon).text());
        $("#cantidad_granel").val($('#c_granel_g'+galpon).text());
        $("#cantidad").val($('#cantidad_g'+galpon).text());
    }
}

function calcular_alimento(){
    if ($("#cantidad_granel").val()=="") {
        $("#cantidad").val("");
        $("#btn_aceptar").hide();
    } else {
        var dato = (parseFloat($("#cantidad_granel").val()) * parseFloat($("#cantidad_actual_g").val())).toFixed(1);
        $("#cantidad").val(dato);
        $("#btn_aceptar").show();
    }
}

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
                actualizar_control_alimento_cria();
            }       
        }
    });
}


function actualizar_control_alimento_cria(){
 $('#loading').css("display","block"); 
 var temperatura=parseInt($('#temperatura').text());
 var token = $("#token").val(); 
    $.ajax({
        url: "actualizar_control_alimento_cria",
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
                    location.reload(); 
                }
            }
           // miPopup.document.location.reload();
            $('#myModal').modal('hide');
            $('#loading').css("display","none");
            $('#btn_aceptar').show();
        },
        error: function () {
            $('#loading').css("display","none");
            alertify.alert("EROR","NO SE PUDO GUARDAR LOS DATOS NUEVAMENTE"); 
            $('#btn_aceptar').show();
        },
    });    
}

function actualizar(){
    location.reload();
}

function vacunas(){
    $.get("lista_edad_cria", function (response) {
        for (var i = 0; i < response.length; i++) {  
            if (response[i].length != 0) {
               $("#vacuna"+response[i][0].galpon).text(response[i][0].nombre);
               if (response[i][0].dias == 0) {
                    $("#dias"+response[i][0].galpon).text('HOY'); 
               }else{
                    $("#dias"+response[i][0].galpon).text(response[i][0].dias);                
               }
            }
        } 
        $('#loading').css("display","none");
    }); 
}