@extends('layouts.admin')
@section('content')
@include('alerts.request')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	{!!Form::model($compra,['route'=> ['compra.update',$compra->id],'method'=>'PUT'])!!}
	@include('compra.forms.comp')
	<div class="form-group">
		
	</div>
	{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	
	{!!Form::close()!!}


	</div>
</div>
<div class="row">
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
{!!Form::open(['route'=>['compra.destroy',$compra->id], 'method'=>'DELETE'])!!}
	
	{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	</div>
</div>
@stop


