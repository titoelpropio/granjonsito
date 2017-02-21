
  <div class="modal fade" id="myModalControl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="titulogalpon" class="modal-title" >AGREGAR VACUNA</h3>
      </div>
      <div class="modal-body">
    
      <input type="hidden" name="id_edad" id="id_edad">
    
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead align="center" bgcolor=black style="color: white">
          <td>EDAD</td>
          <td>VACUNA</td>
          <td>METODO DE APLICACION</td>
          <td>SELECIONAR</td>          
        </thead>
        <tbody id="datos_vacuna">
          
        </tbody>
      </table>

  </div>

      <div class="modal-footer">
      <button class="btn btn-primary" data-toggle='modal' data-target='#myModalConfirmar' onclick="confirmar_control_vacuna()" >VISTA PREVIA</button> 
      <input  type="button" id=""   data-dismiss="modal" value="CANCELAR" class="btn btn-danger " >
    
      </div>
    </div>
  </div>
</div>



<!--MODAL CONTROL VACUNA CONFIRMAR-->
<div class="modal fade" id="myModalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" > CONTROL VACUNA </h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
           
 {!!Form::open(array('url'=>'control_vacuna_2','method'=>'GET','autocomplete'=>'off'))!!}
 <input type="text" name="id_edad1" id="id_edad1">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead align="center" bgcolor=black style="color: white">
                <td>EDAD</td>
                <td>NOMBRE</td>
                <TD>METODO DE APLICACION</TD>
                </thead>

                
                <tbody id="confirmar_vacuna">
                
                </tbody>

            </table>
 
            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" id="btn_confirmar" onclick="ocultar_btn()" value="CONFIRMAR">  
{!!Form::close()!!}

                <button data-dismiss="modal"  class="btn btn-danger ">CANCELAR</button>
            </div>
        </div>
    </div>
</div>




<?php /*
  <!--div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
</div-->


<!--modal para el agregar vacuna y galpon personalisado-->
<!--div class="modal fade bd-example-modal-lg" id="myModalcreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
</div-->
*/ ?>