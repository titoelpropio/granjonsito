  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h3 id="titulo" class="modal-title">DEVOLUCIONES DE CAJAS</h3>
      </div>

      <div class="modal-body">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id_caja"> 
        INTRODUSCA LA CANTIDAD DE DEVOLUCION: 
        <input type="text" id="devolucion_aux" style="width:70px;height:35px;font-size:25px;text-align:center" onkeypress="return bloqueo_de_punto(event)" maxlength="2" onkeyup="copiar()">
        <input type="hidden" id="devolucion"><br><br>
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #A9D0F5">           
                <th><center>TIPO DE CAJA</center></th>
                <th><center>CANTIDAD DE CAJAS</center></th>
                <th><center>FECHA</center></th>
                </thead>

                <tbody id="datos">
                </tbody>
            </table>
  </div>

      <div class="modal-footer">
          <input type="submit" class="btn btn-primary" onclick="ajuste_caja()" id="btn_ajuste" value="ACEPTAR">
          <input type="submit" id="cancel" class="btn btn-danger" data-dismiss="modal" value="SALIR">          
      </div>
    </div>
  </div>
</div>
