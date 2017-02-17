@extends('layouts.admin')
@section('content')
@include('controlalimento.modal')
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="panel panel-green">
	    <div class="panel-heading">
	         <ul class="nav nav-pills">
	            <li class="active"><a href="{!!URL::to('controlalimento')!!}">CONTROL ALIMENTO</a></li>   
	            <li class="active"><a href="{!!URL::to('rango')!!}">AGREGAR RANGOS</a></li>    	                             
	        </ul>
	    </div> 
	</div> 
</div> 

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="pull-left"><h1>CONTROL DE ALIMENTO</h1></div>
<div class="pull-right"><button class="btn btn-success" data-toggle='modal' data-target='#myModal'>AGREGAR</button></div>

	<table class="table table-striped table-bordered table-condensed table-hover">
	<thead style="background-color: black; color: white">
	<th><CENTER>EDAD MIN</CENTER></th>
		<th><CENTER>EDAD MAX</CENTER></th>
		<th><CENTER>TEMPERATURA MIN</CENTER></th>
		<th><CENTER>TEMPERATURA MAX</CENTER></th>
		
		<th><CENTER>CANTIDAD</CENTER></th>
		<th><CENTER>ALIMENTO</CENTER></th>	
		<th><CENTER>OPCION</CENTER></th>	
	</thead>
	 @foreach ($controlalimento as $cons)
		<tr>
		<td><CENTER>{{$cons->edad_min}} </CENTER></td>
			<td><CENTER>{{$cons->edad_max}}</CENTER></td>		
				<td><CENTER>{{$cons->temp_min}} ºC</CENTER></td>
			<td><CENTER>{{$cons->temp_max}} ºC</CENTER></td>
		
			<td><CENTER>{{$cons->cantidad}} Kg.</CENTER></td>
			<td><CENTER>{{$cons->tipo}}</CENTER></td>
			<td><CENTER>
			<button onclick="eliminar_control({{$cons->id}})" class="btn btn-danger">ELIMINAR</button>
			</CENTER></td>
		</tr>
		@endforeach 
	</table>
</div>
  {!!Html::script('js/control_alimento.js')!!} 
  <script src="{{asset('js/bootstrap-select.min.js')}}"></script> 
@endsection

 