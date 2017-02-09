	<div class="form-group">
		{!!Form::label('detalle','Detalle:')!!}
		{!!Form::text('detalle',null,['class'=>'form-control','placeholder'=>'Ingresa el detalle'])!!}
	</div>

	<div class="form-group">
		{!!Form::label('cantidad','Cantidad:')!!}
		{!!Form::text('cantidad',null,['class'=>'form-control','placeholder'=>'Ingresa la cantidad del silo'])!!}
	</div>
        <div class="form-group">
		{!!Form::label('id_trabajador','alimento:')!!}
		{!!Form::select('id_trabajador',$trabajador,null,array('class' => 'form-control input-sm'))!!}
	</div>
	
	<div class="form-group">
		{!!Form::label('id_trabajador','trabajador:')!!}
		{!!Form::select('id_trabajador',$trabajador,null,array('class' => 'form-control input-sm'))!!}
	</div>
	
