<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Silos;
use App\Alimento;
use App\Galpon;
use App\Http\Requests;
use App\Http\Requests\SilosRequests;
use Session;
use Redirect;
use DB;
use App\Quotation; 
use Hash;

class SilosController extends Controller{

  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
     $this->middleware('auth',['only'=>'admin']);
  }

  function index(){
      //$silo=Silos::paginate(7);
    $silo=DB::select('SELECT silo.id,silo.nombre,silo.capacidad,silo.cantidad,silo.cantidad_minima,silo.id_alimento,alimento.tipo,silo.estado FROM silo,alimento WHERE silo.id_alimento=alimento.id order by silo.estado desc,silo.id');
    $result=DB::select("select count(*)as contador from silo");
            foreach ($result as $key => $value){
                $contador=$value->contador+1;
            }
          //   $alimento=Alimento::lists('tipo','id');
    $alimento=Alimento::where('estado',1)->lists('tipo','id');
    return view('silos.index',compact('silo',$silo,'alimento',$alimento,'contador',$contador));
	}


	public function create(){
      $result=DB::select("select count(*)as contador from silo");
      foreach ($result as $key => $value){
          $contador=$value->contador+1;
      }
       $alimento=Alimento::lists('tipo','id');
      return view('silos.create',compact('alimento',$alimento,'contador',$contador));	
    }
    
  public function store(SilosRequests $request){
      //if ($request->ajax()) {
        Silos::create($request->all());
        return redirect('/silo')->with('message','GUARDADO CORRECTAMENTE'); 
        //return response()->json($request->all());
     // }  
  }

  public function edit($id){
    $result=DB::select("SELECT alimento.estado,alimento.tipo from silo,alimento WHERE alimento.id=silo.id_alimento and silo.id=".$id);
    if ($result[0]->estado==0) {
      $alimento=Alimento::lists('tipo','id');
    } else {
      $alimento=Alimento::where('estado',1)->lists('tipo','id');
    }
    
    		
   $silo = Silos::find($id);
   return view('silos.edit',compact('alimento',$alimento),['silo'=>$silo]);
  }

   public function update($id, SilosRequests $request){
        $silo =Silos::find($id);
        $silo->fill($request->all());
        $silo->save();
        return redirect('/silo')->with('message','MODIFICADO CORRECTAMENTE'); 
   }

 public  function update_estado(Request $request){
     if($request->ajax()){
         $resultado=DB::table('silo')->where('id',$request['id'])->update(['estado'=>$request->estado]);         
      return response()->json($resultado);   
     }  
 }
}
