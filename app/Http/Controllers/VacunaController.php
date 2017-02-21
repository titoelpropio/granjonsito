<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Vacuna;
use App\Http\Requests\VacunaCreateRequest;
use Session;
use Redirect;
use DB;
use Hash;

class VacunaController extends Controller{

public function __construct() {
   $this->middleware('auth');
   $this->middleware('admin');
   $this->middleware('auth',['only'=>'admin']);
}

function index(){
 $vacuna=Vacuna::paginate(15);
    return view('vacuna.index',compact('vacuna'));
}

public function create(){
    return view('vacuna.create');	
}
  
public function store(VacunaCreateRequest $request){
  //if ($request->ajax()) {
     Vacuna::create($request->all());
     return redirect('/vacuna')->with('message','GUARDADO CORRECTAMENTE');  
    // return response()->json($request->all());
 // }
}

public function edit($id){
 $vacuna = Vacuna::find($id);
 return view('vacuna.edit',compact('vacuna'));
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

 public function update($id, VacunaCreateRequest $request){
    $resultado=DB::table('vacuna')->where('id',$id)->update(['edad'=>$request->edad,'nombre'=>$request->nombre,'detalle'=>$request->detalle,'precio'=>$request->precio]);
    return redirect('/vacuna')->with('message','MODIFICADO CORRECTAMENTE'); 
 }
    
public function destroy(Request $request){
    $id=$request->get('id_vac');
    $vacuna=Vacuna::find($id);
    $vacuna->delete();
    $vacuna::destroy($id);
    Session::flash('message','VACUNA ELIMINADA');
    return Redirect::to('/vacuna');
} 
    
public function listavacuna(){//lista de vacuna para el select en el modal del formulario vacunagalpon
//    $vacunaActivas=Vacuna::where('vacuna.estado','=','1')->lists('nombre','detalle','id');
     $vacuna=DB::select("select edad,nombre, detalle, id from `vacuna` where `vacuna`.`deleted_at` is null and estado=1 order by edad");
    return response()->json($vacuna);
}

public function agregar_listavacuna($id_edad){//lista de vacuna nuevas q se van a agregar personalizado
     $vacuna=DB::select("SELECT DISTINCT vacuna.id as id_vacuna,vacuna.edad,vacuna.nombre,vacuna.detalle,vacuna.estado from vacuna WHERE vacuna.deleted_at IS NULL AND (NOT EXISTS(SELECT *from control_vacuna,edad WHERE vacuna.id=control_vacuna.id_vacuna AND edad.id=control_vacuna.id_edad AND edad.id=".$id_edad." order by edad))");
    return response()->json($vacuna);
}


 public  function cambiarestado(Request $request){
     if($request->ajax()){
          $resultado=DB::table('vacuna')->where('id',$request['id'])->update(['estado'=>$request->estado]);
          return response()->json($resultado);   
     }
 } 
}
