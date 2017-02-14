  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >REGISTRAR CONTROL</h3>
      </div>

      <div class="modal-body">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

    <div class="col-lg-12 col-sm-12 col-xs-12" >
        <div class="form-group" >
            <label>RANGO EDAD:</label>
            <select id="id_edad" class="form-control selectpicker"  data-live-search="true">
             <option value="0">SELECCIONE UN RANGO EDAD</option>
                @foreach($edad as $ed)
                <option value="{{$ed->id}}"> {{$ed->edad_min}} - {{$ed->edad_max}} </option>
                @endforeach
            </select>
        </div>
    </div>


        <div class="col-lg-12 col-sm-12 col-xs-12" >
        <div class="form-group" >
            <label>RANGO TEMPERATURA:</label>
            <select id="id_temperatura" class="form-control selectpicker"  data-live-search="true">
             <option value="0">SELECCIONE UN RANGO TEMPERATURA</option>
                @foreach($temperatura as $temp)
                <option value="{{$temp->id}}"> {{$temp->temp_min}} ºC  - {{$temp->temp_max}} ºC </option>
                @endforeach
            </select>
        </div>
    </div>
     
      
      <div class="form-group">
          {!!Form::label('cantidad','Cantidad: ')!!}
          {!!Form::text('cantidad',null,['id'=>'cantidad','class'=>'form-control','placeholder'=>'Ingrese El Cantidad','onkeypress'=>'return numerosmasdecimal(event)'])!!}
      </div>

      <div class="form-group">
          {!!Form::label('id_alimento','Alimento:')!!}
          {!!Form::select('id_alimento',$alimento,null,array('id'=>'id_alimento','class'=>'form-control'))!!}    
      </div>

</div>

      <div class="modal-footer">
      <button class="btn btn-primary" onclick="crear_control()" id="btnregistrar">REGISTRAR</button>
      <button data-dismiss="modal"  class="btn btn-danger" onclick="limpiar()">CANCELAR</button>
      </div>
    </div>
  </div>
</div>

