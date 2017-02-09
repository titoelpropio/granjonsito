@extends ('layouts.admin')
@section ('content')
@include('alerts.success')
@include('alerts.request')
@include('alerts.cargando')
@include('tipocaja.modal')	
<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">	
		<div class="pull-left"><H1>TIPOS DE CAJAS</H1></div>
		<div class="pull-right">  <button class='btn btn-success' data-toggle='modal' data-target='#myModal' >AGREGAR</button>  </div>
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead bgcolor=black style="color: white">
					<th><center>TIPO DE CAJA</center></th>
					<th><center>MAPLE</center></th>
					<th><center>CANTIDAD DE MAPLE</center></th>
					<th><center>PRECIO UNITARIO</center></th>
					<th><center>COLOR</center></th>
					<th><center>OPCION</center></th>
				</thead>
				@foreach($tipocaja as $tc)
				<tr>
					<td><center>{{ $tc->tipo}}</center></td>												
					<td><center>{{ $tc->tamano}}</center></td>
					<td><center>{{ $tc->cantidad_maple}}</center></td>						
					<td><center>{{ $tc->precio}} Bs.</center></td>						
					<td style="background-color: {{ $tc->color}}"><center>{{ $tc->color}}</center></td>
					<td><CENTER>
					{!!link_to_route('tipocaja.edit', $title = 'ACTUALIZAR', $parameters = $tc->id, $attributes = ['class'=>'btn btn-primary','style'=>'color:white'])!!}
					<?php 
                    if ($tc->estado == 1) {
                        echo '<button value="' . $tc->id . '" id="btnestado" onclick="cambiar_estado(0,this)" class="btn btn-success">ACTIVO</button>';
                    } else{
                        echo '<button value="' . $tc->id . '" id="btnestado" onclick="cambiar_estado(1,this)" class="btn btn-warning">INACTIVO</button>';
                    }
					?></CENTER></td>
				</tr>
				@endforeach
			</table>
	</div>
	</div>
</div>
{!!Html::script('js/tipo_caja.js')!!}        
@endsection
