<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\VentaCaja;
use App\DetalleVenta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VentaCajaRequest;
use DB;
use Hash;

class VentaCajaController extends Controller{

  /*public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
     $this->middleware('auth',['only'=>'admin']);
  }*/

	function index(){
     $venta_caja=VentaCaja::where('estado', '=', 1)->orderBy('fecha','desc')->paginate(30);
     return view('ventacaja.index',compact('venta_caja'));
	}
  
	public function create(){
    return view('ventacaja.create');		
  }

  public function store(Request $request){
    try {
      DB::beginTransaction();  
        $venta_caja=new VentaCaja;
        $venta_caja->precio=$request->get('precio');
        $venta_caja->fecha=$request->get('fecha');
        $venta_caja->estado=$request->get('estado');
        $venta_caja->save();

        $id_tipo_caja=$request->get('id_tipo_caja');
        $cantidad_caja=$request->get('cantidad_caja');
        $subtotal_precio=$request->get('subtotal_precio');

        $cont=0;

        while ( $cont < count($id_tipo_caja)) {
          $detalle=new DetalleVenta;
          $detalle->id_venta_caja=$venta_caja->id;
          $detalle->id_tipo_caja=$id_tipo_caja[$cont];
          $detalle->cantidad_caja=$cantidad_caja[$cont];
          $detalle->subtotal_precio=$subtotal_precio[$cont];
          $detalle->save();

          $cont=$cont+1;
        }
      DB::commit();
      return redirect('/ventacaja')->with('message','GUARDADO CORRECTAMENTE');  
    } catch (Exception $e) {
      DB::rollback();
    }
    return Redirect::to("ventacaja");
  }

  public function obtener_id_venta(Request $request) {
      if ($request->ajax()) {
        $dato_id = DB::select("SELECT MAX(id)as id FROM venta_caja");
          return response()->json($dato_id);
      }
  }

  public function obtener_datos_acumulado_venta(Request $request, $tipe) {
      if ($request->ajax()) {
        $dato = DB::select("SELECT caja_deposito.id_tipo_caja,caja_deposito.cantidad_caja FROM caja_deposito WHERE caja_deposito.id_tipo_caja=".$tipe);
          return response()->json($dato);
      }
  }
  
  public function show($id){
    $tipo_caja=DB::select("SELECT tipo_caja.id,tipo_caja.tipo,tipo_caja.color,tipo_caja.cantidad_maple,maple.cantidad,tipo_caja.precio FROM tipo_caja,maple WHERE tipo_caja.id_maple=maple.id");

    $venta_caja=DB::table('venta_caja as v')
    ->join('detalle_venta as dv','v.id','=','dv.id_venta_caja')
    ->select('v.id','v.fecha','v.precio')
    ->where('v.id','=',$id)
    ->first();

    $detalle=DB::table('detalle_venta as dt')
    ->join('tipo_caja as tc','dt.id_tipo_caja','=','tc.id')
    ->select('dt.id','dt.id_tipo_caja','tc.tipo','dt.cantidad_caja','dt.subtotal_precio')
    ->where('dt.id_venta_caja','=',$id)
    ->get();
    return view("ventacaja.show",["venta_caja"=>$venta_caja, "detalle"=>$detalle],compact('tipo_caja'));
  }

  public function update(VentaCajaRequest $request, $id) {
    if ($request->ajax()) {
        $actua = DB::table('venta_caja')->where('id', $id)->update(['fecha' => $request->fecha, 'precio' => $request->precio, 'estado' => $request->estado]);
        return response()->json($request->all());
    }
  }

  public function edit($id){
      $ventacaja=VentaCaja::find($id);
      return view('ventacaja.edit',['ventacaja'=>$ventacaja]);
  }

  public function venta_caja_lista($fecha_inicio, $fecha_fin){         
      $ventacaja=DB::select("SELECT venta_caja.id,venta_caja.fecha,venta_caja.precio,venta_caja.estado from venta_caja WHERE venta_caja.estado=1 AND venta_caja.fecha BETWEEN '".$fecha_inicio."' and '".$fecha_fin."' ORDER by venta_caja.fecha DESC");
      return response()->json($ventacaja);
  }
}
