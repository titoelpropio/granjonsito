$(document).ready(function () {                
   $("#galpon_cria").addClass("form-control");
   $("#galpon_cria").append("<option value='0'>Seleccione Un Galpon Cria</option>");
   $("#galpon_ponedora").addClass("form-control");
   $("#galpon_ponedora").append("<option value='0'>Seleccione Un Galpon Ponedora</option>");
    $.get("/capturagalponcria", function (response) {
        for (i = 0; i < response.length; i++) {
            $("#galpon_cria").append("<option value='" + response[i].id + "'>" + response[i].nombre + " --->  " + "Edad: "+ response[i].edad + "</option>");
        }
    });

    $.get("/capturagalponponedora", function (response) {
        for (i = 0; i < response.length; i++) {
            $("#galpon_ponedora").append("<option value='" + response[i].id + "'>" + response[i].nombre + "</option>");
        }
    });
})

$("#galpon_cria").change(function(event){
    var tipo_galpon = $("#galpon_cria option:selected").val();
     $("#id_g").val(event.target.value);
    $.get("/tipogalponcria/" + event.target.value, function (response) {   
        $("#cantidad_inicial").val(response[0].cantidad_actual);
        $('#edad').val(response[0].edad);       
        $('#id_edad').val(response[0].id);  
        $('#fecha_inicio').val(response[0].fecha_inicio);
    }); 
});

function traspaso_edad() {
var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1; 
var yyyy = hoy.getFullYear();
if(dd<10) {
    dd='0'+dd
} 
if(mm<10) {
    mm='0'+mm
} 
hoy = yyyy+'-'+mm+'-'+dd;

    var edad = $("#edad").val();
    var fecha_inicio = $("#fecha_inicio").val();
    var cantidad_inicial = $("#cantidad_inicial").val();
    var cantidad_actual = $("#cantidad_inicial").val();
    var total_muerta = 0;
    var estado = 1;
    var id_galpon = $("#galpon_ponedora").val();

    var id_edad = $("#id_edad").val();
    var id_galpon_cria = $("#galpon_cria").val();
    var fecha_egreso=hoy;

    var token = $('#token').val();
    $.ajax({
         url: "crear_edad",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {edad: edad, cantidad_inicial: cantidad_inicial, cantidad_actual: cantidad_actual, total_muerta: total_muerta,fecha_inicio:fecha_inicio,estado: estado, id_galpon: id_galpon},
    });

    $.ajax({
         url: "edad1a",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {id: id_edad, estado:0, id_galpon: id_galpon_cria,fecha_egreso:fecha_egreso},
    });
    location.reload();
}

