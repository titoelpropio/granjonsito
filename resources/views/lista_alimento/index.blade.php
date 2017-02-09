@extends ('layouts.admin2')
@section ('content')
@include('alerts.cargando')
<?php $cont = 0;$x=1; $x2=9; $x3=1; 
$cantidad=0;
$alimento="";
$id=0;
$cantidad_granel=0;
$contador_consumo_cria=0;//cuenta el array consumo para desactivar el boton control alimento
$total_consumo_cria=count($consumo_cria);
$contador_consumo=0;//cuenta el array consumo para desactivar el boton control alimento
$total_consumo=count($consumo);
$contador_consumo2=0;//cuenta el array consumo para desactivar el boton control alimento
$total_consumo2=count($consumo2);
?>
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive">	
<br>
<div class="pull-left"><h1>GALPONES</h1> </div>      
<div class="pull-right"><font size="5">TEMPERATURA: <span id="temperatura">{{$temperatura[0]->temperatura}}</span> ºC</font>  <a href="lista_alimento" class="btn btn-primary" style="height:50px; font-size: 30px">ACTUALIZAR</a></div>

<table border=1 class="table-striped  table-condensed table-hover" style="width: 100%" id="tablagalpon">
<tr height=27 style='height:20.25pt'>
  @foreach($galpon as $gal) <?php 
  $control=DB::select("SELECT control_alimento.id as id_control ,cantidad,tipo FROM control_alimento,rango_edad,rango_temperatura,alimento WHERE control_alimento.id_temperatura=rango_temperatura.id and  control_alimento.id_edad= rango_edad.id and control_alimento.id_alimento=alimento.id and control_alimento.deleted_at IS NULL and rango_edad.edad_min<=".$gal->edad." and rango_edad.edad_max>=".$gal->edad." and rango_temperatura.temp_min<=".$temperatura[0]->temperatura."  and rango_temperatura.temp_max>=".$temperatura[0]->temperatura); 
  
  for ($i=$x; $i <=$gal->numero;  $i++) { 
    if (count($control)!=0) {
      $cantidad=$control[0]->cantidad*$gal->cantidad_actual;
      $alimento=$control[0]->tipo;
      $id=$control[0]->id_control;
      $cantidad_granel=$control[0]->cantidad;
    } else{
      $cantidad=0;
      $alimento="";
    }
    if ($i!=$gal->numero) { echo " <td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%; background-color:#f6cece'><font size=5>VACIO</font></td>"; } 
    else{ 
      if (count($consumo)==0) {
        echo "<td colspan=2 align='center' class=xl83 style='border-left:none;width:10.75%;background-color:#cef6f5'><font size=5>GALPON ".$gal->numero."</font><br><br><font size=2>ALIMENTO: </font><font size=3><span data-status=1 id=id_alimento".$gal->numero.">".$alimento."</span></font><br><br>
        <font size=2>CANTIDAD: </font><font size=3><span id=cantidad_g".$gal->numero.">".$cantidad."</span> kg.</font> <br>
        <span hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span> <br>
        <span hidden id='cant_actual".$gal->numero."'>". $gal->cantidad_actual."</span> </td> ";
      } else {
        if ($consumo[$contador_consumo]->numero_galpon==$gal->numero) {
          echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%; background-color:orange'><font size=5>GALPON ".$gal->numero." </font><br>
          <font size=4><span >ALIMENTADO CON</span></font> <br><br>
          <font size=2>ALIMENTO: </font><font size=3><span data-status=0  id=id_alimento".$gal->numero.">".$consumo[$contador_consumo]->tipo."</span></font> <br>
          <font size=2>CANTIDAD: </font> <font size=3><span id=cantidad_g".$gal->numero.">".$consumo[$contador_consumo]->cantidad."</span> kg.</font><br>
          <span  hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span>
          <span  hidden id='cant_actual".$gal->numero."'>". $gal->cantidad_actual."</span> </td> ";
          if ($total_consumo-1>$contador_consumo) {
            $contador_consumo++;
          } 
        } else {
          echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%; background-color:#cef6f5'><font size=5>GALPON ".$gal->numero." </font><br><br>
          <font size=2>ALIMENTO: </font><font size=3><span data-status=1 id=id_alimento".$gal->numero.">". $alimento."</span></font> <br><br>
          <font size=2>CANTIDAD: </font> <font size=3><span id=cantidad_g".$gal->numero.">".$cantidad."</span> kg.</font> 
          <span hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span> <br>
          <span hidden id='cant_actual".$gal->numero."'>". $gal->cantidad_actual."</span> </td> ";
        }
      }
    }
  } $x=$gal->numero+1; ?> 
  @endforeach   <?php  
  for ($i=$x; $i <9 ; $i++) { 
    echo "<td colspan=2 align='center' class=xl83 style='border-left:none;width:10.75%;background-color:#f6cece'><font size=5>GALPON ".$i."</font></td>";
  }   $x=1;  ?> 
