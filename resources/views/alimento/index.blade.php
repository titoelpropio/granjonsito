@extends ('layouts.admin')
@section ('content')
@include('alerts.success')
@include('alerts.request')
@include('alerts.cargando')
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	@include('alimento.modal')
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
			<div class="pull-left"><H1>ALIMENTO</H1></div>
            <div class="pull-right"><button class='btn btn-success' data-toggle='modal' data-target='#myModal' >AGREGAR</button>  </div>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead bgcolor=black style="color: white">
						<th><center>NOMBRE</center></th>
						<th><center>TIPO DE GRANO</center></th>
						<th><center>TIPO DE GALLINA</center></th>
						<th><center>OPCION</center></th>
					</thead>
					@foreach($alimento as $ali)
					<tr align="center">
						<td>{{ $ali->nombre }}</td>
						<td>{{ $ali->tipo }}</td>
						<td><?php  if ($ali->tipo_gallina==0){echo "CRIA";}
						if ($ali->tipo_gallina==1) {echo "PONEDORA";}
						if ($ali->tipo_gallina==2) {echo "AMBAS";} ?> </td>
						<td>
						{!!link_to_route('alimento.edit', $title = 'ACTUALIZAR', $parameters = $ali->id, $attributes = ['class'=>'btn btn-primary'])!!}
						<?php 
		                if ($ali->estado == 1) {
		                    echo '<button value="'.$ali->id.'" id="btnestado" onclick="estado_alimento(0,this)" class="btn btn-success">ACTIVO</button>';
		                } else{
		                    echo '<button value="'.$ali->id.'" id="btnestado" onclick="estado_alimento(1,this)" class="btn btn-warning">INACTIVO</button>';
		                }
						?>	</td>
					</tr>
					@endforeach
				</table>
	{!!$alimento->render()!!}
			</div>

		</div>
	</div>
<script src="{{asset('js/addalimento.js')}}"></script> 
@endsection
