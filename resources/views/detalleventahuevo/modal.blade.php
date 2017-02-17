  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" ></h4>
      </div>

      <div class="modal-body">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id">
        {!!Form::hidden('null',null,['id'=>'idgalpon','class'=>'form-control'])!!}
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">

		<script type="text/javascript">
		                function numerosmasdecimal(e)
		                {
		                    var keynum = window.event ? window.event.keyCode : e.which;
		                    if ((keynum == 8) || (keynum == 46))
		                        return true;
		                    return /\d/.test(String.fromCharCode(keynum));
		                }
		            </script>

		<div class="form-group">
		    {!!Form::label('Nombre','Nombre:')!!}
		    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese el Nombre del alimento'])!!}
		</div>

		<div class="form-group">
		    {!!Form::label('tipo','Tipo:')!!}
		    {!!Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Tipo'])!!}
		</div>

		<div class="form-group">
		    {!!Form::label('Precio','Precio:')!!}
		    {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','onkeypress'=>'return numerosmasdecimal(event)','placeholder'=>'Precio'])!!}
		</div>

		<div class="form-group">
		    {!!Form::label('tipo_gallina','Tipo Gallina:')!!}
		    {!!Form::select('tipo_gallina', array('0' => 'CRIA', '1' => 'PONEDORAS', '2' => 'AMBAS'),null,array('id'=>'tipo_gallina','class'=>'form-control'))!!}
		</div>
  </div>

      <div class="modal-footer">
          <button class="btn btn-primary"  onclick="crearalimento()" >ACEPTAR</button>
      {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar', 'class'=>'btn btn-danger'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>