</tr> 
</table>    


<!--TABLA2-->

<?php 
$contador=DB::select("SELECT COUNT(*)as contador from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre='PONEDORA' and edad.estado=1 and galpon.numero>8");
if ($contador[0]->contador != 0 ) { ?>

<table border=1 class="table-striped  table-condensed table-hover" style=" width: 100%" id="tablagalpon">
<tr height=27 style='height:20.25pt'>
  @foreach($galpon2 as $gal) <?php 
    $control=DB::select("SELECT control_alimento.id as id_control ,cantidad,tipo FROM control_alimento,rango_edad,rango_temperatura,alimento WHERE control_alimento.id_temperatura=rango_temperatura.id and  control_alimento.id_edad= rango_edad.id and control_alimento.id_alimento=alimento.id and control_alimento.deleted_at IS NULL and rango_edad.edad_min<=".$gal->edad." and rango_edad.edad_max>=".$gal->edad." and rango_temperatura.temp_min<=".$temperatura[0]->temperatura."  and rango_temperatura.temp_max>=".$temperatura[0]->temperatura); 

  for ($i=$x2; $i <=$gal->numero;  $i++) { 
    if (count($control)!=0) {
      $cantidad=$control[0]->cantidad*$gal->cantidad_actual;
      $alimento=$control[0]->tipo;
      $id=$control[0]->id_control;
      $cantidad_granel=$control[0]->cantidad;
    } else{
      $cantidad=0;
      $alimento="";
    }
    if ($i!=$gal->numero) { echo " <td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%; background-color:#f6cece'><font size=5>VACIO</font></td>"; } 
    else{ 
      if (count($consumo2)==0) {
        echo "<td colspan=2 align='center'class=xl83 style='border-left:none;width:10.75%; background-color:#cef6f5'><font size=5>GALPON ".$gal->numero." </font><br><br><font size=2>ALIMENTO: </font><font size=3><span data-status=1 id=id_alimento".$gal->numero.">".$alimento."</span></font><br><br>
        <font size=2>CANTIDAD: </font> <font size=3><span data-status=1  id=cantidad_g".$gal->numero.">".$cantidad."</span> kg.</font><br>
        <span  hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span>
        <span  hidden id='cant_actual".$gal->numero."'>". $gal->cantidad_actual."</span> </td> ";
      } else {
        if ($consumo2[$contador_consumo2]->numero_galpon==$gal->numero) {
          echo "<td colspan=2 align='center' class=xl83 style='border-left:none;width:10.75%;background-color:orange'><font size=5>GALPON ".$gal->numero."</font><br> <font size=4><span >ALIMENTADO CON</span></font> <br><br>
          <font size=2>ALIMENTO: </font><font size=3><span data-status=0 id=id_alimento".$gal->numero.">".$consumo2[$contador_consumo2]->tipo."</span></font><br>
          <font size=2>CANTIDAD: </font><font size=3><span id=cantidad_g".$gal->numero.">".$consumo2[$contador_consumo2]->cantidad."</span> kg.</font><br>
          <span hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span>
          <span hidden id='cant_actual".$gal->numero."'>". $gal->cantidad_actual."</span> </td> ";
          if ($total_consumo2-1>$contador_consumo2) {
            $contador_consumo2++;
          }   
        } else {
          echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%; background-color:#cef6f5'><font size=5>GALPON ".$gal->numero."</font><br><br>
          <font size=2>ALIMENTO: </font><font size=3><span data-status=1 id=id_alimento".$gal->numero.">". $alimento."</span></font><br><br>
          <font size=2>CANTIDAD: </font> <font size=3><span data-status=1 id=cantidad_g".$gal->numero.">". $cantidad."</span> kg.</font><br>
          <span hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span>
          <span hidden id='cant_actual".$gal->numero."'>". $gal->cantidad_actual."</span> </td> ";
        }
      }
    }
  } $x2=$gal->numero+1; ?> 
  @endforeach   <?php  
  for ($i=$x2; $i <17 ; $i++) { 
    echo " <td colspan=2 align='center' class=xl83 style='border-left:none;width:10.75%;background-color:#f6cece'><font size=5>GALPON ".$i."</font></td>";
  }   $x2=9;  ?> 
</tr> 
</table>
<?php 
}
?>

