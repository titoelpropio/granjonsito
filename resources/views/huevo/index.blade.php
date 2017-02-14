@extends ('layouts.admin')
@section ('content')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	{{Session::get('message')}}
</div>
@endif
        <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
			<H1>CAJA</H1>
			<input type="hidden" id="id_tipo">
				<table class="table table-striped table-bordered table-condensed table-hover">
				<tr>
				@foreach($postura as $pos)
					<td><font size=4><span id="postura">TOTAL POSTURA DE HUEVO: {{ $pos->cantidad_total }} </span></font></td>
					<td><font size=4><span id="fecha">FECHA: {{ $pos->fecha }} </span></font></td>
				@endforeach
				</tr>
				</table>

				<table class="table table-striped table-bordered table-condensed table-hover">
					<tr>
					<?php $total=0; $i=0; ?>
					@foreach($caja as $caj)
						<td><center> <font size="3"><b> {{ $caj->tipo}} </b></font></center></td>
					@endforeach
					<TD align=center><SPAN><font size="3"> TOTAL</font></SPAN></TD>
					</tr>

					<tr>
					@foreach($caja as $caj)
						<td style="background-color: {{ $caj->color }}"><center> <input type="text" class="form-control" id="cantidad{{ $caj->id }}"  > </center><br>
						<CENTER>
						<span id="precio{{ $caj->id }}" hidden="true"> {{ $caj->precio }} </span> 				
						<button class='btn btn-danger' id="registrar_caja" onclick="extraer_id_tipo({{ $caj->id }})">REGISTRAR</button>
						</CENTER></td>
					@endforeach	

					@foreach($cant as $can)
						<span id="cant{{ $can->id }}" hidden="true"> {{ $can->cantidad }} </span>
						<?php  $total=$total+ $can->cantidad; ?>	 
					@endforeach					
					<TD align=center><font size="4">{!!Form::label($total,null,['id'=>'total'])!!}</font></TD>
					</tr>
				</table>
<br><br><br><br><br>
			</div>

		</div>
	</div>
  
        {!!Html::script('js/huevo.js')!!} 
@endsection
