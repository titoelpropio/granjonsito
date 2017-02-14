
<div class="form-group">
    {!!Form::label('edad','Edad a Vacunar:')!!}
    {!!Form::text('edad',null,['class'=>'form-control','placeholder'=>'Ingresa La Edad A Vacunar','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
</div>
<div class="form-group">
    {!!Form::label('nombre','Nombre:')!!}
    {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa El Nombre De La Vacuna'])!!}
</div>

<div class="form-group">
    {!!Form::label('detalle','Metodo De Aplicacion:')!!}
    {!!Form::textarea('detalle',null,['class'=>'form-control','rows'=>'3','placeholder'=>'Ingresa El Metodo De Aplicacion'])!!}
</div>

