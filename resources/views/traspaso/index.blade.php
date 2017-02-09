@extends ('layouts.admin')
@section ('content')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h1>TRASPASO</h1><br>

		   {!!Form::hidden('id_g',null,['id'=>'id_g','class'=>'form-control','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		   {!!Form::hidden('id_edad',null,['id'=>'id_edad','class'=>'form-control','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		   {!!Form::hidden('fecha_inicio',null,['id'=>'fecha_inicio','class'=>'form-control','onkeypress'=>'return numerosmasdecimal(event)'])!!}

	      {!!Form::label('id_galpon','Galpon Cria:')!!}
	      {!!Form::select('id_galpon',[],null,['id'=>'galpon_cria'])!!}
			<br>
	      {!!Form::label('id_galpon','Galpon Ponedora:')!!}
	      {!!Form::select('id_galpon',[],null,['id'=>'galpon_ponedora'])!!}
			<br>

	     <div class="form-group">
		    {!!Form::label('edad','Edad:')!!}
		    {!!Form::text('edad',null,['id'=>'edad','class'=>'form-control','onkeypress'=>'return numerosmasdecimal(event)','readonly'])!!}
		</div>

	     <div class="form-group">
		    {!!Form::label('cantidad_inicial','Cantidad Inicial:')!!}
		    {!!Form::text('cantidad_inicial',null,['id'=>'cantidad_inicial','class'=>'form-control','readonly','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>
        <button class="btn btn-primary" onclick="traspaso_edad()">REGISTRAR</button>

	</div>
</div>
  {!!Html::script('js/traspaso.js')!!} 
@endsection
