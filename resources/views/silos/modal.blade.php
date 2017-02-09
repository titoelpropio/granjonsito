  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR SILO</h3>
      </div>

    <div class="modal-body">
      
		<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
 	{!!Form::open(['route'=>'silo.store', 'method'=>'POST'])!!}    
		{!!Form::hidden('id',$contador,['id'=>'id_silo','class'=>'form-control','readonly'])!!}
		<div class="form-group">
		    {!!Form::label('nombre','Nombre:')!!}
		    {!!Form::text('nombre','SILO '.$contador,['id'=>'nombre','class'=>'form-control','readonly'])!!}
		</div>
		<div class="form-group">
		    {!!Form::label('capacidad','Capacidad Del Silo:')!!}
		    {!!Form::text('capacidad',null,['id'=>'capacidad','class'=>'form-control','placeholder'=>'Ingresa La Capacidad Del Silo','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>
		<div class="form-group">
		    {!!Form::label('cantidad','Cantidad Actual:')!!}
		    {!!Form::text('cantidad',null,['id'=>'cantidad','class'=>'form-control','placeholder'=>'Ingresa La Cantidad Del Silo','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>
		<div class="form-group">
		    {!!Form::label('cantidad_minima','Cantidad Minima De Alerta:')!!}
		    {!!Form::text('cantidad_minima',null,['id'=>'cantidad_minima','class'=>'form-control','placeholder'=>'Ingresa La Cantidad Minima Del Silo','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>
		<div class="form-group">
		    {!!Form::label('id_tipo','Tipo de Alimento:')!!}
		    {!!Form::select('id_alimento',$alimento,null,array('id'=>'id_alimento','class'=>'form-control'))!!}
		</div>
		{!!Form::hidden('estado',1,['id'=>'estado','class'=>'form-control','placeholder'=>'Estado'])!!}   
  	</div>

      <div class="modal-footer">
      	{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}      
      <!--BUTTON class="btn btn-primary" onclick="crear_silo()" id="btnregistrar" >REGISTRAR</BUTTON-->
      	<button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
