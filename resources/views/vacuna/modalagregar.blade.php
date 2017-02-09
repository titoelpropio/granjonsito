  <div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR VACUNA</h3>
      </div>

      <div class="modal-body">
      {!!Form::open(['route'=>'vacuna.store', 'method'=>'POST'])!!} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        {!!Form::hidden('id',null,['id'=>'id_vacuna','class'=>'form-control'])!!}
      <div class="form-group">
          {!!Form::label('edad','Edad a vacunar:')!!}
          {!!Form::text('edad',null,['id'=>'edad','class'=>'form-control','placeholder'=>'Ingresa La Edad A Vacunar','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
      </div>
      <div class="form-group">
          {!!Form::label('nombre','Nombre:')!!}
          {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingresa El Nombre De La Vacuna'])!!}
      </div>

      <div class="form-group">
          {!!Form::label('detalle','Metodo De Aplicacion:')!!}
          {!!Form::textarea('detalle',null,['id'=>'detalle','class'=>'form-control','rows'=>'3','placeholder'=>'Ingresa El Metodo De Aplicacion'])!!}
      </div>
    {!!Form::hidden('estado',1,['id'=>'estado','class'=>'form-control','placeholder'=>'Estado'])!!}    
  </div>

      <div class="modal-footer">
          {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}
          <!--button class="btn btn-primary" onclick="crear_vacuna()" id="btnregistrar">REGISTRAR</button-->
          <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>  
      </div>
    </div>
  </div>
</div>
