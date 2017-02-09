@extends('layouts.admin')
@section('content')
 
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')
{!!Form::open(['route'=>'alimento.store', 'method'=>'POST'])!!}	
	  @include('alimento.forms.alimento')
      <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
	 {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::reset('Cancelar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	</div>
</div>
 
	@endsection