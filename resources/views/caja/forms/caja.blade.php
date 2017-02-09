<script type="text/javascript">
                function numerosmasdecimal(e)
                {
                    var keynum = window.event ? window.event.keyCode : e.which;
                    if ((keynum == 8) || (keynum == 46))
                        return true;
                    return /\d/.test(String.fromCharCode(keynum));
                }

                function limpia(elemento)
                {
                    if (elemento.value==0)
                    elemento.value="";                    
                }

                function verificar(elemento)
                {
                    if (elemento.value=="")
                    elemento.value="0";                    
                }
            </script>

<div class="form-group">
    {!!Form::label('cantidad','Cantidad:')!!}
    {!!Form::text('cantidad',null,['id'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese La Cantidad De Cajas','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>

<div class="form-group">
    {!!Form::label('id_tipo_caja','Tipo De Caja:')!!}
    {!!Form::select('id_tipo_caja',$tipocaja,null,array('class'=>'form-control'))!!}
</div>

<div class="form-group">
    {!!Form::label('total','Total:')!!}
    {!!Form::text('total',null,['id'=>'total','class'=>'form-control','placeholder'=>'Ingrese La Cantidad De Cajas','onkeypress'=>'return numerosmasdecimal(event)'])!!}
</div>
