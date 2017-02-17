@extends ('layouts.admin')
@section ('content') 
@include('alerts.success')
@include('alerts.request')
@include('maple.modal')
@include('alerts.cargando')
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">	
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	

			<div class="pull-left"><H1>TIPOS DE MAPLES</H1></div>
			<div class="pull-right"><button class='btn btn-success' data-toggle='modal' data-target='#myModal' >AGREGAR</button>  </div>
			
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead bgcolor=black style="color: white" align="center">
						<td>TIPO DE MAPLE</td>
						<td>CANTIDAD DE HUEVO</td>
						<td>OPCIONES</td>
					</thead>
					@foreach($maple as $map)
					<tr align="center">
						<td>{{ $map->tamano}}</td>
						<td>{{ $map->cantidad}}</td>
						<td>{!!link_to_route('maple.edit', $title = 'ACTUALIZAR', $parameters = $map->id, $attributes = ['class'=>'btn btn-primary','style'=>'color:white'])!!}
<button class="btn btn-danger" onclick="eliminar_maple({{$map->id}})">ELIMINAR</button>
						</td>
					</tr>
					@endforeach
				</table>
	{!!$maple->render()!!}
		</div>
		</div>
	</div>
   {!!Html::script('js/maple.js')!!} 
       
@endsection
