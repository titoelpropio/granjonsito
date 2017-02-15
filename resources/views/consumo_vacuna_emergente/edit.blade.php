@extends('layouts.admin')
@section('content')
@include('alerts.request')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

	{!!Form::model($consumo,['route'=>['consumo.update',$consumo->id],'method'=>'PUT'])!!}
		@include('consumo.forms.comp')
	{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	
	{!!Form::close()!!}


	</div>
</div>
<div class="row">
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
{!!Form::open(['route'=>['consumo.destroy',$consumo->id], 'method'=>'DELETE'])!!}

{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
	</div>
	
	
	

</div>
@stop

