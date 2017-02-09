@extends ('layouts.admin')
@section ('content')

<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-green">
        <div class="panel-heading">
            <ul class="nav nav-pills">
                <li class="active"><a href="{!!URL::to('reportecajadiario')!!}">VENTA DE CAJAS POR DIA</a></li>
                <li class="active"><a href="{!!URL::to('reportecaja')!!}">VENTA DE CAJAS</a></li>
            </ul>
        </div>  
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="pull-left"> <font size="5">VENTA DE CAJAS </font> <font size="5" id="fecha"> </font> </div>

    <div class="pull-right"> 
        <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 15%; margin: 0px; padding: 0px">
          <button id="btnPDF1" class="btn btn-success" onclick="cargar_diario()"><i class="fa fa-file-text" aria-hidden="true"></i> PDF</button>
        </div>

        <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 20%; margin: 0px; padding: 0px">
          <div class="form-group"> <button class="btn btn-danger" onclick="Cargar_reporte_caja_diario()">MOSTRAR</button>   </div>    
        </div>


        <div class="col-sm-4  col-md-4  col-sm-4 col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
          <div class="form-group">
            <div class='input-group date' id='datetimepicker2'>
              <input type='text' class="form-control" id="fecha_inicio" style="font-size:20px" />
              <span class="input-group-addon ">
                 <span class="fa fa-calendar" aria-hidden="true"></span> 
              </span>
            </div>
          </div>
        </div>

        <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="margin: 10px; padding: 0px">
          <div class="form-group">  <B>FECHA: </B> </div>
        </div>
     </div>
    <!--font size="6">VENTA DE CAJAS </font> <font size="6" id="fecha"> </font>
    <div class="pull-right"> <B>FECHA: </B>
    <font size=4><input type="date" id="fecha_inicio"> </font>
    <button class="btn btn-danger" onclick="Cargar_reporte_caja_diario()">MOSTRAR</button> <button id="btnPDF1" class="btn btn-success" onclick="cargar_diario()"><i class="fa fa-file-text" aria-hidden="true"></i> PDF</button> </div-->

    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead bgcolor=black style="color: white">
            <th><center>TIPO DE CAJA</center></th>
            <th><center>CANTIDAD DE CAJAS</center></th>
            <th><center>SALDO</center></th>
        </thead>
        <tbody id="datos_rcd">
        </tbody>
    </table>            
</div>
    
{!!Html::script('js/caja.js')!!} 
@endsection
