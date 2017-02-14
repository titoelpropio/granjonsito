@extends ('layouts.admin')
@section ('content')
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
			<div class="pull-left"><H1>TEMPERATURA</H1></div>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead bgcolor=black style="color: white">
						<th><center>TEMPERATURA</center></th>
						<th><center>OPCION</center></th>
					</thead>
					@foreach($temperatura as $ali)
					<tr align="center">
						<td>{{ $ali->temperatura }}</td>
					
						<td>
						{!!link_to_route('temperatura.edit', $title = 'ACTUALIZAR', $parameters = $ali->id, $attributes = ['class'=>'btn btn-primary'])!!}
						</td>
					</tr>
					@endforeach
				</table>
	{!!$temperatura->render()!!}
			</div>

		</div>
	</div> 
@endsection
