<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\HuevoAcumulado;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\HuevoAcumuladoRequest;
use DB;

class HuevoAcumuladoController extends Controller{
  
  function index(){ }
  
	public function create(){
    return view('huevoacumulado.create');		
  }

  public function store(Request $request){
  $contador=DB::select("SELECT COUNT(*) as contador,id from huevo_acumulado");
        foreach ($contador as $key => $value) {
            $cont = $value->contador;
            $id = $value->id;
        }
    if ($cont==0) {
        HuevoAcumulado::create($request->all());
        return response()->json($request->all());   
    }
    else{
        $HuevoAcumulado= HuevoAcumulado::find($id);
        $HuevoAcumulado->fill($request->all());
        $HuevoAcumulado->save();
        return response()->json($request->all()); 
    }
  }
}
