<script type="text/javascript">
    function numerosmasdecimal(e)
    {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }
</script>   
{!!Form::hidden('id',null,['class'=>'form-control','readonly'])!!}
<div class="form-group">
    {!!Form::label('nombre','Nombre:')!!}
    {!!Form::text('nombre',null,['class'=>'form-control','readonly'])!!}
</div>
<div class="form-group">
    {!!Form::label('capacidad','Capacidad Actual:')!!}
    {!!Form::text('capacidad',null,['class'=>'form-control','placeholder'=>'Ingresa La Capacidad Del Silo','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>
<div class="form-group">
    {!!Form::label('cantidad','Cantidad:')!!}
    {!!Form::text('cantidad',null,['class'=>'form-control','placeholder'=>'Ingresa La Cantidad Del Silo','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>
<div class="form-group">
    {!!Form::label('cantidad_minima','Cantidad Minima:')!!}
    {!!Form::text('cantidad_minima',null,['class'=>'form-control','placeholder'=>'Ingresa La Cantidad Minima Del Silo','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>
<div class="form-group">
    {!!Form::label('id_tipo','Tipo de Alimento:')!!}
    {!!Form::select('id_alimento',$alimento,null,array('class'=>'form-control'))!!}
</div>
