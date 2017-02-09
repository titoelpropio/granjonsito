@extends('layouts.admin')
@section('content')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
<div class="row">	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<H1>TRABAJADORES</H1>
		<table class="table table-striped table-bordered table-condensed table-hover">
		<thead>
		<th><CENTER>ID</CENTER></th>
		<th><CENTER>NOMBRE</CENTER></th>
		<th><CENTER>APELLIDOS</CENTER></th>
		<th><CENTER>CARGO</CENTER></th>
		<th><CENTER>ACCESO</CENTER></th>
		<th><CENTER>NICK</CENTER></th>
		<th><CENTER>CONTRASEÑA</CENTER></th>
		<th><CENTER>OPCION</CENTER></th>
		</thead>
		 @foreach ($trabajador as $tra)
			<TR>
			<td><CENTER>{{$tra->id}}</CENTER></td>
			<td><CENTER>{{$tra->nombre}}</CENTER></td>
			<td><CENTER>{{$tra->apellidos}}</CENTER></td>
			<td><CENTER>{{$tra->cargo}}</CENTER></td>
			<td><CENTER>{{$tra->acceso}}</CENTER></td>
			<td><CENTER>{{$tra->nick}}</CENTER></td>
			<td><CENTER>{{$tra->pass}}</CENTER></td>
			<td><CENTER>
			{!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $tra, $attributes = ['class'=>'btn btn-primary'])!!}
			</CENTER></td>
		</TR>
		@endforeach 
		</table>
	{!!$trabajador->render()!!}
	</div>
</div>
</div>

{!!$trabajador->render()!!}
@stop