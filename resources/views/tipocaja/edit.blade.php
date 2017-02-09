@extends('layouts.admin')
	@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')
<H3>ACTUALIZAR TIPO DE CAJA</H3><br>
	{!!Form::model($tipocaja,['route'=>['tipocaja.update',$tipocaja->id],'method'=>'PUT'])!!}
		@include('tipocaja.forms.tipocaja')
	{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	</div>
</div>
@endsection