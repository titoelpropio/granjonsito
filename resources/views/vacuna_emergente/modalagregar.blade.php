  <div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR VACUNA</h3>
      </div>

      <div class="modal-body">
      {!!Form::open(['route'=>'vacuna_emergente.store', 'method'=>'POST'])!!} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        {!!Form::hidden('id',null,['id'=>'id_vacuna','class'=>'form-control'])!!}
      <div class="form-group">
          {!!Form::label('nombre','Nombre:')!!}
          {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingresa El Nombre De La Vacuna'])!!}
      </div>

      <div class="form-group">
          {!!Form::label('detalle','Metodo De Aplicacion:')!!}
          {!!Form::textarea('detalle',null,['id'=>'detalle','class'=>'form-control','rows'=>'3','placeholder'=>'Ingresa El Metodo De Aplicacion'])!!}
      </div>

      <div class="form-group">
          {!!Form::label('precio','Precio:')!!}
          {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','rows'=>'3','placeholder'=>'Ingrese El Precio','onkeypress'=>'return numerosmasdecimal(event)'])!!}
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


  <div class="modal fade" id="ModalConsumoEmergente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >CONSUMIR VACUNA EMERGENTE</h3>
      </div>

      <div class="modal-body">     
    {!!Form::open(['route'=>'consumo_vacuna_emergente.store', 'method'=>'POST'])!!}  

        {!!Form::hidden('id_vac',null,['id'=>'id_vac','class'=>'form-control'])!!}
      <div class="form-group">
          {!!Form::label('cantidad_vac','Cantidad:')!!}
          {!!Form::text('cantidad_vac',1,['id'=>'cantidad_vac','class'=>'form-control','placeholder'=>'Ingrese La Cantidad','onkeyup'=>'calcular()','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
      </div>

      <div class="form-group">
          {!!Form::label('precio_vac','Precio:')!!}
          {!!Form::text('precio_vac',null,['id'=>'precio_vac','class'=>'form-control','placeholder'=>'Ingrese El Precio','onkeypress'=>'return numerosmasdecimal(event)'])!!}
      </div>
      <input type="hidden" id="precio_aux">

      <div class="form-group">
          {!!Form::label('seleccionar','Seleccionar:')!!}
          {!!Form::select('id_galponcv',[],null,['id'=>'id_galponcv'])!!}
      </div>


    {!!Form::hidden('estado_vac',1,['id'=>'estado_vac','class'=>'form-control','placeholder'=>'Estado'])!!}    
  </div>

      <div class="modal-footer">
          {!!Form::submit('ACEPTAR',['class'=>'btn btn-primary','id'=>'btn_consumir', 'onclick'=>'esconder()'])!!}
   {!!Form::close()!!} 
          <!--<button class="btn btn-primary" onclick="consumir_vacuna_emergente()" id="btnregistrar">REGISTRAR</button>-->
          <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>  
      </div>
    </div>
  </div>
</div>


<!--ELIMINAR VACUNA EMERGENTE-->
  <div class="modal fade" id="ModalEliminarVacunaEmergente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">     
      {!!Form::open(['route'=>['vacuna_emergente.destroy','null'],'method'=>'DELETE'])!!}      

        {!!Form::TEXT('id_con_vac',null,['id'=>'id_con_vac','class'=>'form-control'])!!}
        <h3>DESEA ELIMINAR ESTA VACUNA EMERGENTE</h3>

  </div>

      <div class="modal-footer">
          {!!Form::submit('ACEPTAR',['class'=>'btn btn-primary','id'=>'btn_eliminar', 'onclick'=>'esconder()'])!!}
   {!!Form::close()!!} 
          <!--<button class="btn btn-primary" onclick="consumir_vacuna_emergente()" id="btnregistrar">REGISTRAR</button>-->
          <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>  
      </div>
    </div>
  </div>
</div>