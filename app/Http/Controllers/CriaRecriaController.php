<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galpon;
use App\PosturaHuevo;
use App\GallinaMuerta;
use App\Edad;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Requests\GalponCreateRequest;
use App\Http\Requests\GalponUpdateRequest;
use DB;

class CriaRecriaController extends Controller {

  function index() {
    try {
              DB::beginTransaction();     
    $lista2=array();
    $silo=DB::select("SELECT silo.id,silo.nombre,silo.cantidad,silo.cantidad_minima,silo.estado,alimento.tipo FROM silo,alimento WHERE silo.estado=1 AND alimento.id=silo.id_alimento and silo.deleted_at IS NULL");
    $consumo = DB::SELECT("SELECT alimento.tipo, consumo.cantidad, consumo.id,galpon.numero as numero_galpon,fases.numero as numero_fase,fases.nombre,consumo.fecha,silo.id as id_silo,silo.nombre as nombre_silo FROM silo,consumo,fases_galpon,fases,edad,galpon,alimento WHERE consumo.id_fase_galpon=fases_galpon.id and silo.id=consumo.id_silo AND fases_galpon.id_edad=edad.id and edad.id_galpon=galpon.id and fases_galpon.id_fase=fases.id and Date_format(consumo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') AND fases.nombre!='PONEDORA' and silo.id_alimento=alimento.id order by numero_fase");      
    $cria_recria=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases_galpon.id as id_fase_galpon,galpon.numero,galpon.capacidad_total,DATEDIFF(now(),edad.fecha_inicio)AS edad,fases_galpon.cantidad_inicial,fases_galpon.cantidad_actual,fases.nombre,fases_galpon.total_muerta,fases.numero as numero_fase from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre!='PONEDORA' AND fases_galpon.fecha_fin IS NULL and edad.estado=1 order by numero_fase");
    $gallina_muerta=DB::select("SELECT postura_huevo.cantidad_muertas,  fases.numero from postura_huevo, fases_galpon,fases,edad where postura_huevo.id_fases_galpon=fases_galpon.id and fases_galpon.id_fase=fases.id and fases_galpon.id_edad=edad.id and Date_format(postura_huevo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and edad.estado=1 and fases_galpon.fecha_fin IS NULL and fases.nombre<>'PONEDORA'");          
    $temperatura=DB::select("select temperatura from temperatura"); 
    $contador=0;
    for ($i=0; $i < count($cria_recria) ; $i++) { //este es para las vacunas de los galpones 1-8
        $verificar=DB::select("SELECT control_vacuna.id as id_control_vacuna,vacuna.precio,vacuna.id, vacuna.edad,vacuna.nombre,vacuna.detalle,".$cria_recria[$i]->numero_fase." as galpon,(vacuna.edad - ".$cria_recria[$i]->edad.") AS dias FROM vacuna,control_vacuna,edad WHERE edad.id=control_vacuna.id_edad AND vacuna.id=control_vacuna.id_vacuna AND vacuna.edad>=".$cria_recria[$i]->edad." AND control_vacuna.estado=1 AND edad.id=".$cria_recria[$i]->id_edad."  ORDER BY dias");

          /*SELECT vacuna.id, vacuna.edad,vacuna.nombre,vacuna.detalle,".$cria_recria[$i]->numero_fase." as galpon,(vacuna.edad - ".$cria_recria[$i]->edad.") AS dias FROM vacuna WHERE vacuna.edad>=".$cria_recria[$i]->edad." AND vacuna.estado=1 order by edad LIMIT 1");  */
        if (count($verificar) != 0) {
            $lista2[$contador] = $verificar;
            $contador++;
        }
          
    }  
 
    DB::commit();
    return view('cria-recria.index', compact('lista2','temperatura','cria_recria','gallina_muerta','consumo','silo'));
  } catch (Exception $e) {
     DB::rollback();
     return redirect('/')->with('message-error','A OCURRIDO UN ERROR');  
  }
}

    public function lista_edad_cria(){
       $lista2=array();
       $lista=DB::select("SELECT edad.id as id_edad, galpon.id as id_galpon, fases.numero, DATEDIFF(curdate(),edad.fecha_inicio)as edad, edad.fecha_inicio,fases.nombre as fase FROM edad,fases_galpon,fases,galpon WHERE edad.id_galpon=galpon.id AND edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases.nombre!='PONEDORA' AND fases_galpon.fecha_fin IS NULL AND edad.estado=1 ORDER by galpon.numero");
       for ($i=0; $i < count($lista) ; $i++) { 
            $lista2[$i]=DB::select("SELECT vacuna.id, vacuna.edad,vacuna.nombre,vacuna.detalle,".$lista[$i]->numero." as galpon,(vacuna.edad - ".$lista[$i]->edad.") AS dias FROM vacuna WHERE vacuna.edad>=".$lista[$i]->edad." AND vacuna.estado=1 order by edad LIMIT 1");   
       }
      return response()->json($lista2);
    } 

    public function actualizar_control_alimento_cria(Request $request){
        $control=array();
        $contador=0;
        $galpon=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases_galpon.id as id_fase_galpon,galpon.numero,galpon.capacidad_total,DATEDIFF(now(),edad.fecha_inicio)AS edad,fases_galpon.cantidad_inicial,fases_galpon.cantidad_actual,fases.nombre,fases_galpon.total_muerta,fases.numero as numero_fase from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre!='PONEDORA' AND fases_galpon.fecha_fin IS NULL and edad.estado=1 order by numero_fase");

        foreach ($galpon as $key => $value) {
        
            $verificar=DB::select("SELECT ".$value->numero_fase." as numero,control_alimento.id as id_control ,cantidad,tipo,alimento.tipo FROM control_alimento,rango_edad,rango_temperatura,alimento WHERE control_alimento.id_temperatura=rango_temperatura.id and  control_alimento.id_edad= rango_edad.id 
and control_alimento.id_alimento=alimento.id and control_alimento.deleted_at IS NULL and rango_edad.edad_min<=".$value->edad." and rango_edad.edad_max>=".$value->edad ." and rango_temperatura.temp_min<=".$request->temperatura."  and rango_temperatura.temp_max>=".$request->temperatura); 
            if (count($verificar)!=0) {
              $control[$contador]=$verificar;

            }
            else
            {
                $control[$contador]=$value->numero_fase;
            }
                  $contador++;
      
        }
        return response()->json($control);
    }

  /*  function obtenerdadafecha_cria(Request $request) {
        if ($request->ajax()) {
            $resultado = DB::select("SELECT fases.numero,postura_huevo.cantidad_muertas from postura_huevo,fases_galpon,fases WHERE fases_galpon.id=postura_huevo.id_fases_galpon AND fases.id=fases_galpon.id_fase AND Date_format(postura_huevo.fecha,'%Y/%M/%d')=Date_format('".$request->fecha."','%Y/%M/%d') and fases.nombre!='PONEDORA' ORDER BY fases.numero");
        
            return response()->json($resultado);
        }
    }*/
}
