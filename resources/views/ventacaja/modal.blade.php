  <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="pull-left">      
        <h3 id="titulogalpon" class="modal-title" >DETALE DE VENTA</h3>
      </div>
        <div class="pull-right">
            <h3 id="fecha"></h3>
      </div>
      </div>

      <div class="modal-body">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
		<input type="hidden" id="id_venta">	

            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #A9D0F5">						
                <th><center>TIPO DE CAJA</center></th>
                <th><center>CANTIDAD DE CAJAS</center></th>
                <th><center>SALDO</center></th>
                </thead>

                <tbody id="datos">
                </tbody>

                <tr align="center" style="background-color: #f1948a">
                	<td>TOTAL</td>
                	<td></td>                   
                    <td><font size="4" id="total"></font><font size="4"> Bs.</font></td>
                </tr>
            </table>
  	  </div>

      <div class="modal-footer">        
      	{!!link_to('#', $title='SALIR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>

<!--ANULAR VENTA-->
  <div class="modal fade bd-example-modal-lg" id="myModal_anular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="pull-left">      
        <h3 id="titulogalpon" class="modal-title" >DETALE DE VENTA</h3>
      </div>
        <div class="pull-right">
            <h3 id="fecha_aux"></h3>
            <input type="hidden" id="fecha_a">
      </div>
      </div>

      <div class="modal-body">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <input type="hidden" id="id_venta_a"> 

            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #A9D0F5">           
                <th><center>TIPO DE CAJA</center></th>
                <th><center>CANTIDAD DE CAJAS</center></th>
                <th><center>SALDO</center></th>
                </thead>

                <tbody id="datos_a">
                </tbody>

                <tr align="center" style="background-color: #f1948a">
                  <td>TOTAL</td>
                  <td></td>                   
                    <td><font size="4" id="total_a"></font><font size="4"> Bs.</font></td>
                </tr>
            </table>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" id="btn_anular" onclick="anular_venta_caja()">ANULAR VENTA</button>
        {!!link_to('#', $title='SALIR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>