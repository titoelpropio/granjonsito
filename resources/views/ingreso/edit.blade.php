@extends('layouts.admin')
	@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')
<H3>ACTUALIZAR INGRESO</H3><br>
	{!!Form::model($ingreso,['route'=>['ingreso.update',$ingreso->id],'method'=>'PUT'])!!}
		@include('ingreso.forms.ingreso')
	{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	</div>
</div>
@endsection