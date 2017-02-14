<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Egreso;
use App\Categoria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EgresoRequest;
use DB;
use Hash;

class EgresoController extends Controller{
  public function __construct() {
         $this->middleware('auth');
         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
    }

	function index(){     
     //$egreso= DB::table('egreso_varios')->orderBy('id','desc')->paginate(30); 
     $categoria=Categoria::where('tipo',0)->lists('nombre','id');
     return view('egreso.index',compact('categoria',$categoria));
	}
  
	public function create(){
    return view('egreso.create');		
  }

  public function store(EgresoRequest $request){     
    //if ($request->ajax()) {
         $egreso=Egreso::create($request->all());
         return redirect('/egreso')->with('message','GUARDADO CORRECTAMENTE');           
     /*    return response()->json($request->all());
        }  */
  }

  public function update(Request $request,$id){
    if ($request->ajax()) {
         $egreso=DB::table('egreso_varios')->where('id', $id)->update(['detalle' => $request->detalle, 'fecha' => $request->fecha, 'precio'=>$request->precio, 'id_categoria'=>$request->id_categoria]);        
        return response()->json($request->all());
    }      
  /*  $egreso= Egreso::find($id);
    $egreso->fill($request->all());
    $egreso->save();
    return redirect('/egreso')->with('message','MODIFICADO CORRECTAMENTE');  */
  }

  public function edit($id){
      $egreso=Egreso::find($id);
      $categoria=Categoria::where('tipo',0)->lists('nombre','id');
      return view('egreso.edit',compact('categoria',$categoria),['egreso'=>$egreso]);
  }

  public function destroy(Request $request){
      $id=$request->get('id_egreso');
      $egreso=Egreso::find($id);
      $egreso->delete();
      Session::flash('message','EGRESO ELIMINADO');
     return Redirect::to('/lista_egreso');
  }

    public function lista_egreso() {
     $categoria=Categoria::where('tipo',0)->lists('nombre','id');
     return view('egreso.index',compact('categoria',$categoria));      
  }

  public function egreso_lista($fecha_inicio, $fecha_fin){         
      $egreso=DB::select("SELECT egreso_varios.id,egreso_varios.detalle,egreso_varios.precio,egreso_varios.id_categoria,egreso_varios.fecha FROM egreso_varios WHERE egreso_varios.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND egreso_varios.deleted_at IS NULL ORDER BY egreso_varios.fecha DESC");
      return response()->json($egreso);
  }

  public function actualizar_egreso($id){         
      $ingreso=DB::select("SELECT egreso_varios.id,egreso_varios.detalle,egreso_varios.precio,egreso_varios.id_categoria,egreso_varios.fecha FROM egreso_varios WHERE egreso_varios.id=".$id);
      return response()->json($ingreso);
  }   

  public function select_egreso($id){         
      $select=DB::select("SELECT categoria.id, categoria.nombre from categoria WHERE categoria.deleted_at IS NULL AND categoria.tipo=0 AND categoria.id=".$id."
      UNION
      SELECT categoria.id, categoria.nombre from categoria WHERE categoria.deleted_at IS NULL AND categoria.tipo=0 AND categoria.id!=".$id);
      return response()->json($select);
  }   
}
