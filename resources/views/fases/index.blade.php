@extends ('layouts.admin')
@section ('content')
@include('alerts.success')
@include('alerts.request')
@include('alerts.cargando')

	@include('fases.modal')
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
			<div class="pull-left"><H1>FASES</H1></div>
            <div class="pull-right"><button class='btn btn-success' data-toggle='modal' data-target='#myModal'>AGREGAR</button></div>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead bgcolor=black style="color: white">
						<th><center>NUMERO</center></th>
						<th><center>NOMBRE</center></th>
						<th><center>OPCION</center></th>
					</thead>
					@foreach($fases as $egr)
					<tr>
						<td><center>{{ $egr->numero}}</center></td>
						<td><center>{{ $egr->nombre}}</center></td>
						<td><CENTER>
						{!!link_to_route('fases.edit', $title = 'ACTUALIZAR', $parameters = $egr->id, $attributes = ['class'=>'btn btn-primary'])!!}
						</CENTER></td>
					</tr>
					@endforeach
				</table>
	{!!$fases->render()!!}
			</div>

		</div>
	</div>
  {!!Html::script('js/fases.js')!!} 
@endsection
