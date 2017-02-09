@extends('layouts.admin')
@section('content')
@include('alerts.request')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <H3>ACTUALIZAR SILO</H3><br>
	{!!Form::model($silo,['route'=> ['silo.update',$silo->id],'method'=>'PUT'])!!}
	@include('silos.forms.silupdate')
	{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary'])!!}
	
	{!!Form::close()!!}


	</div>
</div>
@stop