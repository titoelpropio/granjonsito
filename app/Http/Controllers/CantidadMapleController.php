<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\CantidadMaple;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CantidadMapleRequest;
use DB;

class CantidadMapleController extends Controller
{

  function index(){
   $tipo_caja=DB::select("SELECT tipo_caja.id,tipo_caja.tipo,tipo_caja.color,tipo_caja.cantidad_maple,maple.cantidad FROM tipo_caja,maple WHERE tipo_caja.id_maple=maple.id and tipo_caja.estado=1 order by tipo_caja.id");

   $caja_dia=DB::select("SELECT caja.id_tipo_caja,caja.cantidad_maple,caja.cantidad_caja from caja WHERE Date_format(caja.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d')");
   $caja_deposito=DB::select('SELECT caja_deposito.id_tipo_caja,caja_deposito.cantidad_caja,caja_deposito.cantidad_maple from caja_deposito');

   $cantidad_maple=DB::select("SELECT cantidad_maple.cantidad_maple,cantidad_maple.id_tipo_caja FROM cantidad_maple");

   $tipo_huevo=DB::select("SELECT tipo_huevo.id,tipo_huevo.tipo,maple.cantidad FROM tipo_huevo,maple WHERE tipo_huevo.id_maple=maple.id and tipo_huevo.estado=1 order by tipo_huevo.id");
   $huevo_dia=DB::select("SELECT huevo.id_tipo_huevo,huevo.cantidad_maple,huevo.cantidad_huevo from huevo WHERE Date_format(huevo.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d')");
   $huevo_deposito=DB::select('SELECT huevo_deposito.id_tipo_huevo,huevo_deposito.cantidad_maple,huevo_deposito.cantidad_huevo from huevo_deposito');

   $huevo_acumulado=DB::select("SELECT cantidad FROM huevo_acumulado");

     return view('cantidadmaple.index',compact('tipo_caja','caja_dia','caja_deposito','cantidad_maple','tipo_huevo','huevo_dia','huevo_deposito','huevo_acumulado'));
  }
  
  
	public function create(){
    return view('cantidadmaple.create');		
  }

  public function store(Request $request){
  try {
    DB::beginTransaction();
        $contador=DB::select("SELECT COUNT(*) as contador,id from cantidad_maple WHERE id_tipo_caja=?", [$request->id_tipo_caja]);
        foreach ($contador as $key => $value) {
            $cont = $value->contador;
            $id = $value->id;
          }
        if ($cont==0) {
          if ($request->ajax()) {
            CantidadMaple::create($request->all());
            DB::commit();
            return response()->json($request->all());
          }
        }
        else{
          if($request->ajax()) {
            $cantidad_maple= CantidadMaple::find($id);
            $cantidad_maple->fill($request->all());
            $cantidad_maple->save();
            DB::commit();
            return response()->json($request->all());        
          } 
        }
    } catch (Exception $e) {
      DB::rollback();
    }
  }





  public function obtener_datos_acumulado(Request $request, $tipe) {
      if ($request->ajax()) {
        $dato = DB::select("SELECT caja_deposito.id_tipo_caja,caja_deposito.cantidad_caja FROM caja_deposito WHERE caja_deposito.id_tipo_caja=".$tipe);
          return response()->json($dato);
      }
  }

  public function obtener_datos_diario(Request $request, $tipe) {
      if ($request->ajax()) {
        $dato_2 = DB::select("SELECT caja.id_tipo_caja,caja.cantidad_caja FROM caja WHERE Date_format(caja.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d') and caja.id_tipo_caja=".$tipe);
          return response()->json($dato_2);
      }
  }

  public function obtener_datos_huevo_acumulado(Request $request, $tipe) {
      if ($request->ajax()) {
        $dato = DB::select("SELECT huevo_deposito.id_tipo_huevo,huevo_deposito.cantidad_maple,huevo_deposito.cantidad_huevo FROM huevo_deposito WHERE huevo_deposito.id_tipo_huevo=".$tipe);
          return response()->json($dato);
      }
  }

  public function obtener_datos_huevo_diario(Request $request, $tipe) {
      if ($request->ajax()) {
        $dato_2 = DB::select("SELECT huevo.id_tipo_huevo,huevo.cantidad_maple FROM huevo WHERE Date_format(huevo.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d') and huevo.id_tipo_huevo=".$tipe);
          return response()->json($dato_2);
      }
  }

  public function obtener_huevo_acumulado(Request $request) {
      if ($request->ajax()) {
        $dato_3 = DB::select("SELECT cantidad FROM huevo_acumulado");
          return response()->json($dato_3);
      }
  }

  public function update(CantidadMapleRequest $request,$id){
    $cantidadmaple= CantidadMaple::find($id);
    $cantidadmaple->fill($request->all());
    $cantidadmaple->save();
    return redirect('/cantidadmaple')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $cantidadmaple=CantidadMaple::find($id);
      return view('cantidadmaple.edit',['cantidadmaple'=>$cantidadmaple]);
  }
}
