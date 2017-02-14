
<div class="form-group">
    {!!Form::label('detalle','Detalle: ')!!}
    {!!Form::text('detalle',null,['id'=>'detalle','class'=>'form-control','placeholder'=>'Ingrese El Detalle'])!!}
</div>

<div class="form-group">
    {!!Form::label('fecha','Fecha: ')!!}
    <div class='input-group date' id='datetimepicker10'>
      {!!Form::text('fecha',null,['id'=>'fecha','class'=>'form-control'])!!} 
      <span class="input-group-addon ">
         <span class="fa fa-calendar" aria-hidden="true"></span> 
      </span>
    </div>  
</div>
<div class="form-group">
    {!!Form::label('precio','Precio: ')!!}
    {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'Ingrese El Precio','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>

<div class="form-group">
    {!!Form::label('id_categoria','Categoria:')!!}
    {!!Form::select('id_categoria',$categoria,null,array('id'=>'id_categoria','class'=>'form-control'))!!}
</div>