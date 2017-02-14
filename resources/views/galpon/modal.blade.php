  
<div class="modal fade" id="myModalcreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" >REGISTRAR GALPON</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    
    <div class="form-group">
      {!!Form::label('numero','Numero:')!!}
      {!!Form::text('numero',$contador,['id'=>'numero','class'=>'form-control','readonly'=>'','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
    </div>

    <div class="form-group">
      {!!Form::label('capacidad_total','Capacidad Total:')!!}
      {!!Form::text('capacidad_total',null,['id'=>'capacidad_total','class'=>'form-control','placeholder'=>'Ingrese La Capacidad Total','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
    </div>

</div>

        <div class="modal-footer">
            <button class="btn btn-primary" onclick="crear_galpon()" id="btnregistrar">REGISTRAR</button>
            <button data-dismiss="modal"  class="btn btn-danger" onclick="limpiar_text()">CANCELAR</button>
        </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" ></h3> 
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token"> 
    @include('alerts.request')
    {!!Form::hidden('id',null,['id'=>'id_galpon_a','class'=>'form-control','readonly'])!!}

    <div class="form-group">
      {!!Form::label('numero','Numero:')!!}
      {!!Form::text('numero',null,['id'=>'numero_a','class'=>'form-control','readonly'=>'','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
    </div>

    <div class="form-group">
      {!!Form::label('capacidad_total','Capacidad Total:')!!}
      {!!Form::text('capacidad_total',null,['id'=>'capacidad_total_a','class'=>'form-control','placeholder'=>'Ingrese La Capacidad Total','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
    </div>
  </div>

      <div class="modal-footer">
      <button class="btn btn-primary" onclick="actualizar_galpon()">ACEPTAR</button>
      {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal','class'=>'btn btn-danger'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>





