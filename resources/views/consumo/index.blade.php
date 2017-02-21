@extends ('layouts.admin')
@section ('content')
@include('alerts.errors')
@include('alerts.cargando')
@include('alerts.request')

@include('consumo.modal')

<div class="pull-left"><h1>CONSUMO DE ALIMENTO</h1></div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">

    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 15%; margin: 0px; padding: 0px">
      <div class="form-group"> <button class="btn btn-danger" onclick="cargar_lista_consumo()">MOSTRAR</button> </div>
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
            <!--div class="pull-left"><H1>CONSUMO DE GALPONES</H1></div-->
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead bgcolor=black style="color: white">
                <th><center>GALPON</center></th>
                <th><center>FASE</center></th>
                <th><center>ALIMENTO</center></th>
                <th><center>CANTIDAD</center></th>
                <th><center>FECHA</center></th>
                <th><center>OPCION</center></th>
                </thead>
                <tbody id="datos_con"></tbody>
                    <?php /* @foreach($consumo as $cons)
                    <tr>
                        <td><center>GALPON {{ $cons->numero_galpon}}</center></td>
                        <td><center>{{ $cons->nombre}}</center></td>
                        <td><center>{{ $cons->nombre_silo}}</center></td>
                        <td><center>{{ $cons->cantidad}} kg.</center></td>
                        <td><center>{{ $cons->fecha}}</center></td>
                        <td><CENTER>
                    <button class="btn btn-primary"  data-toggle='modal' data-target='#myModal'  onclick="editar_consumo({{$cons->id}})">ACTUALIZAR</button>
                </CENTER></td>
                </tr>
                @endforeach*/?>
            </table>

        </div>
    </div>
{!!Html::script('js/consumo.js')!!} 
@endsection
