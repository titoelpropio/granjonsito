<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ControlVacuna;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use Hash;


class ControlVacunaController extends Controller{

public function __construct() {
   $this->middleware('auth');
   $this->middleware('admin');
   $this->middleware('auth',['only'=>'admin']);
}

  public function lista_control_vacuna() {     
     return view('control_vacuna.index');      
  }

public function select_control_vacuna_ponedora(){
  $select=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases.nombre,galpon.numero FROM edad,galpon,fases_galpon,fases WHERE edad.id_galpon=galpon.id AND edad.estado=1 AND fases.id=fases_galpon.id_fase AND fases_galpon.id_edad=edad.id AND fases.nombre='PONEDORA' GROUP BY edad.id ORDER by galpon.numero");
  return response()->json($select);
}

public function select_control_vacuna_fase(){
  $select=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases.nombre,fases.numero FROM edad,galpon,fases_galpon,fases WHERE edad.id_galpon=galpon.id AND edad.estado=1 AND fases.id=fases_galpon.id_fase AND fases_galpon.id_edad=edad.id AND fases.nombre!='PONEDORA' GROUP BY edad.id ORDER by fases.numero");
  return response()->json($select);
}

function ver_control_vacuna($id_edad){
    $vacuna=DB::select("SELECT galpon.id as id_galpon,galpon.numero,vacuna.edad,vacuna.nombre,vacuna.detalle,control_vacuna.estado,vacuna.precio,edad.id as id_edad,vacuna.id as id_vacuna,control_vacuna.id as id_control_vacuna 
      FROM control_vacuna,vacuna,edad,galpon,fases_galpon,fases 
      WHERE edad.id=control_vacuna.id_edad AND control_vacuna.id_vacuna=vacuna.id AND edad.id_galpon=galpon.id AND edad.estado=1 AND fases.id=fases_galpon.id_fase AND fases_galpon.id_edad=edad.id AND edad.id=".$id_edad." ORDER by vacuna.edad");
      return response()->json($vacuna);
}

public function lista_vacuna($id_ed){
  $id_edad=DB::select("SELECT COUNT(*)as contador from control_vacuna,edad WHERE control_vacuna.id_edad=edad.id AND edad.estado=1 AND edad.id=".$id_ed);  
  return response()->json($id_edad);
}


public function create(){
    return view('vacuna.create');	
}
  
public function store(Request $request){
  try {
    DB::beginTransaction();  
      $id_vacuna=$request->get('id_vacuna');
      $cont=0;
      while ( $cont < count($id_vacuna)) {
        $rango_temp = DB::table('control_vacuna')->insert(['id_edad' => $request->get('id_edad1'), 'id_vacuna' => $id_vacuna[$cont], 'estado' =>1]);
        $cont=$cont+1;
      }
    DB::commit();
    return redirect('/edad')->with('message','GUARDADO CORRECTAMENTE');  
  } catch (Exception $e) {
    DB::rollback();
  }
  return Redirect::to("ventacaja");
}

public function store_2(Request $request){
  try {
    DB::beginTransaction();  
      $id_vacuna=$request->get('id_vacuna');
      $cont=0;
      while ( $cont < count($id_vacuna)) {
        $rango_temp = DB::table('control_vacuna')->insert(['id_edad' => $request->get('id_edad1'), 'id_vacuna' => $id_vacuna[$cont], 'estado' =>1]);
        $cont=$cont+1;
      }
    DB::commit();
    return redirect('/lista_control_vacuna')->with('message','GUARDADO CORRECTAMENTE');  
  } catch (Exception $e) {
    DB::rollback();
  }
  return Redirect::to("ventacaja");
}

public function edit($id){
 $vacuna = Vacuna::find($id);
 return view('vacuna.edit',compact('vacuna'));
}

 public function update($id, Request $request){
  if ($request->ajax()) {
     $resultado=DB::table('control_vacuna')->where('id',$id)->update(['estado'=>$request->estado]);
     return response()->json($resultado);
  }
 }
    
public function destroy($id){
    $vacuna=Vacuna::find($id);
    $vacuna->delete();
    $vacuna::destroy($id);
    Session::flash('message','Vacuna Eliminada Correctamente');
    return Redirect::to('/vacuna');
} 
    
}
