@extends ('layouts.admin')
@section ('content')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('message')}}
</div>
@endif


<div class="alert alert-danger alert-dismissible" role="alert" hidden="true" id="mensaje">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>

</div>
@include('alimentocriarecria.modal')
<div class="row" style="height: 100%">  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">  
            <div class="panel panel-green">
                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="{!!URL::to('criarecria')!!}">GALPONES CRIA</a></li>
                        <li class="active"><a href="{!!URL::to('alimentocria')!!}">ALIMENTO CRIA</a></li>
                    </ul>
                </div>
                <table border=1 cellpadding=0 cellspacing=0 class="table-striped  table-condensed table-hover" style="width: 100%;height: 350px">
                    <tr height=20 style='height:15.0pt; background-color: orange'>
                        <td height=20 class=xl65 style='height:15.0pt; width: 6.7%'>GALPON Nro.</td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon17">FASE 1</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon18">GALPON 18</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon19">GALPON 19</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon20">GALPON 22</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon21">GALPON 23</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon22">GALPON 24</span></td>
                        <!--td colspan=6 align=center class=xl74 width=11.62% >GALPON 7</td>
                        <td colspan=6 align=center class=xl74 width=11.62% >GALPON 8</td-->
                    </tr>

                    <tr height=20 style='height:15.0pt'>
                        <td height=20 class=xl76 style='height:15.0pt'>EDAD GALLINA</td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[0],null,['id'=>'edadg17'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[1],null,['id'=>'edadg18'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[2],null,['id'=>'edadg19'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[3],null,['id'=>'edadg20'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[4],null,['id'=>'edadg21'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[5],null,['id'=>'edadg22'])!!}</font></td>
                    </tr>
                    <!--tr height=20 style='height:15.0pt'>
                     <td height=20 class=xl76 style='height:15.0pt'>CANTIDAD
                     INICIAL<span style='mso-spacerun:yes'> </span></td>
                     <td colspan=6 align=center class=xl75>1934</td>
                     <td colspan=6 align=center class=xl75>1953</td>
                     <td colspan=6 align=center class=xl75>1899</td>
                     <td colspan=6 align=center class=xl75>1901</td>
                    </tr>
                    <tr height=20 style='height:15.0pt'>
                     <td height=20 class=xl76 style='height:15.0pt'>MUERTAS</td>
                     <td colspan=6 align=center class=xl75>66</td>
                     <td colspan=6 align=center class=xl75>47</td>
                     <td colspan=6 align=center class=xl75>101</td>
                     <td colspan=6 align=center class=xl75>99</td>
                    </tr-->
                    <tr height=20 style='height:15.0pt'>
                        <td height=20 class=xl77 style='height:15.0pt'>TOTAL GALLINA<span
                                style='display:none'>S</span></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[0],null,['id'=>'cantidadg17'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[1],null,['id'=>'cantidadg18'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[2],null,['id'=>'cantidadg19'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[3],null,['id'=>'cantidadg20'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[4],null,['id'=>'cantidadg21'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[5],null,['id'=>'cantidadg22'])!!}</font></td>                  
                    </tr>

                    <tr height=28 style='height:21.0pt'>
                        <td height=57 class=xl78 style='height:42.75pt'>FECHA</td>
                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{!!Form::label($tipo[0],null,['id'=>'tipo1'])!!}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 17</td>


                        <td colspan="3" class=xl89 align=center style='border-top:none'><font size=3>{!!Form::label($tipo[1],null,['id'=>'tipo1'])!!}</font></td>
                        <td colspan=3 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 18</td>

                        <td colspan="2" class=xl93 align=center style='border-top:none'><font size=3>{!!Form::label($tipo[2],null,['id'=>'tipo1'])!!}</font></td>
                        <td colspan=4 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 19</td>

                        <td colspan="3" class=xl89 align=center style='border-top:none'><font size=3>{!!Form::label($tipo[3],null,['id'=>'tipo1'])!!}</font></td>
                        <td colspan=3 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 20</td>

                        <td colspan="3" class=xl87 align=center style='border-top:none;border-left:none'><font size=3>{!!Form::label($tipo[4],null,['id'=>'tipo1'])!!}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 21</td>


                        <td colspan="2" class=xl89 align=center style='border-top:none'><font size=3>{!!Form::label($tipo[5],null,['id'=>'tipo1'])!!}</font></td>
                        <td colspan=4 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 22</td>
                    </tr>

                    <tr height=20 style='height:15.0pt'>
                        <td height=20 class=xl96 style='height:15.0pt'>{!!Form::label($fecha,null,['id'=>'fecha'])!!}</td>
                        <td colspan=3 class=xl97 align=center style='border-top:none'><font size=3>{!!Form::label($cantidad_c[0],null,['id'=>'PREg1'])!!} Kg.</font></td>

                        <td colspan=3 class=xl99 align=center style='border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatoscria(17)' id="btnalimentog17">ALIMENTAR</button></td>


                        <td colspan="3" align=center style='border-left:none'><font size=4>{!!Form::label($cantidad_c[1],null,['id'=>'G5g2'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatoscria(18)' id="btnalimentog18">ALIMENTAR</button></td>


                        <td colspan="2" align=center style='border-top:none;border-left:none'><font size=4>{!!Form::label($cantidad_c[2],null,['id'=>'G5g3'])!!} Kg.</font></td>
                        <td colspan=4 align=center class=xl103 align=center style='border-top:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatoscria(19)' id="btnalimentog19">ALIMENTAR</button></td>


                        <td colspan="3" align=center style='border-left:none'><font size=4>{!!Form::label($cantidad_c[3],null,['id'=>'G5g4'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatoscria(20)'  id="btnalimentog20">ALIMENTAR</button></td>


                        <td colspan="3" align=center style='border-top:none'><font size=4>{!!Form::label($cantidad_c[4],null,['id'=>'G5g5'])!!} Kg.</font></td>
                        <td colspan=3 class=xl99 align=center style='border-top:none;border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatoscria(21)' id="btnalimentog21">ALIMENTAR</button></td>


                        <td colspan="2" align=center style='border-left:none'><font size=4>{!!Form::label($cantidad_c[5],null,['id'=>'G5g6'])!!} Kg.</font></td>
                        <td colspan=4 class=xl103 align=center style='border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatoscria(22)' id="btnalimentog22">ALIMENTAR</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
{!!Html::script('js/alimentocriarecria.js')!!} 
@endsection