@extends('layouts.admin')
	@section('content')
	@include('alerts.request')

		{!!Form::model($user,['route'=>['usuario.update',$user],'method'=>'DELETE'])!!}
					@include('usuario.forms.usr')
			{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
		{!!Form::close()!!}
	@endsection