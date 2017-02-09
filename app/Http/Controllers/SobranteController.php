<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Sobrante;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SobranteRequest;
use DB;

class SobranteController extends Controller
{
	function index(){	}
  
	public function create(){
    return view('sobrante.create');		
  }

  public function store(Request $request){
    try {
      DB::beginTransaction();
      $contador=DB::select("SELECT COUNT(*) as contador,id from sobrante WHERE Date_format(sobrante.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d') and id_tipo_caja=?", [$request->id_tipo_caja]);
          foreach ($contador as $key => $value) {
              $cont = $value->contador;
              $id = $value->id;
          }
      if ($cont==0) {
        if ($request->ajax()) {
          Sobrante::create($request->all());  
          DB::commit();
          return response()->json($request->all());
        }
      }
      else{
        if ($request->ajax()) {
          $sobrante= Sobrante::find($id);
          $sobrante->fill($request->all());
          $sobrante->save();
          DB::commit();
          return response()->json($request->all());
        }
      }
    }catch (Exception $e) {
       DB::rollback();
    }
  }
  public function update(SobranteRequest $request,$id){
    $sobrante= Sobrante::find($id);
    $sobrante->fill($request->all());
    $sobrante->save();
    return redirect('/sobrante')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $sobrante=Sobrante::find($id);
      return view('sobrante.edit',['sobrante'=>$sobrante]);
  }
}
