  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >VACUNAR GALPON</h3>
      </div>
      <div class="modal-body">
      
      {!!Form::open(['route'=>'consumo.store', 'method'=>'POST'])!!} 

    <div class="form-group">
     {!!Form::label('galpon','Galpon:')!!}
   
      {!!Form::text('nombre',null,['id'=>'nombre_galpon','class'=>'form-control'])!!}
    </div>
   
  </div>
 {!!Form::text('id_galpon',null,['id'=>'idinputgalpon','class'=>'form-control','readonly'])!!}
      {!!Form::text('id_vacuna',null,['id'=>'idinputvacuna','class'=>'form-control','readonly'])!!}
      <div class="modal-footer">
      {!!link_to('#', $title='Resgistrar', $attributes = ['id'=>'registrarcria', 'class'=>'btn btn-danger'], $secure = null)!!}
      {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>

