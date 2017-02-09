
<div class="form-group">
    {!!Form::label('Nombre','Nombre: ')!!}
    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese El Nombre'])!!}
</div>

<div class="form-group">
    {!!Form::label('tipo','Tipo: ')!!}
    {!!Form::select('tipo', array('0' => 'EGRESO', '1' => 'INGRESO'),null,array('id'=>'tipo','class'=>'form-control'))!!}
</div>
