@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Listado de Galpones <a href="galpon/create"><button class="btn btn-success">NUEVO</button></a></h3>
		@include('galpon.galpon.search')
		</div>	
	</div>

	<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>Galpon</center></th>
						<th><center>Capacidad Total</center></th>
						<th><center>Cantidad Inicial</center></th>
						<th><center>Cantidad Total</center></th>
						<th><center>Consumo</center></th>
						<th><center>Opcion</center></th>
					</thead>
					@foreach($galpon as $gal)
					<tr>
						<td><center>{{ $gal->nombre}}</center></td>
						<td><center>{{ $gal->capacidad_total}}</center></td>
						<td><center>{{ $gal->cantidad_inicial}}</center></td>
						<td><center>{{ $gal->cantidad_total}}</center></td>	
						<td><center>{{ $gal->consumo}} Kg.</center></td>
						<td>
							<center><a href=""><button class="btn btn-info">Editar</button></a>
							<a href=""><button class="btn btn-danger">Eliminar</button></a></center>
						</td>					
					</tr>
					@endforeach
				</table>
			</div>
			{{$galpon->render()}}
		</div>
	</div>

@endsection