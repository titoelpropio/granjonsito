<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DB;

class ListaAlimentoController extends Controller
{

  function index(){
   $consumo = DB::SELECT("SELECT alimento.tipo, consumo.cantidad, consumo.id,galpon.numero as numero_galpon,fases.numero as numero_fase,fases.nombre,consumo.fecha,silo.id as id_silo,silo.nombre as nombre_silo FROM silo,consumo,fases_galpon,fases,edad,galpon,alimento WHERE consumo.id_fase_galpon=fases_galpon.id and silo.id=consumo.id_silo AND fases_galpon.id_edad=edad.id and edad.id_galpon=galpon.id and fases_galpon.id_fase=fases.id and Date_format(consumo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and galpon.numero<=8 AND fases.nombre='PONEDORA' and silo.id_alimento=alimento.id  order by galpon.numero");
    $consumo2 = DB::SELECT("SELECT alimento.tipo, consumo.cantidad, consumo.id,galpon.numero as numero_galpon,fases.numero as numero_fase,fases.nombre,consumo.fecha,silo.id as id_silo,silo.nombre as nombre_silo FROM silo,consumo,fases_galpon,fases,edad,galpon,alimento WHERE consumo.id_fase_galpon=fases_galpon.id and silo.id=consumo.id_silo AND fases_galpon.id_edad=edad.id and edad.id_galpon=galpon.id and fases_galpon.id_fase=fases.id and Date_format(consumo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and galpon.numero>8 AND fases.nombre='PONEDORA' and silo.id_alimento=alimento.id order by galpon.numero");
   $consumo_cria = DB::SELECT("SELECT alimento.tipo, consumo.cantidad, consumo.id,galpon.numero as numero_galpon,fases.numero as numero_fase,fases.nombre,consumo.fecha,silo.id as id_silo,silo.nombre as nombre_silo FROM silo,consumo,fases_galpon,fases,edad,galpon,alimento WHERE consumo.id_fase_galpon=fases_galpon.id and silo.id=consumo.id_silo AND fases_galpon.id_edad=edad.id and edad.id_galpon=galpon.id and fases_galpon.id_fase=fases.id and Date_format(consumo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') AND fases.nombre!='PONEDORA' and silo.id_alimento=alimento.id order by numero_fase");        
$galpon=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases_galpon.id as id_fase_galpon,galpon.numero,galpon.capacidad_total,DATEDIFF(now(),edad.fecha_inicio)AS edad,fases_galpon.cantidad_inicial,fases_galpon.cantidad_actual,fases.nombre,fases_galpon.total_muerta from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre='PONEDORA' and edad.estado=1 and galpon.numero<=8 order by numero ");
$galpon2=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases_galpon.id as id_fase_galpon,galpon.numero,galpon.capacidad_total,DATEDIFF(now(),edad.fecha_inicio)AS edad,fases_galpon.cantidad_inicial,fases_galpon.cantidad_actual,fases.nombre,fases_galpon.total_muerta from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre='PONEDORA' and edad.estado=1 and galpon.numero>8 order by numero");
$cria_recria=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases_galpon.id as id_fase_galpon,galpon.numero,galpon.capacidad_total,DATEDIFF(now(),edad.fecha_inicio)AS edad,fases_galpon.cantidad_inicial,fases_galpon.cantidad_actual,fases.nombre,fases_galpon.total_muerta,fases.numero as numero_fase from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre!='PONEDORA' AND fases_galpon.fecha_fin IS NULL and edad.estado=1 order by numero_fase");    
    $temperatura=DB::select("select temperatura from temperatura"); 
     return view('lista_alimento.index',compact('galpon','temperatura','galpon2','cria_recria','consumo','consumo2','consumo_cria'));
  }
  
}
