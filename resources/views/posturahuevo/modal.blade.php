  
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="titulogalpon" class="modal-title" ></h4>
      </div>
      <div class="modal-body">      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id">
        {!!Form::hidden('cantidad',null,['id'=>'idgalpon','class'=>'form-control','placeholder'=>'Cantidad'])!!}

<table border=1 class="table-striped  table-condensed table-hover" style=" width: 100%" >
<tr align=center style="background-color:black; color:white">
  <td>EDAD</td>
  <td>CANTIDAD GALLINAS</td>
  
</tr>
  <tr align=center>
    <td><font size=3>{!!Form::label(null,null,['id'=>'edad'])!!}</font></td>
    <td><font size=3>{!!Form::label(null,null,['id'=>'cantidad'])!!}</font></td>
  
  </tr>
  
</table>
        <table border=1 class="table-striped  table-condensed table-hover" style=" width: 100%" >
            <tr align=center style="background-color:black; color:white" id="fecha_p">
 
</tr>
<tr align=center id="listapostura">
  
  </tr>
</table>
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
<br>
<script type="text/javascript">
    function numerosmasdecimal(e)
    {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }
</script>  
{!!Form::open(['route'=>'consumo.store', 'method'=>'POST'])!!}

    <div class="form-group">
      {!!Form::label('id_silo','Silo:')!!}
      {!!Form::select('id_silo',[],null,['id'=>'silo'])!!}
    </div>
{!!Form::hidden('id_galpon',null,['id'=>'id_galpon','class'=>'form-control','placeholder'=>'Cantidad'])!!}
    <div class="form-group">
    {!!Form::label('cantidad','Cantidad en Granel:')!!}
    {!!Form::text('cantidad_k',null,['id'=>'cantidad_granel','class'=>'form-control','placeholder'=>'Cantidad En Granel','onkeypress'=>'return numerosmasdecimal(event)'])!!}
    </div>

    <div class="form-group">
      {!!Form::label('cantidad','Cantidad en Kilo:')!!}
      {!!Form::text('cantidad',null,['id'=>'cantidad_total','class'=>'form-control','onkeypress'=>'return numerosmasdecimal(event)','readonly'])!!}
    </div>

      </div>
      <div class="modal-footer">
          {!!Form::submit('REGISTRAR',['class'=>'btn btn-danger'])!!}
          {!!Form::close()!!}
     
      </div>
    </div>
  </div>
</div>
