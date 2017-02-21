<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\VacunaEmergente;
use App\Http\Requests\VacunaEmergenteRequest;
use Session;
use Redirect;
use DB;
use Hash;

class VacunaEmegerteController extends Controller{

public function __construct() {
   $this->middleware('auth');
   $this->middleware('admin');
   $this->middleware('auth',['only'=>'admin']);
}

function index(){
 $vacuna=VacunaEmergente::paginate(30);
    return view('vacuna_emergente.index',compact('vacuna'));
}

public function create(){
    //return view('vacuna.create');	
}
  
public function store(VacunaEmergenteRequest $request){
     VacunaEmergente::create($request->all());
     return redirect('/vacuna_emergente')->with('message','GUARDADO CORRECTAMENTE');  
}

public function edit($id){
 $vacuna = VacunaEmergente::find($id);
 return view('vacuna_emergente.edit',compact('vacuna'));  
}

public function vacunagalpon(){//lista los galpones a vacunar para el dia actual
  $vacuna=DB::select("select edad.edad,g.nombre as galpon,v.nombre, v.detalle,g.id as idgalpon,v.id as idvacuna FROM galpon g, edad,vacuna v WHERE g.id=edad.id_galpon and edad.edad=v.edad and v.estado=1 and edad.estado=1 and (not EXISTS(select * from galpon, galpon_vacuna, vacuna where v.id=galpon_vacuna.id_vacuna AND g.id=galpon.id and vacuna.id=galpon_vacuna.id_vacuna and date_format(galpon_vacuna.fecha,'%Y/%M/%d')=date_format(now(),'%Y/%M/%d')))");
  $vacunaActivas=Vacuna::where('vacuna.estado','=','1')->lists('nombre','id');
      //$silo=paginate::make(DB::select($query),7);
  return view('vacuna.vacunagalpon',compact('vacuna','vacunaActivas'));
}

public function galponavacunar(){//lista los galpones a vacunar para el dia actual
  $vacuna=DB::select("select edad.edad,g.nombre as galpon,v.nombre, v.detalle,g.id as idgalpon,v.id as idvacuna FROM galpon g, edad,vacuna v WHERE g.id=edad.id_galpon and edad.edad=v.edad and v.estado=1 and edad.estado=1 and (not EXISTS(select * from galpon, galpon_vacuna, vacuna where v.id=galpon_vacuna.id_vacuna AND g.id=galpon.id and vacuna.id=galpon_vacuna.id_vacuna and date_format(galpon_vacuna.fecha,'%Y/%M/%d')=date_format(now(),'%Y/%M/%d')))");
  $vacunaActivas=Vacuna::where('vacuna.estado','=','1')->lists('nombre','id');
      //$silo=paginate::make(DB::select($query),7);
  return view('vacuna.galponavacunar',compact('vacuna','vacunaActivas'));
}

 public function update($id, VacunaEmergenteRequest $request){
    $resultado=DB::table('vacuna_emergente')->where('id',$id)->update(['nombre'=>$request->nombre,'detalle'=>$request->detalle,'precio'=>$request->precio]);
    return redirect('/vacuna_emergente')->with('message','MODIFICADO CORRECTAMENTE'); 
 }
    
public function destroy(Request $request){
    $id = $request->get("id_con_vac");
    $vacuna=VacunaEmergente::find($id);
    $vacuna->delete();
    $vacuna::destroy($id);
    Session::flash('message','VACUNA EMERGENTE ELIMINADAD');
    return Redirect::to('/vacuna_emergente');
} 
    
public function listavacuna(){//lista de vacuna para el select en el modal del formulario vacunagalpon
//    $vacunaActivas=Vacuna::where('vacuna.estado','=','1')->lists('nombre','detalle','id');
     $vacuna=DB::select("select edad,nombre, detalle, id from `vacuna` where `vacuna`.`deleted_at` is null and estado=1 order by edad");
    return response()->json($vacuna);
}

public function agregar_listavacuna($id_edad){//lista de vacuna nuevas q se van a agregar personalizado
     $vacuna=DB::select("SELECT DISTINCT vacuna.id as id_vacuna,vacuna.edad,vacuna.nombre,vacuna.detalle,vacuna.estado from vacuna WHERE (NOT EXISTS(SELECT *from control_vacuna,edad WHERE vacuna.id=control_vacuna.id_vacuna AND edad.id=control_vacuna.id_edad AND edad.id=".$id_edad." order by edad))");
    return response()->json($vacuna);
}


 public  function cambiarestado(Request $request){
     if($request->ajax()){
          $resultado=DB::table('vacuna_emergente')->where('id',$request['id'])->update(['estado'=>$request->estado]);
          return response()->json($resultado);   
     }
 } 
}
