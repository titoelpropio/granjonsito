<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categoria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaRequest;
use DB;
use Hash;
class CategoriaController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }

	function index(){
     $categoria=DB::select("SELECT id,nombre,tipo FROM categoria where categoria.deleted_at IS NULL ORDER BY tipo");
     return view('categoria.index',compact('categoria'));
	}
  
	public function create(){
    return view('categoria.create');		
  }

  public function store(CategoriaRequest $request){     
  //  if ($request->ajax()) {
         $categoria=Categoria::create($request->all());
         return redirect('/categoria')->with('message','GUARDADO CORRECTAMENTE');  
      /*   return response()->json($request->all());
        }  */ 
  }

  public function update(CategoriaRequest $request,$id){
    $categoria= Categoria::find($id);
    $categoria->fill($request->all());
    $categoria->save();
    return redirect('/categoria')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $categoria=Categoria::find($id);
      return view('categoria.edit',['categoria'=>$categoria]);
  }

  public function destroy(Request $request){
     $id=$request->get('id_gasto');
      $ingreso=Categoria::find($id);
      $ingreso->delete();
      Session::flash('message','ELIMINADO CORRECTAMENTE');
     return Redirect::to('/categoria');
  }
}
