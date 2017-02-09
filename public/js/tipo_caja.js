$(document).ready(function(){
    if ($('#token').val()=="") {
        location.reload();
    }else{
    $('#oculta').hide(5000);
    $('#loading').css("display","none");
    } 
});

function cambiar_estado(estado, id_tipo_caja) {
    var token = $('#token').val();
    var id = $(id_tipo_caja).val();
 var route = "cantidad_caja/"+id;    
 $.get(route, function (res) { 
 	if (isNaN(res)) {
		if (res[0].cantidad_caja ==0 ) {
			    $.ajax({
			        url: "tipocaja_estado",
			        headers: {'X-CSRF-TOKEN': token},
			        type: 'GET',
			        dataType: 'JSON',
			        data: {estado: estado, id: id},
			        success: function () {
			            if (estado==1) {
			                $(id_tipo_caja).attr('onclick', "cambiar_estado(0,this)");
				            $(id_tipo_caja).removeClass();
				            $(id_tipo_caja).addClass('btn btn-success');
				            $(id_tipo_caja).text("ACTIVO");
			            }else{
			                $(id_tipo_caja).attr('onclick', "cambiar_estado(1,this)");
				            $(id_tipo_caja).removeClass();
				            $(id_tipo_caja).addClass('btn btn-warning');
				            $(id_tipo_caja).text("INACTIVO");			
			            }
			        }, error: function () {
			            toastr.options.timeOut = 3000;
			            toastr.options.positionClass = "toast-bottom-center";
			            toastr.error('INTENTE NUEVAMENTE');
			        },
			    });   		
		 	} else {
				alertify.alert("MENSAJE",'EXISTE CAJAS EN EL DEPOSITO NO PUEDE DESHABILITAR ESTE TIPO DE CAJA');
		 	} 
 	}else{
 		$.ajax({
	        url: "tipocaja_estado",
	        headers: {'X-CSRF-TOKEN': token},
	        type: 'GET',
	        dataType: 'JSON',
	        data: {estado: estado, id: id},
	        success: function () {
	            if (estado==1) {
	                $(id_tipo_caja).attr('onclick', "cambiar_estado(0,this)");
		            $(id_tipo_caja).removeClass();
		            $(id_tipo_caja).addClass('btn btn-success');
		            $(id_tipo_caja).text("ACTIVO");
	            }else{
	                $(id_tipo_caja).attr('onclick', "cambiar_estado(1,this)");
		            $(id_tipo_caja).removeClass();
		            $(id_tipo_caja).addClass('btn btn-warning');
		            $(id_tipo_caja).text("INACTIVO");	            
	            }
	        }, error: function () {
	            toastr.options.timeOut = 3000;
	            toastr.options.positionClass = "toast-bottom-center";
	            toastr.error('INTENTE NUEVAMENTE');
	        },
		});   		
 	}
  });  
}

//CREAR TIPO CAJA
function crear_tipo_caja(){
$('#btnregistrar').hide();
$('#loading').css("display","block"); 
var tipo=$("#tipo").val();
var precio=$("#precio").val();
var color=$("#color").val();
var cantidad_maple=$("#cantidad_maple").val();
var id_maple=$("#id_maple").val();
var token = $("#token").val();
        $.ajax({
            url: "tipocaja",
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data: {tipo:tipo, precio:precio, color:color, cantidad_maple:cantidad_maple, id_maple:id_maple, estado:1},
            success:function(){
            	alertify.success("GUARDADO CORRECTAMENTE");
        		location.reload();
            },
            error:function(){
            	$('#btnregistrar').show();
            	alertify.alert("ERROR","NO SE PUDO GUARDAR LOS DATOS INTENTE NUEVAMENTE");
            	$('#loading').css("display","none"); 
            },
        });
}