
<!--RANGO EDAD-->

<div class="modal fade" id="myModalRangoEdad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR RANGO EDAD</h3>
      </div>

      <div class="modal-body">
       <?php //{!!Form::open(['route'=>'rango_edad.store', 'method'=>'POST'])!!}  ?>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

      <div class="form-group">
          {!!Form::label('edad_min','Edad Minima: ')!!}
          {!!Form::number('edad_min',null,['id'=>'edad_min','class'=>'form-control','placeholder'=>'Ingrese La Edad Minima','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
      </div>

      <div class="form-group">
          {!!Form::label('edad_max','Edad Maxima: ')!!}
          {!!Form::number('edad_max',null,['id'=>'edad_max','class'=>'form-control','placeholder'=>'Ingrese La Edad Maxima','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
      </div>
          {!!Form::text('estado',1,['id'=>'estado','class'=>'form-control'])!!}
</div>

      <div class="modal-footer">
     <?php // {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}      
   // {!!Form::close()!!} ?>
    <button class="btn btn-primary" onclick="crear_rango_edad()" id="btnregistrar">REGISTRAR</button>
      <button data-dismiss="modal"  class="btn btn-danger" onclick="limpiar()">CANCELAR</button>
      </div>
    </div>
  </div>
</div>


<!--RANGO EDAD-->

  <div class="modal fade" id="myModalRangoTemperatura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR RANGO TEMPERATURA</h3>
      </div>

      <div class="modal-body">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

      <div class="form-group">
          {!!Form::label('temp_min','Temperatura Minima: ')!!}
          {!!Form::number('temp_min',null,['id'=>'temp_min','class'=>'form-control','placeholder'=>'Ingrese La Temperatura Minima','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
      </div>

      <div class="form-group">
          {!!Form::label('temp_max','Temperatura Maxima: ')!!}
          {!!Form::number('temp_max',null,['id'=>'temp_max','class'=>'form-control','placeholder'=>'Ingrese La Temperatura Maxima','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
      </div>

</div>

      <div class="modal-footer">
      <button class="btn btn-primary" onclick="crear_rango_temperatura()" id="btnregistrar" >REGISTRAR</button>
      <button data-dismiss="modal"  class="btn btn-danger" onclick="limpiar()">CANCELAR</button>
      </div>
    </div>
  </div>
</div>