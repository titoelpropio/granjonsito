<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_consumo">
                <input type="hidden" id="id_silo">
                <div class="form-group">
                    {!!Form::label('cantidad','CANTIDAD:')!!}
                    <input type="number" id="cantidad" class="form-control" >
                </div>
                <input type="hidden" id="cantidad_aux">

            </div>

            <div class="modal-footer">

                <input type="button" class="btn btn-primary" id="" onclick="actualizar()" value="ACTUALIZAR"> 
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>

        </div>
    </div>
</div>

<!--ELIMINAR CONSUMO-->
<div class="modal fade" id="myModalAnular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!!Form::open(['route'=>['consumo.destroy','null'],'method'=>'DELETE'])!!}
            <div class="modal-body">
            <h3>DESEA ELIMINAR ESTE CONSUMO</h3>
                <input type="hidden" id="id_con" name="id_con">
            </div>

            <div class="modal-footer">
        {!!Form::submit('ELIMINAR CONSUMO',['class'=>'btn btn-primary','id'=>'btn_guardar','onclick'=>'ucultar_boton()'])!!}
        {!!Form::close()!!}
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>

        </div>
    </div>
</div>
