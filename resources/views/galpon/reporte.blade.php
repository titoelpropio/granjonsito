@extends ('layouts.admin')
@section ('content')

<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
          <div class="table-responsive">
            <div class="panel panel-green">
                <div class="panel-heading">
                      <ul class="nav nav-pills">
                      <li class="active"><a href="{!!URL::to('reporteponedoras')!!}">PONEDORAS</a></li>
                        <li class="active"><a href="{!!URL::to('reporteponedoras_fases')!!}">FASES</a></li>
                        <li class="active"><a href="{!!URL::to('reporte_comparacion')!!}">COMPARACION PONEDORAS</a></li>
                    </ul>
                </div> <br>

            <div class="pull-left"><h2 id="nombre"></h2></div>

            <div class="pull-right">    
                <button class="btn btn-info" onclick="detalle_galpon(0)"><i class="fa fa-search" aria-hidden="true"></i></button>        
                <button id="btnPDF" onclick="detalle_galpon_pdf(0)" class="btn btn-success"><i class="fa fa-file-text" aria-hidden="true"></i> PDF</button>
            </div>
            <div class="pull-right">
                {!!Form::select('id_galpon',[],null,['id'=>'id_galpon'])!!}  
            </div><br><br>

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead bgcolor=black style="color: white">
                        <th><center>ETAPA</center></th>
                        <th><center>GALPON</center></th>
                        <!--th><center>FECHA INICIO</center></th-->
                        <th><center>MUERTAS</center></th>
                        <th><center>HUEVOS</center></th>
                        <th><center>POSTURA</center></th>
                    </thead>
                    <tbody id="datos_r">
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
{!!Html::script('js/galpon.js')!!} 
@endsection
