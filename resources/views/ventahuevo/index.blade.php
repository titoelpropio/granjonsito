@extends ('layouts.admin')
@section ('content')
@include('alerts.success')
@include('alerts.cargando')
 <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	@include('ventahuevo.modal')
		<div class="row">	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">	
			<div class="pull-left"> <h1>LISTA DE VENTAS DE MAPLES</h1> </div>
			<div class="pull-right"> <a href="detalleventahuevo" class="btn btn-success">AGREGAR</a></div>		
			<table class="table table-striped table-bordered table-condensed table-hover">
				<tr align="center" style="background-color: black; color: white">
					<td>FECHA</td>
					<td>SALDO</td>
					<td>OPCION</td>				
				</tr>
				@foreach($venta_huevo as $can)
				<tr align="center">
					<td>{{ $can->fecha}}</td>
					<td>{{ $can->precio}} Bs.</td>
					<td><button id="detalle{{$can->id}}" class="btn btn-primary" data-toggle='modal' data-target='#myModal' onclick="cargartabla_ventahuevo({{$can->id}})"><i class="fa fa-navicon" aria-hidden="true"></i> DETALLE</button> 
					<button id="detalle{{$can->id}}" class="btn btn-danger" data-toggle='modal' data-target='#myModal_anular' onclick="cargartabla_anular_huevo({{$can->id}})"><i class="fa fa-remove" aria-hidden="true"></i> ANULAR VENTA</button> 
					<!--{!!link_to_route('ventahuevo.show', $title = 'ANULAR VENTA', $parameters = $can->id, $attributes = ['class'=>'btn btn-danger'])!!}--></td>						
				</tr>					
				@endforeach
			</table>
			{!!$venta_huevo->render()!!}
			</div>
		</div>
	</div>	
<script src="{{asset('js/ventahuevo.js')}}"></script> 
@endsection
