<!--ACTUALIZAR CONSIUMO VACUNA-->
<div class="modal fade" id="ModalActualizarConsumoVacuna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" >ACTUALIZAR CONSUMO VACUNA</h3> 
            </div>

            <div class="modal-body">
      {!!Form::open(['route'=>['consumo_vacuna.update','null'],'method'=>'PUT'])!!}      

                <input type="hidden" id="id_con_vac" name="id_con_vac">

                <div class="form-group">
                    {!!Form::label('cantidad','CANTIDAD:')!!}
                    <input type="number" id="cantidad_con_vac" name="cantidad_con_vac" class="form-control" onkeypress="return bloqueo_de_punto(event)" onkeyup="calcular_con_vac()">
                </div>

                <div class="form-group">
                    {!!Form::label('precio','PRECIO:')!!}
                    <input type="text" id="precio_con_vac" name="precio_con_vac" class="form-control" onkeypress="return numerosmasdecimal(event)">
                </div>
                <input type="hidden" id="precio_aux">

            </div>

            <div class="modal-footer">
                {!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary','id'=>'btn_consumir'])!!}            
            {!!Form::close()!!}                
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>

        </div>
    </div>
</div>

<!--ELIMINAR CONSIUMO VACUNA-->
<div class="modal fade" id="ModalEliminarConsumoVacuna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
      {!!Form::open(['route'=>['consumo_vacuna.destroy','null'],'method'=>'DELETE'])!!}      

                <input type="hidden" id="id_con_vac_eli" name="id_con_vac_eli">
                <H3>DESEA ELIMINAR ESTE CONSUMO VACUNA</H3>
        
            </div>

            <div class="modal-footer">
                {!!Form::submit('ACEPTAR',['class'=>'btn btn-primary','id'=>'btn_consumir_eli','onclick'=>'esconder()'])!!}            
            {!!Form::close()!!}                
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>

        </div>
    </div>
</div>

<!--CONSIUMO VACUNA EMERGENTE-->
<div class="modal fade" id="ModalActualizarConsumoEmergente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" >ACTUALIZAR CONSUMO VACUNA EMERGENTE</h3>
            </div>

            <div class="modal-body">
      {!!Form::open(['route'=>['consumo_vacuna_emergente.update','null'],'method'=>'PUT'])!!}      


                <input type="hidden" id="id_con_vac_emer" name="id_con_vac_emer">

                <div class="form-group">
                    {!!Form::label('cantidad','CANTIDAD:')!!}
                    <input type="number" id="cantidad_con_vac_emer" name="cantidad_con_vac_emer" class="form-control" onkeypress="return bloqueo_de_punto(event)" onkeyup="calcular_con_vac_emer()">
                </div>

                <div class="form-group">
                    {!!Form::label('precio','PRECIO:')!!}
                    <input type="text" id="precio_con_vac_emer" name="precio_con_vac_emer" class="form-control" onkeypress="return numerosmasdecimal(event)">
                </div>
                <input type="hidden" id="precio_aux_emer">

            </div>

            <div class="modal-footer">
                {!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary','id'=>'btn_consumir_emer'])!!}                                        
            {!!Form::close()!!}            
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>

        </div>
    </div>
</div>

<!--ELIMINAR CONSIUMO VACUNA EMERGENTE-->
<div class="modal fade" id="ModalEliminarConsumoVacunaEmergente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
      {!!Form::open(['route'=>['consumo_vacuna_emergente.destroy','null'],'method'=>'DELETE'])!!}      

                <input type="hidden" id="id_con_vac_emer_eli" name="id_con_vac_emer_eli">
                <H3>DESEA ELIMINAR ESTE CONSUMO VACUNA</H3>
        
            </div>

            <div class="modal-footer">
                {!!Form::submit('ACEPTAR',['class'=>'btn btn-primary','id'=>'btn_consumir_emer_eli','onclick'=>'esconder()'])!!}            
            {!!Form::close()!!}                
                {!!link_to('#', $title='CANCELAR', $attributes = ['id'=>'cancelar','data-dismiss'=>'modal', 'class'=>'btn btn-danger'], $secure = null)!!}
            </div>

        </div>
    </div>
</div>