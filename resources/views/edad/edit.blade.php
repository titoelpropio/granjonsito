@extends('layouts.admin')
	@section('content')
        {!!Html::script('js/dardebaja.js')!!}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')

	{!!Form::model($edad,['route'=>['edad.update',$edad->id],'method'=>'PUT'])!!}

	
		@include('edad.forms.edad')
	{!!Form::submit('Actializar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}

	{!!Form::open(['route'=>['edad.destroy',$edad->id],'method'=>'DELETE'])!!}
	{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	</div>
</div>
@endsection