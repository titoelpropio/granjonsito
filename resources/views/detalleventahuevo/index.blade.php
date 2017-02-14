@extends ('layouts.admin')
@section ('content')
@include('alerts.cargando')
<div class="pull-left"><h1><b>VENTA DE HUEVOS DESCARTES</b></h1></div>
<br><br><br>
{!!Form::open(array('url'=>'ventahuevo','method'=>'POST','autocomplete'=>'off'))!!}
 {{Form::token()}} 

    <div class="col-lg-2 col-sm-2 col-xs-12" >
        <div class="form-group">
            <label>FECHA: </label>
            <div class='input-group date' id='datetimepicker10'>
              <input type='text' class="form-control" id="fecha" name="fecha" style="font-size:20px;text-align:left" />
              <span class="input-group-addon ">
                 <span class="fa fa-calendar" aria-hidden="true"></span>  <!--span class="glyphicon glyphicon-calendar"></span-->
              </span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-xs-12" >
        <div class="form-group" >
            <label>TIPO DE MAPLE:</label>
            <select name="id_tipo_huevo" class="form-control selectpicker" id="id_tipo_huevo" data-live-search="true">
             <option value="0">SELECCIONE UN TIPO DE MAPLE</option>
                @foreach($huevo_deposito as $tc)
                <option value="{{$tc->id_tipo_huevo}}">{{$tc->tipo}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-xs-12" >
        <div class="form-group" >
            <label>CANTIDAD DE MAPLE:</label><br>
            <input type="text" size="3" onkeypress="return bloqueo_de_punto(event)" style="font-size: 20px; text-align:center" id="cantidad_maples">
            <button id="bt_add" type="button" class="btn btn-success" onclick="agregar_maple()"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
         </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-xs-12" >
        <div class="panel panel-primary" >
            <div class="panel-body" >
                <div class="table-responsive">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">
                            <th><center>OPCION</center></th>
                            <th><center>TIPO DE MAPLE</center></th>
                            <th><center>CANTIDAD DE MAPLE</center></th>
                            <th><center>PRECIO</center></th>                       
                        </thead>

                        <tbody id="detalles">
                        </tbody>
                        <tfoot style="background-color: #f1948a">
                            <th><center>TOTAL</center></th>
                            <th></th>
                            <th></th>
                            <th><center><font size="4" id="total">0.00</font><font> Bs.</font></center></th>
                        </tfoot>
                    </table>
                </div>
                <div class="pull-right">
                <b>MONTO TOTA VENTA: </b><input name="precio" type="text" id="monto_total" size="5" onkeypress="return numerosmasdecimal(event)" style="font-size:20px;text-align:center"><b> Bs.</b></div>
            </div>
        </div>
    </div>
<input type="hidden" name="estado" value="1">
    <div class="pull-right">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <button id="guardar" type="submit" class="btn btn-info" onclick="ocultar()"><i class="fa fa-check-square" aria-hidden="true"></i> GUARDAR</button>
        <a href="detalleventahuevo" class="btn btn-danger" id="cancelar"><i class="fa fa-remove" aria-hidden="true"></i> CANCELAR</a>
    </div>
{!!Form::close()!!}


    <div id="" class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar" >
        @foreach($tipo_huevo as $tc)
            <input type="hidden" size="1" value="{{$tc->precio}}" id="precio{{$tc->id}}">
            <input type="hidden" size="1" value="{{$tc->cantidad}}" id="cant_huevo{{$tc->id}}"><br>        
        @endforeach
    </div>

    <div id="" class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar" >
        @foreach($huevo_deposito as $tc)
            <input type="hidden" size="1" value="{{$tc->cantidad_maple}}" id="cant_maple{{$tc->id_tipo_huevo}}">  
            <input type="hidden" size="1" value="{{$tc->cantidad_huevo}}" id="cant_huevo_tipo{{$tc->id_tipo_huevo}}"> <br>              
        @endforeach
    </div>

<script src="{{asset('js/detalle_venta_huevo.js')}}"></script> 
<script src="{{asset('js/bootstrap-select.min.js')}}"></script> 
@endsection