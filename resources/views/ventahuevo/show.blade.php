@extends ('layouts.admin')
@section ('content')

<div class="pull-left"><h1><b>DETALLE DE VENTA DE HUEVOS</b></h1></div>
        <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
    <div class="pull-right" >
           <h3>FECHA: {{$venta_huevo->fecha}}</h3><br><br>
           <input type="hidden" id="fecha" value="{{$venta_huevo->fecha}}">
    </div>

    <div class="col-lg-12 col-sm-12 col-xs-12" >
        <div class="panel panel-primary" >
            <div class="panel-body" >
                <div class="table-responsive">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">                    
                            <th><center>TIPO DE HUEVO</center></th>
                            <th><center>CANTIDAD DE MAPLE</center></th>
                            <th><center>CANTIDAD DE HUEVO</center></th>                            
                            <th><center>SALDO</center></th>                       
                        </thead>

                        <tbody>
                        	@foreach($detalle as $det)
                        	<tr align="center" id="fila{{$det->id_tipo_huevo}}">
                        		<td>{{$det->tipo}}</td>                        		
                        		<td><span id="cantidad_caja{{$det->id_tipo_huevo}}">{{$det->cantidad_maple}}</span></td>
                                <td><span id="cantidad_huevo{{$det->id_tipo_huevo}}">{{$det->cantidad_huevo}}</span></td>                                
                        		<td>{{$det->subtotal_precio}}</td>
                        	</tr>
                        	@endforeach
                        </tbody>
                        <tr align="center" style="background-color: #f1948a">
                        	<td>MONTO TOTAL</td>
                        	<td></td>                           	               
                            <td></td>                                 
                            <td><font size="4" id="total">{{$venta_huevo->precio}} Bs.</font></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="pull-right"> 
	<button class="btn btn-primary" onclick="anular_venta_huevo({{$venta_huevo->id}})" id="anular">ANULAR VENTA</button> 
	<a href="{!!URL::to('ventahuevo')!!}" class="btn btn-danger" id="cancelar">CANCELAR</a>
</div>

<script src="{{asset('js/ventahuevo.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script> 
@endsection
