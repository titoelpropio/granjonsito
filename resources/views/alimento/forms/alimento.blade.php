
<div class="form-group">
    {!!Form::label('Nombre','Nombre:')!!}
    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese el Nombre del alimento'])!!}
</div>

<div class="form-group">
    {!!Form::label('tipo','Tipo:')!!}
    {!!Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Tipo'])!!}
</div>

<div class="form-group">
    {!!Form::label('tipo_gallina','Tipo Gallina:')!!}
    {!!Form::select('tipo_gallina', array('0' => 'CRIA', '1' => 'PONEDORAS', '2' => 'AMBAS'), null,array('id'=>'estado','class'=>'form-control'))!!}
</div>
