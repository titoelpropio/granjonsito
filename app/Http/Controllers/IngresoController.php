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
     $ingreso= DB::table('ingreso_varios')->orderBy('id','desc')->paginate(30); 
     $categoria=Categoria::where('tipo',1)->lists('nombre','id');
     return view('ingreso.index',compact('ingreso','categoria',$categoria));
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

  public function update(IngresoRequest $request,$id){
    $ingreso= Ingreso::find($id);
    $ingreso->fill($request->all());
    $ingreso->save();
    return redirect('/ingreso')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $ingreso=Ingreso::find($id);
      $categoria=Categoria::where('tipo',1)->lists('nombre','id');
      return view('ingreso.edit',compact('categoria',$categoria),['ingreso'=>$ingreso]);
  }

  public function destroy($id){
    /*  $edad=Edad::find($id);
      $edad->delete();
      Session::flash('message','Edad Eliminado Correctamente');
     return Redirect::to('/edad');*/
  }
}
