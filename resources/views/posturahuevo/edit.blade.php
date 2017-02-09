@extends('layouts.admin')
	@section('content')
          {!!Html::script('js/alimentop.js')!!}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')
	{!!Form::model($posturahuevo,['route'=>['posturahuevo.update',$posturahuevo->id],'method'=>'PUT'])!!}
		@include('posturahuevo.forms.posturahuevo')
	{!!Form::submit('Actializar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}

	{!!Form::open(['route'=>['posturahuevo.destroy',$posturahuevo->id],'method'=>'DELETE'])!!}
	{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	</div>
</div>
@endsection