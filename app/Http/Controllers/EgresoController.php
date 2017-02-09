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
     $egreso= DB::table('egreso_varios')->orderBy('id','desc')->paginate(30); 
     $categoria=Categoria::where('tipo',0)->lists('nombre','id');
     return view('egreso.index',compact('egreso','categoria',$categoria));
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

  public function update(EgresoRequest $request,$id){
    $egreso= Egreso::find($id);
    $egreso->fill($request->all());
    $egreso->save();
    return redirect('/egreso')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $egreso=Egreso::find($id);
      $categoria=Categoria::where('tipo',0)->lists('nombre','id');
      return view('egreso.edit',compact('categoria',$categoria),['egreso'=>$egreso]);
  }

  public function destroy($id){
    /*  $edad=Edad::find($id);
      $edad->delete();
      Session::flash('message','Edad Eliminado Correctamente');
     return Redirect::to('/edad');*/
  }
}
