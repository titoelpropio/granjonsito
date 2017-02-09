<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\HuevoDeposito;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\HuevoDepositoRequest;
use DB;

class HuevoDepositoController extends Controller{
  
  function index(){}
  
	public function create(){
    return view('huevodeposito.create');		
  }

  public function store(Request $request){
    $contador=DB::select("SELECT COUNT(*) as contador,id from huevo_deposito WHERE id_tipo_huevo=?", [$request->id_tipo_huevo]);
    foreach ($contador as $key => $value) {
        $cont = $value->contador;
        $id = $value->id;
    }
    if ($cont==0) {
        HuevoDeposito::create($request->all());
        return response()->json($request->all());        
    }
    else{
        $huevodeposito= HuevoDeposito::find($id);
        $huevodeposito->fill($request->all());
        $huevodeposito->save();
        return response()->json($request->all());        
    }
  }

  public function volver_cajas(Request $request, $tipe) {
      if ($request->ajax()) {
        $dato = DB::select("SELECT caja.id,caja.cantidad_caja,caja.cantidad_maple,caja.cantidad_huevo,caja.id_tipo_caja,caja.fecha,tipo_caja.tipo from caja,tipo_caja WHERE caja.id_tipo_caja=tipo_caja.id AND caja.id_tipo_caja=".$tipe." ORDER by fecha desc LIMIT 7");
          return response()->json($dato);
      }
  }  

  public function obtener_datos_acumulado_venta(Request $request, $tipe) {
      if ($request->ajax()) {
        $dato = DB::select("SELECT caja_deposito.id_tipo_caja,caja_deposito.cantidad_caja FROM caja_deposito WHERE caja_deposito.id_tipo_caja=".$tipe);
          return response()->json($dato);
      }
  }

  public function update(HuevoDepositoRequest $request,$id){
    $huevodeposito= HuevoDeposito::find($id);
    $huevodeposito->fill($request->all());
    $huevodeposito->save();
    return response()->json($request->all());    
  }

  public function edit($id){
      $huevodeposito=HuevoDeposito::find($id);
      return view('huevodeposito.edit',['huevodeposito'=>$huevodeposito]);
  }
}
