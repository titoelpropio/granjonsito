	<div class="form-group">
		{!!Form::label('nombre','Nombre:')!!}
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('apellidos','Apellidos:')!!}
		{!!Form::text('apellidos',null,['class'=>'form-control','placeholder'=>'Ingresa su apellido del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('cargo','Cargo:')!!}
		{!!Form::text('cargo',null,['class'=>'form-control','placeholder'=>'Ingresa el cargo del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('acceso','Acceso:')!!}
		{!!Form::text('acceso',null,['class'=>'form-control','placeholder'=>'Ingresa el cargo del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('nick','Nick:')!!}
		{!!Form::text('nick',null,['class'=>'form-control','placeholder'=>'Ingresa el cargo del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('pass','Contraseña:')!!}
		{!!Form::password('pass',['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>