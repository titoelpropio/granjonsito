@extends ('layouts.admin')
@section ('content')

<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-green">
        <div class="panel-heading">
              <ul class="nav nav-pills">
              <li class="active"><a href="{!!URL::to('reporteponedoras')!!}">PONEDORAS</a></li>
                <li class="active"><a href="{!!URL::to('reporteponedoras_fases')!!}">FASES</a></li>
                <li class="active"><a href="{!!URL::to('reporte_comparacion')!!}">COMPARACION PONEDORAS</a></li>
            </ul>
        </div> 
    </div> 
</div> 


<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background-color: #fafafa">

    <div class="pull-left">
        {!!Form::select('id_galpon',[],null,['id'=>'id_galpon'])!!}  
    </div>            
    <div class="pull-left">
        <button class="btn btn-success" onclick="detalle_galpon(0)"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div> 



    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 10%; margin: 18px; padding: 0px">
      <div class="form-group"> <button class="btn btn-danger" onclick=" detalle_galpon(1)">MOSTRAR</button> </div>
    </div>

    <div class="col-sm-3  col-md-3  col-sm-3 col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
    HASTA:
      <div class="form-group">
        <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" id="fecha_fin" style="font-size:14px" />
          <span class="input-group-addon ">
             <span class="fa fa-calendar" aria-hidden="true"></span> 
          </span>
        </div>
      </div>
    </div>


    <div class="col-sm-3 col-md-3 col-sm-3 col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
    DESDE: 
      <div class="form-group">
        <div class='input-group date' id='datetimepicker2'>
          <input type='text' class="form-control" id="fecha_inicio" style="font-size:14px" />
          <span class="input-group-addon ">
             <span class="fa fa-calendar" aria-hidden="true"></span> 
          </span>
        </div>
      </div>
    </div>

    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead bgcolor=black style="color: white">
            <th><center>ETAPA</center></th>
            <th><center>GALPON</center></th>
            <!--th><center>FECHA INICIO</center></th-->
            <th><center>MUERTAS</center></th>
            <th><center>HUEVOS</center></th>
            <th><center>POSTURA</center></th>
        </thead>
        <tbody id="datos_r">
        </tbody>
    </table>
</div> 

<!--TABLA2-->

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background-color: #f2f2f2">

    <div class="pull-left">
        {!!Form::select('id_galpon2',[],null,['id'=>'id_galpon2'])!!}  
    </div>            
    <div class="pull-left">
        <button class="btn btn-success" onclick="detalle_galpon2(0)"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div> 



    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 10%; margin: 18px; padding: 0px">
      <div class="form-group"> <button class="btn btn-danger" onclick=" detalle_galpon2(1)">MOSTRAR</button> </div>
    </div>

    <div class="col-sm-3  col-md-3  col-sm-3 col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
    HASTA:
      <div class="form-group">
        <div class='input-group date' id='datetimepicker3'>
          <input type='text' class="form-control" id="fecha_fin2" style="font-size:14px" />
          <span class="input-group-addon ">
             <span class="fa fa-calendar" aria-hidden="true"></span> 
          </span>
        </div>
      </div>
    </div>


    <div class="col-sm-3 col-md-3 col-sm-3 col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
    DESDE: 
      <div class="form-group">
        <div class='input-group date' id='datetimepicker4'>
          <input type='text' class="form-control" id="fecha_inicio2" style="font-size:14px" />
          <span class="input-group-addon ">
             <span class="fa fa-calendar" aria-hidden="true"></span> 
          </span>
        </div>
      </div>
    </div>

    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead bgcolor=black style="color: white">
            <th><center>ETAPA</center></th>
            <th><center>GALPON</center></th>
            <!--th><center>FECHA INICIO</center></th-->
            <th><center>MUERTAS</center></th>
            <th><center>HUEVOS</center></th>
            <th><center>POSTURA</center></th>
        </thead>
        <tbody id="datos_r2">
        </tbody>
    </table>
</div> 


{!!Html::script('js/galpon.js')!!} 
@endsection

