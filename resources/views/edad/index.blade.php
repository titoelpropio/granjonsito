@extends ('layouts.admin')
@section ('content')
@include('alerts.cargando')

<div id="alert" class="hidden" ></div>
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
@include('edad.modal')
<div class="row">	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">	
            <div class="pull-left"><H1>EDAD</H1></div>
            <div class="pull-right"><button class='btn btn-success' data-toggle='modal' data-target='#myModalcreate' onclick="cargarselect()">AGREGAR</button></div> 

            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead bgcolor=black style="color: white">
                <th><center>GALPON</center></th>	
                <th><center>FASE</center></th>
                <th><center>EDAD</center></th>
                <th><center>INGRESO</center></th>
                <th><center>CANTIDAD INICIAL</center></th>
                <th><center>CANTIDAD ACTUAL</center></th>                                				
                <th><center>MUERTAS</center></th>  
                <th><center>OPCION</center></th>
                </thead>

                <tbody id="datos">
                </tbody>
            </table>
        </div>
    </div>
</div>

{!!Html::script('js/edad.js')!!}
{!!Html::script('js/control_vacuna.js')!!}

@endsection