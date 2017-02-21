@extends ('layouts.admin')
@section ('content')
@include('alerts.success')
@include('alerts.request')
@include('alerts.cargando')
@include('categoria.modal')
<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">	
		<div class="pull-left"><H1>GASTOS</H1></div>
		<div class="pull-right"> <button class='btn btn-success' data-toggle='modal' data-target='#myModal' >AGREGAR</button>  </div>
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead bgcolor=black style="color: white">
					<th><center>NOMBRE</center></th>
					<th><center>TIPO</center></th>
					<th><center>OPCION</center></th>
				</thead>
				@foreach($categoria as $cat)
				<tr>
					<td><center>{{ $cat->nombre}}</center></td>
					</td><td><center><?php  if ($cat->tipo==0){echo "<font color=red>EGRESO</font>";}
					if ($cat->tipo==1) {echo "INGRESO";} ?> </center></td>
					<td><CENTER>
					{!!link_to_route('categoria.edit', $title = 'ACTUALIZAR', $parameters = $cat->id, $attributes = ['class'=>'btn btn-primary'])!!}
					<button class="btn btn-danger" data-toggle='modal' data-target='#ModalEliminarGastos' onclick="EliminarGastos({{$cat->id}})">ELIMINAR</button>
					</CENTER></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
{!!Html::script('js/categoria.js')!!} 
@endsection
