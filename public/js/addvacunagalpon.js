$(document).ready(function () {

    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    hoy = yyyy + '-' + mm + '-' + dd;
    $('#fecha1').val(hoy);
    vacunaselect();
    galponselect();
});

//extrae toda la lista de galpon a vacuna 
function listagalponvacunar() {
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1; //hoy es 0!
    var yyyy = hoy.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    hoy = yyyy + '-' + mm + '-' + dd;


  
    var lista = $('#tablavacunagalpon');
    var fecha = $('#fecha1').val();
 $('#tablavacunagalpon').empty();
    var token = $("#token").val();
    $.ajax({
        url: "lista-vacuna-galpon",
        headers: {'X-CSRF-TOKEN': token},
        type: 'GET',
        dataType: 'json',
        data: {fecha: fecha},
        success: function (data) {
       
            if ($('#fecha1').val() == hoy) {
                     
                $(data).each(function (index, el) {
            
                    lista.append("<TR>\n\
  <td><center>" + data[index].galpon + "</center></td> \n\
<td><center>" + data[index].edad + "</center></td>\n\
<td><center>" + data[index].nombre + "</center></td> \n\
<td><center>" + data[index].detalle + "</center></td>\n\
<td><center><button class='btn btn-primary' onclick='cambiarvacuna(" + data[index].idgalpon + "," + data[index].idvacuna + "," + data[index].galpon + "')'>Cambiar V. </button><input  type='button'   value='VACUNAR' class='btn btn-danger' onclick='vacunar(" + data[index].idgalpon + "," + data[index].idvacuna + ")>/center></td> </TR>'");
                });
            }
else
{
      $('#tablavacunagalpon').empty();
      $(data).each(function (index, el) {

                    lista.append("<TR>\n\
  <td><center>" + data[index].galpon + "</center></td> \n\
<td><center>" + data[index].edad + "</center></td>\n\
<td><center>" + data[index].nombre + "</center></td> \n\
<td><center>" + data[index].detalle + "</center></td>\n\
 </TR>'");
                });
}
        }
    });
}
//vacuna un galpon, con una vacuna personalizada en el modal
function vacunar(galpon, vacuna) {
    var idgalpon = galpon;
    var idvacuna = vacuna;
    var token = $("#token").val();
    $.ajax({
        url: "vacuna-galpon",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {id_galpon: idgalpon, id_vacuna: idvacuna},
    });
    $(location).attr('href', 'vacuna-galpon');
}
function cambiarvacuna(galpon, vacuna, nombregalpon) {
    var idgalpon = $('#id_galpon').val(galpon);
    $('#nombre_galpon').val(nombregalpon);
    var token = $("#token").val();
}

function vacunarmodal() {
    var idgalpon = $('#id_galpon').val();
    var idvacuna = $('#selectvacuna option:selected').val();
    var token = $("#token").val();
    $.ajax({
        url: "vacuna-galpon",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {id_galpon: idgalpon, id_vacuna: idvacuna},
    });
    $(location).attr('href', 'vacuna-galpon');
}
function vacunarmodalcreate() {
    
    var idvacuna = $('#selectvacunas option:selected').val();
   var idgalpon = $('#idgalpons option:selected').val();
    var token = $("#token").val();
    $.ajax({
        url: "vacuna-galpon",
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data: {id_galpon: idgalpon, id_vacuna: idvacuna},
    });
    $(location).attr('href', 'vacuna-galpon');
}
//lista de vacunas en el select
function vacunaselect(){
     $("select[name=id_vacuna]").empty();
  

    var routevacuna='/listavacuna/';
     galponselect()
    
    
   
    $.get(routevacuna,function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_vacuna]").append("<option value='" + response[i].id + "'><font color='red'>" + response[i].nombre + "</font>  ->  "+response[i].detalle+"</option>");
        }

    });
   function galponselect(){
           var routegalpon = "/listaedad/";
            $("select[name=id_galpon]").empty();
       $.get(routegalpon,function (response) {
        for (var i = 0; i < response.length; i++) {
            $("select[name=id_galpon]").append("<option value='" + response[i].id_galpon+ "'> Galpon " + response[i].id_galpon + "</option>");
        }

    });
   }
}