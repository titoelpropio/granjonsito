<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TipoHuevo;
use App\Maple;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TipoHuevoRequest;
use DB;
use Hash;
class TipoHuevoController extends Controller
{
  public function __construct() {
         $this->middleware('auth');
         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
    }

	function index(){
     $tipohuevo=DB::select("SELECT tipo_huevo.id,tipo_huevo.tipo,tipo_huevo.precio,maple.tamano,tipo_huevo.estado,maple.cantidad from tipo_huevo,maple WHERE tipo_huevo.id_maple=maple.id order by estado,id desc");
     $maple=Maple::lists('tamano','id');     
     return view('tipohuevo.index',compact('tipohuevo','maple',$maple));
	}
 
	public function create(){
    return view('tipohuevo.create');		
  }

  public function store(TipoHuevoRequest $request){
    //if ($request->ajax()) {
      TipoHuevo::create($request->all());
      return redirect('/tipohuevo')->with('message','GUARDADO CORRECTAMENTE');  
    /*  return response()->json($request->all());
    }*/
  }

  public function update(TipoHuevoRequest $request,$id){
    $tipohuevo= TipoHuevo::find($id);
    $tipohuevo->fill($request->all());
    $tipohuevo->save();
    return redirect('/tipohuevo')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $tipohuevo=TipoHuevo::find($id);
      $maple=Maple::lists('tamano','id'); 
      return view('tipohuevo.edit',compact('maple',$maple),['tipohuevo'=>$tipohuevo]);
  }

 public  function cambiar_estado_tipo_huevo(Request $request){
     if($request->ajax()){
         $resultado=DB::table('tipo_huevo')->where('id',$request['id'])->update(['estado'=>$request->estado]);         
      return response()->json($resultado);   
     }
}
}