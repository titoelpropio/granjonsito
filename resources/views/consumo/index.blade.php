@extends ('layouts.admin')
@section ('content')
@include('alerts.errors')
@include('alerts.cargando')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
</div>
@endif


@include('consumo.modal')
<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">	
            <div class="pull-left"><H1>CONSUMO DE GALPONES</H1></div>
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead bgcolor=black style="color: white">
                <th><center>GALPON</center></th>
                <th><center>FASE</center></th>
                <th><center>SILO</center></th>
                <th><center>CANTIDAD</center></th>
                <th><center>FECHA</center></th>
                <th><center>OPCION</center></th>
                </thead>
                <tbody>
                    @foreach($consumo as $cons)
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
                @endforeach
            </table>

        </div>

    </div>
</div>
{!!Html::script('js/consumo.js')!!} 
@endsection
