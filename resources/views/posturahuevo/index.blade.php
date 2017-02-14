
@extends ('layouts.admin')
@section ('content')
@include('alerts.request')

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
@include('posturahuevo.modal')
<div class="row" style="height: 100%">  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">  
            <div class="panel panel-green">
                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="{!!URL::to('galpon')!!}">GALPONES</a></li>
                        <li class="active"><a href="{!!URL::to('alimentop')!!}">ALIMENTO PONEDORAS</a></li>
                    </ul>
                </div>
                <style>
                    #oculto{visibility:hidden};
                </style>
                <table border=1 cellpadding=0 cellspacing=0 class="table-striped  table-condensed table-hover" style="width: 100%;height: 350px">
                    <tr height=20 style='height:15.0pt; background-color: orange'>
                        <td height=20 class=xl65 style='height:15.0pt; width: 6.7%'>GALPON Nro.</td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon1">GALPON 1</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon2">GALPON 2</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon3">GALPON 3</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon4">GALPON 4</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon5">GALPON 5</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon6">GALPON 6</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon7">GALPON 7</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon8">GALPON 8</span></td>
                    </tr>

                    <tr height=20 style='height:15.0pt'>
                        <td height=20 class=xl76 style='height:15.0pt'>EDAD GALLINA</td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[0],null,['id'=>'edadg1'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[1],null,['id'=>'edadg2'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[2],null,['id'=>'edadg3'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[3],null,['id'=>'edadg4'])!!}</font></td>


                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[4],null,['id'=>'edadg5'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[5],null,['id'=>'edadg6'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[6],null,['id'=>'edadg7'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[7],null,['id'=>'edadg8'])!!}</font></td>
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
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[0],null,['id'=>'cantidadg1'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[1],null,['id'=>'cantidadg2'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[2],null,['id'=>'cantidadg3'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[3],null,['id'=>'cantidadg4'])!!}</font></td>


                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[4],null,['id'=>'cantidadg5'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[5],null,['id'=>'cantidadg6'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[6],null,['id'=>'cantidadg7'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[7],null,['id'=>'cantidadg8'])!!}</font></td>                    
                    </tr>

                    <tr height=28 style='height:21.0pt'>
                        <td height=57 class=xl78 style='height:42.75pt'>FECHA</td>
                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[0]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2% title="1">GALPON 1</td>


                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[1]}}</font></td>
                        <td colspan=3 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 2</td>

                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[2]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 3</td>

                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[3]}}</font></td>
                        <td colspan=3 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 4</td>


                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[4]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 5</td>


                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[5]}}</font></td>
                        <td colspan=3 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 6</td>

                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[6]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 7</td>

                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[7]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 8</td>

                    </tr>

                    <tr height=20 style='height:15.0pt'>
                        <td height=20 class=xl96 style='height:15.0pt' align=center><font size=2>{!!Form::label($fecha,null,['id'=>'fecha'])!!}</font></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[0],['id'=>'G5g1'])!!} Kg.</font></td>

                        <td colspan=3 class=xl99 align=center style='border-top:none;border-left:none'> <input type="button" class='btn btn-primary' data-toggle='modal' data-target='#myModal'  onclick='obtenerdatos(1)'  id="btnalimentog1" value="ALIMENTAR">
                            <input type="hidden" value="1" id="hola">
                            <input type="hidden" value="1" id="hola1">
                        </td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[1],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(2)'  id="btnalimentog2" >ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[2],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 align=center class=xl103 align=center style='border-top:none;border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal'  id="btnalimentog3" onclick='obtenerdatos(3)'>ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[3],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'> <button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(4)' id="btnalimentog4" >ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[4],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl99 align=center style='border-top:none;border-left:none'> <button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(5)' id="btnalimentog5" >ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[5],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'> <button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(6)' id="btnalimentog6" >ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[6],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-top:none;border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(7)' id="btnalimentog7" >ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[7],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(8)' id="btnalimentog8" >ALIMENTAR</button></td>
                    </tr>
                </table>

                <br>  <br> 

                <table border=1 cellpadding=0 cellspacing=0 class="table-striped  table-condensed table-hover" style="width: 100%;height: 350px" id="tablagalpon2">
                    <tr height=20 style='height:15.0pt; background-color: orange'>
                        <td height=20 class=xl65 style='height:15.0pt; width: 6.7%'>GALPON Nro.</td>
                        <td colspan=6 align=center class=xl74 ; width=11.62% ><span id="galpon9">GALPON 9</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon10">GALPON 10</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon11">GALPON 11</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon12">GALPON 12</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon13">GALPON 13</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon14">GALPON 14</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon15">GALPON 15</span></td>
                        <td colspan=6 align=center class=xl74 width=11.62% ><span id="galpon16">GALPON 16</span></td>
                    </tr>

                    <tr height=20 style='height:15.0pt'>
                        <td height=20 class=xl76 style='height:15.0pt'>EDAD GALLINA</td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[8],null,['id'=>'edadg9'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[9],null,['id'=>'edadg10'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[10],null,['id'=>'edadg11'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[11],null,['id'=>'edadg12'])!!}</font></td>


                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[12],null,['id'=>'edadg13'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[13],null,['id'=>'edadg14'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[14],null,['id'=>'edadg15'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($edad[15],null,['id'=>'edadg16'])!!}</font></td>
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
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[8],null,['id'=>'cantidadg9'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[9],null,['id'=>'cantidadg10'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[10],null,['id'=>'cantidadg11'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[11],null,['id'=>'cantidadg12'])!!}</font></td>


                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[12],null,['id'=>'cantidadg13'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[13],null,['id'=>'cantidadg14'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[14],null,['id'=>'cantidadg15'])!!}</font></td>
                        <td colspan=6 align=center class=xl75><font size=4>{!!Form::label($cantidad_actual[15],null,['id'=>'cantidadg16'])!!}</font></td>                    
                    </tr>

                    <tr height=28 style='height:21.0pt'>
                        <td height=57 class=xl78 style='height:42.75pt'>FECHA</td>
                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[8]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2% title="1">GALPON 9</td>


                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[9]}}</font></td>
                        <td colspan=3 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 10</td>

                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[10]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 11</td>

                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[11]}}</font></td>
                        <td colspan=3 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 12</td>


                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[12]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 13</td>


                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[13]}}</font></td>
                        <td colspan=3 class=xl91 align=center style='border-top:none;border-left:none' width=2%>GALPON 14</td>

                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[14]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 15</td>

                        <td colspan=3 height=29 align=center class=xl85 style='height:21.75pt;border-top:none'><font size=3>{{$tipo[15]}}</font></td>
                        <td colspan=3 class=xl87 align=center style='border-top:none;border-left:none' width=2%>GALPON 16</td>

                    </tr>

                    <tr height=20 style='height:15.0pt'>
                        <td height=20 class=xl96 style='height:15.0pt'  align=center><font size="2">{!!Form::label($fecha,null,['id'=>'fecha'])!!}</font></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[8],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl99 align=center style='border-top:none;border-left:none'> <input type="button" class='btn btn-primary' data-toggle='modal' data-target='#myModal'  onclick='obtenerdatos(9)'  id="btnalimentog9" value="ALIMENTAR">                    </td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[9],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(10)'  id="btnalimentog10">ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[10],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 align=center class=xl103 align=center style='border-top:none;border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(11)'  id="btnalimentog11">ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[11],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'> <button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(12)'  id="btnalimentog12">ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[12],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl99 align=center style='border-top:none;border-left:none'> <button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(13)'  id="btnalimentog13">ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[13],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'> <button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(14)'  id="btnalimentog14">ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[14],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-top:none;border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(15)'  id="btnalimentog15">ALIMENTAR</button></td>
                        <td colspan=3 align=center style='border-top:none'><font size=3>{!!Form::label(null,$cantidadc[15],['id'=>'G5g1'])!!} Kg.</font></td>
                        <td colspan=3 class=xl103 align=center style='border-left:none'><button class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='obtenerdatos(16)' id="btnalimentog16">ALIMENTAR</button></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
<script src="{{asset('js/alimentop.js')}}"></script> 
@endsection
