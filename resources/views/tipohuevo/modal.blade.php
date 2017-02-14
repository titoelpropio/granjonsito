  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR TIPO DE HUEVOS</h3>
      </div>

      <div class="modal-body">
  {!!Form::open(['route'=>'tipohuevo.store', 'method'=>'POST'])!!} 
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">

	<div class="form-group">
	    {!!Form::label('tipo','Tipo:')!!}
	    {!!Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Ingrese El Tipo De Huevo'])!!}
	</div>

	<div class="form-group">
	    {!!Form::label('precio','Precio:')!!}
	    {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'Ingrese El Precio Del Huevo','onkeypress'=>'return numerosmasdecimal(event)'])!!}
	</div>

<div class="form-group">
    {!!Form::label('id_maple','Maple:')!!}
    {!!Form::select('id_maple',$maple,null,array('id'=>'id_maple','class'=>'form-control'))!!}
</div>
{!!Form::hidden('estado',1,['id'=>'estado','class'=>'form-control','placeholder'=>'Estado'])!!} 
</div>

      <div class="modal-footer">
            {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}
      <!--button class="btn btn-primary" onclick="crear_tipo_huevo()" id="btnregistrar">REGISTRAR</button-->      
            <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
