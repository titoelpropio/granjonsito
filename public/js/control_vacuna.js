var id_vacuna = [];
var nombre = [];
var edad = [];
var metodo=[];
var check =[];
var cont =0;
var fila=[];

$(document).ready(function(){
    $('#oculta').hide(5000);
    $('#loading').css("display","none");   
    cargar_select();
    $("#btn_agregar").hide();
});



function control_de_vacuna(id){ //CARGA LAS VACUNA CON LAS Q CUENTA ESE GALPON O FASE
$("#vacunas").empty();
$.get("ver_control_vacuna/"+id,function(res){
    for (var i = 0; i < res.length; i++) {
        if (res[i].estado==1) {
             $("#vacunas").append("<tr id=fila align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'>\n\
            <td>"+res[i].edad+"</td><td>"+res[i].nombre+"</td><td>"+res[i].detalle+"</td><td><button value='"+res[i].id_control_vacuna+"' id='btnestado"+res[i].id_control_vacuna+"'  onclick='estado_control_vacuna(0,"+res[i].id_control_vacuna+")' class='btn btn-success'>ACTIVO</button></td></tr>");                    
        } else {
           $("#vacunas").append("<tr id=fila align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'>\n\
            <td>"+res[i].edad+"</td><td>"+res[i].nombre+"</td><td>"+res[i].detalle+"</td><td><button value='"+res[i].id_control_vacuna+"' id='btnestado"+res[i].id_control_vacuna+"' onclick='estado_control_vacuna(1,"+res[i].id_control_vacuna+")' class='btn btn-warning' >INACTIVO</button></td></tr>");
        }           
    }
});
}

function control_vacuna(id){ //CARGA LAS VACUNA CON LAS Q CUENTA ESE GALPON O FASE
cont=0;
$("#datos_vacuna").empty();
$("#id_edad1").val(id);
$.get("listavacuna",function(res){
    for (var i = 0; i < res.length; i++) {
        id_vacuna[cont]=res[i].id;
        check[cont]=i;
        edad[cont]=res[i].edad;
        nombre[cont]=res[i].nombre;
        metodo[cont]=res[i].detalle;
        fila[cont]= $("#datos_vacuna").append("<tr id=fila["+cont+"] align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'>\n\
            <td><input type=hidden name=id_vacuna id=id_vacuna value="+id_vacuna[cont]+" >"+edad[cont]+"</td><td>"+nombre[cont]+"</td><td>"+metodo[cont]+"</td><td><input type='checkbox' style='-webkit-transform: scale(2);' id=v_check"+check[cont]+" value="+id_vacuna[cont]+" checked></td></tr>");
        cont++;
    }
});
}

function confirmar_control_vacuna(){ //CONFIRMA SI VA A AGREGAR LAS VACUNAS
    $("#confirmar_vacuna").empty();
    for (var i = 0; i < cont; i++) {
        if($("#v_check"+i).is(':checked')) {  
            $("#confirmar_vacuna").append("<tr id=fila2["+i+"] align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'>\n\
            <td ><input type=hidden name=id_vacuna[] id=id_vacuna value="+id_vacuna[i]+" >"+edad[i]+"</td><td>"+nombre[i]+"</td><td>"+metodo[i]+"</td><td><input type='checkbox' style='-webkit-transform: scale(2);' id=v_check2"+check[i]+" value="+id_vacuna[i]+" checked></td></tr>");                          
        } 
    }
    $("#btn_confirmar").show();
}

function cargar_select() {
    $("select[name=id_galponcv]").empty();
    $("select[name=id_galponcv]").addClass("form-control");   
    $("select[name=id_galponcv]").append("<option value='0'>SELECCIONE</option>");
    $.get("select_control_vacuna_fase", function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_galponcv]").append("<option value='" + response[i].id_edad + "'>" + response[i].nombre + "</option>");
        }
        $.get("select_control_vacuna_ponedora", function (response) {
            for (var i = 0; i < response.length; i++) {
                $("select[name=id_galponcv]").append("<option value='" + response[i].id_edad + "'> GALPON " + response[i].numero + "</option>");
            }
        });  
    }); 
}

