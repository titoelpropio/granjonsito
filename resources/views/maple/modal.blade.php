  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" >REGISTRAR TIPO DE MAPLE</h3>
      </div>

      <div class="modal-body">
    {!!Form::open(['route'=>'maple.store', 'method'=>'POST'])!!} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    		<div class="form-group">    		   
    		    {!!Form::label('tamano','Tipo:')!!}
    		    {!!Form::text('tamano',null,['id'=>'tamano','class'=>'form-control','placeholder'=>'Ingrese Tipo De Maple'])!!}
    		</div>

    		<div class="form-group">
    		    {!!Form::label('cantidad','Cantidad:')!!}
    		    {!!Form::text('cantidad',null,['id'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese La Cantidad De Huevos','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
    		</div>
      </div>

      <div class="modal-footer">
      {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}      
      <!--button class="btn btn-primary" onclick="crearmaple1()" id="btnregistrar">REGISTRAR</button-->
            <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
