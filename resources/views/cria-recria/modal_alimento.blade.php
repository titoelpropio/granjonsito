


<!--modal para el agregar vacuna y galpon personalisado-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulo" class="modal-title"></h3>
      </div>

      <div class="modal-body">
      <input type="hidden" id="id_control" class="form-control">
      <input type="hidden" id="id_galpon" class="form-control">
      <input type="hidden" id="id_fase_galpon" class="form-control">
      <input type="hidden" id="cantidad_actual_g" class="form-control">

      <div class="form-group">
        <input type="hidden" id="tipo" class="form-control">
      </div>

    <div class="col-lg-12 col-sm-12 col-xs-12" >
      <div class="form-group">
        {!!Form::label('cantidad','CANTIDAD DE ALIMENTO EN GRANEL:')!!} <br>
        <input type="text" id="cantidad_granel" class="form-control" onkeypress="return numerosmasdecimal(event)" onkeyup="calcular_alimento()"> 
      </div>     
      </div> 


    <div class="col-lg-12 col-sm-12 col-xs-12" >
      <div class="form-group">
        {!!Form::label('cantidad','CANTIDAD DE ALIMENTO:')!!}
        <input type="text" id="cantidad" class="form-control"  onkeypress="return numerosmasdecimal(event)">
      </div>      
    </div>      
    <div class="col-lg-12 col-sm-12 col-xs-12" >
      <div class="form-group">
        {!!Form::label('id_silo','SILO:')!!}
        {!!Form::select('id_silo',[],null,['id'=>'id_silo'])!!}
      </div>
    </div>
   
      </div>

      <div class="modal-footer">
        <div class="col-lg-12 col-sm-12 col-xs-12" >
            <button id="btn_aceptar" class="btn btn-primary " onclick="alimentar()">ALIMENTAR</button>
            <button id="btn_cancelar"   data-dismiss="modal" class="btn btn-danger">CANCELAR</button>
        </div>
      </div>
    </div>
  </div>
</div>
