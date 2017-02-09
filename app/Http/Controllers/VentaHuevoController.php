<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\VentaHuevo;
use App\DetalleVentaHuevo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VentaHuevoRequest;
use DB;
use Hash;

class VentaHuevoController extends Controller{
 
  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
     $this->middleware('auth',['only'=>'admin']);
  }

	function index(){
     $venta_huevo=VentaHuevo::where('estado', '=', 1)->orderBy('fecha','desc')->paginate(30);
     return view('ventahuevo.index',compact('venta_huevo'));
	}
  
	public function create(){
    return view('ventahuevo.create');		
  }

  public function store(Request $request){
    try {
      DB::beginTransaction();  
        $venta_huevo=new VentaHuevo;
        $venta_huevo->precio=$request->get('precio');
        $venta_huevo->fecha=$request->get('fecha');
        $venta_huevo->estado=$request->get('estado');
        $venta_huevo->save();

        $id_tipo_huevo=$request->get('id_tipo_huevo');
        $cantidad_maple=$request->get('cantidad_maple');
        $cantidad_huevo=$request->get('cantidad_huevo');
        $subtotal_precio=$request->get('subtotal_precio');

        $cont=0;

        while ( $cont < count($id_tipo_huevo)) {
          $detalle=new DetalleVentaHuevo;
          $detalle->id_venta_huevo=$venta_huevo->id;
          $detalle->id_tipo_huevo=$id_tipo_huevo[$cont];
          $detalle->cantidad_maple=$cantidad_maple[$cont];
          $detalle->cantidad_huevo=$cantidad_huevo[$cont];
          $detalle->subtotal_precio=$subtotal_precio[$cont];
          $detalle->save();
          $cont=$cont+1;
        }
      DB::commit();
      return redirect('/ventahuevo')->with('message','GUARDADO CORRECTAMENTE');  
    } catch (Exception $e) {
      DB::rollback();
    }
    return Redirect::to("ventahuevo");
  }

  public function obtener_id_venta_huevo(Request $request) {
    if ($request->ajax()) {
        $dato_id = DB::select("SELECT MAX(id)as id FROM venta_huevo");
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

    $venta_huevo=DB::table('venta_huevo as v')
    ->join('detalle_venta_huevo as dv','v.id','=','dv.id_venta_huevo')
    ->select('v.id','v.fecha','v.precio')
    ->where('v.id','=',$id)
    ->first();

    $detalle=DB::table('detalle_venta_huevo as dt')
    ->join('tipo_huevo as tc','dt.id_tipo_huevo','=','tc.id')
    ->select('dt.id_tipo_huevo','tc.tipo','dt.cantidad_maple','dt.cantidad_huevo','dt.subtotal_precio')
    ->where('dt.id_venta_huevo','=',$id)
    ->get();
    return view("ventahuevo.show",["venta_huevo"=>$venta_huevo, "detalle"=>$detalle],compact('tipo_caja'));
  }

  public function update(VentaHuevoRequest $request, $id) {
    if ($request->ajax()) {
        $actua=DB::table('venta_huevo')->where('id', $id)->update(['fecha'=>$request->fecha, 'precio'=>$request->precio, 'estado'=>$request->estado]);
        return response()->json($request->all());
    }
  }

  public function edit($id){
      $ventahuevo=VentaHuevo::find($id);
      return view('ventahuevo.edit',['ventahuevo'=>$ventahuevo]);
  }
}
