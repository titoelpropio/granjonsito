<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        {!!Form::open(['route'=>['compra.destroy','null'],'method'=>'DELETE'])!!}
            <div class="modal-body">
                    <CENTER><H2>DESEA ANULAR ESTA COMPRA</H2></CENTER>
                    <input type='hidden' class="form-control" id="id_compra" name="id_compra"/>
            </div>
                
            <div class="modal-footer">
               {!!Form::submit('ANULAR COMPRA',['class'=>'btn btn-primary'])!!}
        {!!Form::close()!!}
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>
            </div>
            
        </div>
    </div>

