  <!--MODAL DAR DE BAJA-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"></div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_fase_galponb">
                <input type="hidden" id="nombre_b">  
                <input type="hidden" id="id_edad_b">  
                {!!Form::hidden('null',null,['id'=>'idgalponb','class'=>'form-control'])!!}
                <center><h3 id="titulo" class="modal-title" ></h3></center>
            </div>

            <div class="modal-footer">
                <button id="baja" onclick="dardebaja()" class="btn btn-primary">ACEPTAR</button>
                <button data-dismiss="modal"  class="btn btn-danger ">CANCELAR</button>
            </div>
        </div>
    </div>
</div>


<!--MODAL AUMENTAR GALLINAS-->
<div class="modal fade" id="myModal_aumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulo_a" class="modal-title" ></h3> 
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_fase_galpon_a">
                <input type="hidden" id="nombre_a">  
                <input type="hidden" id="cantidad_actual_a">  
                <b>INTRODUSCA LAS CANTIDAD DE GALLINAS:</b>
                <input type="number" id="aumento_a" class="form-control" onkeypress="return bloqueo_de_punto(event)" style="font-size:20px">

            </div>

            <div class="modal-footer">
                <button onclick="aumentar_gallinas()" class="btn btn-primary" id="btnaumentar">ACEPTAR</button>
                <button data-dismiss="modal"  class="btn btn-danger" onclick="limpiar()">CANCELAR</button>
            </div>
        </div>
    </div>
</div>


<!--modal guardar-->

