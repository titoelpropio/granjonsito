@extends('layouts.admin')
	@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')

	{!!Form::model($alimento,['route'=>['alimento.update',$alimento->id],'method'=>'PUT'])!!}
		@include('alimento.forms.alimento')
	{!!Form::submit('Actializar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}

	{!!Form::open(['route'=>['alimento.destroy',$alimento->id],'method'=>'DELETE'])!!}
	{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	</div>
</div>
@endsection