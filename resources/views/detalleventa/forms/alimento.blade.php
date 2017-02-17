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
    {!!Form::label('Nombre','Nombre:')!!}
    {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese el Nombre del alimento'])!!}
</div>

<div class="form-group">
    {!!Form::label('tipo','Tipo:')!!}
    {!!Form::text('tipo',null,['id'=>'tipo','class'=>'form-control','placeholder'=>'Tipo'])!!}
</div>

<div class="form-group">
    {!!Form::label('Precio','Precio:')!!}
    {!!Form::text('precio',null,['id'=>'precio','class'=>'form-control','onkeypress'=>'return numerosmasdecimal(event)','placeholder'=>'Precio'])!!}
</div>

<div class="form-group">
    {!!Form::label('tipo_gallina','Tipo Gallina:')!!}
    {!!Form::select('tipo_gallina', array('0' => 'CRIA', '1' => 'PONEDORAS', '2' => 'AMBAS'), null,array('id'=>'estado','class'=>'form-control'))!!}
</div>
