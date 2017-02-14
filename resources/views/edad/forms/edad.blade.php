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
    {!!Form::label('edad','Edad:')!!}
    {!!Form::text('edad',null,['id'=>'edad','class'=>'form-control','placeholder'=>'Ingrese La Edad','onkeypress'=>'return numerosmasdecimal(event)'])!!}

</div>
<div class="form-group">

    {!!Form::label('cantidad_inicial','Cantidad inicial:')!!}
    {!!Form::text('cantidad_inicial',null,['id'=>'cantidad_inicial','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Incial','onkeypress'=>'return numerosmasdecimal(event)'])!!}

</div>

<div class="form-group">
    {!!Form::label('cantidad_actual','Cantidad actual:')!!}
    {!!Form::text('cantidad_actual',null,['id'=>'cantidad_actual','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Actual','onkeypress'=>'return numerosmasdecimal(event)'])!!}

</div>
<div class="form-group">

    {!!Form::label('cantidad_muerta','Total Muertas:')!!}
    {!!Form::text('total_muerta',null,['id'=>'totalmuerta','class'=>'form-control','placeholder'=>'Ingrese Total Muertas','onkeypress'=>'return numerosmasdecimal(event)'])!!}

</div>
<div class="form-group">
    {!!Form::label('id_galpon','Galpon:')!!}
{!!Form::select('id_galpon',[],null,['id'=>'id_galpon'])!!}


    <br>
    {!!Form::label('estado','Estado:')!!}
    {!!Form::select('estado', array('1' => 'Activo', '0' => 'Inactivo'), '23423',array('id'=>'estado','class'=>'form-control'))!!}
</div>



<!--div class="col-sm-6" style="height:130px;">
    <div class="form-group">
{!!Form::label('fecha','Fecha:')!!}
        <div class='input-group date' id='datetimepicker8'>
         {!!Form::text('fecha_inicio',null,['id'=>'fecha','class'=>'form-control'])!!}
           
            <span class="input-group-addon">
                <span class="fa fa-calendar">
                </span>
            </span>
        </div>
    </div>
</div-->

