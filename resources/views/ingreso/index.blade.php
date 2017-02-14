@extends ('layouts.admin')
@section ('content')
@include('alerts.success')
@include('alerts.request')
@include('alerts.cargando')
@include('ingreso.modal')

<div class="pull-left"><h1>LISTA DE INGRESOS</h1></div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 15%; margin: 0px; padding: 0px">
      <div class="form-group"><button class='btn btn-success' data-toggle='modal' data-target='#myModal' >AGREGAR</button> </div>
    </div>

    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 15%; margin: 0px; padding: 0px">
      <div class="form-group"> <button class="btn btn-danger" onclick="cargar_lista_ingreso()">MOSTRAR</button> </div>
    </div>

    <div class="col-sm-3  col-md-3  col-sm-3  col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
      <div class="form-group">
        <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" id="fecha_fin" style="font-size:20px;text-align:center" />
          <span class="input-group-addon ">
             <span class="fa fa-calendar" aria-hidden="true"></span> 
          </span>
        </div>
      </div>
    </div>

    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="margin: 0px; padding: 0px">
      <div class="form-group">  <B>HASTA: </B> </div>
    </div>

    <div class="col-sm-3  col-md-3  col-sm-3  col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
      <div class="form-group">
        <div class='input-group date' id='datetimepicker2'>
          <input type='text' class="form-control" id="fecha_inicio" style="font-size:20px;text-align:center" />
          <span class="input-group-addon ">
             <span class="fa fa-calendar" aria-hidden="true"></span> 
          </span>
        </div>
      </div>
    </div>

    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="margin: 0px; padding: 0px">
      <div class="form-group">  <B>DESDE: </B> </div>
    </div>    
</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">

			<!--div class="pull-left"><H1>INGRESO</H1></div>
            <div class="pull-right"><button class='btn btn-success' data-toggle='modal' data-target='#myModal' >AGREGAR</button>  </div-->
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead bgcolor=black style="color: white">
						<th><center>DETALLE</center></th>						
						<th><center>PRECIO</center></th>
						<th><center>FECHA</center></th>
						<th><center>OPCION</center></th>
					</thead>
					<tbody id="datos" >
			        </tbody>
					<?php /*@foreach($ingreso as $ingr)
					<tr>
						<td><center>{{ $ingr->detalle}}</center></td>						
						<td><center>{{ $ingr->precio}} Bs.</center></td>						
						<td><center>{{ $ingr->fecha}}</center></td>
						<td><CENTER>
						{!!link_to_route('ingreso.edit', $title = 'ACTUALIZAR', $parameters = $ingr->id, $attributes = ['class'=>'btn btn-primary'])!!}
						</CENTER></td>
					</tr>
					@endforeach */?>
				</table>
	<?php /* {!!$ingreso->render()!!}*/ ?>
			</div>

		</div>
  {!!Html::script('js/ingreso.js')!!} 
@endsection
