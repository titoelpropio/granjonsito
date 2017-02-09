@extends('layouts.admin')
@section('content')
@include('alerts.request')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	{!!Form::model($vacuna,['route'=> ['vacuna.update',$vacuna->id],'method'=>'PUT'])!!}
	@include('vacuna.forms.vac')
	{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	
	{!!Form::close()!!}


	</div>
</div>
@stop