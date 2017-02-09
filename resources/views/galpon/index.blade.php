@extends ('layouts.admin')
@section ('content')
@include('alerts.cargando')
<div id='loading' style="display: none" ><img src='{{asset('images/loading.gif')}}' style='margin:0 auto; position: absolute; top: 50%; left: 50%; margin: -30px 0 0 -30px;'></div>
@include('galpon.modal_alimento')
@include('galpon.mensaje')
<?php $cont = 0;$x=1; $x2=9; 
$cantidad=0;
$alimento="";
$id=0;
$cantidad_granel=0;
$contador_consumo=0;//cuenta el array consumo para desactivar el boton control alimento
$total_consumo=count($consumo);
$contador_consumo2=0;//cuenta el array consumo para desactivar el boton control alimento
$total_consumo2=count($consumo2);
$contador_v=0;
$contador_v2=0;

?>

<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div class="alert alert-danger alert-dismissible" role="alert" hidden="true" id="mensaje" onLoad="">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
  <div class="table-responsive" style="height: 100%; width:100%">
    <div class="pull-left"><font size="5">TEMPERATURA: <span id="temperatura">{{$temperatura[0]->temperatura}}</span> ºC</font></div>

   <div class="col-sm-2 col-md-2  col-sm-2  col-xs-12 pull-right" style="width: 7%; margin: 0px; padding: 0px">
      <div class="form-group">
        <button class="btn btn-danger" onclick="mostrarceldas()" id="btnmostrar" >MOSTRAR</button>                      
      </div>
    </div>
    <div class="col-sm-1  col-md-2  col-sm-2  col-xs-12 pull-right" style=" margin: 0px; padding: 0px">
      <div class="form-group">
        <div class='input-group date' id='datetimepicker10'>
          <input type='text' class="form-control" id="fecha1" style="font-size:20px;text-align:center" />
          <span class="input-group-addon ">
             <span class="fa fa-calendar" aria-hidden="true"></span>  <!--span class="glyphicon glyphicon-calendar"></span-->
          </span>
        </div>
      </div>
    </div>

        <table border=1 class="table-striped  table-condensed table-hover" style="height: 450px; width: 100%" id="tablagalpon">
            <tr height=27 style='height:20.25pt'>
                <td height=27 class=xl93 style='border-right:.5pt solid black;height:20.25pt' align="center"><font size=2>ALIMENTAR</font></td>
                


                @foreach($galpon as $gal) <?php 

                $control=DB::select("SELECT control_alimento.id as id_control ,cantidad,tipo FROM control_alimento,rango_edad,rango_temperatura,alimento WHERE control_alimento.id_temperatura=rango_temperatura.id and  control_alimento.id_edad= rango_edad.id 
and control_alimento.id_alimento=alimento.id and control_alimento.deleted_at IS NULL and rango_edad.edad_min<=".$gal->edad." and rango_edad.edad_max>=".$gal->edad." and rango_temperatura.temp_min<=".$temperatura[0]->temperatura."  and rango_temperatura.temp_max>=".$temperatura[0]->temperatura); 
                

                for ($i=$x; $i <=$gal->numero;  $i++) { 
                if (count($control)!=0) {//verifica que exista un control alimento para esaa edad y temperatura
                  $cantidad=$control[0]->cantidad*$gal->cantidad_actual;
                     $alimento=$control[0]->tipo;
                 $id=$control[0]->id_control;
                 $cantidad_granel=$control[0]->cantidad;
                }
                else{//caso contrario todo se coloca en 0
                  $cantidad=0;
                  $cantidad_granel=0;
                  $alimento="";
                  $id=0;
                }
                    if ($i!=$gal->numero) { echo " <td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'></td>"; } 
                    else{   
                      if (count($consumo)==0) {//entra cuando no existe ningun consumo el dia actual

                        echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'><button class='btn btn-success' data-toggle='modal' data-target='#myModal' onclick=cargar_modal(".$id.",".$gal->numero.",".$gal->id_fase_galpon.",".$cantidad.",".$cantidad_granel.")><span data-status=1 id=id_alimento".$gal->numero.">". $alimento.":</span> <span id=cantidad_g".$gal->numero.">". $cantidad."</span> <span data-status=1 hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span> <span  data-status=1 hidden id=id_control".$gal->numero.">".$id."</span> Kg. </button></td> ";
                      } else {

                      if ($consumo[$contador_consumo]->numero_galpon==$gal->numero) {

                          echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'><button disabled   class='btn btn-danger' data-toggle='modal' data-target='#myModal' onclick=cargar_modal(".$id.",".$gal->numero.",".$gal->id_fase_galpon.",".$cantidad.",".$cantidad_granel.")><span data-status=0 id=id_alimento".$gal->numero.">".$consumo[$contador_consumo]->tipo.":</span> <span data-status=0 id=cantidad_g".$gal->numero.">".$consumo[$contador_consumo]->cantidad."</span> <span data-status=0 hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span> <span data-status=0 hidden id=id_control".$gal->numero.">".$id."</span> Kg.
                        </button></td> ";
                            if ($total_consumo-1>$contador_consumo) {
                              $contador_consumo++;
                             
                            } 
                        } else {
                            echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'><button class='btn btn-success' data-toggle='modal' data-target='#myModal' onclick=cargar_modal(".$id.",".$gal->numero.",".$gal->id_fase_galpon.",".$cantidad.",".$cantidad_granel.")><span data-status=1 id=id_alimento".$gal->numero.">". $alimento.":</span> <span data-status=1 id=cantidad_g".$gal->numero.">". $cantidad."</span> <span data-status=1 hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span> <span data-status=1 hidden id=id_control".$gal->numero.">".$id."</span> Kg.</button></td> ";
                        }
                      }
                  }
                } $x=$gal->numero+1; ?> 
                @endforeach   <?php  
                for ($i=$x; $i <9 ; $i++) { 
                    echo " <td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'></td>";
                }   $x=1;  ?> 
            </tr> 
 
            <tr height=27 style='height:20.25pt' align="center">
                <td colspan=1 height=27 class=xl93 style='border-right:.5pt solid black;height:20.25pt'><font size=2>VACUNA</font></td>
                @foreach($galpon as $gal)   <?php   

                  for ($i=$x; $i <=$gal->numero;  $i++) { 
                    if ($i!=$gal->numero) {echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>"; } 
                    else{ 
                      if (count($lista2)!=0 && $contador_v<count($lista2)) {
                        //echo $lista2[0][0]->galpon;
                      //echo count($lista2);
                      
                       if ($lista2[$contador_v][0]->galpon==$gal->numero) {
                     

                          if ($lista2[$contador_v][0]->dias==0) {
                           echo "<td colspan=2 class=xl83 style='border-left:none; width:10.75%'><font size=3><span id='vacuna".$gal->numero."'>".$lista2[$contador_v][0]->nombre."</span> Días:<span id='dias".$gal->numero."' style='color:red'>HOY</span></font></td>";
                          }
                          else{
                            echo "<td colspan=2 class=xl83 style='border-left:none; width:10.75%'><font size=3><span id='vacuna".$gal->numero."'>".$lista2[$contador_v][0]->nombre."</span> Días:<span id='dias".$gal->numero."' style='color:red'>".$lista2[$contador_v][0]->dias."</span></font></td>";
                          }

$contador_v++;
//echo $contador_v;
  
                      }
                    

                      else{
                        echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                      }
                      

                      }
                      else{
                        echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                      }
                                                          
                    }
                   }    $x=$gal->numero+1; ?>                      
                @endforeach <?php  
                    for ($i=$x; $i <9 ; $i++) { 
                         echo " <td colspan=2  class=xl83 style='border-left:none; width:10.75%'></td>";
                    }   $x=1;   ?> 
            </tr> 

            <tr height=22 style='height:16.5pt; background-color: YellowGreen' align='center'>
                <td colspan=1 height=22 class=xl81 style='border-right:.5pt solid black;height:16.5pt; width:8%'><font size=2>EDAD</font></td>
                @foreach($galpon as $gal) <?php 
                    for ($i=$x; $i <=$gal->numero;  $i++) { 
                        if ($i!=$gal->numero) {  echo " <td colspan=2  class=xl83 style='border-left:none; width:10.75%'></td>";} 
                        else{ echo "<td colspan=2 class=xl83 style='border-left:none; width:10.75%'><font size=3><font size=3><span id='edad".$gal->numero."'>".$gal->edad."</span></font></td> "; }
                    }   $x=$gal->numero+1;  ?>                  
                @endforeach <?php  
                    for ($i=$x; $i <9 ; $i++) { 
                         echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                    }   $x=1;   ?>                              
            </tr>

            <tr height=27 style='height:20.25pt; background-color: #f5bca9' align='center' >
                <td colspan=1 height=27 class=xl93 style='border-right:.5pt solid black;height:20.25pt'><font size=2>CANTIDAD ACTUAL</font></td>
                @foreach($galpon as $gal) <?php 
                  for ($i=$x; $i <=$gal->numero;  $i++) { 
                    if ($i!=$gal->numero) { echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";} 
                    else{ echo "<td colspan=2  class=xl83 style='border-left:none; width:10.75%' ><font size=3><span id='cant_actual".$gal->numero."'>".$gal->cantidad_actual."</span></td>"; }
                  } $x=$gal->numero+1;  ?>                  
                @endforeach <?php  
                    for ($i=$x; $i <9 ; $i++) { 
                         echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                    } $x=1; ?> 
            </tr>   

            <tr height=27 style='height:20.25pt' align='center'>
                <td colspan=1 height=27 class=xl93 style='border-right:.5pt solid black;height:20.25pt'><font size=2>MUERTAS</font></td>
                @foreach($galpon as $gal)  <?php 
                  for ($i=$x; $i <=$gal->numero;  $i++) { 
                    if ($i!=$gal->numero) { echo "<td colspan=2 class=xl83 style='border-left:none;width:10.75%'></td>";} 
                    else{ echo "<td colspan=2  class=xl83 style='border-left:none; width:10.75%'><font size=3><span id='muerta".$gal->numero."'>".$gal->total_muerta."</span></td> "; }
                  } $x=$gal->numero+1; ?>                  
                @endforeach  <?php  
                    for ($i=$x; $i <9 ; $i++) { 
                         echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                    }  $x=1; ?> 
            </tr> 

            <tr height=23 style='height:17.25pt; background-color: orange' align='center'>
                <td colspan=1 height=23 class=xl105 style='border-right:.5pt solid black;height:17.25pt'><font size=2>GALPON Nro</font></td>
                 @foreach($galpon as $gal)  <?php 
                    for ($i=$x; $i <=$gal->numero;  $i++) { 
                        if ($i!=$gal->numero) { echo " <td colspan=2  class=xl83 style='border-left:none; width:10.75%'>Vacio</td>"; }
                        else{ echo "<td colspan=2 class=xl83 style='border-left:none; width:10.75%'><font size=3><span  id='galpon".$gal->numero."'>GALPON ".$gal->numero."</span></td> "; }
                  }  $x=$gal->numero+1; ?> 
                @endforeach <?php  
                    for ($i=$x; $i <9 ; $i++) { 
                         echo " <td colspan=2  class=xl83 style='border-left:none; width:10.75%'>Vacio</td>";
                    }  $x=1;  ?>                   
            </tr>

            <tr height=22 style='height:16.5pt' align='center'>
                <td rowspan=2 align=center class=xl71 style='border-bottom:.5pt solid black'><font size=2>MAÑANA</font></td>
                <?php       
                if ( count($postura_huevo)==0) {
                            for ($i=$x; $i <=8;  $i++)  {
                              echo " <td class=xl72 style='border-left:none'> <input  id='c1g".$i."' type='text' onclick='extraer_id(".$i.")' class='form-control'  onkeypress='return bloqueo_de_punto(event)'> </td>
                            <td rowspan=6 class=xl74 style='border-bottom:.5pt solid black;border-top:none'> <font color=red> MUERTAS </font> <br> <font color=red size='4'><span id='gmd".$i."'>0</span></font>
                            <input type='number'  id='mg".$i."' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'>  </td>";
                            }    
                                }   

                                else {
                                    foreach ($postura_huevo as $key => $pos) {
                                        for ($i=$x; $i <=$pos->numero;  $i++) { 
                                     if ($i!=$pos->numero) {
                            echo " <td class=xl72 style='border-left:none'> <input  id='c1g".$i."' type='text' onclick='extraer_id(".$i.")' class='form-control'  onkeypress='return bloqueo_de_punto(event)'> </td>
                            <td rowspan=6 class=xl74 style='border-bottom:.5pt solid black;border-top:none'> <font color=red> MUERTAS </font> <br> <font color=red size='4'><span id='gmd".$i."'>0</span></font>
                            <input type='number'  id='mg".$i."' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'>  </td>";
                            } 
                        else{ echo "<td class=xl72 style='border-left:none'> <input id='c1g".$i."' value='".$pos->celda1."' type='text' onclick='return limpia(this),extraer_id(".$i.")' onBlur='return verificar(this)' class='form-control' style='font-size: 16px;text-align:center'  onkeypress='return bloqueo_de_punto(event)' > </td> 
                            <td rowspan=6 class=xl74 style='border-bottom:.5pt solid black;border-top:none'><font color=red> MUERTAS </font><br> <font color=red size='4'><span id='gmd".$i."'>".$pos->cantidad_muertas."</span></font>  <input type='number' id='mg".$i."' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'></td>";  }//else
                              } //for
                              $x=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                                 } //foreach
                                  for ($i=$x; $i <9 ; $i++) { 
                        echo " <td class=xl72 style='border-left:none'> <input  id='c1g".$i."' type='text' onclick='extraer_id(".$i.")' class='form-control'  onkeypress='return bloqueo_de_punto(event)'> </td>
                            <td rowspan=6 class=xl74 style='border-bottom:.5pt solid black;border-top:none'> <font color=red> MUERTAS </font> <br> <font color=red size='4'><span id='gmd".$i."'>0</span></font>
                            <input type='number'  id='mg".$i."' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td>";
                    }   $x=1; 
                                }            
                     ?> 
                      
                    
                                       
                </tr>

                <tr height=22 style='height:16.5pt'>
                <?php       
                if ( count($postura_huevo)==0) {
                                for ($i=$x; $i <=8;  $i++)  {
                                         echo  " <td class=xl72 style='border-left:none'> <input id='c2g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                                }    
                                }   

                                else {
                                    foreach ($postura_huevo as $key => $pos) {
                                        for ($i=$x; $i <=$pos->numero;  $i++) { 
                                     if ($i!=$pos->numero) {
                            echo " <td class=xl72 style='border-left:none'> <input id='c2g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                            } 
                        else{echo "<td class=xl72 style='border-left:none'> <input type='text' style='font-size: 16px;text-align:center' value='".$pos->celda2."' id='c2g".$i."'class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='return limpia(this),extraer_id(".$i.")' onBlur='return verificar(this)'></td>";   }//else
                              } //for
                              $x=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                                 } //foreach
                                  for ($i=$x; $i <9 ; $i++) { 
                        echo  "<td class=xl72 style='border-left:none'> <input id='c2g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                    }   $x=1; 
                                }            
                     ?> 
                      
                    
                                                        
                </tr>

                <tr height=22 style='height:16.5pt'>
                    <td rowspan=2 align=center class=xl71 style='border-bottom:.5pt solid black'><font size=2>TARDE</font></td>
                     <?php       
                if ( count($postura_huevo)==0) {
                                for ($i=$x; $i <=8;  $i++)  {
                                         echo  " <td class=xl72 style='border-left:none'> <input id='c3g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                                }    
                                }   

                                else {
                                    foreach ($postura_huevo as $key => $pos) {
                                        for ($i=$x; $i <=$pos->numero;  $i++) { 
                                     if ($i!=$pos->numero) {
                            echo " <td class=xl72 style='border-left:none'> <input id='c3g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                            } 
                        else{echo "<td class=xl72 style='border-left:none'> <input type='text' style='font-size: 16px;text-align:center' value='".$pos->celda3."' id='c3g".$i."'class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='return limpia(this),extraer_id(".$i.")' onBlur='return verificar(this)'></td>";   }//else
                              } //for
                              $x=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                                 } //foreach
                                  for ($i=$x; $i <9 ; $i++) { 
                        echo  "<td class=xl72 style='border-left:none'> <input id='c3g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                    }   $x=1; 
                                }            
                     ?> 
                      
                                                             
                </tr>

                <tr height=22 style='height:16.5pt'>
                      <?php       
                if ( count($postura_huevo)==0) {
                                for ($i=$x; $i <=8;  $i++)  {
                                         echo  " <td class=xl72 style='border-left:none'> <input id='c4g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                                }    
                                }   

                                else {
                                    foreach ($postura_huevo as $key => $pos) {
                                        for ($i=$x; $i <=$pos->numero;  $i++) { 
                                     if ($i!=$pos->numero) {
                            echo " <td class=xl72 style='border-left:none'> <input id='c4g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                            } 
                        else{echo "<td class=xl72 style='border-left:none'> <input type='text' style='font-size: 16px;text-align:center' value='".$pos->celda4."' id='c4g".$i."'class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='return limpia(this),extraer_id(".$i.")' onBlur='return verificar(this)'></td>";   }//else
                              } //for
                              $x=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                                 } //foreach
                                  for ($i=$x; $i <9 ; $i++) { 
                        echo  "<td class=xl72 style='border-left:none'> <input id='c4g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                    }   $x=1; 
                                }            
                     ?>        
                </tr>
                
                <tr height=22 style='height:16.5pt' align=center>
                    <td colspan=1 height=22 class=xl81 style='border-right:.5pt solid black;height:16.5pt;border-left:none'><font size=2>TOTAL GALPON</font></td>
                      <?php       
                if ( count($postura_huevo)==0) {
                                for ($i=$x; $i <=8;  $i++)  {
                                         echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='total_galpones".$i."'>0</span></font></td>";
                                }    
                                }   

                                else {
                                    foreach ($postura_huevo as $key => $pos) {
                                        for ($i=$x; $i <=$pos->numero;  $i++) { 
                                     if ($i!=$pos->numero) {
                            echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='total_galpones".$i."'>0</span></font></td>";
                            } 
                        else{echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='total_galpones".$i."'>".$pos->cantidad_total."</span></font> </td>";}//else
                              } //for
                              $x=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                                 } //foreach
                                  for ($i=$x; $i <9 ; $i++) { 
                        echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='total_galpones".$i."'>0</span></font></td>";
                    }   $x=1; 
                                }            
                     ?>        
                  
                </tr>

                <tr height=22 style='height:16.5pt' align=center>
                    <td colspan=1 height=22 class=xl81 style='border-right:.5pt solid black; height:16.5pt;border-left:none'><font size=2>POSTURA %</font></td>
                     <?php       
                if ( count($postura_huevo)==0) {
                        for ($i=$x; $i <=8;  $i++)  {
                                         echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='ph".$i."'>0</span></font></td>";
                            }    
                            }   
                            else {
                                    foreach ($postura_huevo as $key => $pos) {
                                        for ($i=$x; $i <=$pos->numero;  $i++) { 
                                     if ($i!=$pos->numero) {
                            echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='ph".$i."'>0</span></font></td>";
                            } 
                        else{echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='ph".$i."'>".$pos->postura_p." %</span></font> </td>";}//else
                              } //for
                              $x=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                                 } //foreach
                                  for ($i=$x; $i <9 ; $i++) { 
                        echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='ph".$i."'>0</span></font></td>";
                    }   $x=1; 
                                }            
                     ?>        
                   
                </tr>

                @foreach($galpon as $gal)
                    <input type="hidden" id="id_fase_galpon{{$gal->numero}}" value="{{$gal->id_fase_galpon}}">
                @endforeach                   
            </table>
            </div>



<br>  <!--TABLA2-->
<?php 
$contador=DB::select("SELECT COUNT(*)as contador from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre='PONEDORA' and edad.estado=1 and galpon.numero>8");
if ($contador[0]->contador != 0 ) { ?>


 <table border=1 class="table-striped  table-condensed table-hover" style="height: 450px; width: 100%" id="tablagalpon2">
  <tr height=27 style='height:20.25pt'>
      <td height=27 class=xl93 style='border-right:.5pt solid black;height:20.25pt' align="center"><font size=2>ALIMENTAR</font></td>

      @foreach($galpon2 as $gal) <?php 
     $control=DB::select("SELECT control_alimento.id as id_control ,cantidad,tipo FROM control_alimento,rango_edad,rango_temperatura,alimento WHERE control_alimento.id_temperatura=rango_temperatura.id and  control_alimento.id_edad= rango_edad.id 
    and control_alimento.id_alimento=alimento.id and control_alimento.deleted_at IS NULL and rango_edad.edad_min<=".$gal->edad." and rango_edad.edad_max>=".$gal->edad." and rango_temperatura.temp_min<=".$temperatura[0]->temperatura."  and rango_temperatura.temp_max>=".$temperatura[0]->temperatura); 
      



                for ($i=$x2; $i <=$gal->numero;  $i++) { 
if (count($control)!=0) {

                  $cantidad=$control[0]->cantidad*$gal->cantidad_actual;
                     $alimento=$control[0]->tipo;
                 $id=$control[0]->id_control;
                 $cantidad_granel=$control[0]->cantidad;
                }
                else{
                  $cantidad=0;
                  $cantidad_granel=0;
                  $alimento="";
                  $id=0;
                }
                    if ($i!=$gal->numero) { echo " <td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'></td>"; } 
                    else{   
                      if (count($consumo2)==0) {//entra cuando no existe ningun consumo el dia actual
                        
                        echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'><button class='btn btn-success' data-toggle='modal' data-target='#myModal' onclick=cargar_modal(".$id.",".$gal->numero.",".$gal->id_fase_galpon.",".$cantidad.",".$cantidad_granel.")><span data-status=1 id=id_alimento".$gal->numero.">". $alimento.":</span> <span id=cantidad_g".$gal->numero.">". $cantidad."</span> <span data-status=1 hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span> <span  data-status=1 hidden id=id_control".$gal->numero.">".$id."</span> Kg. </button></td> ";
                      } else {

                      if ($consumo2[$contador_consumo2]->numero_galpon==$gal->numero) {

                          echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'><button disabled   class='btn btn-danger' data-toggle='modal' data-target='#myModal' onclick=cargar_modal(".$id.",".$gal->numero.",".$gal->id_fase_galpon.",".$cantidad.",".$cantidad_granel.")><span data-status=0 id=id_alimento".$gal->numero.">".$consumo2[$contador_consumo2]->tipo.":</span> <span data-status=0 id=cantidad_g".$gal->numero.">".$consumo2[$contador_consumo2]->cantidad."</span> <span data-status=0 hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span> <span data-status=0 hidden id=id_control".$gal->numero.">".$id."</span> Kg.
                        </button></td> ";
                            if ($total_consumo2-1>$contador_consumo2) {
                              $contador_consumo2++;
                             
                            } 
                        } else {
                            echo "<td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'><button class='btn btn-success' data-toggle='modal' data-target='#myModal' onclick=cargar_modal(".$id.",".$gal->numero.",".$gal->id_fase_galpon.",".$cantidad.",".$cantidad_granel.")><span data-status=1 id=id_alimento".$gal->numero.">". $alimento.":</span> <span data-status=1 id=cantidad_g".$gal->numero.">". $cantidad."</span> <span data-status=1 hidden id='c_granel_g".$gal->numero."'>". $cantidad_granel."</span> <span data-status=1 hidden id=id_control".$gal->numero.">".$id."</span> Kg. f</button></td> ";
                        }
                      }
                  }
                }

 $x2=$gal->numero+1; ?> 
      @endforeach   <?php  
      for ($i=$x2; $i <17 ; $i++) { 
          echo " <td colspan=2 align='center' class=xl83 style='border-left:none; width:10.75%'></td>";
      }   $x2=9;  ?> 
  </tr>

  <tr height=27 style='height:20.25pt' align="center">
      <td colspan=1 height=27 class=xl93 style='border-right:.5pt solid black;height:20.25pt'><font size=2>VACUNA</font></td>
      @foreach($galpon2 as $gal)   <?php   

                  for ($i=$x2; $i <=$gal->numero;  $i++) { 
                    if ($i!=$gal->numero) {echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>"; } 
                    else{ 
                      //echo count($lista2[$i]->galpon);
                      if (count($lista3)!=0 && $contador_v2<count($lista3)) {
                       if ($lista3[$contador_v2][0]->galpon==$gal->numero) {
                          if ($lista3[$contador_v2][0]->dias==0) {
                           echo "<td colspan=2 class=xl83 style='border-left:none; width:10.75%'><font size=3><span id='vacuna".$gal->numero."'>".$lista3[$contador_v2][0]->nombre."</span> Días:<span id='dias".$gal->numero."' style='color:red'>HOY</span></font></td>";
                          }
                          else{
                            echo "<td colspan=2 class=xl83 style='border-left:none; width:10.75%'><font size=3><span id='vacuna".$gal->numero."'>".$lista3[$contador_v2][0]->nombre."</span> Días:<span id='dias".$gal->numero."' style='color:red'>".$lista3[$contador_v2][0]->dias."</span></font></td>";
                          }
                    

                    $contador_v2++;
                      } 
                      else{
                        echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                      }
                      }
                      else{
                        echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                      }
                                                          
                    }
                   }    $x2=$gal->numero+1;  ?>                      
                @endforeach <?php  
                    for ($i=$x2; $i <17 ; $i++) { 
                         echo " <td colspan=2  class=xl83 style='border-left:none; width:10.75%'></td>";
                    }   $x2=9;   ?> 
  </tr>  

  <tr height=22 style='height:16.5pt; background-color: YellowGreen' align='center'>
    <td colspan=1 height=22 class=xl81 style='border-right:.5pt solid black;height:16.5pt; width:8%'><font size=2>EDAD</font></td>
    @foreach($galpon2 as $gal) <?php 
        for ($i=$x2; $i <=$gal->numero;  $i++) { 
            if ($i!=$gal->numero) {  echo " <td colspan=2  class=xl83 style='border-left:none; width:10.75%'></td>";} 
            else{ echo "<td colspan=2 class=xl83 style='border-left:none; width:10.75%'><font size=3><span id='edad".$gal->numero."'>".$gal->edad."</span></td> "; }
        }   $x2=$gal->numero+1;  ?>                  
    @endforeach <?php  
        for ($i=$x2; $i <17 ; $i++) { 
             echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
        }   $x2=9;   ?>                              
  </tr>
            <tr height=27 style='height:20.25pt; background-color: #f5bca9' align='center' >
                <td colspan=1 height=27 class=xl93 style='border-right:.5pt solid black;height:20.25pt'><font size=2>CANTIDAD ACTUAL</font></td>
                @foreach($galpon2 as $gal) <?php 
                  for ($i=$x2; $i <=$gal->numero;  $i++) { 
                    if ($i!=$gal->numero) { echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";} 
                    else{ echo "<td colspan=2  class=xl83 style='border-left:none; width:10.75%' ><font size=3><span id='cant_actual".$gal->numero."'>".$gal->cantidad_actual."</span></td>"; }
                  } $x2=$gal->numero+1;  ?>                  
                @endforeach <?php  
                    for ($i=$x2; $i <17 ; $i++) { 
                         echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                    } $x2=9; ?> 
            </tr>   

            <tr height=27 style='height:20.25pt' align='center'>
                <td colspan=1 height=27 class=xl93 style='border-right:.5pt solid black;height:20.25pt'><font size=2>MUERTAS</font></td>
                @foreach($galpon2 as $gal)  <?php 
                  for ($i=$x2; $i <=$gal->numero;  $i++) { 
                    if ($i!=$gal->numero) { echo "<td colspan=2 class=xl83 style='border-left:none;width:10.75%'></td>";} 
                    else{ echo "<td colspan=2  class=xl83 style='border-left:none; width:10.75%'><font size=3><span id='muerta".$gal->numero."'>".$gal->total_muerta."</span></td> "; }
                  } $x2=$gal->numero+1; ?>                  
                @endforeach  <?php  
                    for ($i=$x2; $i <17 ; $i++) { 
                         echo " <td colspan=2 class=xl83 style='border-left:none; width:10.75%'></td>";
                    }  $x2=9; ?> 
            </tr> 

  <tr height=23 style='height:17.25pt; background-color: orange' align='center'>
      <td colspan=1 height=23 class=xl105 style='border-right:.5pt solid black;height:17.25pt'><font size=2>GALPON Nro</font></td>
       @foreach($galpon2 as $gal)  <?php 
          for ($i=$x2; $i <=$gal->numero;  $i++) { 
              if ($i!=$gal->numero) { echo " <td colspan=2  class=xl83 style='border-left:none; width:10.75%'>Vacio</td>"; }
              else{ echo "<td colspan=2 class=xl83 style='border-left:none; width:10.75%'><font size=3><span  id='galpon".$gal->numero."'>GALPON ".$gal->numero."</span></td> "; }
        }  $x2=$gal->numero+1; ?> 
      @endforeach <?php  
          for ($i=$x2; $i <17 ; $i++) { 
               echo " <td colspan=2  class=xl83 style='border-left:none; width:10.75%'>Vacio</td>";
          }  $x2=9;  ?>                   
  </tr>   

  <tr height=22 style='height:16.5pt' align='center'>
      <td rowspan=2 align=center class=xl71 style='border-bottom:.5pt solid black'><font size=2>MAÑANA</font></td>
      <?php       
      if ( count($postura_huevo2)==0) {
                  for ($i=$x2; $i <=16;  $i++)  {
                    echo " <td class=xl72 style='border-left:none'> <input  id='c1g".$i."' type='text' onclick='extraer_id(".$i.")' class='form-control'  onkeypress='return bloqueo_de_punto(event)'> </td>
                  <td rowspan=6 class=xl74 style='border-bottom:.5pt solid black;border-top:none'> <font color=red> MUERTAS </font> <br> <font color=red size='4'><span id='gmd".$i."'>0</span></font>
                  <input type='number'  id='mg".$i."' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'>  </td>";
                  }    
                      }   
                      else {
                          foreach ($postura_huevo2 as $key => $pos) {
                              for ($i=$x2; $i <=$pos->numero;  $i++) { 
                           if ($i!=$pos->numero) {
                  echo " <td class=xl72 style='border-left:none'> <input  id='c1g".$i."' type='text' onclick='extraer_id(".$i.")' class='form-control'  onkeypress='return bloqueo_de_punto(event)'> </td>
                  <td rowspan=6 class=xl74 style='border-bottom:.5pt solid black;border-top:none'> <font color=red> MUERTAS </font> <br> <font color=red size='4'><span id='gmd".$i."'>0</span></font>
                  <input type='number'  id='mg".$i."' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'>  </td>";
                  } 
              else{ echo "<td class=xl72 style='border-left:none'> <input id='c1g".$i."' value='".$pos->celda1."' type='text' onclick='return limpia(this),extraer_id(".$i.")' onBlur='return verificar(this)' class='form-control' style='font-size: 16px;text-align:center'  onkeypress='return bloqueo_de_punto(event)' > </td> 
                  <td rowspan=6 class=xl74 style='border-bottom:.5pt solid black;border-top:none'><font color=red> MUERTAS </font><br> <font color=red size='4'><span id='gmd".$i."'>".$pos->cantidad_muertas."</span></font>  <input type='number' id='mg".$i."' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'></td>";  }//else
                    } //for
                    $x2=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                       } //foreach
                        for ($i=$x2; $i <17 ; $i++) { 
              echo " <td class=xl72 style='border-left:none'> <input  id='c1g".$i."' type='text' onclick='extraer_id(".$i.")' class='form-control'  onkeypress='return bloqueo_de_punto(event)'> </td>
                  <td rowspan=6 class=xl74 style='border-bottom:.5pt solid black;border-top:none'> <font color=red> MUERTAS </font> <br> <font color=red size='4'><span id='gmd".$i."'>0</span></font>
                  <input type='number'  id='mg".$i."' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td>";
          }   $x2=9; 
                      }            
           ?>                                                                        
  </tr> 

  <tr height=22 style='height:16.5pt'>
  <?php       
  if ( count($postura_huevo2)==0) {
                  for ($i=$x2; $i <=16;  $i++)  {
                           echo  " <td class=xl72 style='border-left:none'> <input id='c2g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                  }    
                  }   
                  else {
                      foreach ($postura_huevo2 as $key => $pos) {
                          for ($i=$x2; $i <=$pos->numero;  $i++) { 
                       if ($i!=$pos->numero) {
              echo " <td class=xl72 style='border-left:none'> <input id='c2g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
              } 
          else{echo "<td class=xl72 style='border-left:none'> <input type='text' style='font-size: 16px;text-align:center' value='".$pos->celda2."' id='c2g".$i."'class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='return limpia(this),extraer_id(".$i.")' onBlur='return verificar(this)'></td>";   }//else
                } //for
                $x2=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                   } //foreach
                    for ($i=$x2; $i <17 ; $i++) { 
          echo  "<td class=xl72 style='border-left:none'> <input id='c2g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
      }   $x2=9; 
                  }            
       ?> 
  </tr>    


 <tr height=22 style='height:16.5pt'>
      <td rowspan=2 align=center class=xl71 style='border-bottom:.5pt solid black'><font size=2>TARDE</font></td>
       <?php       
  if ( count($postura_huevo2)==0) {
                  for ($i=$x2; $i <=16;  $i++)  {
                           echo  " <td class=xl72 style='border-left:none'> <input id='c3g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                  }    
                  }   

                  else {
                      foreach ($postura_huevo2 as $key => $pos) {
                          for ($i=$x2; $i <=$pos->numero;  $i++) { 
                       if ($i!=$pos->numero) {
              echo " <td class=xl72 style='border-left:none'> <input id='c3g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
              } 
          else{echo "<td class=xl72 style='border-left:none'> <input type='text' style='font-size: 16px;text-align:center' value='".$pos->celda3."' id='c3g".$i."'class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='return limpia(this),extraer_id(".$i.")' onBlur='return verificar(this)'></td>";   }//else
                } //for
                $x2=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                   } //foreach
                    for ($i=$x2; $i <17 ; $i++) { 
          echo  "<td class=xl72 style='border-left:none'> <input id='c3g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
      }   $x2=9; 
                  }            
       ?> 
        
                                               
  </tr>

  <tr height=22 style='height:16.5pt'>
        <?php       
  if ( count($postura_huevo2)==0) {
                  for ($i=$x2; $i <=16;  $i++)  {
                           echo  " <td class=xl72 style='border-left:none'> <input id='c4g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
                  }    
                  }   

                  else {
                      foreach ($postura_huevo2 as $key => $pos) {
                          for ($i=$x2; $i <=$pos->numero;  $i++) { 
                       if ($i!=$pos->numero) {
              echo " <td class=xl72 style='border-left:none'> <input id='c4g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
              } 
          else{echo "<td class=xl72 style='border-left:none'> <input type='text' style='font-size: 16px;text-align:center' value='".$pos->celda4."' id='c4g".$i."'class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='return limpia(this),extraer_id(".$i.")' onBlur='return verificar(this)'></td>";   }//else
                } //for
                $x2=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                   } //foreach
                    for ($i=$x2; $i <17 ; $i++) { 
          echo  "<td class=xl72 style='border-left:none'> <input id='c4g".$i."' type='text' class='form-control' onkeypress='return bloqueo_de_punto(event)' onclick='extraer_id(".$i.")'> </td> ";
      }   $x2=9; 
                  }            
       ?>        
  </tr>   


                  <tr height=22 style='height:16.5pt' align=center>
                    <td colspan=1 height=22 class=xl81 style='border-right:.5pt solid black;height:16.5pt;border-left:none'><font size=2>TOTAL GALPON</font></td>
                      <?php       
                if ( count($postura_huevo2)==0) {
                                for ($i=$x2; $i <=16;  $i++)  {
                                         echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='total_galpones".$i."'>0</span></font></td>";
                                }    
                                }   

                                else {
                                    foreach ($postura_huevo2 as $key => $pos) {
                                        for ($i=$x2; $i <=$pos->numero;  $i++) { 
                                     if ($i!=$pos->numero) {
                            echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='total_galpones".$i."'>0</span></font></td>";
                            } 
                        else{echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='total_galpones".$i."'>".$pos->cantidad_total."</span></font> </td>";}//else
                              } //for
                              $x2=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                                 } //foreach
                                  for ($i=$x2; $i <17 ; $i++) { 
                        echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='total_galpones".$i."'>0</span></font></td>";
                    }   $x2=9; 
                                }            
                     ?>        
                  
                </tr>

                <tr height=22 style='height:16.5pt' align=center>
                    <td colspan=1 height=22 class=xl81 style='border-right:.5pt solid black; height:16.5pt;border-left:none'><font size=2>POSTURA %</font></td>
                     <?php       
                if ( count($postura_huevo2)==0) {
                        for ($i=$x2; $i <=16;  $i++)  {
                                         echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='ph".$i."'>0</span></font></td>";
                            }    
                            }   
                            else {
                                    foreach ($postura_huevo2 as $key => $pos) {
                                        for ($i=$x2; $i <=$pos->numero;  $i++) { 
                                     if ($i!=$pos->numero) {
                            echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='ph".$i."'>0</span></font></td>";
                            } 
                        else{echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='ph".$i."'>".$pos->postura_p." %</span></font> </td>";}//else
                              } //for
                              $x2=$pos->numero+1; //para controlar el  numero del galpon que le toca iniciar en el for
                                 } //foreach
                                  for ($i=$x2; $i <17 ; $i++) { 
                        echo "<td class=xl83 style='border-top:none;border-left:none'><font size=4><span id='ph".$i."'>0</span></font></td>";
                    }   $x2=9; 
                                }            
                     ?>        
                   
                </tr>                   
  </table>
    @foreach($galpon2 as $gal)
        <input type="hidden" id="id_fase_galpon{{$gal->numero}}" value="{{$gal->id_fase_galpon}}">
    @endforeach  

<?php 
}
?>
 
  <br>

</div>

{!!Html::script('js/script.js')!!}
@endsection





