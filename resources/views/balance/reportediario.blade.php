@extends ('layouts.admin')
@section ('content')
@if(Session::has('message'))

<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
</div>
@endif
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
        <div class="row">   
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive"> 
                        <div class="panel panel-green">
                <div class="panel-heading">
                      <ul class="nav nav-pills">
                        <li class="active"><a href="{!!URL::to('tipocaja')!!}">REGISTRO DE CAJA</a></li>
                        <li class="active"><a href="{!!URL::to('reportecaja')!!}">VENTA DE CAJAS</a></li>
                    </ul>
                </div>    
            <B>FECHA: </B>
            <input type="date" id="fecha_inicio"> 
            <button  class="btn btn-danger" onclick="Cargar_reporte_caja_diario()">MOSTRAR</button> <br><br>
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead bgcolor=black style="color: white">
                        <th><center>FECHA</center></th>
                        <th><center>TIPO DE CAJA</center></th>
                        <th><center>CANTIDAD DE CAJAS</center></th>
                        <th><center>SALDO</center></th>
                    </thead>
                    <tbody id="datos_rcd">
                    </tbody>
                </table>            
            </div>
        </div>
    
    </div>
</div>
{!!Html::script('js/caja.js')!!} 
@endsection
