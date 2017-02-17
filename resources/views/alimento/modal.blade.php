  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR ALIMENTO</h3>
      </div>

      <div class="modal-body">
  {!!Form::open(['route'=>'alimento.store', 'method'=>'POST'])!!}                        
    <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">

		<div class="form-group">
		    {!!Form::label('Nombre','Nombre:')!!}
		    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese el Nombre del Alimento'])!!}
		</div>

		<div class="form-group">
		    {!!Form::label('tipo','Tipo:')!!}
		    {!!Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Ingrese El Tipo De Alimento'])!!}
		</div>

		<div class="form-group">
		    {!!Form::label('tipo_gallina','Tipo Gallina:')!!}
		    {!!Form::select('tipo_gallina', array('0' => 'CRIA', '1' => 'PONEDORAS', '2' => 'AMBAS'),null,array('id'=>'tipo_gallina','class'=>'form-control'))!!}
		</div>          
        {!!Form::hidden('estado',1,['id'=>'estado','class'=>'form-control','placeholder'=>'Estado'])!!}    
  </div>

      <div class="modal-footer">
      {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}
          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
