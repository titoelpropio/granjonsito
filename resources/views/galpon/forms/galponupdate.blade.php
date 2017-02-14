


<div class="form-group">
    {!!Form::label('numero','Numero:')!!}
    {!!Form::text('numero',null,['class'=>'form-control','readonly'])!!}
</div>
<div class="form-group">
    {!!Form::label('capacidad_total','Capacidad Total:')!!}
    {!!Form::text('capacidad_total',null,['id'=>'capacidad_total','class'=>'form-control','placeholder'=>'Ingrese La Capacidad Total','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
</div>


