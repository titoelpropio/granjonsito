
	<div class="form-group">
		{!!Form::label('email','USUARIO:')!!}
		{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingrese el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('password','CONTRASEÑA:')!!}
		{!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese La Contraseña'])!!}
	</div>