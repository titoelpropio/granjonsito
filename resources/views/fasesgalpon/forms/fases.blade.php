<div class="form-group">
    {!!Form::label('numero','Numero: ')!!}
    {!!Form::text('numero',null,['id'=>'numero','class'=>'form-control','placeholder'=>'Ingrese El Numero','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
</div>
<div class="form-group">
    {!!Form::label('nombre','Nombre: ')!!}
    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese La Fase'])!!}
</div>