@extends ('layouts.admin')
@section ('content')
@include('alerts.cargando')
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
  <?php $total=0; $total_caja_dia=0; $total2=0; $total_maple_dia=0;?>
	@include('cajadeposito.login')  
	@include('cajadeposito.modal')
		<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	
 <div class="pull-left"><h1>DEPOSITO DE CAJAS </h1></div> <input type="hidden" id="fecha">
<div class="pull-right"><a href="cajadeposito" class="btn btn-danger">ACTUALIZAR</a></div>
<table class="table table-striped table-bordered table-condensed table-hover"><tr>
	<td><div class="pull-left">
	<button type="submit" class="btn btn-success" data-toggle='modal' data-target='#myModal2' id="conectado"><i class="fa fa-user" aria-hidden="true"></i> ADMINISTRADOR</button></div></td>
	<td><div class="pull-right">@foreach($huevo_acumulado as $aux2)
			<font color="red" size="4">CANTIDAD DE HUEVOS: </font> <input type="text" style="width: 120px; height: 40px; font-size: 30px; text-align: center" readonly="" value="{{$aux2->cantidad}}" id="huevo_acumulado">
	@endforeach	</div></td>
</tr></table>
				 @foreach($caja_deposito as $aux2)
					<input type="hidden" size="1" value="{{$aux2->cantidad_caja}}" id="cantidad_caja_acumulado{{$aux2->id_tipo_caja}}">
					<input type="hidden" size="1" value="{{$aux2->cantidad_maple}}" id="cantidad_maple_acumulado{{$aux2->id_tipo_caja}}">
					<?php $total = $total + $aux2->cantidad_caja; ?>
				@endforeach	

				 @foreach($caja_dia as $aux)
					<input type="hidden" size="1" value="{{$aux->cantidad_caja}}" id="cantidad_caja_dia{{$aux->id_tipo_caja}}">
					<input type="hidden" size="1" value="{{$aux->cantidad_maple}}" id="cantidad_maple_dia{{$aux->id_tipo_caja}}">
					<?php $total_caja_dia = $total_caja_dia + $aux->cantidad_caja; ?>
				@endforeach	

				<table class="table table-striped table-bordered table-condensed table-hover">
				<tr style="background-color: black; color: white" align="center">
				@foreach($tipo_caja as $can)
					<td><center> <font size="3" id="tipo_caja{{$can->id}}"><b> {{ $can->tipo}} </b></font></center></td>
				@endforeach
					<TD><font size="3"> TOTAL CAJAS</font></TD>
				</tr>

				<tr align="center">
				@foreach($tipo_caja as $can)
				  <td style="background-color: {{ $can->color }}">
					<font style=" background-color: white;">Cajas Acumulada:</font>
					<input type="number" style="width:50px;height:30px;font-size:20px;text-align:center" readonly="" id="caja_acumulado{{$can->id}}" onkeypress="return bloqueo_de_punto(event)"> 	
					<input type="hidden" size="1" id="caja_acumulado_aux{{$can->id}}"><br><br>

					<font style=" background-color: white;">Cajas Por Dia:</font>
					<input type="number" style="width:55px;height:30px; font-size:20px;text-align:center" readonly="" id="caja_diario{{$can->id}}" onkeypress="return bloqueo_de_punto(event)">
					<input type="hidden" size="1" id="caja_diario_aux{{$can->id}}"><br><br>
			

					<input type="hidden" size="1" value="{{$can->cantidad_maple}}" id="cant_maple{{$can->id}}">
					<input type="hidden" size="1" value="{{$can->cantidad}}" id="cant_huevo{{$can->id}}">
				  </td>
				@endforeach	
				  <td>CAJAS DEPOSITO <br><font size="6" id="total_caja" ><?php echo $total; ?></font><br>
				  CAJAS POR DIA <br><font size="6" id="total_caja_dia" ><?php echo $total_caja_dia; ?></font></td>		
				</tr> 

				<tr  align="center" style="background-color: black; color: white">
				@foreach($tipo_caja as $can)
					<td><center> <font size="3"><b>SOBRANTE {{ $can->tipo}} </b></font></center></td>
				@endforeach
				</tr>

				<tr align="center">
				@foreach($tipo_caja as $can)
				  <td style="background-color: {{ $can->color }}">
					<font style=" background-color: white;">Cant. De Maples:</font>
					<input type="number" style="width:55px;height:30px;font-size:20px;text-align:center" id="maple_sobrante{{$can->id}}" onkeypress="return bloqueo_de_punto(event)" onkeyup="calcular({{$can->id}})" onclick='extraer_id_sobrante({{$can->id}},2)'><br><br>

					<font style=" background-color: white;">Cant. De Huevos:</font>
					<input type="number" style="width: 55px; height: 30px; font-size: 20px; text-align: center;" id="huevo_sobrante{{$can->id}}" onkeypress="return bloqueo_de_punto(event)" onclick='extraer_id_sobrante({{$can->id}},2)'>
					<!--button class='btn btn-info' onclick="registrar_sobrante({{$can->id}})" id="btnsobrante{{$can->id}}"><b>SOBRANTE</b></button-->
				  </td>
				@endforeach		
				</tr> 
			</table>
				@foreach($sobrante as $aux2)
					<input type="hidden" size="1" value="{{$aux2->cantidad_maple}}" id="cantidad_caja{{$aux2->id_tipo_caja}}">
					<input type="hidden" size="1" value="{{$aux2->cantidad_huevo}}" id="cantidad_huevo{{$aux2->id_tipo_caja}}">
				@endforeach	

			@foreach($huevo as $aux2)
				<input type="hidden" size="1" value="{{$aux2->cantidad_maple}}" id="cantidad_huevo_aux{{$aux2->id_tipo_huevo}}">		<?php $total_maple_dia = $total_maple_dia + $aux2->cantidad_maple; ?>		
			@endforeach	<br>
			@foreach($huevo_deposito as $aux2)
				<input type="hidden" size="1" value="{{$aux2->cantidad_maple}}" id="cantidad_huevo_deposito_aux{{$aux2->id_tipo_huevo}}">
				<?php $total2 = $total2 + $aux2->cantidad_maple; ?>						
			@endforeach	

			<h1>TIPOS DE HUEVOS</h1>
				<table class="table table-striped table-bordered table-condensed table-hover">
				<tr style="background-color: black; color: white" align="center">
				@foreach($tipo_huevo as $can)
					<td><center> <font size="3" id="tipo_huevo{{$can->id}}"><b> {{ $can->tipo}} </b></font></center></td>
				@endforeach
					<TD><font size="3"> TOTAL MAPLES</font></TD>
				</tr>

				<tr align="center" style="background-color: cornsilk">
				@foreach($tipo_huevo as $can)
				  <td>
				  	<font>Maples Acumulado:</font>
				  	<input type="text" style="width:80px;height:30px;font-size:20px;text-align:center" id="cantidad_tipo_huevo_dep{{$can->id}}" readonly="" onkeypress="return bloqueo_de_punto(event)">
				  	<input type="hidden" size="1" id="cantidad_tipo_huevo_dep_aux{{$can->id}}"><br><br>

				  	<font>Maples Por Dia:</font>
				  	<input type="text" style="width:80px;height:30px;font-size:20px;text-align:center" readonly="" id="cantidad_tipo_huevo{{$can->id}}"  onkeypress="return bloqueo_de_punto(event)">
				  	<input type="hidden" size="1" id="cantidad_tipo_huevo_aux{{$can->id}}">
				  	<br><br>
				  				<input type="hidden" size="1" value="{{$can->cantidad}}" id="cant_tipo_huevo{{$can->id}}">
				  </td>
				@endforeach	
				  <td style="background-color: white">MAPLES DEPOSITO <br><font size="6" id="total2"><?php echo $total2; ?></font><br>
				  MAPLES POR DIA <br><font size="6" id="total_maple_dia"><?php echo $total_maple_dia; ?></font></td>			
				</tr> 
			</table>
			</div>
		</div>
	</div>
<script src="{{asset('js/cajadeposito.js')}}"></script> 
@endsection
