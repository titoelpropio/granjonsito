@extends('layouts.admin')
@section('content')
@include('alerts.request')
<div class="row">
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <H1>ACTUALIZAR VACUNA</H1>
		{!!Form::model($vacuna,['route'=> ['vacuna.update',$vacuna->id],'method'=>'PUT'])!!}
			@include('vacuna.forms.vac')
    		<div class="col-lg-3 col-sm-3 col-xs-12" >			
			{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary'])!!}  
			</div>
		{!!Form::close()!!}

		{!!Form::open(['route'=>['vacuna.destroy',$vacuna->id],'method'=>'DELETE'])!!}
		    <div class="col-lg-3 col-sm-3 col-xs-12" >
			{!!Form::submit('ELIMINAR',['class'=>'btn btn-danger'])!!}
			</div>
		{!!Form::close()!!}
	</div>
</div>
@stop