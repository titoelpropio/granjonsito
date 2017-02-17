
<div class="form-group">
    {!!Form::label('tipo','Tipo:')!!}
    {!!Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Ingrese El Tipo De Caja'])!!}
</div>

<div class="form-group">
    {!!Form::label('precio','Precio:')!!}
    {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','placeholder'=>'Ingrese El Precio De La Caja','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>

<div class="form-group">
    {!!Form::label('id_maple','Tamaño De Maple:')!!}
    {!!Form::select('id_maple',$maple,null,array('class'=>'form-control'))!!}
</div>

<div class="form-group">
    {!!Form::label('cantidad_maple','Cantidad Maple:')!!}
    {!!Form::text('cantidad_maple',null,['id'=>'cantidad_maple','class'=>'form-control','placeholder'=>'Ingrese La Cantidad De Maple','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
</div>



<div>
    {!!Form::label('color','Color:')!!}
    <select name="color" id="color" class="form-control">
    <option value="">Seleccione Un Color</option>
    <option value="silver" style="background: silver">PLOMO</option>
    <option value="green" style="background: green">VERDE</option>    
    <option value="red" style="background: red">ROJO</option>
    <option value="blue" style="background: blue">AZUL</option>
    <option value="white" style="background: white">BLANCO</option>
    <option value="yellow" style="background: yellow">AMARILO</option>
    </select>
<br>
</div>