<br><!--TABLA3--><br>

<div class="pull-left"><h1>FASES</h1></div>
<table border=1 class="table-striped  table-condensed table-hover" style=" width: 100%" id="tablagalpon">
<tr height=27 style='height:20.25pt'>
  @foreach($cria_recria as $gal) <?php 
    $control=DB::select("SELECT control_alimento.id as id_control ,cantidad,tipo FROM control_alimento,rango_edad,rango_temperatura,alimento WHERE control_alimento.id_temperatura=rango_temperatura.id and  control_alimento.id_edad= rango_edad.id and control_alimento.id_alimento=alimento.id and control_alimento.deleted_at IS NULL and rango_edad.edad_min<=".$gal->edad." and rango_edad.edad_max>=".$gal->edad." and rango_temperatura.temp_min<=".$temperatura[0]->temperatura."  and rango_temperatura.temp_max>=".$temperatura[0]->temperatura); 

  for ($i=$x3; $i <=$gal->numero_fase;  $i++) { 
    if (count($control)!=0) {
      $cantidad=$control[0]->cantidad*$gal->cantidad_actual;
      $alimento=$control[0]->tipo;
      $id=$control[0]->id_control;
      $cantidad_granel=$control[0]->cantidad;
    }else{
      $cantidad=0;
      $alimento="";
    }
    if ($i!=$gal->numero_fase)  { echo " <td align=center style='background-color:#f6cece'><font size=5>VACIO</font></td>"; } 
    else{ 
      if ($total_consumo_cria==0) {
        echo "<td align='center' style='background-color:#cef6f5' ><font size=5>FASE ".$gal->numero_fase." </font><br><br>
        <font size=2>ALIMENTO: </font><font size=3><span data-status=1 id=id_alimento_c".$gal->numero_fase.">".$alimento."</span></font> <br><br>
        <font size=2>CANTIDAD: </font> <font size=3><span id=cantidad_g_c".$gal->numero_fase.">".$cantidad."</span> kg.</font> <br><br>
        <span hidden id='c_granel_g_c".$gal->numero_fase."'>". $cantidad_granel."</span>
        <span hidden id='cant_actual_c".$gal->numero_fase."'>". $gal->cantidad_actual."</span> </td> ";
      }else {
        if ($consumo_cria[$contador_consumo_cria]->numero_fase==$gal->numero_fase) {
          echo "<td colspan=2 align='center' style='background-color:orange'><font size=5>FASE ".$gal->numero_fase." </font><br>
          <font size=4><span >ALIMENTADO CON: </span></font><br>
          <font size=2>ALIMENTO: </font><font size=3><span data-status=0 id=id_alimento".$gal->numero_fase.">".$consumo_cria[$contador_consumo_cria]->tipo."</span></font> <br>
          <font size=2>CANTIDAD: </font> <font size=3><span id=cantidad_g".$gal->numero_fase.">". $consumo_cria[$contador_consumo_cria]->cantidad."</span> kg.</font><br>
          <span hidden id='c_granel_g".$gal->numero_fase."'>". $cantidad_granel."</span>
          <span hidden id='cant_actual".$gal->numero_fase."'>". $gal->cantidad_actual."</span> </td> ";
          if ($total_consumo_cria-1>$contador_consumo_cria) {
            $contador_consumo_cria++;                       
          } 
        } else {
          echo "<td align='center' style='background-color:#cef6f5' ><font size=5>FASE ".$gal->numero_fase." </font><br><br>
          <font size=2>ALIMENTO: </font><font size=3><span data-status=1 id=id_alimento_c".$gal->numero_fase.">".$alimento."</span></font> <br><br>
          <font size=2>CANTIDAD: </font> <font size=3><span id=cantidad_g_c".$gal->numero_fase.">".$cantidad."</span> kg.</font> <br><br>
          <span hidden id='c_granel_g_c".$gal->numero_fase."'>". $cantidad_granel."</span>
          <span hidden id='cant_actual_c".$gal->numero_fase."'>". $gal->cantidad_actual."</span> </td> ";
        }
      }
    }
  } $x3=$gal->numero_fase+1; ?> 
  @endforeach   <?php  
  for ($i=$x3; $i <=3 ; $i++) { 
    echo " <td align='center' style='background-color:#f6cece'><font size=5>FASE ".$i."</font></td>";
  }   $x3=1;  ?> 
</tr> 
</table>

		</div>
	</div>
</div>
{!!Html::script('js/lista_alimento.js')!!}
@endsection
