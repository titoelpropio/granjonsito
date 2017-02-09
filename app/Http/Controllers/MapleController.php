<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Maple;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MapleRequest;
use DB;
use Hash;

class MapleController extends Controller
{
  public function __construct() {
         $this->middleware('auth');
         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
    }
    
	function index(){
     $maple=Maple::paginate(10);
     return view('maple.index',compact('maple'));
	}
  
	public function create(){
    return view('maple.create');		
  }

  public function store(MapleRequest $request){
      //if ($request->ajax()) {
       Maple::create($request->all());
       return redirect('/maple')->with('message','GUARDADO CORRECTAMENTE');  
     /* return response()->json($request->all());
      }*/
  }

  public function update(MapleRequest $request,$id){
    $maple= Maple::find($id);
    $maple->fill($request->all());
    $maple->save();
    return redirect('/maple')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $maple=Maple::find($id);
      return view('maple.edit',['maple'=>$maple]);
  }


  public function show($id){
    $maple=Maple::find($id);
    return view('maple.destroy',['maple'=>$maple]);
  }

  public function destroy($id) {

    $result=DB::select("SELECT COUNT(*)as contador,tamano from maple,tipo_caja WHERE maple.id=tipo_caja.id_maple AND maple.id=".$id." and tipo_caja.estado=1");
    $result_2=DB::select("SELECT COUNT(*)as contador,tamano from maple,tipo_huevo WHERE maple.id=tipo_huevo.id_maple AND maple.id=".$id." and tipo_huevo.estado=1");
    if ($result[0]->contador==0 || $result_2[0]->contador==0) {
      if ($result[0]->contador==0) {
        if ($result_2[0]->contador==0) {
          $maple = Maple::find($id);
          $maple->delete();
          Maple::destroy($id);
          return response()->json($id);
        } else {
          $maple=$result_2[0]->tamano;
          return response()->json(["mensaje"=>"EXISTE ".$result_2[0]->contador." TIPO DE HUEVO QUE UTILIZAN EL MAPLE ".$maple." VERIFIQUE ANTES DE PODER ELIMINAR"]);
        }
      }else {
        $maple=$result[0]->tamano;
        return response()->json(["mensaje"=>"EXISTE ".$result[0]->contador." TIPO DE CAJA QUE UTILIZAN EL MAPLE ".$maple." VERIFIQUE ANTES DE PODER ELIMINAR"]);
      }
    }else {
      $maple=$result[0]->tamano;
      return response()->json(["mensaje"=>"EXISTE ".$result[0]->contador." TIPO DE CAJA QUE UTILIZAN EL MAPLE ".$maple." Y EXISTE ".$result_2[0]->contador." TIPO DE HUEVO QUE UTILIZAN EL MAPLE ".$maple." VERIFIQUE ANTES DE PODER ELIMINAR"]);
    }
  }

}
