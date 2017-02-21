$(document).ready(function(){
    $('#oculta').hide(5000);
    $('#loading').css("display","none");   
    cargar_select();
});

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

function mostrar_consumo_vacunas(){
    var id_edad=$("#id_galponcv").val();
    var total = 0;
    var nombre = $('#id_galponcv option:selected').text();
    $("#datos_vac_con").empty();
    if (id_edad==0) {
        alertify.alert("MENSAJE","SELECCIONE UNA FASE O UN GALPON");
    } else {
        $("#xxx").text(nombre); 
        $.get("lista_consumo_vacuna_emergente/"+id_edad, function(res){
            $("#datos_vac_con").empty();
            for (var i = 0; i < res.length; i++) {
                if (res[i].edad=="EMERGENTE") {
                    total = parseFloat(total) + parseFloat(res[i].precio);
                    $("#datos_vac_con").append("<tr align=center style='background-color:#CEF6F5' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"#CEF6F5\"'>\n\
                        <td>"+res[i].edad+"</td><td>"+res[i].nombre+"</td><td align=left>"+res[i].detalle+"</td><td>"+res[i].cantidad+"</td><td>"+res[i].precio+" Bs.</td>\n\
                        <td><button class='btn btn-primary' data-toggle='modal' data-target='#ModalActualizarConsumoEmergente' onclick='CargarModalConEmer("+res[i].id+","+res[i].cantidad+","+res[i].precio+","+res[i].precio_unitario+")'>ACTUALIZAR</button>\n\
                        <button class='btn btn-danger' data-toggle='modal' data-target='#ModalEliminarConsumoVacunaEmergente' onclick='CargarModalConEmerEliminar("+res[i].id+")'>ELIMINAR</button></td></tr>");
                } else {
                    total = parseFloat(total) + parseFloat(res[i].precio);                    
                    $("#datos_vac_con").append("<tr align=center style='background-color:white' onmouseover='this.style.backgroundColor=\"#F6CED8\"' onmouseout='this.style.backgroundColor=\"white\"'>\n\
                        <td>"+res[i].edad+"</td><td>"+res[i].nombre+"</td><td align=left>"+res[i].detalle+"</td><td>"+res[i].cantidad+"</td><td>"+res[i].precio+" Bs.</td>\n\
                        <td><button class='btn btn-primary' data-toggle='modal' data-target='#ModalActualizarConsumoVacuna' onclick='CargarModalConVac("+res[i].id+","+res[i].cantidad+","+res[i].precio+","+res[i].precio_unitario+")'>ACTUALIZAR</button>\n\
                        <button class='btn btn-danger' data-toggle='modal' data-target='#ModalEliminarConsumoVacuna' onclick='CargarModalConVacEliminar("+res[i].id+")'>ELIMINAR</button></td></tr>");                  
                }                                                 
            }
             $("#datos_vac_con").append("<tr style='background:#FAFAFA; font-size:30px:; color:red' align=center><td>TOTAL</td><td></td><td></td><td></td><td>"+total.toFixed(2)+" Bs.</td></tr>");                    
        });
    }
}

function CargarModalConEmer(id,cantidad,precio,precio_unitario){
    $("#btn_consumir_emer").show();    
    $("#id_con_vac_emer").val(id);
    $("#cantidad_con_vac_emer").val(cantidad);
    $("#precio_con_vac_emer").val(precio);
    $("#precio_aux_emer").val(precio_unitario);
}

function CargarModalConVac(id,cantidad,precio,precio_unitario){
    $("#btn_consumir").show();    
    $("#id_con_vac").val(id);
    $("#cantidad_con_vac").val(cantidad);
    $("#precio_con_vac").val(precio);
    $("#precio_aux").val(precio_unitario);
}

function calcular_con_vac(){
    if ($("#cantidad_con_vac").val()=="") {
        $("#btn_consumir").hide();
        $("#precio_con_vac").val("");
    } else {
        var dato = parseFloat($("#precio_aux").val()) * parseFloat($("#cantidad_con_vac").val())
        $("#precio_con_vac").val(dato.toFixed(2));
        $("#btn_consumir").show();
    }
}

function calcular_con_vac_emer(){
    if ($("#cantidad_con_vac_emer").val()=="") {
        $("#btn_consumir_emer").hide();
        $("#precio_con_vac_emer").val("");
    } else {
        var dato = parseFloat($("#precio_aux_emer").val()) * parseFloat($("#cantidad_con_vac_emer").val())
        $("#precio_con_vac_emer").val(dato.toFixed(2));
        $("#btn_consumir_emer").show();
    }
}

function CargarModalConVacEliminar(id){
    $("#id_con_vac_eli").val(id);
}

function CargarModalConEmerEliminar(id){
    $("#id_con_vac_emer_eli").val(id);
}

function esconder(){
    $("#btn_consumir_eli").hide();
    $("#btn_consumir_emer_eli").hide();
}