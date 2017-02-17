@extends('layouts.admin')
@section('content')
@include('alerts.cargando')   
@include('compra.modal')
@include('alerts.success')
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">

<div class="pull-left"><h1>LISTA COMPRA DE ALIMENTO</h1></div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 15%; margin: 0px; padding: 0px">
      <div class="form-group"> <button class="btn btn-danger" onclick="cargar_lista_comra()">MOSTRAR</button> </div>
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
      <div class="form-group">  <B>FECHA: </B> </div>
    </div>
</div>

    <table class="table-striped table-bordered table-condensed table-hover" style="width: 100%">
        <thead bgcolor=black style="color: white">
            <th><center>SILO</center></th>
            <th><center>ALIMENTO</center></th>
            <th><center>TIPO ALIMENTO</center></th>
            <th><center>CANTIDAD DE ALIMENTO</center></th>
            <th><center>SALDO</center></th>
            <th><center>FECHA</center></th>            
            <th><center>OPCION</center></th>            
        </thead>
        <tbody id="datos" >
        </tbody>
    </table>

 {!!Html::script('js/compra.js')!!}  
@endsection

 