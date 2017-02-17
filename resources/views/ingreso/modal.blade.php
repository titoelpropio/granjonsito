  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR INGRESO</h3>
      </div>

      <div class="modal-body">
      
  {!!Form::open(['route'=>'ingreso.store', 'method'=>'POST'])!!} 
	<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
    
<div class="form-group">
    {!!Form::label('id_categoria','Categoria:')!!}
    {!!Form::select('id_categoria',$categoria,null,array('id'=>'id_categoria','class'=>'form-control'))!!}
</div>

<div class="form-group">
    {!!Form::label('detalle','Detalle: ')!!}
    {!!Form::textarea('detalle',null,['id'=>'detalle','class'=>'form-control','rows'=>'3','placeholder'=>'Ingrese El Detalle','style'=>'text-transform:uppercase'])!!}
</div>

<div class="form-group">
    {!!Form::label('fecha','Fecha: ')!!}
    <div class='input-group date' id='datetimepicker10'>
      <input type='text' class="form-control" id="fecha" name="fecha" style="font-size:20px;text-align:left" />
      <span class="input-group-addon ">
         <span class="fa fa-calendar" aria-hidden="true"></span>  <!--span class="glyphicon glyphicon-calendar"></span-->
      </span>
    </div>      
    <?php //{!!Form::date('fecha',null,['id'=>'fecha','class'=>'form-control'])!!} ?>
</div>

<div class="form-group">
    {!!Form::label('precio','Precio: ')!!}
    {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'Ingrese El Precio','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>

</div>

      <div class="modal-footer">
            {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}
      <!--button class="btn btn-primary" onclick="crear_ingreso()" id="btnregistrar">REGISTRAR</button-->
            <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
    </div>
  </div>
</div>
