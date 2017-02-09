@extends('layouts.admin')
@section('content')
@include('alerts.request')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	{!!Form::open(['route'=>'vacuna.store', 'method'=>'POST'])!!}
		@include('vacuna.forms.vac')
	{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::reset('Cancelar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	</div>
</div>
	@endsection