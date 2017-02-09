<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TipoCaja;
use App\Maple;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TipoCajaRequest;
use DB;
use Hash;

class TipoCajaController extends Controller
{
  public function __construct() {
      $this->middleware('auth');
      $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }
    
	function index(){
     $tipocaja=DB::select("SELECT tipo_caja.id,tipo,precio,cantidad_maple,tamano,color,tipo_caja.estado from tipo_caja,maple WHERE tipo_caja.id_maple=maple.id order by id,estado ");
     $maple=Maple::lists('tamano','id');
     return view('tipocaja.index',compact('tipocaja',$tipocaja,'maple'));
	}
  
	public function create(){
    $maple=Maple::lists('tamano','id');
    return view('tipocaja.create',compact('maple',$maple));		
  }

  public function store(TipoCajaRequest $request){
      //if ($request->ajax()) {
       TipoCaja::create($request->all());
       return redirect('/tipocaja')->with('message','GUARDADO CORRECTAMENTE');  
       /*return response()->json($request->all());
      }*/
  }

  public function edit($id){
      $tipocaja=TipoCaja::find($id);
      $maple=Maple::lists('tamano','id');
      return view('tipocaja.edit',compact('maple'),['tipocaja'=>$tipocaja]);
  }

  public function update(TipoCajaRequest $request,$id){
    $tipocaja= TipoCaja::find($id);
    $tipocaja->fill($request->all());
    $tipocaja->save();
    return redirect('tipocaja')->with('message','MODIFICADO CORRECTAMENTE'); 
  }

  public  function cambiar_estado_tipo_caja(Request $request){
     if($request->ajax()){
         $resultado=DB::table('tipo_caja')->where('id',$request['id'])->update(['estado'=>$request->estado]);         
      return response()->json($resultado);   
     }  
  }
}
