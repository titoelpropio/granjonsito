  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >VACUNAR GALPON</h3>
      </div>
      <div class="modal-body">
      
      {!!Form::open(['route'=>'vacuna.store', 'method'=>'POST'])!!}  

    <div class="form-group">
     {!!Form::label('galpon','Galpon:')!!}
   
      {!!Form::text('nombre',null,['id'=>'nombre_galpon','class'=>'form-control','readonly'])!!}
    </div>
 {!!Form::hidden('id_galpon',null,['id'=>'id_galpon','class'=>'form-control'])!!}
<div class="form-group">
    {!!Form::label('id_tipo','Vacuna:')!!}
    {!!Form::select('id_vacuna',$vacunaActivas,null,array('id'=>'selectvacuna','class'=>'form-control input-lg'))!!}
</div>

   
  </div>
 {!!Form::hidden('id_galpon',null,['id'=>'idinputgalpon','class'=>'form-control','readonly'])!!}
      {!!Form::hidden('id_vacuna',null,['id'=>'idinputvacuna','class'=>'form-control','readonly'])!!}
      <div class="modal-footer">
      <input  type="button" id=""  value="VACUNAR" class="btn btn-primary " onclick="vacunarmodal()">
      <input  type="button" id=""   data-dismiss="modal" value="CANCELAR" class="btn btn-danger " >
    
      </div>
    </div>
  </div>
</div>


<!--modal para el agregar vacuna y galpon personalisado-->
<div class="modal fade bd-example-modal-lg" id="myModalcreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >VACUNAR GALPON</h3>
      </div>
      <div class="modal-body">
      
      {!!Form::open(['route'=>'vacuna.store', 'method'=>'POST'])!!}

    <div class="form-group">
     {!!Form::label('galpon','Galpon:')!!}
         {!!Form::select('id_galpon',[],null,['id'=>'idgalpons','class'=>'form-control'])!!}
       
    </div>
 {!!Form::hidden('id_galpon',null,['id'=>'id_galpon','class'=>'form-control'])!!}
<div class="form-group">
    {!!Form::label('id_tipo','Vacuna:')!!}
    {!!Form::select('id_vacuna',$vacunaActivas,null,array('id'=>'selectvacunas','class'=>'form-control input-lg'))!!}
</div>

   
  </div>
 {!!Form::hidden('id_galpon',null,['id'=>'idinputgalpon','class'=>'form-control','readonly'])!!}
      {!!Form::hidden('id_vacuna',null,['id'=>'idinputvacuna','class'=>'form-control','readonly'])!!}
      <div class="modal-footer">
      <input  type="button" id=""  value="VACUNAR" class="btn btn-primary " onclick="vacunarmodalcreate()">
      <input  type="button" id=""   data-dismiss="modal" value="CANCELAR" class="btn btn-danger " >
    
      </div>
    </div>
  </div>
</div>
