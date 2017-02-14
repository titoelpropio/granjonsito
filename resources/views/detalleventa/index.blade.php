@extends ('layouts.admin')
@section ('content')
@include('alerts.cargando')
<div class="pull-left"><h1><b>VENTA DE CAJAS</b></h1></div>
<br><br><br>
{!!Form::open(array('url'=>'ventacaja','method'=>'POST','autocomplete'=>'off'))!!}
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
            <label>TIPO DE CAJA:</label>
            <select name="id_tipo_caja" class="form-control selectpicker" id="id_tipo_caja" data-live-search="true">
             <option value="0">SELECCIONE UN TIPO DE CAJA</option>
                @foreach($caja_deposito as $tc)
                <option value="{{$tc->id_tipo_caja}}">{{$tc->tipo}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-xs-12" >
        <div class="form-group" >
            <label>CANTIDAD DE CAJA:</label><br>
            <input type="text" size="3" name="cantidad_caja" onkeypress="return bloqueo_de_punto(event)" style="font-size:20px;text-align:center" id="cantidad_cajas">
            <button id="bt_add" type="button" class="btn btn-success" onclick="agregar()"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
         </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-xs-12" >
        <div class="panel panel-primary" >
            <div class="panel-body" >
                <div class="table-responsive">
                    <table id="detalles_tabla" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">
                            <th><center>OPCION</center></th>
                            <th><center>TIPO DE CAJA</center></th>
                            <th><center>CANTIDAD DE CAJA</center></th>
                            <th><center>PRECIO</center></th>                       
                        </thead>
                    @if(Auth::user()==null)                         
                        <tbody id="detalles" data-status=0> </tbody>
                    @endif 

                    @if(Auth::user()!=null)                         
                        <tbody id="detalles" data-status=1> </tbody>
                    @endif 

                    @if(Auth::user()!=null)                         
                        <tfoot style="background-color: #f1948a">
                            <th><center>TOTAL</center></th>
                            <th></th>
                            <th></th>
                            <th><center><font size="4" id="total">0.00</font><font> Bs.</font></center></th>
                        </tfoot>
                    @endif 
                    </table>
                </div>
        @if(Auth::user()==null) 
            <div class="pull-right"> <input type="hidden" name="precio" id="monto_total" size="5" onkeypress="return numerosmasdecimal(event)"></div>       
        @endif 

        @if(Auth::user()!=null) 
            <div class="pull-right"> <b>MONTO TOTA VENTA: </b><input type="text" name="precio" id="monto_total" size="5" onkeypress="return numerosmasdecimal(event)" style="font-size:20px;text-align:center"><b> Bs.</b> </div>
        @endif 


            </div>
        </div>
    </div>
<input type="hidden" name="estado" value="1">
    <div class="pull-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <button id="guardar" type="submit" class="btn btn-info" onclick="ocultar()"><i class="fa fa-check-square" aria-hidden="true"></i> GUARDAR</button>
        <a href="detalleventa" class="btn btn-danger" id="cancelar"><i class="fa fa-remove" aria-hidden="true"></i> CANCELAR</a>
    </div>

{!!Form::close()!!}

    <div  class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
        @foreach($tipo_caja as $tc)
            <input type="hidden" size="1" value="{{$tc->precio}}" id="precio{{$tc->id}}">
            <input type="hidden" size="1" value="{{$tc->cantidad_maple}}" id="cant_maple{{$tc->id}}">
            <input type="hidden" size="1" value="{{$tc->cantidad}}" id="cant_huevo{{$tc->id}}"><br>        
        @endforeach
    </div>

    <div  class="col-lg-6 col-sm-6 col-md-6 col-xs-12"  >
        @foreach($caja_deposito as $tc)
            <input type="hidden" size="1" value="{{$tc->cantidad_caja}}" id="cant_caja{{$tc->id_tipo_caja}}">
            <input type="hidden" size="1" value="{{$tc->cant_maple}}" id="cant_maple_dep{{$tc->id_tipo_caja}}">        
            <input type="hidden" size="1" value="{{$tc->cantidad_maple}}" id="cant_maple_tipo{{$tc->id_tipo_caja}}"> <br>              
        @endforeach
    </div>

<script src="{{asset('js/detalle_venta.js')}}"></script> 
<script src="{{asset('js/bootstrap-select.min.js')}}"></script> 
@endsection