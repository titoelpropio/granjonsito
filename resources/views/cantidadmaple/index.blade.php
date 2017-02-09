@extends ('layouts.admin2')
@section ('content')
@include('alerts.cargando')
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">	
	<table class="table table-striped table-bordered table-condensed table-hover">
		<tr><td>
		   <div class="pull-right">		
		   @foreach($huevo_acumulado as $aux2)
			<font color="red" size="3">CANTIDAD DE HUEVOS:</font> <input type="text" style="width:120px;height:40px;font-size:30px;text-align:center" readonly="" value="{{$aux2->cantidad}}" id="huevo_acumulado">  <a href="cantidadmaple" class="btn btn-danger">ACTUALIZAR</a>
			@endforeach	</div>
			<h1>MAPLES</h1>
		</td></tr>
	</table>
	<table class="table table-striped table-bordered table-condensed table-hover">
		<tr style="background-color: black; color: white" align="center">
		@foreach($tipo_caja as $can)
			<td><center> <font size="4" id="nombre{{$can->id}}"><b> {{ $can->tipo}} </b></font></center></td>
		@endforeach
		</tr>
		<tr align="center">
		@foreach($tipo_caja as $can)
		  <td style="background-color: {{ $can->color }}">
			<input type="number" style="width: 75px; height: 40px; font-size: 30px; text-align: center" id="cantidad_maple{{$can->id}}" onkeypress="return bloqueo_de_punto(event)" onclick="this.value=''"><br>

			<input type="hidden" size="1" id="cantidad_maple_aux{{$can->id}}"><br>

			<button class='btn btn-danger' style="background:black; height:40px;" id="btnregistrar{{$can->id}}" onclick="registrar_maple({{ $can->id }})"><b>REGISTRAR</b></button> <br>

			<input type="hidden" size="1" value="{{$can->cantidad_maple}}" id="cant_maple{{$can->id}}">
			<input type="hidden" size="1" value="{{$can->cantidad}}" id="cant_huevo{{$can->id}}">
			<br>
			<input type="hidden" size="1" id="caja_acumulado{{$can->id}}">
			<input type="hidden" size="1" id="caja_diario{{$can->id}}">					
		  </td>
		@endforeach	
		</tr> 
	</table>

	 @foreach($cantidad_maple as $aux2)
			<input type="hidden" size="1" value="{{$aux2->cantidad_maple}}" id="maple{{$aux2->id_tipo_caja}}">
	@endforeach	

	 @foreach($caja_dia as $aux2)
			<input type="hidden" size="1" value="{{$aux2->cantidad_caja}}" id="cantidad_caja_diario{{$aux2->id_tipo_caja}}">
	@endforeach	

	 @foreach($caja_deposito as $aux2)
			<input type="hidden" size="1" value="{{$aux2->cantidad_caja}}" id="cantidad_caja_acumulado{{$aux2->id_tipo_caja}}">
	@endforeach	<br><br><br><br>


<!--AQUI EMPIEZA LOS HUEVOS-->
		<table class="table table-striped table-bordered table-condensed table-hover">
		<tr style="background-color: black; color: white" align="center">
		@foreach($tipo_huevo as $can)
			<td><center> <font size="4" id="tipo_huevo{{$can->id}}"><b> {{ $can->tipo}} </b></font></center></td>
		@endforeach
		</tr>
		<tr align="center" style="background-color: cornsilk">
		@foreach($tipo_huevo as $can)
		  <td>
			<input type="number" style="width: 75px; height: 40px; font-size: 30px; text-align: center" id="cantidad_tipo_maple{{$can->id}}" onkeypress="return bloqueo_de_punto(event)" onclick="this.value=''"><br><br>
			<button class='btn btn-danger' style="background:black; height:40px;" id="btnregistrar_huevo{{$can->id}}" onclick="registrar_huevos({{ $can->id }})"><b>REGISTRAR</b></button>

			<input type="hidden" size="1" value="{{$can->cantidad}}" id="cant_tipo_huevo{{$can->id}}">
			<br>
			<input type="hidden" size="1" id="huevo_acumulado{{$can->id}}">
			<input type="hidden" size="1" id="huevo_diario{{$can->id}}">					
		  </td>
		@endforeach	
		</tr> 
	</table>

	 @foreach($huevo_dia as $aux2)
			<input type="hidden" size="1" value="{{$aux2->cantidad_maple}}" id="cantidad_huevo_diario{{$aux2->id_tipo_huevo}}">
	@endforeach	

	 @foreach($huevo_deposito as $aux2)
			<input type="hidden" size="1" value="{{$aux2->cantidad_maple}}" id="cantidad_huevo_acumulado{{$aux2->id_tipo_huevo}}">
	@endforeach
		</div>
	</div>
</div>
{!!Html::script('js/cantidadmaple.js')!!}
@endsection
