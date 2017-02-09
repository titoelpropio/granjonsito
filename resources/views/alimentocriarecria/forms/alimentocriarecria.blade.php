<div class="form-group">
		{!!Form::label('cantidad','Cantidad:')!!}
		{!!Form::text('cantidad',null,['class'=>'form-control','placeholder'=>'Cantidad'])!!}
	</div>
<!--?php
$fecha = date("d/m/Y");
?> 
	<div class="form-group">
		{!!Form::label('$fecha','Fecha:')!!}
		{!!Form::text('fecha',null,['class'=>'form-control'])!!}
	</div-->
	<div class="form-group">
		{!!Form::label('tipo','Tipo:')!!}
		{!!Form::text('tipo',null,['class'=>'form-control','placeholder'=>'Tipo'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('id_galpon','Galpon:')!!}
		{!!Form::select('id_galpon',$posturahuev,null,array('class'=>'form-control'))!!}
	</div>
