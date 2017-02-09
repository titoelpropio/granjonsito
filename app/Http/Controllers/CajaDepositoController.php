<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\CajaDeposito;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CajaDepositoRequest;
use DB;

class CajaDepositoController extends Controller
{
	function index(){
   $tipo_caja=DB::select("SELECT tipo_caja.id,tipo_caja.tipo,tipo_caja.color,tipo_caja.cantidad_maple,maple.cantidad FROM tipo_caja,maple WHERE tipo_caja.id_maple=maple.id and tipo_caja.estado=1 order by tipo_caja.id");

   $caja_dia=DB::select("SELECT caja.id_tipo_caja,caja.cantidad_maple,caja.cantidad_caja from caja WHERE Date_format(caja.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d')");
   $caja_deposito=DB::select('SELECT caja_deposito.id_tipo_caja,caja_deposito.cantidad_caja,caja_deposito.cantidad_maple from caja_deposito');
   $cantidad_maple=DB::select('SELECT cantidad_maple.id_tipo_caja,cantidad_maple.cantidad_maple from cantidad_maple');

   $tipo_huevo=DB::select("SELECT tipo_huevo.id,tipo_huevo.tipo,maple.cantidad FROM tipo_huevo,maple WHERE tipo_huevo.id_maple=maple.id and tipo_huevo.estado=1 order by tipo_huevo.id");
   $huevo=DB::select("SELECT huevo.id_tipo_huevo,huevo.cantidad_maple FROM tipo_huevo th,huevo WHERE th.id=huevo.id_tipo_huevo AND Date_format(huevo.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d')");
   $huevo_deposito=DB::select("SELECT hd.id,hd.cantidad_maple,hd.id_tipo_huevo FROM huevo_deposito hd");

    $sobrante=DB::select("SELECT sobrante.cantidad_maple, sobrante.cantidad_huevo,sobrante.id_tipo_caja FROM sobrante WHERE Date_format(sobrante.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d')");
    $huevo_acumulado=DB::select("SELECT cantidad FROM huevo_acumulado");

     return view('cajadeposito.index_2',compact('tipo_caja','caja_dia','caja_deposito','sobrante','cantidad_maple','tipo_huevo','huevo','huevo_acumulado','huevo_deposito'));
	}

  function index_admin(){
   $tipo_caja=DB::select("SELECT tipo_caja.id,tipo_caja.tipo,tipo_caja.color,tipo_caja.cantidad_maple,maple.cantidad FROM tipo_caja,maple WHERE tipo_caja.id_maple=maple.id and tipo_caja.estado=1 order by tipo_caja.id");

   $caja_dia=DB::select("SELECT caja.id_tipo_caja,caja.cantidad_maple,caja.cantidad_caja from caja WHERE Date_format(caja.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d')");
   $caja_deposito=DB::select('SELECT caja_deposito.id_tipo_caja,caja_deposito.cantidad_caja,caja_deposito.cantidad_maple from caja_deposito');
   $cantidad_maple=DB::select('SELECT cantidad_maple.id_tipo_caja,cantidad_maple.cantidad_maple from cantidad_maple');

   $tipo_huevo=DB::select("SELECT tipo_huevo.id,tipo_huevo.tipo,maple.cantidad FROM tipo_huevo,maple WHERE tipo_huevo.id_maple=maple.id and tipo_huevo.estado=1 order by tipo_huevo.id");
   $huevo=DB::select("SELECT huevo.id_tipo_huevo,huevo.cantidad_maple FROM tipo_huevo th,huevo WHERE th.id=huevo.id_tipo_huevo AND Date_format(huevo.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d')");
   $huevo_deposito=DB::select("SELECT hd.id,hd.cantidad_maple,hd.id_tipo_huevo FROM huevo_deposito hd");

    $sobrante=DB::select("SELECT sobrante.cantidad_maple, sobrante.cantidad_huevo,sobrante.id_tipo_caja FROM sobrante WHERE Date_format(sobrante.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d')");
    $huevo_acumulado=DB::select("SELECT cantidad FROM huevo_acumulado");

     return view('cajadeposito.index_admin',compact('tipo_caja','caja_dia','caja_deposito','sobrante','cantidad_maple','tipo_huevo','huevo','huevo_acumulado','huevo_deposito'));
  }

	public function create(){
    return view('cajadeposito.create');		
  }

  public function store(Request $request){
  try {
        DB::beginTransaction();
        $contador=DB::select("SELECT COUNT(*) as contador,id from caja_deposito WHERE id_tipo_caja=?", [$request->id_tipo_caja]);
        foreach ($contador as $key => $value) {
            $cont = $value->contador;
            $id = $value->id;
        }
        if ($cont==0) {
            CajaDeposito::create($request->all());
            return response()->json($request->all());
        }
        else{
            $cajadeposito= CajaDeposito::find($id);
            $cajadeposito->fill($request->all());
            $cajadeposito->save();
            return response()->json($request->all());        
        }
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
    }
   // return Redirect::to("ventacaja");
  }

public function caja_deposito(Request $request){
  $caja_deposito=DB::select("SELECT tipo_caja.id,tipo_caja.tipo,tipo_caja.color,tipo_caja.cantidad_maple,maple.cantidad FROM tipo_caja,maple WHERE tipo_caja.id_maple=maple.id and tipo_caja.estado=1");
  return response()->json($caja_deposito);
}

public function huevo_deposito(Request $request){
  $huevo_deposito=DB::select("SELECT tipo_huevo.id,tipo_huevo.tipo,maple.cantidad FROM tipo_huevo,maple WHERE tipo_huevo.id_maple=maple.id and tipo_huevo.estado=1");
  return response()->json($huevo_deposito);
}


  public function obtener_contra(Request $request) {
      if ($request->ajax()) {
        $dato = DB::select("SELECT pass2 FROM users");
          return response()->json($dato);
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

  public function update(CajaDepositoRequest $request,$id){
    $cajadeposito= CajaDeposito::find($id);
    $cajadeposito->fill($request->all());
    $cajadeposito->save();
        return response()->json($request->all()); 
  }

  public function edit($id){
      $cajadeposito=CajaDeposito::find($id);
      return view('cajadeposito.edit',['cajadeposito'=>$cajadeposito]);
  }
}
