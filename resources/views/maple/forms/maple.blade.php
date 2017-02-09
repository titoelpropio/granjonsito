

<div class="form-group">
    {!!Form::label('tamano','Tipo:')!!}
    {!!Form::text('tamano',null,['id'=>'tamano','class'=>'form-control','placeholder'=>'Ingrese El Tipo De Cajas'])!!}
</div>

<div class="form-group">
    {!!Form::label('cantidad','Cantidad:')!!}
    {!!Form::text('cantidad',null,['id'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese El Precio De Cajas','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
</div>
