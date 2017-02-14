@extends('layouts.admin')
@section('content')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
@include('vacuna.modalagregar')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-green">
        <div class="panel-heading">
              <ul class="nav nav-pills">
                <li class="active"><a href="{!!URL::to('vacuna')!!}">REGISTRAR VACUNAS</a></li>
                <li class="active"><a href="{!!URL::to('lista_control_vacuna')!!}">LISTA DE CONTROL DE VACUNAS</a></li>                      
            </ul>
        </div> 
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
 <div class="pull-left"> <h2>VACUNAS </h2> </div>
  <div class="pull-right"> <button class="btn btn-success"  data-toggle='modal' data-target='#ModalCreate'>AGREGAR</button> </div> <br><br>

                <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead bgcolor=black style="color: white">
                    <th><center>VACUNA</center></th>
                    <th><center>EDAD A VACUNAR</center></th>
                    <th><center>METODO DE APLICACION</center></th>
                    <th><center>ESTADO</center></th>
                    <th><center>PRECIO</center></th>
                    <th><center>OPCION</center></th>
                    </thead>

                    @foreach ($vacuna as $vac)
                    <TR>    
                    <td align="center">{{$vac->nombre}}</td>
                    <td align="center">{{$vac->edad}}</td>

                    <td align="left">{{$vac->detalle}}</td>
                    <td align="left">{{$vac->precio}}</td>
                    <td align="center">  <?php
                        if ($vac->estado == 1) {
                            echo '<button value="' . $vac->id . '" id="idbotonnestado" onclick="cambiarestado(0,this)" class="btn btn-success">ACTIVO</button>';
                        } else
                            echo '<button value="' . $vac->id . '" id="idbotonnestado"  onclick="cambiarestado(1,this)" class="btn btn-warning">INACTIVO</button>';
                        ?></center></td>
                    <td align="center">
                        {!!link_to_route('vacuna.edit', $title = 'ACTUALIZAR', $parameters = $vac->id, $attributes = ['class'=>'btn btn-primary','style'=>'color: white'])!!}</td>
                    </TR>
                    @endforeach 
                </table>
                {!!$vacuna->render()!!}
            </div>
    </div>
<script src="{{asset('js/addvacuna.js')}}"></script> 
@endsection




