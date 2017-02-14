@extends('layouts.admin')
	@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')
<H3>ACTUALIZAR VENTA</H3><br>
	{!!Form::model($venta_caja,['route'=>['ventacaja.update',$venta_caja->id],'method'=>'PUT'])!!}


<div class="form-group">
    {!!Form::label('fecha','Fecha:')!!}
    {!!Form::text('fecha',null,['id'=>'fecha','class'=>'form-control'])!!}
</div>

	{!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	</div>
</div>
@endsection