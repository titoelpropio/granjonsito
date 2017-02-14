@extends('layouts.admin')
@section('content')
@if(Session::has('message'))
@include('alerts.cargando')
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
</div>
@endif
@include('vacunagalpon.modal')
<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="{!!URL::to('vacuna')!!}">LISTA DE VACUNAS</a></li>
                        <li class="active"><a href="{!!URL::to('vacunagalpon')!!}">LISTA DE GALPON A VACUNAR</a></li>
                    </ul>
                </div><br>
                <h2>LISTA DE GALONES VACUNADOS</h2>
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead  bgcolor=black style="color: white">

                    <th><center>GALPON</center></th>
                    <th><center>VACUNA</center></th>
                    <th><center>FECHA</center></th>
                    <th><center>OPCION</center></th>
                    </thead>

                    @foreach ($vacunagalpon as $vacgal)
                    <TR>			
                    <td align="center">{{$vacgal->galpon }}</td>
                    <td align="center">>{{$vacgal->vacuna}}</td>
                    <td align="center">{{$vacgal->fecha}}</td>

                    <td align="center">
                        {!!link_to_route('vacuna.edit', $title = 'Editar', $parameters = $vacgal->id, $attributes = ['class'=>'btn btn-primary'])!!}</td>
                    </TR>
                    @endforeach 
                </table>

            </div>
        </div>
    </div>
</div>
@endsection




