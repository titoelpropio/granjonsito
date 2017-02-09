  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="pull-left"> <h3 class="modal-title">INTRODUSCA LA CONTRASEÑA</h3></div>         
      </div>

      <div class="modal-body">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="password" maxlength="15" id="contra" class="form-control"> 
  </div>

      <div class="modal-footer">
          <input type="submit" class="btn btn-primary" onclick="confirmar()" value="ACEPTAR">
          {!!link_to('#', $title='CANCELAR', $attributes = ['data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>
