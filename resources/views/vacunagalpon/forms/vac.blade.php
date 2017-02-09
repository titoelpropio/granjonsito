<script type="text/javascript">
    function numerosmasdecimal(e)
    {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }
</script>   

<div class="form-group">
    {!!Form::label('edad','Edad a vacunar:')!!}
    {!!Form::text('edad',null,['class'=>'form-control','placeholder'=>'Ingresa La Edad A Vacunar','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>
<div class="form-group">
    {!!Form::label('nombre','Nombre:')!!}
    {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa El Nombre De La Vacuna'])!!}
</div>

<div class="form-group">
    {!!Form::label('detalle','Metodo De Aplicacion:')!!}
    {!!Form::textarea('detalle',null,['class'=>'form-control','rows'=>'3','placeholder'=>'Ingresa El Metodo De Aplicacion'])!!}
</div>
<div class="form-group">
    {!!Form::label('estado','Estado:')!!}
    {!!Form::select('estado', array('1' => 'Activo', '0' => 'Inactivo'), '23423',array('id'=>'estado','class'=>'form-control'))!!}
</div>

