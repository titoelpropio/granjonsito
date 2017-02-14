@extends ('layouts.admin')
@section ('content')
@include('alerts.success')
@include('alerts.request')
@include('tipohuevo.modal')	
@include('alerts.cargando')
<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">
		<div class="pull-left"><H1>TIPOS DE HUEVOS</H1></div>
		<div class="pull-right"><button class='btn btn-success' data-toggle='modal' data-target='#myModal' >AGREGAR</button> </div> 
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead bgcolor=black style="color:white">
					<th><center>TIPO DE HUEVO</center></th>
					<th><center>MAPLE</center></th>						
					<th><center>CANTIDAD DE HUEVO</center></th>
					<th><center>PRECIO UNITARIO</center></th>
					<th><center>OPCION</center></th>
				</thead>
				@foreach($tipohuevo as $th)
				<tr>
					<td><center>{{ $th->tipo}}</center></td>
					<td><center>{{ $th->tamano}}</center></td>
					<td><center>{{ $th->cantidad}}</center></td>							
					<td><center>{{ $th->precio}} Bs.</center></td>
					<td><CENTER>
					{!!link_to_route('tipohuevo.edit', $title = 'ACTUALIZAR', $parameters = $th->id, $attributes = ['class'=>'btn btn-primary','style'=>'color:white'])!!}
					<?php 
                    if ($th->estado == 1) {
                        echo '<button value="' . $th->id . '" id="btnestado" onclick="cambiar_estado_huevo(0,this)" class="btn btn-success">ACTIVO</button>';
                    } else{
                        echo '<button value="' . $th->id . '" id="btnestado" onclick="cambiar_estado_huevo(1,this)" class="btn btn-warning">INACTIVO</button>';
                    }
					?>
					</CENTER></td>
				</tr>
				@endforeach
			</table>
	</div>
	</div>
</div>
{!!Html::script('js/tipo_huevo.js')!!} 
@endsection
