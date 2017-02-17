@extends('layouts.admin')
@section('content')
@include('alerts.cargando')   
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
<table class="table table-striped table-bordered table-condensed table-hover">
	<TR>	
	@foreach ($silo as $sil)

	<?php if ($sil->cantidad <= $sil->cantidad_minima): ?>
		<td align="center" bgcolor="MistyRose">
		<font color="red" size="5"><span>COMPRAR GRANO</span></font><br>
	<?php else: ?>
		<td align="center" bgcolor="white">
	<?php endif ?>
			<font color="red" size="5"><span id="nombre{{$sil->id}}"> {{$sil->nombre}} </span></font><br>
			<img src="{{asset('images/silo3.jpg')}}"><br>
			<font color="red">Tipo:</font> <span id="tipo"> {{$sil->tipo}} </span><br>
			<font color="red">Capacidad:</font> <span id="capacidad{{$sil->id}}"}>{{$sil->capacidad}}</span> Kg<br>
			<font color="red">Cantidad Actual:</font> <span id="cantidad{{$sil->id}}" title="LLENAR">{{$sil->cantidad}}</span> Kg<br>
			<font color="red">Cantidad a Llenar:</font> <span id="llenar{{$sil->id}}"}></span> Kg<br>
			<button class="btn btn-success" onclick="llenar_silo({{$sil->id}})" id="btnllenar{{$sil->id}}">LLENAR SILO</button> <br><br>

			<input type="text" class="form-control" placeholder="Cantidad De Grano" id="cantidad_total{{$sil->id}}" onkeypress="return numerosmasdecimal(event)"><br>
			<input type="text" class="form-control" placeholder="Precio" id="precio_compra{{$sil->id}}" onkeypress="return numerosmasdecimal(event)"><br>
			
			<button class="btn btn-danger" onclick="obtener_id_silo({{$sil->id}})" id="btncomprar{{$sil->id}}">COMPRAR</button>
		</td>
	@endforeach 
		</TR>
</table>
 {!!Html::script('js/compra.js')!!}  
@endsection

 