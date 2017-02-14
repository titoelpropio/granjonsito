  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR TIPO DE CAJAS</h3>
      </div>

      <div class="modal-body">
  {!!Form::open(['route'=>'tipocaja.store', 'method'=>'POST'])!!}       
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
     
		 {!!Form::label('color','Seleccione Un Color:')!!}
		<select name="color" id="color" class="form-control">
		<option value="">SELECCIONE UN COLOR</option>
		<option value="silver" style="background: silver">PLOMO</option>
		<option value="green" style="background: green">VERDE</option>
		<option value="red" style="background: red">ROJO</option>
		<option value="blue" style="background: blue">AZUL</option>
		<option value="white" style="background: white">BLANCO</option>
		<option value="yellow" style="background: yellow">AMARILO</option>
		</select>
		<br>
		<div class="form-group">
		    {!!Form::label('tipo','Tipo:')!!}
		    {!!Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Ingrese El Tipo De Caja'])!!}
		</div>

		<div class="form-group">
		    {!!Form::label('precio','Precio:')!!}
		    {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'Ingrese El Precio De Caja','onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group">
		    {!!Form::label('id_maple','Tipo de Maple:')!!}
		    {!!Form::select('id_maple',$maple,null,array('id'=>'id_maple','class'=>'form-control'))!!}
		</div>

		<div class="form-group">
		    {!!Form::label('cantidad_maple','Cantidad De Maple:')!!}
		    {!!Form::text('cantidad_maple',null,['id'=>'cantidad_maple','class'=>'form-control','placeholder'=>'Ingrese La Cantidad De Maple','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
		</div>
		{!!Form::hidden('estado',1,['id'=>'estado','class'=>'form-control','placeholder'=>'Estado'])!!} 
  </div>

      <div class="modal-footer">
      {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}      
      <!--button class="btn btn-primary" onclick="crear_tipo_caja()" id="btnregistrar">REGISTRAR</button-->
            <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
