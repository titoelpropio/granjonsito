@extends ('layouts.admin')
@section ('content')
@include('alerts.cargando')
<div id="alert" class="hidden" ></div>
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
@include('galpon.modal')
<div class="row">   
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">  
        <div class="pull-left"><H1>LISTA DE GALPONES</H1></div>
        <div class="pull-right"><button class='btn btn-success' data-toggle='modal' data-target='#myModalcreate'>AGREGAR</button></div>
            <table class="table table-striped table-bordered table-condensed table-hover" id="tablacategoria">
                <thead style="background: black; color: white">
                <th><center>NUMERO</center></th>
                <th ><center>CAPACIDAD TOTAL</center></th>
                <th><center>OPCION</center></th>
                </thead>

                <tbody id="datos">
                </tbody>
            </table>
 
        </div>
    </div>
</div>
{!!Html::script('js/galpon.js')!!} 
@endsection
