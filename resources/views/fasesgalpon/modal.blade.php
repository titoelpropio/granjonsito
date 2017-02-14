  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR FASES</h3>
      </div>

      <div class="modal-body">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id">

<div class="form-group">
    {!!Form::label('numero','Numero: ')!!}
    {!!Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'Ingrese El Numero','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
</div>
<div class="form-group">
    {!!Form::label('nombre','Nombre: ')!!}
    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese La Fase'])!!}
</div>

</div>

      <div class="modal-footer">
      <button class="btn btn-primary" onclick="crear_fase()">ACEPTAR</button>
      {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal','class'=>'btn btn-danger'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>
