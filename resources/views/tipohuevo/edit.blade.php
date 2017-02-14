@extends('layouts.admin')
	@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')
<H3>ACTUALIZAR TIPO DE HUEVO</H3><br>
	{!!Form::model($tipohuevo,['route'=>['tipohuevo.update',$tipohuevo->id],'method'=>'PUT'])!!}
		@include('tipohuevo.forms.tipohuevo')
	{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	</div>
</div>
@endsection