  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR CATEGORIA</h3>
      </div>

      <div class="modal-body">
    {!!Form::open(['route'=>'categoria.store', 'method'=>'POST'])!!} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

      	<div class="form-group">
      	    {!!Form::label('Nombre','Nombre: ')!!}
      	    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese El Nombre'])!!}
      	</div>

      	<div class="form-group">
      	    {!!Form::label('tipo','Tipo: ')!!}
      	    {!!Form::select('tipo', array('0' => 'EGRESO', '1' => 'INGRESO'),null,array('id'=>'tipo','class'=>'form-control'))!!}
      	</div>

      </div>

      <div class="modal-footer">
      {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}      
      <!--button class="btn btn-primary" id="btnregistrar" onclick="crear_categoria()">REGISTRAR</button-->
            <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
