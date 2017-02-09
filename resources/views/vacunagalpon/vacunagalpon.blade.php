@extends('layouts.admin')
@section('content')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
</div>
@endif


<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><b>LISTA DE GALPONES A VACUNAR </b></h3>
                </div>

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead  bgcolor=black style="color: white">

                    <th><center>GALPONES</center></th>
                    <th><center>EDAD DEL GALPON</center></th>
                    <th><center>VACUNA</center></th>
                    <th><center>METODO DE APLICACION</center></th>
                    <th><center>OPERACION</center></th>

                    </thead>

                    @foreach ($vacuna as $vac)
                    <TR>		

                        <td><center>{{$vac->galpon}}</center></td>
                    <td><center>{{$vac->edad}}</center></td>
                    <td><center>{{$vac->nombre}}</center></td>
                    <td><center>{{$vac->detalle}}</center></td>

                    <td><center>

                        <input type="button" id=""  value="vacunar" class="btn primary btn-google" data-toggle='modal' data-target='#myModal' onclick="darvalorinput({{$vac->idgalpon}},{{$vac->idvacuna}},'{{$vac->galpon}}','{{$vac->nombre}}')">
                    </center></td>
                    </TR>
                    @endforeach 
                </table>

            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/addvacunagalpon.js')}}"></script> 
@endsection




