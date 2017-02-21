@extends('layouts.admin')
@section('content')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
@include('consumo_vacuna.modal')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-green">
        <div class="panel-heading">
              <ul class="nav nav-pills">
                <li class="active"><a href="{!!URL::to('vacuna')!!}">REGISTRAR VACUNAS</a></li>
                <li class="active"><a href="{!!URL::to('lista_control_vacuna')!!}">LISTA DE CONTROL DE VACUNAS</a></li>    
                <li class="active"><a href="{!!URL::to('vacuna_emergente')!!}">LISTA DE VACUNAS EMERGENTES</a></li>                    
                <li class="active"><a href="{!!URL::to('consumo_vacuna_emergente')!!}">LISTA CONSUMO VACUNAS</a></li> 
            </ul>
        </div> 
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
           

<div class="pull-left"> <font size="6">CONSUMO DE VACUNAS </font>   <font size="6" id="xxx"> </font> </div>

<div class="pull-right"><button class="btn btn-danger" onclick="mostrar_consumo_vacunas()">MOSTRAR</button></div> 
<div class="pull-right">{!!Form::select('id_galponcv',[],null,['id'=>'id_galponcv'])!!} </div>   

    <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead bgcolor=black style="color: white">
        <th><center>EDAD</center></th>
        <th><center>VACUNA</center></th>
        <th><center>METODO DE APLICACION</center></th>
        <th><center>CANTIDAD</center></th>
        <th><center>PRECIO</center></th>
        <th><center>OPCION</center></th>        
        </thead>

        <tbody id="datos_vac_con">
            
        </tbody>
    </table>

  </div>
</div>
<script src="{{asset('js/consumo_vacuna.js')}}"></script> 
@endsection