<div class="modal fade" id="myModalcreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" > REGISTRAR EDAD </h3>
            </div>
            <div class="modal-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
           

            <!--div class="form-group">
                {!!Form::label('fecha_inicio','Fecha Ingreso:')!!}
                {!!Form::date('fecha_inicio',null,['id'=>'fecha_inicio','class'=>'form-control'])!!}
            </div-->

            <div class="form-group">
                {!!Form::label('fecha_inicio','Fecha Ingreso:')!!}
                <div class='input-group date' id='datetimepicker10'>
                  <input type='text' class="form-control" id="fecha_inicio" name="fecha_inicio" style="font-size:20px;text-align:left" />
                  <span class="input-group-addon ">
                     <span class="fa fa-calendar" aria-hidden="true"></span>  <!--span class="glyphicon glyphicon-calendar"></span-->
                  </span>
                </div>
            </div>

            <div class="form-group">
                {!!Form::label('id','Fase:')!!}
                {!!Form::select('id',$fases,null,array('id'=>'id_fase','class'=>'form-control'))!!}
            </div>

            <div class="form-group">
                {!!Form::label('id_galpon','Galpon:')!!}
                {!!Form::select('id_galpon',[],null,['id'=>'id_galpon'])!!}
            </div>

            <div class="form-group">
                {!!Form::label('cantidad_inicial','Cantidad Inicial: ')!!}
                {!!Form::text('cantidad_inicial',null,['id'=>'cantidad_inicial','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Inicial','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
            </div>
            
            <div class="form-group">
                {!!Form::label('cantidad_actual','Cantidad Actual: ')!!}
                {!!Form::text('cantidad_actual',null,['id'=>'cantidad_actual','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Actual','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
            </div>

            <div class="form-group">
                {!!Form::label('total_muerta','Total Muerta: ')!!}
                {!!Form::text('total_muerta',null,['id'=>'total_muerta','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Actual','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
            </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="crearedad()" id="btnregistrar">REGISTRAR</button>      
                <button data-dismiss="modal"  class="btn btn-danger" onclick="limpiar()">CANCELAR</button>
            </div>
        </div>
    </div>
</div>


<!--modal actualizar-->
<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" > ACTUALIZAR EDAD </h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_edad">      <input type="hidden" id="id_fases">     <input type="hidden" id="id_fase_galpon"> 
                
                <div class="form-group">
                    {!!Form::label('id_fase','Fases:')!!}
                    {!!Form::select('id_fasea',[],null,['id'=>'id_fasea'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('id_galpon','Galpon:')!!}
                    {!!Form::select('id_galpons',[],null,['id'=>'id_galpons'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('cantidad_inicial','Cantidad inicial:')!!}
                    {!!Form::text('cantidad_inicials',null,['id'=>'cantidad_inicials','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Incial','onkeypress'=>'return bloqueo_de_punto(event)'])!!}

                </div>

                <div class="form-group">
                    {!!Form::label('cantidad_actual','Cantidad Actual:')!!}
                    {!!Form::text('cantidad_actuals',null,['id'=>'cantidad_actuals','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Actual','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('total_muerta','Total Muerta:')!!}
                    {!!Form::text('total_muertas',null,['id'=>'total_muertas','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Actual','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('fecha_inicio','Fecha Inicio:')!!}
                    <div class='input-group date' id='datetimepicker10a'>
                      <input type='text' class="form-control" id="fecha_inicios" name="fecha_inicios" style="font-size:15px;text-align:left" />
                      <span class="input-group-addon ">
                         <span class="fa fa-calendar" aria-hidden="true"></span>  <!--span class="glyphicon glyphicon-calendar"></span-->
                      </span>
                    </div>

                    <?php //{!!Form::date('fecha_inicios',null,['id'=>'fecha_inicios','class'=>'form-control'])!!} ?>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="actualizaredad()" id="btnactualizar">ACTUALIZAR</button>      
                <button data-dismiss="modal"  class="btn btn-danger ">CANCELAR</button>
            </div>
        </div>
    </div>
</div>


<!--modal TRASPASO-->

<div class="modal fade" id="myModalTraspaso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" > TRASPASO </h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_edadt">      <input type="hidden" id="id_fasest">   <input type="hidden" id="id_galpont">   <input type="hidden" id="id_fase_galpont"> 
            <div class="col-lg-6 col-sm-6 col-xs-12" >
                <div class="form-group">
                    {!!Form::label('nombre','Fase Actual:')!!}
                    {!!Form::text('nombret',null,['id'=>'nombret','class'=>'form-control','readonly'])!!}
                </div>
            </div>                
            <div class="col-lg-6 col-sm-6 col-xs-12" >                      
                <div class="form-group">
                    {!!Form::label('id_fase','Fase Siguiente:')!!}
                    {!!Form::select('id_faset',[],null,['id'=>'id_faset'])!!}
                </div>
            </div> 

                <div class="form-group">
                    {!!Form::label('cantidad_actual','Cantidad actual:')!!}
                    {!!Form::text('cantidad_actualt',null,['id'=>'cantidad_actualt','class'=>'form-control','placeholder'=>'Ingrese La Cantidad Actual','onkeypress'=>'return bloqueo_de_punto(event)'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('fecha_fin','Fecha Salida:')!!}
                    <div class='input-group date' id='datetimepicker10t'>
                      <input type='text' class="form-control" id="fecha_fint" name="fecha_fint" style="font-size:15px;text-align:left" />
                      <span class="input-group-addon ">
                         <span class="fa fa-calendar" aria-hidden="true"></span>  <!--span class="glyphicon glyphicon-calendar"></span-->
                      </span>
                    </div>
                    <?php  //{!!Form::date('fecha_fint',null,['id'=>'fecha_fint','class'=>'form-control'])!!}?>
                </div>             
 
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" id="btntraspaso" onclick="CrearTraspaso()" >TRASPASAR</button>      
                <button data-dismiss="modal"  class="btn btn-danger ">CANCELAR</button>
            </div>
        </div>
    </div>
</div>



<!--MODAL CONTROL VACUNA-->

<div class="modal fade" id="myModalControl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" > CONTROL VACUNA </h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
           
 
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead align="center" bgcolor=black style="color: white">
                <td>EDAD</td>
                <td>NOMBRE</td>
                <TD>METODO DE APLICACION</TD>
                <TD>SELECCIONAR</TD>
                </thead>
                
                <tbody id="datos_vacuna">
                
                </tbody>

            </table>
 
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-toggle='modal' data-target='#myModalConfirmar' onclick="confirmar_control_vacuna()" >VISTA PREVIA</button>    
                <button data-dismiss="modal"  class="btn btn-danger ">CANCELAR</button>
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
           
 {!!Form::open(array('url'=>'control_vacuna','method'=>'POST','autocomplete'=>'off'))!!}
 <input type="hidden" name="id_edad1" id="id_edad1">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead align="center" bgcolor=black style="color: white">
                <td>EDAD</td>
                <td>NOMBRE</td>
                <TD>METODO DE APLICACION</TD>
                <TD>SELECCIONAR</TD>
                </thead>

                
                <tbody id="confirmar_vacuna">
                
                </tbody>

            </table>
 
            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="CONFIRMAR">  
{!!Form::close()!!}

                <button data-dismiss="modal"  class="btn btn-danger ">CANCELAR</button>
            </div>
        </div>
    </div>
</div>


<!--MODAL CONTROL DE VACUNAS-->
<div class="modal fade" id="myModal_Vacunas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="titulogalpon" class="modal-title" > CONTROL VACUNA </h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead align="center" bgcolor=black style="color: white">
                <td>EDAD</td>
                <td>NOMBRE</td>
                <TD>METODO DE APLICACION</TD>
                <TD>ESTADO</TD>
                </thead>

                
                <tbody id="vacunas">
                
                </tbody>

            </table>
 
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal"  class="btn btn-danger ">SALIR</button>
            </div>
        </div>
    </div>
</div>