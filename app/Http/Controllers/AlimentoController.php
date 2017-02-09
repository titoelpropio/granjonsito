<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Alimento;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AlimentoRequest;
use DB;
use Hash;
class AlimentoController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }
	public function index(){
     $alimento=DB::table('alimento')->orderBy('estado','desc')->paginate(15); 
     return view('alimento.index',compact('alimento'));
	}
  
	public function create(){
    return view('alimento.create');		
  }

  public function store(AlimentoRequest $request){
   // if ($request->ajax()) {
      Alimento::create($request->all());
      return redirect('/alimento')->with('message','GUARDADO CORRECTAMENTE');  
      // return response()->json($request->all());
    //}          
  }

  public function update(AlimentoRequest $request,$id){
    $alimento= Alimento::find($id);
    $alimento->fill($request->all());
    $alimento->save();
    return redirect('/alimento')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $alimento=Alimento::find($id);
      return view('alimento.edit',['alimento'=>$alimento]);
  }

 public  function update_estado_alimento(Request $request){
     if($request->ajax()){
         $resultado=DB::table('alimento')->where('id',$request['id'])->update(['estado'=>$request->estado]);         
      return response()->json($resultado);   
     }  
 }
}
