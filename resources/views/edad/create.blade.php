@extends('layouts.admin')
@section('content')
{!!Html::script('js/edad.js')!!}  
{!!Html::script('js/dardebaja.js')!!}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')
{!!Form::open(['route'=>'edad.store', 'method'=>'POST'])!!}

		@include('edad.forms.edad')
                 <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
                 <div style="float:right">
	 {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::reset('Cancelar',['class'=>'btn btn-danger'])!!}
	</div>
	{!!Form::close()!!}
	</div>
</div>
 
	@endsection