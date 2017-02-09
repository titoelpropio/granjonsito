<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Fases;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\FasesRequest;
use DB;
use Hash;

class FasesController extends Controller{
  public function __construct() {
         $this->middleware('auth');
         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
  }

	function index(){
     $fases= DB::table('fases')->paginate(30); 
     return view('fases.index',compact('fases'));
	}
  
	public function create(){
    return view('fases.create');		
  }

  public function store(FasesRequest $request){     
      //if ($request->ajax()) {
         $fases=Fases::create($request->all());
         return redirect('/fases')->with('message','GUARDADO CORRECTAMENTE');  
        // return response()->json($request->all());
      //}        
  }

  public function update(FasesRequest $request,$id){
    $fases= Fases::find($id);
    $fases->fill($request->all());
    $fases->save();
    return redirect('/fases')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $fases=Fases::find($id);
      return view('fases.edit',['fases'=>$fases]);
  }

  public function destroy($id){
    /*  $edad=Edad::find($id);
      $edad->delete();
      Session::flash('message','Edad Eliminado Correctamente');
     return Redirect::to('/edad');*/
  }
}
