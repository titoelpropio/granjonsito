@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Galpon</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>
						{{$error}}
					</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'galpon/galpon','method'=>'POST','autocomplete'=>'off'))!!}
			
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" placeholder="Nombre">
			</div>
			<div class="form-group">
				<label for="capacidad_total">Capacidad Total</label>
				<input type="text" name="capacidad_total" class="form-control" placeholder="Capacidad Total">
			</div>
			<div class="form-group">
				<label for="cantidad_inicial">Cantidad Inicial</label>
				<input type="text" name="cantidad_inicial" class="form-control" placeholder="Cantidad Inicial">
			</div>
			<div class="form-group">
				<label for="cantidad_total">Cantidad Total</label>
				<input type="text" name="cantidad_total" class="form-control" placeholder="Cantidad Total">
			</div>
			<div class="form-group">
				<label for="consumo">Consumo</label>
				<input type="text" name="consumo" class="form-control" placeholder="Consumo">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
