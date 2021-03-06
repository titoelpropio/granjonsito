@extends ('layouts.admin')
@section ('content')

<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!--div class="table-responsive"--> 
    <div class="panel panel-green">
        <div class="panel-heading">
              <ul class="nav nav-pills">
                <li class="active"><a href="{!!URL::to('lista_maple')!!}">LISTA DE HUEVOS DESCARTES</a></li>
                <li class="active"><a href="{!!URL::to('comparar_maples')!!}">COMPARAR HUEVOS DESCARTES</a></li>                    
            </ul>
        </div>   
    </div>
</div>

<div class="pull-left">    <font size="6">LISTA DE HUEVOS DESCARTES </font> <font size="6" id="fecha"> </font></div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right" >

    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 13%; margin: 0px; padding: 0px">
      <div class="form-group"> <button class="btn btn-danger" onclick=" cargar_lista_maple()">MOSTRAR</button> </div>
    </div>

    <div class="col-sm-3  col-md-3  col-sm-3  col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
      <div class="form-group">
        <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" id="fecha_fin" style="font-size:20px;text-align:center" />
          <span class="input-group-addon ">
             <span class="fa fa-calendar" aria-hidden="true"></span> 
          </span>
        </div>
      </div>
    </div>


    <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="margin: 0px; padding: 0px">
      <div class="form-group"> <B>HASTA: </B> </div>
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
      <div class="form-group">  <B>DESDE: </B> </div>
    </div>
</div>

<table  class="table-striped table-bordered table-condensed table-hover" style="width: 100%">
    <thead bgcolor=black style="color: white">
        <th><center>TIPO DE CAJA</center></th>
        <th><center>CANTIDAD DE MAPLES</center></th>
        <th><center>CANTIDAD DE HUEVOS</center></th>
        <th><center>FECHA</center></th>
    </thead>
    <tbody id="datos_c1">
    </tbody>
</table>




{!!Html::script('js/caja.js')!!} 
@endsection

