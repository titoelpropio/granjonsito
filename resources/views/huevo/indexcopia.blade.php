@extends ('layouts.admin')
@section ('content')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
			<H1>CAJA</H1>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>CANTIDAD</center></th>
						<th><center>TIPO CAJA</center></th>
						<th><center>TOTAL PRECIO</center></th>
						<th><center>FECHA</center></th>
						<th><center>OPCION</center></th>
					</thead>
					@foreach($caja as $caj)
					<tr>
						<td><center>{{ $caj->cantidad}}</center></td>
						<td><center>{{ $caj->id_tipo_caja}}</center></td>
						<td><center>{{ $caj->total}}</center></td>
						<td><center>{{ $caj->fecha}}</center></td>
						<td><CENTER>
						{!!link_to_route('caja.edit', $title = 'Editar', $parameters = $caj->id, $attributes = ['class'=>'btn btn-primary'])!!}
						</CENTER></td>
					</tr>
					@endforeach
				</table>
	{!!$caja->render()!!}
			</div>

		</div>
	</div>

@endsection
