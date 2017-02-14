@extends ('layouts.admin')
@section ('content')

<div class="pull-left"><h1><b>DETALLE DE VENTA</b></h1></div>


    <div class="pull-right" >
           <h3>FECHA: {{$venta_caja->fecha}}</h3><br><br>
           <input type="hidden" name="fecha" id="fecha" value="{{$venta_caja->fecha}}">
    </div>

    <div class="col-lg-12 col-sm-12 col-xs-12" >
        <div class="panel panel-primary" >
            <div class="panel-body" >
                <div class="table-responsive">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">                    
                            <th><center>TIPO DE CAJA</center></th>
                            <th><center>CANTIDAD DE CAJA</center></th>
                            <th><center>SALDO</center></th>                       
                        </thead>

                        <tbody>
                        	@foreach($detalle as $det)
                        	<tr align="center" id="fila{{$det->id_tipo_caja}}">
                        		<td>{{$det->tipo}} <input type="text" name="id_tipo_caja[]" value="{{$det->id_tipo_caja}}"> 
                                <input type="text" name="id[]" value="{{$det->id}}"></td>                        		
                        		<td><input readonly="" style="width:100px;height:30px;font-size:20px;text-align:center" name="cantidad_caja[]" type="text" value="{{$det->cantidad_caja}}">
                                <span id="cantidad_caja{{$det->id_tipo_caja}}">{{$det->cantidad_caja}}</span></td>
                        		<td><input readonly="" style="width:100px;height:30px;font-size:20px;text-align:center" name="subtotal_precio[]" type="text" value="{{$det->subtotal_precio}}"> Bs.{{$det->subtotal_precio}}</td>
                        	</tr>
                        	@endforeach
                        </tbody>
                        <tr align="center" style="background-color: #f1948a">
                        	<td>MONTO TOTAL</td>
                        	<td></td>                           	               
                            <td><font size="4" name="precio" id="total">{{$venta_caja->precio}}</font></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="pull-right"> 
    <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
	<button class="btn btn-primary" onclick="anular_venta({{$venta_caja->id}})" id="anular">ANULAR VENTA</button> 
	<a href="{!!URL::to('ventacaja')!!}" class="btn btn-danger" id="cancelar">CANCELAR</a>
</div>


<div class="col-lg-12 col-sm-12 col-xs-12" >
	@foreach($tipo_caja as $det)
		<input type="hidden" size="1" value="{{$det->cantidad_maple}}" id="cant_maple{{$det->id}}">
		<input type="hidden" size="1" value="{{$det->cantidad}}" id="cant_huevo{{$det->id}}">	<br>	
	@endforeach
</div>

<script src="{{asset('js/ventacaja.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script> 
@endsection
