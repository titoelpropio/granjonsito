  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR EGRESO</h3>
      </div>

      <div class="modal-body">
        {!!Form::open(['route'=>'egreso.store', 'method'=>'POST'])!!} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    
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
           <?php // {!!Form::date('fecha',null,['id'=>'fecha','class'=>'form-control'])!!} ?>
      </div>
      <div class="form-group">
          {!!Form::label('precio','Precio: ')!!}
          {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'Ingrese El Precio','onkeypress'=>'return numerosmasdecimal(event)'])!!}
      </div>

</div>

      <div class="modal-footer">
            {!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
    {!!Form::close()!!}
      <!--button class="btn btn-primary" onclick="crear_egreso()" id="btnregistrar">REGISTRAR</button-->     
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
    </div>
  </div>
</div>


<!--ACTUALIZAR EGRESO-->
<div class="modal fade" id="myModalActualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
              <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" >ACTUALIZAR EGRESO</h3>
              </div>
       <?php // {!!Form::open(['route'=>['ingreso.update','null'],'method'=>'PUT'])!!} ?>
            <div class="modal-body">                    
              <input type='hidden' class="form-control" id="id_egreso_ac" name="id_egreso_ac"/>
              <div class="form-group">
                  {!!Form::label('id_categoria','Categoria:')!!}
                  {!!Form::select('id_categoria_ac',[],null,['id'=>'id_categoria_ac'])!!}
              </div>

              <div class="form-group">
                  {!!Form::label('detalle','Detalle: ')!!}
                  {!!Form::textarea('detalle_ac',null,['id'=>'detalle_ac','class'=>'form-control','rows'=>'3','placeholder'=>'Ingrese El Detalle','style'=>'text-transform:uppercase'])!!}
              </div>

              <div class="form-group">
                  {!!Form::label('fecha','Fecha: ')!!}
                  <div class='input-group date' id='datetimepicker10'>
                    <input type='text' class="form-control" id="fecha_ac" name="fecha_ac" style="font-size:20px;text-align:left" />
                    <span class="input-group-addon ">
                       <span class="fa fa-calendar" aria-hidden="true"></span>  <!--span class="glyphicon glyphicon-calendar"></span-->
                    </span>
                  </div>      
                  <?php //{!!Form::date('fecha',null,['id'=>'fecha','class'=>'form-control'])!!} ?>
              </div>
              <div class="form-group">
                {!!Form::label('precio','Precio: ')!!}
                {!!Form::text('precio_ac',null,['id'=>'precio_ac','class'=>'form-control','placeholder'=>'Ingrese El Precio','onkeypress'=>'return numerosmasdecimal(event)'])!!}
            </div>
            </div>
                
            <div class="modal-footer">
         <?php /*      {!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary'])!!}
      {!!Form::close()!!}*/ ?>
      <button class="btn btn-primary" onclick="actualizar_egreso()">ACTUALIZAR</button>
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>
            </div>
            
        </div>
    </div>

<!--ANULAR EGRESO-->
<div class="modal fade" id="myModalAnular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        {!!Form::open(['route'=>['egreso.destroy','null'],'method'=>'DELETE'])!!}
            <div class="modal-body">
                    <CENTER><H2>DESEA ANULAR ESTE EGRESO</H2></CENTER>
                    <input type='text' class="form-control" id="id_egreso" name="id_egreso"/>
            </div>
                
            <div class="modal-footer">
               {!!Form::submit('ANULAR EGRESO',['class'=>'btn btn-primary'])!!}
        {!!Form::close()!!}
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>
            </div>
            
        </div>
    </div>