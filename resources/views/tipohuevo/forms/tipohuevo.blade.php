
<div class="form-group">
    {!!Form::label('tipo','Tipo:')!!}
    {!!Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Ingrese El Tipo De Huevo'])!!}
</div>

<div class="form-group">
    {!!Form::label('precio','Precio:')!!}
    {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'Ingrese El Precio Del Huevo','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>

<div class="form-group">
    {!!Form::label('id_maple','Maple:')!!}
    {!!Form::select('id_maple',$maple,null,array('id'=>'id_maple','class'=>'form-control'))!!}
</div>