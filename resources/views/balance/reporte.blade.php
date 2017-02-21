@extends ('layouts.admin')
@section ('content')
<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
  
    <div class="pull-left"><h1>REPORTE DE INGRESO Y EGRESO</h1></font></div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
        <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 15%; margin: 0px; padding: 0px">
          <button id="btnPDF" class="btn btn-success" onclick="cargar_fechas()"><i class="fa fa-file-text" aria-hidden="true"></i> PDF</button>
        </div>

        <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="width: 15%; margin: 0px; padding: 0px">
          <div class="form-group"> <button class="btn btn-danger" onclick="balance_egreso()">MOSTRAR</button>   </div>    
        </div>


        <div class="col-sm-3  col-md-3  col-sm-3 col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
          <div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
              <input type='text' class="form-control" id="fecha_fin" style="font-size:19px" />
              <span class="input-group-addon ">
                 <span class="fa fa-calendar" aria-hidden="true"></span> 
              </span>
            </div>
          </div>
        </div>

        <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="margin: 0px; padding: 0px">
          <div class="form-group">  <B>HASTA: </B> </div>
        </div>

        <div class="col-sm-3  col-md-3 col-sm-3 col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
          <div class="form-group">
            <div class='input-group date' id='datetimepicker2'>
              <input type='text' class="form-control" id="fecha_inicio" style="font-size:19px" />
              <span class="input-group-addon ">
                 <span class="fa fa-calendar" aria-hidden="true"></span> 
              </span>
            </div>
          </div>
        </div>

        <div class="col-sm-1 col-md-1  col-sm-1  col-xs-12 pull-right" style="margin: 0px; padding: 0px">
          <div class="form-group">  <B>DESDE: </B> </div>
        </div>
        </div>

            <!--div class="pull-left"><h1>REPORTE DE INGRESO Y EGRESO</h1></div>
            <div class="pull-right">            
                <B>DESDE: </B>  <font size=4><input type="date" id="fecha_inicio"></font>
                <B>HASTA: </B>  <font size=4><input type="date" id="fecha_fin"></font>
                <button class="btn btn-danger" onclick="balance_egreso()">MOSTRAR</button>
                <button id="btnPDF" class="btn btn-success" onclick="cargar_fechas()"><i class="fa fa-file-text" aria-hidden="true"></i> PDF</button>
            </div-->

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <H3>EGRESOS</H3>
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead bgcolor=black style="color: white">
                    <th><center>DETALLE</center></th>
                    <th><center>SALDO</center></th>
                </thead>
                <tbody id="datos_e">
                </tbody>
            </table>
  </div>       

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <H3>INGRESOS</H3>
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead bgcolor=black style="color: white">
                    <th><center>DETALLE</center></th>
                    <th><center>SALDO</center></th>
                </thead>
                <tbody id="datos_i">
                </tbody>
            </table>
  </div>       

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<table class="table table-striped table-bordered table-condensed table-hover">
<tr>
    <td>
 <div class="pull-right">
        <span id='total_egreso' hidden="true"></span>
        <span id='total_ingreso' hidden="true"></span>
        <font size="6">TOTAL: <span id='total_balance'></span> Bs.</font>
        </div>
    </td>
</tr>
</table>        
  </div>       
  
 
{!!Html::script('js/balance.js')!!} 
@endsection

