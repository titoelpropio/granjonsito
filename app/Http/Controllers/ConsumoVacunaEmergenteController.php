<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConsumoVacunaEmergente;
use App\Galpon;
use App\Silos;
use App\Http\Requests;
use App\Http\Requests\ConsumoVacunaEmergenteRequest;
use Session;
use Redirect;
use DB;

class ConsumoVacunaEmergenteController extends Controller {

    function index() {
        $consumo = DB::SELECT("SELECT vacuna_emergente.nombre,vacuna_emergente.detalle from edad,vacuna_emergente,consumo_emergente WHERE edad.id=consumo_emergente.id_edad AND vacuna_emergente.id=consumo_emergente.id_vacuna AND consumo_emergente.deleted_at IS NULL AND edad.id=53");
        return view('consumo_vacuna.index', compact('consumo'));
    }

    public function create() {
    }

    public function store(ConsumoVacunaEmergenteRequest $request) {
        if($request->get("id_galponcv")==0){
            Session::flash('message-error', 'SELECCIONE QUE GALPON VA A CONSUMIR');
            return Redirect::to('/vacuna_emergente'); 
        }else{
            $con_vac_emer=DB::table("consumo_emergente")->insert(['cantidad'=>$request->get("cantidad_vac"),'precio'=>$request->get("precio_vac"),'estado'=>$request->get("estado_vac"),'id_edad'=>$request->get("id_galponcv"),'id_vacuna'=>$request->get("id_vac")]);
            Session::flash('message', 'CONSUMIDO CORRECTAMENTE');
            return Redirect::to('/vacuna_emergente');
        }
    }


      public function update(Request $request){
        $id = $request->get("id_con_vac_emer");
        
        $con_vac=DB::table('consumo_emergente')->where('id', $id)->update(['cantidad' => $request->get("cantidad_con_vac_emer"), 'precio'=> $request->get("precio_con_vac_emer")]);
        return redirect('/consumo_vacuna_emergente')->with('message','MODIFICADO CORRECTAMENTE');  
      }

    public function edit($id) {
        $consumo = Consumo::find($id);
        return response()->json($consumo);
    }


    public function destroy(Request $request) {
        $id=$request->get("id_con_vac_emer_eli");
        $fecha=DB::select("SELECT CURDATE() as fecha");
        $con_vac=DB::table('consumo_emergente')->where('id', $id)->update(['deleted_at' => $fecha[0]->fecha]);        
        return redirect('/consumo_vacuna_emergente')->with('message','ELIMINADO CORRECTAMENTE');  
    }

}
