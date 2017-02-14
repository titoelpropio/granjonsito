@extends('layouts.admin')
@include('alerts.success')
@section('content')
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
	<div class="pull-left"><h1>USUARIOS</h1></div>
	<div class="pull-right"> {!!link_to_route('usuario.create', $title='AGREGAR',array(), $attributes = ['class'=>'btn btn-success'])!!} </div>
	<table class="table table-striped table-bordered table-condensed table-hover">
		<tr align="center" style="background-color: black; color: white">
			<td>USUARIO</td>
			<td>CONTRASEÑA</td>
			<td>OPCION</td>
		</tr>
		@foreach($users as $user)
			<TR align=center>
				<td>{{$user->email}}</td>
				<td>{{$user->password}}</td>
				<td>
				<button class="btn btn-danger" onclick="eliminar_usuario({{$user->id}})">ELIMINAR</button>
				</td>
			</TR>
		@endforeach
	</table>
	{!!$users->render()!!}
{!!Html::script('js/usuario.js')!!}	
@endsection
 