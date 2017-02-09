<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Galpon;
use App\PosturaHuevo;
use App\GallinaMuerta;
use App\Edad;
use App\HuevoAcumulado;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Requests\GalponCreateRequest;
use App\Http\Requests\GalponUpdateRequest;
use DB;


class GalponController extends Controller {

function index() {
    try {
              DB::beginTransaction(); 
              $lista2=array();
              $lista3=array();
          $consumo = DB::SELECT("SELECT alimento.tipo, consumo.cantidad, consumo.id,galpon.numero as numero_galpon,fases.numero as numero_fase,fases.nombre,consumo.fecha,silo.id as id_silo,silo.nombre as nombre_silo FROM silo,consumo,fases_galpon,fases,edad,galpon,alimento WHERE consumo.id_fase_galpon=fases_galpon.id and silo.id=consumo.id_silo AND fases_galpon.id_edad=edad.id and edad.id_galpon=galpon.id and fases_galpon.id_fase=fases.id and Date_format(consumo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and galpon.numero<=8 AND fases.nombre='PONEDORA' and silo.id_alimento=alimento.id
     order by galpon.numero");
    $consumo2 = DB::SELECT("SELECT alimento.tipo, consumo.cantidad, consumo.id,galpon.numero as numero_galpon,fases.numero as numero_fase,fases.nombre,consumo.fecha,silo.id as id_silo,silo.nombre as nombre_silo FROM silo,consumo,fases_galpon,fases,edad,galpon,alimento WHERE consumo.id_fase_galpon=fases_galpon.id and silo.id=consumo.id_silo AND fases_galpon.id_edad=edad.id and edad.id_galpon=galpon.id and fases_galpon.id_fase=fases.id and Date_format(consumo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and galpon.numero>8 AND fases.nombre='PONEDORA' and silo.id_alimento=alimento.id order by galpon.numero");
    $galpon=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases_galpon.id as id_fase_galpon,galpon.numero,galpon.capacidad_total,DATEDIFF(now(),edad.fecha_inicio)AS edad,fases_galpon.cantidad_inicial,fases_galpon.cantidad_actual,fases.nombre,fases_galpon.total_muerta from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre='PONEDORA' and edad.estado=1 and galpon.numero<=8 order by numero ");
    $postura_huevo=DB::select("SELECT postura_huevo.id as id_postura_huevo,celda1,celda2,celda3,celda4,postura_huevo.postura_p,postura_huevo.cantidad_total,galpon.id as id_galpon,galpon.numero,edad.id as id_edad,fases_galpon.total_muerta ,postura_huevo.cantidad_muertas  from postura_huevo,galpon,edad,fases_galpon,fases WHERE edad.id_galpon=galpon.id and fases_galpon.id_edad=edad.id and postura_huevo.id_fases_galpon=fases_galpon.id and edad.estado=1 and fases_galpon.id_fase=fases.id AND fases.nombre='PONEDORA' AND Date_format(postura_huevo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and galpon.numero<=8 order by numero");   

    $temperatura=DB::select("select temperatura from temperatura"); 
    $galpon2=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases_galpon.id as id_fase_galpon,galpon.numero,galpon.capacidad_total,DATEDIFF(now(),edad.fecha_inicio)AS edad,fases_galpon.cantidad_inicial,fases_galpon.cantidad_actual,fases.nombre,fases_galpon.total_muerta from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre='PONEDORA' and edad.estado=1 and galpon.numero>8 order by numero");
    $postura_huevo2=DB::select("SELECT postura_huevo.id as id_postura_huevo,celda1,celda2,celda3,celda4,postura_huevo.postura_p,postura_huevo.cantidad_total,galpon.id as id_galpon,galpon.numero,edad.id as id_edad,fases_galpon.total_muerta ,postura_huevo.cantidad_muertas  from postura_huevo,galpon,edad,fases_galpon,fases WHERE edad.id_galpon=galpon.id and fases_galpon.id_edad=edad.id and postura_huevo.id_fases_galpon=fases_galpon.id and edad.estado=1 and fases_galpon.id_fase=fases.id AND fases.nombre='PONEDORA' AND Date_format(postura_huevo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and galpon.numero>8 order by numero");  
        $fecha=DB::select("SELECT curdate()as fecha");
$contador=0;
     for ($i=0; $i < count($galpon) ; $i++) { //este es para las vacunas de los galpones 1-8

              $verificar=DB::select("SELECT vacuna.id, vacuna.edad,vacuna.nombre,vacuna.detalle,".$galpon[$i]->numero." as galpon,(vacuna.edad - ".$galpon[$i]->edad.") AS dias FROM vacuna WHERE vacuna.edad>=".$galpon[$i]->edad." AND vacuna.estado=1 order by edad LIMIT 1");   
         if (count($verificar) != 0) {
              $lista2[$contador] = $verificar;
              $contador++;
            }
          
       }
      
       $contador=0;
        for ($i=0; $i < count($galpon2) ; $i++) { //este es para las vacunas de los galpones 1-8

              $verificar=DB::select("SELECT vacuna.id, vacuna.edad,vacuna.nombre,vacuna.detalle,".$galpon2[$i]->numero." as galpon,(vacuna.edad - ".$galpon2[$i]->edad.") AS dias FROM vacuna WHERE vacuna.edad>=".$galpon2[$i]->edad." AND vacuna.estado=1 order by edad LIMIT 1");   
         if (count($verificar) != 0) {
              $lista3[$contador] = $verificar;
              $contador++;
            }
          
       }
       DB::commit();

    return view("galpon.index",compact('lista3','lista2','consumo','consumo2','galpon','postura_huevo','galpon2','postura_huevo2','temperatura','fecha'));
    } catch (Exception $e) {
           DB::rollback();
          return redirect('/')->with('message-error','A OCURRIDO UN ERROR');  
    }
}

public function update_galpon(Request $request) {
    try {
    DB::beginTransaction();
    $contador = DB::select("SELECT COUNT(*) AS contador, id,cantidad_total  FROM postura_huevo WHERE Date_format(postura_huevo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and postura_huevo.id_fases_galpon=?", [$request->id_fases_galpon]);
        $cont = $contador[0]->contador;
        $id = $contador[0]->id;
    
    if ($cont == 0) {
        if ($request->ajax()) {
            $postura_huevo=PosturaHuevo::create($request->all());
            DB::commit();
            return response()->json($request->all());
        }
    } else {
        $postura_huevo = PosturaHuevo::find($id);
        $postura_huevo->fill($request->all());
        $postura_huevo->save();
        DB::commit();
         return response()->json($request->all());
    }            

    } catch (Exception $e) {
         DB::rollback();
    }
}

  
    

    public function obtenerdadafecha(Request $request) {
        if ($request->ajax()) {
            $resultado = DB::select("SELECT postura_huevo.id as id_postura_huevo,celda1,celda2,celda3,celda4,postura_huevo.postura_p,postura_huevo.cantidad_total,galpon.id as id_galpon,galpon.numero,edad.id as id_edad,fases_galpon.total_muerta,postura_huevo.cantidad_muertas from postura_huevo,galpon,edad,fases_galpon,fases WHERE edad.id_galpon=galpon.id and fases_galpon.id_edad=edad.id and postura_huevo.id_fases_galpon=fases_galpon.id AND fases.id=fases_galpon.id_fase AND fases.nombre='PONEDORA' and edad.estado=1 and Date_format(postura_huevo.fecha,'%Y/%M/%d')=Date_format('".$request->fecha."','%Y/%M/%d') order by numero");
            return response()->json($resultado);
        }
    }
    
    public function obtenerdadafecha_cria(Request $request) {
        if ($request->ajax()) {
            $resultado = DB::select("SELECT fases.numero,postura_huevo.cantidad_muertas from postura_huevo,fases_galpon,fases WHERE fases_galpon.id=postura_huevo.id_fases_galpon AND fases.id=fases_galpon.id_fase AND Date_format(postura_huevo.fecha,'%Y/%M/%d')=Date_format('".$request->fecha."','%Y/%M/%d') and fases.nombre!='PONEDORA' ORDER BY fases.numero");
            return response()->json($resultado);
        }
    }


    public function update3(Request $request, $id) { //ACTUALIZA LA CANTIDAD ACTUAL Y TOTAL MUERTAS Q SE INTRODUCE EN LOS GALPONES
        if ($request->ajax()) {
            $actua = DB::table('fases_galpon')->where('id', $id)->update(['cantidad_actual'=>$request->cantidad_actual,'total_muerta'=>$request->total_muerta]);
            return response()->json($request->all());
        }
    }

    public function lista_galpones(){ 
        $otro=DB::select("SELECT galpon.id as id_galpon,galpon.numero,edad.id as id_edad FROM galpon,edad,fases_galpon,fases WHERE galpon.id=edad.id_galpon AND edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND edad.estado=1 and fases.nombre='PONEDORA' ORDER BY galpon.numero");
        return response()->json($otro);
    }

    public function detalle_galpon($id_edad, $fecha_inicio, $fecha_fin, $sw){ 
        if ($id_edad == 0) {
            if ($sw == 0) {
                $otro=DB::select("SELECT fases_galpon.fecha_inicio,galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(postura_huevo.cantidad_muertas)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 AND fases.nombre='PONEDORA' GROUP BY edad.id ORDER BY id_fase DESC,galpon.numero");
            } else {
                $otro=DB::select("SELECT fases_galpon.fecha_inicio,galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(postura_huevo.cantidad_muertas)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 and postura_huevo.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY) AND fases.nombre='PONEDORA' GROUP BY edad.id ORDER BY id_fase DESC,galpon.numero");
            }
        }
        else{
            if ($sw == 0) {
                $otro=DB::select("SELECT fases_galpon.fecha_inicio,galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(postura_huevo.cantidad_muertas)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 AND edad.id=".$id_edad." GROUP BY edad.id,fases.nombre ORDER BY id_fase DESC,galpon.numero");
            } else {
                $otro=DB::select("SELECT fases_galpon.fecha_inicio,galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(postura_huevo.cantidad_muertas)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 and postura_huevo.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY) AND edad.id=".$id_edad." GROUP BY edad.id,fases.nombre ORDER BY id_fase DESC,galpon.numero");
            }
        }
        return response()->json($otro);
    }


    public function lista_fases(){ 
        $otro=DB::select("SELECT galpon.id as id_galpon,galpon.numero,edad.id as id_edad,fases.nombre FROM galpon,edad,fases_galpon,fases WHERE galpon.id=edad.id_galpon AND edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND edad.estado=1 and fases.nombre!='PONEDORA' and fases_galpon.fecha_fin IS NULL ORDER BY fases.numero");
        return response()->json($otro);
    }

    public function detalle_fases($id_edad){ 
        if ($id_edad == 0) {
            $otro=DB::select("SELECT fases.nombre,fases_galpon.fecha_inicio,galpon.numero,SUM(fases_galpon.total_muerta)as total_muerta,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 AND fases.nombre!='PONEDORA' AND fases_galpon.fecha_fin IS NULL  GROUP BY edad.id ORDER BY id_fase");
        }else{
            $otro=DB::select("SELECT fases_galpon.fecha_inicio,galpon.id as id_galpon,galpon.numero,edad.id as id_edad,fases.nombre,fases_galpon.total_muerta FROM galpon,edad,fases_galpon,fases WHERE galpon.id=edad.id_galpon AND edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND edad.estado=1 and fases.nombre!='PONEDORA' AND edad.id=".$id_edad." ORDER BY fases.numero DESC");
        }
        return response()->json($otro);
    }


    public function listareporte($fecha_inicio, $fecha_fin){ 
        $otro=DB::select("SELECT galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(fases_galpon.total_muerta)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo  WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 GROUP BY edad.id ORDER BY id_fase,galpon.numero");         
        return response()->json($otro);
    }

    public function listareporte_aux($fecha_inicio, $fecha_fin, $id_edad){ 
        $otro=DB::select("SELECT galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(fases_galpon.total_muerta)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 AND edad.id=".$id_edad." GROUP BY edad.id,fases.nombre ORDER BY id_fase DESC,galpon.numero");
        return response()->json($otro);
    }

    public function reporte() {
        return view('galpon.reporte');
    }

    public function reporte_fase() {
        return view('galpon.reporte_fase');
    }

    public function reporte_comparacion() {
        return view('galpon.reporte_comparacion');
    }

    public function store(GalponCreateRequest $request) {
    if($request->ajax()){
      DB::table('galpon')->insert([
        'numero' => $request->numero,
        'capacidad_total' => $request->capacidad_total]);          
        return response()->json($request->all());
        }
    }

     public function listagalpon(){
        $otro=DB::select("SELECT * from galpon order by numero");
        return response()->json($otro);
    }

    public function vistagalpon(){
        $galpon = Galpon::paginate(20);        
        $res=DB::select("SELECT COUNT(*) as contador from galpon");
        foreach ($res as $key => $value) {
            $contador=$value->contador+1;
        }
         return view('galpon.listagalpon2',compact('galpon','contador',$contador));
    }

    public function getgalpon(Request $request, $tipe) {
        if ($request->ajax()) {
            $cont = DB::select("SELECT COUNT(*) as contador from galpon WHERE tipo_galpon=".$tipe);
            foreach ($cont as $key => $value) {
                $contador=$value->contador;
            }
            if ($tipe==0) 
                $contador=$contador+17;
            else
                $contador=$contador+1;
            return response()->json($contador);
        }
    }

    public function create() {   
        return view('galpon.create');
    }

    public function edit($id) {
      $galpon=Galpon::find($id);
        return response()->json($galpon);
    }

    public function update(GalponUpdateRequest $request, $id)
    {
    $actua= DB::table('galpon')->where('id', $id)->update(['numero' => $request->numero,'capacidad_total' => $request->capacidad_total]);
    return response()->json(["mensaje" => "listo"]);
    }

    public function mostrar_tem(Request $request){
        $temperatura=DB::select("select temperatura from temperatura");
        return response()->json($temperatura);
    }
    
    public function actualizar_control_alimento(Request $request){
        $control=array();
        $contador=0;
        $galpon=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases_galpon.id as id_fase_galpon,galpon.numero,galpon.capacidad_total,DATEDIFF(now(),edad.fecha_inicio)AS edad,fases_galpon.cantidad_inicial,fases_galpon.cantidad_actual,fases.nombre,fases_galpon.total_muerta from edad,fases_galpon,galpon,fases WHERE edad.id_galpon=galpon.id and edad.id=fases_galpon.id_edad and fases.id=fases_galpon.id_fase and fases.nombre='PONEDORA' and edad.estado=1 and galpon.numero<=16 order by numero");

        foreach ($galpon as $key => $value) {
        
            $verificar=DB::select("SELECT ".$value->numero." as numero,control_alimento.id as id_control ,cantidad,tipo,alimento.tipo FROM control_alimento,rango_edad,rango_temperatura,alimento WHERE control_alimento.id_temperatura=rango_temperatura.id and  control_alimento.id_edad= rango_edad.id 
and control_alimento.id_alimento=alimento.id and control_alimento.deleted_at IS NULL and rango_edad.edad_min<=".$value->edad." and rango_edad.edad_max>=".$value->edad ." and rango_temperatura.temp_min<=".$request->temperatura."  and rango_temperatura.temp_max>=".$request->temperatura); 
            if (count($verificar)!=0) {
              $control[$contador]=$verificar;

            }
            else
            {
                $control[$contador]=$value->numero;
            }
                  $contador++;
      
        }
        return response()->json($control);
    }

    public function lista_id_edad(){
       $lista2=array();
       $lista=DB::select("SELECT edad.id as id_edad, galpon.id as id_galpon, galpon.numero, DATEDIFF(curdate(),edad.fecha_inicio)as edad, edad.fecha_inicio,fases.nombre as fase FROM edad,fases_galpon,fases,galpon WHERE edad.id_galpon=galpon.id AND edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases.nombre='PONEDORA' AND edad.estado=1 ORDER by galpon.numero");
       for ($i=0; $i < count($lista) ; $i++) { 
            $lista2[$i]=DB::select("SELECT vacuna.id, vacuna.edad,vacuna.nombre,vacuna.detalle,".$lista[$i]->numero." as galpon,(vacuna.edad - ".$lista[$i]->edad.") AS dias FROM vacuna WHERE vacuna.edad>=".$lista[$i]->edad." AND vacuna.estado=1 order by edad LIMIT 1");   
       }
      return response()->json($lista2);
    } 

    public function lista_de_silos($id_control){
        $silo=DB::select("SELECT control_alimento.id as id_control,alimento.id as id_alimento, alimento.tipo, silo.id as id_silo, silo.nombre, silo.cantidad from control_alimento,alimento,silo WHERE control_alimento.id_alimento=alimento.id AND silo.id_alimento=alimento.id AND control_alimento.id='".$id_control."' and silo.estado=1 AND alimento.estado=1");
        return response()->json($silo);
    }

    public function lista_de_silos_aux($id_silo){
        $silo=DB::select("SELECT alimento.id as id_alimento, alimento.tipo, silo.id as id_silo, silo.nombre, silo.cantidad from silo,alimento WHERE alimento.id=silo.id_alimento and alimento.estado=1 and silo.estado=1 and silo.id!=".$id_silo);
        return response()->json($silo);
    }

}

