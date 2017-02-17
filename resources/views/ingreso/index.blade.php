@extends ('layouts.admin')
@section ('content')
@include('alerts.success')
@include('alerts.request')
@include('alerts.cargando')
@include('ingreso.modal')
<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">

			<div class="pull-left"><H1>INGRESO</H1></div>
            <div class="pull-right"><button class='btn btn-success' data-toggle='modal' data-target='#myModal' >AGREGAR</button>  </div>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead bgcolor=black style="color: white">
						<th><center>DETALLE</center></th>						
						<th><center>PRECIO</center></th>
						<th><center>FECHA</center></th>
						<th><center>OPCION</center></th>
					</thead>
					@foreach($ingreso as $ingr)
					<tr>
						<td><center>{{ $ingr->detalle}}</center></td>						
						<td><center>{{ $ingr->precio}} Bs.</center></td>						
						<td><center>{{ $ingr->fecha}}</center></td>
						<td><CENTER>
						{!!link_to_route('ingreso.edit', $title = 'ACTUALIZAR', $parameters = $ingr->id, $attributes = ['class'=>'btn btn-primary'])!!}
						</CENTER></td>
					</tr>
					@endforeach
				</table>
	{!!$ingreso->render()!!}
			</div>

		</div>
	</div>
  {!!Html::script('js/ingreso.js')!!} 
@endsection
