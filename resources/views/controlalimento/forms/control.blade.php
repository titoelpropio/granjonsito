<div class="form-group">
		{!!Form::label('id_galpon','Galpon:')!!}
		{!!Form::select('id_galpon',$galpon,null,array('class' => 'form-control input-sm'))!!}
	</div>

	<div class="form-group">
		{!!Form::label('id_silo','Silos:')!!}
		{!!Form::select('id_silo',$silos,null,array('class' => 'form-control input-sm'))!!}
	</div>
	<div class="form-group">
		{!!Form::label('cantidad','Cantidad:')!!}
		{!!Form::text('cantidad',null,['class'=>'form-control','placeholder'=>'Ingresa la cantidad del silo'])!!}
	</div>
		<?php $fecha = date("d/m/Y"); ?>
	<div class="form-group">
		{!!Form::label('fecha','fecha:')!!}
		{!!Form::text('$fecha',$fecha ,['class'=>'form-control','placeholder'=>'Ingresa el id del empleado','disabled'=>'true'])!!}
	</div>
