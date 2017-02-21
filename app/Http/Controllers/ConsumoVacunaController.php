<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConsumoVacuna;
use App\Http\Requests;
use App\Http\Requests\ConsumoVacunaRequest;
use Session;
use Redirect;
use DB;

class ConsumoVacunaController extends Controller {

    function index() {
        return view('consumo_vacuna.index');
    }

    public function create() {
    }

    public function store(ConsumoVacunaRequest $request) {
        if ($request->ajax()) {
            $consumo_vac=DB::table('consumo_vacuna')->insert(['cantidad'=>$request->cantidad, 'precio'=>$request->precio, 'id_control_vacuna'=>$request->id_control_vacuna, 'estado'=>$request->estado]);            
           // $consumo = ConsumoVacuna::create($request->all());             
            return response()->json($request->all());
        }
    }

    public function edit($id) {
        $consumo = Consumo::find($id);
        return response()->json($consumo);
    }

  public function update(Request $request){
    $id=$request->get("id_con_vac");
    $cantidad = $request->get("cantidad_con_vac");
    $precio = $request->get("precio_con_vac");
    $con_vac=DB::table('consumo_vacuna')->where('id', $id)->update(['cantidad' => $cantidad, 'precio'=> $precio]);
    return redirect('/consumo_vacuna_emergente')->with('message','MODIFICADO CORRECTAMENTE');  
  }

    public function destroy(Request $request) {
        $id=$request->get("id_con_vac_eli");
        $fecha=DB::select("SELECT CURDATE() as fecha");
        $con_vac=DB::table('consumo_vacuna')->where('id', $id)->update(['deleted_at' => $fecha[0]->fecha]);        
        return redirect('/consumo_vacuna_emergente')->with('message','ELIMINADO CORRECTAMENTE');  
    }

    public function lista_consumo_vacuna_emergente($id_edad){
      $select=DB::select("SELECT consumo_emergente.id,('EMERGENTE')as edad, vacuna_emergente.nombre,vacuna_emergente.detalle,consumo_emergente.cantidad,consumo_emergente.precio,vacuna_emergente.precio as precio_unitario from edad,vacuna_emergente,consumo_emergente WHERE edad.id=consumo_emergente.id_edad AND vacuna_emergente.id=consumo_emergente.id_vacuna AND consumo_emergente.deleted_at IS NULL AND edad.id=".$id_edad." 
    UNION
SELECT consumo_vacuna.id, vacuna.edad,vacuna.nombre,vacuna.detalle,consumo_vacuna.cantidad,consumo_vacuna.precio,vacuna.precio as precio_unitario from edad,vacuna,consumo_vacuna,control_vacuna WHERE edad.id=control_vacuna.id_edad AND control_vacuna.id_vacuna=vacuna.id AND consumo_vacuna.id_control_vacuna=control_vacuna.id  AND consumo_vacuna.deleted_at IS NULL AND edad.id=".$id_edad);
      return response()->json($select);
    }

    public function select_control_vacuna_fase(){
      $select=DB::select("SELECT galpon.id as id_galpon,edad.id as id_edad,fases.nombre,fases.numero FROM edad,galpon,fases_galpon,fases WHERE edad.id_galpon=galpon.id AND edad.estado=1 AND fases.id=fases_galpon.id_fase AND fases_galpon.id_edad=edad.id AND fases.nombre!='PONEDORA' GROUP BY edad.id ORDER by fases.numero");
      return response()->json($select);
    }

}