function mostrar_vacunas(){
    $("#datos_vac").empty();
    var id_edad = $("#id_galponcv").val();
    if (id_edad==0) {
        alertify.alert("MENSAJE","SELECCIONE UNA FASE O UN GALPON");
    } else {
        $("#btn_agregar").show();
        var titulo =$('#id_galponcv option:selected').text();
        $("#xxx").text(titulo);
        $.get("ver_control_vacuna/"+id_edad,function(res){
            for (var i = 0; i < res.length; i++) {                        
                if (res[i].estado==1) {
                     $("#datos_vac").append("<tr id=fila align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'>\n\
                    <td>"+res[i].edad+"</td><td>"+res[i].nombre+"</td><td>"+res[i].detalle+"</td><td><button value='"+res[i].id_control_vacuna+"' id='btnestado"+res[i].id_control_vacuna+"'  onclick='estado_control_vacuna(0,"+res[i].id_control_vacuna+")' class='btn btn-success'>ACTIVO</button></td></tr>");                    
                } else {
                   $("#datos_vac").append("<tr id=fila align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'>\n\
                    <td>"+res[i].edad+"</td><td>"+res[i].nombre+"</td><td>"+res[i].detalle+"</td><td><button value='"+res[i].id_control_vacuna+"' id='btnestado"+res[i].id_control_vacuna+"' onclick='estado_control_vacuna(1,"+res[i].id_control_vacuna+")' class='btn btn-warning' >INACTIVO</button></td></tr>");
                }                    
            }
        });   
    } 
}

function estado_control_vacuna(estado, id_control_vacuna) {
    var token = $('#token').val();
    //var id = $(id_control_vacuna).val();
    var route="control_vacuna/"+id_control_vacuna;    
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'JSON',
        data: {estado: estado, id:id_control_vacuna},
        success: function () {
            if (estado==1) {
                $("#btnestado"+id_control_vacuna).attr('onclick', "estado_control_vacuna(0,"+id_control_vacuna+")");
                $("#btnestado"+id_control_vacuna).removeClass();
                $("#btnestado"+id_control_vacuna).addClass('btn btn-success');
                $("#btnestado"+id_control_vacuna).text("ACTIVO");
            }
            else{
                $("#btnestado"+id_control_vacuna).attr('onclick', "estado_control_vacuna(1,"+id_control_vacuna+")");
                $("#btnestado"+id_control_vacuna).removeClass();
                $("#btnestado"+id_control_vacuna).addClass('btn btn-warning');
                $("#btnestado"+id_control_vacuna).text("INACTIVO");            
            }
        }, error: function () {
            alertify.alert("ERROR","INTENTE NUEVAMENTE");
            setInterval(location.reload(), 2000);            
        }
    });         
}


function cargar_id(){ //ESTA FUNCION CARGAR LAS VACUNAS Q NO EXISTE EN ESE GALPON O FASE
    cont=0;
    var id_edad = $("#id_galponcv").val();
    $("#id_edad").val(id_edad);
    $("#id_edad1").val(id_edad);
    $("#datos_vacuna").empty();
    $.get("agregar_listavacuna/"+id_edad,function(res){
        for (var i = 0; i < res.length; i++) {
            id_vacuna[cont]=res[i].id_vacuna;
            check[cont]=i;
            edad[cont]=res[i].edad;
            nombre[cont]=res[i].nombre;
            metodo[cont]=res[i].detalle;
            fila[cont]= $("#datos_vacuna").append("<tr id=fila["+cont+"] align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'>\n\
                <td><input type=hidden name=id_vacuna id=id_vacuna value="+id_vacuna[cont]+" >"+edad[cont]+"</td><td>"+nombre[cont]+"</td><td>"+metodo[cont]+"</td><td><input type='checkbox' style='-webkit-transform: scale(2);' id=v_check"+check[cont]+" value="+id_vacuna[cont]+" checked></td></tr>");
            cont++;
        }
    });    
}

function ocultar_btn(){
    $("#btn_confirmar").hide();
}