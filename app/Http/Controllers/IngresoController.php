<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ingreso;
use App\Categoria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\IngresoRequest;
use DB;
use Hash;
class IngresoController extends Controller{
  
  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }

	function index(){
    // $ingreso= DB::table('ingreso_varios')->orderBy('id','desc')->paginate(30); 
     $categoria=Categoria::where('tipo',1)->lists('nombre','id');
     return view('ingreso.index',compact(/*'ingreso',*/'categoria',$categoria));
	}
  
	public function create(){
    return view('ingreso.create');		
  }

  public function store(IngresoRequest $request){     
    //if ($request->ajax()) {
         $categoria=Ingreso::create($request->all());
         return redirect('/ingreso')->with('message','GUARDADO CORRECTAMENTE');  
       /*  return response()->json($request->all());
        }  */
  }

  public function update(Request $request,$id){
    if ($request->ajax()) {
         $ingreso=DB::table('ingreso_varios')->where('id', $id)->update(['detalle' => $request->detalle, 'fecha' => $request->fecha, 'precio'=>$request->precio, 'id_categoria'=>$request->id_categoria]);        
        return response()->json($request->all());
    }     
    /*$id=$request->get('id_ingreso_ac');
    $ingreso= Ingreso::find($id);
    $ingreso->fill($request->all());
    $ingreso->save();
    return redirect('/ingreso')->with('message','MODIFICADO CORRECTAMENTE');  */
  }

  public function edit($id){
      $ingreso=Ingreso::find($id);
      $categoria=Categoria::where('tipo',1)->lists('nombre','id');
      return view('ingreso.edit',compact('categoria',$categoria),['ingreso'=>$ingreso]);
  }

  public function destroy(Request $request,$id){
     $id=$request->get('id_ingreso');
      $ingreso=Ingreso::find($id);
      $ingreso->delete();
      Session::flash('message','INGRESO ELIMINADO');
     return Redirect::to('/lista_ingreso');
  }

  public function lista_ingreso() {
     $categoria=Categoria::where('tipo',1)->lists('nombre','id');
     return view('ingreso.index',compact('categoria',$categoria));      
  }

  public function ingreso_lista($fecha_inicio, $fecha_fin){         
      $ingreso=DB::select("SELECT ingreso_varios.id,ingreso_varios.detalle,ingreso_varios.precio,ingreso_varios.id_categoria,ingreso_varios.fecha FROM ingreso_varios WHERE ingreso_varios.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND ingreso_varios.deleted_at IS NULL ORDER BY ingreso_varios.fecha DESC");
      return response()->json($ingreso);
  }  

  public function actualizar_ingreso($id){         
      $ingreso=DB::select("SELECT ingreso_varios.id,ingreso_varios.detalle,ingreso_varios.precio,ingreso_varios.id_categoria,ingreso_varios.fecha FROM ingreso_varios WHERE ingreso_varios.id=".$id);
      return response()->json($ingreso);
  }   

  public function select_ingreso($id){         
      $select=DB::select("SELECT categoria.id, categoria.nombre from categoria WHERE categoria.deleted_at IS NULL AND categoria.tipo=1 AND categoria.id=".$id."
      UNION
      SELECT categoria.id, categoria.nombre from categoria WHERE categoria.deleted_at IS NULL AND categoria.tipo=1 AND categoria.id!=".$id);
      return response()->json($select);
  }   

}
