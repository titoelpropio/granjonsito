@extends('layouts.admin')
@section('content')
@include('alerts.errors')
@include('alerts.cargando')
@include('controlalimento.modal_rango')
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-green">
        <div class="panel-heading">
              <ul class="nav nav-pills">
                <li class="active"><a href="{!!URL::to('controlalimento')!!}">CONTROL ALIMENTO</a></li>                                      
                <li class="active"><a href="{!!URL::to('rango')!!}">AGREGAR RANGOS</a></li>                  
            </ul>
        </div> 
    </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="pull-left"><H3>RANGO EDAD</H3></div>
            <div class="pull-right"><button class="btn btn-success" data-toggle='modal' data-target='#myModalRangoEdad'>AGREGAR</button></div>
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead bgcolor=black style="color: white">
                    <th><center>EDAD MINIMA</center></th>
                    <th><center>EDAD MAXIMA</center></th>
                    <th><center>OPCION</center></th>
                </thead>
              
                <tbody id="cuerpoEdad">
                    
                </tbody>
            </table>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="pull-left"><H3>RANGO TEMPERATURA</H3></div>
            <div class="pull-right"><button class="btn btn-success" data-toggle='modal' data-target='#myModalRangoTemperatura'>AGREGAR</button></div>
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead bgcolor=black style="color: white">
                    <th><center>TEMPERATURA MINIMA</center></th>
                    <th><center>TEMPERATURA MAXIMA</center></th>
                    <th><center>OPCION</center></th>
                </thead>
              <tbody id="cuerpoTemperatura">
                    
              </tbody>
            </table>
</div>
  {!!Html::script('js/rango.js')!!} 
@endsection

 